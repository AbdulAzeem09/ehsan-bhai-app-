<?php 
class _eventCategory
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("event_category");
		$this->ta->dbclose = false;
	} 
	
	
	function readAll(){
		return $this->ta->read("ORDER BY speventTitle ASC");
	}
	

	
}
?>