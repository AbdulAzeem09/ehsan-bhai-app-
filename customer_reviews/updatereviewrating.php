<?php
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$r = new _sppostreview;
		$result = $r->read($_POST["postid"] , $_POST["profileid"]);
		if($result != false)
		{
			$r->updaterate($_POST["postid"],$_POST["profileid"],$_POST["rate"]);
		}
?>