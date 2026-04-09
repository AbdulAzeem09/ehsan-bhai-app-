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

			
	case 'Freelancer_SubCategory' :
		$content 	= 'Freelancer_SubCategory.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;
		
	case 'ArtSubCategoryDelete' :
		$content 	= 'ArtSubCategoryDelete.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

	case 'ArtSubCategoryEdit' :
		$content 	= 'ArtSubCategoryEdit.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

	case 'Freelancer_Edit' :
		$content 	= 'Freelancer_Edit.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;
	case 'Freelancer_Delete' :
		$content 	= 'Freelancer_Delete.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

	case 'ArtSubCategory' :
		$content 	= 'ArtSubCategory.php';
		$pageTitle 	= 'Modify';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;



		
		case 'add' :
			$content 	= 'add.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;		
			
		case 'modify' :
			$content 	= 'modify.php';
			$pageTitle 	= 'Modify';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

			
		default :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}

	$script    = array('artcategory.js');

	require_once THEME_PATH . '/template.php';;
?>