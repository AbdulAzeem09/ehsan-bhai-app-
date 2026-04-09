<?php 
// ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);





include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _spevent;

 $id=$_GET['postid'];

$p->delete_value($id);
// header("location: $BaseUrl./events/dashboard/bookmark.php");

?>
<script>
  window.location.replace('<?php echo $BaseUrl?>/events/dashboard/bookmark.php');
  </script>