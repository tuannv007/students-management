
<h3 class="page-header">Quản lý đoàn viên</h3>

<div class="text-right" style="margin-bottom: 25px;">
    <a href="/admin/students/create" class="btn btn-default">
        Thêm mới
    </a>
</div>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách đoàn viên
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Mã ĐV</th>
                            <th>Tên ĐV</th>
                            <th>Khoa</th>
                            <th>Niên khóa</th>
                            <th>Lớp</th>
                            <th class="text-center">Thao tác</th>
                        </tr>

                        <tr>
                            <th></th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('code')); ?>" placeholder="Mã ĐV" name="code" type="text" class="form-control input-sm"/>
                            </th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('name')); ?>" placeholder="Tên ĐV" name="name" type="text" class="form-control input-sm"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-center">
                                <input type="submit" class="btn btn-info btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/students" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($students) && is_array($students) && !empty($students)): ?>
                            <?php foreach ($students as $index => $st): ?>
                            <tr>
                                <td class="text-center"><?php echo format_value($index + 1); ?></td>
                                <td><?php echo format_value($st['code']); ?></td>
                                <td><?php echo format_value($st['name']); ?></td>
                                <td><?php echo format_value($st['department_name']); ?></td>
                                <td><?php echo format_value($st['school_year_label']); ?></td>
                                <td><?php echo format_value($st['class_name']); ?></td>
                                <td class="text-center">
                                    <a href="/admin/students/edit/<?php echo $st['id']; ?>" class="btn btn-default btn-xs">
                                        Sửa <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/students/delete/<?php echo $st['id']; ?>" class="btn btn-danger btn-xs">
                                        Xóa <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="20">
                                    Không tìm thấy đoàn viên nào.
                                </td>
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
