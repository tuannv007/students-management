<?php

$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : 0;
$school_year_id = isset($_GET['school_year_id']) ? $_GET['school_year_id'] : 0;

echo json_encode([
    'code' => 200,
    'message' => 'Lấy danh sách lớp thành công',
    'data' => [
        'classes' => db_find_classes_by_department_and_school_year($department_id, $school_year_id),
    ],
]);
// lay ra danh sach lop
//done
