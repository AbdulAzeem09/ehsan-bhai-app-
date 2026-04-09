<?php
class _spcustomers_basket
{

	public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $tra;
	public $tr;

	function __construct()
	{
		$this->taw = new _tableadapter("spwalletartandcraft");
		$this->ta = new _tableadapter("spcustomers_basket");
		$this->tab = new _tableadapter("spcustomers_basket");
		$this->tai = new _tableadapter("spstorewallet");
		$this->tawallet = new _tableadapter("speventwallet");
		$this->twallet = new _tableadapter("spfreelancerwallet");
		$this->trwallet = new _tableadapter("sptrainig_wallet");
		$this->bwallet = new _tableadapter("spbonuswallet");
		$this->tawalletge = new _tableadapter("spgroup_event_wallet");
		$this->taa = new _tableadapter("spwalletartandcraft");
		$this->tacba = new _tableadapter("spcustomers_basket_attributes");
		$this->tadc = new _tableadapter("spproduct");
		$this->taart = new _tableadapter("sppostingsartcraft");
		$this->tapost = new _tableadapter("spPostField");
		$this->ta->dbclose = false;
	}

	// CREATE customers_basket 
	function create($data)
	{
		return $this->ta->create($data);
		// echo $this->ta->sql;die('=======');		

	}
	function readp($id)
	{
		return $this->tadc->read("WHERE idspPostings=$id");
	}
	function readart($id)
	{
		return $this->taart->read("WHERE idspPostings=$id");
	}
	function readitem($id, $uid)
	{
	  $id = $this->ta->escapeString($id);
		return $this->ta->read("WHERE idspPostings=$id AND spBuyeruserId = $uid AND cartItemType='Store' AND spOrderStatus IS NULL");
	}
	function readitemartcraft($id, $uid)
	{
	  $id = $this->ta->escapeString($id);
		return $this->ta->read("WHERE idspPostings=$id AND spBuyeruserId = $uid AND cartItemType='artandcraft' AND spOrderStatus IS NULL");
	}

	function create1($data)
	{
		return $this->tai->create($data);
	}
	function createforartandcraft($data1)
	{
		return $this->taw->create($data1);
		//echo $this->taw->sql;

	}

	function create2($data)
	{
		return $this->taa->create($data);
	}
	function readfromwallet($uid)
	{
		return $this->tawallet->read("WHERE seller_userid = $uid");
	}
	function readfromwallet1($uid)
	{
		return $this->twallet->read("WHERE seller_userid = $uid");
	}
	function readfromwallet_training($uid)
	{
		return $this->trwallet->read("WHERE seller_userid = $uid");
		//echo $this->trwallet->sql;
		//die('ssssss');
	}
	function readfromwallet_bonus($uid)
	{
		return $this->bwallet->read("WHERE uid = $uid");
	}

	function readfromgewallet($uid)
	{
		return $this->tawalletge->read("WHERE seller_userid = $uid");
		echo $this->tawalletge->sql;
	}

	function readtypeitembystore($uid, $sid)
	{
		return $this->tab->read("WHERE spBuyeruserId = $uid AND spSellerProfileId = $sid  AND spOrderStatus IS NULL AND cartItemType='Store'");
		//echo $this->tab->sql;
	}
	function readtypeitembyartandcraft($uid, $sid)
	{
		return $this->tab->read("WHERE spBuyeruserId = $uid AND spSellerProfileId = $sid  AND spOrderStatus IS NULL AND cartItemType='artandcraft'");
		//echo $this->tab->sql;
	}

	function readid($uid)
	{
		return $this->tai->read("WHERE seller_userid = $uid");
	}

	function readdelivery($idspPostings)
	{
		return $this->ta->read("WHERE idspPostings = $idspPostings");

		//echo $this->ta->sql;
	}

	function readiddd($uid)
	{
		return $this->taw->read("WHERE seller_userid = $uid");
	}



	function readseller($pid)
	{
		return $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='0' AND is_cancel= '0' AND is_refund='0' AND cartItemType='Store'");
		//echo $this->ta->sql;

	}



	function readseller_artcraft($pid)
	{
		return   $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='0' AND is_cancel= '0' AND is_refund='0' AND cartItemType='artandcraft'");
		echo $this->ta->sql;
		die;
	}



	function readseller_artcraft_shipped($pid)
	{
		return  $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='2' AND is_cancel= '0' AND is_refund='0' AND cartItemType='artandcraft'");
		echo $this->ta->sql;
		die;
	}



	function readseller_artcraft_delivered($pid)
	{
		return  $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='3' AND is_cancel= '0' AND is_refund='0' AND cartItemType='artandcraft'");
		echo $this->ta->sql;
		die;
	}



	function read_prod_sell($pid)
	{
		return  $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='0' AND is_cancel= '0' AND is_refund='0'");
		//echo $this->ta->sql;
	}

	function readseller1($pid)
	{
		return $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='2'");
		//echo $this->ta->sql;
	}

	function readseller2($pid)
	{
		return $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='3'");
		//echo $this->ta->sql;
	}

	function readseller_shipped($pid)
	{
		return $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='2'");
		//echo $this->ta->sql;
	}

	function readseller_delivered($pid)
	{
		return $this->ta->read("WHERE spSellerProfileId = $pid AND spOrderStatus='1' AND shipping_status='3'");
		//echo $this->ta->sql;
	}


	function readst($pid)
	{
		return $this->ta->read("WHERE is_refund='1' AND spOrderStatus='1' AND spSellerProfileId=$pid AND cartItemType='Store'  ");
		//echo $this->ta->sql;
	}



	function readst_artcraft($pid)
	{
		return $this->ta->read("WHERE is_refund='1' AND spOrderStatus='1' AND spSellerProfileId=$pid AND cartItemType='artandcraft'  ");
		//echo $this->ta->sql; artandcraft
	}



	function readrefundbuyer($pid)
	{
		return $this->ta->read("WHERE is_refund='1' AND spOrderStatus='1' AND spByuerProfileId=$pid ");
		//echo $this->ta->sql;
	}

	function readcancelbuyer($pid)
	{
		return $this->ta->read("WHERE is_cancel='1' AND spOrderStatus='1' AND spByuerProfileId=$pid");
		//echo $this->ta->sql;
	}



	function readcancelbuyer_art($pid)
	{
		return $this->ta->read("WHERE is_cancel='1' AND spOrderStatus='1' AND spByuerProfileId=$pid AND  cartItemType='artandcraft' ");
		//echo $this->ta->sql;
	}




	function readcancel($pid)
	{
		return $this->ta->read("WHERE is_cancel='1' AND spOrderStatus='1' AND spSellerProfileId=$pid AND cartItemType='Store'");
		echo $this->ta->sql;
	}

	function readcancel_artcraft($pid)
	{
		return $this->ta->read("WHERE is_cancel='1' AND spOrderStatus='1' AND spSellerProfileId=$pid AND cartItemType='artandcraft'");
		echo $this->ta->sql;
	}
	function readcancel_artcraft_d($pid, $postid)
	{
		return $this->ta->read("WHERE is_cancel='1' AND spOrderStatus='1' AND spSellerProfileId=$pid AND cartItemType='artandcraft' AND idspOrder=$postid");
		echo $this->ta->sql;
	}

	// CREATE customers_basket attributes 
	function create_attrib($data)
	{
		return $this->tacba->create($data);
		//echo $this->tacba->sql;die('========');
	}

	function priviousorder($postid, $buyerpid, $cartItemType)
	{
		return $this->ta->read("WHERE idspPostings =" . $postid . " AND cartItemType ='" . $cartItemType . "' AND spByuerProfileId ='" . $buyerpid . "'");
	}


	function priviousattriborder($postid, $buyerpid, $cartItemType, $colorid, $sizeids)
	{
		return $this->tacba->read("WHERE t.idspPostings =" . $postid . " and spb.idspPostings =" . $postid . " and t.cartItemType ='" . $cartItemType . "' and t.cartItemType ='" . $cartItemType . "' and t.spByuerProfileId ='" . $buyerpid . "' and spb.spByuerProfileId ='" . $buyerpid . "' and t.color_idsopv ='" . $colorId . "' and t.size_idsopv='" . $sizeId . "'", "ORDER BY spb.spOrderQty ASC", "spb.spOrderQty", "left join spcustomers_basket spb on t.idspOrder =spb.idspOrder ");
	}

	function removefromCart($orderid)
	{
		$this->ta->remove("WHERE t.idspOrder =" . $orderid);
		$this->tacba->remove("WHERE t.idspOrder =" . $orderid);
		return true;
	}

	function updateorder($oid, $quantity)
	{
		return $this->ta->update(array("spOrderQty" => $quantity), "WHERE idspOrder ='" . $oid . "'");
	}
	function updatestatus($status, $bid)
	{
		//die('===========');
		return  $this->ta->update($status, "WHERE idspOrder = $bid");
		//echo $this->ta->sql;die('========');

	}
	function update_qty($data, $id)
	{

		return $this->tapost->update($data, "WHERE spPostings_idspPostings = $id AND spPostFieldName='quantity_'");
		//echo $this->tapost->sql;
		//die('========');
	}

	function updatecomment($comment, $bid)
	{
		//die('===========');
		return  $this->ta->update($comment, "WHERE idspOrder = $bid");
		//echo $this->ta->sql;die('========');

	}



	function updateqtyByitemid($oid, $quantity, $buyerpid, $cartItemType)
	{
		return $this->ta->update(array("spOrderQty" => $quantity), " WHERE idspPostings ='" . $oid . "'  AND spByuerProfileId = '" . $buyerpid . "' AND cartItemType = '" . $cartItemType . "'");
	}

	function updateorderstatusnew($buyerid, $sellerid, $shpping_Address)
	{

		return  $this->ta->update(array("spOrderStatus" => 1, "shipping_address" => $shpping_Address), " WHERE spBuyeruserId = $buyerid AND  spSellerProfileId = $sellerid ");

		//echo $this->ta->sql;die('=====66666666==========');


		//echo $this->ta->sql;die('=================');
	}
	/*	function newupdate($buyerid, $sellerid){
	//die('========');
	  return $this->ta->update(" WHERE spByuerProfileId = $buyerid AND  spSellerProfileId = $sellerid AND spOrderStatus is NULL ");
	 
	//echo $this->ta->sql;die('=================');
	}*/

	function readCartItemnew($uid)
	{
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ") AND spOrderStatus IS NULL  AND saveforlater='0'");
		//echo $this->ta->sql;
	}

	function readfrombasket($uid, $spid)
	{
		return $this->ta->read("WHERE spBuyeruserId=$uid AND spSellerProfileId=$spid AND spOrderStatus IS NULL");
	}
	function readfromart($id)
	{
		return $this->tapost->read("WHERE spPostings_idspPostings=$id AND spPostFieldName='quantity_' ");
	}
	function updateretailqty($arr, $id)
	{
		return $this->tadc->update($arr, "WHERE idspPostings=$id");
	}

	function updatewholesaleqty($arr, $id)
	{
		return $this->tadc->update($arr, "WHERE idspPostings=$id");
	}

	/*function readid($pid)
	{
		 return $this->tab->read("WHERE spByuerProfileId=$pid");
		echo $this->tab->sql;die;
	}*/

	function updatesaveforletter($oid, $savestatus)
	{
		return $this->ta->update(array("saveforlater" => $savestatus), "WHERE idspOrder ='" . $oid . "'");
	}


	function readCartItem($uid)
	{
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . ") AND spOrderStatus IS NULL AND saveforlater='0'");
	}

	function readselleritem($uid, $sellerid)
	{
		return $this->ta->read("WHERE spByuerProfileId in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . " AND spSellerProfileId=" . $sellerid . ") AND spOrderStatus IS NULL AND saveforlater='0'");
	}

	function quantityavailable($postid)
	{
		return $this->ta->read("WHERE idspOrder in (SELECT spOreder_idspOreder from sp_order_has_ordernew WHERE spPostings_idspPostings =" . $postid . ")");
		//echo  $this->ta->sql;die;
	}


	function readIdOrder($pid, $postingid)
	{
		return $this->ta->read("Where spByuerProfileId='" . $pid . "' AND d.spPostings_idspPostings =" . $postingid);
	}

	function readattribute($itemid, $bid, $itemtype)
	{
		return $this->tacba->read("Where idspPostings='" . $itemid . "' AND idspOrder ='" . $bid . "' and cartItemType='" . $itemtype . "'");
	}
}
