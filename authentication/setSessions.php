<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function sp_autoloader($class){
	include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
require_once "../common.php";

session_start();

$site = !empty($_GET['site']) ? $_GET['site'] : "";
$authToken = !empty($_GET['authToken']) ? $_GET['authToken'] : "";
$url = !empty($_GET['url']) ? $_GET['url'] : "";
$message = !empty($_GET['message']) ? $_GET['message'] : "";
 

if(!$site || !$authToken){
  errorOut("Request invalid");
}

$out = selectQ("select * from user_sessions where auth_token=?", "s", [$authToken], "one");
if(!$out){
  errorOut("Token invalid");
}

//reset authtoken to blank here
insertQ("update user_sessions set auth_token=? where us_id=?", "si", ["", $out['us_id']]);

$rows = selectQ("select * from spuser where idspUser=?", "i", [$out['user_id']], "one");
$p = new _spprofiles;

setAllSessions($rows, $p);

header("Location: ".$site."/ssoRedirect?url=".$url."&message=".$message);exit;




