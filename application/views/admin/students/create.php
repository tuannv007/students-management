
<h3 class="page-header">Quản lý đoàn viên</h3>

<div class="row">
    <div class="col-md-8">
        <form method="post" id="studentsForm">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thêm mới đoàn viên
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
                        <label for="">Khoa *</label>
                        <select name="department_id" class="form-control input-sm">
                            <?php foreach ($departments as $d): ?>
                                <?php $selected = $d['id'] == $this->input->post('department_id') || $d['id'] == $department_id ? 'selected' : ''; ?>
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
                                <?php $selected = $sy['id'] == $this->input->post('school_year_id') || $sy['id'] == $school_year_id ? 'selected' : ''; ?>
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
                        <label for="">Lớp *</label>
                        <select name="class_id" class="form-control input-sm">
                            <?php foreach ($classes as $class): ?>
                                <?php $selected = $class['id'] == $this->input->post('class_id') ? 'selected' : ''; ?>
                                <option value="<?php echo $class['id']; ?>" <?php echo $selected; ?>><?php echo $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('class_id'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Mã đoàn viên *</label>
                        <input value="<?php echo set_value('code'); ?>" type="text" name="code" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('code'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Tên đoàn viên *</label>
                        <input value="<?php echo set_value('name'); ?>" type="text" name="name" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('name'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Ngày sinh *</label>
                        <input value="<?php echo set_value('birthday'); ?>" type="date" name="birthday" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('birthday'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Giới tính *</label>
                        <select name="gender" class="form-control">
                            <?php if ($this->input->post('gender')): ?>
                                <option value="1" selected>Nam</option>
                                <option value="0">Nữ</option>
                            <?php else: ?>
                                <option value="1">Nam</option>
                                <option value="0" selected>Nữ</option>
                            <?php endif; ?>
                        </select>
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('gender'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input value="<?php echo set_value('email'); ?>" type="text" name="email" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('email'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Điện thoại</label>
                        <input value="<?php echo set_value('phone'); ?>" type="text" name="phone" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('phone'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input value="<?php echo set_value('address'); ?>" type="text" name="address" class="form-control">
                        <span class="help-block">
                            <span class="text-danger">
                                <?php echo form_error('address'); ?>
                            </span>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <input type="submit" name="submit" class="btn btn-success" value="Xác nhận"/>
                            <a href="/admin/students" class="btn btn-default">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
