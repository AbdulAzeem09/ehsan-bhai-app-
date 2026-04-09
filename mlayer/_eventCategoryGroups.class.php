<?php 
class _eventCategoryGroups
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("event_groups");
		$this->ta->dbclose = false;
	} 
	
	
	function readAll(){
		return $this->ta->read("ORDER BY speventGropupTitle ASC");
	}


}
?>