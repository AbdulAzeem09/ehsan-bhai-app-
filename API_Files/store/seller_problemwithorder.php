

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $p = new _store_problemwithorder;
                                              
  $result = $p->getMysellerproduct($_POST['spProfiles_id']);   


        if ($result) {
              $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              

             /*print_r($row);*/
	                                            $buyerprofilid  = $row['buyerprofil_id'];

                                                    $sellerprofilid  = $row['sellerprofil_id'];

                                                     
                                                         $buyercomments  = $row['buyerproblem'];
                                                      
                                                         $txnid  = $row['txn_id'];

                                                          $idspOrder  = $row['order_id'];

                                            $or = new _order; 
                                        $result2 = $or->readOrderTxn($txnid, $buyerprofilid);
                                                //   echo $or->ta->sql;
                                                    if ($result2) {

                                                    $row2 = mysqli_fetch_assoc($result2);
                                                     $productname = $row2["spPostingTitle"];

                                                        }



                                                    $sp = new _spprofiles;

                                                    $spbuyresult  = $sp->read($buyerprofilid);
                                               if($spbuyresult != false)
                                                                       {
                                                      $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                       $buyername = $buyrow["spProfileName"];
   
                                                                    
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

		  $probdata[] = array("id"=>$row['id'] ,"order_id"=>$idspOrder,"buyerprofil_id"=>$buyerprofilid, "sellerprofil_id"=>$sellerprofilid, "txn_id"=>$txnid, "buyername"=>$buyername, "productname"=>$productname, "buyercomments"=>$buyercomments, "sellercomment"=>$Sellercomment);

	/*	 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); */
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;








		 $data = array("status" => 200, "message" => "success","data"=>$probdata);
	}else{

		$data = array("status" => 1, "message" => "No seller problem with order record aavailable.");
	}	



echo json_encode($data);

?>