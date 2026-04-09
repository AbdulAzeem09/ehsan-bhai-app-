<?php
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _favorites;
    $result = $p->removeFavProfile($_POST['postid'], $_POST['pid']);

    //$result = $p->removeMsg($_POST['msgid']);
    //echo $p->ta->sql;
    
    
?>