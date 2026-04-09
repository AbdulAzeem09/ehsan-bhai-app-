<?php 
class _artSize
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("artsizes");
		$this->ta->dbclose = false;
	}
	//create sizes
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	//read all sizes 
	function read(){
		return $this->ta->read();
	}
	
}
?>