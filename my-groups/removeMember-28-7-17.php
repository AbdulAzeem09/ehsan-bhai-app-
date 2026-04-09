<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

	$g = new _spgroup;
	if(isset($_GET["pid"])) {
		$g->removeMember($_GET["pid"],$_GET["gid"]);
	}
?>