<?php 
class _cities
{
    // property declaration
	// idspCity, spCityName
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spCities");
		$this->ta->dbclose = false;
	} 
	
	function citylist($name, $id){
		$result = $this->ta->read("WHERE t.spCityName  like ('%" . $name . "%') and spCountries_idspCountries = " . $id);
		// $result = $this->ta->read("WHERE t.spCityName,  like ('%" . $name . "%')");
		// echo $this->ta->sql;
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['spCountries_idspCountries'], 'label'=>$rs['spCityName']);
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
}
?>