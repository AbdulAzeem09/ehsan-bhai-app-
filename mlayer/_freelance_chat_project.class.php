<?php 
class _freelance_chat_project
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("freelance_project");
		$this->ta->dbclose = false;
		$this->ta->dbclose = false;
	} 
	 
	function  read_reciver($res_new){
		return $this->ta->read("WHERE id=$res_new");
		//echo $this->ta->sql;
         //die('---------');
	}
	//chek receiver chat already exixst or not
	/*function chekAlreadyChat($sender, $receiver){
		return $this->ta->read("WHERE sender_idspProfiles = '$sender' AND receiver_idspProfiles = '$receiver' OR sender_idspProfiles = '$receiver' AND receiver_idspProfiles = '$sender'");
	}*/
	//get all sender freelancer chat with person
	function  getbussinesConversation($pid){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' AND receiver_idspProfiles != '$pid' AND complete_status = 0 ORDER BY id DESC");
		 // echo $this->ta->sql;
   //          die('---------');
	}
 
	function  getfreelancerConversation($pid){
		return $this->ta->read("WHERE receiver_idspProfiles = '$pid' AND sender_idspProfiles != '$pid' AND complete_status = 0 ORDER BY id DESC");
		// echo $this->ta->sql;
  //  // die('---------');
	}

	function  read($pid){
	  $pid = $this->ta->escapeString($pid);
		return $this->ta->read("WHERE id = '$pid'");
	}

	function  completedproject($pid){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' AND complete_status = 1 ORDER BY id DESC");
	}

	function  completedincompletedproject($pid){
		return $this->ta->read("WHERE sender_idspProfiles = '$pid' AND complete_status != 0 ORDER BY id DESC");
	}

		function  freelancecompletedproject($pid){
		return $this->ta->read("WHERE receiver_idspProfiles = '$pid' AND complete_status = 1 ORDER BY id DESC");
	}

	function  freelancecompletedincompletedproject($pid){
		return $this->ta->read("WHERE receiver_idspProfiles = '$pid' AND complete_status != 0 ORDER BY id DESC");
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
		return $this->ta->create($data);
		
	}

	function updaterequeststatus($id, $status){
		return $this->ta->update(array("status" => $status), "WHERE id = $id");
	}

	function updatecompletestatus($id, $status){
		return $this->ta->update(array("complete_status" => $status), "WHERE id = $id");
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
