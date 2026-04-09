<?php
//error_reporting(E_ALL);
//ini_set("display_errors", "On");

session_start();
function sp_autoloader($class) {

  include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$postId = !empty($_POST['postid']) ? (int)$_POST['postid']: 0;
if(!$postId){
  die("INVALID REQUEST");
}

$p = new _productposting;
$result = $p->activeprevpost($postId);
$_SESSION['publish1'] = 5;

header("Location:storeindex.php?folder=home");

?>
