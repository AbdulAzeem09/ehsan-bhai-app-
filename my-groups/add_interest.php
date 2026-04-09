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

	$sel = "SELECT * FROM `group_category` WHERE `id` = '".$_REQUEST['cat']."'";
	$sel_data = mysqli_query($dbConn,$sel);
	$fetch_data = mysqli_fetch_array($sel_data);

	foreach ($_REQUEST['cat'] as $val) {
	$sel = "SELECT * FROM `group_category` WHERE `id` = '".$val."'";
	$sel_data = mysqli_query($dbConn,$sel);
	$fetch_data = mysqli_fetch_array($sel_data);
	$cat = "INSERT INTO group_interest(sp_profile_id,cat_id,cat_name,created)VALUES('".$_SESSION['pid']."','".$val."','".$fetch_data['group_category_name']."','".date('Y-m-d')."')";
	$result=mysqli_query($dbConn,$cat);
}
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