<?php
echo "abc"; exit();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	// idspUsers, spUserName, spUserFirstName, spUserLastName, spUserPhone, spUserMobile, spUserEmail, spUsersDOB, spUserEnpass, spUserActCode, spUserRegDate
	
	$u = new _spuser;
	$uid = $u->register(array("spUserName" => $_POST["spUserName"], "spUserEmail" => $_POST["spUserEmail"], "spUserPassword" => hash("sha256", $_POST['spUserPassword'])));
	echo $uid;
	if($uid > 0 ){
		session_start();
		$_SESSION['login_user']= $_POST["spUserName"];
		$_SESSION['uid'] =  $uid; 
		$_SESSION['spUserEmail'] = $_POST["spUserEmail"]; 
		$p = new _spprofiles;
			$rp = $p->readProfiles($_SESSION['uid']);
			if ($rp != false)
			{
				$row = mysqli_fetch_array($rp);
				$_SESSION['pid'] = $row['idspProfiles'];
				$_SESSION['myprofile'] = $row["spProfileName"];
				$_SESSION['ptname'] = $row["spProfileTypeName"];
					
			}
	}
	
?>