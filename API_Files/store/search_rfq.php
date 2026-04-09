

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






    $p = new _rfq;
	$category = $_POST['rfqCategory'];
                                 $title = $_POST['rfqTitle'];
if($category == "all"){
$result = $p->search_rfqtitle(1, $title);
}else{
 $result = $p->search_title_cat($category, $title);
}
                           
	/*echo $po->ta->sql;*/
	
	if($result != false){
	    while($row = mysqli_fetch_assoc($result)){ 
              

             /*print_r($row);*/
	    	 $pr = new _spprofiles;
             $NameOfProfile = $pr->getProfileName($row['spProfile_idspProfiles']);

                                                 $rc = new _country; 
                                                        $result_cntry = $rc->readCountryName($row['rfqCountry']);
                                                        if ($result_cntry) {
                                                            $row4 = mysqli_fetch_assoc($result_cntry);
                                                            $country = $row4['country_title'];
                                                        }

                                                         $st = new _state;
                                                        $result_stat = $st->readStateName($row['rfqState']);
                                                        if ($result_stat) {
                                                            $row6 = mysqli_fetch_assoc($result_stat);
                                                            $state = $stateName = $row6['state_title'];
                                                        }


                                                          $rcty = new _city;
                                                        $result_cty = $rcty->readCityName($row['rfqCity']);
                                                        if ($result_cty) {
                                                            $row5 = mysqli_fetch_assoc($result_cty);
                                                            $city = $cityName = $row5['city_title'];
                                                        }
                                                       
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$rfqdata[] = array("idspRfq"=>$row['idspRfq'],"rfqTitle"=>$row['rfqTitle'],"rfqCategory"=>$row['rfqCategory'],"rfqQty"=>$row['rfqQty'],"rfqDelivered"=>$row['rfqDelivered'],"rfqDesc"=>$row['rfqDesc'],"spProfiles_idspProfiles"=>$row['spProfile_idspProfiles'],"NameOfProfile"=>$NameOfProfile,"rfqDate"=>$row['rfqDate'],"spQuotereached"=>$row['spQuotereached'],"rfqprice"=>$row['rfqprice'],"rfqImage"=>$BaseUrl.'/upload/store/rfq/'.$row['rfqImage'],'rfqCountry'=>$row['rfqCountry'],'countryname' => $country,'rfqState'=>$row['rfqState'],'statename' => $state,'rfqCity'=>$row['rfqCity'],'cityname' => $city);

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