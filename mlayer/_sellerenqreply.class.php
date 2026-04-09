<?php 
class _sellerenqreply
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("store_sellerenqreply");
		$this->ta->dbclose = false;
	}
	
	function createreply($data)
	{
		$id = $this->ta->create($data);
	}

    function getsellerreply($rid)
    {
    	return $this->ta->read("WHERE reply_id = $rid");
    }

/*
 function getonbuyerreply($buyerid)
    {
    	return $this->ta->read("WHERE spByuerProfileId = $buyerid");
    }*/


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