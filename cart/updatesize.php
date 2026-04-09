<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _order;
	$p->updatesize($_POST["orderid"] , $_POST["size"]);

	// echo $p->ta->sql;
?>