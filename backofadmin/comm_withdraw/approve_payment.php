<?php
include '../../univ/baseurl.php';
    if (!defined('WEB_ROOT')) {
        exit;
    }
    date_default_timezone_set("Asia/Bangkok");
     $date = date('m-d-Y');

       $id=$_GET['id'];
       $up="UPDATE spcommission_withdraw
       SET status = 1, action_date ='$date'
       WHERE id=$id;" ;
      // echo $up;
  
    $result  = dbQuery($dbConn, $up);
    redirect("index.php");
  
    //header('location:'.$BaseUrl.'/backofadmin/friend_commission/index.php');
    
    
?>