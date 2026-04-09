<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$p = new _resumeget;

$uid = $_SESSION['uid'];
$pid = $_POST['pid'];
$type = $_POST['type'];
$value = ($_POST['status'] == 0) ? 1 : 0;
$response = $p->get_job_save_fav($pid, $uid);

if($response->num_rows > 0){
    $where = " WHERE pid = $pid AND uid = $uid";
    $r = $p->updateResumeSaveFav([
        'pid' => $pid,
        'uid' => $uid,
        $type => $value
    ], $where);
    echo 1;
}else{
    $r = $p->insertResumeSaveFav([
        'pid' => $pid,
        'uid' => $uid,
        $type => $value
    ]);
    echo 1;
}
die();