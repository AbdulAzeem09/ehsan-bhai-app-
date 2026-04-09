<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
include('../../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$p = new _spevent;

//print_r($_POST);

$id=$_GET['postid'];
// echo $id; die('======');
$record = $p->del_event($id);

header("Location: " . $BaseUrl . '/events/dashboard/all-event.php');



?>