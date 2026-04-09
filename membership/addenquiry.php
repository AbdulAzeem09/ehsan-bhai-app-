
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$e = new _spenquiry;
	$e->create($_POST);
	
	$redirctUrl = $BaseUrl."/membership";
	$re = new _redirect;
	$re->redirect($redirctUrl);
	//header("location:../membership/");
?>
