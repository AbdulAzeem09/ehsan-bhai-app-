<?php

    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    $fc = new _post_chat;
    $p = new _spprofiles;
    $ptype = 5;

    if(isset($_POST['txtSendrProId']) && $_POST['txtSendrProId']){
        $sendrId = $_POST['txtSendrProId'];

        $result = $fc->updateChat($sendrId, $_SESSION['pid'], $ptype);
        if($result){
            //echo "Success";
        }
    }
?>