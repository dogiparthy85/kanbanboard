<?php

$menuJson = file_get_contents(APPPATH . 'config/cstmconfigMenuJson.json');
$menuJson = json_decode($menuJson, true);
$currentURL = current_url();
$aURL = explode("home/", $currentURL);
$append = '';
if (sizeof($aURL) > 1) {
	$aURLSize = explode("/", $aURL[1]);
	$arraysize = sizeof($aURLSize);
	if ($arraysize > 1) {
		for ($i = 1; $i < $arraysize; $i++) {
			$append .= '../';
		}
	}
} elseif (sizeof($aURL) == 1) {
	$aTemp = explode(base_url(), $aURL[0]);
	if ($aTemp[1] == 'home') {
		$append .= '';
	} else {
		$append .= 'index.php/home/';
	}
} else {
	$append .= 'index.php/home/';
}
$logoutLink = $append . 'logout';
$userLink = '';
//$userLink = $append . 'ServiceDetailView/staff_service/users/' . $this->session->userdata('user_id');
?>

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <!-- <span class="logo-mini"><b><?php //echo $this->config->item('system_name'); ?></b></span>-->
     <?php
$logopath = base_url() . 'assets/dist/img/SystemLogo.png';
$logoFile = APPPATH . '../assets/dist/img/SystemLogo.png';
if (!file_exists($logoFile)) {
	?>
  <span class="logo-mini"><b><?php echo $this->config->item('system_name'); ?>Kanban Board</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $this->config->item('system_name'); ?>Kanban Board</b></span>

  <?php
} else {
	?>
    <span class="logo-mini"><b><img src="<?php echo $logopath; ?>">Kanban Board</b></span>
      <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><img src="<?php echo $logopath; ?>">Kanban Board</b></span>
  <?php }?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata['name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                 <?php echo $this->session->userdata['name']; ?>
                  <!--<small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $userLink; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $logoutLink; ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
