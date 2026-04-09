<?php 
class _freelance_recomndation
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("freelance_recomndation");
		$this->smta = new _tableadapter("freelance_recomndation");
		$this->ta_review = new _tableadapter("freelancer_project_review");
		$this->ta->dbclose = false;
		$this->ta->dbclose = false;
	} 
	
	//add recomndation
	function create($data){
		$this->ta->create($data);
		
	}

	function  checkreview($pid,$pro_id){
		return $this->ta->read("WHERE postProject_idspProfiles = '$pid' AND hired = 1 AND spPosting_idspPostings= '$pro_id'");
	}

	function  checkpostedreview($pid,$pro_id){
		return $this->ta->read("WHERE postProject_idspProfiles = '$pid' AND hired = 0 AND spPosting_idspPostings= '$pro_id'");
	}

	function readfreelancerating($pid){
		return $this->ta->read("WHERE freelanceProject_idspProfiles = $pid ");
		//echo $this->ta->sql;
	}

	
	function show_status_m($pid){
		return $this->smta->read("WHERE to_person= $pid");
		//  echo $this->smta->sql;
		//  die("nnmm");
	}
	function read_review_rating_m($postid)
	{
		return $this->ta_review->read("WHERE t.to_person=$postid and project_owner = 0");
		//echo $this->ta_review->sql;
		 //die("mmm");
	}
	

	
}
?>