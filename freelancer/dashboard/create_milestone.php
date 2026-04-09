<?php 

  session_start();
 // print_r($_SESSION);
date_default_timezone_set("Asia/Kolkata");
	include('../../univ/baseurl.php');
	include('../../univ/main.php');


	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}

$freelancer_pid = $_POST['freelancer_profileid'];
$projrctid = $_POST['freelancer_projectid'];
//echo $freelancer_pid;
//die("===================");
	spl_autoload_register("sp_autoloader");
	
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
require_once('../../stripe-php/init.php'); 

//set stripe secret key and publishable key
$stripe = array(
"secret_key"      => SECRET_KEY,
"publishable_key" => PUBLIC_KEY
);    
\Stripe\Stripe::setApiKey($stripe['secret_key']);    


	try {  //die("yyyyyyyyyyyyyyyyyyyyyy");
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
	//echo $currency; die(",,,,,,,,");
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
	//print_r($paymenyResponse); 
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

if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){ 

$data = array(
"amount" => $totalAmount ,
"hired" => $_POST['hired'] ,
"description" => $_POST['description'] ,
"freelancer_projectid" => $_POST['freelancer_projectid'] ,
"freelancer_profileid" => $_POST['freelancer_profileid'] ,
"bussiness_profile_id" => $_POST['bussiness_profile_id'] ,
"freelancer_profile_id" => $_POST['freelancer_cat'],
 "created" => date("Y-m-d h:i:s")
 
);


//print_r($data);die("----");
  $fc = new _milestone;
/// print_r($_POST);
$id = $fc->createmilestone($data);
//die("_________");



$balanceTransaction = $paymenyResponse['balance_transaction'];

 $pay = array(
                   "payer_email" => $_SESSION['spUserEmail'],
                   "post_id" => $id,
                   "txn_id" => $balanceTransaction,
                   "mc_currency" => $currency,
                   "payment_gross" => $totalAmount,
                   "payment_date" => date('Y-m-d')

               );
			       $fc1 = new _payment_milestone;

					$id = $fc1->create($pay);


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
					
					
					
					
					
						//$ss = $u->get_super_vip();
						
						//$super_commission = mysqli_fetch_assoc($ss); 
						//$total_comm=($_POST['price']*$super_commission['super_vip_com'])/100;
					
					
						$data = array(
							"purchaser_user_id"=>$_SESSION['uid'] ,
							"purhcaser_pid"=>$_SESSION['pid'],
							"purcahse_amount"=>$_POST['total_amount'],
							"mycommsion"=>$sale_commission,
							"refred_user"=>$used_ref_id,
							"module"=>'freelancer',
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
	
$u = new _spprofiles;

$reciverdata = $u->read($freelancer_pid);	


if ($reciverdata != false) {




$reciver = mysqli_fetch_array($reciverdata);

$recivername = $reciver['spProfileName'];

$reciveremail =	 $reciver['spProfileEmail'];

}	
//https://dev.thesharepage.com/freelancer/dashboard/project-bid.php?postid=1647

$link = $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$projrctid;
// echo $link;
// die("================");
$em = new _email;
//function sendmilestonecreated($recivername, $reciveremail, $link)
 $em->sendmilestonecreated($recivername,$reciveremail,$link);
}

}
$pstid = $_POST['postid'];


	
	
header("location:$BaseUrl/freelancer/dashboard/project-bid.php?postid=$pstid");
