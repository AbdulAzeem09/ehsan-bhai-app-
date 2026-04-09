<?php 
class _spevent_transection
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spevent_transection");
		$this->tab = new _tableadapter("spfreelancerwallet");
		
		
		$this->tap = new _tableadapter("spevent_type_price");
		$this->taw = new _tableadapter("speventwallet");
		$this->taspw = new _tableadapter("spgroup_event_wallet");  
		$this->taship = new _tableadapter("shipment");
		$this->tas = new _tableadapter("order_transection");
		$this->tasrs = new _tableadapter("realstate_order_transection");
		$this->taspn = new _tableadapter("order_products_checkout");
		$this->taspnrs = new _tableadapter("order_realstate_checkout");
		$this->taspnrsup = new _tableadapter("room_booking");
		$this->ta->dbclose = false;
	}


	
 function readroom_booking($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->taspnrsup->read("WHERE spPosting_idspPosting =".$pid." AND spStatus=3");
		
    }
	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function create_wallet($wallet){
		return $this->taw->create($wallet);
		
	}
	function create_freewallet($wallet){
		return $this->tab->create($wallet);
		
	}
	
	function group_event_wallet($wallet){
	return $this->taspw->create($wallet);
	}
	
	
	function read_wallet($uid){
	return $this->taw->read("WHERE seller_userid=$uid ORDER BY id DESC");
	}
	
		function readprice($uid){
	return $this->tap->read("WHERE event_id=$uid");
	}
	
	
	function read_group_event_wallet($uid){
	return $this->taspw->read("WHERE seller_userid=$uid");
	}
	
	
	function readtodayearning($pid){
	$date_t=date('Y-m-d');
    return $this->taw->read("WHERE seller_userid =".$pid." AND transaction_date ='$date_t'","", "sum(amount) as today_total_earning");
	}
	
	function readtoday($pid){
	$date_t=date('Y-m-d');
    return $this->ta->read("WHERE sellid =".$pid." AND payment_date ='$date_t'","", "sum(payment_gross) as today_total_payment");
	//echo $this->ta->sql;die;
	}
	
	function readweekly($pid){
	$date_t=date('Y-m-d',strtotime("-6 days"));
	//echo $date_t;die;
      return $this->ta->read("WHERE sellid =".$pid." AND payment_date >= '$date_t'","", "sum(payment_gross) as weekly_total_payment");
	//echo $this->ta->sql;die;
	}
	
	function readweeklyEarning($pid){
	$date_t=date('Y-m-d',strtotime("-6 days"));
      return $this->taw->read("WHERE seller_userid =".$pid." AND transaction_date >= '$date_t'","", "sum(amount) as weekly_total_earning");
	}
	
	
	function readmonthly($pid){
	$date_t=date('Y-m-d',strtotime("-29 days"));
	//echo $date_t;die;
      return $this->ta->read("WHERE sellid =".$pid." AND payment_date >= '$date_t'","", "sum(payment_gross) as monthly_total_payment");
	//echo $this->ta->sql;die;
	}
	
	function readmonthlyearning($pid){
	$date_t=date('Y-m-d',strtotime("-29 days"));
      return $this->taw->read("WHERE seller_userid =".$pid." AND transaction_date >= '$date_t'","", "sum(amount) as monthly_total_earning");
	}
	
	function readyearly($pid){
	$date_t=date('Y-m-d',strtotime("-365 days"));
	//echo $date_t;die;
      return $this->ta->read("WHERE sellid =".$pid." AND payment_date >= '$date_t'","", "sum(payment_gross) as yearly_total_payment");
	//echo $this->ta->sql;die;
	}
	
	function readyearlyearning($pid){
	$date_t=date('Y-m-d',strtotime("-365 days"));
      return $this->taw->read("WHERE seller_userid =".$pid." AND transaction_date >= '$date_t'","", "sum(amount) as yearly_total_earning");
	}
	
	
	function createagain($data){
		return  $this->tas->create($data);
		
	}
	
		function createshipm($data){
           $this->taship->create($data);
	}
	
	function readshipm($data){
           return $this->taship->read("WHERE PostId = $data");
	}
	
		function readtr($data){
		return $this->tas->read("WHERE basketid = $data");
	}
	function createagainrealstate($data){
		$id = $this->tasrs->create($data);
		return $id;
	}
	function createagainnew($data){
		$id = $this->taspn->create($data);
		return $id;
	}
	function createagainnewrealstate($data){
		$id = $this->taspnrs->create($data);
		return $id;
	}
	
 function read($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE sellid =".$pid);
    }

     function postread($pid)
    {
        $pid = $this->ta->escapeString($pid);
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE postid =".$pid);

		
    }

 function orderread($id)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE id =".$id);
    }

  function readbuyer($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE buyer_uid =".$uid, "", "DISTINCT card_detail");
    }

     function mybooking($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE buyer_pid =".$pid." ORDER BY id DESC");
    }

	// DELETE ENQUIRY
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)

   function readeventtransection($Buyer_uid){


   	return $this->ta->read("WHERE buyer_uid =".$Buyer_uid);

   }


	
	function updateorderstatusrealstate($postid)
	{
		return $this->taspnrsup->update(array("spStatus" => 3), "WHERE idspRoomBook =".$postid."");
	}

	/*function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}*/

}
