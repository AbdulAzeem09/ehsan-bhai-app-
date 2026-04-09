<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;
	echo $p->plist($_GET["term"],$_GET["ptid"],$_GET["uid"]);
?>