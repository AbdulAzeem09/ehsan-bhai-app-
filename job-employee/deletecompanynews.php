<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

// Check if draftid is provided

    $p = new _company_news;
     $r=$p->remove($_POST["draftid"]);
	
file_put_contents('debug.log', 'Post ID: ' . $_POST["draftid"] . PHP_EOL, FILE_APPEND);
?>
