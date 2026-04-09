<?php

//print_r($_GET); die("----------");
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

	$g = new _spgroup;
	if(isset($_GET["pid"])) {
                $data = array(
                    'spProfiles_idspProfiles' => $_GET["pid"],
                    'spGroup_idspGroup' => $_GET["gid"],
                );
		$g->makeAssistant($_GET["pid"],$_GET["gid"]);
	}
?>

