<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
//print_r($_POST);
//echo "here";

 
$fq = new _faqcontact_info;

$fq->create($_POST);

echo $sl->fq->sql;



?>