<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include('univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "freelancer/";    
    include_once ("authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include 'mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

	 $r = new _spprofilehasprofile; 
	 $friendrequest = 0;
    $res11 = $r->friendReequestAll($_SESSION["pid"]); 
	//print_r($res);die;
    if ($res11 != false) {
        $friendrequest = $res11->num_rows;
		//echo $friendrequest.'==';
    }else{
        $friendrequest = 0;
    }
	echo $friendrequest;
	
}
?>