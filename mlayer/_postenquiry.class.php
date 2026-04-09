<?php 
class _postenquiry
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() {  
		$this->ta = new _tableadapter("spMessaging");
		$this->tabb = new _tableadapter("spMessaging");
		$this->tm = new _tableadapter("spbuiseness_files");
		$this->tp = new _tableadapter("spprofiles");
		$this->tww = new _tableadapter("spprofilecontent");
		
		$this->ta->join = "INNER JOIN spProfiles as d ON t.buyerProfileid = d.idspProfiles";
		$this->ta->dbclose = false;
	} 
	
	function readbuyer($mid,$uid)//As a buyer
	{
		return $this->ta->read("WHERE buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND idspMessage='".$mid."'");
	}
	
	
	
	function read98($pid)
	{
		return $this->tp->read("WHERE t.idspProfiles= $pid");
		
		
		
	}
	
	
	function read99($pidd)
	{
		return $this->tww->read("WHERE t.idspContent= $pidd");
		//echo $this->tww->sql;
		//die('ddddddd');
		
		
	}
	
	
	
	function readpost($pid)
	{
		return $this->tm->read("WHERE  t.sp_uid= $pid ORDER BY id DESC LIMIT 1");
		
		
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

	function updatenotificationallnoti(){
		return $this->ta->update(array("spmessagingstatus" => 0), "WHERE spmessagingstatus = 1");
	}
	
	function readnotification($uid)
	{
		//return $this->ta->read("WHERE (buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")) AND spmessagingstatus = 1");
	return $this->ta->read("WHERE sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spmessagingstatus = 0 ORDER BY id DESC ");
		//echo $this->ta->sql;
	}
	function buyerProfileName($uid)
	{
	return $this->tp->read("WHERE idspProfiles = $uid ");
		//echo $this->tp->sql;
	}
	function delete_notification($id)
	{
		//return $this->ta->read("WHERE (buyerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") OR sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")) AND spmessagingstatus = 1");
		return $this->tabb->remove("WHERE id=$id");
		//echo $this->ta->sql;
	}
	
	function addenquiry($data)
	{
		return $this->ta->create($data);
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

	function readnotid($uid)
	{
		return $this->ta->read("WHERE spmessagingstatus = 1 AND sellerProfileid in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")");
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
       return  $this->ta->remove("WHERE idspMessage= " . $mid);
    }
	
}
?>
