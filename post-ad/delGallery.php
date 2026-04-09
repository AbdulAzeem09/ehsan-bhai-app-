<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

	function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");

	$picsp = new _eventpic;
	
	$pic = $_POST['img_id'];
	$picsp->removeGallery($pic);
	

	
?>