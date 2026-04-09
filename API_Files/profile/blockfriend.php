

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




$r  = new _spprofilehasprofile;
    $pv = new _postingview;
    $f  = new _spprofilefeature;
    $res = $f->getmyblockuser($_POST['profile_id']);
// echo $f->ta->sql;
    if($res != false){
        
        while($rows = mysqli_fetch_assoc($res)){

            //print_r($rows);
            $p = new _spprofiles;
            $blockUser = $rows["idspProfile_to"];

            $result = $p->read($blockUser);
            //echo $p->ta->sql;

            if($result != false){
                $row = mysqli_fetch_assoc($result);

                  $profilepic = ($row['spProfilePic']);


                $totalFrnd = $r->countTotalFrnd($row['idspProfiles']);
                //get friend store
                $result3 = $pv->singlefriendstore($blockUser);
                if($result3 != false){
                    if(mysqli_num_rows($result3) > 0){
                        $storeshow = mysqli_num_rows($result3);
                    }else{
                        $storeshow = 0;
                    }
                }else{
                    $storeshow = 0;
                }
               
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$blockdata[] = array("idspfeature"=>$rows['idspfeature'],"idspProfile_by"=>$rows['idspProfile_by'],"idspProfile_to"=>$rows['idspProfile_to'],"spfeature_block"=>$rows['spfeature_block'],"spfeature_des"=>$rows['spfeature_des'],"spfeature_favourite"=>$rows['spfeature_favourite'],"spProfileName"=>$row["spProfileName"],"spProfileTypeName"=>$row["spProfileTypeName"],"spProfilePic"=>$profilepic);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
   }

		 $data = array("status" => 200, "message" => "success","data"=>$blockdata);
	}else{

		$data = array("status" => 1, "message" => "Blocked user not available.");
	}	



echo json_encode($data);

?>