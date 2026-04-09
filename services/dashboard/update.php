<?php
error_reporting(E_ALL);
	ini_set('display_errors', '1');
 
	include('../../univ/baseurl.php');
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
 
	$p = new _postings;
	$classiFied = new _classified;
	


		if(isset($_GET["postid"])) { 
			$classiFied->activated($_GET["postid"]);
			$re = new _redirect;
   			 $redirctUrl = "deactivated.php";
    		$re->redirect($redirctUrl);
		}
		if(isset($_GET["id"])) { 
			$classiFied->activated($_GET["id"]);
			$re = new _redirect;
    		$redirctUrl = "deactivated.php";
    		$re->redirect($redirctUrl);
			
		}
	
	
	
		
?>