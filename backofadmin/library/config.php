<?php
  
	//error_reporting(E_ALL);
	// start the session
	@session_start();
	// database connection config
	//For localhost

  	$env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
	
	//access variables from env 
	$dbHost = $env["DB_HOST"];
	$dbUser = $env["DB_USER"];
	$dbPass = $env["DB_PASS"];
	$dbName = $env["DB_NAME"];
	
	$dbConn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die(mysqli_error());
	
	define('THEME', "/xpert"); //For root use "/"
	// setting up the web root and server root for
	$thisFile = str_replace('\\', '/', __FILE__);
	$docRoot = $_SERVER['DOCUMENT_ROOT'];
	$webRoot  = str_replace(array($_SERVER['HTTP_HOST'], 'library/config.php'), '', $thisFile);
	$srvRoot  = str_replace('library/config.php', '', $thisFile);
	define('WEB_DIR', "/"); //For root use "/"
	define('WEB_DIR_ADMIN', "backofadmin/"); //For admin "/"

	// Web Path
	define('WEB_ROOT', "https://" . $_SERVER['HTTP_HOST'] . WEB_DIR);

	//Admin Path
	define('WEB_ROOT_ADMIN', "https://" . $_SERVER['HTTP_HOST'] . WEB_DIR . WEB_DIR_ADMIN);

	//Template Paths
	define('WEB_ROOT_TEMPLATE', "https://" . $_SERVER['HTTP_HOST'] . WEB_DIR . WEB_DIR_ADMIN . "template". THEME);

	//Absolute Path
	define('ABS_PATH', $docRoot . WEB_DIR);
	define('SRV_ROOT', $srvRoot);

	define('THEME_PATH', SRV_ROOT . "template" . THEME);
	
	// We need to limit the product image height?
	define('LIMIT_PRODUCT_WIDTH',   true);
	define('LIMIT_PRODUCT_HEIGHT',   true);
	
	define('THUMBNAIL_WIDTH', true);
	define('THUMBNAIL_HEIGHT', true);

	if(!defined('SECRET_KEY')){
		define('SECRET_KEY', $env["SECRET_KEY"]);
	}
	if(!defined('PUBLIC_KEY')){
		define('PUBLIC_KEY', $env["PUBLIC_KEY"]);
	}
	
	define('CARD_PASSWORD', $env['CARD_PASSWORD']);
	
	require_once 'database.php';
	require_once 'common.php';

?>
