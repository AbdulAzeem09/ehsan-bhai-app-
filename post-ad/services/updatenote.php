<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$p = new _classified;
	$p->updateNotes($_POST["postingNotes"], $_POST["postid"]);
	//echo $p->ta->sql;

?>
