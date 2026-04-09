<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	switch ($view) {
		case 'groupevent' :
			$content = 'groupevent.php';
			$pageTitle = 'groupBookings';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
	/*	case 'detail' :			
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
*/
		default :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('registereduser.js');

	require_once THEME_PATH . '/template.php';
?>