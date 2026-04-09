<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
     $sf  = new _realstateposting;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);
 $type = "Sell";
                                  $res = $sf->myDraftJob(3,$profile_id);

                                       // echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                              /* print_r($row);*/
                           $pic = new _realstatepic;
                           $res2 = $pic->read($row['idspPostings']);
                           $pict=array();
                        if ($res2 != false) {
                                             
                                                  # code...

                                                $rp = mysqli_fetch_assoc($res2);

                                                $pic2 = $rp['spPostingPic'];

                                              $pict =  ($pic2);
                                              
                                              
                                            }else{

                                              $pict = "";

                                            }



                                             


                     $biddata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                       "spPostListing"=>$row["spPostListing"],
                                       "spCategories_idspCategory"=>$row["spCategories_idspCategory"],
                                       "spPostingVisibility"=>$row["spPostingVisibility"],
                                       "spProfiles_idspProfiles"=>$row["spProfiles_idspProfiles"],
                                       "spPostingAlbum_idspPostingAlbum"=>$row["spPostingAlbum_idspPostingAlbum"],
                                       "spPostingTitle"=>$row["spPostingTitle"],
                                       "spPostingsCountry"=>$row["spPostingsCountry"],
                                       "spPostingsState"=>$row["spPostingsState"],
                                       "spPostingsCity"=>$row["spPostingsCity"],
                                       "spRoomRent"=>$row["spRoomRent"],
                                       "spPostingPropertyType"=>$row["spPostingPropertyType"],
                                       "spPostingSqurefoot"=>$row["spPostingSqurefoot"],
                                       "spPostingBedroom"=>$row["spPostingBedroom"],
                                       "spPostingBathroom"=>$row["spPostingBathroom"],
                                       "spPostFurnish"=>$row["spPostFurnish"],
                                       "spPostAvailFrom"=>$row["spPostAvailFrom"],
                                        "spPostAvailTo"=>$row["spPostAvailTo"],
                                       "spPostDepositAmt"=>$row["spPostDepositAmt"],
                                       "spPostRentalMonth"=>$row["spPostRentalMonth"],
                                       "spPostRentalWeek"=>$row["spPostRentalWeek"],
                                       "spPostingServicChrg"=>$row["spPostingServicChrg"],
                                       "spPostingCleaningChrg"=>$row["spPostingCleaningChrg"],
                                       "spPostingHouseStyle"=>$row["spPostingHouseStyle"],
                                       "spPostingAddress"=>$row["spPostingAddress"],
                                       "spPostingNotes"=>$row["spPostingNotes"],
                                       "spPostDog"=>$row["spPostDog"],
                                       "spPostCat"=>$row["spPostCat"],
                                       "spPostSmoke"=>$row["spPostSmoke"],
                                       "spPostStainless"=>$row["spPostStainless"],
                                       "spPostCentralAir"=>$row["spPostCentralAir"],
                                       "spPostLotsCloset"=>$row["spPostLotsCloset"],
                                       "spPostOpenFloor"=>$row["spPostOpenFloor"],
                                       "spPostBuildAment"=>$row["spPostBuildAment"],
                                       "spPostWasher"=>$row["spPostWasher"],
                                       "spPostSpacious"=>$row["spPostSpacious"],
                                       "spPostGargParking"=>$row["spPostGargParking"],
                                       "spPostJettedTub"=>$row["spPostJettedTub"],
                                       "spPostSwimPool"=>$row["spPostSwimPool"],
                                       "spPostBedType"=>$row["spPostBedType"],
                                       "spPostFirePlace"=>$row["spPostFirePlace"],
                                       "spPostBalcony"=>$row["spPostBalcony"],
                                       "spPostFenced"=>$row["spPostFenced"],
                                       "spPostFitnesArea"=>$row["spPostFitnesArea"],
                                       "spPostStorage"=>$row["spPostStorage"],
                                       "spPostClosePublic"=>$row["spPostClosePublic"],
                                       "spPostHeat"=>$row["spPostHeat"],
                                       "spPostWater"=>$row["spPostWater"],
                                      "spPostElect"=>$row["spPostElect"],
                                      "spPostCableTv"=>$row["spPostCableTv"],
                                      "spPostInternet"=>$row["spPostInternet"],
                                      "spPostSecurtyCam"=>$row["spPostSecurtyCam"],
                                      "spPostCntrlAces"=>$row["spPostCntrlAces"],
                                      "spPostFulyEquipedGym"=>$row["spPostFulyEquipedGym"],
                                      "spPostConcierge"=>$row["spPostConcierge"],
                                      "spPostElevator"=>$row["spPostElevator"],
                                      "spPostOnsiteStore"=>$row["spPostOnsiteStore"],
                                      "spPostParking"=>$row["spPostParking"],
                                      "spPostingPropertyType"=>$row["spPostingPropertyType"],
                                       "spPostingPropStatus"=>$row["spPostingPropStatus"],
                                       "spPostingPostalcode"=>$row["spPostingPostalcode"],
                                       "spPostingYearBuilt"=>$row["spPostingYearBuilt"],
                                       "spPostingBedroom"=>$row["spPostingBedroom"],
                                       "spPostingBathroom"=>$row["spPostingBathroom"],
                                       "spPostBasement"=>$row["spPostBasement"],
                                       "spPostingPrice"=>$row["spPostingPrice"],
                                        "spPostingSqurefoot"=>$row["spPostingSqurefoot"],
                                       "spPostUnitNum"=>$row["spPostUnitNum"],
                                       "spPostTaxAmt"=>$row["spPostTaxAmt"],
                                       "spPostTaxYear"=>$row["spPostTaxYear"],
                                       "spPostListId"=>$row["spPostListId"],
                                       "spPostingHouseStyle"=>$row["spPostingHouseStyle"],
                                       "spPostingAddress"=>$row["spPostingAddress"],
                                       "spPostingNotes"=>$row["spPostingNotes"],
                                       "spPostingOpenHouse"=>$row["spPostingOpenHouse"],
                                       "spPostingSoldBy"=>$row["spPostingSoldBy"],
                                       "spPostingkeyword"=>$row["spPostingkeyword"],
                                       "openHouseDayone"=>$row["openHouseDayone"],
                                       "openHouseDayoneStrtTime"=>$row["openHouseDayoneStrtTime"],
                                       "openHouseDayoneEndTime"=>$row["openHouseDayoneEndTime"],
                                       "openHouseDayTwo"=>$row["openHouseDayTwo"],
                                       "openHouseDayTwoStrtTime"=>$row["openHouseDayTwoStrtTime"],
                                       "openHouseDayTwoEndTime"=>$row["openHouseDayTwoEndTime"]
                                       /*"pic"=>$pict*/


                                                                      );

}




                          

          $data = array("status" => 200, "message" => "success","data"=>$biddata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  