<?php
	
	//error_reporting(E_ALL);
   // ini_set('display_errors', 'On');
	include('../../univ/baseurl.php');
    session_start();

    //print_r($_SESSION);die;

if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
    
}else{
	function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $re = new _redirect;
    $p = new _productposting;
	 $pind = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
	//$pind = $_GET['postid'];
	
	$res = $p->del_product($pind);
	
	header("location:/store/dashboard/active_product.php");
	
	
}

?>
