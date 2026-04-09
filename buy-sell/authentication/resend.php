<?php
	include('../univ/baseurl.php');
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	
	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/my-profile/";

	$u = new _spuser;

	if(isset($_GET["code"]) && isset($_GET['sendby']) && $_GET['sendby'] == 'sms'){
		$userId = $_GET['code'];
		$result = $u->read($userId);
		if($result){
			$row = mysqli_fetch_assoc($result);
			$genratecode = $row['phone_verify_code'];
			$mobile = $row["spUserCountryCode"].$row['spUserPhone'];

			if ($genratecode == "" || $genratecode == 0) {
				//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
				$size = 6;
				$alpha_key = '';
				$keys = range('A', 'Z');
				for ($i = 0; $i < 2; $i++) {
					$alpha_key .= $keys[array_rand($keys)];
				}
				$length = $size - 2;
				$key = '';
				$keys = range(0, 9);
				for ($i = 0; $i < $length; $i++) {
					$key .= $keys[array_rand($keys)];
				}
				$randCode = $alpha_key . $key;
				//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END
				// UPDATE CODE ON USER PROFILE START
				//$u->updateCode($userId, $randCode);
				$u->updateEmailCode($userId, $randCode, 1);
				//echo $u->ta->sql;
				// UPDATE CODE ON USER PROFILE END
				$message = "Verification code for online account registration is:" .urlencode($randCode)." Please verify at www.thesharepage.com";
			}else{
				$message = $row['phone_verify_code'];
			}
			//SEND SMS TO SPECIFIC USER WHO REGISTER START
			//change the code here for the twilio sms
			$sms = new _sms; 
			$sms->send_any_sms($mobile, $message);
			//SEND SMS TO SPECIFIC USER WHO REGISTER END
			$_SESSION['msg'] = "Code Sent To Your Mobile Number";
			$_SESSION['count'] = 1;
			$re->redirect($redirctUrl);
		}else{
			$_SESSION['msg'] = "Some error is occured.";
			$_SESSION['count'] = 1;
			$re->redirect($redirctUrl);
		}
	}else if(isset($_GET["code"]) && isset($_GET['sendby']) && $_GET['sendby'] == 'email'){
		// VERIFICATION BY EMAIL
		$userId = $_GET['code'];
		$result = $u->read($userId);
		if($result){
			$row = mysqli_fetch_assoc($result);
			$genratecode = $row['email_verify_code'];
			$userEmail = $row['spUserEmail'];

			if ($genratecode == "") {
				//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
				$size = 6;
				$alpha_key = '';
				$keys = range('A', 'Z');
				for ($i = 0; $i < 2; $i++) {
					$alpha_key .= $keys[array_rand($keys)];
				}
				$length = $size - 2;
				$key = '';
				$keys = range(0, 9);
				for ($i = 0; $i < $length; $i++) {
					$key .= $keys[array_rand($keys)];
				}
				$randCode = "ESP".$alpha_key . $key;
				//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END
				// UPDATE CODE ON USER PROFILE START
				$u->updateEmailCode($userId, $randCode, 2);
				//echo $u->ta->sql;
				// UPDATE CODE ON USER PROFILE END
				$message = urlencode($randCode);
			}else{
				$message = $row['email_verify_code'];
			}
			//echo $message;

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
				'from' => 'TheSharePage <no-reply@thesharepage.com>',
				'to' =>  $userEmail, 
				'subject' => 'Email Verification',
				'html' => "Your email Verification passcode is ".$message,
				'o:tracking-clicks' => TRUE
			));
			$result_e = curl_exec($ch);
			curl_close($ch);
			//$string = '{ "id": "<20170424074159.23658.65668.63B3D50D@www.ondotz.com>", "message": "Queued. Thank you." }';
			//$output = explode(',', $result);
			$output = explode(',', $result_e);
			$messageId = $output[0];
			$string2 = ltrim($messageId, '{');
			$string3 = ltrim($string2, ' "id": "<');
			$string4 = trim($string3);
			$string5 = ltrim($string4, '"id": "<');
			$job_id = rtrim($string5, '>"');			
			//SEND SMS TO SPECIFIC USER WHO REGISTER END
			$_SESSION['msg'] = "Code Sent To Your Email.";
			$_SESSION['count'] = 1;
			$re->redirect($redirctUrl);

		}else{
			$_SESSION['msg'] = "Some error is occured.";
			$_SESSION['count'] = 1;
			$re->redirect($redirctUrl);
		}
	}else{
		$_SESSION['msg'] = "Path is wrong";
		$_SESSION['count'] = 1;
		$re->redirect($redirctUrl);
	}
?>