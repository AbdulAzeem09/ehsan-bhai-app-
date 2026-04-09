<?php
	include('../univ/baseurl.php');
	session_start();

		function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

$u = new _spuser;
  $p = new _spprofiles;

  $user  = $u->read($_REQUEST['uid']);

  $userdata = mysqli_fetch_array($user);
              //$rp = $p->readProfiles($_SESSION['uid']);
              //login with default profile
              $rp = $p->readDefaultProfile($_REQUEST['uid']);
              if ($rp != false) {
                $row = mysqli_fetch_array($rp);
                $updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

                $_SESSION['login_user'] = $userdata['spUserName'];
                $_SESSION['uid'] = $userdata['idspUser'];
                $_SESSION['spUserEmail'] = $userdata['spUserEmail'];
                $_SESSION['pid']      = $row['idspProfiles'];
                $_SESSION['myprofile']    = $row["spProfileName"];
                $_SESSION['MyProfileName']  = $row["spProfileName"];
                $_SESSION['ptname']     = $row["spProfileTypeName"];
                $_SESSION['ptpeicon']     = $row["spprofiletypeicon"];
                $_SESSION['ptid']       = $row["spProfileType_idspProfileType"];
                $_SESSION['isActive']     = 1;
                $c = new _order;
                $res = $c->read($_SESSION['pid']);
                if ($res != false) {
                  $_SESSION['cartcount'] = $res->num_rows;
                  //echo $_SESSION['cartcount'];
                } else {
                  $_SESSION['cartcount'] = 0;
                }
              }

if(!isset($_SESSION['pid'])){ 

		//echo "string";
  /*  $_SESSION['afterlogin']="cart/";
    include_once ("../authentication/check.php");*/
    
}else{

	//print_r($_REQUEST);
//print_r($_REQUEST);
	// FIRST CHEK IF USER COME FROM PAYPAL OR LINK
	if (isset($_REQUEST['txn_id']) && !empty($_REQUEST['txn_id'])) {
		// ===GET TOTAL POINT FROM THE DATABASE
		$po = new _spPoints;
		$po_result = $po->readpoint(3); 
		if ($po_result) {
			$po_row = mysqli_fetch_assoc($po_result);
			$sppoint = $po_row['percent']/100;
		}else{
			$sppoint = 0;
		}
		// ===GET AFTER EARN POIINT RETURN TO BUYER
		$po_result2 = $po->readpoint(4); 
		if ($po_result2) {
			$po_row2 = mysqli_fetch_assoc($po_result2);
			$retrnPoint = $po_row2['percent']/100;
		}else{
			$retrnPoint = 0;
		}
		// ===END

		//print_r($_REQUEST);
		if (isset($_REQUEST['item_name'])) {
			$item_name 	= $_REQUEST['item_name'];
		}else if(isset($_REQUEST['item_name1'])){
			$item_name 	= $_REQUEST['item_name1'];
		}else{
			$item_name = "";
		}
		
		$amount 		= $_REQUEST['mc_gross'];
		$currency 		= $_REQUEST['mc_currency']; 
		$payer_email 	= $_REQUEST['payer_email']; 
		$first_name 	= $_REQUEST['first_name'];
		$last_name 		= $_REQUEST['last_name'];

		if (isset($_REQUEST['residence_country'])) {
			$country 	= $_REQUEST['residence_country']; 
		}else{
			$country = 0;
		}
		
		$txn_id 		= $_REQUEST['txn_id'];
		$txn_type 		= $_REQUEST['txn_type']; 
		$payment_status = $_REQUEST['payer_status']; 
		$payment_type 	= $_REQUEST['payment_type']; 
		$payer_id 		= $_REQUEST['payer_id']; 
		$create_date 	= date('Y-m-d H:i:s');
		$payment_date 	= date('Y-m-d H:i:s');

		// first update ORDER NULL => 1 AND ALSO UPDATE TXN ID IN ORDER
		$_SESSION['cartcount'] 	= 0;
		$status 				= 0;
		$p 	= new _order;
		$pf = new _productposting;
        $cs = new _spproductsize;

                                                                        
		// ===GET SHIPPING ADDRESS
		$sh = new _spuser;
		$res_sh = $sh->readship($_SESSION['uid']);
		if ($res_sh) {
			$row_sh = mysqli_fetch_assoc($res_sh);
			$shipid = $row_sh['idspShipment'];
		}else{
			$shipid = 0;
		}
		// ===END

		//$result = $p->readCartItem($_SESSION['uid']);
		// READ CART ITEM BY PROFILE ID
		$result = $p->readCartitemPid($_SESSION['pid']);
		/*echo $p->ta->sql;*/
		if ($result != false){
			while($row = mysqli_fetch_assoc($result)){
                       
                      
	             $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_SESSION['pid'],'sellerProfileid' => $row['spSellerProfileId'],'message'=>'Product Sold  Successfully' );
	                 
	                 $pl->addenquiry($addmssage);
	            $u = new _spprofiles;

	                $resultsellbok = $u->read($row['spSellerProfileId']);	

				 if ($resultsellbok != false) {

                    


                        $soldbuy = mysqli_fetch_array($resultsellbok);


                     $selluserid = $soldbuy['spUser_idspUser'];   

                        /* print_r($bookedbuy);*/

                        $soldbyname = $soldbuy['spProfileName'];
                       
                        $solduseremail =	 $soldbuy['spProfileEmail'];

				 }	


				$prosold= $row['spPostingTitle'];
				$prosellQty= $row['spOrderQty'];
				$prosellammount= $row['sporderAmount'];
				
   $e = new _email;
        $e->sendproductsold($soldbyname,$solduseremail,$prosold,$prosellQty,$prosellammount);
/*print_r($row);*/


			/*	print_r($row);*/
		/*		echo"<pre>";
print_r($row);*/
				// CHEK EACH POST IS EVENT OR NOT [this is only tikt system in event]
				/*if($row['spCategories_idspCategory'] == 9){*/
					// get quantity of post
					$result_pf = $pf->read($row['idspPostings']);



		            /*echo $pf->ta->sql."<br>";*/
		            if($result_pf){
		            	$qtyPost = '';
                		/*while ($row2 = mysqli_fetch_assoc($result_pf)) {*/

                			$row2 = mysqli_fetch_assoc($result_pf);
                			if($qtyPost == ''){
		                        if($row2['sellType'] == 'Retail'){
		                            $qtyPost = $row2['retailQuantity'];
		                        }else if ($row2['sellType'] == 'Wholesaler') {
		                        	# code...
		                        	
		                        	 $qtyPost = $row2['supplyability'];
		                        }
		                    }

		                    $product[] = array("spPostingTitle" =>$row2['spPostingTitle'],"spPostingPrice" =>$row2['spPostingPrice'],"quantity" =>$row['spOrderQty']);
                	/*	}*/
                		$newqty = $qtyPost - $row['spOrderQty'];
                		// UPDATE NEW QUANTITY IN POSTING QTY
                		 if($row2['sellType'] == 'Retail'){

                		 	if($row['subcategory'] == "Clothing"){

                                                $csize= $cs->read($row['idspPostings']);
                                                $clothsize = mysqli_fetch_assoc($csize);

                                         
                                               foreach ($clothsize as $key1 => $value1) {

                                     if($row['size'] == $key1){


                                     	$sizeqty1 = $value1 - $row['spOrderQty'];
                                     	$data1 = array($key1 => $sizeqty1);


                                     	$cs->updatesize($data1,$row['idspPostings']);

                                     }
                                   


                                }





                		 	}else if ($row['subcategory'] == "Shoes") {

                		 		$allsize= $cs->read($row['idspPostings']);
                                $size = mysqli_fetch_assoc($allsize);



                                foreach ($size as $key => $value) {

                                     if($row['size'] == $key){


                                     	$sizeqty = $value - $row['spOrderQty'];
                                     	$data = array($key => $sizeqty);


                                     	$cs->updatesize($data,$row['idspPostings']);

                                     }
                                   


                                }

                               
                		 	}



                		$result3 = $pf->updateQty($row['spPostings_idspPostings'], $newqty);

                		$csize= $cs->read($spid);
                		     
                		      }else if ($row2['sellType'] == 'Wholesaler') {


                                   $result3 = $pf->updateQtywholesaler($row['spPostings_idspPostings'], $newqty);
                		      }
                		    /*  echo $pf->ta->sql."<br>";*/
		            }
				/*}*/
				// ======END
				// update txn id
				$p->updateTxn($row["idspOrder"], $txn_id, $shipid);
				// update order id chekout NULL => 0
				$p->transactionupdate($row['idspOrder'], $status);









			}

			$u = new _spprofiles;

	                $resultbok = $u->read($_SESSION['pid']);	
				 if ($resultbok != false) {

                        $bookedbuy = mysqli_fetch_array($resultbok);
                         
                        /* print_r($bookedbuy);*/

                        $bokkedbyname = $bookedbuy['spProfileName'];
                        $bokkedbyname = $bookedbuy['spProfileName'];
                        $bookeduseremail =	 $bookedbuy['spProfileEmail'];

				 }	

				//print_r($product);
				    $e = new _email;
        $e->sendproductplaced($bokkedbyname,$bookeduseremail);


		}
		// ===END

		$or = new _orderSuccess;
		// chek txn_id already exist or not
		$res = $or->chekTxnExist($txn_id);
		if ($res && $res->num_rows > 0) {
			// already added
			// nothing do any thing
		}else{
			// not added then add.
			$result2 = $or->createOrder($_SESSION['pid'],$_SESSION['uid'],$item_name, $amount, $currency, $payer_email, $first_name, $last_name, $country, $txn_id, $txn_type, $payment_status, $payment_type, $payer_id, $create_date, $payment_date);
			
			if ($result2) {
				// TXN_ID = $RESULT2
				// -----PERSONAL CODE
				// 
				$txnId 		= $txn_id;
				$pid 		= $_SESSION['pid'];
				$payGross 	= $amount;
				//$spPercntage = 0.05;
				$spPercntage = $sppoint;
				$payType 	= "Cr";
				// CHEK BALANCE IF PREVIOUS IS NULL THEN ADD 0
				// get balance of buyer
				$result5 = $or->readMyBalance($pid);
				if ($result5) {
					if ($result5->num_rows > 0) {
						$row5 = mysqli_fetch_assoc($result5);
						$balance = $row5['blance'] - $amount;
					}else{
						$balance = $amount;
					}
				}else{
					$balance = $amount;
				}
				// ============end

				// FIRSTLY ADD ON BUYER END
				$result3 = $or->createPayment($txnId, $pid, $payGross, $spPercntage, $payType, $balance);
				// THIS IS PERSONAL ACOUNT ADDING AMOUNT
				if ($result3) {
					// create sharepage personal acount information
					//$paAmt = 0.05 * $amount;
					$paAmt = $sppoint * $amount;
					$paType = "Dr";
					$result7 = $or->getLastPersnlBlnc();
					if ($result7) {
						if ($result7->num_rows > 0) {
							$row7 = mysqli_fetch_assoc($result7);
							$paBln = $row7['paBalance'] + $paAmt;
						}else{
							$paBln = $paAmt;
						}
					}else{
						$paBln = $paAmt;
					}

					$result6 = $or->createPersnlAcount($result3,$paAmt, $paType, $paBln);
					// -------------end

					// create spPoint [RETURN TO BUYER POINTS IN %]
					$pointpertge = $retrnPoint;
					//$pointpertge = 0.01;
					$pntAmt = $pointpertge * $paAmt;
					//$retnPont = $paAmt - $pntAmt;
					$result9 = $or->readlastBlnc($pid);
					
					if ($result9) {
						if ($result9->num_rows > 0) {
							$row9 = mysqli_fetch_assoc($result9);
							$newBlnc = $row9['pointBalance'] + $pntAmt;
						}else{
							$newBlnc = $pntAmt;
						}
					}else{
						$newBlnc = $pntAmt;
					}

					$result8 = $or->createPoint($result3, $pid, $pointpertge,$pntAmt, $newBlnc );
					// -----------end
				}
				
				// ------------------------
				// read all buyer information
				$result4 = $p->readTxnOrder($txn_id);
				if ($result4) {
					$payType = "Dr";
					$Newbalance = 0;
					while ( $row4 = mysqli_fetch_assoc($result4)) {
						$selProId = $row4['spSellerProfileId'];
						$Seprice = $row4['sporderAmount'];
						// ===========COMPLETE CALCULATION
						// formula y = P/100 * X
						// where p (percantage = 5= 0.05) => x (amount)
						//$per = 0.05 * $Seprice;
						$per = $sppoint * $Seprice;
						$newAmt = $Seprice - $per;
						// calculate balance
						$result5 = $or->readMyBalance($selProId);
						if ($result5) {
							if ($result5->num_rows > 0) {
								$row5 = mysqli_fetch_assoc($result5);
								$Newbalance = $row5['blance'] + $newAmt;
							}else{
								$Newbalance = $newAmt;
							}
						}else{
							$Newbalance = $newAmt;
						}
						// end
						$or->createPayment($txnId, $selProId, $newAmt, $spPercntage,$payType, $Newbalance );
					}
				}
				// NOW ADD ON SELLER END
			}
		}






	}else{
		$re = new _redirect;
		$redirctUrl= $BaseUrl."/cart";
		$re->redirect($redirctUrl);
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
   		<?php include('../component/f_links.php');?>
	    
	</head>
	<body onload="pageOnload('cart')"  class="bg_gray">
		<?php
			
			include_once("../header.php");
			
			
		?>
		<section class="landing_page">
            <div class="container">
            	<div class="row">
            		<div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <?php include('../component/left-landing.php');?>
                    </div>	
                    
                    <div class="col-md-10">
                    	<div class="cartbox">
                    		<div class="cart_header">
                    			<h1><i class="fa fa-shopping-cart"></i> Cart</h1>
                    			
                    		</div>
                    		<div class="cart_body text-center successBody">
                    			<i class="fa fa-check"></i>
                    			<h2>Payment has been Successful</h2>
                    			<p>Your Payment has been successfully Completed</p>
                    			<a href="<?php echo $BaseUrl;?>/store/dashboard" class="btn create_add no-radius">Go to dashboard</a>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
}
?>