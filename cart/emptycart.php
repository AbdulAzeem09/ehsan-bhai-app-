<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$od = new _spcustomers_basket;

	$buyoid = $_POST['buyerprofileid'];

	$od->emptyCart($buyoid);
	
?>