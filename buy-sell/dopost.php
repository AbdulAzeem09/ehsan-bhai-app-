<?php

	spl_autoload_register(function ($class) {
		include '../mlayer/' . $class . '.class.php';
	});
	
	$p = new _postings;
	
	$p->post($_POST);

?>