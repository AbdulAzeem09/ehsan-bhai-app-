<?php
	include('../univ/baseurl.php');
	session_start();
	if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
    
}else{
	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$hp = new _hidepost;
	$re = new _redirect;
	
	$pid = $_SESSION['pid'];
	$uid = $_SESSION['uid'];
	
	//$result = $hp->getPost($pid);
	
	//echo $hp->ta->sql;
	
	//while($row = mysqli_fetch_assoc($result)){
	//	print "<pre>"; print_r($row); print "</pre>";
	//}
	
	//exit;

	if(isset($_GET["postid"])) {
		
		$postid = $_GET["postid"];
		$result = $hp->create($postid, $pid);
		
		if($result){
			
			$redirctUrl = $BaseUrl . "/timeline";
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Post hidden successfully";
			$re->redirect($redirctUrl);
		}

	}else if($_GET['unhide']){
		$postid = $_GET['unhide'];
		$hp->remove($postid, $_SESSION['pid']);
		$redirctUrl = $BaseUrl . "/profile/index.php?hidePost";
		$re->redirect($redirctUrl);
	}else{
		$redirctUrl = $BaseUrl . "/timeline";
		$re->redirect($redirctUrl);
	}



}	
?>