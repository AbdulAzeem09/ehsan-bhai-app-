<?php 
class _sppostenquiry
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spproductmessaging");
		$this->tano = new _tableadapter("notification_table");
		$this->gpn = new _tableadapter("group_invitation");
		$this->tae = new _tableadapter("enquiry_store");
		//$this->ta->join = "INNER JOIN spProfiles as d ON t.buyerProfileid = d.idspProfiles";
		$this->ta->dbclose = false;
	} 
	
	
	function readnotification($pid){
		 return $this->tano->read("WHERE to_id = $pid AND by_seller_or_buyer=1");
		//echo $this->ta->sql;die('======');
	}


	function group_notification($pid){
		//read($where = "", $order = "", $columns = "*", $join = "!", $debug=false)
		
		$columns = " p.idspProfiles 'pid', p.spProfileName 'name', p.spProfilePic 'pic', s.spGroupName 'group', t.group_id 'gid', t.id 'inv_id',	DATE_FORMAT(t.send_date, '%d/%m/%Y') 'invdate' ";
		$where = " where t.receiver = $pid and t.invitation_status = '0' ";
		$join .= " join spgroup s on t.group_id = s.idspGroup  ";
		$join .= " join spprofiles p on p.idspProfiles = t.sender ";
		$order = "";
		
		return $this->gpn->read($where,$order,$columns,$join );
		
	}

	function create($data)
	{
		return $this->ta->create($data);
	}
	
	function enquiry($data)
	{
		return $this->tae->create($data);
	}
	
	function msg($id){
	  $id = $this->tae->escapeString($id);
		return $this->tae->read("WHERE enquiry_id = $id ");
		
	}

		// MY SEND ENQUIRY
	function getbuyerEnquery($id){
		return $this->ta->read("WHERE buyerProfileid = $id ORDER BY id DESC");
		//echo $this->ta->sql;die('======');
	}

	function getsellerEnquery($sellerId){
		 return $this->ta->read("WHERE sellerProfileid = $sellerId ORDER BY id DESC");
		//echo $this->ta->sql;die('======');
	}
	
	
	function readMyEnqueryChat($sellerId){
		 return $this->ta->read("WHERE sellerProfileid = $sellerId ORDER BY id DESC");
		 //echo $this->ta->sql;die('======');
	}
	
	function getsellerEnq($id){
	   $id = $this->ta->escapeString($id);
		 return $this->ta->read("WHERE id = $id");
		//echo $this->ta->sql;die('======');
	}
	
/*
	function readbuyer($mid,$uid)//As a buyer
	{
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
