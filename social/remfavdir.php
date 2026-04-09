<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$pl = new _favouriteBusiness;
	$pl->removefavoritDir($_POST['idspProfiles_spProfileCompany'], $_POST['spProfiles_idspProfiles'], $_POST['isfavourite']);
?>