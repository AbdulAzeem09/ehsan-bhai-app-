<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelancerposting;
    //print_r($_GET);
	$fc->updatecompletestatus($_GET['postid'],$_GET['status']);
//echo $fc->ta->sql;



	
//echo $fc->ta->sql;

	
    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/project-bid.php?postid=".$_GET['postid'];
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


