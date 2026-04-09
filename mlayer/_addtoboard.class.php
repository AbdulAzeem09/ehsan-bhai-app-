<?php 
class _addtoboard
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("addtoboard");
		$this->t = new _tableadapter("spbuiseness_files");
	//	$this->tas->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles";
		$this->tas = new _tableadapter("sppostingsartcraft");
		$this->tab = new _tableadapter("addtoboard");

		$this->ta->dbclose = false;
		
	}

	function readMyBoard2_get($postid) {
		
	    return	$this->tab->read("WHERE t.idspPostings = ".$postid." "); 
	   //echo $this->tas->sql;die('=====');
   }

	
	function readMyBoard2($postid) {
		
	    return	$this->tas->read("WHERE t.idspPostings = ".$postid." "); 
	   //echo $this->tas->sql;die('=====');
   }
	
	//add to board in art gallery
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function readdd($uid){ 
    return $this->t->read("WHERE sp_uid =$uid");
	 
	}
	
	
	function reammm(){ 
    return $this->t->read();
	
	}
	
	//chek already added or not
	function chkExist($postid, $pid){
		return $this->ta->read("WHERE spPosting_idspPosting = $postid AND spProfile_idspProfile = $pid");
	}
	//read my all board
	function readMyBoard($pid){
		 return $this->ta->read("WHERE spProfile_idspProfile = $pid ");	
		 //echo $this->ta->sql;
		 //die();	
	}
	function readMyBoards($pid){
		return  $this->ta->read("WHERE idaddtoboard = $pid ");
		   
		// echo $this->ta->sql;
		// die();	
	}
	function readMyBoardallcount($pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid");	
		// echo $this->ta->sql;
		// die();	
	}
	
	
	
	//remove to board
	function removeboard($postid, $pid){
		$this->ta->remove("WHERE spPosting_idspPosting = $postid AND spProfile_idspProfile = $pid");
	}

	function total_data($pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid");	
		// echo $this->ta->sql;
		// die();	
	}

	
}
?>