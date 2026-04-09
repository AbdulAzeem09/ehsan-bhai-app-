<?php
  include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$newsid = isset($_GET['newsid']) ? (int)$_GET['newsid'] : 0;
  
	$cn = new _company_news;
	$cn->removenews($newsid);
	//echo $m->ta->sql;
	//header('location:news.php');
	$re = new _redirect;
	$location = $BaseUrl."/job-board/news.php";
	$re->redirect($location);
	
?>
