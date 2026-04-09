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

	
 $a=$_POST['who'];
	   $b=$_POST['whom'];
$obj=new _spprofilefeature;


$res=$obj->removefollow($a, $b);



	
		}
	?>