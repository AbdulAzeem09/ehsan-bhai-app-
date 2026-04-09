<?php 
//  ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);


include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$r = new _rfq;


 $id=$_GET['postid'];
 //echo $id;
 //die("jhfhdsuf");

$r->delete_data($id);

header("Location: " . $BaseUrl . "/store/dashboard/myprivate_rfq.php");

?>
