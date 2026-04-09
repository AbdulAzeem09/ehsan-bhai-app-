<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _comment;
	$idComment = isset($_POST['idComment']) ? (int) $_POST['idComment'] : 0;
	$p->deletecomment($idComment);
?>
