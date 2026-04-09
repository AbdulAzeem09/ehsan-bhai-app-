<?php 
class _speventlinkperson
{
    public $dbclose = false;
	private $conn;
	public $tal;
	
	function __construct() { 
		$this->tal = new _tableadapter("spevent_linkperson");
		$this->tal->dbclose = false;
	}
	
	function update($data, $where){

        $this->tal->update($data, $where);
	    }

	 function create($data){
        return $this->tal->create($data);
    }

	//read
	function read($eid,$type){
		return $this->tal->read("WHERE event_id = $eid and ass_person_type='$type'");		
	}
	
}
?>