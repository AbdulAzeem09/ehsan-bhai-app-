<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$cn = new _company_news;
	$cn->removenews($_POST["id"]);
	//echo $m->ta->sql;
	//$re = new _redirect;
    //$redirctUrl = "../business-directory/dashboard.php";
   // $re->redirect($redirctUrl);
	//header('location:news.php');
?>