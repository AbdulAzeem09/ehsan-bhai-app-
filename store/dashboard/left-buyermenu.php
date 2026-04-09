<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">  
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<style>
 .left_filter1 h1 a.buyerboard {
    color: black!important;
    background-color: orange!important;
    padding: 2px 8px;
    border-radius: 2px;
}
</style>


<div class="left_grid left_group_gray">
    <div class="left_store">
       <div class="left_filter1" style="border: none;">

           <h1><a href="<?php echo $BaseUrl.'/store/storeindex.php?folder=home'; ?>"><i class="fa fa-arrow-left fs-0.5"></i> Back To Home</a></h1>
		   
		   <?php	if($_GET['msg'] == "notverified"){ ?>
           
         <!-- <h1><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?> "  style="pointer-events: none" >Seller Dashboard</a></h1>-->

 <?php   }  else{ ?>
 
  <h1><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?> "   >Seller Dashboard</a></h1>
 
 <?php } ?>
           <h1><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="buyerboard">Buyer Dashboard</a></h1>
           <div class="dashbids">
		   
		   <?php 
		   $idsprfq = isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0;
		    $st= new _spuser;
									$st1=$st->readdatabybuyerid($_SESSION['uid']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
		   	$n = new _notification;	
		$to_id=$_SESSION['pid'];
		$module='store';
		$by_seller_or_buyer=1;
		$resnoti = $n->readNotification($to_id,$module,$by_seller_or_buyer);

		//print_r($resnoti);die('=================');
		//var_dump($resnoti);
		if($account_status!=1){
			
		if($resnoti!=false){
		$noti= $resnoti->num_rows;
		}else{
			$noti=0;
		}}else{
		$noti=0;
		}
		   ?>
		   

		     <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_buyer_notification.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_buyer_notification.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Notification &nbsp;<span style="color:#0f8f46; font-size:18px;"><?php echo '('.$noti.')';?></span></a></li>

               <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myallproduct_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/storereturn_item.php?orderid=".$cid)?'activepage' : '';?> " ><a href="<?php echo $BaseUrl.'/store/dashboard/myallproduct_orderhistory.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> My Order History</a></li>
			   
 

               <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Auction Bid</a></li>

               <!--    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Active Bid</a></li> -->




             <!--    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/unpaidbid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/unpaidbid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Unpaid Bid</a></li>

                <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/paidbid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/paidbid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Paid Bid</a></li>
          
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/track.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/track.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Track Order11</a></li>-->

            <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_send_enguiry.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_send_enguiry.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Enquiry <span style="color:#0f8f46; font-size:18px;"><?php $en = new _sppostenquiry;
                                                $result = $en->getbuyerEnquery($_SESSION['pid']);
												if($account_status!=1){
                                                if ($result) {
													echo '('.$result->num_rows.')';
												}
												}
												else 
												{
												echo '(0)';
												}?></span></a>
			<?php
			
			?>
			</li>




            <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotation_list.php?idspRfq=".$idsprfq)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> RFQ 
			<span style="color:#0f8f46; font-size:18px;"><?php 
			                                  $r = new _rfq;
                                             $result = $r->readsubmittedRfqquote($_SESSION['pid']);
											 $rfq=0;
											 if($account_status!=1){
											 if($result)
											 {
												 $rfq=$result->num_rows;
											 }}
											 else 
												{
												echo '(0)';
												}?></span></a>
			<?php
			
			?>
			
			</a></li>

                <!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotation_list.php?idspRfq=".$_GET['idspRfq'])?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Public RFQ</a></li>
                   
                 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/private_rfq.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/private_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Private RFQ</a></li> -->



                 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-favourite.php")?'activepage' : '';?>"><a  href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Favorite Products</a></li>

               <!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-returningitem.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my-returningitem.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Returning Items</a></li>

                 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-problemwithorder.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my-problemwithorder.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Problem With Order</a></li>-->


                 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/flag-post.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/flag-post.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Flag Product <span style="color:#0f8f46; font-size:18px;"><?php  
				                                    $objflag = new _flagpost;
		  
//print_r($_SESSION);

//echo 
		  $resultflaf=$objflag->readflag3($_SESSION['pid'] ,1);
		 
		  //var_dump($resultflaf);
		  // die("-------------------");
				   if($account_status!=1){
					  // die("-------------------1111");
		  if($resultflaf!=false){
			  //die("-------------------");
						echo '('.$resultflaf->num_rows.')';
												}
				   
					else 
					{
					 //die("-------------------");	
					echo '(0)';
				   }}?></span></a>
			                     
				 
				        <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/rfq_flag.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/rfq_flag.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> RFQ Flag <span style="color:#0f8f46; font-size:18px;"><?php  $objflag = new _flagpost;
		  
//print_r($_SESSION);

//echo 
		  $resultflaf=$objflag->readflagrfq($_SESSION['pid'] ,1);
		 
		 // var_dump($resultflaf);
		 		   //die("-------------------");
				   if($account_status!=1){
		  if($resultflaf!=false){ 
		  echo '('.$resultflaf->num_rows.')';
				   }}
		  else{
			  echo '(' . 0 .')';
		  }
		  
		  ?></span></a></li>
		   <?php
		  $objflag = new _spquotation;
		  
//print_r($_SESSION);

//echo 
$pid=$_SESSION['pid'];
		  $resultflaf=$objflag->readQuote1($pid);
		  $countQuote=$resultflaf->num_rows;
		  
		  ?>
		  
		   
		  
		  
		  
		  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/quoteHistory.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/quoteHistory.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Quote History <span style="color:#0f8f46; font-size:18px;"> (<?php 
		  if($account_status!=1){
			  //die('==');
if($countQuote!=""){
	echo $countQuote;
		  } else{
	echo 0;
		  }}

		  ?>)</span>
		  </a></li>
		  
		   <!-- <li class=""><a href="<?php echo $BaseUrl.'/store/dashboard/testAdd.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Test <span style="color:#0f8f46; font-size:18px;"</span>
		  </a></li>-->
		  <!---<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/POS_transations.php?action=category")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/POS_transations.php?action=category'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Purchase History</a></li>
		  
		  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/mam_transactions.php?action=category")?'activepage' : '';?> <?php if($_GET['select1']){ echo 'activepage';}  ?>"><a href="<?php echo $BaseUrl.'/store/dashboard/mam_transactions.php?action=category'; ?>" style="font-size: 15px;"><i class="fa fa-caret-right" aria-hidden="true"></i> Subscriptions</a></li>  --->

             </div>

            <!-- <h1><a href="<?php //echo $BaseUrl.'/store/dashboard/faq.php'; ?>">FAQ</a></h1>-->
			<!--
			<li class=""><a href="<?php echo $BaseUrl.'/store/dashboard/testAdd1.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Add <span style="color:#0f8f46; font-size:18px;"</span>
		  </a></li>-->
             <div>


             </div>


         </div>
     </div>
 </div>

 
