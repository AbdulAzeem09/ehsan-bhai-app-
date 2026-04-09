<?php

include('../univ/baseurl.php');
include("../univ/main.php");
include("../helpers/image.php");
session_start();
ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "events/";
	include_once("../authentication/check.php");
} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	require_once('../stripe-php/encry_decrypt.php');
	$post = new _businessrating;

	//else{

    $image = new Image();
    $image->validateFileImageExtensions($_FILES['sale_file']);
    if ($fileValidationResult !== null) {
      echo "<script>alert('$fileValidationResult');</script>";
      echo "<script>window.history.back();</script>";
       exit;
    }
	$paymentMessage = '';
	
	$sa = new _businessrating;
	$sal = $sa->read_duration_price_payment($_POST['duration']);
	$row=mysqli_fetch_assoc($sal);
	$payment_price=$row['price'];


	if (!empty($_POST['stripeToken'])) {

		//print_r($_POST);die;
		// get token and user details
		$stripeToken  = $_POST['stripeToken'];
		$customerName = $_POST['customerName'];
		$cardNumber = $_POST['cardNumber'];
		$cardCVC = $_POST['cardCVC'];
		$cardExpMonth = $_POST['cardExpMonth'];
		$cardExpYear = $_POST['cardExpYear'];
		$cardString = strtolower($customerName) . "||" . $cardNumber . "||" . $cardExpMonth . "||" . $cardExpYear . "||" . $cardCVC;

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
			if ($result3 && $result3->num_rows > 0) {
				$row3 = mysqli_fetch_assoc($result3);
				$customerCountry = $row3['country_title'];
			} else {
				$customerCountry = "";
			}
			// CITY NAME
			$ci = new _city;
			$result4 = $ci->readCityName($city_code);
			if ($result4) {
				$row4 = mysqli_fetch_assoc($result4);
				$customerCity = $row4['city_title'];
			} else {
				$customerCity = "";
			}

			$st = new _state;
			$result5 = $st->readStateName($state_code);
			if ($result5) {
				$row5 = mysqli_fetch_assoc($result5);
				$customerState = $row5['state_title'];
			} else {
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

		try {
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
			$itemPrice = $payment_price;
			$totalAmount = $payment_price;
			$currency = $_POST['currency_code'];
			$orderQty = $_POST['totalOrderQty'];
			$grid = $_POST['groupid'];
			$orderNumber = "WER12345";

			// details for which payment performed
			$payDetails = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $totalAmount * 100,
				'currency' => $currency,
				'description' => $itemName,
				'metadata' => array(
					'order_id' => $orderNumber
				)
			));

			$paymenyResponse = $payDetails->jsonSerialize();
		} catch (Error\Card $e) {

			$paymentMessage = 'Your card was declined ' . $e->getMessage() . 'card_declined ' . $e->getStripeCode() . 'generic_decline ' . $e->getDeclineCode() . 'exp_month ' . $e->getStripeParam();
		} catch (Error\InvalidRequest $e) {

			$paymentMessage = "<strong>" . ucfirst($e->getStripeParam()) . "</strong> " . $e->getMessage();
		} catch (\Exception $e) {
			$paymentMessage = "<strong>" . ucfirst($e->getStripeParam()) . " </strong> " . $e->getMessage();
		}



		if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {




			$id = $_POST['duration'];


			$p1 = $post->read_duration_price($id);

			if ($p1 != false) {

				$p2 = mysqli_fetch_assoc($p1);
				$duration = $p2['duration'];
				$price = $p2['price'];

				$expDate = date('Y-m-d', strtotime("+ $duration"));
			}

			$data = array(
				"uid" => $_SESSION['uid'],
				"pid" => $_SESSION['pid'],
				"business_type" => $_POST['Type'],
				"business_status" => $_POST['Status'],
				"business_category" => $_POST['category'],
				"business_hours" => $_POST['business_hours'],
				"business_days" => $_POST['business_days'],
				"business_operation" => $_POST['business_operation'],
				"year_established" => $_POST['year'],
				"listing_headline" => $_POST['headline'],
				"description" => $_POST['description'],
				"website_address" => $_POST['website_address'],
				"country" => $_POST['country'],
				"state" => $_POST['state'],
				"city" => $_POST['city'],
				"location" => $_POST['Location'],
				"city_expansion" => $_POST['City_expansion'],
				"business_size" => $_POST['business_size'],
				"real_state_included" => $_POST['real_estate'],
				"inventory_includes" => $_POST['inventory'],
				"includes_furnitures" => $_POST['furniture_fixture'],
				"furniture_value" => $_POST['furniture_fix'],
				"sale_software" => $_POST['sale_software'],
				"sales_revenue" => $_POST['sales_revenue'],
				"cash_flow" => $_POST['cash_flow'],
				"competition" => $_POST['competition'],
				"training_support" => $_POST['tr_support'],
				"lease_per_month" => $_POST['lease'],
				"selling_reason" => $_POST['selling_reason'],
				"inventory_amount" => $_POST['inventory_amount'],
				"status" => 1,
				"duration" => $duration,
				"price" => $price,
				"created_date" => date('Y-m-d'),
				"exp_date" => $expDate


			);
			//"sale_file"=>$_FILES['sale_file']['name'];

			$posting = $post->create_business($data);



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
			$admin_commission=($payment_price*$per)/100;
			
			
			$ss = $u->get_super_vip();
			$super_commission = mysqli_fetch_assoc($ss); 
			$sale_commission=$super_commission['sale_comm'];
			$total_sale_commission=($admin_commission*$sale_commission)/100;

				$data = array(
					"purchaser_user_id"=>$_SESSION['uid'] ,
					"purhcaser_pid"=>$_SESSION['pid'],
					"purcahse_amount"=>$payment_price,
					"mycommsion"=>$sale_commission,
					"refred_user"=>$used_ref_id,
					"module"=>'Business',
					"sale_type"=>'sale',
					"currency"=>$currency,
					"date"=>$date,
					"spadmin_commission"=> $admin_commission,
					"spuser_commission"=> $total_sale_commission
			
					);
					$commission = $mb->create_comm($data);
			
			



			
$balanceTransaction = $paymenyResponse['balance_transaction'];
$cur = new _currency;

$fromCurrency=$currency;
$toCurrency="USD";
$amount=$payment_price;

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
  "uid"=>$_SESSION['uid'],
  "spUser_idspUser"=>$ArtistId,
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
	"uid"=>$used_ref_id,
	"spUser_idspUser"=>$ArtistId,
	"spPointComment"=>'Referred User Purchased',
	"spPoint_type"=>'D'
  );

  $rr = new _spPoints;

$last_id = $rr->create_point($data); 






			if (!empty($_FILES['sale_file'])) {

				$count = count($_FILES['sale_file']);

				for ($i = 0; $i < $count - 1; $i++) {

					$name = $_FILES['sale_file']['name'][$i];

					$tmp_name = $_FILES['sale_file']["tmp_name"][$i];
					move_uploaded_file($tmp_name,  "uploads/" . $name);
					$files = array("postid" => $posting, "filename" => $name);
					$fi = $post->create_business_files($files);
				}
				//header("Location: $BaseUrl/business_for_sale/dashboard/all_listing.php");
			}


			if (!empty($_FILES['supp_file'])) {

				$count = count($_FILES['supp_file']);

				for ($i = 0; $i < $count - 1; $i++) {

					$name = $_FILES['supp_file']['name'][$i];

					$tmp_name = $_FILES['supp_file']["tmp_name"][$i];
					move_uploaded_file($tmp_name,  "uploads/" . $name);
					$files = array("postid" => $posting, "filename" => $name);
					$fi = $post->create_business_support_files($files);
				}
			}

			$amountPaid = $paymenyResponse['amount'];
			$balanceTransaction = $paymenyResponse['balance_transaction'];
			$paidCurrency = $paymenyResponse['currency'];
			$paymentStatus = $paymenyResponse['status'];
			$payer_id = $paymenyResponse['customer'];
			//$payer_status = $paymenyResponse['outcome']['type'];
			$paymentDate = date("Y-m-d H:i:s");


			header("Location: $BaseUrl/business_for_sale/dashboard/active_listing.php?pay=payment1");
		}
	} else {


		if (isset($_POST['draft'])) {
			$id = $_POST['duration'];

			$p1 = $post->read_duration_price($id);

			if ($p1 != false) {

				$p2 = mysqli_fetch_assoc($p1);
				$duration = $p2['duration'];
				$price = $p2['price'];

				$expDate = date('Y-m-d', strtotime("+ $duration"));
			}

			$arr = array(
				"uid" => $_SESSION['uid'],
				"pid" => $_SESSION['pid'],
				"business_type" => $_POST['Type'],
				"business_status" => $_POST['Status'],
				"business_category" => $_POST['category'],
				"business_hours" => $_POST['business_hours'],
				"business_days" => $_POST['business_days'],
				"business_operation" => $_POST['business_operation'],
				"year_established" => $_POST['year'],
				"listing_headline" => $_POST['headline'],
				"description" => $_POST['description'],
				"website_address" => $_POST['website_address'],
				"country" => $_POST['country'],
				"state" => $_POST['state'],
				"city" => $_POST['city'],
				"location" => $_POST['Location'],
				"city_expansion" => $_POST['City_expansion'],
				"business_size" => $_POST['business_size'],
				"real_state_included" => $_POST['real_estate'],
				"inventory_includes" => $_POST['inventory'],
				"includes_furnitures" => $_POST['furniture_fixture'],
				"furniture_value" => $_POST['furniture_fix'],
				"sale_software" => $_POST['sale_software'],
				"sales_revenue" => $_POST['sales_revenue'],
				"cash_flow" => $_POST['cash_flow'],
				"competition" => $_POST['competition'],
				"training_support" => $_POST['tr_support'],
				"lease_per_month" => $_POST['lease'],
				"selling_reason" => $_POST['selling_reason'],
				"inventory_amount" => $_POST['inventory_amount'],
				"status" => 4,
				"duration" => $duration,
				"price" => $price,
				"created_date" => date('Y-m-d'),
				"exp_date" => $expDate


			);
			$pst = $post->save_as_draft($arr);

			//header("Location: $BaseUrl/business_for_sale/dashboard/all_listing.php");




			//$posting= $post->create_business($data);



			if (!empty($_FILES['sale_file'])) {

				$count = count($_FILES['sale_file']['name']);

				for ($i = 0; $i < $count - 1; $i++) {

					$name = $_FILES['sale_file']['name'][$i];

					$tmp_name = $_FILES['sale_file']["tmp_name"][$i];
					move_uploaded_file($tmp_name,  "uploads/" . $name);
					$files = array("postid" => $pst, "filename" => $name);
					$fi = $post->create_business_files($files);
				}
			}


			if (!empty($_FILES['supp_file'])) {

				$count = count($_FILES['supp_file']['name']);


				for ($i = 0; $i < $count - 1; $i++) {

					$name = $_FILES['supp_file']['name'][$i];

					$tmp_name = $_FILES['supp_file']["tmp_name"][$i];
					move_uploaded_file($tmp_name,  "uploads/" . $name);
					$files = array("postid" => $pst, "filename" => $name);
					$fi = $post->create_business_support_files($files);
				}
			}
			header("Location: $BaseUrl/business_for_sale/dashboard/draft.php");
		}
	}
	//}
}
