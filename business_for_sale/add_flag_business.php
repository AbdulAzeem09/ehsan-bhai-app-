<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	include('../univ/baseurl.php');
	session_start();
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "business_for_sale/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		
		$postid=$_POST['spPosting_idspPosting'];
		$fl= new _businessrating;
		$fl->addBussinessflag($_POST);
		header('Location: business_detail.php?postid='.$postid);
		}
		
	?>