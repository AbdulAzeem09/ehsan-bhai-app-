<?php
    include('../univ/baseurl.php');
    session_start();

   /* print_r($_SESSION);*/
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-profile/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $u = new _spuser;
	$sms = new _sms; 
	
	//echo "<pre>"; print_r($_POST); exit;
	$response = array();
	try {
		if(isset($_POST["send_otp"]) && $_POST["send_otp"] == 1){
			
			//$u->updatetwostep(1,$_POST['idspUser']);
			
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

			$mobile = $_POST["country_code"].$_POST["phone_no"];

			$isAlreadyExist = $u->checkUserPhoneByUID($_POST["idspUser"], trim($_POST["country_code"]), trim($_POST["phone_no"]));

			if ($isAlreadyExist != false) {
				$response["status"] = 0;
				$response["msg"] = "Entered number is already exists, Please enter unique number.";
			} else {
				$u->updateEmailCode($_POST["idspUser"], $randCode, 1); 
				$message = urlencode($randCode)." is your code to change Phone Number. Do not share it with anyone.";
			
				$smsResponse = $sms->send_any_sms($mobile, $message);
			
				if(isset($_POST["re_send_otp"]) && $_POST["re_send_otp"] == 1)
				{
					$response["status"] = 1;
					$response["msg"] = "OTP resent successfully, Please enter OTP.";
				}
				else
				{
					$response["status"] = 1;
					$response["msg"] = "OTP has been sent to your new number, Please enter OTP.";
				}
			}
		}
		else if(isset($_POST["send_otp"]) && $_POST["send_otp"] == 2)
		{
			if(isset($_POST["idspUser"]) && $_POST["idspUser"] != "")
			{
				$r = $u->read($_POST["idspUser"]);
				
				if ($r != false) {
					if ($r->num_rows == 1) {
						if($rows = mysqli_fetch_array($r)) {
							if ($rows['phone_verify_code'] == $_POST['otp']) 
							{
								//update new number spUserPhone.
								$u->update(array("spUserPhone" => $_POST["phone_no"],"spUserCountryCode"=>$_POST["country_code"]),$_POST["idspUser"]);
								$response["status"] = 1;
								$response["msg"] = "Phone number updated successfully.";
							}
							else 
							{
								$response["status"] = 0;
								$response["msg"] = "Please enter valid OTP.";	
							}
						}	
					}
				}
			}
		} else {
			$response["status"] = 0;
			$response["msg"] = "Something went wrong.";
		}
		echo json_encode($response);
	} catch(Exception $e) {
		$response["status"] = 0;
		$response["msg"] = "Something went wrong, might be the number is invalid.";
		echo json_encode($response);
	}
}
?>