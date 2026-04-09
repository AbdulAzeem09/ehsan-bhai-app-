<?php 
class _messageactivity
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spMessageActivity");
		$this->ta->dbclose = false;
	} 
	//idspMessageActivityFlag,spMessageActivityProfile,spfriendChatting_idspfriendChatting
	function readactivity($mid)
	{
		return $this->ta->read("WHERE spfriendChatting_idspfriendChatting =".$mid." AND idspMessageActivityFlag = 0");
	}
	
	
	function deletedmessage($mid,$uid)
	{
		return $this->ta->read("WHERE spMessageActivityProfile in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spfriendChatting_idspfriendChatting =".$mid." AND idspMessageActivityFlag = 0");
	}
	
	function create($mid , $pid , $flag)
	{
		return $this->ta->create(array("idspMessageActivityFlag" => $flag ,"spMessageActivityProfile" => $pid , "spfriendChatting_idspfriendChatting" => $mid));
	}
	
	function read($mid ,$uid)
	{
		return $this->ta->read("WHERE spMessageActivityProfile in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spfriendChatting_idspfriendChatting =".$mid);
	}
	
	
	function deleteactivity($mid,$pid,$flag)
	{
		return $this->ta->remove("WHERE idspMessageActivityFlag =".$flag. " AND spMessageActivityProfile =".$pid." AND spfriendChatting_idspfriendChatting =".$mid);
	}
}
?>