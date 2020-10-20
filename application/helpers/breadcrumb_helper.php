<?php
//Added By Kinjal Shah
//For Breadcrumb generation
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getBreadcrumb')) {
	function getBreadcrumb($aBreadcumbs = array()) {
		$CI = &get_instance();
		$CI->load->helper('url');

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
		if (empty($aBreadcumbs)) {
			$aBreadcrumb[$append . 'index.php'] = 'Home';
		}
		foreach ($aBreadcumbs as $link => $value) {
			if ($value == 'home') {
				$aBreadcrumb[$append . "index.php"] = $value;
			} elseif ($link == '#') {
				$aBreadcrumb[$append . $aURL[1]] = $value;
			} else {
				$aBreadcrumb[$append . $link] = $value;
			}
		}
		return $aBreadcrumb;
	}
}

if (!function_exists('pageHeaderTitle')) {
	function pageHeaderTitle($title = 'Home') {
		return $title;
	}
}
