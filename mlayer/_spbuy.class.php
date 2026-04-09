<?php 
class _spbuy
{
    // property declaration
	// idspProfiles, spProfileName, spProfileEmail, spProfilePhone, spProfilePic, spUser_idspUser, spProfileType_idspProfileType
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spBuyPostings");
		$this->ta->dbclose = false;
	} 
	
	
	function create($data){
		return $this->ta->create($data);
	}
	
}

?>