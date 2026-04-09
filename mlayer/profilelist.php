<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;
	echo $p->profilelist($_GET["term"],$_SESSION["uid"]);
?>