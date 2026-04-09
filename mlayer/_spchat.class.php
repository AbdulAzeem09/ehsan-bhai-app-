<?php 
class _spchat
{
    // property declaration
	// idspProfiles, spProfileName, spProfileEmail, spProfilePhone, spProfilePic, spUser_idspUser, spProfileType_idspProfileType
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spfriendchatting");
		$this->ta->dbclose = false;
	} 
	
	
	function create($data){
		return $this->ta->create($data);
	}


	  function read($senderprofileid,$reciverprofileid,$offset,$limit) {
        return $this->ta->read("WHERE t.spprofiles_idspProfilesSender IN ($senderprofileid,$reciverprofileid) AND  t.spprofiles_idspProfilesReciver IN ($senderprofileid,$reciverprofileid)  ORDER BY spMessageDate DESC LIMIT ".$offset.", ".$limit."");
    }

     function latestchat($ldate,$senderprofileid,$reciverprofileid,$offset,$limit) {
        return $this->ta->read("WHERE t.spprofiles_idspProfilesSender IN ($senderprofileid,$reciverprofileid) AND  t.spprofiles_idspProfilesReciver IN ($senderprofileid,$reciverprofileid) AND spMessageDate > '".$ldate."'  ORDER BY spMessageDate DESC LIMIT ".$offset.", ".$limit."");
    }
	
	
}

?>