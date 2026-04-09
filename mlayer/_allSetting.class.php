<?php 
class _allSetting
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		
		$this->ta = new _tableadapter("tbl_setting");
		$this->ta->dbclose = false;
	}
	
	function showBanner($catId){
		return $this->ta->read("WHERE spCategory_idspCategory= " . $catId);
	}
}
?>