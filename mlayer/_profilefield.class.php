<?php 
class _profilefield
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spprofilefield");
		$this->tat = new _tableadapter("spbusiness_profile");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}
	
	function read($pid){ 
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid);
		//echo $this->ta->sql;
		
	}
	function read_to($pid){
	  $pid = $this->tat->escapeString($pid);
		return $this->tat->read("WHERE t.spprofiles_idspProfiles = " . $pid);
	   //echo $this->tat->sql;
	   
   }
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}
	//get the field which type of profile
	function getType($pid){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND spProfileFieldName = 'profiletype_'");
	}
	//get skill on 
	function getSkill($pid){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND spProfileFieldName = 'skill_'");
	}
	//chek field is add or not.
	function readField($pid, $spProfileFieldName){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = $pid AND t.spProfileFieldName = '$spProfileFieldName' ");
	}
}
?>
