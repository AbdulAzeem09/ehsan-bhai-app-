<?php
session_start();
 error_reporting(E_ALL);
 ini_set('display_errors', 'On'); 
include('../univ/baseurl.php');
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/common.php";

function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;
$em = new _email;


$phone = $_POST['spfregemail'];
if (str_contains($_POST['spfregemail'], '@')) { 
$res = $u->checkemail($_POST['spfregemail']);


if($res){
$redata = mysqli_fetch_assoc($res);
$name =  $redata['spUserFirstName'];
$userid = $redata['idspUser'];
$random = rand(100000,999999);
$subject = "The SharePage Login [code]";

if($redata['is_email_verify']==1 && $redata['spUserLock']==0){

$em->login_emailotp($_POST['spfregemail'],$random,$name,$subject);
$_SESSION['loginotp'] = $random;
//

$_SESSION['solidotp'] = $random;

$_SESSION['emailsend'] = $_POST['spfregemail'];
$_SESSION['loginotpuser'] = $userid;
header("Location: $BaseUrl/enter-OTP.php"); 
}else {
$_SESSION['mail_notverify'] = 'yes';
header("Location: $BaseUrl/Login-OTP.php"); 
}

}
else {

$_SESSION['emaillogin'] = 'yes';
header("Location: $BaseUrl/Login-OTP.php"); 
}
//


} else if(is_numeric($phone)){
	$contact_no= $_POST['c_code'].$phone;
//echo $contact_no; die('====');
$phdata = $u->checkphone($contact_no);
if($phdata){
$phonedata = mysqli_fetch_assoc($phdata);
$userid = $phonedata['idspUser'];
//$numberdata = $phonedata['phone_no'];
if($phonedata['is_phone_verify']==1 && $phonedata['spUserLock']==0){
  $spUserPhone = $phonedata['phone_code']. $phonedata['spUserPhone'];
  $otp = rand(100000,999999);

  $txt = 'The SharePage phone verification code  is  '.$otp.'.Do not share this code with anyone.';
  callSmsApi($spUserPhone, $txt);
  
$_SESSION['loginphotp'] = $otp;

$_SESSION['solidphotp'] = $otp;

$_SESSION['phonesend'] = $phone;
// echo   $random;
$_SESSION['loginphotpuser'] = $userid;
header("Location: $BaseUrl/enterphone-OTP.php"); 

} else {
$_SESSION['phone_notverify'] = 'yes';
header("Location: $BaseUrl/Login-OTP.php"); 
}

} else {
$_SESSION['phonelogin'] = 'yes';
header("Location: $BaseUrl/Login-OTP.php"); 
}


} else {

  if($_POST['radio']==1){
$_SESSION['validdataemail'] = 'yes';
}
else {
  $_SESSION['validdata'] = 'yes';
}
header("Location: $BaseUrl/Login-OTP.php"); 

}



?>

