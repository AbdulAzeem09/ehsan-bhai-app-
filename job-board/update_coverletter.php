
<?php
// update_coverletter.php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _coverletter;
$array  = ['spuid' => $_POST['uid'], 'pid' => $_POST['pid'], 'title' => $_POST['title'], 'coverletter' => $_POST['coverletter']];
$coverletter_id = $_POST['coverletter_id'];

$r = $p->updateJobAlert($array, $coverletter_id);
