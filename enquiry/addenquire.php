<?php

		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	$pl = new _postenquiry;
	$pl->addenquiry($_POST);
	
	$p = new _spprofiles;
	$rpvt = $p->read($_POST["sellerProfileid"]);
	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		$email = $row["spProfileEmail"];
	}
		
	$headers = "From: THE SHAREPAGE <admin@thesharepage.com> \r\n";
	$msg = "You are receiving this mail because the user has enquired on your post .\r\n\r\n";

	$msg .= "See More Details click on link http://dev.thesharepage.com/enquiry/notification.php/\r\n";
	
	mail($email, "The SharePage, new enquiry.", $msg, $headers);

?>