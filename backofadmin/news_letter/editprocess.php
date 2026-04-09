<?php 
   session_start();
   if(isset($_POST['txtSubject']) &&$_POST['txtSubject']!=='')
   {
   	
    $id = isset($_POST['id']) ? trim($_POST['id']) : "";
    $subject = isset($_POST['txtSubject']) ? trim($_POST['txtSubject']) : "";
    $txtMessage = isset($_POST['txtMessage']) ? trim($_POST['txtMessage']) : "";
    $currentDateTime = date("Y-m-d H:i:s");
   
   include "../../common.php";
   require_once '../library/config.php';
   require_once '../library/functions.php';
   
   $result =insertQ("update spnewsletter_template set newsletter_title=?, newsletter_content=? ,created_at=? where id=?", "ssss", [$subject, $txtMessage, date("Y-m-d H:i:s"),$id]);
    
     if($result=='')
     {
     	 echo "success";
     }
   }
   else
   {
   	$_SESSION['edit_data']='Please Fill This Field!!';
   	echo "error";
   	
   }
   
   ?>