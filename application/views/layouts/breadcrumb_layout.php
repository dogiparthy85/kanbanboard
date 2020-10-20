<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aBreadcrumb = getBreadcrumb($this->template->template_data['breadcrumb']);
$view = '';
foreach ($aBreadcrumb as $link => $title) {
	$view .= '<li><a href="' . $link . '">' . $title . '</a></li>';
}

echo $view;
