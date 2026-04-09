<?php
    session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

   


    $p = new _orderSuccess;
    $or = new _order;

    $ship_cmpny = $_POST['ship_cmpny'];
    $shipTrack = $_POST['shipTrack'];
    $shipDate = $_POST['shipDate'];
    // ===CREATE SHIPING INFO
    $result = $p->createShip($ship_cmpny, $shipTrack, $shipDate);
    //echo $p->ta->sql;
    if ($result) {
        // ===UPDATE SHIP CART
        $res = $or->updateShip($_POST['oid'], $result);
    }
    
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Success!</strong> Shipment Added Successfully!";

    $re = new _redirect;
    $re->redirect("prepare_ship.php");
    
    
?>