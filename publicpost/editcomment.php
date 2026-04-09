<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	require_once "../common.php";
	$re = new _redirect;
	$p6 = new _spprofiles;
	$p = new _comment;
	if(isset($_POST['idComment']) && (int)$_POST['idComment'] > 0){
		$arr = [];
		$arr[] = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';
		$arr[] = (int) $_POST['idComment'];
    	insertQ("UPDATE comment SET comment = ? WHERE idComment = ?", "si", $arr);
	}	 
	if(isset($_POST['redirect'])){
		$url = $BaseUrl . $_POST['redirect'] .'?cpid='.$_POST['postid'];
	}else{
		$rpvt6 = $p6->read($_POST["profileid"]);
		$profileid = $_POST['postid'];
		$url = $BaseUrl."/publicpost/post_comment_details.php?postid=$profileid";
	}
	$re->redirect($url); 
?>
