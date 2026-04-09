<?php

function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _postingalbum;
	$txtGroupId = $_POST["txtGroupId"];
	$txtFolderId = $_POST["txtFolderId"];
	$txtFolderTitle = $_POST["txtFolderTitle"];

	
	$p->update_folder_title($txtGroupId , $txtFolderId, $txtFolderTitle);
	
	

?>