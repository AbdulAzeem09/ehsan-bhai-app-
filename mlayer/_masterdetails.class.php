<?php 
class _masterdetails
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("masterDetails");
		$this->ta->dbclose = false;
	} 
	
	function create($data)
	{
		$this->ta->create($data);
	}
	
	function read($masterid)
	{
		return $this->ta->read("WHERE master_idmaster=".$masterid." ORDER BY masterDetails ASC");
	}
	function all_category($mid)
	{ 
		return $this->ta->read("WHERE master_idmaster=".$mid." ORDER BY masterDetails ASC");
		 //echo $this->ta->sql ; die('-----');
	}
	function remove($masterdetails)
	{
		$this->ta->remove("WHERE t.idmasterDetails =" .$masterdetails);
	}
	//read master detail name
	function readMasterName($imd){
		return $this->ta->read("WHERE t.idmasterDetails = $imd");
	}
	/*
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($gid)
	{
		return $this->ta->read("WHERE spGroup_idspGroup =".$gid);
	}
	
	function approve($mid)
	{
		return $this->ta->update(array("spGroupMessageFlag" => 0), "WHERE idspGroupMessage ='".$mid."'");
	}*/
	
	function update($idmasterDetails,$masterDetails){
		return $this->ta->update(array("masterDetails" => $masterDetails), "WHERE idmasterDetails ='".$idmasterDetails."'");
	}
	
}
?>