<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	
	spl_autoload_register("sp_autoloader");
	$re = new _redirect;
	$redirctUrl = "../my-profile/";
	$u = new _spuser;

	if(isset($_POST['btnVerifyCode'])){
		//$conn = _data::getConnection();

		$idspUser = $_POST['idspUser'];
		$idspProfile = $_POST['idspProfile'];
		$txtCode = $_POST['spUserVerifyCode'];
		$verifyby = $_POST['spUserVerfiyBy'];

		
		$result = $u->read($idspUser);

		//echo $u->ta->sql;
		if($result){
			$row = mysqli_fetch_assoc($result);
			if (strtolower($verifyby) == 'sms') {
				// ACTIVATED ACOUNT BY SMS
				//echo $txtCode;
				if(strtolower($row['phone_verify_code']) == strtolower($txtCode)){
					echo 
					$u->activePhone($idspUser);
					$_SESSION['msg'] = "Your Phone Is Registered!";
					$_SESSION['count'] = 1;
					$_SESSION['msg_type'] = "success";
					$re->redirect($redirctUrl);
				}else{
					$_SESSION['msg'] = "You Enter Wrong Code!";
					$_SESSION['count'] = 1;
					$re->redirect($redirctUrl);
				}
			}else{
				// ACTIVATED ACOUNT BY EMAIL
				if($row['email_verify_code'] == $txt,. Code){
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
	}else{
		$u->update($_POST, "WHERE idspUser ='".$_POST["idspUser"]."'"); 

		$_SESSION['msg'] = "Profile updated successfully!";
		$_SESSION['count'] = 0;

		$re->redirect($redirctUrl);
	}
?>