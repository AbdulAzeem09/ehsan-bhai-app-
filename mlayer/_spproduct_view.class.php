<?php 
class _spproduct_view
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spproduct_view");//spShipping
		$this->ta->dbclose = false;
	} 
	
	function create($data){
		return $this->ta->create($data);
	}
	
	function read($uid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE uid =".$uid);
	}



	function readrecentcartview($uid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE uid = $uid ORDER BY id DESC LIMIT 5");
	}
	
    function readviewed($uid,$productid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE uid =".$uid." And productid=".$productid );
	}

	function readproductview($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		//return $this->ta->read("WHERE uid =".$uid);
	}
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}

	function insertrecent_viewproduct($productid,$spProfiles_idspProfiles,$uid,$currentDateTime)
	{
		$this->ta->create(array("productid" => $productid, "spProfiles_idspProfiles" => $spProfiles_idspProfiles, "uid" => $uid, "created" => $currentDateTime ));
		
	}

	function readrecentview($pro_id,$uid)
	{
		return $this->ta->read("WHERE productid = $pro_id AND uid = $uid ORDER BY id DESC");
	}

	
 
	
}

?>