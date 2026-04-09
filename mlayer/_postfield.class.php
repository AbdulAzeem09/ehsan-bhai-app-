<?php
class _postfield
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spPostField");
		$this->ta->dbclose = false;

		$this->tad = new _tableadapter("sppostingpics");
		$this->tad->dbclose = false;
		$this->fa = new _tableadapter("spproduct");
		$this->fad = new _tableadapter("spprofiles");
	}

	




	function spproid($sellerid)
	{
		return $this->fad->read("WHERE t.idspProfiles = " . $sellerid);
		//echo $this->ta->sql;
		//die('==');
	}


	// update notes on the training module
	function updateCourse($notes, $postid)
	{
		$this->ta->update(array("spPostFieldValue" => $notes), "WHERE spPostFieldLabel = 'Course outline' AND spPostFieldName = 'outline_' AND spPostings_idspPostings = $postid");
	}
	// UPDATE COURSE FIELD 
	function updateCustomLyric($lyric, $postid, $label, $fieldName)
	{
		$this->ta->update(array("spPostFieldValue" => $lyric), "WHERE spPostFieldLabel = '$label' AND spPostFieldName = '$fieldName' AND spPostings_idspPostings = $postid ");
	}
	// READ ALL POST FIELDS FROM THE SPPOSTFIELD TABLE
	function read($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
		//echo $this->ta->sql;
		//die('==');
	}

	function read_quantity($postid)
	{
		return	$this->ta->read("WHERE t.spPostings_idspPostings = $postid AND spPostFieldName='quantity_'");
		//echo $this->ta->sql;
		//die('==');
	}


	function read_photo($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spPostFieldName = 'photos_'");
	}
	function updateqtyforid($arr, $postid)
	{
		return $this->ta->update($arr, "WHERE t.spPostings_idspPostings =  $postid AND spPostFieldName= 'quantity_'  ");
		//echo $this->ta->sql;die;
	}
	// READ ALL POSTINGS images
	function readPostingPic($idspPostings)
	{
		return $this->tad->read("WHERE spPostings_idspPostings = '$idspPostings'");
	}
	// CREATE NEW POSTINGS
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}

	function removeafterinsert($postid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings = $postid AND spPostFieldName = 'imagesize_'");
	}

	function readSizePost($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = 'imagesize_'");
	}
	//read all profiles which is add in featuring
	function readFeaturPost($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = 'addfeaturning_'");
	}
	//read all sponsors
	function readSponsorPost($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = 'sponsorId_'");
	}
	//read all custom field with FieldName
	function readCustomPost($postid, $fieldName)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = '$fieldName'");
	}
	//read all custom field with FieldName and filter
	function readCustomPostFilter($postid, $fieldName, $filter)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = $postid AND spPostFieldName = '$fieldName' AND spPostFieldValue = 'Sell' AND spPostFieldIsFilter = '$filter'");
	}
	//create posting field
	function createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value)
	{
		$id = $this->ta->create(array("spPostFieldLabel" => $spPostFieldLabel, "spPostFieldName" => $spPostFieldName, "spPostings_idspPostings" => $spPostings_idspPostings, "spCategories_idspCategory" => $spCategories_idspCategory, "spPostFieldValue" => $value));
		return $id;
	}
	// READ ALL PROFILES SAME CATEGORY
	function readAllSameCategoryProfile($catTitle, $pid)
	{
		return $this->ta->read("INNER JOIN sppostings AS p ON t.spPostings_idspPostings = p.idspPostings WHERE spPostFieldName = 'subcategory_' AND spPostFieldValue = '$catTitle' AND p.spProfiles_idspProfiles != $pid GROUP BY p.spProfiles_idspProfiles LIMIT 20 ");
	}
	// UPDATE QUANTITY IN EVENTS FIELDS
	function updateQty($postid, $newQty)
	{
		$this->ta->update(array("spPostFieldValue" => $newQty), "WHERE spPostFieldLabel = 'Ticket Capacity' AND spPostFieldName = 'ticketcapacity_' AND spPostings_idspPostings = $postid");
	}









	function rejectbid($postid, $profileid)
	{
		return $this->ta->remove("WHERE t.spPostings_idspPostings=" . $postid . " AND spProfiles_idspProfiles =" . $profileid . " AND spPostFieldBidFlag = 1");
	}

	function events($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}


	function readFields($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spPostFieldIsFilter=1");
	}


	function readpostfield($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}

	function field($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid);
	}

	function quantity($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
	}

	function readfield($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spPostFieldValue!='1' AND spPostFieldValue!='0' AND spPostFieldValue!='on' AND spPostFieldBidFlag IS NULL");
	}

	function readlabel($categoryid)
	{
		return $this->ta->read("WHERE t.spCategories_idspCategory = " . $categoryid . " AND spPostFieldIsFilter = 1", "", "DISTINCT spPostFieldLabel");
	}

	function readvalues($categoryid, $label)
	{
		return $this->ta->read("WHERE t.spCategories_idspCategory = " . $categoryid . " AND spPostFieldIsFilter = 1 AND t.spPostFieldLabel = '" . $label . "'", "", "DISTINCT spPostFieldValue");
	}

	function searchedpost($fieldavalue)
	{
		return $this->ta->read("WHERE t.spPostFieldValue = " . $fieldavalue);
	}

	function readprice($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE t.spPostings_idspPostings =" . $postid . " AND spPostFieldName ='spPostingPriceHourly_ ' AND spPostFieldValue = 1");
	}

	function update($data, $pid)
	{
		$this->ta->update($data, $pid);
	}

	function totalbids($postid)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = " . $postid . " AND spProfiles_idspProfiles IS NOT NULL", "", "DISTINCT spProfiles_idspProfiles");
	}

	function mybid($uid)
	{
		return $this->ta->read("WHERE t.spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser = " . $uid . ")", "", "DISTINCT spProfiles_idspProfiles,spPostings_idspPostings");
	}



	function mybiddenproject($uid)
	{
		//return $this->ta->read("WHERE spPostings_idspPostings in (SELECT idspPostings from spPostings where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser= ".$uid.")) AND spPostFieldBidFlag = 1","","DISTINCT spPostings_idspPostings");
		return $this->ta->read("WHERE spPostings_idspPostings in (SELECT idspPostings from spPostings where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles where spUser_idspUser= " . $uid . ") AND spPostingsBought IS NULL ) AND spPostFieldBidFlag = 1", "", "DISTINCT spPostings_idspPostings");
	}


	function biddetails($postid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$profileid." AND spPostings_idspPostings =".$postid);
		return $this->ta->read("WHERE spPostings_idspPostings =" . $postid . " AND spPostFieldBidFlag = 1", "", "DISTINCT spProfiles_idspProfiles");
	}
	//show all bids
	function allbids($pid, $postid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =" . $pid . " AND spPostings_idspPostings =" . $postid);
	}

	//chek post is auction or not
	function checkAuction($postid)
	{
	  $postid = $this->ta->escapeString($postid);
		$result = $this->ta->read("WHERE spPostFieldValue = 'Auction' AND spPostings_idspPostings = '$postid'");
		if ($result != false) {
			return true;
		} else {
			return false;
		}
	}
	//chek this post is my.
	function checkMyAuction($postid, $pid)
	{
		$result = $this->ta->read("INNER JOIN sppostings AS d ON t.spPostings_idspPostings = d.idspPostings where sppostfieldvalue = 'auction' and sppostings_idsppostings = '$postid' AND d.spProfiles_idspProfiles = '$pid'");
		//$result = $this->ta->read("WHERE spPostFieldValue = 'Auction' AND spPostings_idspPostings = '$postid' AND idspProfiles = '$pid'");
		if ($result != false) {
			return true;
		} else {
			return false;
		}
	}
	//all auction post to get bids
	function allauctionbid($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid' AND spPostFieldName = 'AuctionPrice'");
	}
	//get height auction bid
	function get_heigh_auction_price($postid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid' AND spPostFieldName = 'AuctionPrice' ORDER BY idspPostField DESC LIMIT 1");
	}
	//get all auction product
	function totalAuctionStore()
	{
		return $this->ta->read("where spPostFieldValue = 'Auction' GROUP BY spPostings_idspPostings");
	}
	//single person freelancer bid detail
	function read_single_person_bid_detail($postid, $pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles =" . $pid . " AND spPostings_idspPostings =" . $postid);
	}
	//remove sponsors when update new 
	function removeSponsor($postid, $spPostFieldLabel)
	{
		return $this->ta->remove("WHERE t.spPostings_idspPostings=" . $postid . " AND t.spPostFieldLabel ='$spPostFieldLabel' ");
	}
	function readMyDraftprofile($pidgfhcgvhcv)
	{
		return  $this->fa->read("WHERE idspPostings=" . $pidgfhcgvhcv);
	}
}
