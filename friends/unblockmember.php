<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$u = new _spprofilehasprofile;
	$u->unblockMember($_POST['profileid'] , $_SESSION['uid']);
?>
