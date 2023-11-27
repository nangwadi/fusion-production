<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	$config = array(
	    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
	    'smtp_host' => 'outlook.office365.com', 
	    'smtp_port' => 587,
	    'smtp_user' => 'no-reply@meiwa-m.co.id',
	    'smtp_pass' => '@dM1n08*#',
	    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
	    'mailtype' => 'html', //plaintext 'text' mails or 'html'
	    'smtp_timeout' => '15', //in seconds
	    //'charset' => 'iso-8859-1',
	    'charset' => 'utf-8',
	    'wordwrap' => TRUE
	);