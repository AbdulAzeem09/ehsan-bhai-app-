<?php
//require_once('../common.php');

include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$p = new _jobalert;
$array  = ['spuserId' => $_POST['uid'], 'pid' => $_POST['pid'], 'email' => $_POST['email'], 'keywords' => $_POST['keywords']];

$pid = $array['pid'];
$spuid = $array['spuserId'];
$email = $array['email'];
$query = "WHERE pid='$pid' and spuserid='$spuid' and email='$email'";
$response = $p->readJobAlert($query);
if($response->num_rows > 0){
    echo 0;
}else{
    $r = $p->insertJobAlert($array );
    echo 1;
}
die();
