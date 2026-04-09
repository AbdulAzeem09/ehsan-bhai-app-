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

$arr=array(

"media_id"=>$id,
"uid"=>$_SESSION['uid'],
"pid"=>$_SESSION['pid'],
"status"=>1
);
//print_r($arr);

$fav=new _spPoints;
$res=$fav->insert_fav($arr);
header('location:'.$BaseUrl.'/dashboard/add_media/');





}?>