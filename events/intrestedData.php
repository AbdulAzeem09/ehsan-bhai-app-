<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "events/";
    include_once("../authentication/check.php");
}
else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    if ($_SESSION['spPostCountry'] == '') {
        $u = new _spuser;
        $res = $u->read($_SESSION["uid"]);
        if ($res != false) {
            $ruser = mysqli_fetch_assoc($res);
            $_SESSION['spPostCountry'] = $ruser["spUserCountry"];
            $_SESSION['spPostState'] = $ruser["spUserState"];
            $_SESSION['spPostCity'] = $ruser["spUserCity"];
        }
    }
    if (isset($_POST['changelc'])) {
        $userCountry = $_POST['spPostCountry'];
        $userState = $_POST['spUserState'];
        $userCity = $_POST['spUserCity'];
        $_SESSION['spPostState'] = $userState;
        $_SESSION['spPostCity'] =  $userCity;
        $_SESSION['spPostCountry'] =   $userCountry;
        $usercountry =  $_SESSION['spPostCountry'];
        $userstate = $_SESSION['spPostState'];
        $usercity = $_SESSION['spPostCity'];
    } else {
        $usercountry = $_SESSION['spPostCountry'];
        $userstate = $_SESSION['spPostState'];
        $usercity = $_SESSION['spPostCity'];
    }
    ?>

    <?php $m = new _spevent;?>
    <?php $eventData =  $p->event_online_data(); ?>

    <?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {

        echo "-----";
        echo $eventRow['id'];
        echo "-----";
        echo $eventRow['id'];
    }}?>



    <?php
}
?>