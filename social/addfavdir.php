<?php
	session_start();   
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$pl = new _favouriteBusiness;
	$flag = 0;
	$result = $pl->chkFavAlready($_POST['idspProfiles_spProfileCompany'], $_POST['spProfiles_idspProfiles'], $_POST['isfavourite']);
	if($result == false){
		$pl->addfavbus($_POST);
	} 	
?>