<?php
//Added By Kinjal Shah
//For Breadcrumb generation
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('sendMail')) {
	function sendMail($subject, $body, $toAddress, $ccAddress = '') {
		$email_config = [];
		$CI = &get_instance();
		$CI->load->helper('cstmsystem_helper');
		$CI->load->library('email');
		$email_config['smtp_crypto'] = 'tls';
		$email_config['smtp_host'] = 'smtp.gmail.com';
		$email_config['smtp_user'] = 'test@user.com';
		$email_config['smtp_pass'] = 'test';
		$email_config['smtp_port'] = 25;
		$email_config['charset'] = 'iso-8859-1';
		$email_config['mailtype'] = 'html';
		$email_config['protocol'] = 'smtp';
		$email_config['smtp_timeout'] = '5';
		//$CI->load->model('Config_model', 'cstmconfig');
		$email_config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
		$email_config['wordwrap'] = TRUE;
		$email_config['validate'] = FALSE;
		$CI->email->initialize($email_config);
		$CI->email->set_newline("\r\n");
		$CI->email->from($email_config['smtp_user']);
		$CI->email->to($toAddress);
		if (!empty($ccAddress)) {
			$CI->email->cc($ccAddress);
		}
		$CI->email->subject($subject);
		$CI->email->message($body);
		if ($CI->email->send()) {
			/*$aEmailData = array(
				'id' => create_guid(),
				'from_addr' => $email_config['smtp_user'],
				'reply_to_addr' => '',
				'to_addrs' => $toAddress,
				'cc_addrs' => '',
				'bcc_addrs' => '',
				'date_entered' => date("Y-m-d H:i:s"),
				'date_modified' => date("Y-m-d H:i:s"),
				'deleted' => 0,
				'subject' => $subject,
				'description' => $body,
			);*/
			//$CI->cstmconfig->createEmailDirectory($aEmailData);
			return true;
		} else {
			return $CI->email->print_debugger();
		}
	}
}
