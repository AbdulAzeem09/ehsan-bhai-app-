
<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
	spl_autoload_register("sp_autoloader");
	$p = new _postfield;
	$p->rejectbid($_POST["postid"],$_POST["profileid"]);
	
	//Delete from activity
	$activity = new  _sppost_has_spprofile;
	$activity->rejectbid($_POST["postid"],$_POST["profileid"]);
?>
