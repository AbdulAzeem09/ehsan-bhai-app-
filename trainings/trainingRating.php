<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pl = new _trainingrating;

	$isAlreadyRated = $pl->checkRatingAlready($_POST['trainingId'],$_POST['profileid']);
	print_r($isAlreadyRated);
	if ($isAlreadyRated) {
		$pl->removeRating($_POST['trainingId'],$_POST['profileid']);
		$pl->addTrainingRating(array('spTrainId' => $_POST['trainingId'], 'spProfileId' => $_POST['profileid'], 'rating' => $_POST['rating']));
	} else {
		$pl->addTrainingRating(array('spTrainId' => $_POST['trainingId'], 'spProfileId' => $_POST['profileid'], 'rating' => $_POST['rating']));
	}
?>