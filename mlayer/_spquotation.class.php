<?php
class _spquotation
{

	public $dbclose = false;
	private $conn;
	public $ta;
	public $pic;
	public $media;
	
	function __construct() { 
		$this->ta = new _tableadapter("spquotationrfq");
		$this->pic = new _tableadapter("spQuotationPic");
		$this->media = new _tableadapter("spQuotationMedia");
		$this->ta->dbclose = false;
	} 
	
	
	function create($data){
		//die('======');
		$quotationid = $this->ta->create($data);
		

		/*$em = new _email;
		//$em->sendemail();
		// ===not complete
		$em->send_privaterfq_email($sellerEmailid, $buyerEmailid, $spTitle,$sellerName, $buyerName);
*/
		return $quotationid;

	}

function updatequote($deleveryprice, $qid) {
        $this->ta->update(array("spQuotationPrice" => "$deleveryprice"), $qid);
    }

   

	// MY SEND ENQUIRY
	function getbuyerquotation($bid){
		return $this->ta->read("WHERE spQuotationBuyerid = $bid ORDER BY idspQuotation DESC");
	}

		function getsellerquotation($sid){
		return $this->ta->read("WHERE spQuotationSellerid = $sid ORDER BY idspQuotation DESC");
	}


	function swa($qid){
		 $this->ta->remove("WHERE t.idspQuotation=" .$qid); 
		echo $this->ta->sql;
	}


	
	// READ QUOTION USER ID VISE
	function read($uid){
		return $this->ta->read("WHERE t.spQuotationBuyerid in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spQuotationStatus is null GROUP BY spPostings_idspPostings");
	}
	// DELETE QUOTION
	function deletequote($qid){
		return $this->ta->remove("WHERE t.idspQuotation=" .$qid);
	}
	// READ QUOTION WHICH I RECEIVED PROFILE ID VISE
	function readProfileQuote($pid){
		return $this->ta->read("WHERE t.spQuotationSellerid in(SELECT idspProfiles FROM spProfiles WHERE idspProfiles = $pid) GROUP BY spQuotationBuyerid");
		//return $this->ta->read("WHERE t.spQuotationSellerid in(SELECT idspProfiles FROM spProfiles WHERE idspProfiles = $pid) GROUP BY spQuotationSellerid");
	}
	// READ QUOTION WHICH I SEND PROFILE ID VISE
	function readProfileSendQuote($pid){
		return $this->ta->read("WHERE t.spQuotationBuyerid in(SELECT idspProfiles FROM spProfiles WHERE idspProfiles = $pid) GROUP BY spQuotationSellerid");
	}
	// READ QUOTION ID THROUGH
	function readQuote($qid){
		return $this->ta->read("WHERE idspQuotation ='".$qid."'");
		
	}
	
function readQuote1($pid){
		return $this->ta->read("WHERE spQuotationBuyerid ='".$pid."'");
		 //echo $this->ta->sql;
		
	}


	function readpostquote($postid){
		 return $this->ta->read("WHERE t.spPostings_idspPostings =".$postid);
	}
	
	function adddraft($qid){
		return $this->ta->update(array("spQuotationStatus" => 2), "WHERE idspQuotation ='".$qid."'");
	}
	
	
	
	
	function draftquote($uid){
		 return $this->ta->read("WHERE t.spQuotationBuyerid in (Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spQuotationStatus = 2 GROUP BY spPostings_idspPostings");
	}
	
	//Accepted , Rejected , Draft , Archieved
	function allaccept($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid . " AND spQuotationStatus = 0");
	}
	
	function allrejected($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid . " AND spQuotationStatus = 1");
	}
	
	function alldraftquote($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid . " AND spQuotationStatus = 2");
	}
	
	function readallquote($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings =".$postid . " AND spQuotationStatus IS NULL");
	}
	//Completed
	
	
	
	 
    function accepted($qid)
	{
		return $this->ta->update(array("spQuotationStatus" => 0), "WHERE idspQuotation ='".$qid."'");
	}
	
	function rejected($qid)
	{
		return $this->ta->update(array("spQuotationStatus" => 1), "WHERE idspQuotation ='".$qid."'");
	}
	
	function accept($uid)
	{
		 return $this->ta->read("WHERE t.spQuotationBuyerid in (Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spQuotationStatus = 0 GROUP BY spPostings_idspPostings");
	}
	
	function reject($uid)
	{
		 return $this->ta->read("WHERE t.spQuotationBuyerid in (Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND spQuotationStatus = 1 GROUP BY spPostings_idspPostings");
	}
}
?>
	