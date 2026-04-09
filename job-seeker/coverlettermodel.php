<?php
//require_once('../common.php');

include('../univ/baseurl.php');
session_start();




function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _coverletter;

$array2 = [
    'spuid' => $_POST['uid'],
    'pid' => $_POST['pid'],
    'title' => $_POST['pdfTitle'], // Cover letter title
    'coverletter' => $_POST['pdfContent'], // Cover letter content
];


$r = $p->insertcoverletter($array2);
$_SESSION['coverletter_create_update'] = true;
$_SESSION['coverletter_update_msg'] = 'Cover letter saved successfully';