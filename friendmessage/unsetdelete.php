<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$m = new _messageactivity;
	$flag = 0;
	$m->deleteactivity($_POST['messageid'] ,$_POST['profileid'] , $flag);
?>
