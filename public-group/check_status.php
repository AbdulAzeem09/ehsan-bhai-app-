<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$r = new _spgroup;
	$adm = $r->isGroupAdmin($_POST["pid"],$_POST["gid"]); 
	$ast_adm = $r->checkSubadmin($_POST["gid"],$_POST["pid"]);
	$membr = $r->ismember($_POST["gid"],$_POST["pid"]);
	$reqst_sts = $r->checkRequestStatus($_POST["gid"],$_POST["pid"]);	
	$is_blocked = $r->is_blockedMember($_POST["gid"],$_POST["pid"]);
	$is_rejected = $r->is_rejectedMember($_POST["gid"],$_POST["pid"]);

	if($adm != false)
	{		
		echo json_encode(array('status'=>'admin','message'=>"You are the admin")); exit();		
	}
	else if($ast_adm != false) {
		echo json_encode(array('status'=>'asst_admin','message'=>"You are the asst. admin"));exit();	
	}
	else if($membr != false) {
		echo json_encode(array('status'=>'member','message'=>"You are the group member"));exit();	
	}
	else if($reqst_sts != false) {
		echo json_encode(array('status'=>'pending','message'=>"You request is pending for approval"));exit();
	}
	else if($is_blocked != false) {
		echo json_encode(array('status'=>'blocked','message'=>"You are blocked by admin"));exit();
	}
	else if($is_rejected != false) {
		echo json_encode(array('status'=>'rejected','message'=>"You are blocked by admin"));exit();
	}
	else {
		echo json_encode(array('status'=>'nomember','message'=>"You are ready to join"));exit();
	}
	
?>