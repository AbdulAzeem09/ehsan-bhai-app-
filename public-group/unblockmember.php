<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$r = new _spgroup;	
	$r->unblockMember($_POST["gid"] , $_POST["pid"]);
?>