

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






                             
        $r = new _rfq;
          $result = $r->readRfqquotedetail($_POST['idspRfqComment']);
                                             
                                             

                                           /* echo $r->tcd->sql; */
                              if ($result) {
                                  $i = 1;
                       while ($row = mysqli_fetch_assoc($result)) {


             /*print_r($row);*/
	      $pt = new _spprofiles;
                                             
                           $result_profile = $pt->read($row['spProfiles_idspProfiles']);
                          if ($result_profile) {
                                 $rowpro = mysqli_fetch_assoc($result_profile);
                                 $NameOfProfile = $rowpro['spProfileName'];
                                                        
                                              }


                                 $p = new _spbusiness_profile;

                               $rpvt = $p->read($row['spProfiles_idspProfiles']);
                                //echo $p->ta->sql;

   
                                    if ($rpvt != false){
                                 $rowB = mysqli_fetch_assoc($rpvt);
                                 

                                   $bussinessName = $rowB['spDynamicWholesell'];

                               }




                                             $image = $BaseUrl.'/upload/store/rfq/'.$row['rfqcImage'];

                                               $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                             }
     
                        
                                                       
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$rfqdata[] = array("idspRfq"=>$row['idspRfq'],"rfqDesc"=>$row['rfqDesc'],"ProfileName"=>$NameOfProfile,"bussinessName"=>$bussinessName,"rfqPrice"=>$row['rfqPrice'],"spProfiles_idspProfiles"=>$row['rfq_spProfiles_idspProfiles'],"NameOfProfile"=>$NameOfProfile,"image"=>$images,"rfqcMaxOrder"=>$row['rfqcMaxOrder'],"rfqcMinOrder"=>$row['rfqcMinOrder'],"rfqcvideoLink"=>$row['rfqcvideoLink'],"idspRfqComment"=>$row['idspRfqComment']);

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