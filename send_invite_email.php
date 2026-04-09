<?php
	if(isset($_SESSION)){
		session_start();
		session_destroy(); 
	}
	
	include("univ/baseurl.php");
	session_start();
	
	//print_r($_SESSION);
	function sp_autoloader($class)
	{
	include 'mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
 
	
    $em = new _email;

    $em->send_all_email($_POST['email'], $_POST['subject'],$_POST['message']);