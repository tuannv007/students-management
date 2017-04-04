
<h3 class="page-header">Quản lý khoản thu</h3>

<div class="row">
    <div class="col-md-8">
        <form method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chỉnh sửa khoản thu
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
                        <label for="">Tên khoản thu *</label>
                        <input value="<?php echo set_value('title', $fee['title']); ?>" type="text" name="title" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('title'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Năm thu *</label>
                        <input value="<?php echo set_value('year', $fee['year']); ?>" type="text" name="year" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('year'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Khoản tiền *</label>
                        <input value="<?php echo set_value('amount', $fee['amount']); ?>" type="text" name="amount" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('amount'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea name="description" rows="10" class="form-control"><?php echo set_value('description', $fee['description']); ?></textarea>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('description'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                            <a href="/admin/fees" class="btn btn-default">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
