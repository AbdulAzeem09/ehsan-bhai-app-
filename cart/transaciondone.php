<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _order;
	$p->transactiondone($_POST["orderid"] , $_POST["quantity"] , $_POST["subtotal"],date("Y-m-d") );
?>