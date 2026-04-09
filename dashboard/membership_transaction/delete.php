<?php
require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");


//echo $_GET['id'];die(' gggggggggggggggg');
$mb = new _spmembership;
$result = $mb->Delete_table($_GET['id']);
header("Location: index.php");

















}