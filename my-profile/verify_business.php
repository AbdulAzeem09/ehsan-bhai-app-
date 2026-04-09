<?php
error_reporting(E_ALL);
session_start();
require_once("../backofadmin/library/config.php");
$sp_pid = $_SESSION['pid'];
$sp_uid = $_SESSION['uid'];
$sprecord = "select * from spbuiseness_files where sp_pid='$sp_pid' and sp_uid='$sp_uid' order by id desc limit 1 ";      
$allrecord = mysqli_query($dbConn, $sprecord);
if(mysqli_num_rows($allrecord)){
    $spresult = mysqli_fetch_array($allrecord);
    $code = $spresult['direct_verification_code'];
    if($code==$_POST['verification_code']){
        $update_sql = " update spbuiseness_files set status = '2' where sp_pid = '".$sp_pid."' and sp_uid = '".$sp_uid."'";
        $result = dbQuery($dbConn, $update_sql);
        $error   = false;
        $message = 'Provide verified successfully! Redirecting to updated profile..';
    }else{
        $error   = true;
        $message = 'Invalid code. Please contact support!';
    }
}else{
    $error   = true;
    $message = 'Invalid code. Please contact support!';
} 

echo  json_encode(['error'=>$error,'message'=>$message]);