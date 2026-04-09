<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$pm = new _postingmusicmedia;


	$pm->updatevdo($_POST["postid"], $_POST["pid"]);
	//echo $p->ta->sql;
	// THIS CODE FOR FEATURED VIDEO FOR JS
	// if(isset($_POST['featvdo']) && $_POST['featvdo'] > 0){
	// 	$pm->updateFeature($_POST['featvdo']);
	// }


	
?>
