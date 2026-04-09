<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
    
	switch ($view) {
		case 'event_categories' :
			$content = 'event_categories.php';
			$pageTitle = 'Events Categories';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
		case 'add' :
			$content = 'add_event_category.php';
			$pageTitle = 'Add Event Category';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
		case 'modify' :
			$content 	= 'modify_event_category.php';
			$pageTitle 	= 'Modify Event Category';
			$icon		=  '<img src="../images/add-file.jpg">';		
			break;	
		default :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('registereduser.js');

	require_once THEME_PATH . '/template.php';
?>