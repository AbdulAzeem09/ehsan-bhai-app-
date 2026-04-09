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
		
		case 'add' :
			$content 	= 'add.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;		

			case 'del_pack' :
				$content 	= 'delete_pack.php';
				$pageTitle 	= 'Add';
				$icon		=  '<img src="../images/add-file.jpg">';
			
				break;	
				case 'delete_blog' :
					$content 	= 'delete_spblog.php';
					$pageTitle 	= 'Add';
					$icon		=  '<img src="../images/add-file.jpg">';
				
					break;

		case 'update' :
			$content 	= 'update_pack.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
				
			break;	
				
			case 'update_blog' :
				$content 	= 'update_spblog.php';
				$pageTitle 	= 'Add';
				$icon		=  '<img src="../images/add-file.jpg">';
					
				break;	
		case 'modify' :
			$content 	= 'modify.php';
			$pageTitle 	= 'Modify';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
		case 'package' :
			$content 	= 'package.php';
			$pageTitle 	= 'Modify';
			$icon		=  '<img src="../images/add-file.jpg">';
			
			break;
			case 'sp_blog' :
				$content 	= 'sp_blog.php';
				$pageTitle 	= 'Modify';
				$icon		=  '<img src="../images/add-file.jpg">';
				
				break;
		case 'purchase' :
				$content 	= 'purchase.php';
				$pageTitle 	= 'Modify';
				$icon		=  '<img src="../images/add-file.jpg">';
				
				break;	
			
		default :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}

	$script    = array('allnode.js');

	require_once THEME_PATH . '/template.php';
?>