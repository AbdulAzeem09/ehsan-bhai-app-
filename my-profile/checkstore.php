<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$p = new _spprofiles;
		$res = $p->storename($_POST["storename"]);
		if($res != false)
		{
			echo "Try";
		}
?>