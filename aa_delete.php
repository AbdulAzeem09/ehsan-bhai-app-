<?php 
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$q = new _album;
 $id=$_GET['id'];
 $q->delete_data1($id);
 header("location:a_show.php");
 ?>