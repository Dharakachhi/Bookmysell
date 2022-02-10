<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('sentMailSetup')) {
	function sentMailSetup($attechment = '', $sender_from, $password, $email, $subject, $message) {
		$att = explode('/', $attechment);
		$fn = $attechment; //'http://qbcloud.cefiro.ca/uploads/20167.pdf';
		$IMAPhost = 'mail.cefiro.ca';
		// IMAP port 143, 995 or POP3 port 110, 995
		$IMAPport = '143'; //143 , 993
		$IMAPssl = 'tls'; //tls , ssl
		$IMAP = '{mail.cefiro.ca:993/validate-cert/ssl}INBOX.Sent';
		$IMAPuser = $sender_from;

		// imap email and password
		$ibox = imap_open($IMAP, $sender_from, $password);
		$dmy = date("Y-m-d H:i:s");
		// pack file contents    ff
		$attachment = chunk_split(base64_encode(file_get_contents($fn)));

		$boundary1 = "###" . md5(microtime()) . "###";
		$boundary2 = "###" . md5(microtime() . rand(99, 999)) . "###";
		imap_append($ibox, $IMAP
			, "From:<" . $IMAPuser . ">\r\n"
			. "To: " . $email . "\r\n"
			. "Date: $dmy\r\n"
			. "Subject: " . quoted_printable_encode($subject) . "\r\n"
			. "MIME-Version: 1.0\r\n"
			. "Content-Type: multipart/mixed; boundary=\"$boundary1\"\r\n"
			. "\r\n\r\n"
			. "--$boundary1\r\n"
			. "Content-Type: multipart/alternative; boundary=\"$boundary2\"\r\n"
			. "\r\n\r\n"
			// ADD Html content
			 . "--$boundary2\r\n"
			. "Content-Type: text/html; charset=\"utf-8\"\r\n"
			. "Content-Transfer-Encoding: quoted-printable \r\n"
			. "\r\n\r\n"
			. $message . "\r\n"
			. "\r\n\r\n"
			. "--$boundary2\r\n"
			. "\r\n\r\n"
			// ADD attachment(s)
			 . "--$boundary1\r\n"
			. "Content-Type: application/pdf; name=\"" . end($att) . "\"\r\n"
			. "Content-Transfer-Encoding: base64\r\n"
			. "Content-Disposition: attachment; filename=\"" . end($att) . "\"\r\n"
			. "\r\n\r\n"
			. $attachment
			. "\r\n\r\n"
			. "--$boundary1--\r\n\r\n"
		);
		return true;
	}
}
if (!function_exists('sendEmail')) {

	function sendEmail($email, $subject, $message, $cc = null, $attechment = null, $sender_from = false, $password = false, $protocol = false, $port = false, $hostname = false) {
		$CI = get_instance();
		$CI->load->model('Common_model');
		$companydata = $CI->Common_model->getDatabyId($CI->company_id, 'company_matser', 'company_id');
		@$weblink = str_replace('https://', '', $companydata->web_link);
		@$logoname = $companydata->company_logo;
		//'.base_url().'assets/logo/'.$logoname.'
		// /// /http://qbcloud.cefiro.ca/assets/logo/cefiro.jpg
		@$logo = '<img src="' . base_url() . 'assets/logo/' . $logoname . '" alt="' . $logoname . '" height="36" border="0">';
		@$companyname = $companydata->short_name;
		@$webaddress = $companydata->web_link;
		$message .= "<br>" . @$logo . "<br>5610 Blvd. Thimens<br>St-Laurent, QC, H4R 2K9<br><a target='_blank' href='" . $webaddress . "'>" . $weblink . "</a>";

		$message = nl2br($message);
		$CI->load->library('email');
		/*$config = array(
			'protocol' => $protocol,
			'smtp_host' => $hostname,
			'smtp_port' => $port,
			'smtp_timeout' => '7',
			'smtp_user' => $sender_from,
			'smtp_pass' => $password,
			'charset' => 'UTF-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'validation' => TRUE,
			'smtp_crypto' => 'ssl',
		);*/

		$config = array(
			'protocol' => 'imap',
			'smtp_host' => 'ssl://mail.globalpos.ca',
			'smtp_port' => 465,
			'smtp_user' => 'admin@cefiro.ca',
			'smtp_pass' => 'JADdanny=11',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE,
		);

		$CI->email->initialize($config);
		$CI->email->clear(TRUE);
		$CI->email->from("admin");
		//echo $email;
		//print_r($email);exit;
		$CI->email->to($email);

		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->email->attach($attechment);

		if ($CI->email->send()) {
			return true;
		} else {
			return false;
			return show_error($CI->email->print_debugger());
		}
	}
}

if (!function_exists('sendEmailTest')) {

	function sendEmailTest($email, $subject, $message, $attechment) {
		$CI = get_instance();
		$CI->load->model('Common_model');
		$companydata = $CI->Common_model->getDatabyId($CI->company_id, 'company_matser', 'company_id');
		@$weblink = str_replace('https://', '', $companydata->web_link);
		@$logoname = $companydata->company_logo;
		//'.base_url().'assets/logo/'.$logoname.'
		// /// /http://qbcloud.cefiro.ca/assets/logo/cefiro.jpg
		//@$logo = '<img src="' . base_url() . 'assets/logo/' . $logoname . '" alt="' . $logoname . '" height="36" border="0">';
		@$logo = '<img src="' . base_url() . 'uploads/company/' . $logoname . '" alt="' . $logoname . '" height="36" border="0">';
		@$companyname = $companydata->short_name;
		@$webaddress = $companydata->web_link;
		$message .= "<br>" . @$logo . "<br>5610 Blvd. Thimens<br>St-Laurent, QC, H4R 2K9<br><a target='_blank' href='" . $webaddress . "'>" . $weblink . "</a>";

		$message = nl2br($message);

		/*echo $subject; echo "<br>";
			        echo "<pre>";
		*/
		$CI->load->library('email');
		//error_reporting(0);
		$config = array(
			'protocol' => 'imap',
			'smtp_host' => 'ssl://mail.globalpos.ca',
			'smtp_port' => 465,
			'smtp_user' => 'admin@cefiro.ca',
			'smtp_pass' => 'JADdanny=11',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE);

		$CI->email->initialize($config);
		$CI->email->clear(TRUE);
		$CI->email->from("admin");
		$CI->email->to($email);

		$CI->email->subject($subject);
		$CI->email->message($message);

		$CI->email->attach($attechment);

		if ($CI->email->send()) {
			return true;
		} else {
			return false;
			//return show_error($CI->email->print_debugger());
		}
	}
}

if (!function_exists('sendBulkmail')) {

	function sendBulkmail($email, $subject, $message, $cc = null, $attechment = null, $sender_from = false, $password = false, $protocol = false, $port = false, $hostname = false, $otherattachment = null) {
		$CI = get_instance();
		$CI->load->model('Common_model');
		$companydata = $CI->Common_model->getDatabyId($CI->company_id, 'company_matser', 'company_id');
		@$weblink = str_replace('https://', '', $companydata->web_link);
		@$logoname = $companydata->company_logo;
		//'.base_url().'assets/logo/'.$logoname.'
		// /// /http://qbcloud.cefiro.ca/assets/logo/cefiro.jpg
		@$logo = '<img src="' . base_url() . 'assets/logo/' . $logoname . '" alt="' . $logoname . '" height="36" border="0">';
		@$companyname = $companydata->short_name;
		@$webaddress = $companydata->web_link;
		$message .= "<br>" . @$logo . "<br>5610 Blvd. Thimens<br>St-Laurent, QC, H4R 2K9<br><a target='_blank' href='" . $webaddress . "'>" . $weblink . "</a>";
		$message = nl2br($message);

		/*echo $subject; echo "<br>";
			        echo "<pre>";
		*/

		//error_reporting(0);
		/*   $config = array(
	               'protocol' => 'smtp',
	               'smtp_host' => 'ssl://smtp.googlemail.com',
	               'smtp_port' => 25,
	               'smtp_user' => 'admin@cefiro.ca',
	               'smtp_pass' => '',
	               'mailtype' => 'html',
	               'charset' => 'iso-8859-1',
	               'wordwrap' => TRUE
		*/

		$config = array(
			'protocol' => trim($protocol),
			'smtp_host' => trim($hostname),
			'smtp_port' => trim($port),
			/*'smtp_timeout' => '7',*/
			'smtp_user' => trim($sender_from),
			'smtp_pass' => trim($password),
			'charset' => 'UTF-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'validation' => TRUE,
			'smtp_crypto' => 'ssl',
		);

		/*$config['protocol']    = @$protocol;

			        $config['smtp_host']    = @$hostname;

			        $config['smtp_port']    = @$port;

			        $config['smtp_timeout'] = '7';

			        $config['smtp_user']    = @$sender_from;

			        $config['smtp_pass']    = @$password;

			        $config['charset']    = 'iso-8859-1';

			        $config['newline']    = "\r\n";

			        $config['mailtype'] = 'html'; // or html

		*/

		$CI = &get_instance();
		$CI->load->library('email');
		$CI->email->initialize($config);

		//$CI->email->set_newline("\r\n");
		$CI->email->clear(TRUE);
		//$CI->email->set_mailtype('html');
		$CI->email->from($sender_from);
		$CI->email->to($email);
		if ($cc != '') {
			$ccMail = implode(',', $cc);
			foreach ($ccMail as $cc) {
				$CI->email->cc($cc);
			}
		}
		$CI->email->subject($subject);
		$CI->email->message($message);

		//echo $attechment; exit;
		$CI->email->attach($attechment);

		if ($otherattachment != '') {
			$otherattachment = rtrim($otherattachment, ',');
			$otherattachment = explode(',', $otherattachment);

			//$path = set_realpath('./images/');
			//$path = set_realpath('uploads/pdf/');
			//echo $path; exit;
			foreach (@$otherattachment as $attachedFile) {
				//@$otherattachments =  $_SERVER["DOCUMENT_ROOT"].'/uploads/otherAttachment/'.preg_replace('/\s+/', '_', @$attachedFile);
				//$otherattachments = $path.preg_replace('/\s+/', '_', @$attachedFile);
				//$attachedFile = str_replace('/','\\',$attachedFile);
				$otherattachments = FCPATH . 'uploads/otherAttachment/' . preg_replace('/\s+/', '_', @$attachedFile);
				$CI->email->attach($otherattachments);
			}
		}

		//echo $otherattachment1; echo "<br>";
		//echo @$otherattachments; exit;

		if ($CI->email->send()) {
			//sentMailSetup($attechment,$sender_from,$password,$email,$subject,$message);
			return true;
		} else {
			//return $CI->email->print_debugger(array('headers'));
			//return false;

			//return show_error($CI->email->print_debugger());
			return false;
			//return $a;
		}
	}
}

if (!function_exists('sendAllEmail')) {

	function sendAllEmail($email, $subject, $message, $cc = null, $attechment = null, $sender_from = false, $password = false, $protocol = false, $port = false, $hostname = false) {
		$CI = get_instance();
		$CI->load->model('Common_model');
		$companydata = $CI->Common_model->getDatabyId($CI->company_id, 'company_matser', 'company_id');
		@$weblink = str_replace('https://', '', $companydata->web_link);
		@$logoname = $companydata->company_logo;
		//'.base_url().'assets/logo/'.$logoname.'
		// /// /http://qbcloud.cefiro.ca/assets/logo/cefiro.jpg
		@$logo = '<img src="' . base_url() . 'assets/logo/' . $logoname . '" alt="' . $logoname . '" height="36" border="0">';
		@$companyname = $companydata->short_name;
		@$webaddress = $companydata->web_link;
		$message .= "<br><br>Regards,<br>" . $companyname . "<br>Ph :514-991-6674<br>Fax:438-386-9430<br>" . @$logo . "<br>5610 Blvd. Thimens<br>St-Laurent, QC, H4R 2K9<br><a target='_blank' href='" . $webaddress . "'>" . $weblink . "</a>";

		$message = nl2br($message);

		/*echo $subject; echo "<br>";
			        echo "<pre>";
		*/

		//error_reporting(0);
		/*   $config = array(
	               'protocol' => 'smtp',
	               'smtp_host' => 'ssl://smtp.googlemail.com',
	               'smtp_port' => 25,
	               'smtp_user' => 'admin@cefiro.ca',
	               'smtp_pass' => 'JADdanny=11',
	               'mailtype' => 'html',
	               'charset' => 'iso-8859-1',
	               'wordwrap' => TRUE
		*/

		/* $config = array(
			             'protocol' => $protocol,
			             'smtp_host' => $hostname,
			             'smtp_port' => $port,
			             'smtp_user' => $sender_from,
			             'smtp_pass' => $password,
			             'mailtype' => 'html',
			             'charset' => 'iso-8859-1',
			             'wordwrap' => TRUE,
		*/

		$config = array(
			'protocol' => trim($protocol),
			'smtp_host' => trim($hostname),
			'smtp_port' => trim($port),
			/*'smtp_timeout' => '7',*/
			'smtp_user' => trim($sender_from),
			'smtp_pass' => trim($password),
			'charset' => 'UTF-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'validation' => TRUE,
			'smtp_crypto' => 'ssl',
		);

		$CI->load->library('email');
		$CI->email->initialize($config);

		$CI->email->clear(TRUE);
		// $CI->email->set_newline("\r\n");
		// $CI->email->set_mailtype('html');
		//$CI->email->from($sender_from);
		$CI->email->from($sender_from);
		$CI->email->to(implode(', ', $email));
		if ($cc != '') {
			$ccMail = implode(',', $cc);
			foreach ($ccMail as $cc) {
				$CI->email->cc($cc);
			}
		}
		$CI->email->subject($subject);
		$CI->email->message($message);

		$CI->email->attach($attechment);

		if ($CI->email->send()) {
			//sentMailSetup($attechment,$sender_from,$password,$email,$subject,$message);
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('resetpwdBody')) {
	function resetpwdBody($link = null) {
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Actionable emails e.g. reset password</title>
		<style>
		* {
		  margin: 0;
		  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		  box-sizing: border-box;
		  font-size: 14px;
		}

		img {
		  max-width: 100%;
		}

		body {
		  -webkit-font-smoothing: antialiased;
		  -webkit-text-size-adjust: none;
		  width: 100% !important;
		  height: 100%;
		  line-height: 1.6em;
		}

		table td {
		  vertical-align: top;
		}

		body {
		  background-color: #f6f6f6;
		}

		.body-wrap {
		  background-color: #f6f6f6;
		  width: 100%;
		}

		.container {
		  display: block !important;
		  max-width: 600px !important;
		  margin: 0 auto !important;
		  clear: both !important;
		}

		.content {
		  max-width: 600px;
		  margin: 0 auto;
		  display: block;
		  padding: 20px;
		}
		.main {
		  background-color: #fff;
		  border: 1px solid #e9e9e9;
		  border-radius: 3px;
		}

		.content-wrap {
		  padding: 20px;
		}

		.content-block {
		  padding: 0 0 20px;
		}

		.header {
		  width: 100%;
		  margin-bottom: 20px;
		}

		.footer {
		  width: 100%;
		  clear: both;
		  color: #999;
		  padding: 20px;
		}
		.footer p, .footer a, .footer td {
		  color: #999;
		  font-size: 12px;
		}

		h1, h2, h3 {
		  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		  color: #000;
		  margin: 40px 0 0;
		  line-height: 1.2em;
		  font-weight: 400;
		}

		h1 {
		  font-size: 32px;
		  font-weight: 500;
		}

		h2 {
		  font-size: 24px;
		}

		h3 {
		  font-size: 18px;
		}

		h4 {
		  font-size: 14px;
		  font-weight: 600;
		}

		p, ul, ol {
		  margin-bottom: 10px;
		  font-weight: normal;
		}
		p li, ul li, ol li {
		  margin-left: 5px;
		  list-style-position: inside;
		}
		a {
		  color: #348eda;
		  text-decoration: underline;
		}

		.btn-primary {
		  text-decoration: none;
		  color: #FFF;
		  background-color: #348eda;
		  border: solid #348eda;
		  border-width: 10px 20px;
		  line-height: 2em;
		  font-weight: bold;
		  text-align: center;
		  cursor: pointer;
		  display: inline-block;
		  border-radius: 5px;
		  text-transform: capitalize;
		}

		.last {
		  margin-bottom: 0;
		}

		.first {
		  margin-top: 0;
		}

		.aligncenter {
		  text-align: center;
		}

		.alignright {
		  text-align: right;
		}

		.alignleft {
		  text-align: left;
		}

		.clear {
		  clear: both;
		}

		.alert {
		  font-size: 16px;
		  color: #fff;
		  font-weight: 500;
		  padding: 20px;
		  text-align: center;
		  border-radius: 3px 3px 0 0;
		}
		.alert a {
		  color: #fff;
		  text-decoration: none;
		  font-weight: 500;
		  font-size: 16px;
		}
		.alert.alert-warning {
		  background-color: #FF9F00;
		}
		.alert.alert-bad {
		  background-color: #D0021B;
		}
		.alert.alert-good {
		  background-color: #68B90F;
		}
		.invoice {
		  margin: 40px auto;
		  text-align: left;
		  width: 80%;
		}
		.invoice td {
		  padding: 5px 0;
		}
		.invoice .invoice-items {
		  width: 100%;
		}
		.invoice .invoice-items td {
		  border-top: #eee 1px solid;
		}
		.invoice .invoice-items .total td {
		  border-top: 2px solid #333;
		  border-bottom: 2px solid #333;
		  font-weight: 700;
		}

		@media only screen and (max-width: 640px) {
		  body {
		    padding: 0 !important;
		  }

		  h1, h2, h3, h4 {
		    font-weight: 800 !important;
		    margin: 20px 0 5px !important;
		  }

		  h1 {
		    font-size: 22px !important;
		  }

		  h2 {
		    font-size: 18px !important;
		  }

		  h3 {
		    font-size: 16px !important;
		  }

		  .container {
		    padding: 0 !important;
		    width: 100% !important;
		  }

		  .content {
		    padding: 0 !important;
		  }

		  .content-wrap {
		    padding: 10px !important;
		  }

		  .invoice {
		    width: 100% !important;
		  }
		}
		</style>
		</head>

		<body itemscope itemtype="http://schema.org/EmailMessage">

		<table class="body-wrap">
		    <tr>
		        <td></td>
		        <td class="container" width="600">
		            <div class="content">
		                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action">
		                    <tr>
		                        <td class="content-wrap">
		                            <meta itemprop="name" content="Confirm Email"/>
		                            <table width="100%" cellpadding="0" cellspacing="0">
		                                <tr>
		                                    <td class="content-block">
		                                        Please reset your password by clicking the link below.
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td class="content-block">
		                                        We have received new password request for your account.
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td class="content-block" itemprop="handler">
		                                        <a href="' . $link . '" class="btn-primary" itemprop="url">Reset Password</a>
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td class="content-block">
		                                        &mdash; Montessori Elementry
		                                    </td>
		                                </tr>
		                            </table>
		                        </td>
		                    </tr>
		                </table>
		                <div class="footer">
		                </div></div>
		        </td>
		        <td></td>
		    </tr>
		</table>

		</body>
		</html>';
		return $body;
	}
}

if (!function_exists('simpleMail')) {
	function simpleMail($to = null, $subject = null, $MailBodyForSendMail = null) {
		
		$config = array(
			'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 25,
			'smtp_user' => 'testoffice9@gmail.com',
			'smtp_pass' => 'Destiny@1234*',
			'smtp_crypto' => 'ssl',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE,
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);

		$CI->email->clear(TRUE);
		$CI->email->set_newline("\r\n");
		$CI->email->from('testoffice9@gmail.com', 'BookMySell.com');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->set_mailtype('html');
		//$this->email->set_mailtype("html");

		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	            <html xmlns="http://www.w3.org/1999/xhtml">
	              <head>
	                <meta name="viewport" content="width=device-width" />
	                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	                <title></title>
	                <style>
	                  * {
	                  margin: 0;
	                  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	                  box-sizing: border-box;
	                  font-size: 14px;
	                  }
	                  img { max-width: 100%; }
	                  body {
	                  -webkit-font-smoothing: antialiased;
	                  -webkit-text-size-adjust: none;
	                  width: 100% !important;
	                  height: 100%;
	                  line-height: 1.6em;
	                  }
	                  table td { vertical-align: top; }
	                  body { background-color: #f6f6f6; }
	                  .body-wrap { background-color: #f6f6f6; width: 100%; }
	                  .container {
	                  display: block !important;
	                  max-width: 600px !important;
	                  clear: both !important;
	                  }
	                  .content {
	                  max-width: 600px;
	                  margin: 0 auto;
	                  display: block;
	                  padding: 20px;
	                  }
	                  .main { background-color: #fff; border: 1px solid #e9e9e9; border-radius: 3px; }
	                  .content-wrap { padding: 20px; }
	                  .content-block { padding: 0 0 20px; }
	                  .header { width: 100%; margin-bottom: 20px; }
	                  .footer { width: 100%; clear: both; color: #999; padding: 20px; }
	                  .footer p, .footer a, .footer td { color: #999; font-size: 12px; }
	                  h1, h2, h3 {
	                  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	                  color: #000;
	                  margin: 40px 0 0;
	                  line-height: 1.2em;
	                  font-weight: 400;
	                  }
	                  h1 { font-size: 32px; font-weight: 500; }
	                  h2 { font-size: 24px; }
	                  h3 { font-size: 18px; }
	                  h4 { font-size: 14px; font-weight: 600; }
	                  a { color: #348eda; text-decoration: underline; }
	                  #reset_pass {
	                    background-color: #f2a733;
	                    color: white;
	                    padding: 10px;
	                    margin: 10px;
	                    border: 0px;
	                    text-decoration: none;
	                    text-transform: uppercase; }
	                    #reset_pass_link { color: white; text-decoration: none; }
	                </style>
	              </head>
	              <body itemscope itemtype="http://schema.org/EmailMessage">
	              	<div class="container">
	              			' . $MailBodyForSendMail . '
		              </div>
	              </body>
	            </html>';

		$CI->email->message($body);
		// $this->email->message($body);
		if ($CI->email->send()) {
			return true;
		} else {
			return false;
		}
	}
}