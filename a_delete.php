
<?php 
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _album;
 $id=$_GET['id'];

$p->delete_data($id);
header("location:a_dashboard.php");
?>