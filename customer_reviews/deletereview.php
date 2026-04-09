<?php
function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$r = new _sppostreview;
		$r->remove($_POST["postid"],$_POST["profieid"],$_POST["reiviewid"]);
?>