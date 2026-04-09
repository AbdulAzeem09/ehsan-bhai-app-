<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	date_default_timezone_set('Asia/Kolkata');
	$obj=new _friendchatting;      
	
	 $draf_message=$_POST['draf_message'];
	//die("KKKKKKKKKKKKKK");
	$senderid=$_POST['senderdid'];
	$recieverid=$_POST['recieverdid'];
	
	$res=$obj->readdraftmessage($senderid,$recieverid);
	if($res != false){
		$row=mysqli_fetch_assoc($res);
		//echo $row['draft_message']; 
		
		$obj->updatedraftmessage($senderid,$recieverid,$draf_message);  
		
	}
	else{
		
		$data=array(
		'draft_message'=>$draf_message,
		'senderid'=>$senderid,
		'recieverid'=>$recieverid  
		
		);
		$obj->createdraftmessage($data);  
		
		
	}
	
	
?>
