<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p =  new _spAllStoreForm;


    $id=$_GET['postid'];
   
   $p->deletequa($id);

    header("location: $BaseUrl./bulk_import_attr.php?action=status");
   
   ?>
    