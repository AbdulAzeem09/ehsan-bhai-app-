<?php
 
 
/*print_r($_POST);*/
/*print_r($_GET);*/
include('../univ/baseurl.php');
include( "../univ/main.php");
/*require_once '../library/config.php';
require_once '../library/functions.php';*/
	//$conn = _data::getConnection();
$con = mysqli_connect(DBHOST, UNAME, PASS);

	if(!$con) {
	die('Not Connected To Server'); 
}

//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
	echo 'Database Not Selected';
}

$spPosting_idspPosting = $_POST['spPosting_idspPosting'];
$why_flag = $_POST['radReport'];
$spProfile_idspProfile = $_POST['spProfile_idspProfile'];
$flagpostprofileid = $_POST['flagpostprofileid'];
$userid = $_POST['userid'];
$flagpostuserid = $_POST['flagpostuserid'];

/*print_r($userid);*/

$sql   = "INSERT INTO flagtimelinepost (why_flag, spPosting_idspPosting, spProfile_idspProfile,flagpostprofileid,flagpostuserid,userid) VALUES ('$why_flag','$spPosting_idspPosting','$spProfile_idspProfile' ,'$flagpostprofileid','$flagpostuserid','$userid')";

	/*$result = dbQuery($con, $sql);*/

if(!mysqli_query($con, $sql)) {
	echo 'Could not insert';
}
else {
	echo "Thank you";
}

//header('location:'.$BaseUrl.'/timeline/');
/*function sp_autoloader($class){
	include '../mlayer/_sptimelinepost.class.php';
}
spl_autoload_register("sp_autoloader");

$f = new _sptimelinepost;

$f->flag($_POST);*/
/*if(isset($_GET['by']) && $_GET['by'] > 0 && isset($_GET['to']) && $_GET['to'] > 0){

	$idspProfileBy = $_GET['by'];
	$idspProfileTo = $_GET['to'];
	//agr flag 1 ha to profile favourite ho jaen gi
	if(isset($_GET['flag'])){
		$flag = $_GET['flag'];
		if($flag == 1){
			$f->createfavourite($idspProfileBy, $idspProfileTo);
			header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
		}
		//remove the profile if favourite
		if($flag == 0){
			$f->removefavourite($idspProfileBy, $idspProfileTo);
			header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
		}
	}
	if(isset($_GET['block'])){
		$block = $_GET['block'];
		if($block == 1){
			$f->createblock($idspProfileBy, $idspProfileTo);
			header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
		}
		if($block == 0){
			$f->removeblock($idspProfileBy, $idspProfileTo);
			header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
		}
	}
}*/
/*if(isset($_POST['btnReport'])){
	$idspProfileBy 	= $_POST['idspProfileBy'];
	$idspProfileTo 	= $_POST['idspProfileTo'];
	$radReport 		= $_POST['radReport'];
	if($idspProfileBy > 0 && $idspProfileTo > 0){
		$f->reportSubmit($idspProfileBy, $idspProfileTo, $radReport);
		header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
	}
}*/
	
	
?>
