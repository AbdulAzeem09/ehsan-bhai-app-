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
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
		case 'detail' :
			$content = 'detail.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'block' :
			$content = 'block.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	

		case 'ListEvents' :
			$content = 'ListEvents.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	

		case 'FeatureEventPrice' :
			$content = 'FeatureEventPrice.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;
			
		case 'AddEventPrice' :
			$content = 'AddEventPrice.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'DeleteEvent' :
			$content = 'DeleteEvent.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;
			
		case 'EditEvent' :
			$content = 'EditEvent.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;

		default :
			$content = 'list.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('allmodule.js');

	require_once THEME_PATH . '/template.php';;
?>