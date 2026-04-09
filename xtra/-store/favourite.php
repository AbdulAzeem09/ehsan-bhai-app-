<?php
    session_start();

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $p = new _rfq;

    $myPid = $_SESSION['pid'];
    $cmpanyid = $_GET['pid'];
    $rfqId = $_GET['rfq'];

    if (isset($_GET['action']) && $_GET['action'] == 'add') {
        // ADD TO FAVOURITE
        $result = $p->createFavrtCmpny($rfqId, $myPid, $cmpanyid);

    }else{
        // REMOVE TO FAVOURITE
        $p->remoeFavrtCmpny($rfqId, $myPid, $cmpanyid);
    }


    $re = new _redirect;
    $re->redirect("my-rfq-detail.php?rfq=".$rfqId."&pid=".$cmpanyid);
    
    
?>