<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <link href="<?php echo base_url('public/assets/admin/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/admin/vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/admin/dist/css/sb-admin-2.css') ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/assets/admin/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input value="<?php echo set_value('account'); ?>" class="form-control" placeholder="E-mail" name="account" type="text" autofocus/>
                                    <span class="help-block">
                                        <small class="text-danger">
                                            <?php echo form_error('account'); ?>
                                            <?php echo isset($error) ? $error : ''; ?>
                                        </small>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value=""/>
                                    <span class="help-block">
                                        <small class="text-danger"><?php echo form_error('password'); ?></small>
                                    </span>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="1"/>
                                        Nhớ tài khoản
                                    </label>
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">
                                    Xác nhận
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('public/assets/admin/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/admin/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/admin/vendor/metisMenu/metisMenu.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/admin/dist/js/sb-admin-2.js'); ?>"></script>
</body>
</html>
