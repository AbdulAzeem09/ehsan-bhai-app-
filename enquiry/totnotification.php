<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _postenquiry;
	$totnotification = 0 ;
	$totnotification1 = 0;
	$res = $p->readnotification($_SESSION['uid']);
	if( $res != false)
	{	
		$totnotification1 = $res->num_rows;
	}
	
	$totnotification2 = 0;
	$n = new _conversation;
	$res = $n->notification($_SESSION['uid']);
	if($res != false)
	{
		$totnotification2 = $res->num_rows;
	}
	$totnotification = $totnotification1+$totnotification2;
	if($totnotification == 0)
		echo "";
	else
		echo $totnotification;
?>