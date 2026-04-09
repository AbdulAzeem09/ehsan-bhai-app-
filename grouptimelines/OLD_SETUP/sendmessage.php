<?php
include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS,DBNAME);

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-groups/";
	include_once ("../authentication/check.php");

}else{
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$m = new _spgroupmessage;
	$id = $m->create($_POST);

	echo 1;
	// $re = new _redirect;
 //    $re->redirect($BaseUrl."/grouptimelines/discussion-board.php?groupid=".$_POST["spGroup_idspGroup"]."&groupname=".$_POST["groupname_"]."&disc");
    // header("Location:".$BaseUrl."/grouptimelines/discussion-board.php?groupid=".$_POST["spGroup_idspGroup"]."&groupname=".$_POST["groupname_"]."&disc");
    // print_r($re);
    // exit();
}

	//window.location.reload();
	// header("Location:".$BaseUrl."/grouptimelines/discussion-board.php?groupid=".$_POST["spGroup_idspGroup"]."&groupname=".$_POST["groupname_"]."&disc");
?>