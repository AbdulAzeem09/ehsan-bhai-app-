<?php
include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$row = $_POST['row'];
$profile = $_POST['profile'];
echo $row;
echo $profile;

die();
$rowperpage = 10;


$obj2=new _postings;
$res4= $obj2->loadmoredata($row,$rowperpage,$profile);

$html = '';
while($rows=mysqli_fetch_assoc($res4)){
	include('friend_data.php');
}

echo $html;

















?>



