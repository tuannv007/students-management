<?php

$year = isset($_GET['year']) ? $_GET['year'] : '';

$input_total = db_calculate_input_total_in_year($year);
$output_total = db_calculate_paid_total_in_year($year);
$payments = db_get_payments_in_year($year);

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
