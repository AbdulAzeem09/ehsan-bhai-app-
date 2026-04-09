<?php 
class _eventJoin
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("event_join");
		$this->ta->dbclose = false;
	}
	//create event join
	function create($postid, $pid, $org, $stat){
		$id = $this->ta->create(array("spPosting_idspPosting" => $postid, "spProfile_idspProfile" => $pid,"spEventjoin_type" => $org, "spEventjoin_status" =>$stat));
		return $id;
	}
	//read exist or not in organizer
	function chekEventExixt($postid, $type, $pid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND spEventjoin_type = $type AND spProfile_idspProfile = $pid");
	}
	//chek status active or in-active
	function chekStatus($postid, $pid, $type){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND spEventjoin_type = $type AND spProfile_idspProfile = $pid");
	}

	
}
?>