<?php 
class _rfqchat

{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("rfqchat");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}



    function getsellercomment($comid)
    {
    	return $this->ta->read("WHERE comment_id = $comid");
    }

/*
	function getbuyerproduct($pid){
		return $this->ta->read("WHERE spByuerProfileId = $pid ORDER BY id DESC");
	}

	
    function getMysellerproduct($sellerid)
    {
    	return $this->ta->read("WHERE spSellerProfileId = $sellerid ORDER BY id DESC");
    }


    function updatereqstatus($data,$reqid)
	{
		 $did = $this->ta->update($data, $reqid);
	}
*/
	
  
/*
function addsellercomment($data)
	{
		$id = $this->ta->create($data);
	}*/

	

}
?>