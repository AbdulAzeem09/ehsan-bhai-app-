<?php 
class _payment_milestone
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("payment_milestone");
		$this->ta->dbclose = false;
		$this->ta->dbclose = false;
	} 
	
		function  checkmilestone($pro){
		return $this->ta->read("WHERE freelancer_projectid = '$pro' ORDER BY id ASC");
	}


	function  read($id){
		return $this->ta->read("WHERE id = '$id' ORDER BY id ASC");
	}

function  read_miles($id){
		return $this->ta->read("WHERE post_id = $id ORDER BY pay_id DESC");
	}



	//chek receiver chat already exixst or not
	/*function chekAlreadyChat($sender, $receiver){
		return $this->ta->read("WHERE sender_idspProfiles = '$sender' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$sender'");
	}*/
	//get all sender freelancer chat with person
	function  getbussinesConversation($pid){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' AND receiver_idspProfiles != '$pid' GROUP BY receiver_idspProfiles ORDER BY chat_status ASC");
	}

	function  getfreelancerConversation($pid){
		return $this->ta->read("WHERE receiver_idspProfiles = '$pid' AND sender_idspProfiles != '$pid' GROUP BY receiver_idspProfiles ORDER BY chat_status ASC");
	}
	//get all receiver freelancer chat with person
	/*function  getAllReceiverConversation($pid){
		return $this->ta->read("WHERE receiver_idspprofiles  = '$pid' OR sender_idspprofiles  = '$pid' AND sender_idspProfiles  != '$pid' GROUP BY sender_idspProfiles ORDER BY chat_status ASC");
	}

	//read chat 
	function readChat($receiver, $pid_sendr){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid_sendr' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$pid_sendr' ORDER BY chat_id ASC ");
	}*/
	//add conversation
	function create($data){
	return 	$this->ta->create($data);
	//echo $this->ta->sql;
		
	}

	function updaterequeststatus($id, $status){
		return $this->ta->update(array("status" => $status), "WHERE id = $id");
	}
	//read all unread sms
	/*function chekunreadmessage($pid){
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
	}*/
	
}
?>