<?php
$service_list = array(
	'staff_service' => 'Staff',
	'rbac_service' => 'Role Management',
	'dashboard_service' => 'Dashboard',
	'dataapi_service' => 'Data API',
	'department_service' => 'Department',
	'division_service' => 'Division',
	'organization_service' => 'Organization',
	'registry_service' => 'Registry',
	'advancereport_service' => 'Report',
	'skill_service' => 'Skill',
	'questionbank_service' => 'Question Bank',
	'platform_service' => 'Platform Service',
);
if (file_exists('../application/config/app-config.php')) {
	echo '<p> ' . $service_list[$_REQUEST['service']] . ' Service : <font color="red">Installation Process Locked<font></p>';
	exit;
} else {
	require_once 'install.class.php';
	$install = new Install($service_list);
	$install->go();

}