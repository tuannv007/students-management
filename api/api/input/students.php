<?php

$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
$fee_id = isset($_GET['fee_id']) ? $_GET['fee_id'] : 0;

echo json_encode([
    'code' => 200,
    'message' => 'Lấy danh sách đoàn viên thành công',
    'data' => [
        'students' => db_get_students_with_trade_in_class_by_fee($class_id, $fee_id),
    ],
]);
// lay ra danh sach doan vien  dua vao lop 
//done