<?php 
class _videocategory
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("video_category");
		$this->ta->dbclose = false;
	} 
	
	//read all category
	function readAll(){
		return $this->ta->read();
	}

	function get_video_category() {
		return $this->ta->read();
	}
	function get_video_category_d($data) {
		return $this->ta->read("where video_id=$data");
	}
	
	function get_category($categoryId) {
		return $this->ta->read("where video_id = $categoryId");
	}

	
}
?>