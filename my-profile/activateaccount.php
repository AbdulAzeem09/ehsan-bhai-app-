<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;
	$p->activate($_POST["profileid"]);

	$sp = new _postings;
	$sp->profilePostActive($_POST['profileid']);
?>