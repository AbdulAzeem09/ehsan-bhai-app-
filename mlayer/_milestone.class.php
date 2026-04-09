<?php 
class _milestone
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("milestone");
		$this->tab = new _tableadapter("payment_milestone");
		$this->tac = new _tableadapter("spfreelancerwallet");
		$this->tan = new _tableadapter("spprofiles");
		$this->tac->dbclose = false;
		$this->tab->dbclose = false;
		$this->ta->dbclose = false; 
	} 
	
		function  checkmilestone($pro){
		return $this->ta->read("INNER JOIN payment_milestone AS d ON t.id = d.post_id WHERE t.freelancer_projectid = '$pro' AND hired = 1 ORDER BY t.id DESC");
	}

	function  checkmilestoneposted($pro){
	  $pro = $this->ta->escapeString($pro);
		return $this->ta->read("INNER JOIN payment_milestone AS d ON t.id = d.post_id WHERE t.freelancer_projectid = '$pro' AND hired = 0 ORDER BY t.id DESC");
		 //echo $this->ta->sql;
		 //die('------');
	}

	function  allpaymentsuccess($pid){
		 return $this->ta->read("INNER JOIN payment_milestone AS d ON t.id = d.post_id WHERE t.freelancer_profileid = '$pid' AND request_status = 1 ORDER BY t.id DESC");
		// echo $this->ta->sql;
		//  die('------');

	}

		function  allpaymentcancel($pid){
		return $this->ta->read("INNER JOIN payment_milestone AS d ON t.id = d.post_id WHERE t.bussiness_profile_id = '$pid' AND request_status = 2 ORDER BY t.id DESC");

	}
	function  profile_11($rid)
	{
		return $this->tan->read("WHERE t.idspProfiles=$rid");
		 //echo $this->tan->sql;
		// die("mmm");
	}

	function  read($id){
		return $this->ta->read("WHERE id = '$id' ORDER BY id DESC");
	}
	function  readmile(){
		return $this->ta->read();
	}
	function  readfreelancer($id){
		 return $this->tac->read("WHERE seller_userid = '$id' ORDER BY id DESC");
		//echo $this->tac->sql;die("----");
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
	return	$this->ta->create($data);
		
	}

	function createmilestone($data){
	return $this->ta->create($data);
		
	}

	function updatemilestonestatus($id, $status){
		return $this->ta->update(array("request_status" => $status), " WHERE id = $id");
	}
	
	
	
	
	function updatemilestonestatus_freelancer($id, $status){
		return $this->tab->update(array("status" => $status), " WHERE pay_id = $id");
		
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
