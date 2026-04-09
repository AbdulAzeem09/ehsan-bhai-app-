<?php
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p = new _comment_reply();
    $p->deletecomment($_POST["idComment"]);
?>