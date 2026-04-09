

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $p = new _orderSuccess;
    $or = new _order;
   $result = $p->chekTxnExist($_POST['txtTxnNumber']);


        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
                 extract($row);

                   $result2 = $or->readOrderTxn($txn_id, $spProfile_idspProfile);

                                                          //  echo $or->ta->sql;

                                                            if ($result2) {
                                                                 while ($row2 = mysqli_fetch_assoc($result2)) {

                                               


/*
                                                                if ($row2['spOrderStatus'] == 0) {
                                                                    echo "Wait for shipping";
                                                                }else if($row2['spOrderStatus'] == 1){
                                                                    echo "Prepare Order To Ship";
                                                                }else if($row2['spOrderStatus'] == 2){
                                                                    echo "On Way";
                                                                }else if($row2['spOrderStatus'] == 3){
                                                                    echo "Delivered";
                                                                }*/

                                                       

             /*print_r($row);*/
	                                   
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		 
      $orderdata[] = array("cid"=>$cid ,"txn_id"=>$txn_id, "idspUser"=>$idspUser,"spProfile_idspProfile"=>$spProfile_idspProfile, "payer_id"=>$payer_id, "payer_email"=>$payer_email, "first_name"=>$first_name, "last_name"=>$last_name, "amount"=>$amount, "currency"=>$currency, "country"=>$country, "txn_type"=>$txn_type, "payment_type"=>$payment_type, "payment_status"=>$payment_status, "create_date"=>$create_date,"payment_date"=>$payment_date, "spOrderStatus"=>$row2['spOrderStatus']);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }


    }

   }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;








		 $data = array("status" => 200, "message" => "success","data"=>$orderdata);
	}else{

		$data = array("status" => 1, "message" => " Track order not aavailable.");
	}	



echo json_encode($data);

?>