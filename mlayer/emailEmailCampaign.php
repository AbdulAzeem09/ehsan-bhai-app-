<?php


class emailEmailCampaign 
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sms_email_campaigns");
		$this->ta->dbclose = false;
	}
	
    function getemailEmailCampaign($userid , $type){
        return $this->ta->read("WHERE user_id = '$userid' AND type = '$type'");
    }

    //GET EMAIL REPORT ON SERVER
    function getemailReport($job_id){
    	
    }

}
