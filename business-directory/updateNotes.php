<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$pl = new _favouriteBusiness;


	$pl->updateNotes($_POST['notes'], $_POST['idspFavbus']);
	
	$re = new _redirect;
    $redirctUrl = "resource.php";
    $re->redirect($redirctUrl);
	
	
?>