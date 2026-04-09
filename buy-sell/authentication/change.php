<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	// idspUsers, spUserName, spUserFirstName, spUserLastName, spUserPhone, spUserMobile, spUserEmail, spUsersDOB, spUserEnpass, spUserActCode, spUserRegDate
	
	$u = new _spuser;
	$result = $u->read($_SESSION["uid"]);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		$password = $row['spUserPassword'];
		$email = $row['spUserEmail'];
		$name= $row['spUserName'];
	}
	$p = new _spprofiles;
$d = $p->changePassword_description(3);
if ($d) {
	$ro = mysqli_fetch_array($d);
	$notification_description = $ro['notification_description'];
	$subject = $ro['subject'];
}

	if($password == hash("sha256", $_POST['oldpassword_']))
		
	{
		if(hash("sha256", $_POST['spUserPassword']) == hash("sha256", $_POST['spUserPassword_']))
		{
			$u->changepassword($_SESSION['uid'],hash("sha256", $_POST['spUserPassword']));
			//Testing
			// SEND EMAIL TO THE USER
			
			$em = new _email; 
			
			$em->update_password_email($name, $email, $_POST['spUserPassword'], $notification_description, $subject);
			// END
			// $headers = "From: THE the-share-page <admin@thethe-share-page.com> \r\n";
			// $msg = "Dear " . $name. ",\r\n\r\n" . "Your password has been successfully changed your new password:". $_POST['spUserPassword']." on THE SharePage\r\n\r\n";
			// //$msg .= "Though it is not mandatory to activate your account for using the-share-page however it is advisable so you don't lose your work in case you forget your password.\r\n\r\n";
			// //$msg .= "Activation link:\r\n";
			// //$msg .= "http://webarrister.com/authentication/activate.php?me=".$u."&active=".$a."\r\n\r\n\r\n";
			// $msg .= "Thank you,\r\nMembers' Team\r\n https://youtu.be/nL95-RgbFc4 \r\n+91 93 429 72000";
			// mail($email, "The SharePage, Change Password successful.", $msg, $headers);
			//Testing Complete
			
			echo "Your password is Successfully Change";
		}
		else
			echo "Confirm password is not matching";
	}
	else
		echo "Please type old password correctly";
?>