<?php 
class _returnrefund
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spRetRefund");
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		$this->ta->create($data);
	}
	
	function read($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}
}
?>