<?php
session_start();


include("../univ/baseurl.php");
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/common.php";

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

require __DIR__ . '/vendor/autoload.php';



$u = new _spuser;
//print_r($_SESSION);
$userid=$_SESSION['uid'];
$res_1 = $u->phone($userid);
if($res_1){
  $row = mysqli_fetch_assoc($res_1);
  $spUserPhone = $row['phone_code']. $row['spUserPhone'];

  $otp=rand(10000,99999);
  $_SESSION["phone_otp_setting2"] = $otp;

  $txt = 'The SharePage phone verification code  is  '.$otp.'.Do not share this code with anyone.';
  callSmsApi($spUserPhone, $txt);

  echo 1;
}
else{
  echo 0;
}
