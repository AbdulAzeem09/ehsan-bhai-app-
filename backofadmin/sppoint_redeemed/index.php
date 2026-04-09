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

			case 'redeem' :
				$content 	= 'list_request.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
			
				break;
				
			case 'retail' :
				$content 	= 'list_retail.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
				break; 

			case 'auction' :
				$content 	= 'list_auction.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
				break;	
			case 'rfq' :
				$content 	= 'list_rfq.php';
				$pageTitle 	= 'Setting';
				$icon		=  '<img src="../images/add-file.jpg">';
				break;
				case 'personal' :
					$content 	= 'list_personal.php';
					$pageTitle 	= 'Setting';
					$icon		=  '<img src="../images/add-file.jpg">';
				
					break;

					case 'wholesale' :
						$content 	= 'list_wholesale.php';
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