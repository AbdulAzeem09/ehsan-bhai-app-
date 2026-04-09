<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$accept = new _spprofilehasprofile;
	$accept->accept($_POST['sender'] , $_POST['receiver']);	
?>
