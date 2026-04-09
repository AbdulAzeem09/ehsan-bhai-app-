<?php
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
		$g->removeAssistant($_GET["pid"],$_GET["gid"]);
	}
?>