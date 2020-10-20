<?php

$menuJson = file_get_contents(APPPATH . 'config/cstmconfigMenuJson.json');
$menuJson = json_decode($menuJson, true);
$view = '';
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
function checkLinkforUser($link, $org_id, $onlyAdminService) {
	if ($org_id != '1') {
		foreach ($onlyAdminService as $service) {

			if (preg_match("/{$service}/", $link)) {
				return false;
			}
		}
	}
	return true;
}
if (!empty($menuJson)) {
	foreach ($menuJson as $mainmenu) {
		$view .= ' <ul class="sidebar-menu" data-widget="tree"> ';
		if (!empty($mainmenu['children'])) {
			$view .= '<li class="treeview">';
		} else {
			$view .= '<li>';
		}
		$view .= '<a href="' . $append . $mainmenu['href'] . '"  target="' . $mainmenu['target'] . '" >';
		$view .= ' <i class="' . $mainmenu['icon'] . '"></i><span>' . $mainmenu['text'] . '</span>';
		if (!empty($mainmenu['children'])) {
			$view .= '<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>';
			$view .= '</a>';
			$view .= createChildMenu($mainmenu['children'], $append);
		} else {
			$view .= '</a>';
		}
		$view .= '</li>';
		$view .= '</ul>';
	}
}
function createChildMenu($submenu, $append) {
	$view = '<ul class="treeview-menu">';
	foreach ($submenu as $menuTitle) {
		$view .= '<li';
		if (!empty($menuTitle['children'])) {
			$view .= ' class="treeview" ><a href="' . $append . $menuTitle['href'] . '" target="' . $menuTitle['target'] . '"><i class="' . $menuTitle['icon'] . '"></i> ' . $menuTitle['text'];
		} else {
			$view .= '><a href="' . $append . $menuTitle['href'] . '" target="' . $menuTitle['target'] . '"><i class="' . $menuTitle['icon'] . '"></i> ' . $menuTitle['text'];
		}
		if (!empty($menuTitle['children'])) {
			$view .= '<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>';
			$view .= createChildMenu($menuTitle['children'], $append);
		} else {
			$view .= '</a>';
		}
		$view .= '</li>';
	}
	$view .= '</ul>';
	return $view;
}
?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- search form -->
     <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
     <?php echo $view; ?>
    </section>
    <!-- /.sidebar -->
  </aside>
