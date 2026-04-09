<?php
    
session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _classified_fav;
  
  
    if(isset($_POST['sort'])){
       
               $sortid =  $_POST['sort'];
         $result = $p->removesortlist($sortid);

     
      }
    

/*     $_SESSION['count'] = 0;
     $_SESSION['data'] = "success";
     $_SESSION['err'] = "Sort Listed Successfully.";*/
   $re = new _redirect;
    

    $re->redirect($BaseUrl."/services/dashboard/sortlist.php");
    
?>