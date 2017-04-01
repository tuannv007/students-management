<?php

$fee_id = isset($_POST['fee_id']) ? $_POST['fee_id'] : 0;

$unset_st_ids = isset($_POST['unset_st_ids']) ? $_POST['unset_st_ids'] : null;
if ($unset_st_ids != null) {
    db_unset_student_fees($fee_id, $unset_st_ids);
}

$new_st_ids = isset($_POST['new_st_ids']) ? $_POST['new_st_ids'] : null;
if ($new_st_ids != null) {
    db_new_student_fees($fee_id, $new_st_ids);
}

echo json_encode([
    'code' => 200,
    'message' => 'Cập nhật thành công',
    'data' => null,
]);
