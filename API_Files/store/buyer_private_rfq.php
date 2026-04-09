

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






        $en = new _spquotation;
                                             $result = $en->getbuyerquotation($_POST['spProfiles_idspProfiles']);
                       
                                  // echo $r->ta->sql; 
                                               
        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              

             /*print_r($row);*/
	    	 $pr = new _spprofiles;
             $NameOfProfile = $pr->getProfileName($row['spProfile_idspProfiles']);


                $pst = new _productposting;
                                          $result3 = $pst->read($row['spPostings_idspPostings']);



                                                      if ($result3) {
                                                      $row3 = mysqli_fetch_assoc($result3);
                                                          $title = $row3['spPostingTitle'];
                                                                        }
                                                                  

                                                         $rc = new _country; 
                                                        $result_cntry = $rc->readCountryName($row['spQuotationCountry']);
                                                        if ($result_cntry) {
                                                            $row4 = mysqli_fetch_assoc($result_cntry);
                                                            $country = $row4['country_title'];
                                                        }

                                                         $st = new _state;
                                                        $result_stat = $st->readStateName($row['spQuotationState']);
                                                        if ($result_stat) {
                                                            $row6 = mysqli_fetch_assoc($result_stat);
                                                            $state = $stateName = $row6['state_title'];
                                                        }


                                                          $rcty = new _city;
                                                        $result_cty = $rcty->readCityName($row['spQuotationCity']);
                                                        if ($result_cty) {
                                                            $row5 = mysqli_fetch_assoc($result_cty);
                                                            $city = $cityName = $row5['city_title'];
                                                        }
                                                       
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$rfqdata[] = array("idspQuotation"=>$row['idspQuotation'],"rfqtitle"=>$title,"spQuotationBuyerid"=>$row['spQuotationBuyerid'],"spQuotationSellerid"=>$row['spQuotationSellerid'],"spPostings_idspPostings"=>$row['spPostings_idspPostings'],"spQuotationTotalQty"=>$row['spQuotationTotalQty'],"spQuotatioProductDetails"=>$row['spQuotatioProductDetails'],"spQuotationDelevery"=>$row['spQuotationDelevery'],"spQuotationPrice"=>$row['spQuotationPrice'],"spQuotationStatus"=>$row['spQuotationStatus'],'rfqCountry'=>$row['spQuotationCountry'],'countryname' => $country,'rfqState'=>$row['spQuotationState'],'statename' => $state,'rfqCity'=>$row['spQuotationCity'],'cityname' => $city);

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