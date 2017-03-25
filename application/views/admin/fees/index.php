
<h3 class="page-header">Quản lý khoản thu</h3>

<div class="text-right" style="margin-bottom: 25px;">
    <a href="/admin/input" class="btn btn-default">
        Truy thu theo lớp
    </a>

    <a href="/admin/fees/create" class="btn btn-default">
        Thêm mới
    </a>
</div>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách khoản thu
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tên khoản thu</th>
                            <th>Năm thu</th>
                            <th>Số tiền</th>
                            <th>Người tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>

                        <tr>
                            <th class="text-center"></th>
                            <th>
                                <input value="<?php echo format_value($this->input->get('title')); ?>" placeholder="Tên khoản thu" name="title" type="text" class="form-control input-sm"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-center">
                                <input type="submit" class="btn btn-info btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/fees" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($fees) && is_array($fees) && !empty($fees)): ?>
                            <?php foreach ($fees as $index => $fee): ?>
                            <tr>
                                <td class="text-center"><?php echo format_value($index + 1); ?></td>
                                <td><?php echo format_value($fee['title']); ?></td>
                                <td><?php echo format_value($fee['year']); ?></td>
                                <td><?php echo format_value($fee['amount']); ?></td>
                                <td><?php echo format_value($fee['user_name']); ?></td>
                                <td class="text-center">
                                    <a href="/admin/fees/edit/<?php echo $fee['id']; ?>" class="btn btn-default btn-xs">
                                        Sửa <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/fees/delete/<?php echo $fee['id']; ?>" class="btn btn-danger btn-xs">
                                        Xóa <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="20">
                                    Không tìm thấy khoản thu nào.
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
