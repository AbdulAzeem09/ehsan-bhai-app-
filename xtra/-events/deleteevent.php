<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _postings;
	if(isset($_POST["postid"])) {
		$p->remove($_POST["postid"]);
	}
	
	
	//http://sp.localhost/my-posts/?flag&viewdraft=check
?>