<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader"); 
	$u = new _spuser;
	//  $email= trim($_GET["uemail"]);
	 echo $u->emailavailablecheck(trim($_GET["uemail"]));
?> 