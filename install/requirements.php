<?php

$error = false;

if (version_compare(PHP_VERSION, '5.6.4') >= 0) {
	$requirement1 = "<span class='label label-success'>v." . PHP_VERSION . '</span>';
} else {
	$error = true;
	$requirement1 = "<span class='label label-danger'>Your PHP version is " . PHP_VERSION . '</span>';
}

if (!extension_loaded('mysqli')) {
	$error = true;
	$requirement2 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement2 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('pdo')) {
	$error = true;
	$requirement3 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement3 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('curl')) {
	$error = true;
	$requirement4 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement4 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('openssl')) {
	$error = true;
	$requirement5 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement5 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('mbstring')) {
	$error = true;
	$requirement6 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement6 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('iconv') && !function_exists('iconv')) {
	$error = true;
	$requirement7 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement7 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('imap')) {
	$error = true;
	$requirement8 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement8 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('gd')) {
	$error = true;
	$requirement9 = "<span class='label label-danger'>Not enabled</span>";
} else {
	$requirement9 = "<span class='label label-success'>Enabled</span>";
}

if (!extension_loaded('zip')) {
	$error = true;
	$requirement10 = "<span class='label label-danger'>Zip Extension is not enabled</span>";
} else {
	$requirement10 = "<span class='label label-success'>Enabled</span>";
}

$url_f_open = ini_get('allow_url_fopen');
if ($url_f_open != '1'
	&& strcasecmp($url_f_open, 'On') != 0
	&& strcasecmp($url_f_open, 'true') != 0
	&& strcasecmp($url_f_open, 'yes') != 0) {
	$error = true;
	$requirement11 = "<span class='label label-danger'>Allow_url_fopen is not enabled!</span>";
} else {
	$requirement11 = "<span class='label label-success'>Enabled</span>";
}

?>
<table class="table table-hover">
	<thead>
		<tr>
			<th><b>Extensions</b></th>
			<th><b>Result</b></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>PHP >= 5.6.4 (PHP >= 7.3 recommended)</td>
			<td><?php echo $requirement1; ?></td>
		</tr>
		<tr>
			<td>MySQLi PHP Extension</td>
			<td><?php echo $requirement2; ?></td>
		</tr>
		<tr>
			<td>PDO PHP Extension</td>
			<td><?php echo $requirement3; ?></td>
		</tr>
		<tr>
			<td>cURL PHP Extension</td>
			<td><?php echo $requirement4; ?></td>
		</tr>
		<tr>
			<td>OpenSSL PHP Extension</td>
			<td><?php echo $requirement5; ?></td>
		</tr>
		<tr>
			<td>MBString PHP Extension</td>
			<td><?php echo $requirement6; ?></td>
		</tr>
		<tr>
			<td>iconv PHP Extension</td>
			<td><?php echo $requirement7; ?></td>
		</tr>
		<tr>
			<td>IMAP PHP Extension</td>
			<td><?php echo $requirement8; ?></td>
		</tr>
		<tr>
			<td>GD PHP Extension</td>
			<td><?php echo $requirement9; ?></td>
		</tr>
		<tr>
			<td>Zip PHP Extension</td>
			<td><?php echo $requirement10; ?></td>
		</tr>
		<tr>
			<td>allow_url_fopen</td>
			<td><?php echo $requirement11; ?></td>
		</tr>
	</tbody>
</table>
<hr />
<?php if ($error == true) {
	echo '<div class="text-center alert alert-danger">You need to fix the requirements in order to continue installing ' . $this->service_name . ' Service</div>';
} else {
	switch ($this->service_id) {
	case 'rbac_service':
		$addstaffflag = true;
		break;
	case 'dashboard_service':
		$addstaffflag = true;
		break;
	case 'dataapi_service':
		$addstaffflag = true;
		$addorgflag = true;
		break;
	case 'department_service':
		$addstaffflag = true;
		break;
	case 'division_service':
		$addstaffflag = true;
		break;
	case 'organization_service':
		$addstaffflag = true;
		break;
	case 'registry_service':
		$addstaffflag = true;
		$addorgflag = true;
		$addaccessflag = true;
		break;
	case 'advancereport_service':
		$addstaffflag = true;
		$addorgflag = true;
		break;
	case 'skill_service':
		$addstaffflag = true;
		break;
	case 'questionbank_service':
		$addstaffflag = true;
		break;
	case 'platform_service':
		$addregflag = true;
		break;
	}
	echo '<div class="text-center">';
	echo '<form action="" method="post" id="kishah" accept-charset="utf-8">';
	if ($addstaffflag) {
		echo '<div class="form-group">
                <div class="form-group">
                <label for="staff_url" class="control-label">Staff Service URL </label>
                <input type="url" class="form-control" value="" name="staff_url" id="staff_url" required>
            </div>
         </div>';
	}
	if ($addorgflag) {

		echo '<div class="form-group">
                <div class="form-group">
                <label for="org_url" class="control-label">Organization Service URL </label>
                <input type="url" class="form-control" value="" name="org_url" id="org_url" required>
            </div>
         </div>';
	}
	if ($addaccessflag) {
		echo '<div class="form-group">
                <div class="form-group">
                <label for="access_url" class="control-label">Role Management Service URL </label>
                <input type="url" class="form-control" value="" name="access_url" id="access_url" required>
            </div>
         </div>';
	}
	if ($addregflag) {
		echo '<div class="form-group">
                <div class="form-group">
                <label for="reg_url" class="control-label">Registry Service URL </label>
                <input type="url" class="form-control" value="" name="reg_url" id="reg_url" required>
            </div>
         </div>';
	}
	echo '<input type="hidden" value="true" name="requirements_success">';
	echo '<div class="text-left">';
	echo '<button type="submit" class="btn btn-success">Go to files/folders permissions</button>';
	echo '</div>';
	echo '</form>';
	echo '</div>';
}