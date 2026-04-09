<?php
class _training
{
    
    public $dbclose = false;
	private $conn;
	public $ta;

	
	function __construct() { 
		$this->ta = new _tableadapter("training_order_list");
		$this->ta->dbclose = false;
	}

	function create($data){
		return $this->ta->create($data);
	}

	function readTrain($postid){
		return $this->ta->read("WHERE t.spTrainId ='".$postid."' GROUP BY t.spProfileId");
	}
	
		function read_now($pid)
	{
		return $this->ta->read("where t.spProfileId = " . $pid );
	}

}