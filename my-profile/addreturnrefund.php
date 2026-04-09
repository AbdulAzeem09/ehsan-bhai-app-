<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$r = new _returnrefund;
	$re = new _redirect;
	$result = $r->read($_POST["spProfiles_idspProfiles"]);
	if($result != false)
	{
		$r->update( $_POST, "WHERE t.spProfiles_idspProfiles =" . $_POST["spProfiles_idspProfiles"]);
		$re->redirect("../my-profile/");
		//header ("Location:../my-profile/");
	}
	else
	{
		$r->create($_POST);
		$re->redirect("../my-profile/");
		//header ("Location:../my-profile/");
	}
         
?>