<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spgroup;
	$id = 0;
	if(isset($_POST["idspGroup"]))
		$id = $p->update( $_POST, "WHERE t.idspGroup =" . $_POST["idspGroup"]);
	else
		$id = $p->create($_POST, $_POST["pid_"]);
	
	echo $id;
?>