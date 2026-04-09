<?php

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$p = new _spgroup;
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$p->removeGroup($group_id);
echo $p->ta->sql;
?>
