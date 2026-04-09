<?php
    

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $ponv = new _spproductoptionsvalues;

  
    if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];

    	$result = $ponv->delopvalue($postid);
        
    }
    
    
?>