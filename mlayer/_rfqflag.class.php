<?php 
class _rfqflag

{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("rfqflag");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		return $this->ta->create($data);
	}



    function getsellercomment($comid)
    {
    	return $this->ta->read("WHERE comment_id = $comid");
    }


}
?>