<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission();

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	switch ($view) {
		case 'list' :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
		case 'add' :
			
			$content = 'add.php';
			$pageTitle = 'Add New User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;

		case 'staff' :
		
			$content = 'list_staff.php';
			$pageTitle = 'Add New User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'add_staff' :
	
			$content = 'add_staff.php';
			$pageTitle = 'Add New User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
			case 'delete_staff' :

				$content = 'delete_staff.php';
				$pageTitle = 'Add New User / Admin';
				$icon = '<img src="../images/add-file.jpg">';
				break;	
		case 'staff_edit' :

			$content = 'staff_edit.php';
			$pageTitle = 'Add New User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'modify' :
			
			$content = 'modify.php';
			$pageTitle = 'Modify User / Admin';
			$icon = '<img src="../images/add-file.jpg">';
			break;			

		default :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('admin.js');

	require_once THEME_PATH . '/template.php';;
?>