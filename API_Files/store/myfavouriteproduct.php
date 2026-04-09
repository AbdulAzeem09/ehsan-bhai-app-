

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");





/*Array
(
    [spPostings_idspPostings] => 30
    [spProfiles_idspProfiles] => 510
    [auctionPrice] => 45
    [lastBid] => 42
)
 */
/* [spOrderAdid_] => 40
    [spByuerProfileId] => 521
    [spBuyeruserId] => 384
    [size] => 
    [sporderAmount] => 123
    [spSellerProfileId] => 510
    [spOrderQty] => 1
	print_r($_POST);*/
	//$result = $p-> priviousorder($_POST["spOrderAdid_"],$_POST["spByuerProfileId"]);
	

    $p = new _productposting;
	$result_fav = $p->myallfavrouiteproduct(1,$_POST['profile_id']);
	//echo $po->ta->sql;
	
	if($result_fav != false){
	    while($row = mysqli_fetch_assoc($result_fav)){ 
              

                $auctionStatus = $row['auctionStatus'];
                 $selltype = $row['sellType'];
  
                if($selltype == "Auction"){
                   
                   $Quantity = $row['auctionQuantity'];
                
                }elseif($selltype == "Retail"){

                     $Quantity = $row['retailQuantity'];
                }elseif($selltype == "Wholesaler"){

                     $Quantity = $row['supplyability'];
                }

                 if($selltype == "Auction"){
                   
                   $ItemCondition = $row['auctionStatus'];
                
                }elseif($selltype == "Retail"){

                     $ItemCondition = $row['retailStatus'];
                }/*elseif($selltype == "Wholesaler"){

                     $ItemCondition = $row['supplyability'];
                }*/
                

                $price = $row['spPostingPrice'];

                if($selltype == "Auction"){
                   
                   $ExpiryDate = $row['spPostingExpDt'];
                
                }elseif($selltype == "Retail"){

                   $ExpiryDate = $row['spPostingExpDt'];
                }


              
               $minorderqty = $row['minorderqty'];
               $supplyability = $row['supplyability'];
               $paymentterm = $row['paymentterm'];
               

       
     $pic = new _productpic;
                                              $result = $pic->read($row['idspPostings']);
                                           $pict=array();
                                          if ($result != false) {
                                              while ($rp = mysqli_fetch_assoc($result)) {

                                             /* $rp = mysqli_fetch_assoc($result);*/

                                               // print_r($rp);
                                                  $pict[] = array(($rp['spPostingPic']));
                                              }
                                          } else{
                                              /*$pict = " ";*/
                                          }

                                           $r = new _spstorereview_rating;

                                  $sumres = $r->readstorerating($row['idspPostings']);
                                                          //    echo $r->ta->sql;
                                                                if($sumres != false){
                                                                    while($sumrow = mysqli_fetch_assoc($sumres)){

                                                                      $sumrating += $sumrow['rating'];
                                                                       $ratarr[] =  $sumrow['rating'];

                                                                     }  



                                                              $countrate = count($ratarr);

                                                              $averagerate = $sumrating / $countrate;

                                                              $totalrate  = round($averagerate, 1);
                                                            }

             // print_r($row_bid);
	    	/* $p = new _spprofiles;
             $NameOfProfile = $p->getProfileName($row_bid['spProfiles_idspProfiles']);*/
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		$productdata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "spPostingPrice"=> $row['spPostingPrice'],
                                      "sellType"=> $row['sellType'],
                                     
                                      "quantity" => $Quantity,
                                      "ItemCondition" => $ItemCondition,
                                      
                                      "paymentterm" => $row['paymentterm'],

                                      "auctionStatus" => $row['auctionStatus'],
                                      "auctionQuantity" => $row['auctionQuantity'],
                                      "subcategory" => $row['subcategory'],
                                      "quantitytype" => $row['quantitytype'],
                                      "supplyability" => $row['supplyability'],
                                      "industryType" => $row['industryType'],
                                      "retailStatus" => $row['retailStatus'],
                                      "retailQuantity" => $row['retailQuantity'],
                                      "retailSpecDiscount" => $row['retailSpecDiscount'],
                                      "retailDiscount" => $row['retailDiscount'],


                                      "minorderqty" => $row['minorderqty'],
                                      "description" => $row['spPostingNotes'],
                                       "specification" => $row['specification'],
                                       "spProfiles_idspProfiles" => $row['spProfiles_idspProfiles'],
                                       "rating" => $totalrate,
                                      "picture"=> $pict
                                    );


		
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$productdata);
	}else{

		$data = array("status" => 1, "message" => "No product found");
	}	



echo json_encode($data);

?>