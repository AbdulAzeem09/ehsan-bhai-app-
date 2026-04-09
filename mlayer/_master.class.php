<?php 
class _master
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("master");
		$this->ta->dbclose = false;
	} 
	
	function read($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings=" .$postid);
	}
	/*
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($gid)
	{
		return $this->ta->read("WHERE spGroup_idspGroup =".$gid);
	}
	
	function approve($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 0), "WHERE idspGroupMessage ='".$mid."'");
	}
	
	function rejectMessage($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 2), "WHERE idspGroupMessage ='".$mid."'");
	}
	*/
}
?>