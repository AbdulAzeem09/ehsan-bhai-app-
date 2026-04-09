<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$profilename = $_POST["profilename"];
	$flag = $_POST['flag'];
	$s = new _spprofilehasprofile;	
	$result = $s->checkfriend($_POST["sender"],$_POST["reciever"]);
	if($result != false) {
		if($flag == 'NULL') {
			//friend request pending
			$status = '';
			$s->againSendRequest($_POST["sender"],$_POST["reciever"], $status);
			echo "Your request has successfully sent for!" .$profilename;
		} else if($flag == 1) {
			//friends ko unfrnd krna ha.			
		} else if($flag == -1) {
			//request rejected
			$status = '-1';
			// $s->againSendRequest($_POST["sender"],$_POST["reciever"], $status);
			$s->unfriend($_POST["sender"],$_POST["reciever"]);
			echo "Your request has successfully cancel for!" .$profilename;
		}
		
	}else{
		$s->create($_POST["sender"],$_POST["reciever"]);
		echo "Your request has successfully sent for!" .$profilename;
	}
?>