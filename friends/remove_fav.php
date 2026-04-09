<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 
$pl = new _favorites;


$id = $pl->removefavorites_f($_POST["postid"], $_SESSION['uid'], $_POST["pid"]);

$result = $pl->readcount($_POST["postid"]);
if($result){
$numRows = mysqli_num_rows($result);
echo $numRows;
}else{
    echo "0";
}
