<?php
include('../../univ/baseurl.php');
session_start();
$_SESSION['msg']=3;
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _pos;
$id = $_GET['id'];
$p->remove_holiday($id);
header("Location: holiday.php");
