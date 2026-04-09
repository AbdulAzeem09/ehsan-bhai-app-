<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		case 'sendall' :
			sendemailall($dbConn);
			break;

		case 'sendspecefic' :
			sendspecefic($dbConn);
			break;
			
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	// SEND ALL USERS WHICH IS VALID EMAILS
	function sendemailall($dbConn){
		$txtSubject   = mysqli_real_escape_string($dbConn,$_POST['txtSubject']);
		$txtMessage 	= mysqli_real_escape_string($dbConn, $_POST['txtMessage']);

		// GET ALL EMAILS WHICH IS VALID
		$sql = "SELECT * FROM spuser WHERE is_email_verify = 1";
		$result = dbQuery($dbConn, $sql);
		if ($result) {
			$email = array();
			$i = 0;
			while ($row = dbFetchAssoc($result)) {
				$email[] = $row['spUserEmail'];
				$s_test['spUserName'] = $row['spUserName'];
				$e_test[$row['spUserEmail']] = $s_test;
				$i = $i + 1;
			}
			$myJSON = json_encode($e_test);
			$totalCount = count($email);
			//print_r($email);
			$emails = implode(', ', $email);
			$api_key = "key-2664c40f3b1c2991fb51e72fa4ecd13a"; /* Api Key got from https://mailgun.com/cp/my_account */
			$domain = "dev.thesharepage.com";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, array(
				//'X-Mailgun-Recipient-Variables' => $myJSON,
				'from' 		=> 'TheSharePage <info@thesharepage.com>',
				'to' 		=>  $emails,
				'subject' 	=>	$txtSubject,
				'html' 		=> 	$txtMessage,
				'o:tracking-clicks' => TRUE
			));
			$resultch = curl_exec($ch);
			
			curl_close($ch);
			
			//print_r($resultch);
			$output 	= explode(',', $resultch);
			$messageId 	= $output[0];
			$string2 	= ltrim($messageId, '{');
			$string3 	= ltrim($string2, ' "id": "<');
			$string4 	= trim($string3);
			$string5 	= ltrim($string4, '"id": "<');
			$job_id 	= rtrim($string5, '>"');

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Email Sent Successfully.";
			redirect('index.php');
		}else{
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "No Valid Emails.";
			redirect('index.php');
		}
	}
	// send specefic emails
	function sendspecefic($dbConn){
		$txtEmail   	= mysqli_real_escape_string($dbConn,$_POST['txtEmail']);
		$txtSubject   	= mysqli_real_escape_string($dbConn,$_POST['txtSubject']);
		$txtMessage 	= mysqli_real_escape_string($dbConn, $_POST['txtMessage']);

		if (isset($txtEmail) && $txtEmail != '') {
			$email = array();
			$i = 0;
			$email = explode(';', $txtEmail);
			$totalCount = count($email);
			//print_r($email);
			$emails = implode(', ', $email);
			$api_key = "key-2664c40f3b1c2991fb51e72fa4ecd13a"; /* Api Key got from https://mailgun.com/cp/my_account */
			$domain = "dev.thesharepage.com";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, array(
				//'X-Mailgun-Recipient-Variables' => $myJSON,
				'from' 		=> 'TheSharePage <info@thesharepage.com>',
				'to' 		=>  $emails,
				'subject' 	=>	$txtSubject,
				'html' 		=> 	$txtMessage,
				'o:tracking-clicks' => TRUE
			));
			$resultch = curl_exec($ch);
			
			curl_close($ch);
			
			//print_r($resultch);
			$output 	= explode(',', $resultch);
			$messageId 	= $output[0];
			$string2 	= ltrim($messageId, '{');
			$string3 	= ltrim($string2, ' "id": "<');
			$string4 	= trim($string3);
			$string5 	= ltrim($string4, '"id": "<');
			$job_id 	= rtrim($string5, '>"');

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Email Sent Successfully.";
			redirect('index.php');

			
		}else{
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "No Valid Emails.";
			redirect('index.php');
		}
	}
	

?>