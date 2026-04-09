<?php 
class _artgalleryenquiry
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tra;
	
	function __construct() { 
		$this->ta = new _tableadapter("artgalleryenquiry");
		$this->tra = new _tableadapter("enquirychat");
		$this->tart = new _tableadapter("sppostingsartcraft ");
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
	
	function readdetails($id){
		return $this->tart->read("WHERE idspPostings = $id");
	}
	
	function readMyEnquerychat($pid){
		return $this->tra->read("WHERE enquiry_id = $pid ORDER BY msg_time_date ASC");
		//echo $this->tra->sql;die;
	}
	function readMyEnqueryspspPosting_idspPosting($pid){
		return $this->ta->read("WHERE spPosting_idspPosting = $pid");
	}
	//read single enquiry
	function read($iae){
		return $this->ta->read("WHERE idartenquiry = $iae");
	}
	
}
?>