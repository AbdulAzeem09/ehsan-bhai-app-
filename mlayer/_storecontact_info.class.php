<?php 
class _storecontact_info

{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("storecontact_info");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create(array("cname" =>  $data["cname"], "cemail" => $data["cemail"], "cmessage" => $data["cmessage"], "useremail" => $data["useremail"]));

		$em = new _email;
		//$em->sendemail();
		// ===not complete
		$em->send_contact_email($data["useremail"], $data['cname'], $data["cemail"], $data["cmessage"]);

		return $id;
	}


/*
    function getsellercomment($sellerid)
    {
    	return $this->ta->read("WHERE spSellerProfileId = $sellerid");
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