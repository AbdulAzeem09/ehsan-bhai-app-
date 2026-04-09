<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

	$p = new _album;
	$p->update( $_POST, "WHERE t.idspPostingAlbum =" . $_POST["idspPostingAlbum"]);
	
?>