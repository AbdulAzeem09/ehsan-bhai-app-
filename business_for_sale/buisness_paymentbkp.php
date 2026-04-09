<?php
		include('../univ/baseurl.php');
	include( "../univ/main.php");
    session_start();
ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    

	    require_once('../stripe-php/encry_decrypt.php'); 
		
	
	$data= array(
		"uid"=>$_SESSION['uid'],
		"pid"=>$_SESSION['pid'],
		"business_type"=>$_POST['Type'],
		"business_status"=>$_POST['Status'],
		"business_category"=>$_POST['category'],
		"business_hours"=>$_POST['business_hours'],
		"business_days"=>$_POST['business_days'],
		"business_operation"=>$_POST['business_operation'],
		"year_established"=>$_POST['year'],
		"listing_headline"=>$_POST['headline'],
		"description"=>$_POST['description'],
		"website_address"=>$_POST['website_address'],
		"country"=>$_POST['country'],
		"state"=>$_POST['state'],
		"city"=>$_POST['city'],
		"location"=>$_POST['Location'],
		"city_expansion"=>$_POST['City_expansion'],
		"business_size"=>$_POST['business_size'],
		"real_state_included"=>$_POST['real_estate'],
		"inventory_includes"=>$_POST['inventory'],
		"includes_furnitures"=>$_POST['furniture_fixture'],
		"furniture_value"=>$_POST['furniture_fix'],
		"sale_software"=>$_POST['sale_software'],
		"sales_revenue"=>$_POST['sales_revenue'],
		"cash_flow"=>$_POST['cash_flow'],
		"competition"=>$_POST['competition'],
		"training_support"=>$_POST['training_support'],
		"lease_per_month"=>$_POST['lease'],
		"selling_reason"=>$_POST['selling_reason'],
		"inventory_amount"=>$_POST['inventory_amount'],
		"duration"=>$_POST['duration']
		
		);
		//"sale_file"=>$_FILES['sale_file']['name'];
		$post= new _businessrating;
		$posting= $post->create_business($data);
		
		
		
		$count =count($_FILES['sale_file']);
		
		for($i=0;$i<$count;$i++)
		{
		
	$name = $_FILES['sale_file']['name'][$i];
	
$tmp_name = $_FILES['sale_file']["tmp_name"][$i];	
move_uploaded_file($tmp_name,  "uploads/".$name);
		}

	die("1111111");
	
		
		
		
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		die("77777");
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

                        $customerEmail =	 $bookedbuy['spUserEmail'];
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


		
    if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
        
		 $amountPaid = $paymenyResponse['amount'];
        $balanceTransaction = $paymenyResponse['balance_transaction'];
        $paidCurrency = $paymenyResponse['currency'];
        $paymentStatus = $paymenyResponse['status'];
		$payer_id = $paymenyResponse['customer'];
		//$payer_status = $paymenyResponse['outcome']['type'];
        $paymentDate = date("Y-m-d H:i:s");   
		
		
		
	}
}
}