<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

include '../univ/baseurl.php';

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u          = new _spuser;
$re         = new _redirect;
$redirctUrl = $BaseUrl . "/sign-up.php";

if(isset($_POST['respUserEphone'])) {
$uid = $_SESSION['chkuid'];

echo $u->verifyMobileOtp($_POST, $uid);

$res = $u->loginverifycode($uid);
$row = mysqli_fetch_assoc($res);

//$code = $_POST["vcode"];
//$datacode = $row["phone_verify_code"];


$e = new _email;
$au_email = $row["spUserEmail"];
$au_username =$row["spUserName"];
$au_me =$row["idspUser"];
$e->send_welcome_email($au_email,$au_username,$au_me,'');

}   
