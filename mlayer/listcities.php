<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$c = new _cities;
	echo $c->citylist($_GET["term"], isset($_GET["idspCountries_"]) ? $_GET["idspCountries_"] : "1");
	// echo $c->subcategorylist($_GET["term"]);
?>