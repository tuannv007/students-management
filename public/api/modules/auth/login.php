<?php

$account = 'system';
$password = 'system';

// $response = [
//     'code' => '',
//     'message' => '',
//     'error' => [],
//     'data' => []
// ];

$user = db_authenticate($account, $password);

if ($user) {
    $response['code'] = 200;
    $response['message'] = 'success';
    $response['error'] = [];
    $response['data']['user'] = $user;
} else {
    $response['code'] = 401;
    $response['message'] = 'authenticated failed';
    $response['error12323'] = ['Đăng nhập thất bại'];
    $response['data'] = null;
}

ec json_encode($response);
