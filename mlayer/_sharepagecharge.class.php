<?php
class _sharepagecharge
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spsharepagecharges");
		$this->ta->dbclose = false;
	} 
 
 function read($category)
	{
		return $this->ta->read("where t.spcategories_idspCategory = " . $category);
	}
}
?>