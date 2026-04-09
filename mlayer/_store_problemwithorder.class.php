<?php 
class _store_problemwithorder
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tab;
	
	function __construct() { 
		$this->ta = new _tableadapter("store_problemwithorder");
			$this->tab = new _tableadapter("store_problemcomment");
		//$this->ta->join = "INNER JOIN spProfiles as d ON t.buyerProfileid = d.idspProfiles";
		$this->ta->dbclose = false;
	} 
	
	function create($data)
	{
		$this->ta->create($data);
	}

	function createcomment($cdata)
	{
		$this->tab->create($cdata);
	}

	function getsellercomment($comid){
		return $this->tab->read("WHERE comment_id = $comid");
	}



		// MY SEND ENQUIRY
	function getbuyerproduct($buyerid){
		return $this->ta->read("WHERE buyerprofil_id = $buyerid ORDER BY id DESC");
	}

	function getMysellerproduct($sellerId){
		 return $this->ta->read("WHERE sellerprofil_id = $sellerId ORDER BY id DESC");
		//echo  $this->ta->sql;die('==========');
	}

	
/*	
function getbuyerproductdata($sellerId){
	
  return $this->ta->read("INNER JOIN sporder as d ON t.idspOrder = d.idspOrder INNER JOIN spproduct as p ON t.spSellerProfileId = p.spProfiles_idspProfiles");

	}*/
/*
	function readbuyer($mid,$uid)//As a buyer
	{
		 return $this->ta->read("INNER JOIN spproduct as d ON t.spByuerProfileId  = d.spByuerProfileId WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . " AND t.sellType = 'Retail' AND t.spPostingExpDt >= CURDATE()");


		return $this->ta->read("WHERE buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND idspMessage='".$mid."'");
	}
	// get all my enquiry
	function getMyEnquery($buyerId){
		return $this->ta->read("WHERE sellerProfileid = $buyerId ORDER BY idspMessage DESC");
	}
	// MY SEND ENQUIRY
	function getMySendEnquery($id){
		return $this->ta->read("WHERE buyerProfileid = $id ORDER BY idspMessage DESC");
	}

	function readseller($mid,$uid)// As a seller
	{
		return $this->ta->read("WHERE sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND idspMessage='".$mid."'");
	}
	
	function updatenotification($mid){
		return $this->ta->update(array("spmessagingstatus" => 0), "WHERE idspMessage ='".$mid."'");
	}
	
	function readnotification($uid)
	{
		//return $this->ta->read("WHERE (buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")) AND spmessagingstatus = 1");
		return $this->ta->read("WHERE sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spmessagingstatus = 1");
	}
	
	
	function read($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =" .$postid);
	}
	
	function readmessage($mid)
	{
		return $this->ta->read("WHERE idspMessage =" .$mid);
	}
	
	function readmessageid($uid)
	{
		return $this->ta->read("WHERE (buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid."))");
	}
        
    function countunreadmessage($uid){
        $current_date = date('Y-m-d');
        $conn = _data::getConnection();
        $sql = "select * from spmessaging where sellerProfileid = '".$uid."' and spmessaging_date = '".$current_date."' and spmessagingstatus = 1";            
        $query = mysqli_query($conn, $sql);
        return $query;
        
    }
	// DELETE THE MESSAGE
	function removeMsg($mid) {
        $this->ta->remove("WHERE idspMessage= " . $mid);
    }*/
	
}
?>