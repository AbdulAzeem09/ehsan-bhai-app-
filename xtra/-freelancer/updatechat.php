<?php

    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    $fc = new _freelance_chat;
    $p = new _spprofiles;

    if(isset($_POST['txtSendrProId']) && $_POST['txtSendrProId']){
        $sendrId = $_POST['txtSendrProId'];

        $result = $fc->updateChat($sendrId, $_SESSION['pid']);
        if($result){
            //echo "Success";
        }
    }
?>