<?php 
class _eventIntrest
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("event_intrest");
		$this->ta->dbclose = false;
	}
	
	//create event intrest
	function create($postid, $pid, $area){
		$id = $this->ta->create(array("spPostings_idspPostings" => $postid, "spProfile_idspProfile" => $pid,"intrestArea" => $area));
		return $id;
	}
	//update kry gy agr aik dafa entr ho gya ha to
	function update($postid, $pid, $area){
		$this->ta->update(array("intrestArea" => $area), "WHERE spPostings_idspPostings = $postid AND spProfile_idspProfile = $pid");
	}
	//chek kry gy pahly say ha ya ni
	function chekAlready($postid, $pid){
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spProfile_idspProfile = $pid");
	}
	//complete going person on event
	function chekGoing($postid, $intrest){
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND intrestArea = $intrest");
	}

}
?>