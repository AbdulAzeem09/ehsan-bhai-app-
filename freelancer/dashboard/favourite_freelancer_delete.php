<?php
	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class){
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");


		 //echo "<pre>";
        
         //print_r($_POST);

          $b = new _freelance_project_status;

          $b->removefavfree($_GET["postid"]);

         //echo $b->ta->sql;
		 

           $re = new _redirect;
 
    $re->redirect($BaseUrl."/freelancer/dashboard/favourite_freelancer.php");


?>
