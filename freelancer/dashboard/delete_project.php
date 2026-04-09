<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelancerposting;
  /// print_r($_POST);
	$id = $fc->remove($_GET['post_id']);
//echo $fc->ta->sql;



    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/draft.php";
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


