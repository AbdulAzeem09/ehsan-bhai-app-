<?php 
class _freelance_chat
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	public $jss;
	
	function __construct() { 
		$this->ta = new _tableadapter("freelance_chat");
		$this->tap= new _tableadapter("freelancer_newfield");
		$this->jss= new _tableadapter("jobboard_save");
		$this->ta->dbclose = false;
		$this->ta->dbclose = false;
	} 
	
	
	//chek receiver chat already exixst or not
	function chekAlreadyChat($sender, $receiver){
		return $this->ta->read("WHERE sender_idspProfiles = '$sender' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$sender'");
	}
	//get all sender freelancer chat with person
	function  getAllSenderConversation($pid){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' OR receiver_idspProfiles = '$pid' AND receiver_idspProfiles != '$pid' GROUP BY receiver_idspProfiles ORDER BY chat_status ASC");
	}
	//get all receiver freelancer chat with person
	function  getAllReceiverConversation($pid){
		return $this->ta->read("WHERE receiver_idspprofiles  = '$pid' OR sender_idspprofiles  = '$pid' AND sender_idspProfiles  != '$pid' GROUP BY sender_idspProfiles ORDER BY chat_status ASC");
	}

	//read chat 
	function readChat($receiver, $pid_sendr){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid_sendr' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$pid_sendr' ORDER BY chat_id ASC ");
	}
	//add conversation
	function create($data){
		$this->ta->create($data);
		
	}
	//read all unread sms
	function chekunreadmessage($pid){
		return $this->ta->read("WHERE receiver_idspprofiles = $pid AND chat_status = 0 GROUP BY sender_idspProfiles");
	}
	//check chating is new or old
	function chkNewChat($pid, $myPid){
		return $this->ta->read("WHERE sender_idspProfiles = $pid AND receiver_idspprofiles = $myPid AND chat_status = 0");
	}
	//update chat after reading
	function updateChat($pid, $myPid){
		return $this->ta->update(array("chat_status" => 1), "WHERE sender_idspprofiles = $pid AND receiver_idspprofiles = $myPid AND chat_status = 0");
	}
	//read last msg
	function lastMsg($pid, $myPid){
		return $this->ta->read("WHERE sender_idspProfiles = $pid AND receiver_idspprofiles = $myPid ORDER BY chat_id DESC LIMIT 1");
	}
	
	
		function get_profile_portfolio($profileid){
		return  $this->tap->read(" WHERE spPid = $profileid AND portFreelancer = 1");  
		// echo $this->tap->sql; die('xxxx');
	}
	function insert_savejob($data){
		 $this->jss->create($data);

		// echo $this->jss->sql;
		// die("-------------------");

	}
	function delete_savejob($unsave){
		return $this->jss->remove("WHERE save_id = $unsave");
		//echo $this->jss->sql;  
		//die("-----------------");

	}
	
}
?>