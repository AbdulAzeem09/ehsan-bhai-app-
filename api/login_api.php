<?php

    error_reporting(E_ALL);
	ini_set('display_errors', '1');


include('../univ/baseurl.php');

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
session_start();

$u = new _spuser;
$spUserEmail = $_POST['email'];
$spUserPassword = $_POST['password'];

if ($spUserEmail != '') {
    $r = $u->login_api($spUserEmail, hash("sha256", $spUserPassword));

    if ($r != false) {
        $result = $u->chekLock_api($spUserEmail);

        if ($result != false) {
                
            //email verify hona chiye 1 hona
            $row = $u->chekEmail($spUserEmail);

            if ($row != false){

               die("Email Verify Login Success");

            }else{
                die("Email Not Verify");

            }

        }else{
            die("User Locked");

        }

    } else {

        die("Credentails Wrong");

    }

    

} else {
    die("Pleasse Enter Email and Pasword");
}
?>