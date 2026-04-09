
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
$eid = 0;
//print_r($_POST);
$insertdata = array(
    "name" => $_POST['sname'],
    "lname" => $_POST['slname'],
    "email" => $_POST['semail'],
    "password" => $_POST['spassword'],
    "mob" => $_POST['smob'],
    "country" => $_POST['scountry'],
    "address" => $_POST['saddress'],
    "state" => $_POST['sstate'],
    "birth" => $_POST['sbirth'],
    "salary" => $_POST['ssalary'],

    
);
$record = $p->mcreate($insertdata);
header("location:mukesh.php");