<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['email']['mailtype'] = 'html';
$config['email']['charset'] = 'utf-8';
$config['email']['newline'] = "\r\n";
// $config['email']['protocol'] = "smtp";
// $config['email']['smtp_host'] = "ssl://smtp.googlemail.com";
// $config['email']['smtp_port'] = 465;
// $config['email']['smtp_user'] = 'vokhoanam@gmail.com';
// $config['email']['smtp_pass'] = "Vfu9B3260591";
//$config['email']['smtp_pass'] = "w3U4cZKuXvTx3Vq";

$config['system_email'] = 'website@healthyhomes.com.vn';
$config['display_name'] = 'Healthyhomes VN';
//$config['to'] = array('hoangphuc.ag@gmail.com');
$config['to'] = array('ethan@healthyhomes.com.vn');
//$config['title'] = 'Reports Account';

/* End of file email.php */
/* Location: ./application/config/email.php */