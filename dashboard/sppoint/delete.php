<?php 

require_once("../../univ/baseurl.php" );
     session_start();

     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    $pageactive = 80;
	

//print_r($_POST);
$id=$_GET['uid'];

$aa = new _spPoints;
$result=$aa->delete1($id);
header('location:'.$BaseUrl.'/dashboard/sppoint/testing.php');





?>