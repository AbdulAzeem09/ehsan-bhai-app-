<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 

$p = new _timelineflag;
$rr = $_GET['sid'];
//die('mukeskjj');
$p->delstudent($rr);
header("location:mukesh.php");