<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelancerposting;
  /// print_r($_POST);
	$id = $fc->removeexpire($_GET['postexpireid']);
//echo $fc->ta->sql;



    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/expire.php";
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


