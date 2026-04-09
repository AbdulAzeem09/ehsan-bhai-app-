<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	
	
	
	
	$obj=new _friendchatting;  
	$senderPidd = isset($_POST['data_myid2']) ? (int)$_POST['data_myid2'] : 0;
	$recieverid = isset($_POST['data_friendid2']) ? (int)$_POST['data_friendid2'] : 0;
	//die("success");   
	
	$obj->deletechat($senderPidd,$recieverid);
	
	
?>
