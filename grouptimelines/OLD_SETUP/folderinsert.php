<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _postingalbum; 
$eid = 0;
//print_r($_POST);
$insertdata = array(
    "spf_title" => $_POST['txtfoldername'],
    "sppostingGroupid" => $_POST['grpid'],
    "spProfiles_idspProfiles" =>$_SESSION['pid'],
    "spf_folder_name" =>$_POST['txtFolerName'],
    "spf_date" =>date('Y-m-d'),
   "spf_status" =>1

);
$folder_11 = $p->mfolder_create($insertdata,$_POST['grpid']);


header("location:group-folder.php?groupid=".$_POST['grpid'].'&groupname='.$_POST['grpname'].'&files');
