<?php


class emailCampaignUser 
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("email_campaign_user");
		$this->ta->dbclose = false;
	}
	
    function getImportEmail($userid){
        return $this->ta->read("WHERE user_id = '$userid'");
    }
    
}
