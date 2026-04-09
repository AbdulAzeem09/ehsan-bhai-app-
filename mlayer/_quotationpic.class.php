<?php 
class _quotationpic
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spQuotationPic");
		//$this->ta->join = "INNER JOIN spQuotation as d ON t.ispQuotation_idspQuotation = d.idspQuotation";
		$this->ta->dbclose = false;
	}
	
	
	function read($qid){
		return $this->ta->read("WHERE t.spQuotation_idspQuotation = " . $qid);
	}
}
?>