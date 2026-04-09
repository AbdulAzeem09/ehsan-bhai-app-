<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");


	/*	 echo "<pre>";
        
         print_r($_POST);*/

          $b = new _freelance_placebid;

         $id = $b->create($_POST);
/*
         echo $b->ta->sql;*/

           $re = new _redirect;
    session_start();
    $_SESSION['count'] = 0;
    $_SESSION['data'] = "success";
    $_SESSION['errorMessage'] = "Bid Added Successfully";
    $re->redirect($BaseUrl."/freelancer/project-detail.php?project=".$_POST['spPostings_idspPostings']);


?>
