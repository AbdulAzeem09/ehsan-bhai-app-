<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	$fc = new _freelance_recomndation;
	$fc->create($_POST);

	$re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/complete.php";
	if(!isset($_SESSION['uid'])){
        $re->redirect($location);
	}

	// header('location:archive-project.php');
?>