<?php 

//die("ghfhf");

 //ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);


include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postings;

  $id = $_GET['postid'];


 $p->remove2($id);
 //die("fghfhf");
 header("Location: " . $BaseUrl . "/trainings/dashboard/requested_course.php");
?>
<script>
 