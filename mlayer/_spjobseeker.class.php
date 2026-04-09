<?php 
class _spjobseeker
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("jobseekerProfile");
			$this->tap = new _tableadapter("spjobboard");
		$this->ta->dbclose = false;
	}
	
	function read($pid)
	{
		return $this->ta->read("where t.spProfiles_idspProfiles = " . $pid );
	}
	
	function read_now($pid)
	{
		return $this->tap->read("where t.spProfiles_idspProfiles = " . $pid );
	}
	
	function removeProfiles($pid) { 
        $this->tap->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
    }  
	
	
}
?>