<?php

$year = isset($_GET['year']) ? $_GET['year'] : '';
$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : 0;

$input_total = db_calculate_input_total_by_department_year($department_id, $year);
$output_total = db_calculate_output_total_by_department_year($department_id, $year);
$payments = db_get_payments_by_department_year($department_id, $year);



echo json_encode([
    'code' => 200,
    'message' => 'Danh sách chi',
    'data' => [
        'input_total' => $input_total,
        'output_total' => $output_total,
        'rest_total' => $input_total - $output_total,
        'payments' => $payments,
    ],
]);
// danh sach cac khoan chi
//done
