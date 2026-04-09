<?php 
class _flageventpost
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("flagpost");
		$this->flag_ta = new _tableadapter("flagged_jobprofile");
		$this->job_ta = new _tableadapter("spjobboard");
		$this->ta->dbclose = false;
	}
	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
/*	// DELETE ENQUIRY
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)


	function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}
*/

	 function readFlagJob($pid,$private){
        return $this->flag_ta->read(
			"INNER JOIN music_cat AS c ON c.category_id = t.category_id
			"
		);
    }

	
}
?>