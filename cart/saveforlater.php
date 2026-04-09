<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$rfc = new _spcustomers_basket;
	$re = new _redirect;

	if (isset($_POST['orderId']) && $_POST['orderId'] > 0) {
		// remove from cart
		$rfc->updatesaveforletter($_POST["orderId"],$_POST["savestatus"]);
	}else{
		$re->redirect($BaseUrl."/cart");
	}
	
?>