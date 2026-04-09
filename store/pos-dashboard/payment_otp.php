<?php 
/*ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);*/
   include('../../univ/baseurl.php');
   include( "../../univ/main.php");
   session_start();
  // 
   
   if(!isset($_SESSION['pid'])){ 
   $_SESSION['afterlogin']="events/";
   include_once ("../../authentication/check.php");
   
   }else{
   function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
   }
   spl_autoload_register("sp_autoloader");
   
   
   require_once('../../stripe-php/encry_decrypt.php'); 
   $re = new _redirect;
   
   //die('==');
   $_GET["categoryID"] = "9";
   $_GET["categoryName"] = "Events";
   $header_event = "events";
   
   
   ?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <?php include('../../component/f_links.php');?>
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
      <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/paymentjs1.js"></script>
       
   </head>
   <body class="bg_gray">
      <?php include_once("../../header.php");?>
	  <?php
	  $p = new _pos; 
     $id=$_GET['id'];
//echo $id;
//die('==');	 
	  $vr=$p->read_peyment($id);
	  if($vr!=false){
	  $data=mysqli_fetch_assoc($vr);
	  }
	 // print_r($data);
	//  die('==');
	  ?>
	  
	  
	  
      <?php
	  $paymentMessage = '';
if(!empty($_POST['stripeToken'])){
   // die('==');
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
	
	
	
	 require_once('../../stripe-php/init.php'); 
	
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
		'description' =>  $ProTitle,
        'email' => $customerEmail,
        'source'  => $stripeToken,
		"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
    ));  
    // item details for which payment made
	$itemName = $_POST['item_details'];
	//$itemPrice = number_format($_POST['price'], 2, '.', '');
	//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
	$itemPrice = $_POST['price'];
	$totalAmount = $_POST['total_amount'];
	$currency = $_POST['currency_code'];
	$orderQty = $_POST['totalOrderQty'];
	$grid=$_POST['groupid'];
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
		$data=array('status'=>1);
		
		$p->update_status($data,$id);
		//die('==');
		
		?>
				<script>
  window.location.replace('<?php echo $BaseUrl?>/store/pos-dashboard/pos_payment_record.php?action=all&msg=message');
  </script>
		<?php
	}
	  
}
	  ?>
	  
	  <?php 
	  if(isset($_POST['submit'])){
		//print_r($_POST); die('-------'); 
       $us= new _pos; 
	 
	 $otp_code = $_POST['otp_code'];
	 $c_id = $_POST['c_id'];
	
     $status = 1;

$data1 = array("status" => $status);

if($_SESSION['code_opt'] == $otp_code ){	 

$us2=$us->update_status($data1,$c_id); 
$_SESSION['success'] = 1 ;

?>

<script>
  window.location.replace('<?php echo $BaseUrl?>/store/pos-dashboard/pos_sales_record.php?action=all&msg=success'); 
  </script>

<?php 
  
} else{
	$_SESSION['wrong'] = 5;
	
} 
	  }
	  
	  
	  
	  ?>
   
      <section class="main_box" style="padding: 129px;">
         <div class="container">
            
            <div class="bg_white detailEvent m_top_10  btn-border-radius">
			  <h4 align="left" style="margin-left: 95px;" >Please Enter The OTP</h4>
			<?php if(isset($_SESSION['wrong'])== 5){
				unset($_SESSION['wrong']);
				
				?>
			
			
			
			<div class="alert alert-danger" role="alert">
  You Entered wrong code!
               </div>

			<?php }
				?>
				
				<?php if($_SESSION['success'] == 1){
					
					unset($_SESSION['success']);
					unset($_SESSION['code_opt']);
					?>
			
			<div class="alert alert-success" role="alert">
  You Are verified!
               </div>

			<?php }
				?>
				
               <div class="row">
			   <form action="" method="post"> 
			   <div class="col-md-1"></div>
			   <div class="col-md-6">
			    <input type="hidden" name="c_id" value="<?php echo $_GET['id'];?>">
			    <div class="form-group">
                                    <label><b>OTP<span class="text-danger"></span></b></label>
                                    <input type="password" name="otp_code" id="otp_code" style="width:300px;" class="form-control" value="" required>
                                   
                                 </div>
								 
								 
			   
			   </div>
			   <div class="col-md-3 pull-left" style="margin-top: 15px;">
			   <button type="submit" class="btn btn-primary" name="submit">Submit</button>
			   </div> 
			   </form>
                 <!-- <div class="col-md-12">
                     <div class="titleEvent">
                        <div class="row">
                           <div class="col-md-10">
                              <div class="hostedbyevent">
                                 <h2 class="eventcapitalize">
                                    <?php
                                       if($tr_id && $paymentStatus == 'succeeded'){
                                       	echo "Payment <span>Successful</span>";
                                       }
                                       else
                                       {
                                       	echo "Order <span>Process</span>";
                                         }
                                       ?>	
                                 </h2>
                              </div>
                           </div>
          <div class="col-md-2" style="margin-top:30px;">
        &larr;<a style="text-decoration: underline;" href="<?php echo $BaseUrl ?>/store/pos-dashboard/index.php"> Return to Dashboard</a>
                           </div>
                        </div>
                     </div>
                     <div class="alert alert-danger" id="message" style="display:none;"></div>
                     <?php 
                        if($paymentMessage!="" && $paymentStatus != 'succeeded') {
                        ?>			
                     <div class="alert alert-danger">
                        <?php 
                           echo $paymentMessage; 
                           $paymentMessage = '';
                           ?>
                     </div>
                     <?php 
                        } elseif($tr_id && $paymentStatus == 'succeeded'){
                        ?>
                     <div class="alert alert-success">
                        <?php 
                           echo $paymentMessage; 
                           $paymentMessage = '';
                           ?>
                     </div>
                     <?php } ?>
                     <hr class="hrline">
                     <div class="row">
                        <?php
                           if($tr_id && $paymentStatus == 'succeeded'){
                           ?>   
                        <div class="col-md-12">
                           <div class="col-md-6" style="margin-bottom:50px;">
                              <a href="<?php echo $BaseUrl;?>/events/dashboard" class="btn create_add no-radius" style="background-color: #c11f50!important;    border: 1px solid #c11f50 !important;">Go to dashboard</a>
                           </div>
                        </div>
                        <?php
                           }
                           else
                           {
                           
                           
                           ?>
                        <div class="col-md-12">
                           <div class="col-md-6" style="border-right:1px solid #ddd;">
                              <h4 align="left" >Payment Details</h4>
                              <?php
                                 ?>
                          
                         <form action="<?php echo $BaseUrl;?>/store/pos-dashboard/peyment.php?id=<?php echo $_GET['id'];?>" method="POST" id="paymentForm">	
                              
                 
                                
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
                                 <div align="left">
                                    <input type="hidden" name="price" value="<?php echo $data['total_by_net'];?>">
                                    <input type="hidden" name="total_amount" value="<?php echo $data['total_by_net'];?>">
                                    <input type="hidden" name="currency_code" value="<?php echo "USD";?>">
                                    <input type="hidden" name="item_details" value="<?php echo "text";?>">
                                    <button type="submit" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay(event)" value="Pay Now">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>
                                    
                                 </div>
                                 <br>
                           </div>
                           </form>
                           <div class="col-md-6">
                              <h4 align="center">Order Details</h4>
                              <div class="table-responsive" id="order_table">
                                 <table class="table table-bordered table-striped">
                                    <form action="<?php echo $BaseUrl;?>/events/event-payment.php?postid=<?php echo $_GET['postid'];?>" method="POST" onsubmit="return checkqty();">
                                       <thead>
                                          <tr>
                                             <!--<th>Ticket Type</th>
                                             <th>Quantity</th>-->
                      <!--  <th style="text-align:right;">Price</th>
                       <th style="text-align:right;">Total</th>
                                          </tr>
                                       </thead>
                                       <tbody style="text-align: left;">
                                          <tr>
                                             <!--<td></td>
                                             <td align="right"><button type="submit" class="btn butn_submit_real" style="border-radius: 25px;margin-left:5px;min-width:50px;" >UPDATE</button></td>-->
                                             <!-- <td align="right">Sub Total</td>
                                             <td align="right"><strong><?php echo $data['currency'];?> <?php echo $data['total_by_net'];?></strong></td>
                                          </tr>
                                          <?php
                                             if($notax==0)
                                             {
                                             ?>
                                          <tr>
                                             <td colspan="" align="right">Tax</td>
                                             <td align="right"><strong><?php echo $curr.' '.round($data['total_tax'],2);?></strong></td>
                                          </tr>
                                          <?php
                                             $totalval = $subtotal + $taxamount;
                                             }
                                             else
                                             {
                                             	$totalval = $subtotal;
                                              }
                                             ?>
                                          <tr>
                                             <td colspan="" align="right">Total</td>
                                             <td align="right"><strong><?php echo $data['currency'];?> <?php echo $data['Gross_net'];?></strong></td>
                                          </tr>
                                    </form>
                                    </tbody>
                                    
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        ?>
                  </div>--> 
               </div>
            </div>
         </div>
         </div>
      </section>
      
      
      <?php 
         include('../../component/f_footer.php');
         include('../../component/f_btm_script.php'); 
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
         $(function() {
         
           $("#customerName").keydown(function (e) {
           
             if (e.shiftKey || e.ctrlKey || e.altKey) {
             
               e.preventDefault();
               
             } else {
             
               var key = e.keyCode;
               
               if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
               
                 e.preventDefault();
                 
               }
         
             }
             
           });
           
         });
         });
      </script>
      <script type="text/javascript">
         /*$('.thumbnail').magnificPopup({
           type: 'image'
           // other options
         });*/
      </script>   
      <script type="text/javascript">
         /*function keyupflagfun() {
         
           var flagdesc= $("#flag_desc").val()
         
            if(flagdesc != "")
           {
             $('#flagdesc_error').text(" ");
           
           }
           
                
         }*/
         
      </script>       
      
   </body>
</html>
<?php
   }
   
   ?>