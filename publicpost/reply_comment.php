<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="store/";
	include_once ("../authentication/check.php");	
}else{
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$re = new _redirect;
	$p = new _comment_reply;
	$data = $_POST;
	unset($data['redirect']);
	$p->comment($data);
	if(isset($_POST['redirect'])){
		if($_POST['redirect'] == "ajax"){
			echo "ok"; die();
		}
		$url = $BaseUrl . $_POST['redirect'] .'?cpid='.$_POST['postid'];
	}else{
		$postid = $_POST['spPostings_idspPostings'];
		$url = $BaseUrl."/publicpost/post_comment_details.php?postid=".$postid;               
	}
	$re->redirect($url); 
}
?>