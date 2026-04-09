<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$m = new _spgroup_event;
	$m->remove($_POST["eventId"]);
?>