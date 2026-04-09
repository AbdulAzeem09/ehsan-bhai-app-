<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$s = new _spusershipadd;
	$re = new _redirect;

   // print_r($_POST);

	$result = $s->read($_POST["spProfiles_idspProfiles"]);
	if($result != false){
		$s->update( $_POST, "WHERE t.spProfiles_idspProfiles =" . $_POST["spProfiles_idspProfiles"]);
		//$re->redirect("../my-profile/");

		//header ("Location:../my-profile/");
	}else{
		
		$s->create($_POST);
		//$re->redirect("../my-profile/");
		//header ("Location:../my-profile/");
	}
         
?>