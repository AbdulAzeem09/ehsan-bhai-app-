<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$cn = new _company_news;
	$cn->removenews($_GET["newsid"]);
	//echo $m->ta->sql;
	header('location:news.php');
?>