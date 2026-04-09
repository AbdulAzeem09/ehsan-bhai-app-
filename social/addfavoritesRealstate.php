<?php
session_start();
function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$pl = new _favorites;

	$pl->addfavorites_realstate(array("spProfiles_idspProfiles" => $_POST["pid"], "spPostings_idspPostings" => $_POST["postid"], "spUserid" => $_SESSION["uid"]));
	
?>

