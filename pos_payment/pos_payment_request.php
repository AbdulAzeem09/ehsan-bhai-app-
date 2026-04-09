<?php 

	include('../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	


	$pr = new _spprofiles;
	$m = new _spmembership;
	$result = $pr->profileforresume($_SESSION["uid"]);
	if($result != false){
		while($rows = mysqli_fetch_assoc($result)){
			if($rows["idspProfileType"] == 1)
			{
				$profileid = $rows["idspProfiles"];
				$subdate = $rows["spProfileSubscriptionDate"];
			}
		//	$res = $m->readmember($rows["spMembership_idspMembership"]);
			
			$res = $m->readmember($_GET['id']);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				//print_r($row);die;
				//echo $row["spMembershipName"]."<br>";
				$membership_name=$row["spMembershipName"];
				$count=$row["spMembershipPostlimit"]."<br>";
			$duration=$row["spMembershipDuration"];
				
			}
		}
		//echo $duration;
	
		
		//echo $expDate;
		//Details Code testing	
		if (isset($profileid)) {
			$p = new _postings;
			$res = $p->businesspost($profileid);
			if($res != false){
				$postconsumed = $res->num_rows;
			}
			// this is orignal - $remainpostlimit = $count - $postconsumed;
			$remainpostlimit = 0 - $postconsumed;
		}
		if (isset($subdate)) {
			$postdate = strtotime($subdate);
			$currentdate = strtotime(date('Y-m-d h:i:sa'));
			$Diff = abs($currentdate - $postdate);
			$numberDays = $Diff/86400;
			$numberDays = intval($numberDays); 
			// this is orignal - $remainingday  = $duration - $numberDays;
			
		}else{
			$numberDays = 0;
		}
		$remainingday  = 1 - $numberDays;
		
	}




///////// start code for stripe payment request , response////////////

  
$paymentMessage = '';
							if(!empty($_POST['stripeToken'])){
								
												// get token and user details
												$stripeToken  = $_POST['stripeToken'];
												$customerName = $_POST['customerName'];
												$cardNumber = $_POST['cardNumber'];
												$cardCVC = $_POST['cardCVC'];
												$cardExpMonth = $_POST['cardExpMonth'];
												$cardExpYear = $_POST['cardExpYear']; 
												$cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;
												
												
													//include Stripe PHP library
												require_once('../stripe-php/init.php'); 
												
												//set stripe secret key and publishable key
												$stripe = array(
												"secret_key"      => SECRET_KEY,
												"publishable_key" => PUBLIC_KEY
												);    
												\Stripe\Stripe::setApiKey($stripe['secret_key']);    
												
												
													try{  //die("yyyyyyyyyyyyyyyyyyyyyy");
													//add customer to stripe
													$customer = \Stripe\Customer::create(array(
													'name' => $customerName,
													'description' =>  'PRO TITLE',
													'email' => $customerEmail,
													'source'  => $stripeToken,
													"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
													));  
													// item details for which payment made
													//$seller_id = $_POST['seller_id'];
													//$itemPrice = number_format($_POST['price'], 2, '.', '');
													//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
													$totalAmount = $_POST['total_amount'];
													//$totalAmount = $totalprice;  //$totalprice
													$currency = $_POST['currency_code'];
													//$orderQty = $_POST['spOrderQty'];
													$orderNumber ="WER12345";   
													//print_r($_POST); die('=================');
													// details for which payment performed
													$payDetails = \Stripe\Charge::create(array(
													'customer' => $customer->id,
													'amount'   => (int)$totalAmount*100,
													'currency' => $currency,
													'description' => 'ITEM NAME',
													'metadata' => array(
													'order_id' => $orderNumber
													)
													)); 
													
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
												
											//echo "cdskifjuidkjgofyiuodfhjopgfgjkhngfoiug";	
										//	print_r($paymenyResponse); die("---------888888888-------------------");
								
						$fr= new _spuser;
$fr1= $fr->readdatabybuyerid($_SESSION['uid']);
//var_dump($fr1); 

if($fr1!=false){
	$fr2=mysqli_fetch_assoc($fr1);
	//print_r($fr2);die;
    $trial=$fr2['duration'];
	 $recurring_duration=$fr2['recurring_duration'];
	if($trial==0){
	$new_duration = $duration+0;
	}
	else{
	$new_duration=$duration;
	}
	
}	
							
							
												if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){ //$cardDetails
													//die('======');
							$tansation = "123456789";
								$uid = $_SESSION['uid'];
								$pid = $_SESSION['pid'];
							//echo $_POST['price'];
								$dat = array(
													"amount"=>$_POST['price'],
													"membership_id"=>$_GET['id'],
													"txn_numberpid"=>$tansation,
													"uid"=>$uid,
													"pid"=>$pid,
													"duration"=>$new_duration
													
													);
											$fr2=$fr->update_duration($_SESSION['uid']);
											
											//if($trial==0){
									$mb = new _spmembership;
                                    $result = $mb->create($dat);
											//}
									
												}
												
							}
             

///////// end code for stripe payment request , response////////////
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <!-- this script for slider art -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->

		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
		 <link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
		  <script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

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

			function checkqtynew(txb,limit,id) {                
                var qty = parseInt(txb);
              
                if(qty > limit){
                    document.getElementById("newValue"+id).value = limit;
					alert("you can not enter more than available qty");
                }
                if(qty < 1){
                    document.getElementById("newValue"+id).value = 0;
                  //  alert("please enter more than 1 qty");
                }
				if(qty==""){
                    document.getElementById("newValue"+id).value = 0;
                  //  alert("please enter more than 1 qty");
                }

                
            }

			function checkqty()
			{
			$checkboxTicket_Type = $('.Ticket_Typenew');
			var chkArray = [];
			chkArray = $.map($checkboxTicket_Type, function(el){
				 return el.value ;
			});
			var totval =0;
			$.each(chkArray,function(key,value){
			
			totval = totval+value;
			
        });
			if(totval>0)
				{
				return true;
			  }else
				{
				 alert("Please enter some ticket quantity.");
				return false;
			    }
			
			}
        </script>
      	<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>

        
<style type="text/css">
  div#profileshow {
    padding-left: 0!important;
}
div#groupshow {
    padding-left: 0!important;
}

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  /*padding-bottom: 10px;*/
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

.flag:hover{
    color:#428bca!important;
}
	
.ui-autocomplete.ui-menu {
    background: #fff;
    max-width: 20%;
    border: 1px solid #c5c5c5;
    font-size: 1em;
	padding: 3px 3em 6px 1em;
}
	.ui-autocomplete.ui-menu .ui-menu-item {
    line-height: 26px;
    letter-spacing: 0.5px;
}


	
	/* * Pure CSS star rating that works without reversing order * of inputs * ------------------------------------------------------- * NOTE: For the styling to work, there needs to be a radio * input selected by default. There also needs to be a * radio input before the first star, regardless of * whether you offer a 'no rating' or 0 stars option * * This codepen uses FontAwesome icons */
 #full-stars-example {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* set icon padding and size */
	/* set default star color */
	/* set color of none icon when unchecked */
	/* if none icon is checked, make it red */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
	/* make none icon grey on rating group hover */
	/* make none icon red on hover */
}
 #full-stars-example .rating-group {
	 display: inline-flex;
}
 #full-stars-example .rating__icon {
	 pointer-events: none;
}
 #full-stars-example .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #full-stars-example .rating__label {
	 cursor: pointer;
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #full-stars-example .rating__icon--star {
	 color: orange;
}
 #full-stars-example .rating__icon--none {
	 color: #eee;
}
 #full-stars-example .rating__input--none:checked + .rating__label .rating__icon--none {
	 color: red;
}
 #full-stars-example .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example .rating-group:hover .rating__label .rating__icon--star {
	 color: orange;
}
 #full-stars-example .rating__input:hover ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example .rating-group:hover .rating__input--none:not(:hover) + .rating__label .rating__icon--none {
	 color: #eee;
}
 #full-stars-example .rating__input--none:hover + .rating__label .rating__icon--none {
	 color: red;
}
 #half-stars-example {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* set icon padding and size */
	/* add padding and positioning to half star labels */
	/* set default star color */
	/* set color of none icon when unchecked */
	/* if none icon is checked, make it red */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
	/* make none icon grey on rating group hover */
	/* make none icon red on hover */
}
 #half-stars-example .rating-group {
	 display: inline-flex;
}
 #half-stars-example .rating__icon {
	 pointer-events: none;
}
 #half-stars-example .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #half-stars-example .rating__label {
	 cursor: pointer;
	/* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #half-stars-example .rating__label--half {
	 padding-right: 0;
	 margin-right: -0.6em;
	 z-index: 2;
}
 #half-stars-example .rating__icon--star {
	 color: orange;
}
 #half-stars-example .rating__icon--none {
	 color: #eee;
}
 #half-stars-example .rating__input--none:checked + .rating__label .rating__icon--none {
	 color: red;
}
 #half-stars-example .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #half-stars-example .rating-group:hover .rating__label .rating__icon--star, #half-stars-example .rating-group:hover .rating__label--half .rating__icon--star {
	 color: orange;
}
 #half-stars-example .rating__input:hover ~ .rating__label .rating__icon--star, #half-stars-example .rating__input:hover ~ .rating__label--half .rating__icon--star {
	 color: #ddd;
}
 #half-stars-example .rating-group:hover .rating__input--none:not(:hover) + .rating__label .rating__icon--none {
	 color: #eee;
}
 #half-stars-example .rating__input--none:hover + .rating__label .rating__icon--none {
	 color: red;
}
 #full-stars-example-two {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* hide 'none' input from screenreaders */
	/* set icon padding and size */
	/* set default star color */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
}
 #full-stars-example-two .rating-group {
	 display: inline-flex;
}
 #full-stars-example-two .rating__icon {
	 pointer-events: none;
}
 #full-stars-example-two .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #full-stars-example-two .rating__input--none {
	 display: none;
}
 #full-stars-example-two .rating__label {
	 cursor: pointer;
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #full-stars-example-two .rating__icon--star {
	 color: orange;
}
 #full-stars-example-two .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
	 color: orange;
}
 #full-stars-example-two .rating__input:hover ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 
	.ui-autocomplete li.ui-menu-item {
    font-size: 10px;
}
</style>



    </head>


    <body class="bg_gray">
        <?php include_once("../header.php");?>
		<?php if($_GET['msg']=='success'){?>
		<div class='alert alert-success' role='alert'>   
  Payment Successful
</div>
		<?php } ?>
		
        <!-- Modal for send a sms -->
        <div id="sendAsms" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 15px; ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Send a sms</h4>
                    </div>
                    <div class="row no-margin">
                        <!-- <div class="col-md-12 no-padding orgifo">
                            <label>Organizer Name (
                            <?php
                            $pro = new _spprofiles;
                            $result7 = $pro->read($OrganizerId);
                            if($result7 != false){
                                $row7 = mysqli_fetch_assoc($result7);
                                ?>
                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>"><?php echo $row7['spProfileName'];?></a>
                                <?php
                            }
                            ?>
                            )</label>
                        </div> -->
                    </div>
                    <form method="post" action="../friendmessage/sendSms.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                        <input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="<?php echo $_SESSION['pid'];?>">
                        <input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="<?php echo $OrganizerId;?>">
                        
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sp-post-edit">
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" name="spfriendChattingMessage"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn pull-right btnSendSms" <?php echo ($_SESSION['pid'] == $OrganizerId)?'disabled':'';?> id="sendEventSms" style="border-radius: 15px; ">Send Message</button>
                                    <button type="button" class="btn pull-right"  data-dismiss="modal" style="margin-right: 5px; border-radius: 15px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="main_box">            
            <div class="container">
             
                <div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
                    <div class="row">
                        <div class="col-md-12">
                            

								<div class="alert alert-danger" id="message" style="display:none;"></div>

						<div class="alert alert-success" id="span1" style="display:none;margin-top: -8px; " ><span>Payment Successful</span></div>

					<div class="col-md-12"> 
						<div class="col-md-6" style="border-right:1px solid #ddd;">
							<h4 align="left" >Payment Details</h4>
					

						  <form action="<?php echo $BaseUrl;?>/pos_payment/payment_recurring/payment.php?id=<?php echo $_GET['id'];?>" method="POST" id="paymentForm">	

							<div class="form-group">
								<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
								<input type="text" name="customerName" id="customerName" style="width:300px;" class="form-control" value="" required>
								<span id="errorCustomerName" class="text-danger"></span>
							</div>

							<div class="form-group">
								<label>Card Number <span class="text-danger">*</span></label>
								<input type="text" name="cardNumber" id="cardNumber" style="width:300px;" class="form-control" maxlength="20" onkeypress="">
								<span id="errorCardNumber" class="text-danger"></span>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>Expiry Month</label>
										<input type="text" name="cardExpMonth" style="width:110px;" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
										<span id="errorCardExpMonth" class="text-danger"></span>
									</div>
									<div class="col-md-3">
										<label>Expiry Year</label>
										<input type="text" name="cardExpYear" id="cardExpYear" style="width:110px;" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
										<span id="errorCardExpYear" class="text-danger"></span>
									</div>
									<div class="col-md-3">
										<label>CVC</label>
										<input type="text" name="cardCVC" id="cardCVC" style="width:90px;" class="form-control"  maxlength="3" onkeypress="return validateNumber(event);">
										<span id="errorCardCvc" class="text-danger"></span>
									</div>
								</div>
							</div>
							<br>
							<div align="left">
							<?php 
												$mb = new _spmembership;
                                    //$result = $mb->readmember($_GET['id']);
									$id = $_GET['id'];
                                     $us= new _pos; 
                                $result=$us->read_pos_customer_rand_no($id); 
                                    if ($result != false) {
											while ($row = mysqli_fetch_assoc($result)) { 
							                $untinprice =	$row['payment_amount'];
										//$ProTitle=$row['spMembershipName'];
												//print_r($row); 
									}}	?>
				<input type="hidden" name="rand_no" value="<?php echo $id;?>"> 
			    <input type="hidden" name="price" value="<?php echo $untinprice;?>">
				<input type="hidden" name="total_amount" value="<?php echo $untinprice;?>">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="item_details" value="<?php echo $ProTitle;?>">
				<button type="submit" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow" onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>

							<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
							</div>
							<br>
						</div>
					</form>

						<div class="col-md-6">
							<h4 align="center">Order Details</h4>
							<div class="table-responsive" id="order_table">
								<table class="table table-bordered table-striped">
									

									    <thead>
                                                   <tr>
                                                        <!--<th class="text-center">Membership Name</th>                                          
														<th class="text-center">Post Limit</th>-->
														<th class="text-center">Date</th>
                                                        <th class="text-center">Amount</th>
                                                     </tr>
                                                </thead>
                                                <tbody style="text-align: left;">
											<?php 
												$mb = new _spmembership;
                                    //$result = $mb->readmember($_GET['id']);
									
									$id = $_GET['id'];
                                 $us= new _pos; 
                                $result=$us->read_pos_customer_rand_no($id); 
									//print_r($result);
                                    if ($result != false) {
											while ($row = mysqli_fetch_assoc($result)) { 
								$duration=$row['spMembershipDuration'];
								/*if($row['spMembershipPostlimit']!=0){
										$membership_limit=$row['spMembershipPostlimit'];
								}
								else{
								$membership_limit="Unlimited";
								}*/
											//	print_r($row); 
												?>
													<tr>
													<!--<td class="text-center"><?php echo $row['spMembershipName'];?></td>
													<td class="text-center"><?php echo $membership_limit ?></td>-->
													<td class="text-center"><?php echo $row['date'];?></td>
													<td class="text-center"><?php echo $row['currency'];?>&nbsp;<?php echo $row['payment_amount'];?></td>
													</tr>
                                                   
													


												
                                                </tbody>
													<?php  }} ?>
										<tbody>
																				
										
										
									</tbody>
								</table>									
							</div>
						</div>
					</div>
					</div>
				
                               
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

       
        
        <?php include('postshare.php');?>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- image gallery script strt -->
        <script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
        <script type="text/javascript">
      
$(document).ready(function() {
  //alert();
	  $(".mySelect").select2();
  $('.submitevent').click(function() {
  //  alert();

var flagdesc = $('#flag_desc').val(); 
if (flagdesc == "" ){
$('#flagdesc_error').text("This Field is Required."); 
$("#flag_desc").focus();
 return false;

}else {
$("#addflagdata").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});
</script>
 <script type="text/javascript">
    
$('.thumbnail').magnificPopup({
  type: 'image'
  // other options
});




</script>   

 <script type="text/javascript">
function keyupflagfun() {

  var flagdesc= $("#flag_desc").val()

   if(flagdesc != "")
  {
    $('#flagdesc_error').text(" ");
  
  }
  
       
}
</script>       
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
            // Colorbox Call
            $(document).ready(function(){
                $("[rel^='lightbox']").prettyPhoto();
            });
			
				
			
			
			
        </script>
        <!-- image gallery script end -->
	</body>
</html> 
