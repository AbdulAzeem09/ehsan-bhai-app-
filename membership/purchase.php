<?php
	include('../univ/baseurl.php');
	session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "membership/";
    include_once ("../authentication/check.php");
    
}else{

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
			$res = $m->readmember($rows["spMembership_idspMembership"]);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				//echo $row["spMembershipName"]."<br>";
				$count=$row["spMembershipPostlimit"]."<br>";
				$duration=$row["spMembershipDuration"];
				
			}
		}
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
?>

<?php

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
												
												
													try{
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
													$payDetails = \Stripe\Charge::create(array(
													'customer' => $customer->id,
													'amount'   => $totalAmount*100,
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
												
												
												
												if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
													// die('---------');
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
													
													
												}
												
												
}

?>

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
										

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('../component/f_links.php');?>
	    
 	</head>
	<body class="bg_gray" >
		<?php  include_once("../header.php"); ?>
		<br>
		<div class="container"  >
			<div class="row">
				<div class="col-md-12">
				<!-- payment system-->
				 <div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
				<div class="row">
				    	<div class="col-md-12">
						<div class="col-md-6" style="border-right:1px solid #ddd;">
							<h4 align="left" >Payment Details</h4>
							

						  <form action="<?php echo $BaseUrl;?>/membership/purchase.php?postid=<?php echo $_GET['id'];?>" method="POST" id="paymentForm">	

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
										<input type="text" name="cardCVC" id="cardCVC" style="width:90px;" class="form-control"  maxlength="4" onkeypress="return validateNumber(event);">
										<span id="errorCardCvc" class="text-danger"></span>
									</div>
								</div>
							</div>
							<br>
							<div align="left">
							<input type="hidden" name="totalOrderQty" value="<?php echo $totalqty;?>">
							<input type="hidden" name="price" value="<?php echo $untinprice;?>">
							<input type="hidden" name="total_amount" value="<?php echo $totalPrice;?>">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="item_details" value="<?php echo $ProTitle;?>">
							 <button type="submit" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>

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
                                                        <th class="text-center">Membership Name</th>                                          
														<th class="text-center">Post Limit</th>
														<th class="text-center">Duration</th>
                                                        <th class="text-center">Price</th>
                                                     </tr>
                                                </thead>
                                                <tbody style="text-align: left;">
												<?php 
												$mb = new _spmembership;
                                    $result = $mb->readmember($_GET['id']);
                                    if ($result != false) {
											while ($row = mysqli_fetch_assoc($result)) { 
								
											//	print_r($row); 
												?>
													<tr>
													<td class="text-center"><?php echo $row['spMembershipName'];?></td>
													<td class="text-center"><?php echo $row['spMembershipPostlimit'];?></td>
													<td class="text-center"><?php echo $row['spMembershipDuration'];?></td>
													<td class="text-center"><?php echo $row['spMembershipAmount'];?></td>
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
					<!-- end payment system-->
				</div>
			</div>
		
		    <!--Pop-up Box for contact form-->
	
		
		<!--Done-->
		</div> <br><br>

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
		
		
	</body>	
</html>
<?php
}
?>