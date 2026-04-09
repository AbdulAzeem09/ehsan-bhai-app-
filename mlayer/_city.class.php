<?php 
class _city
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("consult_tbl_city");
		
				$this->tac = new _tableadapter("country");

		$this->ta->dbclose = false;
	}
	
	//read
	function readCity($id){
	    return $this->ta->read("WHERE state_id = $id ORDER BY city_title ASC");	
	// 	 echo $this->ta->sql;
	// 	 die("mmm");	
	 }
	// read city name
	function readCityName($id){
		return $this->ta->read("WHERE city_id = $id");
	}


	function readCityName_country($id){
		return  $this->tac->read("WHERE t.code = '$id'");
	echo  $this->tac->sql; die('xxxxxxxxx');
	}
	
}
?>