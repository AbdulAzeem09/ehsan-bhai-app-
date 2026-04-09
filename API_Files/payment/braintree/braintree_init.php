<?php 

	session_start();

	require_once("lib/autoload.php");

/*	 if(file_exists(__DIR__ . "/../.env"));

	 {

	 	$dotenv= new Dotenv\Dotenv(__DIR__ . "/../");

	 	$dotenv->load();

	}*/



	Braintree_Configuration::environment("sandbox");

	Braintree_Configuration::merchantId("gjypfzgxc5xghnvk");

	Braintree_Configuration::publicKey("wvztc568xgp7y2g7");

	Braintree_Configuration::privateKey("9cfef0dcbb0a7e5d25e11099db69085b");

 ?>