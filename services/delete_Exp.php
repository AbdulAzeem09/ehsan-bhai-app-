<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	   $p      = new _classified;
	//$classiFied = new _classified;
	
	
	
		if(isset($_GET["action"])) { 
			$p->remove($_GET["postid"]);
			//echo $p->ta->sql;
		}
	
	
	$re = new _redirect;
    $redirctUrl = "../services/dashboard/index.php";
    $re->redirect($redirctUrl);
?>