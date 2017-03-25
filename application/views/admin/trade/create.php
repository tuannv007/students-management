
<h3 class="page-header">Quản lý khoản chi</h3>

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
        <form method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thêm mới khoản chi
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo isset($error) ? $error : ''; ?>
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Tên khoản chi *</label>
                        <input value="<?php echo set_value('title'); ?>" type="text" name="title" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('title'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Khoản tiền *</label>
                        <input value="<?php echo set_value('amount'); ?>" type="text" name="amount" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('amount'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea name="description" rows="10" class="form-control"><?php echo set_value('description'); ?></textarea>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('description'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <a href="/admin/output?year=<?php echo $year; ?>" class="btn btn-default">Hủy bỏ</a>
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
