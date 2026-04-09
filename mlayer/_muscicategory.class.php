<?php 
class _muscicategory
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("music_category");
		$this->ta->dbclose = false;
	} 
	
	//read all category
	function readAll(){
		return $this->ta->read();
	}
	

	
}
?>