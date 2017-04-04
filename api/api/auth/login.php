<?php

$account = isset($_POST['account']) ? $_POST['account'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

// $response = [
//     'code' => '',
//     'message' => '',
//     'error' => [],
//     'data' => []
// ];

pre(sess_all());

$user = db_authenticate($account, $password);

if ($user) {
    $response['code'] = 200;
    $response['message'] = 'Đăng nhập thành công.';
    $response['data']['user'] = $user;
    sess_put('user', $user);
} else {
    $response['code'] = 401;
    $response['message'] = 'Đăng nhập thất bại.';
    $response['data'] = null;
}

echo json_encode($response);
