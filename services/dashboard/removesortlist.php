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


  
  
  
    if(isset($_POST['sort'])){
	  $p = new _classified_fav;
       
               $sortid =  $_POST['sort'];
         $result = $p->removesortlist($sortid);

     
      }
    

/*     $_SESSION['count'] = 0;
     $_SESSION['data'] = "success";
     $_SESSION['err'] = "Sort Listed Successfully.";*/
   $re = new _redirect;
    

    $re->redirect($BaseUrl."/services/dashboard/sortlist.php");
}
?>