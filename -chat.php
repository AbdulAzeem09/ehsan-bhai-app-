<?php

/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

define ('DBPATH','localhost');
define ('DBUSER','osspdev');
define ('DBPASS','Office@256');
define ('DBNAME','thesharepage');

session_start();

global $dbh;
//$dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
//mysql_selectdb(DBNAME,$dbh);

	$dbh = mysqli_connect(DBPATH,DBUSER,DBPASS,DBNAME) or die(mysqli_error());


if ($_GET['action'] == "chatheartbeat") { chatHeartbeat($dbh); } 
if ($_GET['action'] == "sendchat") { sendChat($dbh); } 
if ($_GET['action'] == "closechat") { closeChat($dbh); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 
if ($_GET['action'] == "getNameOfMyChat") { getNameOfMyChat($dbh); }

//GET THE NAME AND PRINT OUT ON SCREEN
	function getNameOfMyChat($dbh){
		$pid = $_POST['pid'];
		$sql = "SELECT * FROM spprofiles WHERE idspProfiles = $pid";
		$result = mysqli_query($dbh, $sql);
		if($result){
			$row = mysqli_fetch_assoc($result);
			echo $row['spProfileName'];
		}
	}


if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat($dbh) {
	
	$sql = "select * from spfriendchatting where (spfriendchatting.spprofiles_idspProfilesReciver = '".$_SESSION['pid']."' AND spfriendChattingUnread = 0) order by idspfriendChatting ASC";
	$query = mysqli_query($dbh, $sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysqli_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['spprofiles_idspProfilesSender']]) && isset($_SESSION['chatHistory'][$chat['spprofiles_idspProfilesSender']])) {
			$items = $_SESSION['chatHistory'][$chat['spprofiles_idspProfilesSender']];
		}

		$chat['spfriendChattingMessage'] = sanitize($chat['spfriendChattingMessage']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['spprofiles_idspProfilesSender']}",
			"m": "{$chat['spfriendChattingMessage']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['spprofiles_idspProfilesSender']])) {
		$_SESSION['chatHistory'][$chat['spprofiles_idspProfilesSender']] = '';
	}

	$_SESSION['chatHistory'][$chat['spprofiles_idspProfilesSender']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['spprofiles_idspProfilesSender']}",
			"m": "{$chat['spfriendChattingMessage']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['spprofiles_idspProfilesSender']]);
		$_SESSION['openChatBoxes'][$chat['spprofiles_idspProfilesSender']] = $chat['spMessageDate'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update spfriendchatting set spfriendChattingUnread = 1 where spfriendchatting.spprofiles_idspProfilesReciver = '".$_SESSION['pid']."' and spfriendChattingUnread = 0";
	$query = mysqli_query($dbh, $sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}
//=============THIS IS AUTO CHAT LOAD

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			//print_r($chatbox);
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
		//print_r($items);
	}

header('Content-type: application/json');
//HERE IS THE NAME OF MyProfileName IS CHAT NAME
?>
{
		"username": "<?php echo $_SESSION['MyProfileName'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}
//==========THIS IS USED TO SEND A CHAT
function sendChat($dbh) {
	//this is custom name
	$from = $_SESSION['pid'];
	$to = $_POST['to'];
	$message = $_POST['message'];

	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());

	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;

	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
	echo $sql = "INSERT INTO spfriendchatting(spfriendChattingMessage, spfriendchatting.spprofiles_idspProfilesSender, spfriendchatting.spprofiles_idspProfilesReciver) VALUES ('".$message."', '".$from."', '".$to."')";
	//echo $sql = "insert into spfriendchatting (spfriendchatting.spprofiles_idspProfilesSender, spfriendchatting.spprofiles_idspProfilesReciver, spfriendChattingMessage) values ('".$from."', '".$to."','".$message."')";		
	$query = mysqli_query($dbh, $sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}