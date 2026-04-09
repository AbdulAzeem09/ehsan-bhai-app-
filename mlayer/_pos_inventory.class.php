<?php 
class _pos_inventory
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $ts;
	
	function __construct() { 
		$this->ta = new _tableadapter("pos_inventory");
		$this->tad = new _tableadapter("tbl_contact_issue_topic");    
		$this->ts = new _tableadapter("tbl_social");
		$this->mem = new _tableadapter("membership_pos");
		$this->cur = new _tableadapter("spuser");
		$this->ta->dbclose = false;
	}



	function updateactive($data,$id){
		$this->ta->update($data,"WHERE id=$id and status=3");

	   echo  $this->ta->sql; die('---------------------');
	   }
	
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
		
	}
	
	function create_membership($data)
	{
		$id = $this->mem->create($data);
		return $id;
		
	}
	function currency($uid){
	return $this->cur->read("WHERE idspuser=$uid");
	
	}
	
	
	function read_membership($uid){
	return $this->mem->read("WHERE spuser_idspuser=$uid");
	}
	
	function read_membership_id($id){
	return $this->mem->read("WHERE id=$id");
	}
	function update_membership($data,$id){
	return $this->mem->update($data,"WHERE id=$id");
	}
	
	function delete_membership($id){
	$this->mem->remove("WHERE id=$id");
	}
	// ===========TABLE CONTACT ISSUE==============
	function read_data($pid){
		return $this->ta->read("WHERE pid = $pid");  
	}
	
	
	function read_data_id($id){
		return $this->ta->read("WHERE id = $id");  
	}
	
	function remove($id){
		return $this->ta->remove("WHERE id = $id");   
	}
	
	
	function update($data,$res){
		 $this->ta->update($data," WHERE id = $res "); 
//echo  $this->ta->sql; die('-----');
		
	}


	// ===========TABLE SOCIAL==============
	function readSocial(){
		return $this->ts->read();
	}

}
?>