<?php

	include('../univ/baseurl.php');
	session_start();
	
    function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	if (isset($_REQUEST['otp']) && $_REQUEST['userid']) {
		$otp = strtoupper($_REQUEST['otp']);
		$uid = $_REQUEST['userid'];

		$u = new _spuser;
		$result = $u->isPhoneVerify($uid);
		//echo $u->ta->sql;
		if ($result && $result->num_rows > 0) {
			$data = array("status" => 1, "message" => "Phone Already Verified!");
		}else{
			
			$result2 = $u->isvodevalid($uid, $otp);
			//echo $u->ta->sql;
			if ($result2) {

				$result3 = $u->activePhone($uid);
				$userdata = array("userid"=>$uid,"otp"=>$otp,"status"=>1);
				$data = array("status" => 200, "message" => "success","data"=> $userdata);
			
			}else{
				//echo 1;
				$data = array("status" => 1, "message" => "Please Enter Correct OTP!");
			}
		}

	}else{

		$data = array("status" => 1, "message" => "Some Field missing!");
	}

echo json_encode($data);

?>