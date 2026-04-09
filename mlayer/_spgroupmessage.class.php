<?php 
class _spgroupmessage
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	function __construct() { 
		$this->ta = new _tableadapter("spGroupMessage");
		$this->tad = new _tableadapter("spGroupConversation");
		$this->ta->join = "INNER JOIN spProfiles as d ON t.spSenderProfile = d.idspProfiles";
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		$id = $this->ta->create($data);
		$this->tad->create(array("spGroupConversationText" => $data["conversationText_"], "spGroupMessage_idspGroupMessage" => $id, "spGroupConProfile" => $data["spSenderProfile"], "spGroupConversationCreator" =>1));
		return $id;
	}
	
	function readmessage($mid)
	{
		return $this->ta->read("WHERE idspGroupMessage =".$mid);
	}

	function newtopicdata($mid)
	{
		return $this->ta->read("WHERE idspGroupMessage =".$mid);
	}

	function read($gid)
	{
		return $this->ta->read("WHERE spGroup_idspGroup =".$gid,"ORDER BY idspGroupMessage DESC");
	}
	function readSingleGroup($gid, $sendrid, $gmsg){
		return $this->ta->read("WHERE spGroup_idspGroup =".$gid," AND idspGroupMessage = '$gmsg' AND spSenderProfile = '$sendrid'");
	}
	function approve($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 0), "WHERE idspGroupMessage ='".$mid."'");
	}
	
	function rejectMessage($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 2), "WHERE idspGroupMessage ='".$mid."'");
	}
	


	function updatedata($data, $pid) {
		return  $this->ta->update($data, "WHERE t.idspGroupMessage =" . $pid);
	  }

	  function updatedata1($data1, $textid) {
		return  $this->tad->update($data1, "WHERE t.idspGroupConversation =" . $textid);
	  }


		 function remove($postid) {
        $this->ta->remove("WHERE idspGroupMessage = " . $postid);
    }
	/*
	function addenquiry($data)
	{
		$this->ta->create($data);
	}
	
	function read($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =" .$postid);
	}
	
	function readmessage($mid)
	{
		return $this->ta->read("WHERE idspMessage =" .$mid);
	}
	
	function readmessageid($uid)
	{
		return $this->ta->read("WHERE buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")");
	}
	*/
}
?>