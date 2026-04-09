<?php
	
 	include('../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
	    $_SESSION['afterlogin']="store/";
	    include_once ("../authentication/check.php");
	    
	}else{
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		if (isset($_POST)) {
			$pc = new _post_chat;
			$pc->create($_POST);
		}
	    	
	    $re = new _redirect;
		$location = $BaseUrl."/job-board/inbox.php";
	    $re->redirect($location);
		

	    //header('location:inbox.php');
	}
?>


