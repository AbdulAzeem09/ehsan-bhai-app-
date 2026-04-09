<?php
	error_reporting(E_ALL);
ini_set('display_errors', 1);
		session_start();
include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';  
	}
	spl_autoload_register("sp_autoloader");
	
	$pb = new  _spbusiness_profile;
	$media = new _postingalbum;
	$p = new _spprofiles;
	$pf = new  _spfreelancer_profile;
	$ps = new  _spprofessional_profile;
	$em = new _spemployment_profile;
	$fm = new _spfamily_profile;
	
	$u = new _spuser; 
	
	
	
	if(isset($_GET['action']) =='delexp'){ 
			$postid = $_GET['postid'];
			$em->removeexperience($postid);
			//header('location: https://dev.thesharepage.com/my-profile/ ');
			header('location: /my-profile/');

	//die;
		}
	