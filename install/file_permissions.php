<?php
$error = false;
if (!is_writable('../assets/dist/img')) {
	$error = true;
	$logofile = "<span class='label label-danger'>No (Make assets/dist/img writable) - Permissions 0755</span>";
} else {
	$logofile = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../application/config')) {
	$error = true;
	$requirement14 = "<span class='label label-danger'>No (Make application/config/ writable - Permissions 0755</span>";
} else {
	$requirement14 = "<span class='label label-success'>Ok</span>";
}
if ($this->service_id == 'dataapi_service') {
	if (!is_writable('../DataImport')) {
		$error = true;
		$requirement11 = "<span class='label label-danger'>No (Make DataImport writable - Permissions 0755</span>";
	} else {
		$requirement11 = "<span class='label label-success'>Ok</span>";
	}

	if (!is_writable('../Dataapi_Backup')) {
		$error = true;
		$requirement12 = "<span class='label label-danger'>No (Make Dataapi_Backup writable - Permissions 0755</span>";
	} else {
		$requirement12 = "<span class='label label-success'>Ok</span>";
	}
}
if ($this->service_id == 'registry_service') {
	if (!is_writable('../upload')) {
		$error = true;
		$requirement12 = "<span class='label label-danger'>No (Make upload/ writable - Permissions 0755</span>";
	} else {
		$requirement12 = "<span class='label label-success'>Ok</span>";
	}
}
if ($this->service_id == 'platform_service') {
	if (!is_writable('../DataImport')) {
		$error = true;
		$requirement11 = "<span class='label label-danger'>No (Make DataImport writable - Permissions 0755</span>";
	} else {
		$requirement11 = "<span class='label label-success'>Ok</span>";
	}

	if (!is_writable('../LayoutMetadata')) {
		$error = true;
		$requirement12 = "<span class='label label-danger'>No (Make LayoutMetadata writable - Permissions 0755</span>";
	} else {
		$requirement12 = "<span class='label label-success'>Ok</span>";
	}
	if (!is_writable('../metadata')) {
		$error = true;
		$requirement13 = "<span class='label label-danger'>No (Make metadata writable - Permissions 0755</span>";
	} else {
		$requirement13 = "<span class='label label-success'>Ok</span>";
	}
	if (!is_writable('../application/language/english')) {
		$error = true;
		$requirement14 = "<span class='label label-danger'>No (Make application/language/english writable - Permissions 0755</span>";
	} else {
		$requirement14 = "<span class='label label-success'>Ok</span>";
	}
	if (!is_writable('../upload')) {
		$error = true;
		$requirement15 = "<span class='label label-danger'>No (Make upload writable - Permissions 0755</span>";
	} else {
		$requirement15 = "<span class='label label-success'>Ok</span>";
	}

}

?>
<table class="table table-hover">
    <thead>
        <tr>
            <th><b>File/Folder</b></th>
            <th><b>Result</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>assets/dist/img Writable</td>
            <td><?php echo $logofile; ?></td>
        </tr>
        <tr>
            <td>application/config Writable</td>
            <td><?php echo $requirement14; ?></td>
        </tr>
        <?php
if ($this->service_id == 'dataapi_service') {
	?>
        <tr>
            <td>DataImport Writable</td>
            <td><?php echo $requirement11; ?></td>
        </tr>
        <tr>
            <td>Dataapi_Backup Writable</td>
            <td><?php echo $requirement12; ?></td>
        </tr>
    <?php }?>
           <?php
if ($this->service_id == 'registry_service') {
	?>
    <tr>
            <td>upload Writable</td>
            <td><?php echo $requirement12; ?></td>
        </tr>
     <?php }?>
          <?php
if ($this->service_id == 'platform_service') {
	?>
        <tr>
            <td>DataImport Writable</td>
            <td><?php echo $requirement11; ?></td>
        </tr>
        <tr>
            <td>LayoutMetadata Writable</td>
            <td><?php echo $requirement12; ?></td>
        </tr>
        <tr>
            <td>metadata Writable</td>
            <td><?php echo $requirement13; ?></td>
        </tr>
        <tr>
            <td>application/language/english Writable</td>
            <td><?php echo $requirement14; ?></td>
        </tr>
        <tr>
            <td>upload Writable</td>
            <td><?php echo $requirement15; ?></td>
        </tr>
    <?php }?>

    </tbody>
</table>
<hr />
<?php if ($error == true) {
	echo '<div class="text-center alert alert-danger">You need to fix the requirements in order to install ' . $this->service_name . ' Service</div>';
} else {
	echo '<div class="text-center">';
	echo '<form action="" method="post" accept-charset="utf-8">';
	echo '<input type="hidden" name="permissions_success" value="true">';
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

	}
	echo '<div class="text-left">';
	echo '<button type="submit" class="btn btn-success">Setup Database</button>';
	echo '</div>';
	echo '</form>';
	echo '</div>';
}
