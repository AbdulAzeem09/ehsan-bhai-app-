<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
//echo $view;die;
	switch ($view) {
		case 'add' :
			$content = 'add.php';
			$pageTitle = 'User / Add Admin';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
		case 'list' :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		case 'delete_list' :
			$content = 'delete_list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
		case 'detail' :			
			$content = 'detail.php';
			$pageTitle = 'User Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'singleprofile' :
			$content = 'singleprofile.php';
			$pageTitle = 'Detail / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'modify' :
			$content = 'modify.php';
			$pageTitle = 'Modify User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;			
		case 'today' :
			$content = 'today.php';
			$pageTitle = 'Today User / Admin';
			break;
		case 'vemail' :
			$content = 'vemail.php';
			$pageTitle = 'Today User / Admin';
			break;	
		case 'vphone' :
			$content = 'vphone.php';
			$pageTitle = 'Today User / Admin';
			break;	
		case 'block' :
			$content = 'block.php';
			$pageTitle = 'Today User / Admin';
			break;	
	    case 'vaccount'	:
			$content = 'vaccount.php';
			$pageTitle = 'Today User / Admin';
			break;	
			
		case 'referred_user':
			$content = 'referral.php';
			$pageTitle = 'Referral User';
			break;

		case 'referral_list':
			$content = 'referral_list.php';
			$pageTitle = 'Referral User';
			break;	
			
		case 'referral_user_list':
			$content = 'referral_user_list.php';
			$pageTitle = 'Referral User';
			break;	
		
		case 'baccount' :
			$content = 'baccount.php';
			$pageTitle = 'User / Add Admin';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
	
	    case 'deactivated' :
			$content = 'deactivated.php';
			$pageTitle = 'Deactivated User / Add Admin';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		default :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('registereduser.js');

	require_once THEME_PATH . '/template.php';
?>