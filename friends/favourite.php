<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
$re = new _redirect;
	$f = new _spprofilefeature;
	$s = new _spprofilehasprofile;
	if(isset($_GET['by']) && $_GET['by'] > 0 && isset($_GET['to']) && $_GET['to'] > 0){
		$idspProfileBy = $_GET['by'];
		$idspProfileTo = $_GET['to'];
		if(isset($_GET['flag'])){
			$flag = $_GET['flag'];
			if($flag == 1){
				$f->createfavourite($idspProfileBy, $idspProfileTo);
                $re->redirect($BaseUrl.'/friends/?profileid='.$idspProfileTo);
				//header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
			}
			if($flag == 0){
				$f->removefavourite($idspProfileBy, $idspProfileTo);
                $re->redirect($BaseUrl.'/friends/?profileid='.$idspProfileTo);
				//header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
			}
		}
		if(isset($_GET['block'])){
			$block = $_GET['block'];
			if($block == 1){
				$f->createblock($idspProfileBy, $idspProfileTo);
				$s->unfriend($idspProfileBy,$idspProfileTo);
                $re->redirect($BaseUrl.'/friends/?profileid='.$idspProfileTo);
				//header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
			}
			if($block == 0){
				$f->removeblock($idspProfileBy, $idspProfileTo);
                $re->redirect($BaseUrl.'/friends/?profileid='.$idspProfileTo);
				//header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
			}
		}
	}
	if(isset($_POST['btnReport'])){
		$idspProfileBy 	= $_POST['idspProfileBy'];
		$idspProfileTo 	= $_POST['idspProfileTo'];
		$radReport 		= $_POST['radReport'];
		if($idspProfileBy > 0 && $idspProfileTo > 0){
			$f->reportSubmit($idspProfileBy, $idspProfileTo, $radReport);
            $re->redirect($BaseUrl.'/friends/?profileid='.$idspProfileTo);
			//header('location:'.$BaseUrl.'/friends/?profileid='.$idspProfileTo);
		}
	}
	
	
?>
