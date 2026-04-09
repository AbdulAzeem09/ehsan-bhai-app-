<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

   // print_r($_POST['postid']);
  
    $s = new _sponsorpic;


    if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];

    	//print_r($postid);

    	$result = $s->remove($postid);

    	// echo $s->ta->sql;

        
    }
    
    
?>