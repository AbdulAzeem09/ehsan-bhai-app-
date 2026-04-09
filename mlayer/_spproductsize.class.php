<?php 
class _spproductsize
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spproductsize");//spShipping
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($pid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE productid =".$pid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}

   function updatesize($data,$pid)
	{
	   return $this->ta->update($data, "WHERE productid ='".$pid."'");
	}

}

?>