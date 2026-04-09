<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$rej = new _spprofilehasprofile;
	$rej->reject($_POST['sender'] , $_POST['receiver']);
?>
