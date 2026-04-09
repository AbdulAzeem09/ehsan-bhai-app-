<?php 
class _spemployment_profile 
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spemployment_profile");
		$this->empedu = new _tableadapter("employment_education");
		$this->empex = new _tableadapter("employment_experience");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}
	
	 
	 	function removeexperience($postid){
		$this->empex->remove("WHERE t.id =".$postid);
	} 
	
	
	
		function createEmpEdu($data)
	{
		$this->empedu->create($data);
		
	}
	
			function createEmpExp($data)
	{
	    $data = $this->ta->escapeArray($data);
		return $this->empex->create($data);
	}
	 
		function readEmpEdu($idspProfiles, $spProfileType_idspProfileType)
	{  
	      $idspProfiles = (int)$idspProfiles;
      	return $this->empedu->read("WHERE t.idspProfiles = " . $idspProfiles." AND spProfileType_idspProfileType = ". $spProfileType_idspProfileType. "");
    }
	
		function readEmpExp($idspProfiles, $spProfileType_idspProfileType)
	{
	    $idspProfiles = (int)$idspProfiles;
		return $this->empex->read("WHERE t.id = " . $idspProfiles." AND spProfileType_idspProfileType = ". $spProfileType_idspProfileType. "");
	}  
	
	function readEmpExp1($idspProfiles, $spProfileType_idspProfileType)
	{
	  $idspProfiles = (int)$idspProfiles;
		return $this->empex->read("WHERE t.idspProfiles = " . $idspProfiles." AND spProfileType_idspProfileType = ". $spProfileType_idspProfileType. "");
	} 
	
	function read($pid){
	  $pid = (int)$pid;
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = " . $pid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}
	
  function updateExp($data, $pid){
		$this->empex->update($data, $pid);
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
	  $spProfileFieldName = $this->ta->escapeString($spProfileFieldName);
		return $this->ta->read("WHERE t.spprofiles_idspProfiles = $pid AND t.spProfileFieldName = '$spProfileFieldName' ");
	}
	
  function removeedu($postid){
		$pid = (int)$pid;
		$this->empedu->remove("WHERE t.idspProfiles =".$postid);
	}
	
		
	function removeexp($postid){
		$pid = (int)$pid;
		$this->empex->remove("WHERE t.idspProfiles =".$postid);
	}
	
}
?>
