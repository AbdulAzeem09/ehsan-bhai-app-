<?php
	/*error_reporting(E_ALL);
	ini_set('display_errors', 1);*/
	include('../univ/baseurl.php');
	include( "../univ/main.php");
	session_start();
	//print_r($_SESSION);
	//ini_set('display_startup_errors', 1);
	//
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="cart/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php include('../component/f_links.php');?>
			<style type="text/css" media="screen">
				
				
				/*button css*/
				.btn_st_dash_s {
				border-radius: 18px!important;
				}
				.butn_draf {
				color: #fff!important;
				border-radius: 0;
				background-image: -moz-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -ms-linear-gradient(90deg,#f60 0,#fda649 99%);
				font-size: 14px;
				min-width: 130px;
				}
				.butn_draf:focus, .butn_draf:hover {
				color: #fff;
				opacity: .8;
				background-image: -moz-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -ms-linear-gradient(90deg,#f60 0,#fda649 99%);
				}
				.btn_st_post {
				border-radius: 18px!important;
				color: #fff!important;
				border: 1px solid #0c3c38!important;
				background-color: #0c3c38!important;
				}
				
				.btn_st_post:focus, .btn_st_post:hover {
				color: #fff;
				background-color: #009688;
				border: 1px solid #0c3c38;
				}
				
				ul {
				list-style-type: none;
				}
				
				.butn_save {
				color: #fff;
				border-radius: 30px;
				background-image: -moz-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				background-image: -webkit-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				background-image: -ms-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				font-size: 14px;
				min-width: 130px;
				}	
				.butn_update{
				color: #fff;
				border-radius: 40px;
				font-size: 14px;
				min-width: 100px;
				font-weight: 20px;
				
				/*background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);*/
				
				background-image: -webkit-linear-gradient(90deg,#0f8c19 0,#45be51 100%);
				}
				
				.rating-box {
				position:relative!important;
				vertical-align: middle!important;
				font-size: 18px;
				font-family: FontAwesome;
				display:inline-block!important;
				color: lighten(@grayLight, 25%);
				padding-bottom: 10px;
				}
				
				.rating-box:before{
				content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
				}
				
				.ratings {
				position: absolute!important;
				left:0;
				top:0;
				white-space:nowrap!important;
				overflow:hidden!important;
				color: Gold!important;
				
				}
				.ratings:before {
				content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
				}
				
				<!-- Saved for later card css -->
				img{
				height:150px;
				width:100%;
				}
				
				.item{
				padding-left:5px;
				padding-right:5px;
				}
				.item-card{
				transition:0.5s;
				cursor:pointer;
				}
				.item-card-title{  
				font-size:15px;
				transition:1s;
				cursor:pointer;
				}
				.item-card-title i{  
				font-size:15px;
				transition:1s;
				cursor:pointer;
				color:#ffa710
				}
				.card-title i:hover{
				transform: scale(1.25) rotate(100deg); 
				color:#18d4ca;
				
				}
				.card:hover{
				transform: scale(1.05);
				box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
				}
				.card-text{
				height:80px;  
				}
				
				.card::before, .card::after {
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				transform: scale3d(0, 0, 1);
				transition: transform .3s ease-out 0s;
				background: rgba(255, 255, 255, 0.1);
				content: '';
				pointer-events: none;
				}
				.card::before {
				transform-origin: left top;
				}
				.card::after {
				transform-origin: right bottom;
				}
				.card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
				transform: scale3d(1, 1, 1);
				}
				

			</style>
		
			<!--<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>-->
			
	
		</head>
		<body onload="pageOnload('cart')" class="bg_gray">
			
			<?php
				include_once("../header.php");
			?>
			<section class="landing_page">
				<div class="container">
					<div class="row">
						<div class="col-md-9">
							<div class="cartbox bradius-15" style="margin-top: 10px;">
								
								<div class="cart_header">
									<h3 style="color: #032350;"><i class="fa fa-shopping-cart"></i>&nbsp;Cart</h3>
								</div>
								
								<div class="cart_body">
									
									
									
									<?php
									
												$p = new _spcustomers_basket;
									$rpvsst = $p->readCartItemnew($_SESSION['uid']);
										
										if($rpvsst!=false){
											
											while($rowss = mysqli_fetch_assoc($rpvsst))
											{ 	
												//print_r($rowss);
												$sid = $rowss['spSellerProfileId'];
										}}
										$i= new _spprofiles;
													$i1=$i->read_img($sid);
													//var_dump($i1);
													if($i1!=false){
														$i11=mysqli_fetch_assoc($i1);
														//print_r($i11);
														$usid=$i11['spUser_idspUser'];
														//echo $usid;
													}	
								
													
									$paymentMessage = '';
													if(!empty($_POST['stripeToken'])){
														
													$pi= new _spcustomers_basket;
													$it= $pi->readtypeitembystore($_SESSION['uid'],$_POST['seller_id']);
													//var_dump($it);
													if($it!=false){
														$famount=0;
														while($itt=mysqli_fetch_assoc($it)){
															//print_r($itt);
															$quantity=$itt['spOrderQty'];
															$amount=$itt['sporderAmount'];
															$finalamount =$quantity*$amount;
															$famount=$famount+$finalamount;
															
															
														}
														//echo $famount;
													}
													
													
													
													//echo $sid;die;
													$it11= $pi->readtypeitembyartandcraft($_SESSION['uid'],$_POST['seller_id']);
													//var_dump($it);
													if($it11!=false){
														$famt=0;
														while($itt11=mysqli_fetch_assoc($it11)){
															//print_r($itt11);
															$quant=$itt11['spOrderQty'];
															$amot=$itt11['sporderAmount'];
															$finamt=$quant*$amot;
															$famt= $famt+$finamt;
															
														}		
														//echo $famt;
													}
														
														//die('===');
														// get token and user details
														$stripeToken  = $_POST['stripeToken'];
														$customerName = $_POST['customerName'];
														$cardNumber = $_POST['cardNumber'];
														$cardCVC = $_POST['cardCVC'];
														$cardExpMonth = $_POST['cardExpMonth'];
														$cardExpYear = $_POST['cardExpYear']; 
														$cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;
														
														//$cardDetails = PHP_AES_Cipher::encrypt($encrypt_key, $encrypt_iv, $cardString);
														
														
														$u = new _spuser;
														$resultbok = $u->read($_SESSION['uid']);	
														if ($resultbok != false) {
															$bookedbuy = mysqli_fetch_array($resultbok);
															//print_r($bookedbuy);
															$customerEmail =	 $bookedbuy['spUserEmail'];
															$customerAddress =   $bookedbuy['spUserAddress'];
															$customerZipcode =   $bookedbuy['spUserzipcode'];
															$customerFname =   $bookedbuy['spUserFirstName'];
															$customerLname =   $bookedbuy['spUserLastName'];
															
															$country_code =   $bookedbuy['spUserCountry'];
															$state_code =   $bookedbuy['spUserState'];
															$city_code =   $bookedbuy['spUserCity'];
															
															$co = new _country;
															$result3 = $co->readCountryName($country_code);
															//echo $co->ta->sql;
															if($result3 && $result3->num_rows > 0){
																$row3 = mysqli_fetch_assoc($result3);
																$customerCountry = $row3['country_title'];
																}else{
																$customerCountry = "";
															}
															// CITY NAME
															$ci = new _city;
															$result4 = $ci->readCityName($city_code);
															if ($result4) {
																$row4 = mysqli_fetch_assoc($result4);
																$customerCity = $row4['city_title'];
																}else{
																$customerCity = "";
															}
															
															$st = new _state;
															$result5 = $st->readStateName($state_code);
															if ($result5) {
																$row5 = mysqli_fetch_assoc($result5);
																$customerState = $row5['state_title'];
																}else{
																$customerState = "";
															}
															
															
														}	
														
														//include Stripe PHP library
														require_once('../stripe-php/init.php'); 
														
														//set stripe secret key and publishable key
														$stripe = array(
														"secret_key"      => SECRET_KEY,
														"publishable_key" => PUBLIC_KEY
														);    
														\Stripe\Stripe::setApiKey($stripe['secret_key']);    
														
														try{
														//die('====');
															//add customer to stripe
															$customer = \Stripe\Customer::create(array(
															'name' => $customerName,
															'description' =>  'PRO TITLE',
															'email' => $customerEmail,
															'source'  => $stripeToken,
															"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
															));  
															// item details for which payment made
															$seller_id = $_POST['seller_id'];
															//$itemPrice = number_format($_POST['price'], 2, '.', '');
															//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
															$totalAmount = $_POST['total_amount'];
															//$totalAmount = $totalprice;  //$totalprice
															$currency = $_POST['currency_code'];
															$orderQty = $_POST['spOrderQty'];
															$orderNumber ="WER12345";   
															//print_r($_POST); die('=================');
															// details for which payment performed
															//die('dfhgsdfh');
															//echo $customer->id.' '.$totalAmount.' '.$currency.' '.$orderNumber;
															$payDetails = \Stripe\Charge::create(array(
															'customer' => $customer->id,
															'amount'   => $totalAmount*100,
															'currency' => $currency,
															'description' => 'ITEM NAME',
															'metadata' => array(
															'order_id' => $orderNumber
															)
															)); 
														/*	print_r($payDetails).'<br>';
															die('====');
															print_r($paymenyResponse);*/
															
															
															$paymenyResponse = $payDetails->jsonSerialize();
															
														}
														catch (Error\Card $e) {
															
															$paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();
														}
														catch (Error\InvalidRequest $e) {
															
															$paymentMessage = "<strong>".ucfirst($e->getStripeParam())."</strong> ".$e->getMessage();
														} 
														catch (\Exception $e) {
															$paymentMessage = "<strong>".ucfirst($e->getStripeParam())." </strong> ".$e->getMessage();
														} 
														
														
														
														//print_r($payDetails);
														// get payment details
														
														//echo "<pre>";
														//print_r($paymenyResponse);
														//exit;
														// check whether the payment is successful
														
														//die('00000');
														$orderid = "";
														$p = new _order;
														$rpvtforss = $p->readselleritem_sold($_SESSION['uid'], $_POST['seller_id']);
														if($rpvtforss!=false){
															while($rownewsold = mysqli_fetch_assoc($rpvtforss))
															{ 	
																//print_r($rownewsold);
																
																$id= $rownewsold['idspOrder'];
																
																$orderid  = $id .''.$orderid;
																
															}
														}
														
														
														if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
															//die('---------');
															// transaction details 
															$amountPaid = $paymenyResponse['amount'];
															$balanceTransaction = $paymenyResponse['balance_transaction'];
															$paidCurrency = $paymenyResponse['currency'];
															$paymentStatus = $paymenyResponse['status'];
															$payer_id = $paymenyResponse['customer'];
															$shpping_Address1 = $_POST['shipping_address'];
															//$payer_status = $paymenyResponse['outcome']['type'];
															$paymentDate = date("Y-m-d H:i:s");     
															
															
															
															$data = array(
															"payer_email"=>$customerEmail,
															"payer_id"=>$payer_id,
															"payer_status"=>$payer_status,
															"payment_status"=>$paymentStatus,
															"first_name"=>$customerFname,
															"last_name"=>$customerLname,
															"txn_id"=>$balanceTransaction,
															"currency"=>$currency,
															"quantity"=>$orderQty,
															"payment_date"=>$paymentDate,
															"buyer_uid"=>$_SESSION['uid'],
															"buyer_pid"=>$_SESSION['pid'],
															"payment_gross"=>$totalAmount,
															"sellerid"=>$seller_id,
															"shippAddress"=>$shpping_Address1,
															"basketid"=>$orderid
															);
															// $cardDetails
															
															$paass = new _spcustomers_basket;
															
															$paass->updateorderstatusnew($_SESSION['uid'], $seller_id);
															
															$uu = new _spprofiles;
															
															$resultu = $uu->read($ArtistId);
															if ($resultu != false) {
																$row6 = mysqli_fetch_array($resultu);
																$evetpostuid = $row6['spUser_idspUser'];	
																$posteduseremail =	 $row6['spProfileEmail'];	
																$postedusername =	 $row6['spProfileName'];
																
																$resultboku = $uu->read($_SESSION['pid']);	
																if ($resultboku != false) {
																	
																	$bookedbuyu = mysqli_fetch_array($resultboku);
																	
																	
																	$bokkedbynameu = $bookedbuyu['spProfileName'];
																	$bookeduseremail =	 $bookedbuyu['spProfileEmail'];
																	
																}	
																
																$event_title = '<a style="text-decoration: underline;" href="'.$BaseUrl.'/events/event-detail.php?postid='.$_GET['postid'].'">'.$ProTitle.'</a>';
																
																$e = new _email;
																////// email to event Organizer
																$e->sendeventbooked($postedusername,$posteduseremail,$event_title,$bokkedbynameu,$orderQty,$totalAmount);
																
																
																//// email to buyer
																$e->sendeventbooked($postedusername,"ecommerceguru13@gmail.com",$event_title,$bokkedbynameu,$orderQty,$totalAmount);
															}
															
															/*$oi= new _spcustomers_basket;
																$oid= $oi->newupdate($_SESSION['uid'],$seller_id);
															print_r($oid);*/
															
															$orderid = "";
															$p = new _order;
															$rpvtforss = $p->readselleritem_sold($_SESSION['uid'], $_POST['seller_id']);
															if($rpvtforss!=false){
																while($rownewsold = mysqli_fetch_assoc($rpvtforss))
																{ 	
																	
																	$id= $rownewsold['idspOrder'];
																	
																	//echo $id;
																	$orderid  = $id .','.$orderid;
																	
																	//echo "<br>";
																	//echo $orderid; 
																	//die("===================");
																}
															}
															
															//		echo $orderid;
															//		die('---------');
															
															
															
															
															$sppr= new _spprofiles; 
															$spprofiole= $sppr->read($_POST['seller_id']);
															
															$spprofiole = mysqli_fetch_assoc($spprofiole);
															$spUser_idspUser = $spprofiole['spUser_idspUser'];
															
															
															
															
															
															$pet = new _spevent_transection;
															
															$tr_id = $pet->createagain($data); 
															$orderid  = $id ;
															
															//notification   for seller
															
															$msg =" <b>Order Recieved</b> : Congratulations , you have received a new order ,<a  href='$BaseUrl/store/dashboard/sellerstatusnew.php?postid=$orderid'>Click to View</a> ";
															
															$noti = new _notification;
															
															$data=array('from_id'=>$_SESSION['pid'],
															'to_id'=> $_POST['seller_id'],
															'message'=>$msg,
															'module'=>"store",
															'by_seller_or_buyer'=> 2
															);
															
															$postnoti = $noti->noti_create($data);
															
															
															
															//notification   for buyer
															
															//<b>Order Placed</b> : Congratulations ,  Your order of ORDER_10 has been successfully placed ,<a href="/artandcraft/dashboard/invoice.php?order=MTA=">Click to View</a>
															
															$msg1 =" <b>Order Placed</b> : Congratulations ,  Your order of ORDER_10 has been successfully placed ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$orderid'>Click to View </a> ";	
															$data=array('from_id'=>$_POST['seller_id'],
															'to_id'=> $_SESSION['pid'],
															'message'=>$msg1, 
															'module'=>"store",
															'by_seller_or_buyer'=> 1
															);
															
															$postnoti = $noti->noti_create($data);
															
															
															//from_id  = seesion pid
															//to_id  = _POST['seller_id']);
															//message = <b>Order Recieved</b> : Congratulations , you have received a new order ,<a href="/artandcraft/dashboard/order-invoice.php?order=MQ==">Click to View</a>
															//https://dev.thesharepage.com/store/dashboard/sellerstatus.php?postid=96  //$orderid
															
															//module = store
															//by_seller_or_buyer  = 2
															
															
															
															
															
															
															$p = new _order;
															$rpvt = $p->readselleritem($_SESSION['uid'],$seller_id);
															if ($rpvt != false){
																$cartitem=0;
																while($row = mysqli_fetch_assoc($rpvt))
																{ 										
																	$rpvtnew = $p->resdnewagain($row['idspOrder']);
																	while($rownew = mysqli_fetch_assoc($rpvtnew))
																	{ 	
																		
																		$rpvtnewad = $p->resdnewagainnewsa($rownew['idspPostings']);
																		
																		$rownewadss = mysqli_fetch_assoc($rpvtnewad);
																		
																		$datanew = array(
																		"spPostings_idspPostings"=>$rownew['idspPostings'],
																		"spOrderQty"=>$row['spOrderQty'],
																		"price"=>$rownewadss['spPostingPrice'],
																		"sellerPid"=>$rownewadss['spProfiles_idspProfiles'],
																		"txn_id"=>$tr_id
																		);
																		
																		
																		$dfgdfb = $pet->createagainnew($datanew);
																		
																		
																		$n = new _notification;	
																		
																		$to_id = $rownewadss['spProfiles_idspProfiles'];
																		$from_id = $_SESSION['pid'];
																		$module = 'artcraft';
																		$by_seller_or_buyer = 2;
																		$by_seller_or_buyer1 = 1;
																		
																		$message1 =  '<b>Order Placed</b> : Congratulations ,  Your order of ORDER_'.$tr_id.' has been successfully placed ,<a href="/artandcraft/dashboard/invoice.php?order='.base64_encode($tr_id).'">Click to View</a>';
																		
																		$message =  '<b>Order Recieved</b> : Congratulations , you have received a new order ,<a href="/artandcraft/dashboard/order-invoice.php?order='.base64_encode($tr_id).'">Click to View</a>';
																		
																		$n->createCreatenotification($from_id,$to_id,$message,$module,$by_seller_or_buyer);	
																		
																		$n->createCreatenotificationchart($to_id,$from_id,$message1,$module,$by_seller_or_buyer1);	
																		
																	}
																	
																	
																}
															}   
															
															
															
															
															
															
															
															$paymentMessage = "The payment was successful. Order ID: {$tr_id}";
															//$update_qty = $Quantity - $orderQty;
															//$p->update(array('ticketcapacity' => $update_qty),"WHERE t.idspPostings =" . $_REQUEST["postid"]);
															
															
															//if order inserted successfully
															if($tr_id && $paymentStatus == 'succeeded'){
																$paymentMessage = "The payment was successful. Order ID: {$tr_id}";
																} else{
																//$paymentMessage = "failed";
															}
															
															
															} else{
															//$paymentMessage = "failed";
														}
														//echo $balanceTransaction;
														$pay=array('buyer_userid'=>$_SESSION['uid'],
														'seller_userid'=> $usid,
														'amount'=> $famount,
														'orderid'=>$orderid,
														'balanceTransaction'=>$balanceTransaction,
														'date_txn' =>  date("Y-m-d h:i:sa")
														);
														
														
														
														$oi= new _spcustomers_basket; 
														//die('=====');
														$oi->create1($pay);
														
														
														
														
														$pay1 = array('buyer_userid'=>$_SESSION['uid'],
														'seller_userid'=> $usid,
														'amount'=> $famt,
														'orderid'=>$orderid,
														'balanceTransaction'=>$balanceTransaction,
														'date_txn' =>  date("Y-m-d h:i:sa")
														);
														
														$wat= new _spcustomers_basket; 
														$wat->createforartandcraft($pay1);
												?>
												<div class="alert alert-success" id="success-alert">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Payment Successful! </strong>
</div>



												<script>
												
											$(document).ready(function() {
 // $("#success-alert").hide();
  $("#payNow").click(function showAlert() {
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
});			
									</script>
												
												<?php		
														
													}  //die('========');
										/*$pe = new _spcustomers_basket;
											$anoop=$pe->readid($_SESSION['pid']);
											
											$pi=mysqli_fetch_assoc($anoop);
											print_r($pi);
										$postid=$pi['idspPostings'];*/
										
										
										
										/*$pr = new _productposting;
											$pro = $pr->read($postid);
											
											
											
											if ($pro != false) {
											//print_r($pro);
											while($pror = mysqli_fetch_assoc($pro)){
											//print_r($pror);die;
											//$spPostingTitle = $prorow['spPostingTitle'];
											$sippingch=$pror['sippingcharge'];
											$fixedamt=$pror['fixedamount'];
											
											if($sippingch==0){
											$sippingch=0;
											}
											if($sippingch==1){
											$sippingch+=$fixedamt;
											//echo $sippingch;die('========');
											}
											if($sippingch==2){
											$sippingch=0;
											}
											}	
										}*/
										
										
										$p = new _spcustomers_basket;
										
										
										$sippingch111 = 0 ;
										$u_seller = array();
										
										$rpvsst = $p->readCartItemnew($_SESSION['uid']);
										
										if($rpvsst!=false){
											
											while($rowss = mysqli_fetch_assoc($rpvsst))
											{ 	
												//print_r($rowss);
												$sid = $rowss['spSellerProfileId'];
												
												$u_seller[] =	$spOrderQtyghg = $rowss['spSellerProfileId'];
											}}
											$u_seller = array_unique($u_seller); // 1,2
											
											if ($u_seller != false){
												foreach($u_seller as $values) { 
													
													
													$rpvtforss = $p->readselleritem($_SESSION['uid'],$values);
													$totalpricenewnewforss=0;
													
													$prs = new _spprofiles;
													$result12 = $prs->read($values);
													if($result12 != FALSE){
														$resprofile = mysqli_fetch_array($result12);
														//print_r($resprofile);
														$usid=$resprofile['spUser_idspUser'];
														$sellerNmae = $resprofile['spProfileName'];
													}
													else {
														$sellerNmae = "";
													}
													$cu= new _spuser;
													$cur=$cu->readcurrency($usid);
													if($cur!=false){
														$currr=mysqli_fetch_assoc($cur);
														$curren=$currr['currency'];
														//echo $curren;
													}
												?> 
												<div class="row">
													<div class="col-md-6">
														<b>Seller : <a href="/artandcraft/seller-store.php?profileid=<?php echo $values; ?>&page=1"><?php echo $sellerNmae; ?></a></b>
													</div>
													
												</div>
												
												<div class="row">
													
													
													<div class="col-md-9"></div>
													
													
													
													
												</div>
												<hr style="border: -1px solid Grey;margin-top: 0px;">							
												<?php 
													$rpvt = $p->readselleritem($_SESSION['uid'],$values);
													
													
													if ($rpvt != false){
														
														$cartitem=0;
														$totalitem=0;
														$totalpricenewnew=0;
														$totalspOrderQtyamount = 0;
														$discprice=0;
														while($row = mysqli_fetch_assoc($rpvt))
														{ 	
															
															
															//echo "<pre>";
															//print_r($row);
															
															$spOrderQtyghg = $row['spOrderQty'];
															
															$idspOrdedsfdsr = $row['idspOrder'];
															$baketorderid = $row['idspOrder'];
															
															$spOrderQty = $row['spOrderQty'];
															$totalitem = $totalitem+$spOrderQty;
															//echo $totalitem.'====';
															$sporderAmountnewnew = $row['sporderAmount'];
															
															$totalcart+=($sporderAmountnewnew*$spOrderQty);
															//echo $totalcart;
															
															
															
															
															$pr = new _productposting;
															$pro = $pr->read($row['idspPostings']);
															//var_dump($pro);
															if($pro!=false){
															
																$pror=mysqli_fetch_assoc($pro);
																//print_r($pror);
																$pri=$pror['spPostingPrice'];
																$disco=$pror['retailSpecDiscount'];
																//echo $disco;
																if($disco != 0){
																//echo 'zz';
													      $org_pr=((int)$disco*(int)$pri)/100;
																}
																
																
																
																$disc_price = ($pri-$org_pr);
																
														$discprice= ($discprice + $disc_price);
																//echo $discprice;
																
																
																$sippingch=$pror['sippingcharge'];
																$fixedamt=$pror['fixedamount'];
																//echo $fixedamt;
																
																
															}
															
															$at=$pr->readfromartcraft($row['idspPostings']);
															if($at!=false){
																$art=mysqli_fetch_assoc($at);
																$sippingcharge1=$art['sippingcharge'];
																//echo $sippingcharge1.'<br>';
																$fixedamount1=$art['fixedamount'];
																//echo $fixedamount1;
															}
															
															
															
															$qty=$rowrpvtforss['spOrderQty'];
															//$totalpricenewnewforss +=($qty*$fixedamount+$sippingch);
															//echo $totalpricenewnewforss;
															
															
															//$sippingch111 = $sippingch + $sippingch111 ;
															//echo $sippingch111;
															
															//echo $sporderAmountnewnew;die;
	$totalspOrderQtyamount = $totalspOrderQtyamount+($spOrderQty*$sporderAmountnewnew);
															//$disc_price1=$disc_price+($spOrderQty*$sporderAmountnewnew);
															//echo $disc_price1;
															
															
															
															
															$cartitem++;
															// Getting the item type
															$itemType = $row['cartItemType'];
															$title = $row['spPostingTitle'];
														?>
														
														<?php		
															
															
															/*$m = new _postfield;
															$res = $m->readfield($row["idspPostings"]);*/
															
															//Quantity Availability
															
															$pr = new _postfield;
															$re = $pr->quantity($row["idspPostings"]);
															
															if($re != false)
															{
																
																
																$i = 0;
																$rw = mysqli_fetch_assoc($re);
																$totalquantity = $rw["spPostFieldValue"];
															}
															else{
																$totalquantity = 0;
															}
															
															
															$or = new _spcustomers_basket;
															$soldquantity  = 0;
															$res = $or->quantityavailable($row["idspPostings"]);
															
															if($res != false)
															{ 
																//print_r($res);
																
																
																while($order = mysqli_fetch_assoc($res))
																{
																	
																	//print_r($order);
																	if($order["spOrderStatus"] == 0)
																	{
																		$soldquantity += $order["spOrderQty"];
																		
																	}	
																	
																}
															}
															//die('======');
															$available=0;
															if($totalquantity){
																$available = $totalquantity - $soldquantity;
																//echo $available;
															}
															//echo $available;
															if($available ==0)
															{
																
																$max = 1;
															}
															
															//echo $available;die;
															$max = $available;
															//Quantity Availability Completed
															$postingid = $row["idspPostings"]; 
															$totalqtyprice = $spOrderQtyghg * $row['sporderAmount'];
															$price = $row['sporderAmount'];
															$totalprice+=$totalqtyprice;
															
															echo"<div class='row' style='padding-left:90px'>
															<div class='col-md-2' style='width:100px;margin-left:-80px;float:left;border: 1px solid gray;border-radius: 11px;padding-top: 10px;
															padding-bottom: 10px;'>";	   							
															if ($itemType =='Training') {  
																echo "<a href='../trainings/detail.php?postid=".$row["idspPostings"]."'> ";
																$pc = new _postingpic;
																$tr = new _postingview;
																$result = $tr->singletimelines($postingid);
																
																$row = mysqli_fetch_assoc($result);
																//print_r($row);
																$trTitle   = $row['spPostingTitle'];
																$res = $pc->readFeature($postingid);
																$active1 = 0;
																
																if ($res != false) {
																	$active2 = 0;
																	$postr = mysqli_fetch_assoc($res);
																	//print_r($postr);
																	$picture = $postr['spPostingPic'];
																	
																	if($active2 == 0){
																		$pic = $picture;
																	} ?>
																	
																	<img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive"  style='height: 90px; width: 100px;'>
																	
																	<?php 
																		
																		$active2++;
																		}else{
																		echo"<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 90px; width:100px;'>";
																	}
																	
																	echo"</a>";
															}
															
															elseif($itemType == 'artandcraft'){
																
																echo "<a href='../artandcraft/detail.php?postid=".$postingid."'> ";
																
																$pic = new _postingpicartcraft;
																$res2 = $pic->read($postingid);
																//Quantity
																if ($res2 != false) {
																	$rp = mysqli_fetch_assoc($res2);
																	//print_r($rp);
																	
																	$pic2 = $rp['spPostingPic'];
																	
																?>
																
				   												<img src="<?php echo ($pic2); ?>" alt="Posting Pic" class="img-responsive"  style='height: 90px; width: 100px;'>
																
																<?php 
																	$active2++;
																	}else{
																	echo"<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 90px; width:100px;'>";
																}
																
																echo"</a>"; 
															} else
															{
																
																echo "<a href='".$BaseUrl."/store/detail.php?postid=".$row["idspPostings"]."'> ";
																
																
																$pc = new _productpic;
																$res2 = $pc->read($row["idspPostings"]);
																
																if ($res2 != false) {
																	$rp = mysqli_fetch_assoc($res2);
																	$pic2 = $rp['spPostingPic'];
																?>
																
																<img src="<?php echo ($pic2); ?>" alt="Posting Pic" class="img-responsive"  style='height: 60px; width: 100px;'>
																
																
																<?php
																	
																	$active2++;
																	}else{
																	echo"<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 60px; width:100px;'>";
																}
																
																echo"</a>";
																
																
																
															}
															
															echo"</div>
															<div class='col-md-10' style='padding-left:0%;float:left;padding-right: 0px;'>
															<ul class='a-unordered-list a-nostyle a-vertical a-spacing-mini'>
															<li>";  
															if ($itemType == 'Training') {
																
																echo "<a class='a-link-normal sc-product-link' href='../trainings/detail.php?postid=".$row["idspPostings"]."'
																style='font-size: 24px;'>".ucfirst($row['spPostingTitle'])."</a>";
																}elseif($itemType =='artandcraft'){
																
																$pcraft = new _postingviewartcraft;
																
																$resultc = $pcraft->singletimelines($postingid);
																
																$pf  = new _postfield;
																
																$result_pf8 = $pf->read($row['idspPostings']);	
																
																while($row29 = mysqli_fetch_assoc($result_pf8)){
																	
																	if($row29['spPostFieldName'] == 'quantity_'){
																		$retailQty = $row29['spPostFieldValue'];
																	}
																}
																
																//echo $Quantity;
																
																
																//echo $p->ta->sql;
																if($resultc != false){
																	
																	$rowc = mysqli_fetch_assoc($resultc);
																	//	print_r($rowc);
																	
																	//die();
																	
																	$ProTitle   = $rowc['spPostingTitle'];
																	$retailQty1   = $rowc['retailQuantity'];
																	
																	
																}
																
																
																echo "<a class='a-link-normal sc-product-link' href='../artandcraft/detail.php?postid=".$postingid."'
																style='font-size: 24px;'>".ucfirst($ProTitle)."</a>";
															}else
															{
																$produ = new _productposting;
																$prodata = $produ->read($postingid);
																
																
																// $poster_detail = $pro->read()
																if ($prodata != false) {
																	while($prorow = mysqli_fetch_assoc($prodata)){
																		//print_r($prorow);
																		//	$fixed=0;
																		$curr=$prorow['default_currency'];
																		$spPostingTitle = $prorow['spPostingTitle'];
																		$sippingcharge=$prorow['sippingcharge'];
																		$retailQty=$prorow['retailQuantity'];
																		
																		$fixedamount=$prorow['fixedamount'];
																		$Quantity=$prorow['auctionQuantity'];
																		$fixed=$fixedamount+$fixed;
																		//echo $fixed.'======';
																		/*echo $sippingcharge.'<br>';
																			echo $fixedamount;
																		die;*/
																	}
																}
																
																
																//					$pf  = new _postfield;
																
																//	$result_pf8 = $pf->read($row['idspPostings']);	
																
																//	while($row29 = mysqli_fetch_assoc($result_pf8)){
																
																//	if($row29['spPostFieldName'] == 'quantity_'){
																//		$Quantity = $row29['spPostFieldValue'];
																//	}
																//	}
																
																
																echo "<a class='a-link-normal sc-product-link' href='".$BaseUrl."/store/detail.php?postid=".$row["idspPostings"]."'
																style='font-size: 24px;'>".ucfirst($spPostingTitle)."</a>";
																
															}
															echo "<span class='a-dropdown-container' style='padding-left:30px;'>";
															if ($itemType != 'Training'){
																echo "<label class='a-native-dropdown'>
																Qty:<span class='sc-offscreen-label' aria-label='Quantity'></span>
																</label>";
															}
															
														?>
														<?php
															
															//echo $row["retailQuantity"];
															if($itemType != 'Training'){
																
																if($row['sellType'] == "Wholesaler"){ ?>
																<input type="number" class="liveQty" id="liveQty" name="quantity" value="<?php echo $row['minorderqty'];?>" min="0" min="5" onkeyup="this.value = minmax(this.value, <?php echo $row['minorderqty'];?>, <?php echo $row['supplyability'];?>)" style="width: 50px;" maxlength="5" />
																<?php }else{  ?>
																
																<select name='quantity' class='quantity' autocomplete='off'  tabindex='0' class='a-native-dropdown' <?php echo $max ?> value='<?php echo $row['spOrderQty'] ?>' data-title='<?php echo $row['spPostingTitle']?>' data-available='<?php echo $available8 ?>' data-price='<?php echo $row['spPostingPrice']?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $idspOrdedsfdsr; ?>' >
																	
																	<?php
																		
																		for ($i=1; $i <= $retailQty; $i++) { 
																		?>
																		
																		<option value='<?php echo $i; ?>' <?php  if($row['spOrderQty'] == $i) echo 'selected'; ?>><?php echo $i; ?></option>
																		
																	<?php } ?>
																	
																	
																	
																</select>
															<?php } }
															
															if($itemType != 'Training'){
echo"&nbsp;<span class='sp-order a-link-normal' data-oid='".$row['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$quantity."' data-remainingquant='".$available."' data-subtotal='".$subtotal."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='".$idspOrdedsfdsr."'>Delete</a><span>
																&nbsp; | &nbsp;";
echo "<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('".$idspOrdedsfdsr."',1)  data-oid='".$idspOrdedsfdsr."' data-savestatus='1' id='saveproduct' >Save For later</a>";
															}
															echo "</li>";
															
															if ($itemType != 'Training') {
																
																
																echo "<li><span class=''>In stock</span></li>";
															}
															
															
															echo "</li>";
															if ($itemType == 'Store') {
																//echo "<li><span class=''> </span></li>";
																if($sippingcharge==0){
																	echo "Shipping Charges:Free Shipping";
																}
																if($sippingcharge==1){
																$left_qty=$row['spOrderQty']-1;
																	$left_wty_amt= $left_qty *.25*$fixedamt;
																	$sippingch=$fixedamt+$left_wty_amt;
																//var_dump($fixedamount); 
																	echo "Shipping Charges: ".$sippingch." (Fixed)";
																}
																if($sippingcharge==2){
																	echo "Shipping Charges: As Per Courier";
																}
																$total+=$sippingch;
																//echo $sippingch.'<br>';
																
															}
																if ($itemType == 'artandcraft') {
																//echo "<li><span class=''> </span></li>";
																if($sippingcharge1==0){
																	echo "Shipping Charges:Free Shipping";
																} 
																if($sippingcharge1==1){
																//echo $row['spOrderQty'];
																$left_qty=$row['spOrderQty']-1;
												$left_wty_amt= $left_qty *.25*(int)$fixedamount1;
											$sippingcharge1=(int)$fixedamount1+$left_wty_amt;
																echo "Shipping Charges: ".$sippingcharge1." (Fixed)";
															
																
																}
																if($sippingcharge1==2){
																	echo "Shipping Charges: As Per Courier";
																}
																$total1+=$sippingcharge1;
															//echo $total1;
																
															}
															//echo $total.' ========== ';
													$totalshippingcharge=$total+$total1;
															//echo $totalshippingcharge;
															
															$userid=$_SESSION['uid'];
															
															
															$c= new _orderSuccess;
															
															
															$currency= $c->readcurrency($userid);
															$res1= mysqli_fetch_assoc($currency);
															//$curr=$res1['currency'];
															
															
															$baketattrib = $p->readattribute($postingid,$baketorderid,$itemType);
															
															$optionvaues = new _spproductoptionsvalues;
															
															if ($baketattrib != false){
																
																while($attribrow = mysqli_fetch_assoc($baketattrib))
																{ 	
																	
																	$idsopvdata= $optionvaues->singleread($attribrow['size_idsopv']);
																	if($idsopvdata==""){
																		$datavalues="";
																	}
																	else{
																		$datavalues = mysqli_fetch_assoc($idsopvdata);
																		
																		$idsopdata= $optionvaues->singleread($attribrow['color_idsopv']);
																		
																		$dataname = mysqli_fetch_assoc($idsopdata);
																		
																		
																		echo "<li><strong>Color:</strong> ".$dataname['opton_values']."</li>";
																		
																		echo "<li><strong>Size:</strong> ".$datavalues['opton_values']."</li>";
																	}}
															}
															
															echo "</ul>
															<div class='a-row' style=''>
															<span class='a-dropdown-container' style='padding-left: 40px;'>";
															if ($itemType != 'Training'){
																echo "<label style='display:none;' class='a-native-dropdown'>
																Qty:<span class='sc-offscreen-label' aria-label='Quantity'></span>
																</label>";
															}
															
														?>
														<?php
															
															if($itemType != 'Training'){
																
																if($row['sellType'] == "Wholesaler"){ ?>
																<input type="number" class="liveQty" id="liveQty" name="quantity" value="<?php echo $row['minorderqty'];?>" min="0" min="5" onkeyup="this.value = minmax(this.value, <?php echo $row['minorderqty'];?>, <?php echo $row['supplyability'];?>)" style="width: 50px;" maxlength="5" />
																<?php }else{  ?>
																<select name='quantity'style='display:none;'  class='quantity' autocomplete='off'  tabindex='0' class='a-native-dropdown' <?php echo $max ?> value='<?php echo $row['spOrderQty'] ?>' data-title='<?php echo $row['spPostingTitle']?>' data-available='<?php echo $available ?>' data-price='<?php echo $row['spPostingPrice']?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $idspOrdedsfdsr; ?>' >
																	<option value='1' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "1"){ echo "selected"; } ?>  >1</option>
																	
																	<option value='2' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "2"){ echo "selected"; } ?> > 2 </option>
																	
																	<option value='3' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "3"){ echo "selected"; } ?> > 3 </option>
																	
																	<option value='4' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "4"){ echo "selected"; } ?> > 4 </option>
																	
																	<option value='5' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "5"){ echo "selected"; } ?> > 5 </option>
																	
																	<option value='6' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "6"){ echo "selected"; } ?> > 6 </option>
																	<option value='7' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "7"){ echo "selected"; } ?> > 7 </option>
																	
																	<option value='8' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "8"){ echo "selected"; } ?> > 8 </option>
																	
																	<option value='9' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "9"){ echo "selected"; } ?> > 9 </option>
																	
																	<option value='10' data-a-css-class='quantity-option' <?php if($spOrderQtyghg == "10"){ echo "selected"; } ?> > 10 </option>
																</select>
															<?php } }?>
															<?php
																if($itemType != 'Training'){
																	//echo"&nbsp;  &nbsp";
																	if($row['subcategory'] == "Shoes"){
																		$s = new _spproductsize;
																		$allsize= $s->read($row['idspPostings']);
																		$size = mysqli_fetch_assoc($allsize);
																		$sizeselected === $row['size'];
																	?>
																	<tr>
																		<td><strong>Size:</strong></td>
																		<td>
																			<select id="showsize" class="cartproductsize" data-price='<?php echo $row['spPostingPrice']?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $row['idspOrder']; ?>'>
																				<option value="shoesize1" style="<?php if($size['shoesize1'] <= 0){ echo "display: none;";   }  ?>"   <?php if($row['size'] == 'shoesize1'){ echo "selected";} ?>>1</option>
																				<option value="shoesize2"  style="<?php if($size['shoesize2'] <= 0){ echo "display: none;";   }  ?>"    <?php if($row['size'] == 'shoesize2'){ echo "selected";} ?>>2</option>
																				<option value="shoesize3"  style="<?php if($size['shoesize3'] <= 0){ echo "display: none;";   }  ?>"  <?php if($row['size'] == 'shoesize3'){ echo "selected";} ?>>3</option>
																				<option value="shoesize4"  style="<?php if($size['shoesize4'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize4'){ echo "selected";} ?>>4</option>
																				<option value="shoesize5"  style="<?php if($size['shoesize5'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize5'){ echo "selected";} ?>>5</option>
																				<option value="shoesize6"  style="<?php if($size['shoesize6'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize6'){ echo "selected";} ?>>6</option>
																				<option value="shoesize7"  style="<?php if($size['shoesize7'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize7'){ echo "selected";} ?>>7</option>
																				<option value="shoesize8"  style="<?php if($size['shoesize8'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize8'){ echo "selected";} ?>>8</option>
																				<option value="shoesize9"  style="<?php if($size['shoesize9'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize9'){ echo "selected";} ?>>9</option>
																				<option value="shoesize10" style="<?php if($size['shoesize10'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize10'){ echo "selected";} ?>>10</option>
																				<option value="shoesize11" style="<?php if($size['shoesize11'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize11'){ echo "selected";} ?>>11</option>
																				<option value="shoesize12" style="<?php if($size['shoesize12'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize12'){ echo "selected";} ?>>12</option>
																				<option value="shoesize13" style="<?php if($size['shoesize13'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize13'){ echo "selected";} ?>>13</option>
																				<option value="shoesize14" style="<?php if($size['shoesize14'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'shoesize14'){ echo "selected";} ?>>14</option>
																			</select>
																		</td>
																	</tr>
																	<?php
																	}
																}
																if($itemType != 'Training'){
																	
																	if($row['subcategory'] == "Clothing"){
																		
																		$cs = new _spproductsize;
																		$csize= $cs->read($row['idspPostings']);
																		$clothsize = mysqli_fetch_assoc($csize);
																	?>
																	<tr>
																		<td><strong>Size:</strong></td>
																		<td>
																			<select id="clothsize" style="width: 43px;" class="cartproductsize" data-price='<?php echo $row['spPostingPrice']?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $row['idspOrder']; ?>' >
																				
																				<option value="sizeXS" style="<?php if($clothsize['sizeXS'] <= 0){ echo "display: none;";   }  ?>"  <?php if($row['size'] == 'sizeXS'){ echo "selected";} ?>>XS</option>
																				<option value="sizeS"  style="<?php if($clothsize['sizeS'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeS'){ echo "selected";} ?>>S</option>
																				<option value="sizeM"  style="<?php if($clothsize['sizeM'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeM'){ echo "selected";} ?>>M</option>
																				<option value="sizeL"  style="<?php if($clothsize['sizeL'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeL'){ echo "selected";} ?>>L</option>
																				<option value="sizeXL"  style="<?php if($clothsize['sizeXL'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeXL'){ echo "selected";} ?>>XL</option>
																				<option value="sizeXXL"  style="<?php if($clothsize['sizeXXL'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeXXL'){ echo "selected";} ?>>XXL</option>
																				<option value="sizeXXXL"  style="<?php if($clothsize['sizeXXXL'] <= 0){ echo "display: none;";   }  ?>" <?php if($row['size'] == 'sizeXXXL'){ echo "selected";} ?>>XXXL</option>
																			</select>
																		</td>
																	</tr>
																	<?php 
																		
																	}}?>
																	<?php 
																		if($itemType != 'Training'){
																			echo"<span style='display:none;' class='sp-order a-link-normal' data-oid='".$row['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$quantity."' data-remainingquant='".$available."' data-subtotal='".$subtotal."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='".$idspOrdedsfdsr."'>Delete</a><span>";
																			echo "<a href='javascript:void(0)' style='display:none;' class='a-link-normal delete' onclick=saveproductcart('".$idspOrdedsfdsr."',1)  data-oid='".$idspOrdedsfdsr."' data-savestatus='1' id='saveproduct' >Save For later</a>";
																			
																			echo "</div>	
																			</div>"
																			
																			
																		?>
																		<?php if($disco!=''){	 ?>
<div><?php echo $curr.' '.$disc_price ?><br><del class='float:right; text-success' style='color:green;'><?php echo $curr.' '.$sporderAmountnewnew ?></del></div>
																			<?php } else{ ?>
<div class='pull-right' style='padding-right:20px;'><?php echo $curr.' '.$sporderAmountnewnew ?></div>
																			
																			<?php	}														if($price != false){
																				echo"<div class='col-md-6' style='display:none; float:right;padding-right:0px;width: 200px;'>
																				<span style='float: left;width: 20px;margin-left: 5px;'>".$spOrderQty."</span>
																				<span style='width: 30px;margin-left: 10px;'>".$curr.' '.$sporderAmountnewnew."</span>
																				<span style=' margin-left: 12px;font-size: 15px;color:red'>".$curr.' '.($spOrderQty*$sporderAmountnewnew)."</span></div>";
																				$totalpricenewnew += $sporderAmountnewnew;
																				}else {
																				//$mainpricenow = $spOrderQtyghg * $row['spPostingPrice'];
																				
																				echo" <div class='col-md-3' style='display:none; float:left;padding-right:0px;width: 200px;'>
																				<span style='float: left;width: 30px;margin-left: 10px;'>".$spOrderQty."</span>
																				<span style='width: 30px;margin-right: 8px;'>".$curr.' '.$sporderAmountnewnew."</span>
																				<span style='margin-right: 0px;font-size: 15px;color:red'>".$curr.' '.($spOrderQty*$sporderAmountnewnew)."</span></div>";
																			}
																			}  else{
																			$tr_quantity=1;
																			$tr_order = new _spcustomers_basket;
																			$p = new _postingview; //For price and discount price
																			$pf  = new _postfield;
																			$result_pr = $p->singletimelines($row['idspPostings']); //For price and discount price
																			$row_pr = mysqli_fetch_assoc($result_pr); //For price and discount price
																			$result_pf = $pf->read($row['idspPostings']);//For price and discount price
																			$txtDiscount = "";
																			while ($row2 = mysqli_fetch_assoc($result_pf)) {
																				if($txtDiscount == ''){
																					if($row2['spPostFieldName'] == 'txtDiscount_'){
																						$txtDiscount = $row2['spPostFieldValue'];
																					}
																				}
																			}
																			$org_price =$row['spPostingPrice'];
																			
																			$discountedPrice = $org_price - ($org_price* ($txtDiscount/100));
																			//echo $discountedPrice;
																			$exactPrice = ceil($discountedPrice);
																			
																			
																			$tr_res = $tr_order->readIdOrder($_SESSION['pid'],$row['idspPostings']);
																			$tr_order = mysqli_fetch_assoc($tr_res);
																			
echo"<span class='sp-order a-link-normal' data-oid='".$tr_order['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$tr_quantity."' data-remainingquant='".$available."' data-subtotal='".$exactPrice."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='".$tr_order['idspOrder']."'>Delete</a><span>&nbsp; | &nbsp;";
																			echo "<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('".$tr_order['idspOrder']."',1)  data-oid='".$tr_order['idspOrder']."' data-savestatus='1' id='saveproduct' >Save For later</a>";
																			echo "</div>	
																			</div>"; 
																			if($price != false){
																				echo"<div class='' style='float: right; padding-bottom: 25px; color:red;'>
																				<h4 style='float: right';><b style='font-size: 20px;margin-right: 16px;'> $".$sporderAmountnewnew."</b></h4> </div>";
																				}else {
																				$tr_price=$row['spPostingPrice'];
																				
																				echo" <div class='col-md-3' style='float: right; padding-bottom: 25px; padding-left: 0px; color:red;'>
																				<h4><b style='font-size: 20px;margin-right: 4px;'> $".$sporderAmountnewnew."</b></h4> </div>";
																			}
																			$totalprice += $sporderAmountnewnew;
																		}
																		
																		
																		echo"</div>";
																	?>
																	<!--<div class='pull-right'><a class='btn btn-info text-right' href='#' data-toggle='modal' data-target='#exampleModal2'  onclick='payOnlyThisSeller('<?php //echo $values; ?>','<?php //echo $totalpricenewnewforss; ?>','<?php //echo $sellerNmae; ?>');'>Pay This Product</a></div><br>-->
																	
																	
																	
																	
													<?php echo "<hr style='border: 1px solid Grey;'> ";}?>
													<div class="row">							
														<div class="col-md-12" style="font-size: 18px;float:left;padding-right:5px;">
															<table class="table table-borderless">
																<tr>
																	<td colspan="2">Quantity:</td>
																	<td class="text-right"><?php echo $totalitem;?></td>
																</tr>
																
																
																<td colspan="2">Total Shipping Charges:</td>
																<td class="text-right"><?php echo $curr.' '.$totalshippingcharge;?></td>
																
															</tr>
															<?php if($disco!=false){ 
															//echo 1;
																
																?>
																<tr>
																	<td colspan="2">Total:</td>
<td class="text-danger text-right"><?php echo $curr.' '.(($discprice*$spOrderQty)+$totalshippingcharge);?></td>
																</tr>
																<?php }else{ //echo 2;?>
																<tr>
																	<td colspan="2">Total:</td>
<td class="text-danger text-right"><?php echo $curr.' '.($totalcart+$totalshippingcharge);?></td>
																</tr>
															<?php } ?>
															<tr class="fw-bold">
																
															</tr>
															
														</table>	
													</div>			
													
													
													<?php	echo" <div class='row'>";
														
														echo"<div class='col-md-12 ' style=' float: right; margin-bottom: 25px; '>
														
														<h4 style='display: none;float: left; font-size: 22px; padding-left: 15px; padding-right: 22px; color:#202548;'>Cart Subtotal (".$totalitem." item): <span id='totalamount' class='pull-right;'>".$curr.' '.$totalspOrderQtyamount+$sippingch."</span></h4>
														
														</div></div>	
													";?>
													<?php  
											
											$con =  mysqli_connect(DBHOST, UNAME, PASS);
											
											if(!$con) {
												die('Not Connected To Server');
											}
											
											//Connection to database
											if(!mysqli_select_db($con, DBNAME)) {
												echo 'Database Not Selected';
											}
											
											$uid=$_SESSION["uid"];
											
											//print_r($uid);
											
											$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1"; 
											$result34 = $con -> query($shippingdata);
											//var_dump($result34);
											//if($result34!=false)
											?>
													<div class="col-md-6 float-right">
														<?php $paynow= $totalcart + $totalshippingcharge;
															$paynow1=($discprice*$spOrderQty)+$totalshippingcharge;
															
															//echo $paynow1;
															if($result34->num_rows > 0){
															
															?>
															
															
																	
														<?php if($disco!=false){
															?>
															
															<p style="float:right;">
<a class="btn btn-info text-right" href="#" data-toggle="modal" data-target="#exampleModal1" onclick="payOnlyThisSeller('<?php echo $values; ?>','<?php echo $paynow1; ?>','<?php echo $sellerNmae; ?>','<?php echo $curren; ?>');">Pay This Seller</a></p>
															<?php }else{?>
															<p style="float:right;">
<a class="btn btn-info text-right" href="#" data-toggle="modal" data-target="#exampleModal1" id="<?php echo $nm_row; ?>" onclick="payOnlyThisSeller('<?php echo $values; ?>','<?php echo $paynow; ?>','<?php echo $sellerNmae; ?>','<?php echo $curren; ?>');">Pay This Seller</a></p>
															
															<?php }}  else {?>
														
															
															<p style="float:right;">
<a class="btn btn-info text-right" href="#" data-toggle="modal"  onclick="alert('Please Select Shipping Address')">Pay This Seller</a></p>

															<?php } ?>
															
													
														
													</div></div>
													<hr style='border: 1px solid Grey;'>
													
													
													
													
													
													<?php 	}else{?>
													
													<center><img src='../img/emptycarticon.jpg' alt='Posting Pic' class='img-responsive' style='width: 60%;'>
														
													</center>
													
													<?php	}
													
											}
									}else{?>
									
									<center><img src='../img/emptycarticon.jpg' alt='Posting Pic' class='img-responsive' style='width: 60%;'>
										
									</center>
									
									<?php	}
								?>
								
								<!---<hr  style='border: 1px solid Grey;'>--->
								
							</div> <!-- cardbody close -->
							
						</div>
						
						
						<!--    Add to Cart ENd -->
						
						<!-- saved Product Start -->
						<div class="cartbox bradius-15" style="margin-top: 10px;">
							<div class="cart_header">
								<h3 style="color: #032350;"><!-- <i class="fa fa-shopping-cart"></i> -->Saved For Later</h3>
							</div>
							
							<div class="cart_body">
								<?php
									//
									
									$p = new _order;
									
									$rpvt = $p->readCartItemsavedforlater($_SESSION['uid']);
									//print_r($rpvt);
									if ($rpvt != false){
										//$row = mysqli_fetch_assoc($rpvt);
										//print_r($row);die('======');
										//$cartitem=0;
										while($row = mysqli_fetch_assoc($rpvt))
										{ 	
											if($row['cartItemType']=='Store'){
												
											}
											$price=$row['sporderAmount'];
											
											$n=$p->readNameItemsavedforlater($row['idspPostings']);
											if($n!=false){
												$na=mysqli_fetch_assoc($n);
												
												$title=$na['spPostingTitle'];
												
											}
											
											$im=$p->readImageItemsavedforlater($row['idspPostings']);
											if($im!=false){
												
												while($img=mysqli_fetch_assoc($im)){
													$picture=$img['spPostingPic'];
													
													
												}
											}
											
											if($_GET['action']=='addtocart'){
												$arr=array("saveforlater"=>0);
												$ad=$p->addtocart($arr,$row['idspPostings']);
												header("location:cart/index.php");
											}
											
										?>
										
										
										
										<div class="card item-card card-block">
											<h4 class="card-title text-right"><i class="material-icons">Price:<?php echo $curr.' '.$price;?></i></h4>
											<span class="pull-right"><a href="/cart/index.php?id=<?php echo $row['idspPostings']; ?>&action=addtocart"> Add To Cart</a></span>
											<?php
												
												
											?>
											<div>
												<img src="<?php echo $picture; ?>" style="height:70px;width:100px;" alt="No Image">&nbsp;&nbsp;&nbsp;Title:<a href="<?php echo $BaseUrl.'/store/detail.php?postid='.$row['idspPostings']; ?>" ><?php echo $title; ?></a>
												<h5 ></h5>
											</div>
										</div>
										<?php }
										
										//print_r($row ); 
										
										/*	$SaveditemType = $row['cartItemType'];
											$cartitem++;
											$title = $row['spPostingTitle'];
											$m = new _postfield;
											$res = $m->readfield($row["idspPostings"]);
											if ($res != false){
											while($rows = mysqli_fetch_assoc($res))
											{ 
											if($rows["spPostFieldLabel"] == "Start Date"){
											$startdate = $rows["spPostFieldValue"];
											}else{
											$startdate = "0000-00-00";
											}
											if($rows["spPostFieldLabel"] == "End Date"){
											$enddate = $rows["spPostFieldValue"];
											}else{
											$enddate = "0000-00-00";
											}
											if($rows["spPostFieldLabel"] == "Expiry"){
											$enddate = $rows["spPostFieldValue"];
											}else{
											$enddate = "0000-00-00";
											}
											
											$catid = $rows["spCategories_idspCategory"];
											}
											}
											
											//Quantity Availability
											$pr = new _postfield;
											$re = $pr->quantity($row["idspPostings"]);
											if($re != false)
											{
											$i = 0;
											$rw = mysqli_fetch_assoc($re);
											$totalquantity = $rw["spPostFieldValue"];
											}
											else
											$totalquantity = 0;
											
											$or = new _order;
											$soldquantity  = 0;
											$res = $or->quantityavailable($row["idspPostings"]);
											if($res != false)
											{
											while($order = mysqli_fetch_assoc($res))
											{
											if($order["spOrderStatus"] == 0)
											{
											$soldquantity += $order["spOrderQty"];
											}	
											
											}
											}
											$available = $totalquantity - $soldquantity;
											if($available == 0)
											{
											$max = 1;
											}
											else
											$max = $available;
											//Quantity Availability Completed
											
											$postingid = $row["idspPostings"];
											$totalqtyprice = $row['spOrderQty'] * $row['spPostingPrice'];
											$price = $row['spPostingPrice'];
											$totalprice+=$totalqtyprice;
											echo"<div class='row' style='padding-left:100px'>
											<div class='col-md-3' style='width:100px;margin-left:-50px;float:left;'>";
											if ($SaveditemType == 'Training') {
											echo "<a href='../trainings/detail.php?postid=".$row["idspPostings"]."'> ";
											$pc = new _postingpic;
											$tr = new _postingview;
											
											$result = $tr->singletimelines($postingid);
											$row_sav = mysqli_fetch_assoc($result);
											$trTitle   = $row_sav['spPostingTitle'];
											$res = $pc->readFeature($postingid);
											$active1 = 0;
											if ($res != false) {
											$active2 = 0;
											$postr = mysqli_fetch_assoc($res);
											$picture = $postr['spPostingPic'];
											
											if($picture){
											
											?>
											
											<img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive"  style='height: 50px; width: 80px;'>
											
											<?php 
											//$active2++;
											}else{
											echo"<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 50px; width: 80px;'>";
											}
											/*echo"</a>";
											}else{
											echo '<a  href="../artandcraft/detail.php?postid='.$postingid.'">';
											$pc = new _postingpic;
											$res = $pc->read($postingid);
											$active1 = 0;
											if ($res != false) {
											$active2 = 0;
											$postr = mysqli_fetch_assoc($res);
											$picture = $postr['spPostingPic'];
											
											if($picture){
											
											
											?>
											<img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive"  style='height: 50px; width: 80px;'>
											
											<?php 
											//$active2++;
											}else{
											echo"<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 50px; width: 80px;'>";
											}
											/*echo"</a>";
											}
											echo "</div>
											<div class='col-md-9' style='padding-left:0%;float:left;'>
											<ul class='a-unordered-list a-nostyle a-vertical a-spacing-mini'>
											<li>";
											if ($SaveditemType == 'Training') {
											echo "<a class='a-link-normal sc-product-link' href='../trainings/detail.php?postid=".$row["idspPostings"]."'
											style='font-size: 24px;'>".$title."</a>";
											}else{
											
											$rpvtnewad = $p->resdnewagainnewsa($row["idspPostings"]);
											
											$rownewadss = mysqli_fetch_assoc($rpvtnewad);
											
											echo "<a class='a-link-normal sc-product-link' href='../store/detail.php?postid=".$row["idspPostings"]."'
											style='font-size: 24px;'>".ucfirst($rownewadss['spPostingTitle'])."</a>";
											}
											echo "</li>";
											if ($SaveditemType != 'Training') {
											echo "<li><span class=''>In stock</span>";
											}
											echo "<li>
											</ul>";
											?>
											<div class='a-row' style=''>
											<span class='a-dropdown-container' style='padding-left: 40px;'>
											<?php 
											if ($SaveditemType != 'Training') {
											echo"<span class='sp-order a-link-normal' data-oid='".$row['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$quantity."' data-remainingquant='".$available."' data-subtotal='".$subtotal."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='".$row['idspOrder']."'>Delete</a><span>
											
											&nbsp; | &nbsp;
											
											<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('".$row['idspOrder']."',0) data-oid='".$row['idspOrder']."' data-savestatus='0' id='moveproducttocart' >Move To Cart</a>
											
											</div>	
											
											</div>"; 
											if($price != false){
											echo"<div class='col-md-3' style='float: right; padding-bottom: 25px;color:red;'>
											<h4 style='float: right;'><b style='font-size: 20px;'> $".$row['spPostingPrice']."</b>
											</h4>
											</div>";
											}else {
											echo"<div class='col-md-3' style='float: right; padding-bottom: 25px; padding-left: 0px; color:red;'>
											<h4><b style='font-size: 20px;'> $".$rownewadss['spPostingPrice']."</b></h4> 
											</div>";
											}
											}else{
											$tr_quantity=1;
											$tr_order = new _order;
											$p = new _postingview; //For price and discount price
											$pf  = new _postfield;
											$result_pr = $p->singletimelines($row['idspPostings']); //For price and discount price
											$row_pr = mysqli_fetch_assoc($result_pr); //For price and discount price
											$result_pf = $pf->read($row['idspPostings']);//For price and discount price
											$txtDiscount = "";
											while ($row2 = mysqli_fetch_assoc($result_pf)) {
											if($txtDiscount == ''){
											if($row2['spPostFieldName'] == 'txtDiscount_'){
											$txtDiscount = $row2['spPostFieldValue'];
											}
											}
											}
											$org_price =$row_pr['spPostingPrice'];
											$discountedPrice = $org_price - ($org_price* ($txtDiscount/100));
											$exactPrice = ceil($discountedPrice);
											
											
											$tr_res = $tr_order->readIdOrder($_SESSION['pid'],$row['idspPostings']);
											$tr_order = mysqli_fetch_assoc($tr_res);
											
											echo"<span class='sp-order a-link-normal' data-oid='".$tr_order['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$tr_quantity."' data-remainingquant='".$available."' data-subtotal='".$exactPrice."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='".$tr_order['idspOrder']."'>Delete</a><span>
											&nbsp; | &nbsp;";
											echo "<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('".$row['idspOrder']."',0) data-oid='".$row['idspOrder']."' data-savestatus='0' id='moveproducttocart' >Move To Cart</a>";
											echo "</div>	
											</div>"; 
											if($price != false){
											echo"<div class='' style='float: right; padding-bottom: 25px; color:red;'>
											<h4 style='float: right';><b style='font-size: 20px;margin-right: 16px;'> $".$exactPrice."</b></h4> </div>";
											}else {
											$tr_price=$row['spPostingPrice'];
											
											echo" <div class='col-md-3' style='float: right; padding-bottom: 25px; padding-left: 0px; color:red;'>
											<h4><b style='font-size: 20px;margin-right: 4px;'> $".$exactPrice."</b></h4> </div>";
											}
											}
											echo"</div>
										<hr  style='border: 1px solid Grey;'> ";*/
										
										
									}else{?>
									<center>No Saved product found</center>
									
									<?php	
									}
								?>
								
							</div> <!-- cardbody close -->
							
						</div>
						<!-- saved Product End -->
						
						
						
					</div>
					
					
					<!-- <?php //print_r($_SESSION['uid']);?>  -->
					
					
					
					
					
					<div class="col-md-3 hidden-xs no-padding" >
						
						<div class="" style="padding-left: 70px;">
							
							<!----<a href="../store/storeindex.php" class="btn btn_st_dash_s butn_draf">Countinue Shopping</a>--->
							
							
							
							<?php
								// ===PAYPAL ACCOUNT LIVE SETTING
								// RETURN CANCEL LINK
								$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								$success_return = $BaseUrl."/paymentstatus/payment_success.php?uid=".$_SESSION['uid'];
								// ===END
								// ===LOCAL ACCOUNT SETTING
								// RETURN CANCEL LINK
								//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
								// ===END
								
								
								
								//Here we can use paypal url or sanbox url.
								// sandbox$BaseUrl/
								$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
								// live payment
								//$paypal_url		= 'https://www.paypal.com/cgi-bin/webscr';
								//Here we can used seller email id. 
								$merchant_email = 'developer-facilitator@thesharepage.com';
								// live email
								//$merchant_email = 'sharepagerevenue@gmail.com';
								
								//paypal call this file for ipn
								//$notify_url 	= "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
							?>
							<!--<a href="#" id="checkout" class="btn btn-success pull-right" data-postid="<?php echo $postingid; ?>" data-buyerid="<?php echo $_SESSION['pid']; ?>" data-categoryid="<?php echo $categoryid; ?>" data-expirydate="<?php echo $closingdate; ?>" data-quantity="1"><span class="glyphicon glyphicon-shopping-cart"></span>Checkout</a>-->
							
							
							<form action="<?php echo $paypal_url; ?>" method="post">
								<input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
								<!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
								<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
								<input type="hidden" name="return" value="<?php echo $success_return; ?>">
								<input type="hidden" name="rm" value="2" />
								<input type="hidden" name="lc" value="" />
								<input type="hidden" name="no_shipping" value="1" />
								<input type="hidden" name="no_note" value="1" />
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="page_style" value="paypal" />
								<input type="hidden" name="charset" value="utf-8" />
								<input type="hidden" name="cbt" value="Back to FormGet" />
								
								<!-- Redirect direct to card detail Page -->
								
								<input type="hidden" name="landing_page" value="billing">
								
								<!-- Redirect direct to card detail Page End -->
								
								
								<!-- Specify a Buy Now button. -->
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="upload" value="1">
								
								<?php
									$p = new _order;
									$rpvt = $p->readCartItemnew($_SESSION['uid']);
									if ($rpvt != false)
									{
										$i = 0;
										while($row = mysqli_fetch_assoc($rpvt))
										{ 	
											$price = 0;
											if(isset($row['spPostingPrice'])){
												$price = $row['spPostingPrice'];
											}
											if ($row['cartItemType'] == 'Training') {
												$price += $row['sporderAmount'];
											}
											$quantity = $row['spOrderQty'];
											
											
											
											//print_r($price);
											
											
											$i = $i+1;
											$string = str_replace(' ', '', $row['spPostingTitle']);
											echo "<input type='hidden' name='item_name_".$i."' value='".$row['spPostingTitle']."'>";
											echo "<input type='hidden' name='item_number' value='143' >";
											echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_".$i."' value='".$price."'>";
											
											echo "<input type='hidden' id='".$row['idspPostings']."' name='quantity_".$i."' value='".$quantity."'>";
										}
									}
									
								?>
								
								<input type="hidden" name="shopping_url" value="http://www.a2zwebhelp.com">
								
								
								<!--  <a href="" class="btn  btn_st_post text-right" style="margin-top: 15px!important;">Proceed to Checkout</a>
								-->
								<!--    <input class="pull-right"  type="image" name="submit" border="0" src="../assets/images/payment/paypal.png" alt="Buy Now" id="checkout"> -->
								
								<!-- <input class="btn btn_st_post text-right"  type="button" value="Proceed to Checkout" name="submit" border="0"  alt="Buy Now" id="checkout"> -->
								
								<!---- <button type="submit" id="checkout" name="submit" class="btn btn_st_post text-right" style="margin-top: 15px!important;">Proceed to Checkout</button>---->
								
								
								<!-- 	<?php
									
									if (isset($shipnotshow) && $shipnotshow == 1) {
									?>
									<div class="row no-margin">
									<input class="pull-right"  type="image" name="submit" border="0" src="../assets/images/payment/paypal.png" alt="Buy Now" id="checkout" >
									</div>
									<?php
									}
								?> -->
								
								<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
								
							</form>
							
							
							
						</div>
						
						<style>
							.left_grid.left_group_black.left_sidebar.dfgdfgbdfbgdf {
							display: none;
							background-color: #fff;
							padding-left: 4px;
							padding-top: 15px;
							padding-bottom: 15px;
							border-radius: 15px;
							margin-top: 10px;
							}
						</style>
						
						
						<div class="left_grid left_group_black left_sidebar dfgdfgbdfbgdf">
							
							
							
							<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
							<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>	
							
							
							<script>
								
								Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');
								
								function checkqty(txb) {                
									var qty = parseInt(txb);
									var actualQty = $("#spOrderQty").val();
									//alert(actualQty);return false;
									//console.log(actualQty);
									if(qty > actualQty){
										document.getElementById("newValue").value = actualQty;
									}
									if(qty < 1){
										document.getElementById("newValue").value = 1;
										//alert("less");
									}
									
									$('#payqty').val($('#newValue').val());
								}
							</script>
							
							<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>
							
							<!-- Button trigger modal -->
							
							
							<!-- Modal -->
							
							<!----<form action="<?php echo $BaseUrl;?>/cart/index.php" method="POST" id="paymentForm">	
								
								<div class="form-group">
								<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
								<input type="text" name="customerName" id="customerName" style="width:284px;" class="form-control" value="" required>
								<span id="errorCustomerName" class="text-danger"></span>
								</div>
								
								<div class="form-group">
								<label>Card Number <span class="text-danger">*</span></label>
								<input type="text" name="cardNumber" id="cardNumber" style="width:284px;" class="form-control" maxlength="20" onkeypress="">
								<span id="errorCardNumber" class="text-danger"></span>
								</div>
								<div class="row">
								<div class="col-md-5">
								<label>Expiry Month</label>
								<input type="text" name="cardExpMonth" style="width:100px;" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
								<span id="errorCardExpMonth" class="text-danger"></span>
								</div>
								<div class="col-md-4">
								<label>Expiry Year</label>
								<input type="text" name="cardExpYear" id="cardExpYear" style="width:76px;" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
								<span id="errorCardExpYear" class="text-danger"></span>
								</div>
								<div class="col-md-3">
								<label>CVC</label>
								<input type="text" name="cardCVC" id="cardCVC" style="width: 63px;margin-left: -18px;" class="form-control"  maxlength="4" onkeypress="return validateNumber(event);">
								<span id="errorCardCvc" class="text-danger"></span>
								</div>
								</div>
								<br>
								<div align="left">
								<input type="hidden" name="spOrderQty" value="<?php echo $_SESSION['spOrderQty'];?>">
								<input type="hidden" name="price" value="<?php echo $price;?>">
								<input type="hidden" name="total_amount" value="<?php echo $total_price;?>">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="item_details" value="<?php echo $ProTitle;?>">
								<button type="button" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <?php echo ' $'. $totalprice; ?></button>
								
								
								
							<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
							<!---</div>
								<br>
							</form>--->
							
						</div>
						
						<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Payment To <span id="seller_name"> </span><?php //echo $sellerNmae; ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-32px;">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										
										
										<form class="row" action="<?php echo $BaseUrl;?>/cart/index.php" method="POST" id="paymentForm">	
											<div class="col-md-2"></div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-9 form-group">
														<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
														<input type="text" name="customerName" id="customerName" class="form-control" value="" onkeypress="return /[a-z]/i.test(event.key)" required>
														<span id="errorCustomerName" class="text-danger"></span>
													</div>
													
													<div class="col-md-9 form-group">
														<label>Card Number <span class="text-danger">*</span></label>
														<input type="number" name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="">
														<span id="errorCardNumber" class="text-danger"></span>
													</div>
													<div class="col-md-9">
														<div class="row">
															<div class="col-md-4">
																<label>Expiry Month</label>
																<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
																<span id="errorCardExpMonth" class="text-danger"></span>
															</div>
															<div class="col-md-4">
																<label>Expiry Year</label>
																<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
																<span id="errorCardExpYear" class="text-danger"></span>
															</div>
															
															<div class="col-md-4">
																<label>CVV</label>
																<input type="text" name="cardCVC" id="cardCVC" class="form-control" placeholder="XXX"  maxlength="3" onkeypress="return validateNumber(event);">
																<span id="errorCardCvc" class="text-danger"></span>
															</div>
														</div>
													</div>
													<br>
													<div class="col-md-7" align="left" style=" margin-top: 12px; ">
														<input type="hidden" id="total_amountforss" name="total_amount" value="<?php echo $totalspOrderQtyamount; ?>">
														<input type="hidden" id="selleridforss" name="seller_id" value="">
														<input type="hidden" id="prodt_currency" name="currency_code" value="">
														<input type="hidden" name="shipping_address" value="<?php  echo $shpping_Address; ?>">
														
														
	<button type="button" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now" href="javascript:;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss"><span></button>
															
															
															
															<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
														</div>
														<br>
														</div>
													</div>
													<div class="col-md-2"></div>
												</form>
											</div>
											<div class="modal-footer">
												<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close11</button>-->
											</div>
										</div>
									</div>
								</div>
								
								<script>
									
									/*$("#cardExpMonth").on("keyup change", function(e) {
										var k = $("#cardExpMonth").val();
										// alert('===');
										if((k == 01) || (k == 02) || (k == 03) || (k == 04) || (k == 05) || (k == 06) || (k == 07) || (k == 08) || (k == 09) || (k == 10) || (k == 11) || (k == 12)){
											$("#cardExpMonth").val(k);
											
										}
										else{
											$("#cardExpMonth").val('');
										}
									})*/
									
									
									
								</script>
								<!--pay this product modal
									<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Payment To <span id="seller_name"> </span><?php echo $sellerNmae; ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
									
									
									<form class="row" action="<?php echo $BaseUrl;?>/cart/index.php" method="POST" id="paymentForm">	
									<div class="col-md-2"></div>
									<div class="col-md-10">
									<div class="row">
									<div class="col-md-9 form-group">
									<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
									<input type="text" name="customerName" id="customerName" class="form-control" value="" required>
									<span id="errorCustomerName" class="text-danger"></span>
									</div>
									
									<div class="col-md-9 form-group">
									<label>Card Number <span class="text-danger">*</span></label>
									<input type="text" name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="">
									<span id="errorCardNumber" class="text-danger"></span>
									</div>
									<div class="col-md-9">
									<div class="row">
									<div class="col-md-4">
									<label>Expiry Month</label>
									<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
									<span id="errorCardExpMonth" class="text-danger"></span>
									</div>
									<div class="col-md-4">
									<label>Expiry Year</label>
									<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
									<span id="errorCardExpYear" class="text-danger"></span>
									</div>
									
									<div class="col-md-4">
									<label>CVV</label>
									<input type="text" name="cardCVC" id="cardCVC" class="form-control"  maxlength="4" onkeypress="return validateNumber(event);">
									<span id="errorCardCvc" class="text-danger"></span>
									</div>
									</div>
									</div>
									<br>
									<div class="col-md-7" align="left" style=" margin-top: 12px; ">
									<input type="hidden" id="total_amountforss" name="total_amount" value="">
									<input type="hidden" id="selleridforss" name="seller_id" value="">
									<input type="hidden" name="currency_code" value="<?php echo $curr?>">
									<input type="hidden" name="shipping_address" value="<?php  echo $shpping_Address; ?>">
									
									
									<button type="button" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss"><span></button>
									
									
									
									<input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> 
									</div>
									<br>
									</div>
									</div>
									<div class="col-md-2"></div>
									</form>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
									</div>
								</div>-->
								
								
								<div class="row left_grid left_group_black left_sidebar" style="margin-left:3px; margin-top: -9px;" >
									<div class="col-md-11">
										<a href="../my-profile/add-shipping.php" style="float: left;margin-bottom:10px;">Change Shipping Address</a>
										<h3 style="color: #032350; float-left;">Shipping Address</h3>
										
										<?php  
											
											$con =  mysqli_connect(DBHOST, UNAME, PASS);
											
											if(!$con) {
												die('Not Connected To Server');
											}
											
											//Connection to database
											if(!mysqli_select_db($con, DBNAME)) {
												echo 'Database Not Selected';
											}
											
											$uid=$_SESSION["uid"];
											
											//print_r($uid);
											
											$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1"; 
											$result34 = $con -> query($shippingdata);
											//var_dump($result34);
											/*print_r($result34);*/
											//print_r($result);
											/*if ($result->num_rows == 0) {
												$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 0"; 
												
												$result = $con -> query($shippingdata);
												
												}
											*/
											
											$row34 = mysqli_fetch_assoc($result34);
											
											//print_r($row);
											//print_r($shippingdata);
											
											//print_r(expression)
										?>
										<?php if (!empty($row34)) { ?>
											
											<div class="a-section address-section-with-default">
												<div class="a-row a-spacing-small">               
													
													<?php $co = new _country;
														$result3 = $co->readCountryName($row34['country']);
														if ($result3) {
															$row3 = mysqli_fetch_assoc($result3);
															
															
														} ?>
														
														<?php
															$co = new _state;
															$result4 = $co->readStateName($row34['state']);
															if ($result4) {
																$row4 = mysqli_fetch_assoc($result4);
																
															}
														?>
														
														
														<ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none;">
															<li><b><span class="a-list-item"><h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $row34['fullname'];?></h5></span></b></li>
															
															<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $row34['fulladdress'];?></span></span></li>
															
															
															<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineTwo" class="id-addr-ux-search-text"> <?php echo $row34['landmark'];?> </span></span></li>
															
															
															<li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $row34['city'];?>, <?php echo  $row4['state_title'];?> <?php echo $row1['zipcode'];?></span></span></li>
															
															
															<li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $row34['country_title'];?></span></span></li>
															
															
															<li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php echo $row34['phone'];?>&#8236;</span></span></li>
														</ul>
														
														
														
												</div>
											</div>
											
											<?php
												
												$shpping_Address = $row34['fullname'].' '.$row34['fulladdress'].' <br>'.$row34['landmark'].' '.$row34['city'].'<br> '. $row4['state_title'].' '.$row1['zipcode'].'<br> '.$row34['country_title'].' '.$row34['phone'];
												
											}else{ ?>
											
											<p>Please Add Shipping Address by Clicking on  <a href="../my-profile/add-shipping.php" style="margin-bottom: 26px;">Add Shipping Address</a></p>
											
										<?php } ?>
									</div>
								</div>
								
								<!-- Billing Address-->
								<div class="row left_grid left_group_black left_sidebar" style="margin-left:3px;" >
									<div class="col-md-11">
										<a href="<?php echo $BaseUrl;?>/dashboard/settings/myAddress.php" style=" margin-left:70px; margin-bottom: 10px; font-size:14px">Change Billing Address</a><br>
										<h3 style="color: #032350; font-size:20px" class="d-inline">Billing Address</h3>
										
										
										
										
										
										<?php  
											$u = new _spuser;
											$res = $u->read($_SESSION["uid"]);
											//echo $u->ta->sql;
											if($res != false){
												$ruser = mysqli_fetch_assoc($res);
												//print_r($ruser);
												$username = $ruser["spUserName"]; 
												$userphone = $ruser["spUserCountryCode"].$ruser["spUserPhone"];
												$useremail = $ruser["spUserEmail"]; 
												$useraddress = $ruser["address"];
												$usercountry = $ruser["spUserCountry"]; 
												$userstate = $ruser["spUserState"]; 
												$usercity = $ruser["spUserCity"]; 
												$address = $ruser["address"]; 
												$userZipCode = $ruser["spUserzipcode"]; 
												$isPhoneVerify = $ruser["is_phone_verify"];
												
											?>
											
											<div class="a-section address-section-with-default">
												<div class="a-row a-spacing-small">               
													
													<ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none;">
														<li><b><span class="a-list-item"><h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $username;?></h5></span></b></li>
														
														<li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $useraddress;?></span></span></li>
														
														
														
														
														
														<li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $usercity;?>, <?php echo  $userstate;?> <?php echo $userZipCode;?></span></span></li>
														
														
														<li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $usercountry;?></span></span></li>
														
														
														<li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php echo $userphone;?>&#8236;</span></span></li>
													</ul>
													
													
													
												</div>
											</div>
											
											<?php
												
												
												
											}	else{ ?>
											
											<p>Please Add Billing Address by Clicking on  <a href="../my-profile/add-shipping.php" style="margin-bottom: 26px;">Add Billing Address</a></p>
											
										<?php } ?>
									</div>
								</div>
								
								
									<?php 
										
										
										$pv = new _spproduct_view;
										
										$resv = $pv->readrecentcartview($_SESSION['uid']);
										//var_dump($resv);
										if ($resv != false) {
											
											
											while($rowf = mysqli_fetch_assoc($resv)){
											
												$p = new _productposting;
												$rd = $p->read($rowf['productid']);
												if($rd!=false){
												$prodetail = mysqli_fetch_assoc($rd);
												}
												$rr = new _spstorereview_rating;
												$reviewres = $rr->readstorerating($rowf['productid']);
												if ($reviewres != FALSE) {
													
													$raterow = mysqli_fetch_assoc($reviewres);
													$pc = new _productpic;
													$respic = $pc->read($rowf['productid']);
													$active1 = 0;
													if ($respic != false) {
														$active2 = 0;
														$postr = mysqli_fetch_assoc($respic);
														$picture = $postr['spPostingPic'];
														
														if($active2 == 0){
															$pic = $picture;
															
														}
													}
													
												?>
												
											<?php  }
											
										}
										}
										
									?>	
									
									
									
									
									
									
								</div>
							</div>
						</div>
					</div>	
					
					
				</section>
				
				<?php include('../component/f_footer.php');?>
				<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
				<?php include('../component/f_btm_script.php'); ?>
				
			</body>
		</html>
		
		<?php
		}
	?>
	<script type="text/javascript">
		
		function saveproductcart(orderId,savestatus){
			
			$.post("saveforlater.php", {orderId:orderId,savestatus:savestatus}, function (data) {
				window.location.reload();
			});
		}
		
		
		
		var number = document.getElementById('liveQty');
		
		// Listen for input event on numInput.
		number.onkeydown = function(e) {
			if(!((e.keyCode > 95 && e.keyCode < 106)
			|| (e.keyCode > 47 && e.keyCode < 58) 
			|| e.keyCode == 8)) {
				return false;
			}
		}    
		function minmax(value, min, max) 
		{
			/* if(parseInt(value) < min || isNaN(parseInt(value))) 
			return min; */
			if(parseInt(value) > max) 
			return max; 
			else return value;
		}
		
		function payOnlyThisSeller(sellerid, totalprice,sellerName,currency){
			/*if(nm_rows==0){
			alert('Please Select Shipping Address');
			return false;

			}*/
			$('#selleridforss').val(sellerid);
			$('#total_amountforss').val(totalprice);
			$('#prodt_currency').val(currency);
			$('#totalpriceforss').html(totalprice);
			$('#seller_name').html(sellerName);
			
		}
		
		
	</script>											