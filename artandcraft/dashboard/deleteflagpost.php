<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);



session_start();


include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p =  new _flagpost;

 $id=$_GET['postid'];

$p->flagd($id);
header("Location: {$BaseUrl}/artandcraft/dashboard/flag_post.php");

?>

  <script>
  //window.location.replace('<?php echo $BaseUrl?>/artandcraft/dashboard/my_fevourite.php?postid='$id; ?>');
  </script>


