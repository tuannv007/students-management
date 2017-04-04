<?php

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'students.dev');

$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
    or die('Can not connect database.');

function db_escape($value)
{
    return $value;
}

function db_query($sql)
{
    global $link;

    return mysqli_query($link, $sql);
}

function db_fetch_one($result)
{
    return mysqli_fetch_assoc($result);
}

function db_fetch_all($result)
{
    $items = [];

    while ($item = mysqli_fetch_assoc($result)) {
        $items[] = $item;
    }

    return $items;
}

function db_authenticate($account, $password)
{
    $account = db_escape($account);
    $password = sha1($password);

    $sql = "SELECT * FROM users WHERE account = '{$account}' AND password = '{$password}'";

    return db_fetch_one(db_query($sql));
}

function db_get_all($table)
{
    global $link;
    $sql = "SELECT * FROM {$table}";
    mysqli_set_charset($link, 'utf8');
    return db_fetch_all(db_query($sql));
}

function db_find_classes_by_department_and_school_year($department_id, $school_year_id)
{
    $department_id = db_escape($department_id);
    $school_year_id = db_escape($school_year_id);

    $sql = "SELECT * FROM classes WHERE department_id = '{$department_id}' AND school_year_id = '{$school_year_id}'";

    return db_fetch_all(db_query($sql));
}

function db_get_students_by_class_id($class_id)
{
    $class_id = db_escape($class_id);

    $sql = "SELECT * FROM students WHERE class_id = '{$class_id}'";

    return db_fetch_all(db_query($sql));
}

function db_get_students_with_trade_in_class_by_fee($class_id, $fee_id)
{
    global $link;
     $sql = "SELECT `students`.`id`, `students`.`code`, `students`.`name`, `classes`.`name` as `class_name`
        FROM `students`
        JOIN `classes` ON `students`.`class_id` = `classes`.`id`
        WHERE `classes`.`id` = '{$class_id}'
        ORDER BY `students`.`id` ASC";
    mysqli_set_charset($link, 'utf8');
    $students = db_fetch_all(db_query($sql));

    $sql = "SELECT `student_id`, `date_fee`
            FROM `student_fee`
            WHERE `fee_id` = '{$fee_id}'";
    mysqli_set_charset($link, 'utf8');
    $student_fees = db_fetch_all(db_query($sql));

    foreach ($student_fees as $key => $stf) {
        $has_fees[$stf['student_id']] = $stf['date_fee'];
    }

    $has_fees = isset($has_fees) ? $has_fees : [];

    foreach ($students as $key => $st) {
        if (array_key_exists($st['id'], $has_fees)) {
            $students[$key]['fee_paid'] = 1;
            $students[$key]['date_fee'] = $has_fees[$st['id']];
        } else {
            $students[$key]['fee_paid'] = 0;
        }
    }
 
    return $students;
}

function db_unset_student_fees($fee_id, array $unset_st_ids)
{
    $unset_st_ids = implode(',', $unset_st_ids);
    $sql = "DELETE FROM student_fee WHERE fee_id = {$fee_id} AND student_id in ({$unset_st_ids})";
    return db_query($sql);
}

function db_new_student_fees($fee_id, array $new_st_ids)
{
    foreach ($new_st_ids as $key => $student_id) {
        $data[$key]['fee_id'] = "'$fee_id'";
        $data[$key]['student_id'] = "'$student_id'";
        $data[$key]['date_fee'] = "'" . date('Y-m-d') . "'";
        $data[$key] = '(' . implode(',', $data[$key]) . ')';
    }

    if (isset($data)) {
        $values = implode(',', $data);
        $sql = "INSERT INTO student_fee(fee_id, student_id, date_fee) values {$values}";
        return db_query($sql);
    }

    return null;
}

function db_insert_new_fee($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = "'" . db_escape($value) . "'";
    }

    $values = implode(',', $data);

    $sql = "INSERT INTO fees(title, year, amount, description) values({$values})";

    return db_query($sql);
}

function db_insert_new_payments($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = "'" . db_escape($value) . "'";
    }

    $values = implode(',', $data);

    $sql = "INSERT INTO payments(title, user_id, amount, description, paid_date,department_id) values({$values})";

    return db_query($sql);
}

function db_get_payments_in_year($year)
{
    $sql = "SELECT `payments`.`id`, `payments`.`title`, `payments`.`amount`, `payments`.`paid_date`, `users`.`name` as `user_name`
            FROM `payments`
            JOIN `users` ON `payments`.`user_id` = `users`.`id`
            WHERE year(paid_date) = '{$year}'";

    return db_fetch_all(db_query($sql));
}

function db_calculate_paid_total_in_year($year)
{
    $sql = "SELECT sum(amount) as paid_total
            FROM `payments`
            WHERE year(paid_date) = '{$year}'";

    return db_fetch_one(db_query($sql))['paid_total'];
}

function db_calculate_input_total_in_year($year)
{
    $sql = "SELECT sum(`fees`.`amount`) as input_total
            FROM `fees`
            INNER JOIN `student_fee` ON `fees`.`id` = `student_fee`.`fee_id`
            WHERE year(`student_fee`.`date_fee`) = '{$year}'";

    return db_fetch_one(db_query($sql))['input_total'];
}

function db_calculate_input_total_by_department_year($department_id, $year)
{
    $sql = "SELECT sum(`fees`.`amount`) as input_total
            FROM `fees`
            INNER JOIN `student_fee` ON `fees`.`id` = `student_fee`.`fee_id`
            INNER JOIN `students` ON `student_fee`.`student_id` = `students`.`id`
            INNER JOIN `classes` ON `students`.`class_id` = `classes`.`id`
            INNER JOIN `departments` ON `classes`.`department_id` = `departments`.`id`
            WHERE `departments`.`id` = '{$department_id}' AND year(`student_fee`.`date_fee`) = '{$year}'";

    return db_fetch_one(db_query($sql))['input_total'];
}

function db_calculate_output_total_by_department_year($department_id, $year)
{
    $sql = "SELECT sum(amount) as paid_total
            FROM `payments`
            WHERE `department_id` = '{$department_id}'
            AND year(paid_date) = '{$year}'";

    return db_fetch_one(db_query($sql))['paid_total'];
}

function db_get_payments_by_department_year($department_id, $year)
{
    $sql = "SELECT `payments`.`id`, `payments`.`title`, `payments`.`amount`, `payments`.`paid_date`, `users`.`name` as `user_name`
            FROM `payments`
            JOIN `users` ON `payments`.`user_id` = `users`.`id`
            WHERE `department_id` = '{$department_id}'
            AND year(paid_date) = '{$year}'";

    return db_fetch_all(db_query($sql));
}
