<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
             $content 	= 'report.php';
			$pageTitle 	= 'Report';
			$activeTabnew = 83;
?>
	
	
<?php		
	$script    = array('content.js');

	require_once THEME_PATH . '/template.php';;
?>