<?php
	include('../univ/baseurl.php');
	session_start();
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelance_chat;
	$fc->create($_POST);
    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/inbox.php";
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


