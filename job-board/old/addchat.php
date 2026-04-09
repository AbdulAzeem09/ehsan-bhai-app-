<?php
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
    $pc = new _post_chat;
	$pc->create($_POST);
    
    header('location:inbox.php');
    
?>


