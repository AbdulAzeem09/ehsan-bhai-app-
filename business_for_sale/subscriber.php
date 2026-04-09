<?php
	include('../univ/baseurl.php');
	session_start();
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "job-board/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$em=new _businessrating;
		$em->add_subscriber($_POST);
		header('Location: index.php?page=1');
		
		
		}
	?>