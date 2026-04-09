<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$r = new _rfq;
	$r->createRfqComment($_POST);
	


	$re = new _redirect;
   	$re->redirect($BaseUrl.'/store/my-send-rfq.php');
	//header("Location:../buy-sell/");
?>