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
	
	
	
	if(isset($_GET['action']) == "experienceupdate" ){ 
		if(isset($_POST["current_work"])){
        	$current = $_POST["current_work"];
		}else{
			$current = '';
		}
		
//print_r($_POST);  die("---------------");
		$userid =  $_SESSION['uid']; 
		$user_exp= array(
		"jobtitle"=>$_POST["jobtitle"],
		"emptype"=>$_POST["emptype"],
		"company"=>$_POST["company"],
		"country"=>$_POST["spPostingsCountry"],
		"state"=>$_POST["spPostingsState"],
		"city"=>$_POST["spUserCity"],
		// "start_date"=>$_POST["start_date"],
		// "end_date"=>$_POST["end_date"],
		"frommonth"=>$_POST["frommonth"],
		"fromyear"=>$_POST["fromyear"],
		"tomonth"=>$_POST["tomonth"],
		"toyear"=>$_POST["toyear"],
		"description"=>$_POST["description"],
		'spProfileType_idspProfileType'=>$_POST["spProfileType"],
		'current_work'=>$current,
		'idspProfiles'=>$userid
		);
	
	
		$postid=$_POST["postid"];

		$em->updateExp($user_exp, "WHERE t.id =" . $postid); 
			//header('location:https://dev.thesharepage.com/my-profile/ ');
			header('location: /my-profile/');
	
	//die;
	} 
	
	
	