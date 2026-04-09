<?php 
   session_start();
   
    $userid=$_SESSION['userId'];
    $aikey =  isset($_POST['aikey']) ?  $_POST['aikey'] : "";
   
   
   include "../../common.php";
   require_once '../library/config.php';
   require_once '../library/functions.php';
   
   
   $result =insertQ("update tbl_user set ai_keys=? where user_id=?", "ss", [$aikey,$userid]);
    $_SESSION['ai_key']='AI-Key Updated!!';
    header('location:'.$BaseUrl.'/backofadmin/news_letter/');
   ?>