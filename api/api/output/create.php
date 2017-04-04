<?php

$data['title'] = isset($_POST['title']) ? $_POST['title'] : '';
$data['user_id'] = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$data['amount'] = isset($_POST['amount']) ? $_POST['amount'] : 0;
$data['description'] = isset($_POST['description']) ? $_POST['description'] : '';
$data['paid_date'] = date('Y-m-d');
$data['department_id'] = isset($_POST['department_id']) ? $_POST['department_id'] : 0;

$input_total = db_calculate_input_total_by_department_year($data['department_id'], date('Y'));


if ($data['amount'] > $input_total) {
	$response['code'] = 422;
	$response['message'] = 'Khoan chi vuot qua quy.';
	$response['data'] = '';
} else {
	$check = db_insert_new_payments($data);

	if ($check) {
	    $response['code'] = 200;
	    $response['message'] = 'Thêm mới thành công.';
	    $response['data'] = '';
	} else {
	    $response['code'] = 500;
	    $response['message'] = 'Thêm mới thất bại.';
	    $response['data'] = '';
	}
}


echo json_encode($response);
// them moi khoan chi
//done