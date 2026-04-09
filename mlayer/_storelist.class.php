<?php 
class _storelist
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		/*$this->ta = new _tableadapter("addenquiry");*/
		$this->ta = new _tableadapter("addservenquiry");
		$this->em = new _tableadapter("enquiry_msg");
		$this->taaa = new _tableadapter("spstorewallet");
		$this->ta->dbclose = false;
	}
	
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	
	function readEnq($enqid){
	     return $this->ta->read("WHERE enquiry_id= " . $enqid);
	}
	//my code
	
	function readstorelist(){
	     return $this->taaa->read();
	}
	
	
	//end my code
	
	function createmsg($data){
		$this->em->create($data);
	}
	
		function readEnqmsg($enqid){
	    return  $this->em->read("WHERE t.enq_id= $enqid ORDER BY id DESC");

	}
}
?>