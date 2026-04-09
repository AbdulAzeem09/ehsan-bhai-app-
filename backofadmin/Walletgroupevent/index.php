<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission()  ?view=detail;

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	switch ($view) {

		case 'groupeventlist' :
			$content = 'groupeventlist.php';
			$pageTitle = 'group Event List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
		
			
		default :
			$content = 'list.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('allmodule.js');

	require_once THEME_PATH . '/template.php';;
?>