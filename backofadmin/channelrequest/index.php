<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();
	//checkUserPermission()  ?view=detail;

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	switch ($view) {





		case 'editchannel' :
			$content = 'channel_edit.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;

		case 'channellist' :
			$content = 'channel_list.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
			case 'channelabout' :
			$content = 'aboutus.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">'; 
			break;
			
			case 'Announcement' :
			$content = 'Announcement.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;
			
			case 'addAnnouncement' :
			$content = 'addAnnouncement.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			case 'editAnnouncement' :
			$content = 'editAnnouncement.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			case 'delAnnouncement' :
			$content = 'delAnnouncement.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
			
			case 'worldnewsn' :
			$content = 'worldnews.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;  
			
			case 'worldnewsns' : 
			$content = 'worldnews1.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;  

          case 'addchannels' : 
			$content = 'addchannels.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break;  


          case 'editech' : 
			$content = 'editch.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
			break; 
            			
			
		case 'storelist' :
			$content = 'storelist.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
		case 'block' :
			$content = 'block.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
			
			case 'deletechannels' :
			$content = 'deletechannels.php';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
			
			case 'storeWallet' :
			$content = 'Walletstore/';
			$pageTitle = 'Post Detail';
			$icon = '<img src="../images/add-file.jpg">';
			break;	
			
		default :
			$content = 'channel_list.php';
			$pageTitle = 'Posting List';
			$icon = '<img src="../images/icon-list.jpg">';
	
	}

	$script    = array('allmodule.js');

	require_once THEME_PATH . '/template.php';;
?>