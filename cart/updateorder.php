<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spcustomers_basket;
	$p->updateorder($_POST["orderid"] , $_POST["quantity"]);

/*	echo $p->ta->sql;*/
?>