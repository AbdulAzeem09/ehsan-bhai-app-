<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

	//checkUser();
	//checkUserPermission();

	/*$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	
	switch ($view) {
		case 'list' :
			$content 	= 'list.php';
			$pageTitle 	= 'List';
			$icon		=  '<img src="../images/icon-list.jpg">';
			break;
		
		case 'add' :
			$content 	= 'add.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;		
			
		case 'ban' :
			$content 	= 'ban.php';
			$pageTitle 	= 'Ban';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;

		case 'detail' :
			$content 	= 'detail.php';
			$pageTitle 	= 'Ban';
			$icon		=  '<img src="../images/add-file.jpg">';
			break;
			
		default :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}*/

	//$script    = array('cmpnyNews.js');


				$content 	= 'media.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';    
	require_once THEME_PATH . '/template.php';
?>