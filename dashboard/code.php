
<?php
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _timelineflag;

//print_r($_POST);
//die('kdjfh');
$insert = array(
    
    "name"=>$_POST['fname'],
    "lname"=>$_POST['lname'],
    "mob"=>$_POST['contactno'],
    "email"=>$_POST["email"],
    "password"=>$_POST["password"]
);
$record = $p->data($insert);
header("location:hellow.php");
