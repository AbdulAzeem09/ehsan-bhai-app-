<?php 
	require_once($_SERVER[ 'DOCUMENT_ROOT' ] . "/univ/main.php"); 
	session_start(); 
	$_SESSION['userpage'] = $_SERVER['PHP_SELF'];
	include_once("../authentication/check.php"); 
	include_once("../template.php"); 
?>