<?php 
class _spshipping
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spshipping");//spShipping
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		return $this->ta->create($data);
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