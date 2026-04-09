
<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _timelineflag;
$eid = 0;
//print_r($_POST);
        $data=array(
            'name' => $_POST['fsfdsfsdf'],
            'lname' => $_POST['lnfsdfsdfsdfame']
            );
            
            $record = $p->macreate($data);
            echo $record;
            //window.location.reload(); 
		//echo trim($postid);
        //$postid = $p->macreate($_POST);
		//echo trim($postid);;
//$record = $p->macreate($insertdata);
//header("location:mukesh.php");