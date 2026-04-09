<?php 
class _relation
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("familyrelation");
		$this->ta->dbclose = false;
	}
	
	//read
	function readrelation(){
		return $this->ta->read("ORDER BY city_title ASC");		
	}
	// read city name
	function readCityName($id){
		return $this->ta->read("WHERE city_id = $id");
	}

	
}
?>