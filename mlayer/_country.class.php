<?php 
class _country
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("tbl_country");
		$this->ta->dbclose = false;
	}
	
	//read
	function readCountry(){
		return $this->ta->read("ORDER BY country_title ASC");		
	}
	// read country name
	function readCountryName($id){
	  $id = $this->ta->escapeString($id);
	  return $this->ta->read("WHERE country_id = $id");
	}
	
	function updateCountryCode($code, $name){
	  return $this->ta->update(array("country_code" => $code), "WHERE country_title = '$name'");
	}
	

	
}
?>
