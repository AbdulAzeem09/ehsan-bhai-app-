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

$pageactive = 74;      

$id=$_GET['id'];

$fav=new _spPoints;
$res=$fav->delete_fav($id);

header('location:'.$BaseUrl.'/dashboard/add_media/');




}?>