<?php
include('../../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
	include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;
$p = new _spAllStoreForm;
$re = new _redirect;
$redirctUrl = $BaseUrl . "/dashboard/vault/pin.php";
$redirctUrl2 = $BaseUrl . "/dashboard/sticky-pin/?action=update";
if (isset($_POST['btnCreatePin'])) {
	$txtPinActive = $_POST['txtPinActive'];
	$txtPin = $_POST['txtPin'];
	$txtConfirmPin = $_POST['txtConfirmPin'];
	$txtOtp = $_POST['txtOtp'];
	$txtClue = $_POST['txtClue'];
	$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:$_POST['pid'];


	if ($txtPin == $txtConfirmPin) {

		
 
			//$p->updatesticypin($txtPin, $pid, $txtClue);
			$p->btnCreatePinsticky($txtPin, $pid, $txtClue);
			
			//echo $p->snp->sql;
			$_SESSION['count'] = 0;
			$_SESSION['pinmsg'] = 1;
			$_SESSION['msg'] = "You pin is successfully created.";
			//$re->redirect($redirctUrl);
			$redirctUrl = $BaseUrl ."/dashboard/vault/pin.php";
			$re->redirect($redirctUrl);

			unset($_SESSION['spstickyOtp']);

		// } else {
		// 	$_SESSION['count'] = 0;
		// 	$_SESSION['pinmsg'] = 0;
		// 	$_SESSION['msg'] = "You have entered wrong pin.";

		// 	$re->redirect($redirctUrl2);
		// 	echo $BaseUrl . "/dashboard/sticky-pin/?action=update";
		// }
	} 
	
	
	else {
		$_SESSION['count'] = 0;
		$_SESSION['pinmsg'] = 0;
		$_SESSION['msg'] = "Your pin does not match";
		$re->redirect($redirctUrl);
	}
} else {
	$_SESSION['count'] = 0;
	$_SESSION['pinmsg'] = 0;
	$_SESSION['msg'] = "You have entered wrong path.";
	$re->redirect($redirctUrl);
}
