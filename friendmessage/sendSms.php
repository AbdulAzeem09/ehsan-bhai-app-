<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$m = new _friendchatting;


	$id = $m->create($_POST);
	$re = new _redirect;

	$p = new _spprofiles;
	$rpvt = $p->read($_POST["spprofiles_idspProfilesReciver"]);
	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		$email = $row["spProfileEmail"];
	}
		
	$headers = "From: THE-SHARE-PAGE <admin@the-share-page.com> \r\n";
	$msg = "You are receiving this mail because the user has sent you a message .\r\n\r\n";

	$msg .= "See More Details click on link http://dev.thesharepage.com/staging/friendmessage/\r\n";
	
	mail($email, "The SharePage, new message.", $msg, $headers);
	
	$re->redirect($BaseUrl."/my-friend");
	

?>