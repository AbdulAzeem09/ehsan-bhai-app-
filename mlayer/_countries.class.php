<?php 
class _countries
{
	//spCountries
	//idspCountries, spCountriesName
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spCountries");
		$this->ta->dbclose = false;
	} 
	function countrylist($name){
		$result = $this->ta->read("WHERE t.spCountriesName  like ('%" . $name . "%')");
		// echo $this->ta->sql;
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspCountries'], 'label'=>$rs['spCountriesName']);
				// $data[] =$rs['spCategoryName'];
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
	
}
?>