<?php

session_start();

include('univ/baseurl.php');
include_once $_SERVER["DOCUMENT_ROOT"]."helpers/main.php";

function sp_autoloader($class)
{
	include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$k = new _spuser;
$em = new _email;
$numbdata = $k->checkphone($_SESSION['phonesend']);
if($numbdata) {
  $redata = mysqli_fetch_assoc($numbdata);
  $userid = $redata['idspUser'];
  $_SESSION['solidphotp'];
  $spUserPhone = $redata['phone_code']. $redata['spUserPhone'];
  $txt = 'The SharePage phone verification code  is  '.$_SESSION['solidphotp'].'.Do not share this code with anyone.';
  callSmsApi($spUserPhone, $txt);
  
  $_SESSION['loginotpuser'] = $userid;

  $_SESSION['phresend'] = 'yes';
  header("Location: $BaseUrl/enterphone-OTP.php"); 
    

}




?>
