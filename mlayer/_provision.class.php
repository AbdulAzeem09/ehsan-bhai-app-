<?php 
class _provision
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_provision");
		$this->ta->dbclose = false;
	}
	
	//read
	function readProvision(){
		return $this->ta->read();		
	}
	// read name
	function readName($id){
		return $this->ta->read("WHERE provision_id = $id");
	}
	
}
?>