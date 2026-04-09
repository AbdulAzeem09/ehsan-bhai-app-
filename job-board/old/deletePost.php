<?php

	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _postings;
	if(isset($_GET["postid"])) {
		$p->remove($_GET["postid"]);
	}
	
	header("location:".$BaseUrl.'/job-board/manage-jobs.php');
?>