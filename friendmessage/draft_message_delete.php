<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$obj=new _friendchatting;
	
	 //$draf_message=$_POST['draf_message'];
	//die("KKKKKKKKKKKKKK");
	$senderid=$_POST['senderdid'];
	$recieverid=$_POST['recieverdid']; 
	
	$res=$obj->removedraftmessage($senderid,$recieverid);
	
	
	
	
	
?>
