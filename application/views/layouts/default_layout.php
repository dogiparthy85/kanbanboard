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
  <!-- jQuery 3 -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script  src="<?php echo base_url(); ?>assets/dist/js/jquery-menu-editor.js"></script>
  <script  src="<?php echo base_url(); ?>assets/dist/js/bootstrap-iconpicker.min.js"></script>


   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jqwidgets/jqxsortable.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jqwidgets/jqxkanban.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jqwidgets/jqxdata.js"></script>


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/iconset/fontawesome5-3-1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
   <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/skin-blue-light.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/briskcstm.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrap-iconpicker.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper skin-blue-light">

 <?php require_once 'header_layout.php';?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php require_once 'sidebar_layout.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->template->template_data['title']; ?>
      </h1>
      <ol class="breadcrumb">
         <?php require_once 'breadcrumb_layout.php';?>
      </ol>
    </section>
    <section class="content">
    <!-- Main content -->
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
echo $contents;?>
</section>
    <!-- /.content -->
  </div>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
   $( document ).ready(function(){
        $('.alert').fadeIn('slow', function(){
           $('.alert').delay(5000).fadeOut();
        });
    });

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

</body>
</html>
