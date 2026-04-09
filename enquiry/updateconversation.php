<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pl = new _conversation;
	$res = $pl->updateConversation($_POST["mid"],$_POST["receiver"]);
	
?>