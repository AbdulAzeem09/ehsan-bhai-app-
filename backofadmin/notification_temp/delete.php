<?php
include '../../univ/baseurl.php';
    if (!defined('WEB_ROOT')) {
        exit;
    }

       $id=$_GET['id'];
       $del="DELETE FROM notification_temp where id=$id" ;
  
    $result  = dbQuery($dbConn, $del);
    redirect("index.php");
  
    //header('location:'.$BaseUrl.'/backofadmin/friend_commission/index.php');
    
    
?>