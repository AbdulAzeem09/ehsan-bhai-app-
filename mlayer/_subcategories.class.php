<?php 
class _subcategories
{
    // property declaration
	//idspSubCategory, spSubCategoryName, spSubCategoryNotes, spCategories_idspCategory
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spSubCategories");
		$this->tad = new _tableadapter("craft_category");
		$this->tads = new _tableadapter("craft_subcategory");
		$this->ta->dbclose = false;
	} 
	
	function craft_categorylist(){
		
		return $this->tad->read();
		//echo $this->tads->sql;die("================");
		
	}
	
	function craft_subcategorylist($catiId){
	return $this->tads->read("WHERE idspCraftcategory =" .$catiId);
		
	}
	
	function subcategorylist($name, $id){
		$result = $this->ta->read("WHERE t.spSubCategoryName like ('%" . $name . "%') and spCategories_idspCategory = " . $id);
		// $result = $this->ta->read("WHERE t.spSubCategoryName like ('%" . $name . "%')");
		// echo $this->ta->sql;
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspSubCategory'], 'label'=>$rs['spSubCategoryName']);
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
}
?>
