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

		case 'limited' :
			$content = 'limited.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		default :
			$content = 'list.php';
			$pageTitle = 'User / Admin List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('allmodule.js');

	require_once THEME_PATH . '/template.php';;
?>