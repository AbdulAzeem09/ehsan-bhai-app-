<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	//spProfileTypes_idspProfileTypesid,spGroup_idspGroup
	$g = new _spgroup;
	$id = 0;
	$id = $g->addmember($_POST);
	echo $id;
?>