<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On'); 
include('univ/baseurl.php');

function sp_autoloader($class)
{
	include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$s = new _spuser;
$em = new _email;
$res = $s->checkemail($_SESSION['emailsend']);

if($res){
    $redata = mysqli_fetch_assoc($res);
    $name =  $redata['spUserFirstName'];
    $userid = $redata['idspUser'];
    $subject = "The SharePage Login [code]";

    

  $em->login_emailotp($_SESSION['emailsend'], $_SESSION['solidotp'],$name,$subject);

  //$_SESSION['loginotp'] = $random;
 // $_SESSION['emailsend'] = $_POST['spfregemail'];
  $_SESSION['loginotpuser'] = $userid;

  $_SESSION['resend'] = 'yes';
  header("Location: $BaseUrl/enter-OTP.php"); 
    

}




?>