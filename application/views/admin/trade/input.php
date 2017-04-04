
<h3 class="page-header">Quản lý thu</h3>

<form class="form-inline">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <select class="form-control input-sm" name="department_id">
                    <?php foreach ($departments as $d): ?>
                        <?php $selected = $d['id'] == $department_id ? 'selected' : ''; ?>
                        <option value="<?php echo $d['id'] ?>" <?php echo $selected; ?>><?php echo $d['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control input-sm" name="school_year_id">
                    <?php foreach ($school_years as $sy): ?>
                        <?php $selected = $sy['id'] == $school_year_id ? 'selected' : ''; ?>
                        <option value="<?php echo $sy['id'] ?>" <?php echo $selected; ?>><?php echo $sy['label'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control input-sm" name="class_id">
                    <?php foreach ($classes as $class): ?>
                        <?php $selected = $class['id'] == $class_id ? 'selected' : ''; ?>
                        <option value="<?php echo $class['id'] ?>" <?php echo $selected; ?>><?php echo $class['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control input-sm" name="fee_id">
                    <?php foreach ($fees as $fee): ?>
                        <?php $selected = $fee['id'] == $fee_id ? 'selected' : ''; ?>
                        <option value="<?php echo $fee['id']; ?>" <?php echo $selected; ?>><?php echo $fee['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" name="filter" value="Lọc" class="btn btn-info btn-sm" />
        </div>
    </div>
</form>

<form method="post">
    <input type="hidden" name="fee_id" value="<?php echo $fee_id; ?>">

    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách sinh viên
            <button type="submit" name="submit" class="btn btn-default btn-xs pull-right">
                Cập nhật
            </button>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Mã ĐV</th>
                            <th>Tên ĐV</th>
                            <th>Lớp</th>
                            <th>Khoản tiền (VNĐ)</th>
                            <th>Đã thu</th>
                            <th>Ngày thu</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($students) && is_array($students) && ! empty($students)): ?>
                            <?php foreach ($students as $index => $st): ?>
                                <tr>
                                    <td class="text-center"><?php echo $index + 1; ?></td>
                                    <td><?php echo $st['code']; ?></td>
                                    <td><?php echo $st['name']; ?></td>
                                    <td><?php echo $st['class_name']; ?></td>
                                    <td><?php echo $fee['amount']; ?></td>
                                    <td>
                                        <?php if ($st['fee_paid']): ?>
                                            <span class="label label-success">Đã thu</span>
                                        <?php else: ?>
                                            <div class="checkbox">
                                                <label for="">
                                                    <input type="checkbox" name="student_ids[]" value="<?php echo $st['id']; ?>"/>
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $st['fee_paid'] ? $st['date_fee'] : ''; ?></td>
                                    <td class="text-center">
                                        <?php if ($st['fee_paid']): ?>
                                            <a href="/admin/input/unset-fee/<?php echo $fee_id; ?>/<?php echo $st['id']; ?>?<?php echo $this->input->server('QUERY_STRING'); ?>" class="btn btn-danger btn-xs">
                                                <i class="fa fa-edit"></i> Hủy bỏ
                                            </a>
                                        <?php else: ?>
                                            <!-- <a href="javascript:void(0)" class="btn btn-default btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a> -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="20">Không tìm thấy sinh viên nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="text-right">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</form>
