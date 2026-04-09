

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






        $en = new _spquotation;
       $result = $en->getsellerquotation($_POST['spProfiles_idspProfiles']);
        /* echo $en->ta->sql;*/

          if ($result){
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {


              



  $pst = new _productposting;
                                          $result3 = $pst->read($row['spPostings_idspPostings']);



                                                      if ($result3) {
                                                      $row3 = mysqli_fetch_assoc($result3);
                                                          $producttitle =  $row3['spPostingTitle'];
                                                                        }
     $ch = new _rfqchat;
                                                $commresult  = $ch->getsellercomment($row['idspQuotation']);
                                                        // echo $ch->ta->sql;            

                                                       if($commresult != false)
                                                                 {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                  //  print_r($commrow);

                                                      $Sellercomment = $commrow["sellercomments"];
                                                      $Scommentid = $commrow["id"];
                                                        $commid = $commrow["comment_id"];                                                                    
                                                            
                                                             }
                                                           }

    $qu = new _quotation_transection;
                                                $quote_res  = $qu->getrfqorder($row['idspQuotation']);

                                              //echo $qu->ta->sql;

                                          if ($quote_res) {
                                           $quote_row = mysqli_fetch_assoc($quote_res);
                                                  //echo $quote_row['spPostingTitle'];

                                           $paymentattus= "Paid";
                                           }else{
                                           $paymentattus= "Unpaid";
                                           } 
                                                       
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$rfqdata[] = array("idspQuotation"=>$row['idspQuotation'],"rfqTitle"=>$producttitle,"spQuotationBuyerid"=>$row['spQuotationBuyerid'],"spQuotationSellerid"=>$row['spQuotationSellerid'],"spPostings_idspPostings"=>$row['spPostings_idspPostings'],"spQuotationTotalQty"=>$row['spQuotationTotalQty'],"spQuotatioProductDetails"=>$row['spQuotatioProductDetails'],"spQuotationDelevery"=>$row['spQuotationDelevery'],"Sellercomment"=>$Sellercomment,"paymentattus"=>$paymentattus);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$rfqdata);
	}else{

		$data = array("status" => 1, "message" => "No RfQ found");
	}	



echo json_encode($data);

?>