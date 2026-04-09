<?php 
class _groupconversation
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spGroupConversation");
		$this->text = new _tableadapter("group_category");
		$this->text2 = new _tableadapter("spgroup_intrest");
		$this->member= new _tableadapter("spprofiles_has_spgroup");
		$this->pa = new _tableadapter("spgroup");
			$this->ta->join = "INNER JOIN spProfiles as d ON t.spGroupConProfile = d.idspProfiles";
		$this->ta->dbclose = false;
		//$this->ta->dbclose = false;
	} 
	
	function readPost22(){
    return $this->text->read("WHERE status = 0");
}


function readPost33(){
    return $this->text2->read("WHERE profile_id = ".$_SESSION['pid']. "");
}




function readpa($groupid){
    return $this->pa->read("WHERE idspGroup = ".$groupid."");
}


function readmember($grpid , $profid){
    return $this->member->read("WHERE spGroup_idspGroup= $grpid AND spProfiles_idspProfiles= $profid AND spApproveRegect = 1");
	//echo $this->member->sql;
	//die("=====");
}
	
	 
	
	
	function create($data)
	{
		$this->ta->create($data);
		
	}
	
	function read($mid){
		return $this->ta->read("WHERE spGroupMessage_idspGroupMessage =".$mid . " AND spGroupConversationCreator IS NULL ORDER BY idspGroupConversation DESC");
	}
	function readCreaterMsg($mid){
		return $this->ta->read("WHERE spGroupMessage_idspGroupMessage =".$mid . " AND spGroupConversationCreator =1 ");
	}


	
	/*function readconversation($mid)
	{
		return $this->ta->read("WHERE spMessaging_idspMessage =" .$mid);
	}
	
	function notification($uid)
	{
			//return $this->ta->read("WHERE d.buyerProfileid in(select idspProfiles from spprofiles WHERE spUser_idspUser =".$uid.") OR d.sellerProfileid in(select idspProfiles from spprofiles WHERE spUser_idspUser =".$uid.")");
			
			return $this->ta->read("WHERE spMessaging_idspMessage in(select idspMessage from spMessaging WHERE buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid."))");
		
	}*/
}
?>