<?php
class _friendchatting
{

	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->taa = new _tableadapter("spdraftmessage");
 

		$this->ta = new _tableadapter("spfriendChatting");  
		$this->ta->dbclose = false;
	}


	function updatedraftmessage($senderid, $recieverid, $draf_message)
	{

		return  $this->taa->update(array("draft_message" => $draf_message), "WHERE senderid =" . $senderid . " AND recieverid = $recieverid ");
		//echo $this->ta->sql;
		//die("success"); 

	}

	function createdraftmessage($data)
	{
		return $this->taa->create($data);
	}
	function create_files($data)
	{
		$this->ta->create($data);
		//echo $this->ta->sql;die('=====');

	}

	function readdraftmessage($sender, $receiver)
	{
		return $this->taa->read("WHERE senderid =$sender AND recieverid =$receiver");
	}

	function removedraftmessage($sender, $receiver)
	{
		return $this->taa->remove("WHERE senderid =$sender AND recieverid =$receiver");
	}

	function deletechat($sender, $receiver)
	{
		return  $this->ta->remove("WHERE ((spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver =" . $receiver . ") OR (spprofiles_idspProfilesReciver =" . $sender . " AND spprofiles_idspProfilesSender =" . $receiver . "))");
	}

	//all unread texts show on home timeline
	function totalunread($pid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver = $pid AND spfriendChattingUnread = 0");
		echo $this->ta->sql;
	}
	//get all msgs which i have to received by user
	function totalUnreadReceiver($pid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver = $pid  GROUP BY spprofiles_idspProfilesSender ORDER BY t.spMessageDate DESC");
		echo $this->ta->sql;die('===');
	}

	function totalUnreadReceiver_freelancer($pid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver = $pid  AND module='freelancer' GROUP BY spprofiles_idspProfilesSender ORDER BY t.spMessageDate DESC");
		echo $this->ta->sql;
	}


	function totalUnreadReceiver_new($pid, $where)
	{
			return $this->ta->read("WHERE  $where  ORDER BY idspfriendchatting DESC");     
		//echo $this->ta->sql;
		 
	}

	function read_id_msg($id)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender=$id   ORDER BY idspfriendChatting DESC LIMIT 1");
		echo $this->ta->sql;
	}

	function read_id_msg_freelancer($id)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender=$id AND module='freelancer'  ORDER BY idspfriendChatting DESC LIMIT 1");
		echo $this->ta->sql;
	}


	function read_id_msg_rec($id)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver=$id   ORDER BY idspfriendChatting DESC LIMIT 1");
		echo $this->ta->sql;
	}


	function read_id_msg_rec_freelancer($id)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver=$id AND module='freelancer'   ORDER BY idspfriendChatting DESC LIMIT 1");
		echo $this->ta->sql;
	}
	//get all msgs which i have to send by user
	function totalUnreadSender($pid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender = $pid  GROUP BY spprofiles_idspProfilesReciver ORDER BY t.spMessageDate DESC");
		echo $this->ta->sql;  die;
	}


	function totalUnreadSender_freelancer($pid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender = $pid  AND module='freelancer' GROUP BY spprofiles_idspProfilesReciver ORDER BY t.spMessageDate DESC");
		echo $this->ta->sql;
		die;
	}


	// READ ALL SMS
	/*function read($sender, $receiver){
		return $this->ta->read("WHERE ((spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver.") OR (spprofiles_idspProfilesReciver =" .$sender." AND spprofiles_idspProfilesSender =".$receiver."))","ORDER BY spMessageDate","t.spfriendChattingMessage, t.spMessageDate, t.spprofiles_idspProfilesSender, t.spprofiles_idspProfilesReciver, t.idspfriendChatting, t.spfriendChattingUnread");
	}*/
	function read($sender, $receiver)
	{
		return $this->ta->read("WHERE ((spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver =" . $receiver . ") OR (spprofiles_idspProfilesReciver =" . $sender . " AND spprofiles_idspProfilesSender =" . $receiver . "))");
	}

	//all unread msg 
	function unreadmessage($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->read("WHERE spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver = $pid AND spfriendChattingUnread = 0 ORDER BY spMessageDate DESC");
		//echo $this->ta->sql;
		//die("success");

	}

	function unreadmessage_freelancer($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->read("WHERE spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver = $pid AND spfriendChattingUnread = 0 AND module='freelancer' ORDER BY spMessageDate DESC");
		//echo $this->ta->sql;
		//die("success");

	}

	function unreadmessage22($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver =" . $sender . " AND spprofiles_idspProfilesSender = $pid AND spfriendChattingUnread = 0 ORDER BY spMessageDate DESC");
		//echo $this->ta->sql;
		//die("success");

	}

	function unreadmessage22_freelancer($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver =" . $sender . " AND spprofiles_idspProfilesSender = $pid AND spfriendChattingUnread = 0  AND module='freelancer' ORDER BY spMessageDate DESC");
		//echo $this->ta->sql;
		//die("success");

	}



	function updatemessagestatus($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->update(array("spfriendChattingUnread" => 1), "WHERE spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver = $pid ");
		// $this->ta->sql; 
		//die("success"); 

	}

	function updatemessagestatus_freelancer($sender, $pid)
	{
		//return $this->ta->read("WHERE spprofiles_idspProfilesSender =" .$sender." AND spprofiles_idspProfilesReciver =".$receiver." AND spfriendChattingUnread = 0");
		return $this->ta->update(array("spfriendChattingUnread" => 1), "WHERE spprofiles_idspProfilesSender =" . $sender . " AND spprofiles_idspProfilesReciver = $pid  AND module='freelancer'");
		// $this->ta->sql; 
		//die("success"); 

	}


	// LAST MSG OF MY CHAT
	function lastmsg($mypid, $recid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender =" . $mypid . " AND spprofiles_idspProfilesReciver = $recid OR spprofiles_idspProfilesSender = $recid AND spprofiles_idspProfilesReciver = $mypid ORDER BY idspfriendChatting DESC LIMIT 1");
		//echo $this->ta->sql;die;
	}


	function nonfriendmsg($uid, $receiver)
	{
		return $this->ta->read("WHERE ((spprofiles_idspProfilesSender in(Select idspProfiles from spProfiles where spUser_idspUser =" . $uid . ") AND spprofiles_idspProfilesReciver =" . $receiver . ") OR (spprofiles_idspProfilesReciver in(Select idspProfiles from spProfiles where spUser_idspUser =" . $uid . ") AND spprofiles_idspProfilesSender =" . $receiver . "))", "ORDER BY spMessageDate DESC");
	}

	function assenderfriendid($uid, $mid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender in(Select idspProfiles from spProfiles where spUser_idspUser !=" . $uid . ") AND idspfriendChatting =" . $mid);
	}

	function unsetarchive($mid)
	{
		return $this->ta->update(array("spfriendChattingArchive" => ""), "WHERE idspfriendChatting ='" . $mid . "'");
	}

	function unsetstarred($mid)
	{
		return $this->ta->update(array("spfriendChattingArchive" => ""), "WHERE idspfriendChatting ='" . $mid . "'");
	}


	function starredmessage()
	{
		return $this->ta->read();
	}

	function assender($uid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")");
	}

	function asreceiver($uid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")", "ORDER BY idspfriendChatting DESC");
	}

	function publicmessage($uid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesReciver in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")", "GROUP BY spprofiles_idspProfilesSender");
	}

	function publictomessage($uid)
	{
		return $this->ta->read("WHERE spprofiles_idspProfilesSender in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")", "GROUP BY spprofiles_idspProfilesReciver");
	}

	//create sms with profile
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}

	function unread($mid)
	{
		return $this->ta->update(array("spfriendChattingUnread" => 1), "WHERE idspfriendChatting ='" . $mid . "'");
	}
	//update all unread msg to read msg
	function unreadMsg($data, $sender, $receiver)
	{
		return  $this->ta->update($data, "WHERE spprofiles_idspProfilesSender =$sender AND spprofiles_idspProfilesReciver ='$receiver' AND spfriendChattingUnread = 0 ");
		//echo $this->ta->sql;
	}
	function readmessage($mid)
	{
		return $this->ta->update(array("spfriendChattingUnread" => "1"), "WHERE idspfriendChatting ='" . $mid . "'");
	}

	function readmessage_click($sender, $mid)
	{
		// print_r($sender,$pid);
		// print_r($pid);
		// exit;
		return $this->ta->update(array("spfriendChattingUnread" => "1"), "WHERE spprofiles_idspProfilesSender =$sender  AND spprofiles_idspProfilesReciver =$mid");
	}
}
