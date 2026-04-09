<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
 	$pl = new _postingalbum;
 	$pl->removefolderdel($_POST['id']);
    
?>

