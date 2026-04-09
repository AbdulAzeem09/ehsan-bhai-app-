<?php
	session_start();
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$ul = new _favorites;
	$ul->removefavorites( $_GET["postid"], $_SESSION['uid']);

	$re = new _redirect;
    $redirctUrl = "favourite.php";
    $re->redirect($redirctUrl);
?>