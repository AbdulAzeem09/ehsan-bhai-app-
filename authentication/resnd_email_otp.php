<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include('../univ/baseurl.php');

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$u = new _spuser;


$u->resend_email_otp();
header("location:$BaseUrl/verifyemail.php?resend=resend");
?>