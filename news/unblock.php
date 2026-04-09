<?php



include '../univ/baseurl.php';
session_start();

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "videos/";
	include_once "../authentication/check.php";

} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	
 $who=$_SESSION['pid'];
	 $whom=$_GET['whom'];
	 //die("HHHHHHHHHHHHHHHHHHH");
$obj=new _news;


$res=$obj->removeblock($who, $whom); 


header("location:https://dev.thesharepage.com/news/block_users.php");
	
		}
	?>