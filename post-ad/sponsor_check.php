<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

	function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");

	$p = new _sponsorpic;

	$result=$p->check_data($_POST['company']);
       if($result){

              echo '1';
       }
       else{
        echo '0';

       }
	

	
?>