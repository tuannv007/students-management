
<h3 class="page-header">Quản lý lớp</h3>

<div class="text-right" style="margin-bottom: 25px;">
    <a href="/admin/classes/create" class="btn btn-default">
        Thêm mới
    </a>
</div>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách lớp
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Khoa</th>
                            <th>Niên khóa</th>
                            <th class="text-center">Thao tác</th>
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
                            <th></th>
                            <th class="text-center">
                                <input type="submit" class="btn btn-info btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/classes" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($classes) && is_array($classes) && !empty($classes)): ?>
                            <?php foreach ($classes as $index => $class): ?>
                            <tr>
                                <td class="text-center"><?php echo format_value($index + 1); ?></td>
                                <td><?php echo format_value($class['code']); ?></td>
                                <td><?php echo format_value($class['name']); ?></td>
                                <td><?php echo format_value($class['department_name']); ?></td>
                                <td><?php echo format_value($class['school_year_label']); ?></td>
                                <td class="text-center">
                                    <a href="/admin/classes/edit/<?php echo $class['id']; ?>" class="btn btn-default btn-xs">
                                        Sửa <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/classes/delete/<?php echo $class['id']; ?>" class="btn btn-danger btn-xs">
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
