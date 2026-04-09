<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$cn = new _spprofiles; 
	$cn->delete_gall($_GET["id"]);   
	//echo $m->ta->sql;
	$re = new _redirect;
    $redirctUrl = "../business-directory/manage_album.php";    
    $re->redirect($redirctUrl);
	//header('location:news.php');
?>