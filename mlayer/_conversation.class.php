<?php 
class _conversation
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spConversation");
		$this->ta->dbclose = false;
	} 
	
	
	function updateConversation($mid,$rec)
	{
		return $this->ta->update(array("spConversationFlag" => 0), "WHERE spMessaging_idspMessage ='".$mid."' AND spconversationReceiver !='".$rec."'");
	}
	
	function addconversation($data)
	{
		$this->ta->create($data);
	}
	
	function readconversation($mid)
	{
		return $this->ta->read("WHERE spMessaging_idspMessage =" .$mid);
	}
	
	function checkmessage($uid,$cid)
	{
		return $this->ta->read("WHERE spconversationReceiver Not in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND idspConversation='".$cid."'");
	}
	
	function notification($uid)
	{
		return $this->ta->read("WHERE spConversationFlag = 1 AND spconversationReceiver in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")");
		
		//return $this->ta->read("WHERE spMessaging_idspMessage in(select idspMessage from spMessaging WHERE buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid."))");
		
	}
}
?>