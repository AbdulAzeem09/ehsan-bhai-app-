<?php
    /*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
 include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_GET['id'])){
	  	$p = new _classified;
	    $portid=  $_GET['id'];
        $result = $p->removeFavourit($portid);

     
      }
    
   $re = new _redirect;
    $re->redirect($BaseUrl."/services/dashboard/favourite.php");
}
?>
		
		