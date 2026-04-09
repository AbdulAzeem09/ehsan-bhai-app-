<?php 
class _realstateenquiry
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tra;
	
	function __construct() { 
		$this->ta = new _tableadapter("realenquiry");
		$this->tra = new _tableadapter("realstateenquirychat");
		$this->ta->dbclose = false;
	}
		 
	
	function createenquiryChat($data){
		//die('============='); 
		$buyer_id = $_POST['buyer_id'];
		$seller_id = $_POST['seller_id'];
		$enquiry_msg = $_POST['enquiry_msg'];
		$enquiry_id = $_POST['enquiry_id'];
		$senderid = $_POST['senderid'];
		return $this->tra->create(array( "buyer_id"=> $buyer_id, "seller_id"=> $seller_id, "enquiry_msg"=> $enquiry_msg, "enquiry_id"=> $enquiry_id, "senderid"=> $senderid));
	}
	 
	function create($data){
		return $this->ta->create($data);	
	}
	//read all enquery of specific profile
	function readMyEnquery($pid){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid");
	}
	function readMyEnquerychat($pid){
	  $pid = $this->ta->escapeString($pid);
		return $this->tra->read("WHERE enquiry_id = $pid ORDER BY msg_time_date ASC");
	}
	function readMyEnqueryspspPosting_idspPosting($pid){
		return $this->ta->read("WHERE spPosting_idspPosting = $pid");
	}
	//read single enquiry
	function read($iae){
	  $iae = $this->ta->escapeString($iae);
		return $this->ta->read("WHERE idsprealEnquiry = $iae");
	}
	
	
	
    function myEnquery($category, $pid){
        return $this->ta->read("WHERE spProfile_idspProfile = $pid ORDER BY idsprealEnquiry DESC");
  
       // return $this->ta->read("INNER JOIN realenquiry as r on t.idsppostings = r.spposting_idspposting WHERE t.sppostingvisibility = -1 and t.spCategories_idspCategory = $category AND t.spProfiles_idspProfiles = '$pid' ORDER BY spPostingDate DESC");
    }
	function myEnqueryrecive($pid){
		 return $this->ta->read(" WHERE spProfile_idspProfile=$pid ORDER BY idsprealEnquiry DESC");
		echo $this->ta->sql;
	}
}
?>
