

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






       $p = new _productposting;

                                                /*$result = $p->mydeactiveauctionbid($_SESSION['pid']);*/
                                                $result = $p->getexpiredproductbid($_POST['profile_id']);
                                   //echo $p->ta->sql; 
                                               
        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {



          	 $b = new _spauctionbid;

                                                        $result1 = $b->auctionhighestbid($row['idspPostings']);

                                                        // echo $b->ta->sql;

                                                        $row1 = mysqli_fetch_assoc($result1);



                                                        $result2 = $p->read($row['idspPostings']);
                                                         $row2 = mysqli_fetch_assoc($result2);

/*print_r($row2);*/

    if($row1['spProfiles_idspProfiles'] == $_POST['profile_id'] && $row1['status'] == 0 ){

                $dt = new DateTime($row['spPostingDate']);
                                                        $edt = new DateTime($row['spPostingExpDt']);


                           $spPostingDate = $dt->format('d M Y');    
                             $spPostingExpDt = $edt->format('d M Y');                                 


           /* print_r($row);*/
           

		$auctiondata = array("idspPostings"=>$row['idspPostings'],"spPostingTitle"=>$row['spPostingTitle'],"spPostingNotes"=>$row['spPostingNotes'],"specification"=>$row['specification'],"spPostingExpDt"=>$row['spPostingExpDt'],"spPostingDate"=>$row['spPostingDate'],"spPostingPrice"=>$row['spPostingPrice'],"spProfiles_idspProfiles"=>$row1['spProfiles_idspProfiles'],"spPostings_idspPostings"=>$row1['spPostings_idspPostings'],"auctionPrice"=>$row1['auctionPrice'],'lastBid'=>$row1['lastBid']);


  }
/* $data = array("status" => 200, "message" => "success","data"=>$auctiondata);
	}else{

		$data = array("status" => 1, "message" => "No Auction found");
	}	*/

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;

		$data = array("status" => 200, "message" => "success","data"=>$auctiondata);
	}else{

		$data = array("status" => 1, "message" => "No Auction found");
	}	



echo json_encode($data);

?>