<?php

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	$pl = new _postenquiry;
	$txtemail = $_POST['txtemail'];
	$txtlink  = $_POST['txtlink'];

	$headers = "From: the-share-page <admin@the-share-page.com> \r\n";
	$msg = "Hi,<br>You are receiving this mail because the user has enquired you.\r\n\r\n";

	$msg .= "See More Details click on link ".$txtlink."/\r\n";

	mail($txtemail, "The SharePage, new job.", $msg, $headers);
	
	$re = new _redirect;
	$re->redirect($txtlink);
	//header('location:'.$txtlink);
?>