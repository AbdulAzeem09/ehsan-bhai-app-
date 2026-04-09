<?php
session_start();
		function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
 //echo "herecode";

/*	print_r($_POST["postid"]);

    print_r($_POST["pid"]);*/



	$re = new _freelance_favorites;

	
	   
	   
	$re->removefavorites_realstate($_POST["postid"], $_SESSION['uid']);

	
	
?>