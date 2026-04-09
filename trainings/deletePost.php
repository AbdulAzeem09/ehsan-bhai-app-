<?php

	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _postings;
	if(isset($_GET["postid"])) {
		$p->remove_training($_GET["postid"]);
	}
	$re = new _redirect;
    $redirctUrl = $BaseUrl.'/trainings/dashboard/pending.php';
    $re->redirect($redirctUrl);
	// header("location:".$BaseUrl.'/music/mysongs.php');
?>