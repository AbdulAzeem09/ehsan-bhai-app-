<?php 
class _financereferral
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("financerefferal");
		$this->ta->dbclose = false;
	}
	//create sizes
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	//read all sizes 
	function read($uid, $cod){
		return $this->ta->read("WHERE 	uid =" .$uid." AND userrefferalid = $cod");
	}


	function readreferral($uid){
		return $this->ta->read("WHERE 	uid =" .$uid."");
	}

	   
    function updateamount($amount, $postid){
        $this->ta->update(array("amount" => $amount), "WHERE id='" . $postid . "'");
    }

	
}
?>