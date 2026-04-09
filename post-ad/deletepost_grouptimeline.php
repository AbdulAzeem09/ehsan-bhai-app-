<?php
include('../univ/baseurl.php');

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spevent;
$po = new _postings;
$re = new _redirect;
// DELETE ANY  POST

//ashish changed - date-6-3-21.
if (isset($_GET['postid']) && isset($_GET['flag'])) {
    $postid = $_GET["postid"];
    $po->remove($postid);
	$groupid = urlencode($_GET['groupid']);
	$groupname = urlencode($_GET['groupname']);
	$location = "$BaseUrl/grouptimelines/?groupid=".$groupid."&groupname=".$groupname."&timeline&page=1";
	header("Location: $location");
	exit;
	

}
		
?>
