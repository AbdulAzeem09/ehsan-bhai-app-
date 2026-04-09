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
   $activeTabnew = 700;
   $icon		=  '<img src="../images/icon-list.jpg">';
   break;
   
   case 'addnewsletter' :
   $content = 'addnewsletter.php';
   $pageTitle = 'User / Admin List';
   $activeTabnew = 700;
   $icon = '<img src="../images/icon-list.jpg">';
   break;
   case 'editnewsletter':
   $content = 'editnewsletter.php';
   $pageTitle = 'User / Admin List';
   $activeTabnew = 700;
   $icon = '<img src="../images/icon-list.jpg">';
   break;
   case 'sendnewsletter':
   $content = 'sendnewsletter.php';
   $pageTitle = 'User / Admin List';
   $activeTabnew = 700;
   $icon = '<img src="../images/icon-list.jpg">';
   break;
   
   
   case 'add' :
   $content 	= 'add.php';
   $pageTitle 	= 'Add';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   
   break;		
   
   case 'modify' :
   $content 	= 'modify.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   
   break;
   
   case 'newsletter_view_details' :
   $content 	= 'newsletter_view_details.php';
   $pageTitle 	= 'Newsletter history details';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   
   break;
   
   case 'list_view_count' :
   $content 	= 'list_view_count.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   break;
   
    
   
   case 'unsubscribe_list' :
   $content 	= 'subscribe_list.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   break;
   
   case 'aikeys' :
   $content 	= 'aikeys.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   break;
   
   
   
   case 'history' :
   $content 	= 'news_letter_history.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   break;
   
   case 'newsletter_view' :
   $content 	= 'news_letter_view.php';
   $pageTitle 	= 'Modify';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/add-file.jpg">';
   
   break;
   
   
   default :
   $content 	= 'list.php';
   $pageTitle 	= 'List';
   $activeTabnew = 700;
   $icon		=  '<img src="../images/icon-list.jpg">';
   }
   
   $script    = array('profileType.js');
   
   require_once THEME_PATH . '/template.php';;
   ?>