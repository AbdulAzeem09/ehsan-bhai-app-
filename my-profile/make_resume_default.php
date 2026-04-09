<?php
//require_once('../common.php');

include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$p = new _resumeget;

$pid = $_SESSION['pid'];
$id = $_POST['id'];

$conn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
$sql = "UPDATE `spboard_resumes` SET `default_resume` = '0' WHERE `spboard_resumes`.`pid` = '".$pid."'";
mysqli_query($conn, $sql);
$sql2 = "UPDATE `spboard_resumes` SET `default_resume` = '1' WHERE `spboard_resumes`.`idResume` = '".$id."'";
mysqli_query($conn, $sql2);
echo json_encode(['status' => 'success']);
die();
