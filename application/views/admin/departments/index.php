
<h3 class="page-header">Quản lý khoa</h3>

<div class="text-right" style="margin-bottom: 25px;">
    <a href="/admin/departments/create" class="btn btn-default">
        Thêm mới
    </a>
</div>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách khoa
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã khoa</th>
                            <th>Tên khoa</th>
                            <th>Người tạo</th>
                            <th>Thao tác</th>
                        </tr>

                        <tr>
                            <th></th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('code')); ?>" name="code" type="text" class="form-control input-sm"/>
                            </th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('name')); ?>" name="name" type="text" class="form-control input-sm"/>
                            </th>
                            <th></th>
                            <th>
                                <input type="submit" class="btn btn-default btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/departments" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($departments) && is_array($departments) && !empty($departments)): ?>
                            <?php foreach ($departments as $index => $department): ?>
                            <tr>
                                <td><?php echo format_value($index + 1); ?></td>
                                <td><?php echo format_value($department['code']); ?></td>
                                <td><?php echo format_value($department['name']); ?></td>
                                <td><?php echo format_value($department['user_name']); ?></td>
                                <td>
                                    <a href="/admin/departments/edit/<?php echo $department['id']; ?>" class="btn btn-default btn-xs">
                                        Sửa <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/departments/delete/<?php echo $department['id']; ?>" class="btn btn-danger btn-xs">
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
