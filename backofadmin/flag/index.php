<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	
	//echo "hello";
	
	switch ($view) {
		case 'list' :
			$content 	= 'list.php';
			$pageTitle 	= 'List';
			$icon		=  '<img src="../images/icon-list.jpg">';
			break;
		
		case 'detail' :
			$content 	= 'detail.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;		
			
		case 'modify' :
			$content 	= 'modify.php';
			$pageTitle 	= 'Modify';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;

		case 'flaguser' :
			$content 	= 'flaguser.php';
			$pageTitle 	= 'Flag User';
			$icon 		=  '<img src="../images/add-file.jpg">';
			break;

		case 'userpost' :
			$content 	= 'userpost.php';
			$pageTitle 	= 'Flag User';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;

		case 'flagtimelinepost' :
			$content 	= 'flagtimelinepost.php';
			$pageTitle 	= 'Flag Post';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;	

		case 'postdetail' :
			$content 	= 'postdetail.php';
			$pageTitle 	= 'Flag Post';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;	
			
			case 'business' :
			$content 	= 'business_flag.php';
			$pageTitle 	= 'Flag Post';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;
			
		default :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}

	$script    = array('flag.js');

	require_once THEME_PATH . '/template.php';;
?>