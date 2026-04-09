<?php
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _jobpostings;
  
    if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];
        $saveId = $_POST['saveId'];
    	$result = $p->trashpost($postid);

        $p->rrrrashpost($postid, $saveId);
    }
    
    
?>