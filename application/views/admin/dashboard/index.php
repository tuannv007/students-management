<h3 class="page-header">Bảng điều khiển</h3>

<form>
    <div class="panel panel-default">
        <div class="panel-heading">
            Thống kê khoa tính đến năm <?php echo $year; ?>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-default table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã khoa</th>
                            <th>Tên khoa</th>
                            <th>Số niên khóa</th>
                            <th>Số lớp</th>
                            <th>Lượng sinh viên</th>
                            <th>Thao tác</th>
                        </tr>

                        <tr>
                            <th></th>
                            <th></th>
                            <th>
                                <input value="<?php echo $this->input->get('name'); ?>" name="name" placeholder="Tên khoa" type="text" class="form-control input-sm"/>
                            </th>
                            <th>
                                <input value="<?php echo $this->input->get('year'); ?>" name="year" placeholder="Năm" type="text" class="form-control input-sm"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th class="text-center">
                                <input type="submit" class="btn btn-info btn-sm" value="Tìm kiếm"/>
                                <a href="/admin/departments" class="btn btn-default btn-sm">Hủy bỏ</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($departments) && is_array($departments) && !empty($departments)): ?>
                            <?php foreach ($departments as $index => $department): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $department['code']; ?></td>
                                <td><?php echo $department['name']; ?></td>
                                <td><?php echo $department['school_years_count']; ?></td>
                                <td><?php echo $department['classes_count']; ?></td>
                                <td><?php echo $department['students_count']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-info btn-xs">
                                        Xem <i class="fa fa-info"></i>
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
