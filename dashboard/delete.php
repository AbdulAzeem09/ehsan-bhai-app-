


<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');


require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$p = new _spPoints;

$result = $p->delete($_GET['id']);




header('location:'.$BaseUrl.'/dashboard/test.php/');







} ?>



