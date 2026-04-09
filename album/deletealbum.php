<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _album;
	if(isset($_GET["albumid"])) {
		$p->removeAlbum($_GET["albumid"]);
	}
  	if($p){
  		$re = new _redirect;
  		$re->redirect("../");
      	//header("Location:../");
  	}
?>