

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






       $r = new _rfq;
               $result = $r->readsubmittedRfqquote($_POST['spProfiles_idspProfiles']);
                //echo $r->tcd->sql;

                  if ($result) {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {


/*print_r($row);*/



  $pst = new _productposting;
                                          $result3 = $pst->read($row['spPostings_idspPostings']);



                                                      if ($result3) {
                                                      $row3 = mysqli_fetch_assoc($result3);
                                                          $producttitle =  $row3['spPostingTitle'];
                                                                        }
/*$qt = new _rfq_transection;
                                            $rfqquote_res  = $qt->getpublicrfq_order($row['idspRfqComment']);

                                              //echo $qt->ta->sql;

                                          if ($rfqquote_res) {
                                           $rfqquote_res = mysqli_fetch_assoc($rfqquote_res);
                                                  //echo $quote_row['spPostingTitle'];

                                           echo "Paid";
                                           }else{
                                            echo "Unpaid";
                                           } */
  
                                                       
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$rfqdata[] = array("idspRfq"=>$row['idspRfq'],"rfqDesc"=>$row['rfqDesc'],"rfqDate"=>$row['rfqDate'],"rfqPrice"=>$row['rfqPrice'],"rfqcProductName"=>$row['rfqcProductName'],"rfqcModelNum"=>$row['rfqcModelNum'],"rfq_spProfiles_idspProfiles"=>$row['rfq_spProfiles_idspProfiles'],"rfqcMinOrder"=>$row['rfqcMinOrder'],"rfqcMaxOrder"=>$row['rfqcMaxOrder']);

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