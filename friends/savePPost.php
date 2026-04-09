<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
 
	$sp = new _savepost;
	$re = new _redirect; 
	$p6 = new _spprofiles;
	$rpvt6 = $p6->read($_GET["profileid"]); 
	$gk= $_GET["profileid"];


	$pid = $_SESSION['pid'];
	$uid = $_SESSION['uid'];

 
	if(isset($_GET["save"])) {
		
		$postid = $_GET["save"];
		$gk= $_GET["profileid"];
		$result = $sp->create($postid, $pid, $uid);
		if($result){ 
			$url = "../friends/?profileid=$gk";
			$re->redirect($url);
			//header("Location:../timeline/index.php");
		 }

	}else if(isset($_GET["unsave"])){
		
		$postid = $_GET["unsave"];
		$gk= $_GET["profileid"];
		$result = $sp->removpost($postid, $pid, $uid);
		
		$url = "../friends/?profileid=$gk";
		$re->redirect($url);
		//header("Location:../timeline/index.php");

	 }


	else{
		
		$url = "../friends/?profileid=$gk";
		$re->redirect($url);
		//header("Location:../timeline/index.php");
	}



	
?>