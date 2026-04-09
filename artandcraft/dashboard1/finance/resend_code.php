<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once ("../authentication/check.php");
    
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

	$u = new _spuser;

//print_r($_POST);

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
				//$message = "Verification code for online account registration is:" .urlencode($randCode)." Okease verify at www.thesharepage.com";

				$message = urlencode($randCode)." is your code to login to TheSharePage.com . Do not share it with anyone.";
			
			}else{
				//$message = "Verification code for online account registration is:" .$row['phone_verify_code']." Okease verify at www.thesharepage.com";

				$message = $row['phone_verify_code']." is your code to login to TheSharePage.com . Do not share it with anyone.";
				
				//$message = $row['phone_verify_code'];
			}
			//SEND SMS TO SPECIFIC USER WHO REGISTER START
			$sms = new _sms; 
			$sms->send_any_sms($mobile, $message);
			//SEND SMS TO SPECIFIC USER WHO REGISTER END
			echo 1;
		}else{
			echo 2;
		}
	}


}	
?>