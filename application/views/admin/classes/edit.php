
<h3 class="page-header">Quản lý lớp</h3>

<div class="row">
    <div class="col-md-8">
        <form method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chỉnh sửa lớp
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
                        <label for="">Mã lớp *</label>
                        <input value="<?php echo set_value('code', $class['code']); ?>" type="text" name="code" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('code'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Tên lớp *</label>
                        <input value="<?php echo set_value('name', $class['name']); ?>" type="text" name="name" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('name'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Khoa *</label>
                        <select name="department_id" class="form-control input-sm">
                            <?php foreach ($departments as $d): ?>
                                <?php $selected = $d['id'] == $this->input->post('department_id') || $d['id'] == $class['department_id'] ? 'selected' : ''; ?>
                                <option value="<?php echo $d['id']; ?>" <?php echo $selected; ?>><?php echo $d['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('department_id'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Niên khóa *</label>
                        <select name="school_year_id" class="form-control input-sm">
                            <?php foreach ($school_years as $sy): ?>
                                <?php $selected = $sy['id'] == $this->input->post('school_year_id') || $sy['id'] == $class['school_year_id'] ? 'selected' : ''; ?>
                                <option value="<?php echo $sy['id']; ?>" <?php echo $selected; ?>><?php echo $sy['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('school_year_id'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                            <a href="/admin/classes" class="btn btn-default">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
