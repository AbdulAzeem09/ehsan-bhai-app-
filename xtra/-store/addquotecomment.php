<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$q = new _spAllStoreForm;
	$q->createQuoteComment($_POST);
	


	$re = new _redirect;
   	$re->redirect($BaseUrl.'/store/my-send-quote.php');
	//header("Location:../buy-sell/");
?>