<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mod_list_string = $this->template->template_data['mod_list_string']->language;
	$aOrgList = $this->template->template_data['task_list'];
$view = '';
$view .= '<div class="box box-default">
              <div class="box-header with-border">';
$view .= '<h4><b>Tasks</b></h4>';
$view .= '</div>';
$view .= '<div class="box-body">';

$view .= form_open('index.php/home/submitOrganization');
if (!empty($this->template->template_data['org_id'])) {
	$view .= '<div class="form-group row">
                        <label for="org_name" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['org_name'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="org_name" name="org_name" type="text" class="form-control" value="' . $aOrgList['name'] . '">
                <input id="prod_id" name="prod_id" type="hidden" value="' . $aOrgList['id'] . '">
            </div>';

	$view .= '<label for="phone_office" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['contact_number'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="phone_office" name="phone_office" type="number" class="form-control" value="' . $aOrgList['phone_mobile'] . '">
            </div>';

	$view .= '</div>';

	$view .= '<div class="form-group row">
            <label for="billing_address_street" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_street'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_street" name="billing_address_street" type="text" class="form-control" value="' . $aOrgList['address'] . '">
            </div>';

	$view .= '<label for="billing_address_city" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['billing_address_city'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="billing_address_city" name="billing_address_city" type="text" class="form-control" value="' . $aOrgList['city'] . '">
            </div>';

	$view .= '</div>';

	$view .= '<div class="form-group row">
            <label for="billing_address_state" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_state'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_state" name="billing_address_state" type="text" class="form-control" value="' . $aOrgList['state'] . '">
            </div>';

	$view .= '<label for="billing_address_postalcode" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['billing_address_postalcode'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="billing_address_postalcode" name="billing_address_postalcode" type="number" class="form-control" value="' . $aOrgList['postalcode'] . '">
            </div>';

	$view .= '</div>';
	$view .= '<div class="form-group row">
            <label for="billing_address_country" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_country'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_country" name="billing_address_country" type="text" class="form-control" value="' . $aOrgList['country'] . '">
            </div>';

	$view .= '<label for="email" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['email'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="email" name="email" type="email" class="form-control" value="' . $aOrgList['email'] . '">
            </div>';
	$view .= '</div>';
	$view .= '<div class="form-group row">
            <label for="is_data_api_active" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$checked = ($aOrgList['is_data_api_active']) ? 'checked' : '';
	$view .= $mod_list_string['is_data_api_active'] . '</label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input id="is_data_api_active" name="is_data_api_active" type="checkbox" class="form-check-input" ' . $checked . '>
                <input id="authorization_code" name="authorization_code" type="hidden" value="' . $aOrgList['authorization_code'] . '">
                <input id="database_key" name="database_key" type="hidden" value="' . $aOrgList['database_key'] . '">
            </div>';
	$view .= '</div>';

	$view .= '<div>
            <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Update</button>
                <button  type="button" onclick="location.href=\'../index\';"  class="btn btn-space btn-secondary">Cancel</button>
            </p>
        </div>';

} else {
	$view .= '<div class="form-group row">
                        <label for="org_name" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['org_name'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="org_name" name="org_name" type="text" class="form-control" value="">
            </div>';

	$view .= '<label for="phone_office" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['contact_number'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="phone_office" name="phone_office" type="number" class="form-control" value="">
            </div>';

	$view .= '</div>';

	$view .= '<div class="form-group row">
            <label for="billing_address_street" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_street'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_street" name="billing_address_street" type="text" class="form-control" value="">
            </div>';

	$view .= '<label for="billing_address_city" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['billing_address_city'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="billing_address_city" name="billing_address_city" type="text" class="form-control" value="">
            </div>';

	$view .= '</div>';

	$view .= '<div class="form-group row">
            <label for="billing_address_state" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_state'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_state" name="billing_address_state" type="text" class="form-control" value="">
            </div>';

	$view .= '<label for="billing_address_postalcode" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['billing_address_postalcode'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="billing_address_postalcode" name="billing_address_postalcode" type="number" class="form-control" value="">
            </div>';

	$view .= '</div>';
	$view .= '<div class="form-group row">
            <label for="billing_address_country" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['billing_address_country'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="billing_address_country" name="billing_address_country" type="text" class="form-control" value="">
            </div>';

	$view .= '<label for="email" class="col-12 col-sm-2 col-form-label text-sm-right">' . $mod_list_string['email'] . '<font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
               <input required id="email" name="email" type="email" class="form-control" value="">
            </div>';
	$view .= '</div>';
	$view .= '<div class="form-group row">
            <label for="is_data_api_active" class="col-12 col-sm-2 col-form-label text-sm-right">';
	$view .= $mod_list_string['is_data_api_active'] . '</label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input id="is_data_api_active" name="is_data_api_active" type="checkbox"  class="form-check-input" >
                <input id="authorization_code" name="authorization_code" type="hidden" value="">
                <input id="database_key" name="database_key" type="hidden" value="">
            </div>';
	$view .= '</div>';
	$view .= '<div>
            <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                <button  type="button" onclick="location.href=\'index\';"  class="btn btn-space btn-secondary">Cancel</button>
            </p>
        </div>';

}

$view .= form_close();
$view .= '</div>
</div>';

echo $view;