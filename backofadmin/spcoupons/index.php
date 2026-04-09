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
	  
	  case 'add_coupons' :
	    $content 	= 'addCoupons.php';
	    $pageTitle 	= 'Setting';
	    $icon		=  '<img src="../images/add-file.jpg">';
	  break;
	  
	  case 'edit_coupons' :
	    $content 	= 'editCoupons.php';
	    $pageTitle 	= 'Setting';
	    $icon		=  '<img src="../images/add-file.jpg">';
	    
	  break;
	  
	  case 'delete_coupons' :
	    $content 	= 'deleteCoupons.php';
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
