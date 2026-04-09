<?php 
session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
		$g = new _spgroup;
		$g->deletefreelancer($_POST["profileid"],$_POST["groupid"]);
		echo $g->tad->sql;
?>