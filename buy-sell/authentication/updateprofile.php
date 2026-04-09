<?php
session_start();
$_SESSION['pid'] = $_GET["pid"];
$_SESSION['ptid'] = $_GET["ptid"];
$_SESSION['ptname'] = $_GET["ptname"];
$_SESSION['myprofile'] = $_GET["myprofile"];
$_SESSION['groupname'] = $_GET["groupname"];
$_SESSION['store'] = $_GET["store"];
$_SESSION['dashboardtext'] = $_GET["dashboardtext"];
$_SESSION['gid'] = $_GET["gid"];
$_SESSION['ptpeicon'] = $_GET["ptypeicon"];
$_SESSION['year'] = $_GET["year"];

$_SESSION['monthtext'] = $_GET["monthtext"];
$_SESSION['monthvalue'] = $_GET["monthvalue"];

	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$c = new _order;
	$res = $c->read($_SESSION['pid']);
	if($res != false)
	{
		$_SESSION['cartcount'] = $res->num_rows;
		echo $_SESSION['cartcount'];
	}
	else
	{
		$_SESSION['cartcount'] = 0;
		echo $_SESSION['cartcount'];
	}
	
	
	$p = new _spprofiles;
	$rpvt = $p->read($_SESSION['pid']);
	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		$_SESSION['ptpeicon'] = $row["spprofiletypeicon"];
		echo $_SESSION['ptpeicon'];
	}
	
?>