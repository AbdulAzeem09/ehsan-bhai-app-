<?php
    
session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _classified_fav;
  
    if (isset($_POST['id']) && $_POST['id'] > 0) {
    	$id = $_POST['id'];
        $comment = $_POST['comment'];

    	// $result = $p->addsortcomment($id,$comment);
        $result = $p->addcomment($id,$comment);
        //echo $p->ta->sql;
    }
     $_SESSION['count'] = 0;
     $_SESSION['data'] = "success";
     $_SESSION['err'] = "Comment Added Successfully.";
   
    $re = new _redirect;
    //$re->redirect($BaseUrl."/services/");

    $re->redirect($BaseUrl."/services/dashboard/sortlist.php");
    
?>