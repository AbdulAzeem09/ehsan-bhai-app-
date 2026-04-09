<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "events/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";

    if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 6){
    } else {
        $re = new _redirect;
        $re->redirect($BaseUrl . "/events");
    }
    ?>


    <?php

    $p = new _spevent;


    if(isset($_POST['register_form'])){
        $data =[
            'user_id' => $_SESSION['uid'],
            'post_id' => $_GET['postid'],
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_city' => $_POST['user_city'],
            'user_state' => $_POST['user_state'],
            'user_country' => $_POST['user_country'],
            'user_company' => $_POST['user_company'],
        ];


        $result = $p->event_registration($data);

         if($result){
             $re = new _redirect;
             $redirctUrl = "../events/event-detail1.php?postid=".$_GET['postid']."";
             $re->redirect($redirctUrl);
         }
    }


    $re = new _redirect;
    $redirctUrl = "../events/event-detail1.php?postid=".$_GET['postid']."";
    $re->redirect($redirctUrl);

    ?>

    <?php
}
?>