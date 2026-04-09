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
		
		//print_r($_POST);die;
	 	$uid=$_POST['uid'];
	 	$pid=$_POST['pid'];
		$postid=$_POST['postid'];
	
		
		$fav= new _businessrating;
		$fav1=$fav->remove_business_fav($uid,$pid,$postid);
		}
	?>