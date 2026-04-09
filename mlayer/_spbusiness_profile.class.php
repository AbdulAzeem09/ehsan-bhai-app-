<?php 
class _spbusiness_profile
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spbusiness_profile");
		$this->ta44 = new _tableadapter("spprofiles");
		$this->ta55 = new _tableadapter("spuser");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}
	function sp_read_8($pid){
		return $this->ta55->read("WHERE t.idspUser = " . $pid);
		//echo $this->ta55->sql;

	}
	function sp_read($pid){
	  $pid = $this->ta44->escapeString($pid);
		return $this->ta44->read("WHERE t.idspProfiles = " . $pid);
		//echo $this->ta44->sql;

	}
	function read($pid){
	  $pid = $this->ta->escapeString($pid);
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid);
		//echo $this->ta->sql; die('==========');
	}

	function readlimit($pid){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid,"LIMIT 5");
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

   function getCategory($pid,$cat){ 
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid." AND businesscategory =  '$cat'");
		//echo $this->ta->sql; die('==========');
	}

	//chek field is add or not.
	function readField($pid, $spProfileFieldName){
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = $pid AND t.spProfileFieldName = '$spProfileFieldName' ");
	}
}
