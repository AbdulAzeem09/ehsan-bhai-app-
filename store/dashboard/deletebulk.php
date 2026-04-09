<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _subcategory;
    $post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;


    $id=$post_id;
   
   $p->deletecat($id);

    header("location: $BaseUrl./bulk_import_attr.php?action=category");
   
   ?>
    
    
