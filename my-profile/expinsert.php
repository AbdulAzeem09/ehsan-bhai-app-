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

    if(isset($_GET['action']) && $_GET['action'] == 'experience'){		
		$userid =  $_SESSION['uid']; 
		if(isset($_POST["current_work"])){
			$current = $_POST["current_work"];
		}else{
			$current = '';
		}
		$user_exp = array(
			"jobtitle" => isset($_POST["jobtitle"]) ? $_POST["jobtitle"] : "",
			"emptype" => isset($_POST["emptype"]) ? $_POST["emptype"] : "",
			"company" => isset($_POST["company"]) ? $_POST["company"] : "",
			"country" => isset($_POST["spPostingsCountry"]) ? $_POST["spPostingsCountry"] : "",
			"state" => isset($_POST["spPostingsState"]) ? $_POST["spPostingsState"] : "",
			"city" => isset($_POST["spUserCity"]) ? $_POST["spUserCity"] : "",
			"start_date" => isset($_POST["start_date"]) ? $_POST["start_date"] : "",
			"end_date" => isset($_POST["end_date"]) ? $_POST["end_date"] : "",
			"description" => isset($_POST["description"]) ? $_POST["description"] : "",
			'spProfileType_idspProfileType' => isset($_POST["spProfileType"]) ? $_POST["spProfileType"] : "",
			'current_work' => $current,
			'idspProfiles' => $userid,
			'idsp_pid' => isset($_POST["spProfile_pid"]) ? $_POST["spProfile_pid"] : "",
		);
		$id = $em->createEmpexp($user_exp);
		$stack = array();
		array_push($stack, $id);
		$_SESSION['exp_id'] = $stack;
		header('Location: /my-profile/profilefield.php');
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'experience_add_ajax') {		
		$userid =  $_SESSION['uid']; 
		
		$user_exp = array(
			"jobtitle" => isset($_POST["jobtitle"]) ? $_POST["jobtitle"] : "",
			"emptype" => isset($_POST["emptype"]) ? $_POST["emptype"] : "",
			"company" => isset($_POST["company"]) ? $_POST["company"] : "",
			"country" => isset($_POST["spPostingsCountry"]) ? $_POST["spPostingsCountry"] : "",
			"state" => isset($_POST["spPostingsState"]) ? $_POST["spPostingsState"] : "",
			"city" => isset($_POST["spUserCity"]) ? $_POST["spUserCity"] : "",
			"start_date" => isset($_POST["start_date"]) ? $_POST["start_date"] : "",
			"end_date" => isset($_POST["end_date"]) ? $_POST["end_date"] : "",
			"description" => isset($_POST["description"]) ? $_POST["description"] : "",
			'spProfileType_idspProfileType' => isset($_POST["spProfileType"]) ? $_POST["spProfileType"] : "",
			'current_work' =>  isset($_POST["current_work"]) ? $_POST["current_work"] : "",
			'idspProfiles' => $userid,
			'idsp_pid' => isset($_POST["spProfile_pid"]) ? $_POST["spProfile_pid"] : "",
		);
		  
		$id = $em->createEmpexp($user_exp);
		$stack = array();
		array_push($stack, $id);
		$_SESSION['exp_id'] = $stack;
		echo $id;
	}
	

	
	