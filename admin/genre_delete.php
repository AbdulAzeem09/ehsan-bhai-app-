<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$m = new _genre;
	$re = new _redirect;
	$m->remove($_GET["genre_id"]);
	$redirctUrl = "/admin/genre";
	$_SESSION['err']="Genre Deleted successfully.";
	$re->redirect($redirctUrl);	
?>