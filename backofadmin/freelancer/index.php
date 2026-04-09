<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

	checkUser();
	//checkUserPermission(); otp_verify

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	
	switch ($view) {
		case 'list' :
			$content 	= 'list.php';
			$pageTitle 	= 'List';
			$icon		=  '<img src="../images/icon-list.jpg">';
			break;
		

		case 'otp_verify' :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
				break;
	case 'freelancerList' :
		$content 	= 'list.php';
		$pageTitle 	= 'List';
		$icon		=  '<img src="../images/icon-list.jpg">';
		break;
		 case 'email' :
			$content 	= 'email_otp.php';
			$pageTitle 	= 'Add';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;		
			
		case 'edit' :
			$content 	= 'edit.php';
			$pageTitle 	= 'Edit';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

		case 'approve' :
			$content 	= 'approve_pay.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
			case 'bids' :
				$content 	= 'freelancer_bids.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
			
				break;

		case 'category' :
			$content 	= 'category_list.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

		
	case 'StoreCategory' :
		$content 	= 'StoreCategory.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

	case 'AddStoreCategory' :
		$content 	= 'AddStoreCategory.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;
		

	case 'deleteStoreCa' :
		$content 	= 'deleteStoreCa.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;
	case 'EditStoreCa' :
		$content 	= 'EditStoreCa.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

		case 'delete_category' :
			$content 	= 'delete_category.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

		case 'edit_category' :
			$content 	= 'edit_category.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

	case 'business_sale' :
		$content 	= 'business_sale.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;
	
	case 'add_bus_sale' :
		$content 	= 'add_bus_sale.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

	case 'edit_bus_sale' :
		$content 	= 'edit_bus_sale.php';
		$pageTitle 	= 'Setting';
		$icon		=  '<img src="../images/add-file.jpg">';
	
		break;

		case 'delete_bus_sale' :
			$content 	= 'delete_bus_sale.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
	
		case 'add_category' :
			$content 	= 'add_category.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
			
		case 'profeesional_list' :
			$content 	= 'profeesional_list.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;
		case 'add_profeesional' :
			$content 	= 'add_profeesional.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;

		case 'edit_profeesional' :
			$content 	= 'edit_profeesional.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;	
			
		
		case 'delete_profeesional' :
			$content 	= 'delete_profeesional.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;	

		case 'personal_list' :
			$content 	= 'personal_list.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;



		case 'delete_personal' :
			$content 	= 'delete_personal.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;	

		case 'edit_personal' :
			$content 	= 'edit_personal.php';
			$pageTitle 	= 'Setting';
			$icon		=  '<img src="../images/add-file.jpg">';
		
			break;	
			case 'add_personal' :
				$content 	= 'add_personal.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
			
				break;










		default :
				$content 	= 'list.php';
				$pageTitle 	= 'List';
				$icon		=  '<img src="../images/icon-list.jpg">';
	}

	$script    = array('custom.js');

	require_once THEME_PATH . '/template.php';;
?>