<?php

sess_destroy();

if (! sess_has('user')) {
    echo json_encode([
        'code' => 200,
        'message' => 'Đăng xuất thành công',
        'data' => null,
    ]);
} else {
    echo json_encode([
        'code' => 500,
        'message' => 'Đăng xuất thất bại',
        'data' => null,
    ]);
}
