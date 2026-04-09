<?php
	include('../univ/baseurl.php');
	require '../library/twilio/src/Twilio/autoload.php';
	use Twilio\Rest\Client;
	
	// use Twilio\Rest\Client;


	// include('../univ/library/twilio/src/Twilio/autoload.php');
	// use \univ\library\twilio\src\Twilio\Rest\Client;a
	
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$u = new _spuser;
	// $sms = new _sms;
	$mobile = "+919712263042";
	$message = 'abc';
	$sid = 'AC133edde2cd4eb04a187b23785b9acf65';
    $token = 'c34c43a63c60436330b906ebf35a75c7';
    $client = new Client($sid, $token);
    $twilio_number = "+16042002975";

    $client->messages->create(
        // Where to send a text message (your cell phone?)
        '+919712263042',
        array(
            'from' => $twilio_number,
            'body' => 'I sent this message in under 10 minutes!'
        )
    );
	// $sms->send_sms($mobile, $message);
	// $sms->send_any_sms($mobile, $message);




	if(isset($_POST["uid"]) && $_POST['uid'] > 0){

		$userId = $_POST['uid'];
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
				$message = "Verification code for online account registration is:" .urlencode($randCode)." Okease verify at www.thesharepage.com";
			}else{
				$message = "Verification code for online account registration is:" .$row['phone_verify_code']." Okease verify at www.thesharepage.com";
				//$message = $row['phone_verify_code'];
			}
			//SEND SMS TO SPECIFIC USER WHO REGISTER START
			// $sms = new _sms; 
			// $sms->send_any_sms($mobile, $message);
			//SEND SMS TO SPECIFIC USER WHO REGISTER END
			echo 1;
		}else{
			echo 2;
		}
	}
?>