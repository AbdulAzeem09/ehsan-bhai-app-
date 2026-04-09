<?php
class _artcraftOrder
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $tra;
	public $tr;
	
	function __construct() { 
		$this->ta = new _tableadapter("order_transection");
		$this->tad = new _tableadapter("order_products_checkout");
		$this->tr = new _tableadapter("orderstatus");
		$this->tra = new _tableadapter("enquirychat");
				$this->trap = new _tableadapter("sppostingsartcraft");

		
		
		
		$this->ta->dbclose = false;
	} 
	
	
	function createenquiryChat($data){
		//die('=============');
		$buyer_id = $_POST['buyer_id'];
		$seller_id = $_POST['seller_id'];
		$enquiry_msg = $_POST['enquiry_msg'];
		$enquiry_id = $_POST['enquiry_id'];
		return $this->tra->create(array( "buyer_id"=> $buyer_id, "seller_id"=> $seller_id, "enquiry_msg"=> $enquiry_msg, "enquiry_id"=> $enquiry_id));
	}
	
	// READ CART ITEM PROFILE WISE
	function readBuyerOrder($pid){
		return $this->ta->read("WHERE buyer_pid = $pid ORDER BY id DESC");
	}
	
	function read_artproduct($id){
		return $this->trap->read("WHERE idspPostings = $id");
	}
	
	
	
	function readSellerOrder($pid){
		return $this->ta->read("WHERE id = $pid ORDER BY id DESC");
	}
	
	function existStatus($pid){
		return  $this->tr->read("WHERE products_checkout_id = $pid");
		echo $this->tr->sql;
	}
	
	function createStatusorder($idps, $roew,$datastutsdate){
		$id  = $this->tr->create(array( "products_checkout_id"=> $idps, $roew => 1, $datastutsdate => date("Y-m-d")));
		return $id;
		
		
	}
	function createStatusorderdone_by($idps, $roew,$datastutsdate, $done_by){
		$id  = $this->tr->create(array( "products_checkout_id"=> $idps, $roew => 1, $datastutsdate => date("Y-m-d"), "done_by" => $done_by));
		//return $id;
	}
	
	function updateStatusorder($idps, $roew,$datastutsdate){
	   	return $this->tr->update(array( $roew => 1, $datastutsdate => date("Y-m-d")), "WHERE products_checkout_id ='".$idps."'");
	}
	
	
	function updateStatusorderdone_by($idps, $roew,$datastutsdate,$done_by){
	   	return $this->tr->update(array( $roew => 1, $datastutsdate => date("Y-m-d"), "done_by" => $done_by), "WHERE products_checkout_id ='".$idps."'");
	}
	
	function readBuyerOrdertotal($pid){
		return $this->ta->read("WHERE id = $pid");
	}
	
	function readBuyerOrdertotalpro($pid){
		return $this->tad->read("WHERE txn_id = $pid");
	}	
	
	function readBuyerOrdertotalprorow($pid){
		return $this->tad->read("WHERE id = $pid");
	}	
	
	function readBuyerOrdertotalpropar($txn_id,$pid){
		return $this->tad->read("WHERE txn_id = $txn_id AND sellerPid = $pid");
	}		
	function readBuyerOrdertotalproparsin($txn_id){
		return $this->tad->read("WHERE txn_id = $txn_id");
	}	
	
	function readSellerOrdertotalpro($pid){
		return $this->tad->read("WHERE sellerPid = $pid");
	}
	
	function readSellerOrdertotalpronew($pid){
		return $this->tad->read("WHERE sellerPid = $pid AND status=0");
	}
	
	function updateBuyerOrder($orderID, $Carrier, $Tracking_Id){
	   	return $this->tad->update(array("Carrier" => $Carrier, "Tracking_Id" => $Tracking_Id ), "WHERE id ='".$orderID."'");
	}

	
	function updateBuyerOrderstatus($orderID, $action){
	   	return $this->tad->update(array("status" => $action ), "WHERE id ='".$orderID."'");
	}
	
	
	function refundComplete($orderID, $pro_id){
	   	return $this->tad->update(array("refund_complete" => '1' ), "WHERE txn_id ='".$orderID."' AND spPostings_idspPostings ='".$pro_id."'");
	}
	
	
	function refundStatus($orderID,$pro_order_id){
	   	return $this->tad->read( "WHERE txn_id ='".$orderID."' AND spPostings_idspPostings ='".$pro_order_id."'");
	}
	
	
	
}
?>