<?php
    

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $pon = new _spproductoptionsname;

  
    if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];

    	$result = $pon->delopname($postid);
        
    }
    
    
?>