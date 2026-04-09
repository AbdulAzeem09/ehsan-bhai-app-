<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	$pl = new _conversation;
	$pl->addconversation($_POST);
	
	$p = new _spprofiles;
	$rpvt = $p->read($_POST["spconversationReceiver"]);
	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		$email = $row["spProfileEmail"];
	}
		
	$headers = "From: THE SHAREPAGE <admin@thesharepage.com> \r\n";
	$msg = "You are receiving this mail because the user has sent response on your enquiry .\r\n\r\n";

	$msg .= "See More Details click on link http://dev.thesharepage.com/enquiry/notification.php/\r\n";
	
	mail($email, "The SharePage, enquiry response.", $msg, $headers);
?>