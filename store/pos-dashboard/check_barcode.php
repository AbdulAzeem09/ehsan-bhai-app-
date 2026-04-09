<?php

include('../../univ/baseurl.php');
session_start();
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _spprofiles;


$res = $p->check_barcode($_POST['code']);
if ($res) {
    echo 1;
} else {
    echo 0;
}
