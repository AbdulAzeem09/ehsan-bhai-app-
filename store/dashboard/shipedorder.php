<?php
    session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $p = new _orderSuccess;
    $or = new _order;
    $re = new _redirect;

    if (isset($_GET['oid']) && $_GET['oid'] > 0) {
        if (isset($_GET['do']) && $_GET['do'] == 1) {
            $status = 3;
            $redirecturl = 'delivered_order.php';
        }else{
            $status = 2;
            $redirecturl = 'shiped_order.php';
        }
        
        $oid = $_GET['oid'];
        $or->updateshipstatus($oid, $status);
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "<strong>Success!</strong> Shipped Order Successfully!";

        
        $re->redirect($redirecturl);
    }
    
?>