<?php
include('../../univ/baseurl.php');
session_start();
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_SESSION['msg']= 3;

$p = new _pos;
$id = $_GET['id'];
$p->remove_attendance($id);
header("Location: attendance.php");
