<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

		
		//echo "<pre>";

	/*	print_r($_POST['bidPrice']);

		print_r($_POST['initialPercentage']);
		
		print_r($_POST['totalDays']);

        print_r($_POST['coverLetter']);*/

        echo "<pre>";
        
        print_r($_POST);


       $c = new _postfield;

		$id = $c->create($_POST);

		//echo $c->ta->sql;




?>
