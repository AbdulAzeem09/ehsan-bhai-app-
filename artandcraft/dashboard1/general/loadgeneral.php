<?php
	include('../../univ/baseurl.php');
	session_start();

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$mod = $_POST['mod'];

	$p = new _spAllStoreForm;
	if ($mod == "sms") {
		$pid = $_POST['pid'];
		$uid = $_POST['uid'];
		$phone = $_POST['phone'];

		$result = $p->chekExistOrNot($pid, $uid);
		//echo $p->ge->sql;
		if ($result) {
			// update
			$p->updatePhneGeneral($pid, $uid, $phone);
		
		}else{
			// create
			$p->createPhneGeneral($pid, $uid, $phone);
		}
	}else{
		$pid = $_POST['pid'];
		$uid = $_POST['uid'];
		$email = $_POST['email'];
		$result = $p->chekExistOrNot($pid, $uid);
		if ($result) {
			$p->updateEmailGeneral($pid, $uid, $email);
		}else{
			$p->createEmailGeneral($pid, $uid, $email);
		}
	}



?>