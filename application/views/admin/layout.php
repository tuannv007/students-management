<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <link href="<?php echo base_url('assets/admin/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin/vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin/dist/css/sb-admin-2.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        window.CI = {
            baseUrl: '<?php echo base_url(); ?>'
        };
    </script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <?php $this->load->view('admin/sections/top'); ?>

            <?php $this->load->view('admin/sections/sidebar'); ?>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            $subview = isset($subview) ? $subview : 'admin/dashboard/index';
                            $this->load->view($subview);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/admin/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/vendor/metisMenu/metisMenu.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/dist/js/sb-admin-2.js'); ?>"></script>

    <?php if (isset($scripts) && is_array($scripts)): ?>
        <?php foreach ($scripts as $src): ?>
            <script src="<?php echo base_url($src); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($php_scripts) && is_array($php_scripts)): ?>
        <?php foreach ($php_scripts as $view_script): ?>
            <?php $this->load->view($view_script); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
