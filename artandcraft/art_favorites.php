<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
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
    "spUserid" => $_SESSION["uid"]
);


$id = $pl->addfavorites_artandcraft($timelinedata);
