<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _bookRoom;
	$p->create($_POST);
	//header('location:../photos/myenquiry.php');
	$re = new _redirect;
	$re->redirect("../real-estate/room-detail.php?postid=".$_POST['spPosting_idspPosting']);
	
?>