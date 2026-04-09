<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../univ/baseurl.php");
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	
	spl_autoload_register("sp_autoloader");
	$re = new _redirect;
	$redirctUrl = "../dashboard/settings/";
	$u = new _spuser;

     $idspUser = $_POST['idspUser'];
	if(isset($_POST['spUserVerfiyBy'])){
		//$conn = _data::getConnection();

		
		$idspProfile = $_POST['idspProfile'];
		$txtCode = $_POST['spUserVerifyCode'];
		$verifyby = $_POST['spUserVerfiyBy'];

		
		$result = $u->read($idspUser);

		//echo $u->ta->sql;
		if($result){
			$row = mysqli_fetch_assoc($result);
			if (strtolower($verifyby) == 'sms') {
				
				// ACTIVATED ACOUNT BY SMS
				//echo $txtCode.'+++';
				//echo $_SESSION["phone_otp_setting2"].'==';
				if($_SESSION["phone_otp_setting2"] == $txtCode){
					
					$u->activePhone($idspUser);
					echo 1;
					$_SESSION['msg'] = "Your Phone Is Registered!";
					$_SESSION['count'] = 1;
					$_SESSION['msg_type'] = "success";
					//$re->redirect($redirctUrl);
				}else{
					echo 0;
					$_SESSION['msg'] = "You Enter Wrong Code!";
					$_SESSION['count'] = 1;
					//$re->redirect($redirctUrl);
				}
			}else{
				
				// ACTIVATED ACOUNT BY EMAIL
				if($row['email_verify_code'] == $txt){
					
					$u->activeEmail($idspUser);
					$re->redirect($redirctUrl);
				}else{
					
					$_SESSION['msg'] = "You Enter Wrong Code!";
					$_SESSION['count'] = 1;
					$re->redirect($redirctUrl);
				}
			}
		}else{
			$re->redirect($redirctUrl);
		}
	}
	// else{


	// 	echo '00';
	// 	$u->update($_POST, $idspUser); 

	// 	$_SESSION['msg'] = "Profile updated successfully!";
	// 	$_SESSION['count'] = 0;

	// 	$re->redirect($redirctUrl);
	// }
?>