<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$c = new _subcategories;
	echo $c->subcategorylist($_GET["term"], isset($_GET["idspCategory_"]) ? $_GET["idspCategory_"] : "1");
	// echo $c->subcategorylist($_GET["term"]);
?>