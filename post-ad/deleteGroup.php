<?php
	function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");

	$p = new _spgroup;
	if(isset($_GET["groupid"])) {
		$p->removeGroup($_GET["groupid"]);
	}
  if($p)
  {
      header("Location:../");
  }
?>