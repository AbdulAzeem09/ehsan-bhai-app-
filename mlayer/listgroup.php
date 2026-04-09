<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$c = new _spgroup;
	/*if(isset($_GET["pid"]))
		echo $c->mygrouplist($_GET["term"],$_GET["pid"]);
	else
		echo $c->grouplist($_GET["term"]);*/
	
	echo $c->mygrouplist($_GET["term"],$_SESSION["uid"],$_SESSION["pid"]);
	
?>