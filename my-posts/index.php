<?php
	include('../univ/baseurl.php');
    session_start();

    if(!isset($_SESSION['pid'])){ 
      	include_once ("../authentication/check.php");
      	$_SESSION['afterlogin']= $BaseUrl."/timeline";
    }
    function sp_autoloader($class){
      	include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $re = new _redirect;

    $redirctUrl = $BaseUrl . "/timeline/";
    $re->redirect($redirctUrl);
    
?>