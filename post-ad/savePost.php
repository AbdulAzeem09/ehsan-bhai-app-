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
		$postid = isset($_GET["save"]) ? (int)$_GET["save"] : 0;
		$result = $sp->create($postid, $pid, $uid);
		if($result){
			$url = "../profile/index.php?hidePost";
			$re->redirect($url);
			//header("Location:../timeline/index.php");
		}

	}else if(isset($_GET["unsave"])){
		$postid = isset($_GET["unsave"]) ? (int)$_GET["unsave"] : 0;
		$result = $sp->removpost($postid, $pid, $uid);
		$url = "../profile/index.php?save_Post";
		$re->redirect($url);
		//header("Location:../timeline/index.php");

	}else{
		$url = "../timeline";
		$re->redirect($url);
		//header("Location:../timeline/index.php");
	}



	
?>