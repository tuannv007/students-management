
<h3 class="page-header">Quản lý niên khóa</h3>

<div class="text-right" style="margin-bottom: 25px;">
    <a href="/admin/school_years/create" class="btn btn-default">
        Thêm mới
    </a>
</div>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách niên khóa
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Ký hiệu</th>
                            <th>Tên niên khóa</th>
                            <th>Năm bắt đầu</th>
                            <th>Năm kết thúc</th>
                            <th class="text-center">Thao tác</th>
                        </tr>

                        <tr>
                            <th></th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('name')); ?>" name="name" type="text" class="form-control input-sm"/>
                            </th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('label')); ?>" name="label" type="text" class="form-control input-sm"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th class="text-center">
                                <input type="submit" class="btn btn-info btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/school_years" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($school_years) && is_array($school_years) && !empty($school_years)): ?>
                            <?php foreach ($school_years as $index => $sy): ?>
                            <tr>
                                <td class="text-center"><?php echo format_value($index + 1); ?></td>
                                <td><?php echo format_value($sy['name']); ?></td>
                                <td><?php echo format_value($sy['label']); ?></td>
                                <td><?php echo format_value($sy['start_year']); ?></td>
                                <td><?php echo format_value($sy['end_year']); ?></td>
                                <td class="text-center">
                                    <a href="/admin/school-years/edit/<?php echo $sy['id']; ?>" class="btn btn-default btn-xs">
                                        Sửa <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/school-years/delete/<?php echo $sy['id']; ?>" class="btn btn-danger btn-xs">
                                        Xóa <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="20">
                                    Không tìm thấy khoa nào.
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
