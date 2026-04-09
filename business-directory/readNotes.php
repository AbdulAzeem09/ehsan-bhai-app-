<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$pl = new _favouriteBusiness;

	if (isset($_POST['resourceid'])) {
		$res = $pl->readResource($_POST['resourceid']);
		if($res){
			$row = mysqli_fetch_assoc($res);
			echo trim($row['notes']); 
		}
	}	
?>