<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$createby = $_POST['createby'];

$u = new _spuser;
$p = new _spAllStoreForm;
$sms = new _sms;
$pro = new _spprofiles;
$em = new _email;

//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
$size = 6;
$alpha_key = '';
$keys = range('A', 'Z');
for ($i = 0; $i < 2; $i++) {
    $alpha_key .= $keys[array_rand($keys)];
}
$length = $size - 2;
$key = '';
$keys = range(0, 9);
for ($i = 0; $i < $length; $i++) {
    $key .= $keys[array_rand($keys)];
}
$randCode = $alpha_key . $key;
$_SESSION['code'] = $randCode;
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END

if ($createby == "SMS") {

    // $userId = $_SESSION['uid'];
    // $pid = $_SESSION['pid'];

    // //$result = $pro->read($pid);
    // $result = $u->read($userId);
    // //echo $u->ta->sql;
    // if ($result) {

    //     $row = mysqli_fetch_assoc($result);
    //     $mobileNumber = $row['spUserCountryCode'] . $row['spUserPhone'];


    //     // chek already create or not
    //     $result = $p->chekOtp($pid);
    //     if ($result) {

    //         // already created ha then update the new code ????
    //         $p->updateotp($pid, $randCode);
    //         //$codeSend = $row['spstickyOtp'];
    //     } else {
    //         // if not created first time created
    //         $p->generateotp($pid, $randCode, $createby);
    //         //$codeSend = $randCode;
    //     }

    //     $message = "Warning! Do not share your OTP with anyone. If you have not requested an OTP please contact The SharePage. Your OTP is " . urlencode($randCode);
    //     $sms->send_any_sms($mobileNumber, $message);

    //     // ===========END==========
    // }
    // $_SESSION['vcode'] = urlencode($randCode);
} else {
    // SEND BY EMAIL
    $userId = $_SESSION['uid'];
    $result = $u->read($userId);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $userEmail = $row['spUserEmail'];

        $pid1 = $_SESSION['pid'];
        $result1 = $u->read_pro($pid1);
        $row1 = mysqli_fetch_assoc($result1);
        $userName = $row1['spProfileName'];
        //echo $userName;
        //die('======');

        //$userName = $row['spUserName'];
        $pid = $_SESSION['pid'];

        // chek already create or not
        // $result = $p->chekOtp($pid);
        // if ($result) {
        //     // already created ha then ????
        //     $row = mysqli_fetch_assoc($result);
        //     $codeSend = $row['spstickyOtp'];
        // } else {
        //     // if not created first time created

        //     $p->generateotp($pid, $randCode, $createby);
        //     $codeSend = $randCode;
        // }


        // write code here of email
        // ===========SEND EMAIL==============
        $headers = "From: TheSharePage <no-reply@thesharepage.com> \r\n";
        $msg = "Dear " . $userName . ",\r\n\r\n" . "Your code for Vault note is " . $randCode . "\r\n\r\n";
        $em->send_all_email($userEmail, $headers, $msg);
        //$msg .= "Thank you,\r\nMembers' Team\r\n https://youtu.be/nL95-RgbFc4 \r\n+91 93 429 72000";
        /*if(mail($userEmail, "The SharePage,.", $msg, $headers)){
				
			}*/
        // ==============END=================

    }
    echo $randCode;
}
