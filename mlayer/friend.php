<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$c = new _friendstore;
	echo $c->friend();
?>	
	

