<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelance_chat_project;
    //print_r($_GET);
	$fc->updatecompletestatus($_GET['postid'],$_GET['status']);
//echo $fc->ta->sql;



	
//echo $fc->ta->sql;

	
    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/freelance_project_detail.php?postid=".$_GET['postid'];
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


