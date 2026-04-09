

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

  /* $en = new _spquotation;
        $result = $en->getbuyerquotation($_POST['spProfiles_id']);*/
                       
        // echo $r->ta->sql; 
         $p = new _store_problemwithorder;

        // $result = $p->getbuyerproductdata($_SESSION['pid']);
                                              
            $result = $p->getbuyerproduct($_POST['spProfiles_id']);                                       
        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              

             /*print_r($row);*/
	                                                $sellerprofilid  = $row['sellerprofil_id'];

                                                   $idspOrder  = $row['order_id'];

                                                    $buyercomments  = $row['buyerproblem'];
                                                  
                                                   $ByuerProfileId  = $row['buyerprofil_id'];
                                                   
                                                    $txnid  = $row['txn_id'];

                                                    $or = new _order; 
                                        $result2 = $or->readOrderTxn($txnid, $ByuerProfileId);
                                                   //echo $or->ta->sql;
                                                    if ($result2) {

                                                    $row2 = mysqli_fetch_assoc($result2);
                                                     $productname = $row2["spPostingTitle"];

                                                        }

                                                    

                                                         
                                              $commresult  = $p->getsellercomment($row['id']);

                                                     //echo $p->tab->sql;
                                             if($commresult != false)
                                                                       {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                   // print_r($commrow);

                                                      $Sellercomment = $commrow["sellercomments"];
                                                      $Scommentid = $commrow["id"];
                                                        $commid = $commrow["comment_id"];


                                                                                                                               
                                                            
                                                             }
                                                           }


		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$probdata[] = array("id"=>$row['id'] ,"order_id"=>$idspOrder,"buyerprofil_id"=>$ByuerProfileId, "sellerprofil_id"=>$sellerprofilid, "txn_id"=>$txnid,"productname"=>$productname, "buyercomments"=>$buyercomments, "sellercomment"=>$Sellercomment);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;








		 $data = array("status" => 200, "message" => "success","data"=>$probdata);
	}else{

		$data = array("status" => 1, "message" => "No buyer problem with order record aavailable.");
	}	



echo json_encode($data);

?>