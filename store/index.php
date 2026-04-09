<?php
  include('../univ/baseurl.php');
  session_start();
if(!isset($_SESSION['pid'])){ 
  $_SESSION['afterlogin']="store/";
  include_once ("../authentication/check.php");
  
}else{

    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
  $re = new _redirect;
        $location = $BaseUrl."/store/storeindex.php";
        $re->redirect($location);
   /*  
     include("storeindex.php");*/ 
  
  }