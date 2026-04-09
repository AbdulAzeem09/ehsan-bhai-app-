<?php

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$p = new _spgroup;
$p->updategrouptype($_GET["groupid"],$_GET["type"]);
echo $p->ta->sql;
?>