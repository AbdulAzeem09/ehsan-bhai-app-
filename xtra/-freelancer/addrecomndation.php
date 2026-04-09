<?php

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	$fc = new _freelance_recomndation;
	$fc->create($_POST);
	header('location:archive-project.php');
?>