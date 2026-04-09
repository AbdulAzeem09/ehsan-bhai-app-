<?php

session_start();
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$pl = new _favorites;

$timelinedata = array( 
    "spprofiles_idspprofiles" => $_POST["pid"],
    "sppostings_idsppostings" => $_POST["postid"],
    "added_on" => $date,
    "spUserid" => $_SESSION["uid"]
);
$id = $pl->addfavorites_f($timelinedata);

$result = $pl->readcount($_POST["postid"]);
if($result){
$numRows = mysqli_num_rows($result);
echo $numRows;
}else{
    echo "0";
}