<?php 
	
	include('../univ/baseurl.php');
	include( "../univ/main.php");
    session_start();
ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
	
	$sa = new _businessrating;
	$id= $_GET['data-id'];
	//echo $id;die;
	if(isset($_GET['postid'])){
	$postid=$_GET['postid'];
	
		
		$bu=$sa->delete_business($postid);
		$fi=$sa->delete_files_postid($postid);
		header("Location: /backofadmin/content/b_listings.php");
	}
	else{
					$fil = $sa->delete_files($id);
	}
	
}