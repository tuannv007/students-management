
<h3 class="page-header">Quản lý niên khóa</h3>

<div class="row">
    <div class="col-md-8">
        <form method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thêm mới niên khóa
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
                        <label for="">Ký hiệu *</label>
                        <input value="<?php echo set_value('name', $school_year['name']); ?>" type="text" name="name" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('name'); ?>
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Tên niên khóa *</label>
                        <input value="<?php echo set_value('label', $school_year['label']); ?>" type="text" name="label" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('label'); ?>
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Năm bắt đầu *</label>
                        <input value="<?php echo set_value('start_year', $school_year['start_year']); ?>" type="text" name="start_year" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('start_year'); ?>
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Năm kết thúc *</label>
                        <input value="<?php echo set_value('end_year', $school_year['end_year']); ?>" type="text" name="end_year" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('end_year'); ?>
                            </span>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                            <a href="/admin/school-years" class="btn btn-default">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
