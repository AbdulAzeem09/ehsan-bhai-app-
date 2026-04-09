<?php 
class _projecttype
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("projecttype");
		$this->ta->dbclose = false;
	}
	
	
	function readall(){
		return $this->ta->read("");
	}
	function getProjectName($projectid){
		return $this->ta->read("WHERE project_id = '$projectid'");
	}
	
}
?>