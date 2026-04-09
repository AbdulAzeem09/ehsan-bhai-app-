<?php
require_once("../../univ/baseurl.php" );
session_start();
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$v = new _flagpost;

$flid=isset($_GET['flid']) ? (int)$_GET['flid'] : 0;
$res = $v->deletflag($flid); 
header("Location: index.php");

//die("dddddddddddd");

?>
