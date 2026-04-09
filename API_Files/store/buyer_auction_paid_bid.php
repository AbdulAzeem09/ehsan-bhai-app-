

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






  $pet = new _spauction_transection;
                                              $p = new _productposting;

                                                /*$result = $p->mydeactiveauctionbid($_SESSION['pid']);*/
                                                $result = $pet->mybooking($_POST['profile_id']);
                                   //echo $p->ta->sql; 
                                               
        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
                 $result2 = $p->read($row['postid']);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        /*print_r($row2);*/
                                                        $dt = new DateTime($row['payment_date']);                               


            /*print_r($row);*/
           

		$auctiondata[] = array("idspPostings"=>$row2['idspPostings'],"spPostingTitle"=>$row2['spPostingTitle'],"payment_gross"=>$row['payment_gross'],"txn_id"=>$row['txn_id'],"payment_date"=>$row['payment_date']);

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