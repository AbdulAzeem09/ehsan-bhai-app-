<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _bookRoom;
	if ($_POST['txtDiscount'] > 0) {
		$bokId = $_POST['txtBokId'];
		$spDiscountPrice = $_POST['txtDiscountPrice'];
		$spDiscountPer = $_POST['txtDiscount'];

		$p->updateDiscount($bokId, $spDiscountPrice, $spDiscountPer);
	}
	
	$re = new _redirect;
	$re->redirect("../real-estate/booking.php");
	
?>