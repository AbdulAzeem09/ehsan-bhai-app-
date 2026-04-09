<?php


class _orderSuccess
{

	public $dbclose = false;
	private $conn;
	public $ta;
	public $pay;
	public $spp;
	public $po;
	public $sh;

	function __construct()
	{
		//$this->taa 	= new _tableadapter("spwalletartandcraft");
		$this->ta 	= new _tableadapter("sporder_confirm");
		$this->taw 	= new _tableadapter("spwithdrawalreq_store");
		$this->tai 	= new _tableadapter("spprofiles");
		$this->tap 	= new _tableadapter(" spproduct");
		$this->tapa 	= new _tableadapter("sppostingsartcraft");

		$this->tab 	= new _tableadapter("spcustomers_basket");
		$this->pay 	= new _tableadapter("sppayment");
		$this->spp 	= new _tableadapter("spPersonalAccount");
		$this->po 	= new _tableadapter("spPoints");
		$this->sh 	= new _tableadapter("tbl_shipment");
		$this->cu 	= new _tableadapter("spuser");
		$this->with = new _tableadapter("tbl_withdrawalreq_status");
		$this->ta->dbclose = false;
	}

	// CREATE ORDER SUCCESS
	function createOrder($pid, $uid, $item_name, $amount, $currency, $payer_email, $first_name, $last_name, $country, $txn_id, $txn_type, $payment_status, $payment_type, $payer_id, $create_date, $payment_date)
	{
		$id = $this->ta->create(array("txn_id" => $txn_id, "idspUser" => $uid, "spProfile_idspProfile" => $pid, "txn_id" => $txn_id, "payer_id" => $payer_id, "payer_email" => $payer_email, "first_name" => $first_name, "last_name" => $last_name, "amount" => $amount, "currency" => $currency, "country" => $country, "txn_type" => $txn_type, "payment_type" => $payment_type, "payment_status" => $payment_status, "create_date" => $create_date, "payment_date" => $payment_date));
		return $id;
	}
	function createOrderstore($pid, $uid, $item_name, $amount, $currency, $first_name, $last_name, $country, $txn_id, $txn_type, $payment_status, $payment_type, $payer_id, $create_date, $payment_date)
	{
		$id = $this->ta->create(array("txn_id" => $txn_id, "idspUser" => $uid, "spProfile_idspProfile" => $pid, "txn_id" => $txn_id, "payer_id" => $payer_id, "first_name" => $first_name, "last_name" => $last_name, "amount" => $amount, "currency" => $currency, "country" => $country, "txn_type" => $txn_type, "payment_type" => $payment_type, "payment_status" => $payment_status, "create_date" => $create_date, "payment_date" => $payment_date));
		return $id;
	}


	function createwithdrawalstore($arr)
	{
		//die('========');
		return $this->taw->create($arr);
		//return $id;
		//echo $this->taw->sql;die('===');
	}
	function readdet()
	{
		return $this->taw->read("");
		//echo $this->taw->sql;die; 
	}
	function readuser($uid)
	{
	  return $this->taw->read("WHERE user_id = $uid");
	  //echo $this->taw->sql;die; 
	}

	function readWithdraw($uid, $status)
	{
		return  $this->taw->read("WHERE user_id = $uid  AND status = '$status'");
		//echo $this->taw->sql;die('==============');
	}

	function readid($uid, $module)
	{
		return $this->taw->read("WHERE  user_id = '$uid' AND module = '$module' AND status = '1' ");
		//echo $this->taw->sql;die("----");
	}

	function readid_wallet($uid, $module)
	{
		return $this->taw->read("WHERE  user_id = '$uid' AND module = '$module' AND status = '1' ");
		//echo $this->taw->sql;die("----");
	}


	//function readiddd($uid,$module){
	//return $this->taa->read("WHERE  user_id = '$uid' AND module = '$module' AND status = '1' ");
	//echo $this->taw->sql;die("----");
	//}



	function readREstatus($uid, $module)
	{
		return $this->taw->read("WHERE user_id  = '$uid' AND module = '$module' AND status = '0' ");
		//echo $this->taw->sql;die;
	}


	function createmodul($trancdata)
	{
		$id = $this->ta->create($trancdata);
		return $id;
	}

	function create($data, $postid)
	{
		$id = $this->ta->create($data);
		$this->tad->create(array("spPostings_idspPostings" => $postid, "spOreder_idspOreder" => $id));
		return $id;
	}
	// CHECK TXN ID IS AVAILABLE OR NOT
	function chekTxnExist($txn_id)
	{
		return $this->ta->read("WHERE txn_id = '$txn_id' ");
	}
	// read my order all 
	function readmyOrder($pid)
	{
		return $this->ta->read("WHERE spProfile_idspProfile = $pid ORDER By cid DESC");
		//echo $this->ta->sql;die;
	}

	function readname_44($id)
	{
		return $this->tap->read("WHERE idspPostings = $id");
	// 	 echo $this->tapa->sql;
	//  	die;("=======");
	}
	function readname($id)
	{
		return  $this->tapa->read("WHERE idspPostings = $id");
		//echo $this->tapa->sql;die('============================');
	}






	function readname_74($id)
	{
		return $this->tap->read("WHERE idspPostings = $id");
	}

	
 



	function readname_product($pid)
	{
		return  $this->tab->read(" WHERE spByuerProfileId = $pid ");
		// echo $this->tab->sql;
	   //die;("=======");
	}

	function readname_art($id)
	{
		return  $this->tapa->read("WHERE idspPostings = $id");
		//echo $this->tap->sql;die;
	}

	function readname_art_all($id)
	{
	  $id = $this->tapa->escapeString($id);
		return  $this->tapa->read("WHERE spPostingVisibility = - 1 AND spProfiles_idspProfiles = $id");
		//echo $this->tap->sql;die;
	}


	function readusername($id)
	{
		return  $this->tai->read("WHERE idspProfiles = $id");
		//echo $this->tap->sql;die;
	}

	function readcurrency($uid)
	{
		return $this->cu->read("WHERE idspUser = $uid");
		//echo $this->cu->sql;die('======'); 
	}


	function readproductname($id)
	{
		return  $this->tap->read("WHERE idspPostings = $id");
		//echo $this->tap->sql;die;
	}



	function readstatus($bpid, $buid)
	{
		 return $this->tab->read("WHERE spByuerProfileId = $bpid AND spBuyeruserId= $buid AND spOrderStatus=1 AND cartItemType='Store' AND is_cancel= '0' AND is_refund='0' ORDER BY idspOrder DESC");
		echo $this->tab->sql;die('====+++++>');
	}
	function readstatus_count($bpid, $buid)
	{
		return $this->tab->read("WHERE spByuerProfileId = $bpid AND spBuyeruserId= $buid AND cartItemType='Store' ORDER BY idspOrder DESC");
		echo $this->tab->sql;die('====+++++>');
	}

	function readstatus_art($bpid, $buid)
	{
		return $this->tab->read("WHERE spByuerProfileId = $bpid AND spBuyeruserId= $buid AND spOrderStatus=1 AND cartItemType='artandcraft' AND is_cancel= '0' AND is_refund='0' ORDER BY idspOrder DESC");
		// 		echo $this->tab->sql;die;
	}


	function readstatus_art_refund($bpid, $buid)
	{
		return $this->tab->read("WHERE spByuerProfileId = $bpid AND spBuyeruserId= $buid AND spOrderStatus=1 AND cartItemType='artandcraft' AND is_cancel= '0' AND is_refund='1' ORDER BY idspOrder DESC");
		//echo $this->tab->sql;die;
	}



	function readstatus_art_cancel($bpid, $buid)
	{
		return $this->tab->read("WHERE spByuerProfileId = $bpid AND spBuyeruserId= $buid AND spOrderStatus=1 AND cartItemType='artandcraft' AND is_cancel= '1' AND is_refund='0' ORDER BY idspOrder DESC");
		//echo $this->tab->sql;die;
	}







	function readdetails($id)
	{
		return $this->tab->read("WHERE idspOrder = $id ");
		//echo $this->tab->sql;die;
	}

	// read my order all 
	function readuserallOrder($uid)
	{
		return $this->ta->read("WHERE idspUser = $uid");
	}

	// read confirm order condition
	function readCnfrmOrdr($cid)
	{
		return $this->ta->read("WHERE cid = $cid");
	}
	// =============END=================

	// =============PAYMENT TABLE=======
	// read last balance
	function readMyBalance($pid)
	{
		return $this->pay->read("WHERE spProfile_idspProfile = $pid ORDER BY payment_id DESC LIMIT 1");
	}
	// ADD BUYER INFORMATION IN DB
	function createPayment($txnId, $pid, $payGross, $spPercntage, $payType, $balance)
	{
		$id = $this->pay->create(array("txt_id" => $txnId, "spProfile_idspProfile" => $pid, "payment_gross" => $payGross, "payment_percentage" => $spPercntage, "payment_type" => $payType, "blance" => $balance));
		return $id;
	}
	// =============END=================

	// =====PERSONAL ACCOUNT TABLE======
	// read last balance
	function getLastPersnlBlnc()
	{
		return $this->spp->read("ORDER BY idspPa DESC LIMIT 1");
	}
	// create personal acount info
	function createPersnlAcount($result3, $paAmt, $paType, $paBln)
	{
		$id = $this->spp->create(array("payment_id" => $result3, "paAmount" => $paAmt, "paType" => $paType, "paBalance" => $paBln));
		return $id;
	}
	// =============END=================

	// =============POINTS TABLE========
	function readlastBlnc($pid)
	{
		return $this->po->read("WHERE spProfile_idspProfile = $pid ORDER BY idspPoint DESC LIMIT 1");
	}
	// create points
	function createPoint($result3, $pid, $pointpertge, $pntAmt, $newBlnc)
	{
		$id = $this->po->create(array("payment_id" => $result3, "spProfile_idspProfile" => $pid, "pointpercentage" => $pointpertge, "pointAmount" => $pntAmt, "pointBalance" => $newBlnc));
		return $id;
	}
	// =============END=================
	// ==========SHIPMENT
	function createShip($ship_cmpny, $shipTrack, $shipDate)
	{
		$id = $this->sh->create(array("ship_cmpny" => $ship_cmpny, "ship_track_id" => $shipTrack, "ship_date" => $shipDate));
		return $id;
	}
	// -----------END=============	


	function orderedprofiledata($cid)
	{
		return $this->ta->read("WHERE cid = $cid");
	}

	function readmessage($uid)
	{
	  return $this->with->read("WHERE withdrawalreq_id = $uid");
	  //echo $this->with->sql;die; 
	}
	
	function addmessage($arr)
	{
	  return $this->with->create($arr);
	}

}
