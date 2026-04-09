<?php
    

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _productposting;
  
    if (isset($_POST['postid']) && $_POST['postid'] > 0){
    	$postid = $_POST['postid'];

    	//$result = $p->trashpost($postid);
    	$result = $p->delete_item($postid);
        
    }
    
    
?>