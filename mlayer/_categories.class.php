<?php 
class _categories
{
    // property declaration
	// idspCity, spCityName
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spCategories");
		//$this->tad = new _tableadapter("spcategory_has_spprofiletypes");
		$this->ta->dbclose = false;
	} 
	
	
	function read(){
		return $this->ta->read("WHERE spCategoryStatus = 1 GROUP BY spcategoriesSort");
	}
	
	function categorylist($name){
		$result = $this->ta->read("WHERE t.spCategoryName  like ('%" . $name . "%')");
		// echo $this->ta->sql;
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspCategory'], 'label'=>$rs['spCategoryName']);
				// $data[] =$rs['spCategoryName'];
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
	
	function get_Name($id){
		$cat_name = "";
		$r = $this->ta->read("WHERE t.idspCategory  = " . $id);
		if ($r != false) {
			while($row = $r->fetch_assoc()) {
				$cat_name = $row["spCategoryName"];
			}
		}
		return $cat_name;
	}

	function get_Category_Detail($id){
		return $this->ta->read("WHERE t.idspCategory  = " . $id);
	}
}
?>