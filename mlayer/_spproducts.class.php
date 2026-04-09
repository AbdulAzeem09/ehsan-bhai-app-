<?php 

require_once($_SERVER[ 'DOCUMENT_ROOT' ] . "/univ/main.php"); 

class _spproducts
{
// idspFSProduct, spFSProductName, spFSProductCategory, spFSProductDescription, spFSProductImage, spFSProductAmount, spFSProductDiscount, spFSProductQuantity, spFSProductMinQuantity, spFSProductUnit, spFSProductColors, spFSProductSizes, spProfiles_idspProfiles

    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _dataadapter();
		
		 $this->tap = new _tableadapter("spproduct");
		$this->ta->table = DBNAME . ".spFSProducts";
		$this->ta->dbclose = false;
	} 
	
    public function readall($sid) {
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $sid);
	} 
	
    public function create($data) {
		return $this->ta->create($data);
    }
	
    public function update($data, $pid) {
      return  $this->ta->update($data, "WHERE t.idspFSProduct =" . $pid);
    }

    public function read($pid) {
        return $this->ta->read("WHERE t.idspFSProduct = " . $pid);
	} 
	
	public function readp($pid) {
          return $this->tap->read("WHERE t.idspPostings = " . $pid);
		//  echo $this->tap->sql;
	} 
	
	public function read_currecy($pid) {
          return $this->tap->read("WHERE t.spProfiles_idspProfiles = " . $pid);
		//  echo $this->tap->sql;
	} 
	
    public function delete($pid) {
		return $this->ta->delete("WHERE t.idspFSProduct = " . $pid);
    } 
    





}
?>