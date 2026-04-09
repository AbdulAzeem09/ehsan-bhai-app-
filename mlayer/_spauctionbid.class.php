<?php 
class _spauctionbid
{
    public $dbclose = false;
	private $conn;
	public $ta;
	function __construct() { 
		$this->ta = new _tableadapter("spbid");//spShipping
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
	

	function updateauctionbid($postid, $auctionPrice , $lastBid ){
        $this->ta->update(array("auctionPrice" => $auctionPrice ,"lastBid" => $lastBid ), "WHERE  id = $postid");
    }
	
	function updatebid($data,$postid){
        $this->ta->update($data, "WHERE  spPostings_idspPostings = $postid");
    }

    	function updatetransectionauctionbid($postid){
        $this->ta->update(array("status" => 1), "WHERE  id = $postid");
    }
	
	function update($data, $pid){
		$this->ta->update($data, $pid);
	}

	function auctionbid($postid){
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid' ORDER BY id DESC");
	}

	function auctionhighestbid($postid){
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid' ORDER BY auctionPrice DESC LIMIT 1 ");
	}
	
	function auctionhighestbid2($postid){
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid'",'','MAX(auctionPrice) as auctionPrice');
	}

	function get_heigh_auction_priceof_product($postid){
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("WHERE spPostings_idspPostings = '$postid' ORDER BY id DESC LIMIT 1");
	}

	function Mylastbid($postid, $pid)
	{
	  $postid = $this->ta->escapeString($postid);
		return $this->ta->read("where spPostings_idspPostings = '$postid' AND spProfiles_idspProfiles = '$pid'  ORDER BY id DESC LIMIT 1");
	}
	
	function Myallbid($postid, $pid)
	{
		return $this->ta->read("where spPostings_idspPostings = '$postid' AND spProfiles_idspProfiles = '$pid'  ORDER BY id DESC ");
	}
	
	function ReadBid($postid, $pid)
	{
		return $this->ta->read("where spPostings_idspPostings = '$postid' AND spProfiles_idspProfiles = '$pid' ");
	}

		function checkMyAuctionbid($postid, $pid){
		$result = $this->ta->read("where sppostings_idsppostings = '$postid' AND spProfiles_idspProfiles = '$pid'");
		//$result = $this->ta->read("WHERE spPostFieldValue = 'Auction' AND spPostings_idspPostings = '$postid' AND idspProfiles = '$pid'");
		if($result != false){
			return true;
		}else{
			return false;
		}
	}
	
}

?>
