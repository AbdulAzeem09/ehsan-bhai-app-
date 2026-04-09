<?php
   session_start();
   $id = $_GET['id'];
   include "../../common.php";
   require_once '../library/config.php'; 
   require_once '../library/functions.php';
   
   $sql = "DELETE FROM spnewsletter_template WHERE id = '$id' ";
   $result = dbQuery($dbConn, $sql);
   
   header('location:'.$BaseUrl.'/backofadmin/news_letter/');
   ?>