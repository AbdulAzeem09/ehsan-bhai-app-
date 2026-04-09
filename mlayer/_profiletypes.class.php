<?php 
class _profiletypes
{
    // property declaration
	// idspProfileType, spProfileTypeName
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	function __construct() { 
		$this->ta = new _tableadapter("spProfileType");
		//$this->ta->join = "INNER JOIN spProfiles as d ON t.idspProfileType = d.spProfileType_idspProfileType INNER JOIN spcategory_has_spprofiletypes as p ON t.idspProfileType = p.spProfileType_idspProfileType";
		$this->tad = new _tableadapter("spcategory_has_spprofiletypes");
		$this->ta->dbclose = false;
	} 
	
	function read(){
		return $this->ta->read("WHERE t.idspProfileType != 0","", "DISTINCT idspProfileType, spProfileTypeName");
		//echo $this->ta->sql;die('============5555555');
	}
	
	function readProfileType($ptid){
		return $this->ta->read("WHERE t.idspProfileType = " . $ptid);
	}
	 
}
?>