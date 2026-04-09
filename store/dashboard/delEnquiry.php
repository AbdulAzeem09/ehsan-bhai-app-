<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _postenquiry;
    $result = $p->removeMsg($_POST['msgid']);
    //echo $p->ta->sql;
    
    
?>