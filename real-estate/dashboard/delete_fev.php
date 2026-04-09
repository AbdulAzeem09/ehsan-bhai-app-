<?php 
session_start();
 //print_r($_SESSION);
//die("ghfhf");

 //ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);


include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p= new _spuser;

$id = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
// die("fgfdg");




 $p->remove3($id);
 //die("fghfhf");

 header("location:" . $BaseUrl . "/real-estate/dashboard/favourite.php");

?>
<script>
 
