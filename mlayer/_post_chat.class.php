<?php 
class _post_chat
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("post_chat");
		$this->ta->dbclose = false;
		$this->ta->dbclose = false;
	} 

	//add conversation
	function create($data){
		$this->ta->create($data);
	}
	//read all unread sms
	function chekunreadmessage($pid, $ptype){
		return $this->ta->read("WHERE receiver_idspprofiles = $pid AND chat_status = 0 AND spProfileType_idspProfileType = $ptype GROUP BY sender_idspProfiles ");
	}
	//get all receiver freelancer chat with person
	function  getAllReceiverConversation($pid, $ptype){
		return $this->ta->read("WHERE receiver_idspprofiles  = '$pid' OR sender_idspprofiles  = '$pid' AND sender_idspProfiles != '$pid' AND spProfileType_idspProfileType = $ptype GROUP BY sender_idspProfiles ORDER BY chat_status ASC");
	}
	//get all sender freelancer chat with person
	function  getAllSenderConversation($pid, $ptype){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' OR receiver_idspProfiles = '$pid' AND receiver_idspProfiles != '$pid' AND spProfileType_idspProfileType = $ptype GROUP BY receiver_idspProfiles ORDER BY chat_status ASC");
	}
	//check chating is new or old
	function chkNewChat($pid, $myPid, $ptype){
		return $this->ta->read("WHERE sender_idspProfiles = $pid AND receiver_idspprofiles = $myPid AND chat_status = 0 AND spProfileType_idspProfileType = $ptype");
	}
	//read chat 
	function readChat($receiver, $pid_sendr, $ptype){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid_sendr' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$pid_sendr' AND spProfileType_idspProfileType = $ptype ORDER BY chat_id ASC ");
	}
	//update chat after reading
	function updateChat($pid, $myPid, $ptype){
		return $this->ta->update(array("chat_status" => 1), "WHERE sender_idspprofiles = $pid AND receiver_idspprofiles = $myPid AND chat_status = 0 AND spProfileType_idspProfileType = $ptype");
	}

	
	//chek receiver chat already exixst or not
	function chekAlreadyChat($sender, $receiver){
		return $this->ta->read("WHERE sender_idspProfiles = '$sender' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$sender'");
	}
	
	//read last msg
	function lastMsg($pid, $myPid){
		return $this->ta->read("WHERE sender_idspProfiles = $pid AND receiver_idspprofiles = $myPid OR sender_idspProfiles = $myPid AND receiver_idspprofiles = $pid ORDER BY chat_id DESC LIMIT 1");
	}
	
}
?>