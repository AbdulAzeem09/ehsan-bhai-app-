<?php 
class _spbankdetail
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spbankdetail");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}
	
	function delete($id){
		$this->ta->remove("WHERE t.uid= " . $id);
	}
	
		// READ HELP 
	function read($uid){
		return $this->ta->read("WHERE uid=" .$uid."");
	}
}	
?>