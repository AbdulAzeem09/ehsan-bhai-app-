<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _album;
	$id = 0;
	if(isset($_POST["idspPostingAlbum"]))
		 $id = $p->update( $_POST, "WHERE t.idspPostingAlbum =" . $_POST["idspPostingAlbum"]);
	else
		$id = $p->create($_POST);
		
	echo $id;
	
?>