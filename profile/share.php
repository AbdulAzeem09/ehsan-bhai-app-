<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//spShareByWhom,spPostings_idspPostings,spShareToGroup,spShareToWhom
	$pl = new _postshare;
	$flag = 0;
	
	if($flag == 0){
		$spPostings_idspPostings = $_POST['spPostings_idspPostings'];
		$spShareByWhom = $_POST['spShareByWhom'];
		$spShareToWhom = $_POST['spShareToWhom'];
		$spShareComment = $_POST['spShareComment'];

		$pl->share($_POST);
		header("Location:../profile/index.php?post");
	}
	
?>