<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$mem = new _spmembership;
		$mem->update($_POST["mid"], $_POST["mname"], $_POST["mlimit"], $_POST["mduration"], $_POST["mamount"])
?>