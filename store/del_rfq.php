<?php
    session_start();
    include('../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $p = new _rfq;

    $idrfq = $_GET['idrfq'];
    $catid = 1;

    $result = $p->readRfq($idrfq);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row['rfqImage'])) {

        }
    }
    @unlink( ABS_PATH ."../upload/store/rfq/" .$row['rfqImage']);
    $result2 = $p->removeRfq($idrfq);

    $re = new _redirect;
    $re->redirect("dashboard/my-send-rfq.php");
    
    
?>