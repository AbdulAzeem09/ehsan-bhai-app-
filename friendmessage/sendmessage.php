<?php

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

// date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Canada/Central');
//print_r($_FILES);die('====');
$m = new _friendchatting;

$sp_recvr = isset($_POST["spprofiles_idspProfilesReciver"]) ? (int) $_POST["spprofiles_idspProfilesReciver"] : 0;
$sp_sendr = isset($_POST["spprofiles_idspProfilesSender"]) ? (int) $_POST["spprofiles_idspProfilesSender"] : 0;
$sp_chat = isset($_POST["spfriendChattingMessage"]) ? $_POST["spfriendChattingMessage"] : '';

$data = array(
  'spprofiles_idspProfilesReciver' => $sp_recvr,
  'spprofiles_idspProfilesSender' => $sp_sendr,
  'spfriendChattingMessage' => $sp_chat
);

$id = $m->create($data);


//$draf_message=$_POST['draf_message'];
//die("KKKKKKKKKKKKKK");
// $senderid=$_POST['senderdid'];
//$recieverid=$_POST['recieverdid']; 

$res = $m->removedraftmessage($sp_sendr, $sp_recvr);



$p = new _spprofiles;
$rpvt = $p->read($sp_recvr);
if ($rpvt != false) {
	$row = mysqli_fetch_assoc($rpvt);
	$email = $row["spProfileEmail"];
	//$em = new _email;
	//$em->sendmsgemail();

	// $headers = "From: THESHAREPAGE <admin@thesharepage.com> \r\n";
	// $msg = "You are receiving this mail because the user has sent you a message .\r\n\r\n";

	// $msg .= "See More Details click on link www.thesharepage.com/staging/friendmessage/\r\n";

	// mail($email, "The SharePage, new message.", $msg, $headers);
}


echo trim($id);
