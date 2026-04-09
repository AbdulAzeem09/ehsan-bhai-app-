<?php 
session_start();
function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$u = new _spprofilehasprofile;
//echo $_POST['profileid'];
//echo $_SESSION['pid'];
$result = $u->unfriend($_POST['id'] , $_SESSION['pid']);


?>