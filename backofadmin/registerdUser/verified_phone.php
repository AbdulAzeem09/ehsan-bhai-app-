<?php
$url = '../../twilio-php-5.13.0/Twilio/autoload.php';
require $url;

require_once '../library/config.php';
require_once '../library/functions.php';

if(isset($_POST['u_id']) && isset($_POST['mobile_number']) && $_POST['u_id'] != "" && $_POST['mobile_number'] != ""){

		$uid = $_POST['u_id'];
		$mobile = "+".$_POST['mobile_number'];
	
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
		
		//update phone_verify_code
		$sql		=	"UPDATE spuser SET phone_verify_code = '$randCode' WHERE idspUser = $uid";
		$result 	= 	dbQuery($dbConn, $sql);
		
		$sid = "AC133edde2cd4eb04a187b23785b9acf65"; // Your Account SID from www.twilio.com/console
		$token = "c34c43a63c60436330b906ebf35a75c7"; // Your Auth Token from www.twilio.com/console
		
		$userid = ($uid);
		$message_code = urlencode($randCode)." is your code to Verify Your Number to TheSharePage.com. Do not share it with anyone.";
		$message_code .= "This Is Link To Open To Verify Your Phone https://dev.thesharepage.com/verifyphone.php?id=".$userid;
		$client = new Twilio\Rest\Client($sid, $token);
		$message = $client->messages->create(
		  $mobile, // Text this number
		  array(
			'from' => '+16042002975', // From a valid Twilio number
			'body' => $message_code
		  )
		);
		
		echo 1;
}
?>