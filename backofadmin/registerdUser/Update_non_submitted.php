<?php
	
	/*$con = mysqli_connect('localhost', 'osspdev', 'Office@256');

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, 'thesharepage')) {
        echo 'Database Not Selected';
    }*/
	
require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	
	if (!defined('WEB_ROOT')) {
		exit;
	}

//print_r($_POST); die('================='); 

$sp_status=$_POST['status'];
$tbl=$_POST['tbl'];

$sp_userid=$_POST['userid'];
$spuid=$_POST['spuid'];

if($tbl == 'bussiness_file'){
$update_sql = "UPDATE spbuiseness_files SET status='$sp_status' WHERE sp_pid= '$sp_userid'";

         $result = dbQuery($dbConn, $update_sql);

} elseif($tbl == 'spprofile'){
//$update_sql = "I spbuiseness_files SET status='$sp_status' WHERE sp_pid= '$sp_userid'";
$update_sql = "INSERT INTO spbuiseness_files (sp_pid, sp_uid, Business_Name, Address, Country , State , City , Profiles , upload_bills , bswebsite , counts , status , reject_reason) VALUES ('$sp_userid','$spuid',' ',' ',' ', ' ', ' ', ' ', ' ', ' ', ' ', '$sp_status', ' ')";


 $result = dbQuery($dbConn, $update_sql);  
}
 

        

        ?>