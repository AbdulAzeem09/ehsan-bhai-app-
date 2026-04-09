<?php 
   session_start();
   if(isset($_POST['txtSubject'])&&$_POST['txtSubject']!==''){
   
   
    $subject = isset($_POST['txtSubject']) ? trim($_POST['txtSubject']) : "";
    $txtMessage = isset($_POST['txtMessage']) ? trim($_POST['txtMessage']) : "";
    $currentDateTime = date("Y-m-d H:i:s");
   
   include "../../common.php";
   require_once '../library/config.php';
   require_once '../library/functions.php';
   
   
     $result = insertQ("insert into spnewsletter_template(newsletter_title, newsletter_content, created_at) values(?, ?, ?)", "sss", [$subject, $txtMessage, date("Y-m-d H:i:s")]);
    
     if($result=='')
     {
     	 echo "success";
     }
   
   }else
   {
   	$_SESSION['fill_data']='Please Fill Out This Field!! ';
   	echo "error";
   }
   
   ?>