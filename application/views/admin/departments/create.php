
<h3 class="page-header">Quản lý khoa</h3>

<div class="row">
    <div class="col-md-8">
        <form method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thêm mới khoa
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
                        <label for="">Mã khoa *</label>
                        <input value="<?php echo set_value('code'); ?>" type="text" name="code" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('code'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Tên khoa *</label>
                        <input value="<?php echo set_value('name'); ?>" type="text" name="name" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('name'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                            <a href="/admin/departments" class="btn btn-default">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
