<?php
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _spquotation;
    $result = $p->deletequote($_POST['strid']);
    //echo $p->ta->sql;  
?>