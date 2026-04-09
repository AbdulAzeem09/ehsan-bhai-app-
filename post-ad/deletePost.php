<?php
	include('../univ/baseurl.php');
	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _spevent;
	$po = new _postings;
	$re = new _redirect;
	// DELETE ANY  POST
	
	//ashish changed - date-6-3-21.
	if(isset($_GET['postid']) && isset($_GET['flag'])){
		$postid = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
		$po->remove($postid);
		$redirctUrl = $BaseUrl."/timeline/"; 
		if($_GET['flag'] == 2) {
			$redirctUrl = $BaseUrl."/timeline/?groupid=".$_GET['groupId']."&pendingtimeline&groupname=".$_GET['groupname'];
		} else if( isset($_GET['groupId']) && $_GET['groupId'] > 0 &&  isset($_GET['groupname'])){
		  $redirctUrl = $BaseUrl."/grouptimelines/?groupid=".$_GET['groupId']."&groupname=".$_GET['groupname']."&timeline&page=1";
		}
		$re->redirect($redirctUrl);
	}
		
	/*	old data.	
	if(isset($_GET["postid"])) {
		$p->remove($_GET["postid"]);
          
		$redirctUrl = "../events/dashboard/draft-event.php";
		$re->redirect($redirctUrl);
	}
	
	if(isset($_GET["priviewid"]) && $_GET["priviewid"] != 1){
		$priview  = $_GET["priviewid"];

		if($p && $_GET["flag"] != 1){
			if($_GET["draft"] == 3){
				$redirctUrl = "../my-posts/index.php?flag&viewdraft=check";
				$re->redirect($redirctUrl);
				
			}else{

				$redirctUrl = "../my-posts/index.php";
				$re->redirect($redirctUrl);
			  	
			}
		}else{
			$redirctUrl = "../timeline/index.php";
			$re->redirect($redirctUrl);
		  	//header("Location:../timeline/index.php");
		}
	}else if(isset($_GET['postid']) && isset($_GET['flag'])){
		$po->remove($_GET["postid"]);
		echo 0;
	}else{

		$redirctUrl = "../timeline";
		$re->redirect($redirctUrl);
		//header("Location:../post-ad/sell/index.php?post");
	}*/
	
	//http://sp.localhost/my-posts/?flag&viewdraft=check
?>
