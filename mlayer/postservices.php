<?php
	session_start(); 
	include_once("../authentication/check.php");

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$cstr = $_POST["postservicerequest_"];
	$r = new $cstr;
	echo $r->create($_POST);
?> 
