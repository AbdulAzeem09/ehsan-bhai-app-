<?php
include "../univ/baseurl.php";
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");


if (isset($_POST['respUserEphone'])) {
    $u          = new _spuser;
    $re         = new _redirect;
    $redirctUrl = $BaseUrl . "/sign-up.php";
    $uid        = $_SESSION['chkuid'];
    
    echo $u->sendMobileOtpcall($_POST, $uid);
}
