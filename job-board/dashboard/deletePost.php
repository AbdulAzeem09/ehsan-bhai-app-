<?php

	include('../../univ/baseurl.php');
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _jobpostings;

	//print_r($_GET["postid"]);
	if(isset($_GET["postid"])) {
		$p->trashpost((int)$_GET['postid']);
	}
	if(isset($_GET["postid"])) {
	  $p->trashposts((int)$_GET["postid"]);
	}  
  
	
	$re = new _redirect;
	$location = $BaseUrl.'/job-board/dashboard/active-post.php';
	$re->redirect($location);
	
?>
