<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$sp = new _savepost;
	$re = new _redirect; 

	$pid = $_SESSION['pid'];
	$uid = $_SESSION['uid'];

	if(isset($_GET["save"])) { 
		$postid = $_GET["save"];
		$result = $sp->create($postid, $pid, $uid);
		if($result){
			$url = "../publicpost/post_comment_details.php?postid=$postid";
			$re->redirect($url);
			//header("Location:../timeline/index.php");
           // https://dev.thesharepage.com/publicpost/post_comment_details.php?postid=2327
           
		}

	}else if(isset($_GET["unsave"])){
		$postid = $_GET["unsave"];
		$result = $sp->removpost($postid, $pid, $uid);
		$url = "../publicpost/post_comment_details.php?postid=$postid";
		$re->redirect($url);
		//header("Location:../timeline/index.php");


	}else{
		$url = "../timeline";
		$re->redirect($url);
		//header("Location:../timeline/index.php");
	}



	
?>