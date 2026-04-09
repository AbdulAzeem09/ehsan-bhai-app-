<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _postings;
	$classiFied = new _classified;
	
	if(isset($_GET["action"]) && $_GET["action"] == "renew") {
		$renewDate = date('Y-m-d', strtotime("+90 days"));
		$classiFied->update(array('spPostingExpDt' => $renewDate), "WHERE t.idspPostings =" . $_GET["postid"]);
	} else {
		if(isset($_GET["postid"])) {
			$p->remove($_GET["postid"]);
		}
	}
	
	$re = new _redirect;
    $redirctUrl = "../services/dashboard/index.php";
    $re->redirect($redirctUrl);
?>