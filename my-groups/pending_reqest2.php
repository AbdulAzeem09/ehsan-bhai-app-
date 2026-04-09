<?php


include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);



if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-groups/";
	include_once("../authentication/check.php");
} else {

	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");




	if (isset($_GET['id'])) {

		$approve = array("spApproveRegect" => 2);

		$g1 = new _spgroup;
		if ($g1 != false) {
			$app = $g1->updateapprove($approve, $_GET['id']);
			//die('=777');
			header("Location:index.php");
		}
	}
	if (isset($_GET['postid'])) {




		$g1 = new _spgroup;


		//$app=$g1->updateapprove($reject,$_GET['postid']);
		$app = $g1->reject_d($_GET['postid']);

		//die('=777');
		header("Location:index.php");
	}
}
