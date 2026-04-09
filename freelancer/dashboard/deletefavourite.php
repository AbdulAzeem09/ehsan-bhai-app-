<?php 
// ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);



include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _fav2;

 $id=$_GET['postid'];

$p->deletefavourite($id);
// header("location: $BaseUrl./events/dashboard/bookmark.php");


       $re = new _redirect;
 
    $re->redirect($BaseUrl."/freelancer/dashboard/bookmark.php");


?>
 
