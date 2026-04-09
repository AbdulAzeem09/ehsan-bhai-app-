<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("../../univ/baseurl.php");
include_once "../../helpers/common.php";
session_start();

function sp_autoloader($class) {
  include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$number = $_POST['phone_no'];


$u = new _spuser;
//print_r($_SESSION);
$userid=$_SESSION['uid'];
$res_1 = $u->phone($userid);
if($res_1){
  $row = mysqli_fetch_assoc($res_1);
}



$otp = $_POST['otp'];
$_SESSION["bank_otp"] = $otp;

$txt = 'The SharePage phone verification code  is  ' . $otp . ' . Do not share this code with anyone.';
callSmsApi($number, $txt);


?>
