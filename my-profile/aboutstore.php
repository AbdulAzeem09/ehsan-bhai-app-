<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;
	$p->setaboutstore($_POST['spProfileid_'],$_POST["spProfilesAboutStore"]);
	header("Location:../my-profile/");
?>