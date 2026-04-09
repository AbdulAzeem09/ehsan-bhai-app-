<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$p = new _jobseekerprofile;
	$res = $p->read( $_POST["spProfiles_idspProfiles"]);
	if($res != false)
	{
		$p->update( $_POST, "WHERE t.spProfiles_idspProfiles =" . $_POST["spProfiles_idspProfiles"]);
		header("Location:../my-profile/");
	}
	
	else
	{
		$p->create($_POST);
		header("Location:../my-profile/");
	}
	
?>