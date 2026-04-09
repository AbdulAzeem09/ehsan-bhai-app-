<?php 
class _spfamily_profile 
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spfamily_profile");

		$this->fa = new _tableadapter("add_family_relation");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}


	
	function create_family($data)
	{
		$id = $this->fa->create($data);
		return $id;
	}
	
	function read($pid){
	  $pid = (int)$pid;
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid);
	}

	function delete_family($pid){
	    $pid = (int)$pid;
		 $this->fa->remove("WHERE t.family_id = " . $pid);
		 //echo $this->fa->sql;die('+++');
	}

	function read_famly($id){
	  $id = (int)$id;
		return $this->fa->read("WHERE t.family_id = " . $id);
		//echo $this->fa->sql;die('+++');
	}
	
	function update($data, $pid){
		return $this->ta->update($data, $pid);
	}
	//get the field which type of profile
	function getType($pid){
	  $pid = (int)$pid;
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND spProfileFieldName = 'profiletype_'");
	}
	//get skill on 
	function getSkill($pid){
	  $pid = (int)$pid;
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND spProfileFieldName = 'skill_'");
	}
	//chek field is add or not.
	function readField($pid, $spProfileFieldName){
	  $pid = (int)$pid;
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = $pid AND t.spProfileFieldName = '$spProfileFieldName' ");
	}
}
?>
