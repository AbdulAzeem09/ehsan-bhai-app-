<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$m = new _spgroupmessage;
	$m->rejectMessage($_POST['messageid']);
	echo "Successfully Approved";

?>
