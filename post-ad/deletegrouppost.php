<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
$p = new _postings;
$re = new _redirect;
$p->remove($_GET["postid"]);
/*echo $p->ta->sql;*/

$redirctUrl =  $_SERVER['HTTP_REFERER'];
		$re->redirect($redirctUrl);