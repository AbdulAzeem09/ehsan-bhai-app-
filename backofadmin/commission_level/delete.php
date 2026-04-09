<?php
include '../../univ/baseurl.php';
    if (!defined('WEB_ROOT')) {
        exit;
    }

       $id=$_GET['id'];
       $del="DELETE FROM close_friend where id=$id" ;
  
    $result  = dbQuery($dbConn, $del);
    redirect("index.php?view=close_f");
  
    //header('location:'.$BaseUrl.'/backofadmin/friend_commission/index.php');
    
    
?>