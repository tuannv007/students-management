
<h3 class="page-header">Quản lý khoản chi</h3>

<form class="form-inline">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <select name="department_id" class="form-control input-sm">
                    <?php foreach ($departments as $d): ?>
                        <?php $selected = $d['id'] == $this->input->get('department_id') ? 'selected' : ''; ?>
                        <option value="<?php echo $d['id']; ?>" <?php echo $selected; ?>><?php echo $d['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input value="<?php echo $this->input->get('year'); ?>" placeholder="Năm" name="year" type="text" class="form-control input-sm"/>
            </div>
            <div class="form-group">
                <input type="submit" name="filter" value="Lọc" class="btn btn-info btn-sm" />
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <a href="/admin/output/create/<?php echo $department_id; ?>" class="btn btn-default btn-sm">
                        Thêm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php if (! isset($payments) || empty($payments)): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thống kê</div>
                <div class="panel-body">
                    Chua co khoan chi nao.
                </div>
            <div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Thống kê</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-default table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền (VNĐ):</td>
                                    <td><?php echo number_format($input_total); ?></td>
                                </tr>
                                <tr>
                                    <td>Đã chi (VNĐ):</td>
                                    <td><?php echo number_format($output_total); ?></td>
                                </tr>
                                <tr>
                                    <td>Còn lại:</td>
                                    <td><?php echo number_format($input_total - $output_total) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dánh sách chi
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-default table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Tên khoản chi</th>
                                    <th>Ngày chi</th>
                                    <th>Người chi</th>
                                    <th class="text-right">Lượng tiền(VNĐ)</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (isset($payments) && is_array($payments) && ! empty($payments)): ?>
                                    <?php foreach($payments as $index => $payment): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $index + 1; ?></td>
                                            <td><?php echo $payment['title']; ?></td>
                                            <td><?php echo $payment['paid_date']; ?></td>
                                            <td><?php echo $payment['user_name']; ?></td>
                                            <td class="text-right"><?php echo number_format($payment['amount']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="text-right"><?php echo number_format($output_total); ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="20">Không thấy khoản chi nào.</td>
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
        </div>
    </div>
<?php endif; ?>
