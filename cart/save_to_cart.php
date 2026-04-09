<?php
	/*error_reporting(E_ALL);
	ini_set('display_errors', 1);*/
	include('../univ/baseurl.php');
	include( "../univ/main.php");
	session_start();
	//print_r($_SESSION);
	//ini_set('display_startup_errors', 1);
	//
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="cart/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$p = new _order;
									if($_GET['action']=='addtocart'){ 
										$arr=array("saveforlater"=>0); 
												$ad=$p->addtocart($arr,$_GET['id']);
												
												header("location:/cart/index.php");
												
												
										}
		
		
		
		}
	?>