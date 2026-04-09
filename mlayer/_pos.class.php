<?php
class _pos
{
	public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $ts;

	function __construct()
	{
		$this->invt_receive = new _tableadapter("pos_receive_invent");
		$this->invt_receive_detail = new _tableadapter("pos_receive_invent_detail");
		$this->invt_audit = new _tableadapter("pos_inventory_audit");
		$this->rec_inv_po = new _tableadapter("receive_inventory_by_po");
		$this->product_cat = new _tableadapter("subcategory");
		$this->supplier = new _tableadapter("pos_suppliers");
		$this->return_inv = new _tableadapter("pos_returns_inventory");
		$this->unpost_inv = new _tableadapter("pos_unposted_inventory");
		$this->trans_inv = new _tableadapter("pos_transfer_inventory");
		$this->mem_bar = new _tableadapter("pos_membership_barcode");
		$this->brand_list = new _tableadapter("pos_brand_list");
		$this->cust_id = new _tableadapter("pos_customer_id");
		$this->record = new _tableadapter("pos_customer_record");
		$this->ret_inv = new _tableadapter("pos_return_inventory");
		$this->inv = new _tableadapter("pos_inventory");
		$this->tap = new _tableadapter("membership_assign");
		$this->tam = new _tableadapter("pos_payment_method");
		$this->ta_dur = new _tableadapter("pos_membership_duration");
		$this->ta_bran = new _tableadapter("pos_branches");
		$this->ta_q = new _tableadapter("pos_membership_qty");
		$this->ta_qd = new _tableadapter("pos_member_qty_dur");
		$this->ta_cat = new _tableadapter("pos_category");
		$this->ta_gf = new _tableadapter("pos_gifts");
		$this->tadep = new _tableadapter("pos_department");
		$this->ta = new _tableadapter("pos_customer");
		$this->taa = new _tableadapter("spuser");
		$this->empex = new _tableadapter("employment_experience");
		$this->tax = new _tableadapter("pos_taxes");
		$this->tb = new _tableadapter("pos_membership_trsansaction");
		$this->tad = new _tableadapter("tbl_contact_issue_topic");
		$this->ts = new _tableadapter("tbl_social");
		$this->mem = new _tableadapter("membership_pos");
		$this->cur = new _tableadapter("spuser");
		$this->d = new _tableadapter("uploadimg_dk");
		$this->spuser = new _tableadapter("spuser");
		$this->profile = new _tableadapter("spprofiles");
		$this->user = new _tableadapter("pos_users");
		$this->roles = new _tableadapter("pos_add_roles");
		$this->discount = new _tableadapter("pos_add_discount");
		$this->admin = new _tableadapter("pos_contact_admin");
		$this->pass = new _tableadapter("pos_password_setting");
		$this->user_pass = new _tableadapter("pos_user_password");
		$this->support = new _tableadapter("support_details");
		$this->product_cat_1 = new _tableadapter("category_list");
		$this->mem_bar_n = new _tableadapter("pos_membership_barcode_manually");
		$this->city = new _tableadapter("tbl_city");
		$this->state = new _tableadapter(" tbl_state ");
		$this->country = new _tableadapter("tbl_country ");
		$this->tblcu = new _tableadapter("pos_membership_customer");
		$this->sa = new _tableadapter("spbusiness_profile ");
		$this->e = new _tableadapter("pos_email_containt ");
		$this->we = new _tableadapter("pos_wellcome_email_containt ");
		$this->dep = new _tableadapter("pos_department");
		$this->sp44 = new _tableadapter("spmedia_add");
		$this->empl = new _tableadapter("employes");
		$this->att = new _tableadapter("attendance");
		$this->pay = new _tableadapter("payroll");
		$this->hol = new _tableadapter("holiday");
		$this->acc = new _tableadapter("accounts");
		$this->cate = new _tableadapter("expensecategory");
		$this->expe = new _tableadapter("expense");
		$this->house = new _tableadapter("warehouse");
		$this->tapspp = new _tableadapter("spproduct");
		$this->p_quot = new _tableadapter("pos_quotation");
		$this->p_quot_d = new _tableadapter("pos_quotation_details");
		$this->tarr = new _tableadapter("pos_quotation");
		$this->taw = new _tableadapter("warehouse");
		$this->taca = new _tableadapter("pos_customer");
		


		$this->ta->dbclose = false;
	}





	function read_data_cust($posid)
    {
		return $this->ta->read('where spuser_userid ='. $posid);
		//echo $this->ta->sql; 
        //die("**************");
    
	}




	function read_search($uid)
    {
		return $this->ta->read('where uid='.$uid);
		//echo $this->spuser->sql; 
        //die("**************");
    
	}


	function read_drop1($id)
    {
		return $this->tapspp->read('where spProfiles_idspProfiles='.$id);
		//echo $this->tapspp->sql; 
        //die("**************");
    
	}



	function read_suppliername($id)
	{
	  $id = $this->supplier->escapeString($id);
	  return $this->supplier->read("WHERE id = $id");
		//echo $this->supplier->sql; 
        //die("**************");
    
	}


	function read_drop($id)
    {
		return $this->tax->read( $id);
		//echo $this->supplier->sql; 
        //die("**************");
    
	}




	function read_vender($id)
    {
		return $this->tapspp->read("WHERE idspPostings  = $id");
		//echo $this->tapspp->sql; 
        //die("**************");
    
	}


	function warehouse1_read($id)
    {
		return $this->tapspp->read("WHERE warehouse_id  = $id");
		//echo $this->tapspp->sql; 
        //die("**************");
    
	}



	function vendor_read($id)
    {
		return $this->tapspp->read("WHERE vendor_in  = $id");
		//echo $this->tapspp->sql; 
        //die("**************");
    
	}

	function read_user($id)
    {
		return $this->taa->read("WHERE idspUser  = $id");
		//echo $this->taa->sql; 
        //die("**************");
    
	}






	function read_product1($id)
    {
		return $this->tapspp->read("WHERE idspPostings = $id");
		//echo $this->tarr->sql; 
        //die("**************");
    
	}



	function read3($id)
  {
    $id = $this->p_quot_d->escapeString($id);
		return $this->p_quot_d->read("WHERE quotation_id = $id");
		//echo $this->tarr->sql; 
        //die("**************");
  }








     
    function read_pos($uid,$pid)
    {
        return $this->tarr->read("WHERE uid = $uid AND pid =" . $pid);
        //echo $this->tarr->sql; 
        //die("**************");
    }

	     
    function read_pos_warehouse($warehouseid)
    {
        return $this->taw->read("WHERE id = $warehouseid");
    }


	function read_pos_werehouse1($warehouseid1)
    {
        return $this->taw->read("WHERE id = $warehouseid1");
    }


	function read_pos_customer1($customerid)
    {
        return $this->taca->read("WHERE id = $customerid");
    }


	function re_customer($id)
    {
		return $this->ta->read("WHERE id = $id");
		//echo $this->ta->sql; die('======');
    }


     
	function re2_customer($id)
    {
		return $this->ta->read("WHERE id = $id");
		//echo $this->ta->sql; die('======');
    }


	function re_barcode($id)
    {
		
		return $this->tapspp->read("WHERE barcode = $id");
		//echo $this->tapspp->sql; die('======');
    }



	

	function read_pos_customer($customerid)
    {
        return $this->taca->read("WHERE id = $customerid");
		//echo $this->taca->sql; die('======');
    }


	function read_pos_id($posid)
    {
        return $this->taca->read("WHERE id = $posid");
    }


	function read_pos1($id)
    {
        $id = $this->tarr->escapeString($id);
        return $this->tarr->read("WHERE id = $id");
    }
	
	

	function department_check($type, $uid)
	{
		return $this->dep->read("WHERE t.department_in='$type'AND t.uid=$uid");
		// echo $this->dep->sql; die('======');
	}

	function department_readto($id)
	{
		return $this->dep->read("WHERE t.id=$id");
		// echo $this->dep->sql; die('======');
	}
	function shan_74()
	{
		return $this->sp44->read();
		//echo $this->sp44->sql; die('===');
	}

	function read_department($pid, $uid)
	{
		return $this->dep->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->dep->sql; die('===');
	}

	function read_Category($pid, $uid)
	{
		return $this->cate->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->cate->sql; die('===');
	}

	function read_warehouse($pid, $uid)
	{
		return $this->house->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->house->sql; die('===');
	}
	function read_attendance()
	{
		return $this->att->read();
		//echo $this->dep->sql; die('===');
	}
	function read_payroll()
	{
		return $this->pay->read();
		//echo $this->dep->sql; die('===');
	}
	function read_holiday($pid, $uid)
	{
		return $this->hol->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->dep->sql; die('===');
	}
	function read_account()
	{
		return $this->acc->read();
	}

	function read_account_to($id)
	{
		return $this->acc->read("WHERE t.id=$id");
	}
	function read_accountto($pid, $uid)
	{
		return $this->acc->read("WHERE t.pid='$pid' AND t.uid=$uid");
		
	}
	function read_employes($pid, $uid)
	{
		return $this->empl->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->dep->sql; die('===');
	}


	

	function read_expense($pid, $uid)
	{
		return $this->expe->read("WHERE t.pid='$pid' AND t.uid=$uid");
		//echo $this->dep->sql; die('===');
	}
	function read_employe_name($id)
	{
		return $this->empl->read("WHERE t.id='$id'");
		//echo $this->dep->sql; die('===');
	}
	function read_employesAll()
	{
		return $this->empl->read();
		//echo $this->dep->sql; die('===');
	}
	function read_employesData($id)
	{
	  $id = $this->empl->escapeString($id);
		return $this->empl->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}

	function read_expenseto($id)
	{
	  $id = $this->expe->escapeString($id);
	  return $this->expe->read("WHERE t.id=$id");
	// echo $this->dep->sql; die('===');
	}

	function readexpenseto($id)
	{
		return $this->cate->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}

	function readewarehouseto($id)
	{
		return $this->house->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}
	function read_attendanceData($id)
	{
	  $id = $this->att->escapeString($id);
	  return $this->att->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}
	function read_payrollData($id)
	{
	  $id = $this->pay->escapeString($id);
	  return $this->pay->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}
	function read_holidayData($id)
	{
		return $this->hol->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}
	function read_accountData($id)
	{
	  $id = $this->acc->escapeString($id);
	  return $this->acc->read("WHERE t.id=$id");
		//echo $this->dep->sql; die('===');
	}
	function readDepart($id)
	{
	  $id = $this->dep->escapeString($id);
		return $this->dep->read("WHERE t.id='$id'");
		//echo $this->dep->sql; die('===');
	}

	function readwarehouse($id)
	{
	  $id = $this->house->escapeString($id);
	  return $this->house->read("WHERE t.id='$id'");
	  //echo $this->dep->sql; die('===');
	}
	function readExcadegory($id)
	{
	  $id = $this->cate->escapeString($id);
	  return $this->cate->read("WHERE t.id='$id'");
		//echo $this->dep->sql; die('===');
	}
	function readEmail_new($email, $pid)
	{
		return $this->ta->read("WHERE t.email='$email' AND t.pid=$pid");

		// echo $this->ta->sql;
		//die('===');
	}

	function readPhone_new($phone, $pid)
	{
		return $this->ta->read("WHERE t.phone='$phone' AND t.pid=$pid");

		// echo $this->ta->sql;
		//die('===');
	}

	function readSupplierEmail($email, $pid)
	{
		return $this->supplier->read("WHERE t.email='$email' AND t.pid=$pid");

		// echo $this->ta->sql;
		//die('===');
	}
	function readSupplierPhone($phone, $pid)
	{
		return $this->supplier->read("WHERE t.phone='$phone' AND t.pid=$pid");

		// echo $this->ta->sql;
		//die('===');
	}
	function readQty($ba)
	{
		return $this->ta_q->read("WHERE barcode='$ba'");

		// echo $this->ta_q->sql;
		//die('===');
	}

	function readCom($pid)
	{
		return $this->sa->read("WHERE spprofiles_idspProfiles=$pid");
		// echo $this->ta_q->sql;
		//die('===');
	}

	function readspuser($spUserEmail)
	{
		return $this->spuser->read("WHERE spuserEmail='$spUserEmail'");

		// echo $this->ta_q->sql;
		//die('===');
	}
	function raedpid($userid)
	{
		return $this->cust_id->read("WHERE customer_id=$userid");

		// echo $this->cust_id->sql;
		//die('===');
	}

	function create($data)
	{
		return $this->ta->create($data);
		// echo $this->ta->sql;
		// die('===');
	}
	function create_quotation($data)
	{
		$id=$this->p_quot->create($data);
		return $id;
		//echo $this->ta->sql;
		//die('===');
	}
	function create_quotation_detail($data)
	{
		return $this->p_quot_d->create($data);
		
		//echo $this->ta->sql;
		//die('===');
	}
	function add_email_content($data)
	{
		return $this->e->create($data);
	}


	function add_invt_receive($data)
	{
		return $this->invt_receive->create($data);
	}

	function read_invt_receive($uid, $pid)
	{
		return $this->invt_receive->read("WHERE uid=$uid AND pid=$pid");
	}


	function add_invt_receive_detail($data)
	{
		return $this->invt_receive_detail->create($data);
	}


	function read_invt_receive_detail($id)
	{
		return $this->invt_receive_detail->read("WHERE pos_receiver_id = $id");
	}

	function delete_invt_receive_detail($id)
	{
		$this->invt_receive_detail->remove("WHERE id=$id");
	}


	function read_id_invt_receive_detail($id)
	{
		return $this->invt_receive_detail->read("WHERE id=$id");
	}

	function update_email_content($data, $id)
	{
		return $this->e->update($data, "WHERE id='$id'");
	}

	function update_Status1($data, $id)
	{

		return $this->ta->update($data, "WHERE id=$id");
	}

	function add_wellcomeEmail_content($data)
	{
		return $this->we->create($data);
	}

	function update_Wellcomeemail_content($data, $id)
	{
		return $this->we->update($data, "WHERE id='$id'");
	}
	function read_paragraph($pid)
	{
		return $this->e->read("WHERE pid='$pid'");
	}

	function read_email_c($uid, $pid)
	{
		return $this->e->read("WHERE uid=$uid AND pid=$pid");
	}
	function read_Wellcomeemail_c($uid, $pid)
	{
		return $this->we->read("WHERE uid=$uid AND pid=$pid");
	}


	function create_data($data3)
	{
		return $this->mem_bar_n->create($data3);
	}

	function createdataCu($data3)
	{
		return $this->tblcu->create($data3);
	}
	function createdatred($data3)
	{
		return $this->tblcu->read($data3);
	}
	function create_user($data)
	{
		return $this->spuser->create($data);
		//echo $this->spuser->sql; die('kjkkkkkkkkkkkk');
	}

	function read_cust($poid, $barcode)
	{
		return $this->tblcu->read("where t.customerr_user_id='$poid' AND t.barcode='$barcode' ");
		//echo $this->tblcu->sql; die;

	}
	function updateCust($data, $id)
	{
		return $this->tblcu->update($data, "where t.id='$id'");
		echo $this->tblcu->sql;
		die;
	}




	function read_cust_id($data)
	{
		return $this->spuser->read("where t.spUserEmail='$data'");
		//echo $this->spuser->sql; die;

	}

	function create_profile($data)
	{
		$id = $this->profile->create($data);
		return $id;
	}

	function create_profile_1($data)
	{
		$id = $this->mem_bar->create($data);
		return $id;
	}
	function readCurrency($uid)
	{
		$id = $this->spuser->read("WHERE idspUser=$uid");
		return $id;
	}
	function read_Email_1($spUserPhone)
	{
		return $this->spuser->read("WHERE spUserPhone='$spUserPhone'");

		//echo $this->spuser->sql;die('===');


	}


	function read__pos_email($pos_email)
	{
		return $this->ta->read("WHERE email='$pos_email'");

		//echo $this->spuser->sql;die('===');


	}
	function read__pos_phone($pos_phone)
	{
		return $this->ta->read("WHERE phone='$pos_phone'");

		//echo $this->ta->sql;die('===');


	}
	function read_Customer_1($bar)
	{
		return $this->ta_q->read("WHERE  barcode='$bar'");

		//echo $this->ta_q->sql;die('===');


	}
	function readQuantity($uid)
	{
		return $this->mem_bar->read("WHERE t.customerr_user_id='$uid'");

		//echo $this->mem_bar->sql;die('===');	
	}
	function read_quantity_q($id)
	{
		return $this->mem_bar->read("WHERE customerr_user_id='$id'");

		//echo $this->mem_bar->sql;die('===');	
	}
	function read_compny_address($pid)
	{
		return $this->sa->read("WHERE spprofiles_idspProfiles='$pid'");

		//echo $this->mem_bar->sql;die('===');	
	}

	function readQuantity2($select2)
	{
		$uid = $_SESSION['uid'];
		return $this->mem_bar->read("WHERE t.customerr_user_id='$uid' AND t.pid='$select2'");

		//echo $this->mem_bar->sql;die('===');


	}



	function create_trans_inv($data)
	{
		$id = $this->trans_inv->create($data);
		return $id;
	}

	function create_return_inv($data)
	{
		$id = $this->return_inv->create($data);
		return $id;
	}

	function create_unpost_inv($data)
	{
		$id = $this->unpost_inv->create($data);
		return $id;
	}

	function create_supplier($data)
	{
		$id = $this->supplier->create($data);
		return $id;
	}

	function create_brand($data)
	{
		$id = $this->brand_list->create($data);
		return $id;
	}

	function create_mem_bar($data)
	{
		$id = $this->mem_bar->create($data);
		return $id;
	}

	function add_pos_record($data)
	{
		$id = $this->record->create($data);
		return $id;
	}

	function add_pos_customer($data)
	{
		$id = $this->cust_id->create($data);
		return $id;
	}
	function read_peyment($id)
	{
		return $this->cust_id->read("WHERE id = $id");
	}

	function read_peyment_amount($uid)
	{
		return $this->cust_id->read("WHERE uid = $uid AND status = 1 ");
	}

	function read_peyment_months($uid, $current_motnh)
	{
		return $this->cust_id->read("WHERE uid = $uid AND date LIKE '%$current_motnh%' AND status = 1 ");
		//echo $this->cust_id->sql;
	}
	function read_peyment_monthsto($uid, $current_motnh)
	{
		return $this->cust_id->read("WHERE uid = $uid AND date LIKE '%$current_motnh%' AND status = 1 ");
		//echo $this->cust_id->sql; die("dddddddddddd");
	}

	function read_peyment_monthexpe($pid, $uid, $current_motnh)
	{
		return $this->expe->read("WHERE t.pid='$pid' AND t.uid=$uid AND date LIKE '%$current_motnh%'");
		//echo $this->expe->sql; die("dddddddddddd");
	}

	function read_holiday_month($pid, $uid, $current_motnh)
	{
		return $this->hol->read("WHERE t.pid='$pid' AND t.uid=$uid AND date_from LIKE '%$current_motnh%'");
		//echo $this->expe->sql; die("dddddddddddd");
	}
	function get_all_by_po()
	{
		return $this->rec_inv_po->read();
	}

	function get_all_by_po_filter($customer, $start_date, $end_date)
	{
		return $this->rec_inv_po->read("WHERE vendor_id = $customer AND posted_date BETWEEN '$start_date' AND '$end_date'");
	}

	function get_all_by_po_customer($customer)
	{
		return $this->rec_inv_po->read("WHERE vendor_id = $customer ");
	}


	function login_pos($email, $pass)
	{
		return $this->user_pass->read("WHERE users = '$email' AND password = $pass");
	}



	function login1($email, $pass)
	{
		 return $this->empl->read("WHERE t.email = '$email' AND t.password = $pass");
		echo $this->empl->sql; die('============');
	}



     



	function update_status($data, $id)
	{

		return $this->cust_id->update($data, "WHERE id='$id'");
		//echo $this->cust_id->sql;
		//die('=====');

	}
	function read_status($id)
	{

		return $this->cust_id->read("WHERE id = $id");
	}

	function create_category($data)
	{
		$id = $this->ta_cat->create($data);
		return $id;
	}

	function create_inventory($data)
	{
		$id = $this->inv->create($data);
		return $id;
	}

	function create_ret_inventory($data)
	{
		$id = $this->ret_inv->create($data);
		return $id;
	}

	function add_support($data)
	{
		$this->support->create($data);
	}
	function create_mem_qty_method($data)
	{
		$id = $this->ta_q->create($data);
		return $id;
	}

	function create_mem_qty_dur_method($data)
	{
		$id = $this->ta_qd->create($data);
		return $id;
	}



	function create_member_duration($data)
	{
		$id = $this->ta_dur->create($data);
		return $id;
	}


	function create_payment_method($data)
	{
		$id = $this->tam->create($data);
		return $id;
	}

	function create_taxes($data)
	{
		$id = $this->tax->create($data);
		return $id;
	}

	function create_pass($data)
	{
		$id = $this->pass->create($data);
		return $id;
	}


	function create_user_pass($data)
	{
		$id = $this->user_pass->create($data);
		return $id;
	}

	function create_support_detail($data)
	{
		$this->support->create($data);
	}

	function create_product_cat($data)
	{
		if (isset($_SESSION['uid'])) {
			$this->product_cat->create($data);
		}
	}

	function edit_product_cat($data, $id)
	{
		$uid = $_SESSION['uid'];
		$this->product_cat->update($data, "WHERE idsubCategory = $id ");
	}

	function get_all_cat()
	{
		$uid = $_SESSION['uid'];
		return $this->product_cat->read("  ORDER BY idsubCategory DESC ");
	}


     
	function report1_list()
	{
		
		return $this->mem_bar->read();
	}


	function rep1_list()
	{
		
		return $this->mem_bar->read();
	}


	function report2_list()
	{
		
		return $this->record->read();
	}


	function update_user_pass($data, $id)
	{
		$id = $this->user_pass->update($data, "WHERE id=$id");
		return $id;
	}

	function update_supplier($data, $id)
	{
	  $id = $this->supplier->escapeString($id);
		$id = $this->supplier->update($data, "WHERE id=$id");
		return $id;
	}

	function update_return_inv($data, $id)
	{
		$id = $this->return_inv->update($data, "WHERE id=$id");
		return $id;
	}

	function update_trans_inv($data, $id)
	{
		$id = $this->trans_inv->update($data, "WHERE id=$id");
		return $id;
	}

	function update_unpost_inv($data, $id)
	{
		$id = $this->unpost_inv->update($data, "WHERE id=$id");
		return $id;
	}



	function update_support_detail($data)
	{
		$uid = $_SESSION['uid'];
		$id = $this->support->update($data, "WHERE spuser_idspuser=$uid");
		return $id;
		//echo $this->support->sql;die('==============='); 

	}

	function delete_user_pass($id)
	{
		$this->user_pass->remove("WHERE id=$id");
	}

	function delete_trans_inv($id)
	{
		$this->trans_inv->remove("WHERE id=$id");
	}


	function delete_return_inv($id)
	{
		$this->return_inv->remove("WHERE id=$id");
	}

	function delete_unpost_inv($id)
	{
		$this->unpost_inv->remove("WHERE id=$id");
	}


	function remove_inventory($id)
	{
		$this->inv->remove("WHERE id=$id");
	}

	function remove_ret_inventory($id)
	{
		$this->ret_inv->remove("WHERE id=$id");
	}

	function delete_product_cat($id)
	{
		$uid = $_SESSION['uid'];
		$this->product_cat->remove("WHERE idsubCategory=$id ");
	}

	function get_user_pass()
	{
		$uid = $_SESSION['uid'];
		$id = $this->user_pass->read("WHERE uid = $uid");
		return $id;
	}

	function read_invt_audit()
	{
		$uid = $_SESSION['uid'];
		$id = $this->invt_audit->read("WHERE uid = $uid");
		return $id;
	}


	function get_trans_inv($barcode_in)
	{

		$id = $this->trans_inv->read("WHERE barcode_in = $barcode_in");
		return $id;
	}

	function read_brand()
	{
		$uid = $_SESSION['uid'];
		$id = $this->brand_list->read("WHERE uid = $uid");
		return $id;
	}

	function get_support()
	{
		$uid = $_SESSION['uid'];
		$id = $this->support->read("WHERE spuser_idspuser = $uid");
		return $id;
	}



	function readTransations()
	{
		$userid = $_SESSION['uid'];
		//echo $userid;
		// die('===============');
		return $this->cust_id->read("WHERE customer_id= $userid");
		//echo $this->cu->sql;die('==============='); 
	}

	function readTransations1()
	{
		$userid = $_SESSION['uid'];
		//echo $userid;
		//die('===============');
		return $this->cust_id->read("WHERE customer_id= $userid");
		//echo $this->cu->sql;die; 
	}
	function readTransations2()
	{
		$userid = $_SESSION['uid'];
		//$pid=$_SESSION['pid'];

		//echo $pid;
		//die('===============');
		return $this->mem_bar_n->read("WHERE t.customerr_user_id= $userid");
		//echo $this->mem_bar_n->sql;die('==============='); 
	}

	function readTransations2_mem($select1)
	{
		$userid = $_SESSION['uid'];

		return $this->mem_bar_n->read("WHERE t.customerr_user_id= $userid AND t.pid=$select1");
		//echo $this->mem_bar_n->sql;die('==============='); 
	}

	function read_pos_customer_id($cid)
	{

		$id = $this->record->read("WHERE customer_id = $cid");
		return $id;
		//echo $this->record->sql;
		//die('===');
	}

	function read_pos_customer_uid($uid)
	{

		return $id = $this->cust_id->read("WHERE uid = $uid ORDER BY id DESC");
		//echo $this->cust_id->sql;
		//die('===');
	}



	function read_pos_customer_uid1($uid , $urlid)
	{

		return $id = $this->cust_id->read("WHERE uid = $uid AND customer_id = $urlid ORDER BY id DESC");
		//echo $this->cust_id->sql;
		//die('===');
	}


	function read_supplier($uid)
	{

		$id = $this->supplier->read("WHERE uid = $uid");
		return $id;
	}

	


	function read_mem_bar($uid, $pid)
	{

		$id = $this->mem_bar->read("WHERE uid = $uid AND pid = $pid AND quantity > 0 ");
		return $id;
		//echo $this->mem_bar->sql;
		//die('==');

	}
	function read_mem_bar_id_customer($uid, $pid, $id)
	{

		//	$id = $this->mem_bar->read("WHERE uid = $uid AND pid = $pid AND customer_id=$id AND quantity > 0 ");     
		return $this->mem_bar->read("WHERE  customerr_user_id=$id ");

		//echo $this->mem_bar->sql;
		//die('==11');

	}
	function read_mem_bar_id_customer_n($uid, $pid, $id)
	{

		//	$id = $this->mem_bar->read("WHERE uid = $uid AND pid = $pid AND customer_id=$id AND quantity > 0 ");     
		$id = $this->mem_bar_n->read("WHERE  customerr_user_id=$id AND quantity > 0 ");
		return $id;
		//echo $this->mem_bar_n->sql;die('+++++');


	}

	function read_mem_bar_id($uid, $pid, $id)
	{

		$id = $this->mem_bar->read("WHERE uid = $uid AND pid = $pid AND customer_id=$id AND quantity > 0 ");
		//$id = $this->mem_bar->read("WHERE  customerr_user_id=$id AND quantity > 0 ");     
		return $id;
	}

	function read_barcode($id)
	{

		return $this->mem_bar->read("WHERE customerr_user_id=$id order by id DESC limit 1; ");    //echo $this->mem_bar->sql; 

	}
	function read_barcode11($id)
	{

		return $this->mem_bar->read("WHERE customerr_user_id=$id ");
		//echo $this->mem_bar->sql; 
		// die('====');

	}

	function read_barcode12($pd)
	{

		return $this->mem_bar->read("WHERE t.pid=$pd ");
		// echo $this->mem_bar->sql; 
		//  die('====');

	}


	function read_name_qty($id, $uid)
	{

		return $this->ta_q->read("WHERE barcode='$id' and uid='$uid' ");
		echo $this->ta_q->sql;
		die(' dddddddddd');
	}


	function read_pos_customerid($id)
	{

		$id = $this->cust_id->read("WHERE id = $id");
		return $id;
	}

	function read_pos_customer_rand_no($id)
	{

		$id = $this->cust_id->read("WHERE rand_no = $id");
		return $id;
	}



	function read_pos_customer_by_id($id)
	{

		$id = $this->taa->read("WHERE t.spUserPhone = $id");
		return $id;
		//echo $this->cust_id->sql; die('-----');

	}


	function read_pos_customer_by_date($id, $start_date, $end_date)
	{

		$id = $this->cust_id->read("WHERE customer_id = $id AND date BETWEEN '$start_date' AND '$end_date'");
		return $id;
		//echo $this->cust_id->sql; die('-----');

	}


	function read_pos_customer_by_date_1($start_date, $end_date)
	{

		$id = $this->cust_id->read("WHERE date BETWEEN '$start_date' AND '$end_date'");
		return $id;
		//echo $this->cust_id->sql; die('-----');

	}




	function get_support_detail()
	{
		$uid = $_SESSION['uid'];
		$id = $this->support->read("WHERE spuser_idspuser = $uid");
		return $id;
	}

	function read_trans_inv()
	{
		$uid = $_SESSION['uid'];
		$id = $this->trans_inv->read("WHERE uid = $uid");
		return $id;
	}

	function read_return_inv()
	{
		$uid = $_SESSION['uid'];
		$id = $this->return_inv->read("WHERE uid = $uid");
		return $id;
	}

	function read_unpost_inv()
	{
		$uid = $_SESSION['uid'];
		$id = $this->unpost_inv->read("WHERE uid = $uid");
		return $id;
	}

	function create_gifts($data)
	{
		$id = $this->ta_gf->create($data);
		return $id;
	}

	function create_department($data)
	{
		$id = $this->tadep->create($data);
		return $id;
	}
	function create_Category_($data)
	{
		return $this->cate->create($data);
		
	}

	function create_warehouse_($data)
	{
		return $this->house->create($data);
		
	}
	function create_employee($data)
	{
		$id = $this->empl->create($data);
		return $id;
	}

	function create_expense($data)
	{
		$id = $this->expe->create($data);
		return $id;
	}
	function create_attendance($data)
	{
		return $this->att->create($data);
	}
	function create_payroll($data)
	{
		return $this->pay->create($data);
	}
	function create_holiday($data)
	{
		return $this->hol->create($data);
	}
	function create_account($data)
	{
		return $this->acc->create($data);
	}

	function update_employee($data, $id)
	{
	  $id = $this->empl->escapeString($id);
		return $this->empl->update($data, "Where id=$id");
	}

	function update_expense($data, $id)
	{
	  $id = $this->expe->escapeString($id);
	  return $this->expe->update($data, "Where id=$id");
	}
	function update_attendance($data, $id)
	{
	  $id = $this->att->escapeString($id);
	  return $this->att->update($data, "Where id=$id");
	}
	function update_payroll($data, $id)
	{
	  $id = $this->pay->escapeString($id);
	  return $this->pay->update($data, "Where id=$id");
	}
	function update_holiday($data, $id)
	{
		return $this->hol->update($data, "Where id=$id");
	}
	function update_account($data, $id)
	{
	  $id = $this->acc->escapeString($id);
	  return $this->acc->update($data, "Where id=$id");
	}
	function create_branches($data)
	{
		$id = $this->ta_bran->create($data);
		return $id;
	}


	function insert($data)
	{
		return $this->tb->create($data);
	}
	//add role
	function add_roles($data)
	{
		$this->roles->create($data);
	}
	function update_role($data, $id)
	{
		return $this->roles->update($data, "Where id=$id");
	}

	function update_mem_bar($data, $id)
	{
		return $this->mem_bar->update($data, "Where id=$id");
		echo $this->mem_bar->sql;
		die('==');
	}

	function update_brand_list($data, $id)
	{
		return $this->brand_list->update($data, "Where id=$id");
	}

	function update_pos_pass($data, $uid)
	{
		return $this->pass->update($data, "Where `uid`= $uid");
		//echo $this->pass->sql;
	}
	function create_pos_pass($data)
	{
		return $this->pass->create($data);
	}
	function read_pos_pass($uid)
	{
		return $this->pass->read("WHERE `uid` = $uid");
	}

	function update_payment_method($data, $id)
	{
		return $this->tam->update($data, "Where id=$id");
	}
	function update_tax_method($data, $id)
	{
		return $this->tax->update($data, "Where id=$id");
	}

	function update_inventory($data, $id)
	{
		return $this->inv->update($data, "Where id=$id");
	}

	function update_ret_inventory($data, $id)
	{
		return $this->ret_inv->update($data, "Where id=$id");
	}

	function update_gift_method($data, $id)
	{
		return $this->ta_gf->update($data, "Where id=$id");
	}

	function update_mem_qty_method($data, $id)
	{
		return $this->ta_q->update($data, "Where id=$id");
	}

	function update_department_method($data, $id)
	{
		return $this->tadep->update($data, "Where id=$id");
	}

	function create_update_($data, $id)
	{
	  $id = $this->cate->escapeString($id);
	  return $this->cate->update($data, "Where id=$id");
	}
	function update_category_method($data, $id)
	{
		return $this->ta_cat->update($data, "Where id=$id");
	}

	function update_branches_method($data, $id)
	{
		return $this->ta_bran->update($data, "Where id=$id");
	}

	function update_mem_dur_method($data, $id)
	{
		return $this->ta_dur->update($data, "Where id=$id");
	}


	function update_pos_customer_rand_no($data, $id)
	{
		return $this->cust_id->update($data, "Where rand_no=$id");
	}


	function update_admin_method($data, $id)
	{
		return $this->admin->update($data, "Where id=$id");
		// echo $this->admin->sql; die('------');		
	}

	function update_warehouse_($data, $id)
	{
	  $id = $this->house->escapeString($id);
	  return $this->house->update($data, "Where id=$id");
	  // echo $this->admin->sql; die('------');		
	}
	function update_pass($data, $uid, $old_pass)
	{
		return $this->pass->update($data, "Where uid=$uid AND password= $old_pass");
		// echo $this->admin->sql; die('------');		
	}

	function read_roles($uid)
	{
		return $this->roles->read("WHERE spuser_idspuser= $uid");
	}

	function read_data_payment($uid)
	{
		return $this->tam->read("WHERE uid= $uid");
	}
	function read_data_payment1($uid)
	{
		return $this->tam->read("WHERE uid= $uid");
		// echo $this->tam->sql; die('------');

	}

	function read_pos_password($uid)
	{
		return $this->pass->read("WHERE uid= $uid");
	}

	function read_data_inventory($uid)
	{
		return $this->inv->read("WHERE uid= $uid");
	}

	function read_data_ret_inventory($uid)
	{
		return $this->ret_inv->read("WHERE uid= $uid");
	}

	function check_password_uid($pass, $uid)
	{
		return $this->pass->read("WHERE password= $pass AND uid= $uid ");
	}


	function read_admin($uid)
	{
		return $this->admin->read("WHERE spuser_idspuser= $uid");
		//echo  $this->admin->sql; die('------');	 

	}
	function read_compny_logo($uid)
	{
		return $this->admin->read("WHERE spuser_idspuser= $uid");
		//echo  $this->admin->sql; die('------');	 

	}


	function read_data_membership_qty($uid)
	{
		return $this->ta_q->read("WHERE uid= $uid");
		//echo $this->ta_q->sql;   

	}

	function read_member_bar($id)
	{
		return  $this->ta_q->read("WHERE barcode= '$id'");
		echo $this->ta_q->sql;
		die('=');
	}

	function read_data_membership_qty_id($id)
	{
		return $this->ta_q->read("WHERE id = $id");
	}


	function read_data_membership_qty_dur_id($id)
	{
		return $this->ta_dur->read("WHERE id = $id");
	}


	function read_data_membership_dur($uid)
	{
		return $this->ta_dur->read("WHERE uid= $uid");
	}

	function read_data_tax($uid)
	{
		return $this->tax->read("WHERE uid= $uid");
		//echo $this->tax->sql;  die('===========');
	}


	function read_data_branches($uid)
	{
		return $this->ta_bran->read("WHERE uid= $uid");
	}


	function read_data_department($uid)
	{
		return $this->tadep->read("WHERE uid= $uid");
	}

	function read_data_gifts($uid)
	{
		return $this->ta_gf->read("WHERE uid= $uid");
	}

	function read_data_category($uid)
	{
		return $this->ta_cat->read("WHERE uid= $uid");
	}

	function delete_supplier($id)
	{
		return $this->supplier->remove("WHERE id=$id");
	}

	function remove_invt_audit($id)
	{
		return $this->invt_audit->remove("WHERE id=$id");
	}

	function delete_role($id)
	{
		return $this->roles->remove("WHERE id=$id");
	}

	function remove_brand($id)
	{
		return $this->brand_list->remove("WHERE id=$id");
	}

	function remove_payment_method($id)
	{
		$this->tam->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_tax_method($id)
	{
		$this->tax->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_gift_method($id)
	{
		$this->ta_gf->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_department_method($id)
	{
		$this->tadep->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_warehouse($id)
	{
		$this->house->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_expense($id)
	{
		$this->expe->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_category_($id)
	{
		$this->cate->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_employee($id)
	{
		$this->empl->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_account($id)
	{
		$this->acc->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_holiday($id)
	{
		$this->hol->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_attendance($id)
	{
		$this->att->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}
	function remove_payroll($id)
	{
		$this->pay->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_mem_qty_method($id)
	{
		$this->ta_q->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_category_method($id)
	{
		$this->ta_cat->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_branches_method($id)
	{
		$this->ta_bran->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	function remove_mem_dur_method($id)
	{
		$this->ta_dur->remove("WHERE id=$id");
		// echo $this->tam->sql; 	die('----'); 
	}

	//role end
	//contact_admin start

	function add_message($data)
	{
		return $this->admin->create($data);
	}
	/*function update_message($data,$id){
		return $this->admin->update($data,"Where id=$id");
	}
	function read_message($uid){
	return $this->admin->read("WHERE spuser_idspuser= $uid");
	
	}
	
	function delete_message($id){
	return $this->admin->remove("WHERE id=$id");
	}*/



	//contact_admin end

	//discount start
	function add_discount($data)
	{
		$this->discount->create($data);
	}
	function update_discount($data, $id)
	{
		return $this->discount->update($data, "Where id=$id");
	}
	function read_discount($uid)
	{
		return $this->discount->read("WHERE spuser_idspuser= $uid");
	}

	function delete_discount($id)
	{
		return $this->discount->remove("WHERE id=$id");
	}


	//discount end

	//user start
	function add_users($data)
	{
		return $this->user->create($data);
	}
	function read_users($uid)
	{
		return $this->user->read("WHERE spuser_idspuser= $uid");
	}



	function read_users_id($id)
	{
		return $this->user->read("WHERE id= $id");
	}

	function update_user($data, $id)
	{
		return $this->user->update($data, "Where id=$id");
	}

	function update_invt_aduit($data, $id)
	{
		return $this->invt_audit->update($data, "Where id=$id");
	}

	function delete_user($id)
	{
		return $this->user->remove("WHERE id=$id");
	}

	//user end

	function readid()
	{
		return $this->tb->read();
	}
	function cust_name($data)
	{
		return $this->ta->read("WHERE t.id=$data ");
		// echo $this->taa->sql;
		//die('=====');	
	}
	function read_data_phone($data)
	{
		return $this->taa->read("WHERE t.spUserPhone=$data ");
		//echo $this->taa->sql; die('=====');
	}


	function read_data_phone_cust($data)
	{
		return $this->ta->read("WHERE t.phone=$data ");
		//echo $this->taa->sql; die('=====');
	}



	function member_name($data)
	{
		return $this->mem->read("WHERE t.id=$data");
		echo $this->mem->sql;
		//die('==');		
	}


	function create_member_1($data)
	{
		$id = $this->tap->create($data);
		return $id;
	}
	function uploadimg($data)
	{
		return  $this->d->create($data);
	}

	function create_membership($data)
	{
		$id = $this->mem->create($data);
		return $id;
	}
	function currency($uid)
	{
		return $this->cur->read("WHERE idspuser=$uid");
	}


	function read_membership($uid)
	{
		return $this->mem->read("WHERE spuser_idspuser=$uid");
	}

	function read_membership_id($id)
	{
		return $this->mem->read("WHERE id=$id");
	}
	function update_membership($data, $id)
	{
		return $this->mem->update($data, "WHERE id=$id");
	}

	function delete_membership($id)
	{
		$this->mem->remove("WHERE id=$id");
	}
	// ===========TABLE CONTACT ISSUE==============
	function read_data($pid)
	{
		return $this->ta->read("WHERE pid = $pid ORDER BY id DESC");
	}
	function read_email_id($id)
	{
		return $this->ta->read("WHERE id = $id");
	}
	function read_id_spuser($phone)
	{
		return $this->spuser->read("WHERE spUserPhone = $phone");
	}

	function read_dataByid($id)
	{
		return $this->spuser->read("WHERE idspUser=$id ");
		//echo $this->spuser->sql;
		//die("==");
	}

	function read_cityName($spUserCity)
	{
		return $this->city->read("WHERE city_id =$spUserCity ");
		//echo $this->city->sql;
		//die("==");
	}
	function read_stateName($spUserState)
	{
		return $this->state->read("WHERE state_id =$spUserState ");
		//echo $this->city->sql;
		//die("==");
	}
	function read_countryName($spUserCountry)
	{
		return $this->country->read("WHERE country_id =$spUserCountry ");
		//echo $this->city->sql;
		//die("==");
	}



	function readName_qty2_search($pid)
	{
		return $this->mem_bar->read("WHERE quantity>0 AND t.pid=$pid ");
		// echo $this->mem_bar->sql;
		//die("==");
	}


	function readName_qty($uid, $pid)
	{
		return $this->mem_bar->read("WHERE t.customerr_user_id=$uid AND quantity>0 AND t.pid=$pid ");
		//echo $this->mem_bar->sql;
		// die("=="); 

	}
	function readName_qty1($uid)
	{
		return $this->ta_q->read("WHERE barcode='$uid' ");
	}
	function readName_qty3($select3)
	{
		$uid - $_SESSION['uid'];
		return $this->mem_bar->read("WHERE t.customerr_user_id=$uid AND quantity>0 AND t.pid=$select3 ");
		// echo $this->mem_bar->sql;
		//die("==");
	}

	function read_data_uid($uid)
	{
		return $this->ta->read("WHERE uid = $uid");
	}

	function read_data1($data)
	{
		//die("==");
		return $this->ta->read("WHERE id = $data");
		//echo $this->ta->sql;
		//die('==');
	}

	function read_data_id($id)
	{
		return $this->ta->read("WHERE id = $id");
	}

	function read_supplier_id($id)
	{
	  $id = $this->supplier->escapeString($id);
	  return $this->supplier->read("WHERE id = $id");
	}

	function read_filter($phone, $start_date, $end_date, $biller_id)
	{
		return $this->cust_id->read("WHERE phone_number = '$phone' AND t.cur_date BETWEEN '$start_date' AND '$end_date' $biller_id");
		//echo $this->cust_id->sql;
		//die('==========');
	}

	function read_filterto($start_date, $end_date, $biller_id)
	{
		return $this->pay->read("WHERE t.date BETWEEN '$start_date' AND '$end_date' $biller_id");
		//echo $this->pay->sql;
		//die('==========');
	}

	function read_filteratt($start_date, $end_date, $biller_id)
	{
		return $this->att->read("WHERE t.date BETWEEN '$start_date' AND '$end_date' $biller_id");
		//echo $this->pay->sql;
		//die('==========');
	}

    function read_expence2($start_date, $end_date, $biller_id)
	{
		return $this->expe->read("WHERE t.date BETWEEN '$start_date' AND '$end_date' $biller_id");
		//echo $this->pay->sql;
		//die('==========');
	}





	function read_filterahol($start_date, $end_date)
	{
		return $this->hol->read("WHERE t.date_from BETWEEN '$start_date' AND '$end_date'");
		//echo $this->hol->sql;
		//die('==========');
	}
	function read_data_phone2($phone)
	{

		return $this->cust_id->read("WHERE phone_number = $phone");
		echo $this->cust_id->sql;
		die('==========');
	}
	function read_data_phone1($id)
	{
		return $this->mem_bar->read("WHERE t.customerr_user_id = $id");
		//echo $this->mem_bar->sql;die('++++++++++++'); 
	}



	function remove($id)
	{
		return $this->ta->remove("WHERE id = $id");
	}



	function update($data, $res)
	{
		$this->ta->update($data, " WHERE id = $res ");
		//echo  $this->ta->sql; die('-----');

	}


	// ===========TABLE SOCIAL==============
	function readSocial()
	{
		return $this->ts->read();
	}


	function read_email_check($email)
	{
		return $this->cur->read("WHERE t.spUserEmail='$email'");
	}

	function read_email_check_pro($email)
	{
		return $this->profile->read("WHERE t.spProfileEmail='$email'");
	}

	function read_email($data)
	{
		return $this->cur->create($data);
		//	 echo  $this->cur->sql; die('-----');

	}

	function readprofile($data)
	{
		return $this->profile->read("WHERE t.idspProfiles='$data'");
		//echo $this->profile->sql; die('-----');

	}
	function filter_new($data, $from, $to)
	{

		$userid = $_SESSION['uid'];
		//echo $userid;
		// die('===============');
		return $this->cust_id->read("WHERE customer_id= $userid AND t.pid=$data AND t.cur_date BETWEEN $from and $to");

		// return $this->cust_id->read("WHERE ");
		//echo $this->cust_id->sql; die('-----');

	}
	function filter_date($data1, $data2)
	{
		$userid = $_SESSION['uid'];


		return $this->cust_id->read("WHERE customer_id= $userid AND cur_date= $data1 BETWEEN cur_date=$data2");
		//echo $this->cust_id->sql; die('-----');


	}

	function readprofile_emp($data)
	{
		return $this->empex->read("WHERE t.idspProfiles='$data'");
		// echo $this->empex->sql; die('-----');

	}



	function update_membership_real($data, $id)
	{

		return $this->mem_bar->update($data, "WHERE id='$id'");
		//echo $this->cust_id->sql;
		//die('=====');

	}
}
