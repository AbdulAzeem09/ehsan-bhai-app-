<?php
class _order
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	
	function __construct() { 
		$this->ta = new _tableadapter("spOrder");
		/*$this->ta->join = "INNER JOIN spPost_has_spOrder as d ON t.idspOrder = d.spOreder_idspOreder INNER JOIN spPostings as p ON d.spPostings_idspPostings = p.idspPostings";*/

		$this->ta->join = "INNER JOIN sp_order_has_ordernew as d ON t.idspOrder = d.spOreder_idspOreder INNER JOIN spproduct as p ON d.spPostings_idspPostings = p.idspPostings";

		$this->tad = new _tableadapter("sp_order_has_ordernew");
		
		//$this->tad = new _tableadapter("spPost_has_spOrder");

		$this->ta->dbclose = false;
	} 
	

	// READ CART ITEM PROFILE WISE
	function readCartitemPid($pid){
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE idspProfiles =".$pid.") AND spOrderStatus IS NULL");
	}

	/*function readCartitemPidnew($pid){
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE idspProfiles =".$pid.") AND spOrderStatus IS NULL AND saveforlater ='0'");
	}

	function readCartitemPidsaved($pid){
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE idspProfiles =".$pid.") AND spOrderStatus IS NULL");
	}*/
	// UPDATE TXN IN SPORDER
	function updateTxn($oid, $txn_id, $shipId){
		return $this->ta->update(array("txn_id"=>$txn_id, "idspShipment"=>$shipId), "WHERE idspOrder ='".$oid."'");
	}
	// UPDATE TRANSACTION NULL => 0
	function transactionupdate($oid, $status){
		return $this->ta->update(array("spOrderStatus" => $status ), "WHERE idspOrder = $oid");
	}
	// UPDATE TRANSACTION NULL => 0
	// this is fake just chek and remove
	function transactiondone($oid,$quantity,$amount ,$date){
	   	return $this->ta->update(array("spOrderQty" => $quantity , "spOrderStatus" => 0 , "sporderAmount" => $amount , "sporderdate"=>$date), "WHERE idspOrder ='".$oid."'");
	}
	// PURCHASE PROFILE ID
	function purchase($pid){
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE idspProfiles =".$pid.") AND spOrderStatus = 0 AND txn_id != '' ORDER BY idspOrder DESC");
	} 
	// SELLING PRFILE ID
	function selling($pid){
		return $this->ta->read("WHERE spSellerProfileId in(select idspProfiles from spProfiles WHERE idspProfiles =".$pid.") AND spOrderStatus =0 AND txn_id != '' ORDER BY idspOrder DESC");
	}
	// READ SINGLE ORDER ID
	function readOrder($oid){
		return $this->ta->read("WHERE idspOrder = $oid");
	}
	// READ BUYER ID 
	function read($buyerpid){
		return $this->ta->read("where t.spByuerProfileId = " . $buyerpid . " AND spOrderStatus = 0 AND txn_id != '' ORDER BY idspOrder DESC");
	}
	// READ SELLER ORDERS
	function readSellerOrder($selId){
		return $this->ta->read("where t.spSellerProfileId = " . $selId . " AND spOrderStatus = 0 AND txn_id != '' ORDER BY idspOrder DESC");
	}
	// READ SELLER ORDER WITH STATUS
	function readSellerOrderStatus($selId, $status){
		return $this->ta->read("INNER JOIN tbl_shipment as s ON t.idspShip = s.idspShip where t.spSellerProfileId = " . $selId . " AND spOrderStatus = $status AND txn_id != '' ORDER BY idspOrder DESC");
	}
	// READ BUYERS ORDERS
	function readBuyerOrder($buyId, $catid){
		return $this->ta->read("where t.spByuerProfileId = " . $buyId . " AND spOrderStatus = 0 AND txn_id != '' AND p.spCategories_idspCategory = $catid ORDER BY idspOrder DESC");
	}
	// READ ALL TXN ID VALUES
	function readTxnOrder($txnId){
		return $this->ta->read("WHERE txn_id = '$txnId'");
	}
	// cart empty
	function emptyCart($buyoid){
		$this->ta->remove("WHERE t.spByuerProfileId = $buyoid AND spOrderStatus IS NULL");
	}
	// CREATE ORDER 
	function create($data, $postid){
		$id = $this->ta->create($data);

		//print_r($id);
		//print_r($postid);
		$this->tad->create(array("spPostings_idspPostings" => $postid, "spOreder_idspOreder" => $id));

		//echo $this->tad->sql;
		return $id;
	}
	// read all order against single txn id
	function readOrderTxn($txnId, $pid){
		return $this->ta->read("WHERE spByuerProfileId = $pid AND txn_id = '$txnId' ");
	}

	function searchreadOrderTxn($txnId, $pid, $txtSearch){
		return $this->ta->read("WHERE spByuerProfileId = $pid AND txn_id = '$txnId' AND p.spPostingTitle  like ('%" . $txtSearch . "%')");

	}


	// read all order against txn but only seller products
	function readTxnOrdBuy($txnId, $pid){
		return $this->ta->read("WHERE spSellerProfileId = $pid AND txn_id = '$txnId' ");
	}
	// new show room
	function updateShip($oid, $idspShip){
		return $this->ta->update(array("spOrderStatus" => 1, "idspShip"=>$idspShip), "WHERE idspOrder ='".$oid."'");
	}
	// UPDATE ORDER SHIPMENT STATUS
	function updateshipstatus($oid, $status){
		return $this->ta->update(array("spOrderStatus" => $status), "WHERE idspOrder ='".$oid."'");
	}
	// READ ALL EVENT ORDER BY TICKETS
	function readMyEventTkt($pid, $catid, $postid){
		return $this->ta->read("WHERE spSellerProfileId = $pid AND txn_id != '' AND spPostings_idspPostings = $postid AND spCategories_idspCategory = $catid ");
	}
	// ===============================END==========================================
	
    function todayselling($uid){
        $current_date = date('Y-m-d');
        return $this->ta->read("WHERE spSellerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND sporderdate = ".$current_date." AND spOrderStatus IS NOT NULL");
    }
        
	function totalpoint()
	{
		return $this->ta->read();
	} 
	
	function checkorder($postid , $buyerid)
	{
		return $this->ta->read("WHERE t.spByuerProfileId = " . $buyerid . " AND spOrderStatus IS NULL AND d.spPostings_idspPostings =".$postid);
	}
	
	function checkevent($postid , $buyerid)
	{
		return $this->ta->read("WHERE t.spByuerProfileId = " . $buyerid . " AND spOrderStatus =0 AND d.spPostings_idspPostings =".$postid);
	}
	
	
	 
	 
	function soldpost($uid)
	{
		return $this->ta->read("WHERE spSellerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spOrderStatus IS NOT NULL");
	} 
	 
	 
	function sharepagepoint($uid)
	{
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spOrderStatus IS NOT NULL");
	} 
	 
	
		function removefromCart($orderid){
		$this->ta->remove("WHERE t.idspOrder =" .$orderid);
		return true;
	}
	
	function readCartItem($uid)//$buyerpid
	{
		//return $this->ta->read("WHERE t.spByuerProfileId =" .$buyerpid . " AND spOrderStatus  IS NULL");
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spOrderStatus IS NULL");
	}

	function readCartItemnew($uid)//$buyerpid
	{
		//return $this->ta->read("WHERE t.spByuerProfileId =" .$buyerpid . " AND spOrderStatus  IS NULL");
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spOrderStatus IS NULL AND saveforlater='0'");
		//return $this->ta->read("WHERE spBuyeruserId = $uid AND spOrderStatus IS NULL AND saveforlater='0'");
	}


	function readCartItemsaved($uid)//$buyerpid
	{
		//return $this->ta->read("WHERE t.spByuerProfileId =" .$buyerpid . " AND spOrderStatus  IS NULL");
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spOrderStatus IS NULL AND saveforlater='1'");
	}


	
	function priviousorder($postid,$buyerpid)
	{
		return $this->ta->read("WHERE idspOrder in (SELECT spOreder_idspOreder from sp_order_has_ordernew WHERE spPostings_idspPostings =".$postid.") AND spByuerProfileId =".$buyerpid);
	}
	
	
	
	function transactioncomp($oid,$date)
	{
	   return $this->ta->update(array("spOrderStatus" => 0 , "sporderdate"=>$date), "WHERE idspOrder ='".$oid."'");
	}
	
	function updateorder($oid,$quantity,$amount)
	{
	   return $this->ta->update(array("spOrderQty" => $quantity , "sporderAmount" => $amount), "WHERE idspOrder ='".$oid."'");
	}

	function updatesaveforletter($oid,$savestatus)
	{
	   return $this->ta->update(array("saveforlater" => $savestatus), "WHERE idspOrder ='".$oid."'");
	}
	
	
	function quantityavailable($postid)
	{
		return $this->ta->read("WHERE idspOrder in (SELECT spOreder_idspOreder from sp_order_has_ordernew WHERE spPostings_idspPostings =".$postid.")");
	}
}
?>