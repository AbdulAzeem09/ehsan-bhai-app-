<?php

 include('../univ/baseurl.php');
//die('====');
// print_r($_POST);
// exit();
function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
     $b = new _spgroup;

$obj=new _postingalbum;
$id=$_GET['id'];
$groupid=$_GET['groupid'];

$groupname=$_GET['groupname'];

$obj->deletedatabyid($id);


header("location:".$BaseUrl."/grouptimelines/group-folder.php?groupid=$groupid&groupname=$groupname");
?>