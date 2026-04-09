<?php 
        include('../univ/baseurl.php');
    include( "../univ/main.php");
    session_start();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    

        require_once('../stripe-php/encry_decrypt.php'); 
   
      

///////// start code for stripe payment request , response////////////

$paymentMessage = '';
if(!empty($_POST['stripeToken'])){
    
    //print_r($_POST);die;
    // get token and user details
    $stripeToken  = $_POST['stripeToken'];
    $customerName = $_POST['customerName'];
    $cardNumber = $_POST['cardNumber'];
    $cardCVC = $_POST['cardCVC'];
    $cardExpMonth = $_POST['cardExpMonth'];
    $cardExpYear = $_POST['cardExpYear']; 
    $cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;
 
    $cardDetails = PHP_AES_Cipher::encrypt($encrypt_key, $encrypt_iv, $cardString);

      $u = new _spuser;
            $resultbok = $u->read($_SESSION['uid']);    
                 if ($resultbok != false) {

                        $bookedbuy = mysqli_fetch_array($resultbok);

                        $customerEmail =     $bookedbuy['spUserEmail'];
                        $customerAddress =   $bookedbuy['spUserAddress'];
                        $customerZipcode =   $bookedbuy['spUserzipcode'];
                        $customerFname =   $bookedbuy['spUserFirstName'];
                        $customerLname =   $bookedbuy['spUserLastName'];

                        $country_code =   $bookedbuy['spUserCountry'];
                        $state_code =   $bookedbuy['spUserState'];
                        $city_code =   $bookedbuy['spUserCity'];
                        $userCurrentTotalpoint =   $bookedbuy['spUserTotalPoints'];

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
    //add customer to stripe
    $customer = \Stripe\Customer::create(array(
        'name' => $customerName,
        'description' =>  'test',
        'email' => $customerEmail,
        'source'  => $stripeToken,
        "address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
    ));  
    // item details for which payment made
	
	$id=$_POST['duration'];
//echo $id;die;
		$post= new _businessrating;
		$p1=$post->read_duration_price($id);
	
	if($p1!=false){
	
	$p2=mysqli_fetch_assoc($p1);
	 $duration=$p2['duration'];
	 $price=$p2['price'];
	
		$expDate = date('Y-m-d', strtotime("+ $duration"));
	}
	
	
    $itemName = $_POST['item_details'];
    //$itemPrice = number_format($_POST['price'], 2, '.', '');
    //$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
    $itemPrice = $price;
    $totalAmount = $price;
    $currency = $_POST['currency_code'];
    $orderQty = 1;
   // $grid=$_POST['groupid'];
    $orderNumber ="WER12345";   
    
    // details for which payment performed
    $payDetails = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $totalAmount*100,
        'currency' => $currency,
        'description' => $itemName,
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



    //print_r($payDetails);
    // get payment details
    
    //echo "<pre>";
    //print_r($paymenyResponse);
    //exit;
    // check whether the payment is successful
    if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
        
              $arr= array("status"=>1,"duration"=>$duration,"price"=>$price,"exp_date"=>$expDate);
			  $post->update_business($arr,$_GET['id']);
                                              

                                                 

        /////////////end code  //////////////////

        // transaction details 
        $amountPaid = $paymenyResponse['amount'];
        $balanceTransaction = $paymenyResponse['balance_transaction'];
        $paidCurrency = $paymenyResponse['currency'];
        $paymentStatus = $paymenyResponse['status'];
        $payer_id = $paymenyResponse['customer'];
        //$payer_status = $paymenyResponse['outcome']['type'];
        $paymentDate = date("Y-m-d H:i:s");     
        

     
  
   
  
    
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


        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
         <link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
          <script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

          <script>

          Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');

        
        </script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/paymentjs1.js"></script>

    
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <!-- Modal for send a sms -->
        <style>
		
		
		.row .price-cls{
				padding-left: unset; 
				padding-right: unset; 
				border: 1px solid #c3c0c0;
				}
				.price {
				list-style-type: none;
				border: 1px solid #eee;
				margin: 0;
				padding: 0;
				-webkit-transition: 0.3s;
				transition: 0.3s;
				}
				
				.price .header {
				background-color: #7DBA41;
				color: white;
				font-size: 25px;
				}
				
				.price li {
				border-bottom: 1px solid #eee;
				
				text-align: center;
				}
				
				.price .grey {
				background-color: #eee;
				font-size: 38px;
				}
				section {
				padding: 50px ;
				max-width: 900px;
				margin: 30px auto;
				background:white;
				background:rgba(255,255,255,0.9);
				backdrop-filter:blur(10px);
				box-shadow:0px 2px 10px rgba(0,0,0,0.3);
				border-radius:5px;
				transition:transform 0.2s ease-in-out;
				}
				.expiry-date-group {
				float: left;
				width: 50%
				}
				
				.expiry-date-group input {
				width: calc(100% + 1px);
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
				}
				
				.expiry-date-group input:focus {
				position: relative;
				z-index: 10;
				}
				
				.security-code-group {
				float: right;
				width: 50%
				}
				
				.security-code-group input {
				border-top-left-radius: 0;
				border-bottom-left-radius: 0;
				}
				input[type="radio"], input[type="checkbox"] {
				margin: 3px 0px -16px !important;
				margin-top: 1px \9;
				line-height: normal;
				}
				input {
				width: 100%;
				
				display: inline-block;
				
				
				border-radius: 5px;
				border: 1px solid lightgrey;
				font-size: 1em;
				font-family:inherit;
				background:white;
				}
		</style>
		<span class="float-left" style="margin-left:50px;">
			<a href="<?php echo $BaseUrl?>/business_for_sale/edit_business.php?postid=<?php echo $_GET['id']?>&draft=1" style="font-size:20px;">Back</a>
		</span>
       <section>
	  
	   <?php if($_GET['id']){?>
	   <form action="payment.php?id=<?php echo $_GET['id']?>" method="post" novalidate enctype="multipart/form-data" id="paymentForm">
	   <?php }else{?>
	    <form action="payment.php" method="post" novalidate enctype="multipart/form-data" id="paymentForm">
	   <?php } ?>
								<!-- <div class=""> -->
								
								<div class="row">
									<?php 
										
										$sa = new _businessrating;
										$sal = $sa->read_duration();
										//print_r($sal);
										$i=1;
										if($sal!=false){
											while($row=mysqli_fetch_assoc($sal)){
												$duration=$row['duration'];
												$price=$row['price'];
												
												
											?>
											<div class="col-md-4 price-cls">
												<div>
													<ul class="price">
														<li class="header"><input type="radio" id="radio1" name="duration" value="<?php echo $i;?>" checked style="height:40px;"><br><br><br><span><?php echo $row['duration'];?></span></li>
														<li class="grey"> <span style="margin-top: 5px;"> <?php echo 'USD '.$row['price'];?> </span></li>
														<!--<li class="grey zoom1"><a href="#" class="button" style="background-color: #eb6f33; border-radius: 30px;"></a></li>-->
													</ul>
												</div>
											</div>
											<?php $i++;}
											
										}?>
										</div><br>
									
        <div class="form-group">
                                <label><b>Card Holder Name <span class="text-danger">*</span></b></label>
                                <input type="text" name="customerName" id="customerName" style="width:300px;" class="form-control" value="" required>
                                <span id="errorCustomerName" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label>Card Number <span class="text-danger">*</span></label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="cardNumber" id="cardNumber" style="width:300px;" class="form-control" maxlength="20" >
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
                           
                            
                            
                            
                            <input type="hidden" name="groupid" value="11">
                            <input type="hidden" name="totalOrderQty" value="5">
                            <input type="hidden" name="price" value="44">
                            <input type="hidden" name="total_amount" value="55">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="item_details" value="aaaa">
                             <button type="submit" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow" onclick="stripePay(event)" value="Pay Now">
                             <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Publish & Pay</button>
		

                            <br>
                        </div> 
                    </form>
    
							</section>
              
                                
                         
       
  
        
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- image gallery script strt -->
        <script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
      
 
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
<?php
}

?>