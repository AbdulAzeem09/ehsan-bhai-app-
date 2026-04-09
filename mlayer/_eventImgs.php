<?php 
class _eventImgs
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("events_imgs");
		$this->ta->dbclose = false;
	}
	
	//add to board in art gallery
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function imgList()
	{
		
     return 1;
	}

	
}
?>