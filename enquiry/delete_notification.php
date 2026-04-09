<?php 
	 include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="timeline/";
	include_once ("../authentication/check.php");
	
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	//print_r($_POST);die;
	foreach($_POST['del'] as $id){
	$m= new _postenquiry;
	$res= $m->delete_notification($id);
	
	
	}
	header("location: notification.php");
}