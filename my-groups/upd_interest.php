<?php
include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DBHOST, UNAME, PASS,DBNAME);



if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-groups/";
	include_once ("../authentication/check.php");

}else{

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");

	$sel = "SELECT * FROM `group_category` WHERE `id` = '".$_REQUEST['cat_id']."'";
	$sel_data = mysqli_query($dbConn,$sel);
	$fetch_data = mysqli_fetch_array($sel_data);
	
	$cat = "UPDATE group_interest SET cat_id = '".$_REQUEST['cat_id']."',cat_name = '".$fetch_data['group_category_name']."' WHERE id = '".$_REQUEST['id']."'";
	$result=mysqli_query($dbConn,$cat);
	
	if($result)
	{ 
		echo '1';

	}
	else
	{
		echo '0';
	}
}
?>