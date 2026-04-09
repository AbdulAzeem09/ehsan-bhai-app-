<?php
class _admcommission 
{

	public $dbclose = false;
	private $conn;
	public $ta;
	
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_admcommission");
		$this->tad = new _tableadapter("commission_payment_history");
		$this->ta->dbclose = false;
	} 
	
	function read($id){
		
		return $this->ta->read("WHERE t.comm_id = " . $id);
	}

	function create($data){
		$id = $this->tad->create($data);
		return $id;
	}

	
}
?>
	