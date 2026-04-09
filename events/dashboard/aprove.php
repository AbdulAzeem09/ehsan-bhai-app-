	
<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$ei = new _eventJoin;
	$re = new _redirect;
	
	$postid = $_GET['postid'];
	$pid 	= $_GET['pid'];
	$org 	= $_GET['org'];
	$stat 	= $_GET['stat'];
	
	$result = $ei->create($postid, $pid, $org, $stat);
	$redirctUrl = "join-event.php";
	$re->redirect($redirctUrl);
?>

