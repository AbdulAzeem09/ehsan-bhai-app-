<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $profile_id = $_POST['profile_id'];
    




                $p = new _productposting;
            $rd = $p->read($product_id);
           // echo $p->ta->sql;


            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);
                

                /*print_r($row);*/

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
               

       

                 $spid = $row['idspPostings'];


                $myuserid   = $row['spUser_idspUser'];

                //print_r($myuserid);

                $postingexpire = $row['spPostingExpDt'];
                $PostTitle  = $row['spPostingTitle'];
                $price      = $row['spPostingPrice']; 
                $catid      = $row["idspCategory"];
                $wholesaleflag = $row["spPostingsFlag"];
                $button     = $row["spCategoriesButton"];
                $comment    = $row["sppostingscommentstatus"];
                $Country    = $row['spPostingsCountry'];
                $City       = $row['spPostingsCity'];
                $dt         = new DateTime($row['spPostingDate']);
                $desc       = $row['spPostingNotes'];
                $specification       = $row['specification'];
                
                $SellName   = $row['spProfileName'];
                $SellEmail  = $row['spProfileEmail'];
                $SellPhone  = $row['spProfilePhone'];
                $SellAdres  = $row['spprofilesAddress'];
                $SellCity   = $row['spProfilesCity'];
                $SellCounty = $row['spProfilesCountry'];
                $SellId     = $row['spProfiles_idspProfiles'];

                $category     = $row['subcategory'];

                  



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


                                                               $st = new _store_favorites;
                                    $res_ev = $st->chekFavourite($product_id, $profile_id, $user_id);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                   // echo $ev->ta->sql; 
  $c = new _spauctionbid;
                                         $higestbid = $c->auctionhighestbid($product_id);

  if(!empty($higestbid)){
    //echo "here";
    $row_bid = mysqli_fetch_assoc($higestbid);
   
   /*print_r($row_bid);*/
    $current_bid = $row_bid['auctionPrice'];
    /*$id = $c->create($biddata);*/
       // echo $p->tad->sql;

    }
                                    

                                    if($res_ev != false){ 

                                             $favourite = 1;
                                    }else{
                                            
                                            $favourite = 0;
                                    }

                                    /*print_r($row);*/

                                             $productdata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "spPostingPrice"=> $row['spPostingPrice'],
                                      "sellType"=> $row['sellType'],
                                      "favourite"=> $favourite,
                                      "quantity" => $Quantity,
                                      "ItemCondition" => $ItemCondition,
                                      "current_bid" => $current_bid,
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

                   $data = array("status" => 200, "message" => "success","data"=>$productdata);

            }else{

                  $data = array("status" => 1, "message" => "No Record Found.");

                  }
            


   echo json_encode($data);
	
?>  