<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

  /* $en = new _spquotation;
        $result = $en->getbuyerquotation($_POST['spProfiles_id']);*/
                       
        // echo $r->ta->sql; 
  $p = new _comment;

        // $result = $p->getbuyerproductdata($_SESSION['pid']);
       $result = $p->read($_POST['idspPostings']);
/*                            $result = $c->read($_POST['idspPostings']);
*/


                          //echo $timeline->ta->sql;
                          if($result != false){

                            while($row = mysqli_fetch_assoc($result)){

                              $pict = ($row['spProfilePic']);

                            //  $num_rows = mysqli_num_rows($result);

                               $count_comment = $result->num_rows;


                             // print_r($row);

                          
                             /*  $profilename = $row["spProfileName"];
                               $comment = $row["comment"];
                               $picture = $row["spProfilePic"];
                                $date = $row["commentdate"];
                                $cid=$row["idComment"];*/


		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$comdata[] = array("count_comment"=> $count_comment,"spPostings_idspPostings"=>$row['spPostings_idspPostings'] ,"spProfiles_idspProfiles"=>$row['spProfiles_idspProfiles'],"idComment"=>$row['idComment'], "userid"=>$row['userid'], "comment"=>$row['comment'],"idspProfiles"=>$row['idspProfiles'], "spProfileName"=>$row['spProfileName'], "spProfileEmail"=>$row['spProfileEmail'], "spProfilePhone"=>$row['spProfilePhone'], "spUser_idspUser"=>$row['spUser_idspUser'], "spProfileType_idspProfileType"=>$row['spProfileType_idspProfileType'], "spProfileAbout"=>$row['spProfileAbout'], "spProfilesDefault"=>$row['spProfilesDefault'], "spMembership_idspMembership"=>$row['spMembership_idspMembership'], "spProfileSubscriptionDate"=>$row['spProfileSubscriptionDate'], "spProfilesRenewalDate"=>$row['spProfilesRenewalDate'], "spDynamicWholesell"=>$row['spDynamicWholesell'], "spProfilesCity"=>$row['spProfilesCity'], "spProfilesState"=>$row['spProfilesState'], "spProfilesCountry"=>$row['spProfilesCountry'], "spProfilesDob"=>$row['spProfilesDob'], "spProfilesDob"=>$row['spProfilesDob'], "spAccountStatus"=>$row['spAccountStatus'], "spProfilesAboutStore"=>$row['spProfilesAboutStore'], "spprofilesLanguage"=>$row['spprofilesLanguage'], "spprofilesLocation"=>$row['spprofilesLocation'], "spprofilesAddress"=>$row['spprofilesAddress'], "spprofilesPublished"=>$row['spprofilesPublished'], "spProfileVerification"=>$row['spProfileVerification'], "spProfileCode"=>$row['spProfileCode'], "is_active"=>$row['is_active'], "spProfilePostalCode"=>$row['spProfilePostalCode'], "spProfileCntryCode"=>$row['spProfileCntryCode'], "relationship_status"=>$row['relationship_status'], "phone_status"=>$row['phone_status'], "email_status"=>$row['email_status'], "address"=>$row['address'], "spUserzipcode"=>$row['spUserzipcode'], "latitude"=>$row['latitude'], "longitude"=>$row['longitude'], "profilepicture"=> $pict);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;


		 $data = array("status" => 200, "message" => "success","data"=>$comdata);
	}else{

		$data = array("status" => 1, "message" => "No buyer problem with order record aavailable.");
	}	



echo json_encode($data);

?>