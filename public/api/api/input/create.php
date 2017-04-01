<?php

$data['title'] = isset($_POST['title']) ? $_POST['title'] : '';
$data['year'] = isset($_POST['year']) ? $_POST['year'] : date('Y');
$data['amount'] = isset($_POST['amount']) ? $_POST['amount'] : 0;
$data['description'] = isset($_POST['description']) ? $_POST['description'] : date('Y');

$check = db_insert_new_fee($data);

if ($check) {
    $response['code'] = 200;
    $response['message'] = 'Thêm mới thành công.';
    $response['data'] = '';
} else {
    $response['code'] = 500;
    $response['message'] = 'Thêm mới thất bại.';
    $response['data'] = '';
}

echo json_encode($response);
