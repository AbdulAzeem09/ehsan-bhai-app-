<?php 
class _spcontent
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	
	function __construct() { 
		$this->ta = new _tableadapter("spcontent");
		$this->tad = new _tableadapter("tbl_foot_heading");
		$this->tah = new _tableadapter("homepage_heading");

		$this->ta->dbclose = false;
	}
	
	//read all sizes 
	function read($id){
		return $this->ta->read("WHERE idspContent = $id");
	}
	// READ ALL FEATURE
	function readFeature(){
		return $this->ta->read("WHERE contFeature = 1");
	}

	function readhanling(){
		return $this->tah->read("WHERE spCategory_idspCategory=1");
	}





	// ===============TBL FOOT HEADING======================
	// show heading
	function readFotheading(){
		return $this->tad->read("ORDER BY fh_id ASC LIMIT 4 ");
	}

}
?>