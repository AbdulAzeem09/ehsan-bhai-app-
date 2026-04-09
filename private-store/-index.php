<?php

session_start();
$_GET["groupstore"] = "5";

if (isset($_SESSION['pid']))
    include "../publicpost/index.php";

else {
    include_once ("../authentication/check.php");
    $_SESSION['afterlogin'] = "private-store/";
}
?>