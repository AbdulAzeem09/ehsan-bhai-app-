<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	/*print_r($_POST);*/
	$m = new _postingalbum;
	$m->removemedia($_POST["mediaid"]);
	echo $m->ta->sql;
?>