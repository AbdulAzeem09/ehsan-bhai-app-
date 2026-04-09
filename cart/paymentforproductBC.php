<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//include('../univ/baseurl.php');*/
include( "../univ/main.php");
session_start();

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


//echo $shpping_Address;






$p = new _order;

$rpvt = $p->readCartItemsavedforlater($_SESSION['uid']);
//print_r($rpvt);
if ($rpvt != false){

//$row = mysqli_fetch_assoc($rpvt);
//print_r($row);die('======');
//$cartitem=0;
while($row = mysqli_fetch_assoc($rpvt))
{ 	

$itemtype11=$row['cartItemType'];
if($row['cartItemType']=='Store'){

}

/*if($_GET['action']=='addtocart'){ 
$arr=array("saveforlater"=>0); 
$ad=$p->addtocart($arr,$row['idspPostings']);

//header("location:cart/index.php");
header("Location:https://dev.thesharepage.com/cart/index.php");	
}*/

}}




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
$pr = new _productposting;
$it= $pi->readtypeitembystore($_SESSION['uid'],$_POST['seller_id']);
//var_dump($it);
if($it!=false){
$famount=0;
while($itt=mysqli_fetch_assoc($it)){
//print_r($itt);die('*****');
$prodata = $pr->read($itt['idspPostings']);


// $poster_detail = $pro->read()
if ($prodata != false) {
while($prorow = mysqli_fetch_assoc($prodata)){
//print_r($prorow);
//	$fixed=0;
//$curr=$prorow['default_currency'];
$spPostingTitle = $prorow['spPostingTitle'];
$sippingcharge=$prorow['sippingcharge'];
$fixedamt=$prorow['fixedamount'];
}}
if($sippingcharge==1){
$sippingch=0;
}
if($sippingcharge==2){
$left_qty=$itt['spOrderQty']-1;
$left_wty_amt= $left_qty *.25*$fixedamt;
$sippingch=$fixedamt+$left_wty_amt;


}

//print_r($itt);
$quantity=$itt['spOrderQty'];
$amount=$itt['sporderAmount'];
$finalamount =$quantity*$amount;
$famount=$famount+$finalamount+$sippingch;


}
//echo $famount;
}



//echo $sid;die;
$it11= $pi->readtypeitembyartandcraft($_SESSION['uid'],$_POST['seller_id']);
//var_dump($it);
if($it11!=false){
$famt=0;
while($itt11=mysqli_fetch_assoc($it11)){
//print_r($itt1);
$baskt_id=$itt11['idspOrder'];
$at=$pr->readfromartcraft($itt11['idspPostings']);
if($at!=false){
$art=mysqli_fetch_assoc($at);
$sippingcharge1=$art['sippingcharge'];
//echo $sippingcharge1.'<br>';
$fixedamount1=$art['fixedamount'];
//echo $fixedamount1;
}

//echo "<li><span class=''> </span></li>";
if($sippingcharge1==1){
$sippingcharge1=0;
} 
if($sippingcharge1==2){
//echo $row['spOrderQty'];
$left_qty=$itt11['spOrderQty']-1;
$left_wty_amt= $left_qty *.25*(int)$fixedamount1;
$sippingcharge1=(int)$fixedamount1+$left_wty_amt;
// 	echo "Shipping Charges: ".$sippingcharge1." (Fixed)";
// $total1+=$sippingcharge1;

}



//print_r($itt11);
$quant=$itt11['spOrderQty'];
$amot=$itt11['sporderAmount'];
$finamt=$quant*$amot;
$famt= $famt+$finamt+$sippingcharge1;

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
//echo "<pre>";
//print_r($bookedbuy);die;
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

if(isset($_POST['cardDetails'])){
$carddetails=array("customerName"=>$_POST['customerName'],
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
'description' =>  'PRO TITLE',
'email' => $customerEmail,
'source'  => $stripeToken,
"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
));
//    echo '<pre>';print_r($customer);

// item details for which payment made
$seller_id = $_POST['seller_id'];
//$itemPrice = number_format($_POST['price'], 2, '.', '');
//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
$totalAmount = $_POST['total_amount'];
//$totalAmount = $totalprice;  //$totalprice
$currency = $_POST['currency_code'];
$orderQty = 1;
//$orderNumber ="WER12345";   
$orderNumber = "WER".rand(10000000,99999999);   
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
echo '<pre>';print_r($e->getMessage());
$paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();
}
catch (Error\InvalidRequest $e) {

$paymentMessage = "<strong>".ucfirst($e->getStripeParam())."</strong> ".$e->getMessage();
} 
catch (\Exception $e) {
$paymentMessage = "<strong>".ucfirst($e->getStripeParam())." </strong> ".$e->getMessage();
} 

//exit;


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

$ba=$pi->readfrombasket($_SESSION['uid'],$_POST['seller_id']);


if($ba!=false){

while($ba1=mysqli_fetch_assoc($ba)){
//print_r($ba1);die('===444');
$neworder=$ba1['idspOrder'];
if($ba1['cartItemType']=='Store'){

$spr=$pi->readp($ba1['idspPostings']);
if($spr!=false){
$spr1= mysqli_fetch_assoc($spr);

if($spr1['sellType']=='Retail'){
$qty=$spr1['retailQuantity'];
$updated_qty=$qty-$ba1['spOrderQty'];
$arretail= array("retailQuantity"=>$updated_qty);
$pi->updateretailqty($arretail,$ba1['idspPostings']);
}
if($spr1['sellType']=='Wholesaler'){
$qty=$spr1['supplyability'];
$updated_qty=$qty-$ba1['spOrderQty'];
$arrwholesale= array("supplyability"=>$updated_qty);
$pi->updatewholesaleqty($arrwholesale,$ba1['idspPostings']);
}
}




$msg =" <b>Order Recieved</b> : Congratulations , you have received a new order ,<a  href='$BaseUrl/store/dashboard/sellerstatusnew.php?postid=$neworder'>Click to View</a> ";

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

$msg1 =" <b>Order Placed</b> : Congratulations ,  Your order of ORDER_$neworder  has been successfully placed ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$neworder'>Click to View </a> ";	
$data=array('from_id'=>$_POST['seller_id'],
'to_id'=> $_SESSION['pid'],
'message'=>$msg1, 
'module'=>"store",
'by_seller_or_buyer'=> 1
);

$postnoti = $noti->noti_create($data);
}
if($ba1['cartItemType']=='artandcraft'){

$art=$pi->readfromart($ba1['idspPostings']);
if($art!=false){
$art1=mysqli_fetch_assoc($art);
$qty=$art1['spPostFieldValue'];
$updated_qty=$qty-$ba1['spOrderQty'];
}


$pf= new _postfield;			
$ary= array("spPostFieldValue"=>$updated_qty);
$pf->updateqtyforid($ary,$ba1['idspPostings']);




$n = new _notification;	
						
$rpvtnewad = $p->resdnewagainartcraft($ba1['idspPostings']);

//if($rpvtnewad!=false){
$rownewadss = mysqli_fetch_assoc($rpvtnewad);
//}
$to_id = $rownewadss['spProfiles_idspProfiles'];
$from_id = $_SESSION['pid'];
$module = 'artcraft';
$by_seller_or_buyer = 2;
$by_seller_or_buyer1 = 1;

$message1 =  '<b>Order Placed</b> : Congratulations ,  Your order of ORDER_'.$neworder.' has been successfully placed ,<a href="/artandcraft/dashboard/statusnew.php?postid='.$neworder.'">Click to View</a>';

$message =  '<b>Order Recieved</b> : Congratulations , you have received a new order ,<a href="/artandcraft/dashboard/sellerstatusnew.php?postid='.$neworder.'">Click to View</a>';

$n->createCreatenotification($from_id,$to_id,$message,$module,$by_seller_or_buyer);	

$n->createCreatenotificationchart($to_id,$from_id,$message1,$module,$by_seller_or_buyer1);

}
}
}

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
"payer_status"=>$payer_status ?? '',
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
$row34 = mysqli_fetch_assoc($result34);

if (!empty($row34)) {
$co = new _country;
//echo $row34['country'];
$result3 = $co->readCountryName($row34['country']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
//print_r($row3);


}
$co = new _state;
$result4 = $co->readStateName($row34['state']);
if ($result4) {
$row5 = mysqli_fetch_assoc($result4);
//print_r($row4);

}
$co = new _city;
$result4 = $co->readCityName($row34['city']);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
//print_r($row4);die;
}
$shpping_Address = $row34['fullname'].'<br> '.$row34['fulladdress'].''.$row34['landmark'].' '.$row34['city'].''. $row4['state_title'].' '.$row1['zipcode'].''.$row34['country_title'].' '.$row34['phone'];
}
$paass = new _spcustomers_basket;

$paass->updateorderstatusnew($_SESSION['uid'], $seller_id,$shpping_Address);

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
//$itemtype=$rownewsold['cartItemType'];
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




$mainUSer = $mb->getreferrelUser($_POST['seller_id']);
$refferalcodeused = mysqli_fetch_assoc($mainUSer);
$tier2_user = $mb->getreferrelUser($refferalcodeused['refferalcodeused']);
$tier2_userid = mysqli_fetch_assoc($tier2_user);
$tier3_user = $mb->getreferrelUser($tier2_userid['refferalcodeused']);
$tier3_userid = mysqli_fetch_assoc($tier2_user);






    $ss = $u->get_super_vip_comm();
$super_commission = mysqli_fetch_assoc($ss); 
$sale_commission=$super_commission['sales_commission'];
$admin_commission=($_POST['total_amount']*$sale_commission)/100;
$total_sale_commission=($admin_commission*$sale_commission)/100;

if($tier2_userid){
    $tier2_commission = ($admin_commission*10)/100;
}else{
    $tier2_userid = '';
    $tier2_commission = '';
}
if($tier3_userid){
    $tier3_commission=($admin_commission*5)/100;
}else{
    $tier3_userid = '';
    $tier3_commission = '';
}

	$data = array(
		"purchaser_user_id"=>$_SESSION['uid'] ,
		"purhcaser_pid"=>$_SESSION['pid'],
		"purcahse_amount"=>$_POST['total_amount'],
		"refred_user"=>$used_ref_id,
        "module"=>'cart',
        "sale_type"=>'sale',
        "currency"=>$currency,
        "date"=>$date,
        'tier2_userid'=>$tier2_userid['idspUser'],
        'tier3_userid'=>$tier3_userid['idspUser'],
        'tier2_commission'=>$tier2_commission,
        'tier3_commission'=>$tier3_commission,
        "mycommsion"=>$sale_commission,
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

$data = array(

"payment_id"=>$balanceTransaction,
"spProfile_idspProfile"=>$_SESSION['pid'],
"pointAmount"=>$point,
"pointBalance"=>$point,
"pointDate"=>$date,
"uid"=>$_SESSION['uid'],
"spUser_idspUser"=>$ArtistId,
"spPointComment"=>'Purchase',
"spPoint_type"=>'D'
);
$rr = new _spPoints;

$last_id = $rr->create_point($data); 


$orderid  = $id ;
//print_r($row);die('====');
//notification   for seller
if($itemtype11=='Store'){

}

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

if($rpvtnewad!=false){
$rownewadss = mysqli_fetch_assoc($rpvtnewad);
}
$datanew = array(
"spPostings_idspPostings"=>$rownew['idspPostings'],
"spOrderQty"=>$row['spOrderQty'],
"price"=>$rownewadss['spPostingPrice'],
"sellerPid"=>$rownewadss['spProfiles_idspProfiles'],
"txn_id"=>$tr_id
);


$dfgdfb = $pet->createagainnew($datanew);




}


}
}   







$paymentMessage = "The payment was successful. Order ID: {$baskt_id}";
//$update_qty = $Quantity - $orderQty;
//$p->update(array('ticketcapacity' => $update_qty),"WHERE t.idspPostings =" . $_REQUEST["postid"]);


//if order inserted successfully
if($baskt_id && $paymentStatus == 'succeeded'){
$paymentMessage = "The payment was successful. Order ID: {$baskt_id}";
} else{
//$paymentMessage = "failed";
}

//anoop
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
$("#payNow").click(function () {
$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
$("#success-alert").slideUp(500);
});
});
});			
</script>

<?php
$_SESSION['psuccess']=1;	
header("Location:index.php"); } else{  ?>
<!--<div class="alert alert-danger" id="danger-alert">
<button type="button" class="close" data-dismiss="alert">x</button>
<strong>Payment Failed! </strong>
</div>-->



<script>

$(document).ready(function() {
// $("#success-alert").hide();
$("#payNow").click(function () {
$("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
$("#danger-alert").slideUp(500);
});
});
});			
</script>

<?php 	
$_SESSION['pfailed']=2;
header("Location:index.php");


}}}
//echo $balanceTransaction;

?>