<?php 
class _spusershipadd
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("usershippingaddress");//spShipping
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($uid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE uid =".$uid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}

}

?>