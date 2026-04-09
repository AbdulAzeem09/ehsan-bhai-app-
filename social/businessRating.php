<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pl = new _businessrating;

	$isAlreadyRated = $pl->checkRatingAlready($_POST['bussinessId'],$_POST['profileid']);
	if ($isAlreadyRated) {
		$pl->removeRatingByBusiness($_POST['bussinessId'],$_POST['profileid']);
		$pl->addBussinessRating(array('idspProfiles_spProfileCompany' => $_POST['bussinessId'], 'spProfiles_idspProfiles' => $_POST['profileid'], 'rating' => $_POST['rating']));
	} else {
		$pl->addBussinessRating(array('idspProfiles_spProfileCompany' => $_POST['bussinessId'], 'spProfiles_idspProfiles' => $_POST['profileid'], 'rating' => $_POST['rating']));
	}
?>