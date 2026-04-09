<?php
class _spuserpoints 
{

	public $dbclose = false;
	private $conn;
	public $ta;
	
	
	function __construct() { 
		$this->ta = new _tableadapter("spuserpoints");
		$this->ta->dbclose = false;
	} 
	
	function read($id){
		
		return $this->ta->read("WHERE t.idspPoint = " . $id);
	}
	function readmypoint($id){
		return $this->ta->read("WHERE t.spUser_idspUser = " . $id);
	}
	
	
	// ==================END=============================
	// ===ADD POINTS OF THE USER
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	
}
?>
	