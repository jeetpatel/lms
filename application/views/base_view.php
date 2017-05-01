<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php 
        echo isset($title) ? $title : $this->config->item('site_name'); ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <link rel="shortcut icon" href="<?php echo images_url('favicon.ico'); ?>">
        <link rel="stylesheet" href="<?php echo bower_url('bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo bower_url('font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo css_url('common.css'); ?>">
        <link rel="stylesheet" href="<?php echo css_url('admin/AdminLTE.min.css'); ?>">

        <?php if ($this->authentication->is_signed_in() && ($this->authorization->is_admin() || $this->authorization->is_staff())){ ?>
        <link rel="stylesheet" href="<?php echo css_url('admin/admin.css'); ?>">
        <link rel="stylesheet" href="<?php echo css_url('admin/skins/_all-skins.min.css'); ?>">
        <?php } ?>
        <?php echo $cdn_css; ?>
        <?php echo $thirdparty_css; ?>
        <?php echo $css; ?>
    </head>
    <body class="hold-transition skin-yellow sidebar-mini">
        <?php echo $body; ?>
        <script src="<?php echo bower_url('jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo bower_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo js_url('main.js'); ?>"></script>
        <script src="<?php echo js_url('jquery.cookie.js'); ?>"></script>
        <?php if ($this->authentication->is_signed_in() && ($this->authorization->is_admin() || $this->authorization->is_staff())){ ?>
        <script src="<?php echo bower_url('jQueryUI/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo js_url('admin/admin.js'); ?>"></script>
        <script src="<?php echo js_url('admin/app.js'); ?>"></script>
        <script src="<?php echo js_url('admin/demo.js'); ?>"></script>
        <?php } ?>
        <!-- Extra javascript -->
        <?php echo $cdn_js; ?>
        <?php echo $thirdparty_js; ?>
        <?php echo $js; ?>
        <script>
            <?php echo $appScript; ?>
        </script>
    </body>
    </html>