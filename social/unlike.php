<?php
		function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
	$ul = new _postlike;
	$ul->unlike( $_POST["postid"],$_POST["pid"]);
?>