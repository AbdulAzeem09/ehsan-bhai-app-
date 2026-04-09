<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	switch ($view) {
		case 'list' :
			$content = 'list.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
			break;			
         
		 
		 case 'freelancer' :
			$content = 'freelancer.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			 case 'jobboard' :
			$content = 'jobboard.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			case 'event' :
			$content = 'event.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			case 'realestate' :
			$content = 'realestate.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
		default :
			$content = 'list.php';
			$pageTitle = 'Store Statistic';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('admin.js');

	require_once THEME_PATH . '/template.php';;
?>