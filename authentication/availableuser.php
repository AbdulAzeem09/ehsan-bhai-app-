<?php	
function sp_autoloader($class)
{	
	include '../mlayer/' . $class . '.class.php';	
	}	
	spl_autoload_register("sp_autoloader");
	$u = new _spuser;	
	echo trim($u->useravailable($_GET["uname"]));
	
	?> 