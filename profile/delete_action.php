<?php
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p = new _postings;
    
    $result = array();
    $_POST['emp_id'];
    $postids =  explode(',', $_POST['emp_id']);
    foreach ($postids as $key => $value) {
        $p->remove($value);
    }
?>