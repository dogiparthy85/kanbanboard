<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title><?php echo $this->service_name; ?> Service - Installation</title>
      <link href="../assets/css/reset.css" rel="stylesheet">
      <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href='../assets/css/bs-overides.css' rel='stylesheet' type='text/css'>
      <link href='../assets/plugins/bootstrap-select/css/bootstrap-select.min.css' rel='stylesheet' type='text/css'>
      <style>
         body {
         font-family:'Open Sans';
         background:#f1f1f1;
         }
         h3 {
         margin-top: 7px;
         font-size: 18px;
         }
         .install-row {
         border:1px solid #e4e5e7;
         border-radius:3px;
         background:#fff;
         padding:15px;
         box-shadow: 0px 2px 4px #d6d6d6;
         display:inline-block;
         width:100%;
         }
         .install-row.install-steps {
         margin-bottom:15px;
         box-shadow: 0px 0px 1px #d6d6d6;
         }
         .logo {
         margin-top:15px;
         margin-bottom:10px;
         padding:15px;
         display:inline-block;
         width:100%;
         }
         .logo img {
         display:block;
         margin:0 auto;
         }
         .control-label {
         font-size:13px;
         font-weight:600;
         }
         .padding-10 {
         padding:10px;
         }
         .mbot15 {
         margin-bottom:15px;
         }
         .bg-default {
         background: #03a9f4;
         border:1px solid #03a9f4;
         color:#fff;
         }
         .bg-success {
         border: 1px solid #dff0d8;
         }
         .bg-not-passed {
         border:1px solid #f1f1f1;
         border-radius:2px;
         }
         .bg-not-passed {
         border-right:0px;
         }
         .bg-not-passed.finish {
         border-right:1px solid #f1f1f1 !important;
         }
         .bg-not-passed h5 {
         font-weight:normal;
         color:#6b6b6b;
         }
         .form-control {
         box-shadow:none;
         }
         .bold {
         font-weight:600;
         }
         .col-xs-5ths,
         .col-sm-5ths,
         .col-md-5ths,
         .col-lg-5ths {
         position: relative;
         min-height: 1px;
         padding-right: 15px;
         padding-left: 15px;
         }
         .col-xs-5ths {
         width: 20%;
         float: left;
         }
         b {
         font-weight:600;
         }
         .bootstrap-select .btn-default {
         background: #fff !important;
         border: 1px solid #d6d6d6 !important;
         box-shadow: none;
         color: #494949 !important;
         padding: 6px 12px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-md-offset-2">
               <div class="install-row install-steps">
                  <div class="col-xs-5ths text-center <?php if ($passed_steps[1] == true || $step == 1) {echo 'bg-default';}?> padding-10">
                     <h5>Requirements</h5>
                  </div>
                  <div class="col-xs-5ths text-center <?php if ($passed_steps[2] || $step == 2) {echo 'bg-default';} else {echo 'bg-not-passed';}?> padding-10">
                     <h5>Permissions</h5>
                  </div>
                  <div class="col-xs-5ths text-center <?php if ($passed_steps[3] || $step == 3) {echo 'bg-default';} else {echo 'bg-not-passed';}?> padding-10">
                     <h5> Database setup</h5>
                  </div>
                  <div class="col-xs-5ths text-center <?php if ($passed_steps[4] || $step == 4) {echo 'bg-default';} else {echo 'bg-not-passed';}?> padding-10">
                     <h5> Install</h5>
                  </div>
                  <div class="finish col-xs-5ths text-center <?php if ($step == 5) {echo 'bg-success';} else {echo 'bg-not-passed';}?> padding-10">
                     <h5> Finish</h5>
                  </div>
               </div>
               <div class="install-row">
                  <?php if ($debug != '') {?>
                  <p class="sql-debug-alert text-success" style="margin-bottom:20px;">
                     <b><?php echo $debug; ?></b>
                  </p>
                  <?php }?>
                  <?php if (isset($error) && $error != '') {?>
                  <div class="alert alert-danger text-center">
                     <?php echo $error; ?>
                  </div>
                  <?php }?>
                  <?php if ($step == 1) {
	include_once 'requirements.php';
} else if ($step == 2) {
	include_once 'file_permissions.php';
} else if ($step == 3) {
	?>
                  <?php echo '<form action="" method="post" accept-charset="utf-8">'; ?>
                  <?php echo '<input type="hidden" name="step" value="' . $step . '">'; ?>
                  <?php
switch ($this->service_id) {
	case 'rbac_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'dashboard_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'dataapi_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		break;
	case 'department_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'division_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'organization_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'registry_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		echo '<input type="hidden" name="access_url" value="' . $_POST['access_url'] . '">';
		break;
	case 'advancereport_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		break;
	case 'skill_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'questionbank_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'platform_service':
		echo '<input type="hidden" name="reg_url" value="' . $_POST['reg_url'] . '">';
		break;

	}?>


                  <div class="form-group">
                     <label for="hostname" class="control-label">Hostname</label>
                     <input type="text" class="form-control" name="hostname" value="localhost">
                  </div>
                  <div class="form-group">
                     <label for="username" class="control-label">Username</label>
                     <input type="text" class="form-control" name="username">
                  </div>
                  <div class="form-group">
                     <label for="password" class="control-label"><i class="glyphicon glyphicon-info-sign" title='Avoid use of single(&lsquo;) and double(&ldquo;) quotes in your password'></i> Password</label>
                     <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                     <label for="database" class="control-label">Database</label>
                     <input type="text" class="form-control" name="database">
                  </div>
                  <hr />
                  <div class="text-left">
                     <button type="submit" class="btn btn-success">Check Database</button>
                  </div>
                  </form>
                  <?php } else if ($step == 4) {
	?>
                  <?php echo '<form action="" method="post" accept-charset="utf-8" id="installForm">'; ?>
                  <?php echo '<input type="hidden" name="step" value="' . $step . '">'; ?>
                  <?php echo '<input type="hidden" name="hostname" value="' . $_POST['hostname'] . '">'; ?>
                  <?php echo '<input type="hidden" name="username" value="' . $_POST['username'] . '">'; ?>
                  <?php echo '<input type="hidden" name="password" value="' . $_POST['password'] . '">'; ?>
                  <?php echo '<input type="hidden" name="database" value="' . $_POST['database'] . '">'; ?>
                  <?php switch ($this->service_id) {
	case 'rbac_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'dashboard_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'dataapi_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		break;
	case 'department_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'division_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'organization_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'registry_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		echo '<input type="hidden" name="access_url" value="' . $_POST['access_url'] . '">';
		break;
	case 'advancereport_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		echo '<input type="hidden" name="org_url" value="' . $_POST['org_url'] . '">';
		break;
	case 'skill_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'questionbank_service':
		echo '<input type="hidden" name="staff_url" value="' . $_POST['staff_url'] . '">';
		break;
	case 'platform_service':
		echo '<input type="hidden" name="reg_url" value="' . $_POST['reg_url'] . '">';
		break;

	}?>
                  <div class="form-group">
                     <div class="form-group">
                        <label for="base_url" class="control-label">Base URL </label>
                        <input type="url" class="form-control" value="<?php echo $this->guess_base_url(); ?>" name="base_url" id="base_url" required>
                     </div>
                  </div>
                  <hr />
                  <div class="text-left">
                     <button type="submit" class="btn btn-success" id="installBtn">Install</button>
                  </div>
                  </form>
                  <?php } else if ($step == 5) {
	?>
                  <h4 class="bold">Installation successful!</h4>
                  <?php if (isset($rename_failed)) {?>
                  <p class="text-danger">
                     Failed to rename application/config/app-config-sample.php to app-config.php. Please navigate to application/config/ and rename the file app-config-sample.php to app-config.php
                  </p>
                  <?php }
	?>
                  <p>Login at <a href="<?php echo $_POST['base_url']; ?>" target="_blank"><?php echo $_POST['base_url']; ?></a></p>
                  <hr />
                  <h4>
                     <b>Getting Started Guide - <a href="" target="_blank">Read more</a></b>
                  </h4>
                  <hr />
                  <h4>
                     <b>Looking For Help? - <a href="" target="_blank">Open Support Ticket</a></b>
                  </h4>
                  <?php }?>
               </div>
            </div>
         </div>
      </div>
      <script src='../assets/plugins/jquery/jquery.min.js'></script>
      <script src='../assets/plugins/bootstrap/js/bootstrap.min.js'></script>
      <script src='../assets/plugins/bootstrap-select/js/bootstrap-select.min.js'></script>
      <script>
         $(function(){
           $('select').selectpicker();
           $('#installForm').on('submit',function(e){
               $('#installBtn').prop('disabled',true);
               $('#installBtn').text('Please wait...');
           });
           setTimeout(function(){
             $('.sql-debug-alert').slideUp();
           },4000);
         });
      </script>
   </body>
</html>
