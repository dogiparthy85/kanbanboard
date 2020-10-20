<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('system_name'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <!--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">-->
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="login" style="">
    <?php
$logoFile = APPPATH . '../assets/dist/img/Login.png';
$logopath = base_url() . 'assets/dist/img/Login.png';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div><br><br></div>
                <!--
                <div id="login-logo">
                    <img src="<?php echo $logopath; ?>" width="100%;" height="100%" alt="RESONANT IT">
                </div>-->

                <div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="login-banner text-center">
                            <h1><i class="fa fa-gears"></i>&nbsp;&nbsp;<?php echo $this->config->item('system_name');?>&nbsp;&nbsp; </h1>
                            <h4><strong>&nbsp; __________________________________&nbsp;</strong></h4>
                        </div>

                        <div class="portlet-title">

                            <h4><strong>Login to &nbsp;<?php echo $this->config->item('system_name');?>!&nbsp;</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                        <?php

if (!empty($this->template->template_data['alert_message'])) {
	switch ($this->template->template_data['alert_type']) {
	case 'danger':
		$alert = '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        ' . $this->template->template_data['alert_message'] . '
      </div>';
		break;
	case 'info':
		$alert = ' <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        ' . $this->template->template_data['alert_message'] . '
      </div>';
		break;
	case 'warning':
		$alert = ' <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        ' . $this->template->template_data['alert_message'] . '
      </div>';
		break;
	case 'success':
		$alert = '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        ' . $this->template->template_data['alert_message'] . '
      </div>';
		break;
	}
	echo $alert;

}
?>


                        <?php echo $contents;?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.alert').fadeIn('slow', function() {
                $('.alert').delay(3000).fadeOut();
            });
        });

    </script>

</body>

</html>
