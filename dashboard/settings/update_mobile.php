<?php 
	error_reporting(E_ALL);
ini_set('display_errors', '1');
	    require_once("../../univ/baseurl.php" );
	session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		
		$id=$_SESSION['uid']; 
		$data = array(
			"spUserPhone" => $_POST['phone_no'],
    "phone_code" => $_POST['phone_code'],
    "is_phone_verify" => $_POST['send_otp'],
    "phone_no" => $_POST['phoneno'],
);

		//print_r($data);die('=====');
		$n= new _spuser;
	    $n->updatephone($data,$id);
		echo 'success';
		//json_encode(['status'=>'yes']);
		//header("location:https://dev.thesharepage.com/dashboard/settings/");

		}?>
		