<?php 
class _realenquiry
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("realenquiry");
		$this->ta->dbclose = false;
	}
	//add all fields
	function create($data){
		return $this->ta->create($data);
		
	}
	//read all enquery of specific profile
	function readMyEnquery($pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid");
	}
	//read single enquiry
	function read($iae){
		return $this->ta->read("WHERE idartenquiry = $iae");
	}
	
}
?>