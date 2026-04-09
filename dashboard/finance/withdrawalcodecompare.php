<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
require_once "../../common.php";

$smsOTP = isset($_POST['smsOTP']) ? $_POST['smsOTP'] : "";
$emailOTP = isset($_POST['smsOTP']) ? $_POST['emailOTP'] : "";

if(!$smsOTP || !$emailOTP){
  response(0, "Invalid inputs");
}

if($_SESSION['withdraw_otp_failure_count'] > 5){
  response(0, "Your retry count exceeded");
}

if ($smsOTP == $_SESSION['sms_otp'] && $emailOTP == $_SESSION['email_otp']) {
  unset($_SESSION['email_otp'], $_SESSION['sms_otp']);
  $_SESSION['withdraw_otp_success'] = 1;
  
  insertQ("UPDATE spuser SET withdraw_smsotp = NULL, withdraw_emailotp = NULL WHERE idspUser = ?", "i", [$_SESSION['uid']]);
  
  response(1, 'OTP validation successful');

}

else {
  if(!isset($_SESSION['withdraw_otp_failure_count'])){
    $_SESSION['withdraw_otp_failure_count'] = 0;
  }
  $_SESSION['withdraw_otp_failure_count'] = $_SESSION['withdraw_otp_failure_count']+1;

  response(0, "Not matching");
}

?>

