<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$requirePrefix = "../../";

session_start();
require_once "../../common.php";
require_once "../../helpers/common.php";
require_once "../../mlayer/_email.class.php";


$row = selectQ("SELECT phone_code, spUserPhone FROM spuser WHERE idspUser = ?", "i", [$_SESSION['uid']], "one");
if ($row) {
    if(!isset($_SESSION['withdraw_otp_failure_count'])){
      $_SESSION['withdraw_otp_failure_count'] = 0;
    }

    //sms APi call
    $_SESSION['sms_otp'] = rand(10000, 99999);
    $spUserPhone = $row['phone_code']. $row['spUserPhone'];
    $text = 'Your requested withdrawal. This is your phone verification code: ' . $_SESSION['sms_otp'] . '. Do not share this code with anyone.';
    callSmsApi($spUserPhone, $text);
        
    //Email otp call
    $_SESSION['email_otp'] = rand(10000, 99999);
    $em = new _email;
    $em->withdraw_emailotp($_SESSION['spUserEmail'], $_SESSION['email_otp'], $_SESSION['myprofile'], 'Withdrawal email verification');
    
    insertQ("UPDATE spuser SET withdraw_smsotp = ?, withdraw_emailotp = ? WHERE idspUser = ?", "iss", [$_SESSION['sms_otp'], $_SESSION['email_otp'], $_SESSION['uid']]);

    
    response(1, "success");
    //response(1, "success", [$_SESSION['sms_otp'], $_SESSION['email_otp']]);
}
else{
  response(0, "User not found");
}
?>

