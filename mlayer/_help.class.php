<?php
class _help
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_help");
		$this->ta->dbclose = false;
	} 
	
	// CREATE ORDER 
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	// READ HELP 
	function read($pid, $catid){
		return $this->ta->read("WHERE spCategories_idspCategory=" .$catid." AND spProfiles_idspProfile = ".$pid." ORDER BY help_id DESC");
	}
	// DELETE 
	function delete($id){
		$this->ta->remove("WHERE t.help_id= " . $id);
	}

}
?>