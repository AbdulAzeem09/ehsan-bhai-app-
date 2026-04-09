

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

     $p = new _orderSuccess;
     $or = new _order; 
     $result = $p->readmyOrder($_POST['spProfiles_id']); 


        if ($result) {
          
          while ($row = mysqli_fetch_assoc($result)) {
          extract($row);
         

           $result2 = $or->readOrderTxn($row['txn_id'], $_POST['spProfiles_id']);


                   if ($result2) {
                                    
                   while ($row2 = mysqli_fetch_assoc($result2)) {



                                             $buyerprofilid = $row2['spByuerProfileId'];

                                              $sellerprofilid = $row2['spSellerProfileId'];

                                             $sellpostid = $row2["idspPostings"];
                                                              
                                             $sellproducttitle = $row2["spPostingTitle"];

                                               $sporderAmount = $row2["sporderAmount"];
                                                                
                                               $idspOrder = $row2["idspOrder"];
                                               $spOrderQty = $row2['spOrderQty'];

                                                $sporderdate = $row2['sporderdate'];

    

                                              $sp = new _spprofiles;

                                              $spbuyresult  = $sp->read($spProfile_idspProfile);
                                                 if($spbuyresult != false)
                                                                       {
                                                              $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                              $buyername = $buyrow["spProfileName"];
   

                                                                    
                                                                }






                                              $spsellresult  = $sp->read($sellerprofilid);
                                             if($spsellresult != false)
                                                          {
                                                              $sellrow = mysqli_fetch_assoc($spsellresult);
                                                              $sellername = $sellrow["spProfileName"];
   

                                                                    
                                                                }


                                                            $pp = new _productpic;  

                                                 $sellpic = $pp->read($sellpostid);

                                                      // $pict=array();
                                                 // echo $pp->ta->sql;
                                                        if($sellpic != false){
          
                                                   $sellrowpic = mysqli_fetch_assoc($sellpic);
                                                               //   $sellProductimg   = $sellrowpic['spPostingPic'];
                                                    $pict = ($sellrowpic['spPostingPic']);



                                                                       }         






		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		  $orderdata[] = array("cid"=>$cid , "sellpostid"=>$sellpostid ,"buyername"=>$buyername, "sellername"=>$sellername,"txn_id"=>$txn_id, "idspUser"=>$idspUser,"spProfile_idspProfile"=>$spProfile_idspProfile, "payer_id"=>$payer_id, "payer_email"=>$payer_email, "first_name"=>$first_name, "last_name"=>$last_name, "amount"=>$amount, "currency"=>$currency, "country"=>$country, "txn_type"=>$txn_type, "payment_type"=>$payment_type, "payment_status"=>$payment_status, "create_date"=>$create_date,"payment_date"=>$payment_date, "create_date"=>$create_date, "sellproducttitle"=>$sellproducttitle,"spOrderQty"=>$spOrderQty, "sporderdate"=>$sporderdate, "picture"=> $pict );
	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }

  
   }

   }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;








		 $data = array("status" => 200, "message" => "success","data"=>$orderdata);
	}else{

		$data = array("status" => 1, "message" => "Order histroy not available.");
	}	



echo json_encode($data);

?>