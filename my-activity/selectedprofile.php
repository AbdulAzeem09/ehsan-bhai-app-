<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _sppost_has_spprofile;
	$p->selectresume($_POST["resumeid"], $_POST["postid"] ,$_POST["profileid"]);
?>