<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$m = new _masterdetails;
	if($_POST["idmasterDetails_"] != null)
	{
		$m->update($_POST["idmasterDetails_"],$_POST["masterDetails"]);
		
	}
	else
	{
		$m->create($_POST);
	}
	header("Location:".$_POST["categoryfolder_"]."");
?>