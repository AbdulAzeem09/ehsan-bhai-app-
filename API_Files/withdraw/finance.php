

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






	
	if(!empty($_POST['user_id'])){
	
              

	    	 
                                        // GROUPS
                                        $et = new _spevent_transection;
                                        $t_eventtotalearn = 0;
                                        $result12 = $et->readeventtransection($_POST['user_id']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($result12){

                                            while ($row = mysqli_fetch_assoc($result12)) {


                                                $t_eventtotalearn += $row['payment_gross'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }


                                      $wt = new _spwithdraw;
                                       
                                        $result13 = $wt->withdrawreadevent($_POST['user_id']);

                                        //print_r($result12);



                                       // echo $wt->ta->sql;

                                        if($result13){

                                            while ($row2 = mysqli_fetch_assoc($result13)) {


                                                $withdraw_amount += $row2['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $total_balance = $t_eventtotalearn - $withdraw_amount;


                                           // GROUPS
                                        $gpt = new _spgroupevent_transection;
                                        $t_groupeventtotal = 0;
                                        $resgp = $gpt->readgroupeventtransection($_POST['user_id']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($resgp){

                                            while ($rowgp_ev = mysqli_fetch_assoc($resgp)) {


                                                $t_groupeventtotal += $rowgp_ev['payment_gross'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }


                                      $wt = new _spwithdraw;
                                       
                                        $resultgroup = $wt->withdrawreadgroupevent($_POST['user_id']);

                                        //print_r($result12);



                                       // echo $wt->ta->sql;

                                        if($resultgroup){

                                            while ($rowgrp = mysqli_fetch_assoc($resultgroup)) {


                                                $withdrawgroup_amount += $rowgrp['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $totalgroup_balance = $t_groupeventtotal - $withdrawgroup_amount;


                                        

                                        //print_r($total_balance);
                                       

                                       

                                          // store product

                                     
                                        $or = new _orderSuccess;
                                        $t_storetotalearn = 0;
                                        $result15 = $or->readuserallOrder($_POST['user_id']);

                                           // echo $or->ta->sql;

                                              if($result15){

                                        while ($row15 = mysqli_fetch_assoc($result15)){
                                             
                                           //  echo "<pre>";
                                          $amount  = $row15['amount'];

                                          //echo  $amount;

                                          $t_storetotalearn += $amount;

                                         


                                               }
                                           }

                             $wt = new _spwithdraw;
                                       
                             $result14 = $wt->withdrawreadstore($_POST['user_id']);


                                    //echo $wt->ta->sql;
                             if($result14){

                                     while ($row14 = mysqli_fetch_assoc($result14)) {


                                     $withdraw_storeamount += $row14['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_storebalance = $t_storetotalearn - $withdraw_storeamount;
                                        //print_r($total_balance);



                            // GROUPS private rgq
                            $tr = new _quotation_transection;
                            $t_privatetotalearn = 0;

                            $result17 = $tr->readprivatetrans($_POST['user_id']);

                                       
                                       // echo $tr->ta->sql;

                                    if($result17){

                                    while ($row17 = mysqli_fetch_assoc($result17)) {


                                    $t_privatetotalearn += $row17['payment_gross'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }

                                        
                                     // private rfq
                             $wt = new _spwithdraw;
                                       
                             $result18 = $wt->withdrawreadprivate($_POST['user_id']);


                                    //echo $wt->ta->sql;
                             if($result18){

                                     while ($row18 = mysqli_fetch_assoc($result18)) {


                                     $withdraw_privateamount += $row18['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_privatebalance = $t_privatetotalearn - $withdraw_privateamount;
                                        //print_r($total_balance);



                           // GROUPS public rgq
                            $rf = new _rfq_transection;
                            $t_publictotalearn = 0;

                            $result19 = $rf->readpublictransection($_POST['user_id']);

                                       
                                      // echo $rf->ta->sql;

                                    if($result19){

                                    while ($row19 = mysqli_fetch_assoc($result19)) {


                                    $t_publictotalearn += $row19['payment_gross'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }



                                     $wt = new _spwithdraw;
                                       
                             $result20 = $wt->withdrawreadpublic($_POST['user_id']);


                                    //echo $wt->ta->sql;
                             if($result20){

                                     while ($row20 = mysqli_fetch_assoc($result20)) {


                                     $withdraw_publicamount += $row20['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_publicbalance = $t_publictotalearn - $withdraw_publicamount;




                                       $finance = new _financereferral;
                            $t_referalearn = 0;

                            $result21 = $finance->readreferral($_POST['user_id']);

                                       
                                      //echo $finance->ta->sql;

                                    if($result21){

                                    while ($row21 = mysqli_fetch_assoc($result21)) {


                                    $t_referalearn += $row21['amount'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }

                               // print_r($t_referalearn);


                               $wt = new _spwithdraw;
                                       
                             $result22 = $wt->withdrawreadreferral($_POST['user_id']);


                                    //echo $wt->ta->sql;
                             if($result22){

                                     while ($row22 = mysqli_fetch_assoc($result22)) {


                                     $withdraw_referralamount += $row22['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_referralbalance = $t_referalearn - $withdraw_referralamount;


		 $biddata = array("event_balance"=>$total_balance,"store_balance"=>$total_storebalance,"public_rfq_balance"=>$total_publicbalance,"private_rfq_balance"=>$total_privatebalance,"freelance_balance"=>0,"groupevent_balance"=>$totalgroup_balance,"referral_balance"=>$total_referralbalance,"user_id"=>$_POST['user_id']); 
     


		 $data = array("status" => 200, "message" => "success","data"=>$biddata);
	}else{

		$data = array("status" => 1, "message" => "User Not found");
	}	



echo json_encode($data);

?>