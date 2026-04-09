<?php

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
session_start();
	spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	
	$pl = new _postenquiry;
	$em = new _email;
	//print_r($_POST);die('kkkkkkkkkkk');
	$txtemail = $_POST['txtemail'];
	$txtlink  = $_POST['txtlink']; 
	$arr = explode(',',$txtemail);
	//echo $txtlink; die("----------");

	$headers = "From: the-share-page <admin@the-share-page.com> \r\n";
	$msg = "Hi,<br>You are receiving this mail because the user shared property with  you.\r\n\r\n"."";

	//$msg .= "See111111 More Details click on link ".$txtlink."/\r\n";
	//echo $msg; die("------");
     foreach($arr as $ar){
	$em->mail_property($ar,$_SESSION['login_user'],$txtlink);
	 }
	$re = new _redirect;
	$re->redirect($txtlink);
	//header('location:'.$txtlink);
?>