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
   
       //print_r($_POST);die('=====00');

///////// start code for stripe payment request , response////////////
$postid=$_POST['postid'];
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

if(isset($_POST['cardDetails'])){
										$carddetails=array("customerName"=>$_POST[        'customerName'],
										"cardNumber"=>$_POST['cardNumber'],
										"cardExpMonth"=>$_POST['cardExpMonth'],
										"cardExpYear"=>$_POST['cardExpYear'],
										"cardCVC"=>$_POST['cardCVC']
														
														
														);
								$u->updatecarddetails($carddetails,$_SESSION['uid']);
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
	
	$price=$_POST['total_amount'];
	
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
        
              
                                              

	 


        /////////////end code  //////////////////

        // transaction details 
        $amountPaid = $paymenyResponse['amount'];
        $balanceTransaction = $paymenyResponse['balance_transaction'];
        $paidCurrency = $paymenyResponse['currency'];
        $paymentStatus = $paymenyResponse['status'];
        $payer_id = $paymenyResponse['customer'];
        //$payer_status = $paymenyResponse['outcome']['type'];
        $paymentDate = date("Y-m-d H:i:s");
		
		  $data=array("seller_uid"=>$_POST['seller_uid'],
	   "seller_pid"=>$_POST['seller_pid'],
	   "buyer_pid"=>$_POST['buyer_pid'],
	   "buyer_uid"=>$_POST['buyer_uid'],
	   "currency"=>$_POST['currency_code'],
	   "price"=>$price,
	   "txn_number"=>$balanceTransaction,
	   "txn_date"=>$paymentDate,
	   "postid"=>$_POST['postid'],
	   );  
		
		
		$p= new _postings;
     $p->training_payment($data);

     $u = new _spuser;
     $mb = new _spmembership;
     
     
     $resultbok_1 = $u->read_reffer($_SESSION['uid']);	
     if($resultbok_1){
     $refer = mysqli_fetch_assoc($resultbok_1 ); 
     }
     $used_code= $refer['refferalcodeused']; 
      $used_refer_id=$refer['idspUser'];
     
     $resultbok_2 = $u->user_reffer_code($used_code);	
     if($resultbok_2){
     $rr = mysqli_fetch_assoc($resultbok_2 ); 
     }
     $name_1=$rr['spUserName'];
     $used_ref_id=$rr['idspUser'];
     
     $super_vip = $mb->super_vip1($used_refer_id);
     $vip_com = $mb->vip_com($used_refer_id);
     
     date_default_timezone_set('Asia/Kolkata');
     
     $date=date("Y-m-d h:i:s");
     
     
     $admin = $u->get_admin_commission();
     $admin_com = mysqli_fetch_assoc($admin); 
     $per=$admin_com['comm_amt'];
     $admin_commission=($_POST['total_amount']*$per)/100;
     
     
     $ss = $u->get_super_vip();
     $super_commission = mysqli_fetch_assoc($ss); 
     $sale_commission=$super_commission['sale_comm'];
     $total_sale_commission=($admin_commission*$sale_commission)/100;
     




         $data = array(
             "purchaser_user_id"=>$_SESSION['uid'] ,
             "purhcaser_pid"=>$_SESSION['pid'],
             "purcahse_amount"=>$_POST['total_amount'],
             "mycommsion"=>$sale_commission,
             "refred_user"=>$used_ref_id,
             "module"=>'training',
             "sale_type"=>'sale',
             "currency"=>$currency,
             "date"=>$date,
             "spadmin_commission"=> $admin_commission,
             "spuser_commission"=> $total_sale_commission
     
             );
             $commission = $mb->create_comm($data);
     


     $cur = new _currency;

     $fromCurrency=$currency;
     $toCurrency="USD";
     $amount=$_POST['total_amount'];
     $balanceTransaction = $paymenyResponse['balance_transaction'];
     $detail = $cur->convert_Currency($fromCurrency,$toCurrency,$amount);
     $point=round($detail['convertedAmount'], 0);
     date_default_timezone_set('Asia/Kolkata');
     
     $date=date("Y-m-d h:i:s");
     //print_r($detail );die('====33');


     $resultbok_1 = $u->read_reffer($_SESSION['uid']);	
     if($resultbok_1){
     $refer = mysqli_fetch_assoc($resultbok_1 ); 
     }
     $used_code= $refer['refferalcodeused']; 
      $used_refer_id=$refer['idspUser'];
     
     $resultbok_2 = $u->user_reffer_code($used_code);	
     if($resultbok_2){
     $rr = mysqli_fetch_assoc($resultbok_2 ); 
     }
     $name_1=$rr['spUserName'];
     $used_ref_id=$rr['idspUser'];
     $sppoint_buyer = ($point*80)/100;

     $sppoint_refred = ($point*20)/100;


     
     $data = array(
     
       "payment_id"=>$balanceTransaction,
       "spProfile_idspProfile"=>$_SESSION['pid'],
       "pointAmount"=>$sppoint_buyer,
       "pointBalance"=>$sppoint_buyer,
       "pointDate"=>$date,
       "spUser_idspUser"=>$ArtistId,
       "uid"=>$_SESSION['uid'],
       "spPointComment"=>'Purchase',
       "spPoint_type"=>'D'
     );
     $rr = new _spPoints;
     
     $last_id = $rr->create_point($data); 



     $data = array(
     
        "payment_id"=>$balanceTransaction,
        "spProfile_idspProfile"=>'0',
        "pointAmount"=>$sppoint_refred,
        "pointBalance"=>$sppoint_refred,
        "pointDate"=>$date,
        "spUser_idspUser"=>$ArtistId,
        "uid"=>$used_ref_id,
        "spPointComment"=>'Referred User Purchased',
        "spPoint_type"=>'D'
      );


      $rr = new _spPoints;
     
      $last_id = $rr->create_point($data); 
 

        
		  $wallet=array("seller_userid"=>$_POST['seller_uid'],
	   "buyer_userid"=>$_POST['buyer_uid'],
	  
	   "amount"=>$price,
	   "balanceTransaction"=>$balanceTransaction,
	   "date_txn"=>$paymentDate,
	   "orderid"=>$_POST['postid'],
	   ); 
		
		
		
		
		
		
		
		$p->training_payment_wallet($wallet);



}


}
}
header("Location:$BaseUrl/trainings/?msg=success");
///////// end code for stripe payment request , response////////////
?>