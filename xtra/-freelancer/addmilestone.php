
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$fm = new _freelance_milestone;
	$addfreelancemilestone = $fm->create($_POST);
	header('location:'.$BaseUrl.'/freelancer/active-project.php');
?>
