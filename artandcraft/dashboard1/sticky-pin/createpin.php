<?php
	include('../../univ/baseurl.php');
	session_start();

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	
	$u = new _spuser;
	$p = new _spAllStoreForm;
	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/dashboard/sticky-pin/";


	if (isset($_POST['btnCreatePin'])) {
		$txtPinActive = $_POST['txtPinActive'];
		$txtPin = $_POST['txtPin'];
		$txtConfirmPin = $_POST['txtConfirmPin'];
		$txtOtp = $_POST['txtOtp'];
		$txtClue = $_POST['txtClue'];
		$pid = $_SESSION['pid'];


		if ($txtPin == $txtConfirmPin) {
			
			$result = $p->chekPinisCorect($pid, $txtOtp);
			//echo $p->snp->sql;
			if ($result) {
				// update every thhing
				$p->updatesticypin($txtPin, $pid, $txtClue);
				//echo $p->snp->sql;
				$_SESSION['count'] = 0;
				$_SESSION['msg'] = "You pin is successfully created.";
				$re->redirect($redirctUrl);
			}else{
				$_SESSION['count'] = 0;
				$_SESSION['msg'] = "You have entered wrong pin.";
				$re->redirect($redirctUrl);
			}
		}else{
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Your pin does not match";
			$re->redirect($redirctUrl);
		}
	}else{
		$_SESSION['count'] = 0;
		$_SESSION['msg'] = "You have entered wrong path.";
		$re->redirect($redirctUrl);
	}

?>