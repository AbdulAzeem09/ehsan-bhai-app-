<?php
require_once "../common.php";

session_start();

$site = !empty($_GET['site']) ? $_GET['site'] : "";

if(!$site){
  errorOut("Request invalid");
}

$out = sessionHandling();
if($out['authToken']){ //user is already loggedin
  header("Location: $site/autoLogin?at=".$out['authToken']);  
}
else{
  header("Location: $site?u=1");
}

