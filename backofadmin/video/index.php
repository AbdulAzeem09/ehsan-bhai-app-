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
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		case 'paid_video' :
			$content = 'paid_video.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;	
			
		case 'free_video' :
			$content = 'free_video.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		case 'all_videos' :
			$content = 'all_videos.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		case 'detail' :
			$content = 'detail.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'block' :
			$content = 'block.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
			
		default :
			$content = 'list.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('allmodule.js');

	require_once THEME_PATH . '/template.php';;
?>