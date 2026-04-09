<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	
	switch ($view) {
		case 'list' :
			$content 	= 'list.php';
			$pageTitle 	= 'List';
			$icon		=  '<img src="../images/icon-list.jpg">';
			break;
		
		case 'sale' :
			$content 	= 'sale_comm.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;		
			
		case 'super_vip' :
			$content 	= 'super_vip_com.php';
			$pageTitle 	= 'Edit';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

		case 'settings' :
			$content 	= 'settings.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
			
		default :
				$content 	= 'otp_verification.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}

	$script    = array('custom.js');

	require_once THEME_PATH . '/template.php';;
?>