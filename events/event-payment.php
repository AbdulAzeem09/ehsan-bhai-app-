<?php

include('../univ/baseurl.php');
include("../univ/main.php");
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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
$re = new _redirect;


$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";

if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re->redirect($BaseUrl . "/events");
}

if (isset($_GET['postid']) && $_GET['postid'] > 0) {

if (isset($_POST['spOrderQty']) && $_POST['spOrderQty'] > 0) {
$_SESSION['spOrderQty'] = $_POST['spOrderQty'];
}

if (isset($_SESSION['spOrderQty']) && count($_SESSION['spOrderQty']) < 1) {
$re->redirect($BaseUrl . "/events/event-detail.php?postid=" . $_REQUEST['postid']);
}

$pet = new _spevent_transection;

$p = new _spevent;
$prictype = new _spevent_type_price;
// $pf  = new _postfield;

$result = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
//print_r($row);
$curr = $row['default_currency'];
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$specification     = $row['specification'];

$ArtistName = $row['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout = $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];
$expDate    = $row['spPostingExpDt'];


$vv = new _spprofiles;
$vv1 = $vv->readprofileid($row['spProfiles_idspProfiles']);
if ($vv1) {
$vv2 = mysqli_fetch_assoc($vv1);
}
// print_r($vv2);
$sellpid = $vv2['spUser_idspUser'];
//echo $sellpid;

$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['spProfiles_idspProfiles']);
if ($result3 == 0) {
$level = '1st Connection';
} else if ($result3 == 1) {
$level = '1st Connection';
} else if ($result3 == 2) {
$level = '2nd Connection';
} else if ($result3 == 3) {
$level = '3rd Connection';
} else {
$level = 'Not Define';
}
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$endDate = $row['spPostingEndDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$OrganizerId = $row['spPostingEventOrgId'];
$Organizername = $row['spPostingEventOrgName'];
$Quantity = $row['ticketcapacity'];

$taxrate = $row['taxrate'];
$notax = $row['notax'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}
} else {
$re = new _redirect;
$redirctUrl = "../events";
$re->redirect($redirctUrl);
}

if (isset($_GET['visibility']) && $_GET['visibility'] == -1) {
$visibil = 1;
} else {
$visibil = 0;
}



///////// start code for stripe payment request , response////////////
//die('========');
$paymentMessage = '';
if (!empty($_POST['stripeToken'])) {

//echo "<pre>";
//print_r($_SESSION);die('==='); 

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
$itemPrice = $_POST['price'];
$totalAmount = $_POST['total_amount'];
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



//print_r($payDetails);
// get payment details

//echo "<pre>";
//print_r($paymenyResponse);
//exit;
// check whether the payment is successful
if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {

///////////code for order details ////////
$emailtext = '<h4 align="center">Order Details</h4>
<div class="table-responsive" id="order_table">
<table class="table table-bordered table-striped" style="width:100%;text-align:left;">
<thead>
<tr>
<th>Ticket Type</th>                                          
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>
</thead>
<tbody style="text-align: left;width:100%">';

$resultdata = $prictype->read($_GET["postid"]);
$subtotal = 0;
$taxamount = 0;


if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {



$orderqty = $_SESSION['spOrderQty'][$pricedata['typeid']];
if ($orderqty > 0) {
$totalpri = $orderqty * $pricedata['event_price'];
$subtotal = $subtotal + $totalpri;

if ($notax == 0) {
if ($taxrate != "" && $taxrate > 0) {
$taxamount += round(($totalpri / 100) * $taxrate, 2);
}
}
$emailtext .= '<tr>
<td>' . $pricedata['event_type'] . '</td>
<td>' . $orderqty . '</td>
<td>$' . round($pricedata['event_price'], 2) . '</td> 
<td>$' . round($totalpri, 2) . '</td> 
</tr>';
}
}
}




$emailtext .= '<tr style="text-align: left;width:100%;margin-top:20px">
<td></td>
<td align="right"></td>
<td align="right">Sub Total: </td>  
<td align="left"><strong>$' . round($subtotal, 2) . '</strong></td>
</tr>';

if ($notax == 0) {

$emailtext .= '<tr>  
<td colspan="3" align="right">Tax: </td>  
<td align="left"><strong>$' . round($taxamount, 2) . '</strong></td>
</tr>';

$totalval = $subtotal + $taxamount;
} else {
$totalval = $subtotal;
}

$emailtext .= '<tr>  
<td colspan="3" align="right">Total: </td>  
<td align="left"><strong>$' . round($totalval, 2) . '</strong></td>
</tr>


</form>
</tbody>
</table>									
</div>';

/////////////end code  //////////////////

// transaction details 
$amountPaid = $paymenyResponse['amount'];
$balanceTransaction = $paymenyResponse['balance_transaction'];
$paidCurrency = $paymenyResponse['currency'];
$paymentStatus = $paymenyResponse['status'];
$payer_id = $paymenyResponse['customer'];
//$payer_status = $paymenyResponse['outcome']['type'];
$paymentDate = date("Y-m-d H:i:s");



$ticket_detail = count($_SESSION['spOrderQty']);

foreach ($_SESSION['spOrderQty'] as $x => $val) {
if ($val > 0) {
$prictype = new _spevent_type_price;
$resultdata = $prictype->readtypid($x);

if ($resultdata != false) {

$pricedata = mysqli_fetch_assoc($resultdata);

$event_price = $pricedata['event_price'] * $val;
}
$data = array(

"postid" => $_GET['postid'],
"sellid" => $ArtistId,
"payer_email" => $customerEmail,
"payer_id" => $payer_id,
"payer_status" => $payer_status,
"payment_status" => $paymentStatus,
"first_name" => $customerFname,
"last_name" => $customerLname,
"txn_id" => $balanceTransaction,
"currency" => $currency,
"quantity" => $val,
"ticket_type" => $x,
"payment_date" => $paymentDate,
"business" => "",
"buyer_uid" => $_SESSION['uid'],
"buyer_pid" => $_SESSION['pid'],
"payment_gross" => $event_price,
"card_detail" => $cardDetails,
"order_taxrate" => $taxrate,
"order_notax" => $notax,

);
//print_r($data);die('===5');
$tr_id = $pet->create($data);


$u = new _spuser;
$mb = new _spmembership;
$resultbok_1 = $u->read_reffer($_SESSION['uid']);
if ($resultbok_1) {
$refer = mysqli_fetch_assoc($resultbok_1);
}
$used_code = $refer['refferalcodeused'];
$used_refer_id = $refer['idspUser'];

$resultbok_2 = $u->user_reffer_code($used_code);
if ($resultbok_2) {
$rr = mysqli_fetch_assoc($resultbok_2);
}
$name_1 = $rr['spUserName'];
$used_ref_id = $rr['idspUser'];

$super_vip = $mb->super_vip1($used_refer_id);
$vip_com = $mb->vip_com($used_refer_id);

date_default_timezone_set('Asia/Kolkata');

$date = date("Y-m-d h:i:s");


$admin = $u->get_admin_commission();
$admin_com = mysqli_fetch_assoc($admin);
$per = $admin_com['comm_amt'];
$admin_commission = ($_POST['total_amount'] * $per) / 100;


$ss = $u->get_super_vip();
$super_commission = mysqli_fetch_assoc($ss);
$sale_commission = $super_commission['sale_comm'];
$total_sale_commission = ($admin_commission * $sale_commission) / 100;

$data = array(
"purchaser_user_id" => $_SESSION['uid'],
"purhcaser_pid" => $_SESSION['pid'],
"purcahse_amount" => $_POST['total_amount'],
"mycommsion" => $sale_commission,
"refred_user" => $used_ref_id,
"module" => 'events',
"sale_type" => 'sale',
"currency" => $currency,
"date" => $date,
"spadmin_commission" => $admin_commission,
"spuser_commission" => $total_sale_commission

);
$commission = $mb->create_comm($data);









$cur = new _currency;

$fromCurrency = $currency;
$toCurrency = "USD";
$amount = $_POST['total_amount'];

$detail = $cur->convert_Currency($fromCurrency, $toCurrency, $amount);
$point = round($detail['convertedAmount'], 0);
date_default_timezone_set('Asia/Kolkata');

$date = date("Y-m-d h:i:s");
//print_r($detail );die('====33');
$resultbok_1 = $u->read_reffer($_SESSION['uid']);
if ($resultbok_1) {
$refer = mysqli_fetch_assoc($resultbok_1);
}
$used_code = $refer['refferalcodeused'];
$used_refer_id = $refer['idspUser'];

$resultbok_2 = $u->user_reffer_code($used_code);
if ($resultbok_2) {
$rr = mysqli_fetch_assoc($resultbok_2);
}
$name_1 = $rr['spUserName'];
$used_ref_id = $rr['idspUser'];

$sppoint_buyer = ($point*80)/100;

$sppoint_refred = ($point*20)/100;


$data = array(

"payment_id" => $balanceTransaction,
"spProfile_idspProfile" => $_SESSION['pid'],
"pointAmount" => $sppoint_buyer,
"pointBalance" => $sppoint_buyer,
"pointDate" => $date,
"uid"=>$_SESSION['uid'],
"spUser_idspUser" => $ArtistId,
"spPointComment" => 'Purchase',
"spPoint_type" => 'D'
);
$rr = new _spPoints;

$last_id = $rr->create_point($data);


$data = array(

	"payment_id" => $balanceTransaction,
	"spProfile_idspProfile" => '0',
	"pointAmount" => $sppoint_refred,
	"pointBalance" => $sppoint_refred,
	"pointDate" => $date,
	"uid"=>$used_ref_id,
	"spUser_idspUser" => $ArtistId,
	"spPointComment" => 'Referred User Purchased',
	"spPoint_type" => 'D'
	);


	$rr = new _spPoints;

$last_id = $rr->create_point($data);




}
}



$wallet = array(
"buyer_userid" => $_SESSION['uid'],
"seller_userid" => $sellpid,
"amount" => $_POST['total_amount'],
"orderid" => $_GET['postid'],
"status" => 1,
"balanceTransaction" => $balanceTransaction,
"date_txn" => date('Y-m-d H:i:s'),
"transaction_date" => date('Y-m-d')
);
// echo $_POST['groupid'];
if (($_GET['groupid'])) {
//die('1111');
$pet->group_event_wallet($wallet);
} else {
//die('222');
$pet->create_wallet($wallet);
}



$uu = new _spprofiles;

$resultu = $uu->read($ArtistId);
if ($resultu != false) {
$row6 = mysqli_fetch_array($resultu);
//print_r($row6);
$evetpostuid = $row6['spUser_idspUser'];
$posteduseremail =	 $row6['spProfileEmail'];
$postedusername =	 $row6['spProfileName'];

$resultboku = $uu->read($_SESSION['pid']);
if ($resultboku != false) {

$bookedbuyu = mysqli_fetch_array($resultboku);


$bokkedbynameu = $bookedbuyu['spProfileName'];
$bookeduseremail =	 $bookedbuyu['spProfileEmail'];
}

$event_title = '<a style="text-decoration: underline;" href="' . $BaseUrl . '/events/event-detail.php?postid=' . $_GET['postid'] . '">' . $ProTitle . '</a>';
$dt = new _spprofiles;
$d = $dt->eventBuy_description(5);
if ($d) {
$ro = mysqli_fetch_array($d);
$notification_description = $ro['notification_description'];
$subject = $ro['subject'];
}
$e = new _email;
////// email to event Organizer
$e->sendeventbookednew($postedusername, $posteduseremail, $event_title, $bokkedbynameu, $orderQty, $totalAmount, $emailtext, $notification_description, $subject);


//// email to buyer
$e->sendeventbookednew($postedusername, $bookeduseremail, $event_title, $bokkedbynameu, $orderQty, $totalAmount, $emailtext, $notification_description, $subject);
}



if (count($_SESSION['spOrderQty']) > 0) {

foreach ($_SESSION['spOrderQty'] as $key2 => $value2) {

if ($value2 > 0) {

$resultdata2 = $prictype->readtypid($key2);
$pricedata2 = mysqli_fetch_assoc($resultdata2);
$pricetype_order_data = array(
"orderid" => $tr_id,
"pricetypeid" => $key2,
"eventid" => $_GET['postid'],
"ticket_type" => $pricedata2['event_type'],
"order_ticket_qty" => $value2,
"order_ticket_price" => $pricedata2['event_price'],

);
$ticketlimit = $pricedata2['event_limit'] - $value2;
//$ticketlimit = $pricedata2['event_limit'] - $orderQty;

$tran_pri_type_id = $prictype->create_price_history($pricetype_order_data);

$updatepriceData = array("event_limit" => $ticketlimit);

$price_type_id = $prictype->update($updatepriceData, " where typeid='" . $key2 . "'");
}
}
}

unset($_SESSION['spOrderQty']);



/////////////////start sp-points from here ///////

// ===GET TOTAL POINT FROM THE DATABASE
$po = new _spPoints;
$po_result = $po->readpoint(4);
if ($po_result) {
$po_row = mysqli_fetch_assoc($po_result);
$sppoint_perdollar = $po_row['point_total'];
} else {
$sppoint_perdollar = 0;
}



$upoints = $totalAmount * $sppoint_perdollar;
$userpo = new _spuserpoints;

$userpodata = array(
"payment_id" => $balanceTransaction,
"spProfile_idspProfile" => $_SESSION['pid'],
"totalAmount" => $totalAmount,
"totalPoints" => $upoints,
"pointDate" => $paymentDate,
"spUser_idspUser" => $_SESSION['uid'],
"spPointFrom" => "Event",
"spPoint_type" => "E",
"assoc_payment_tbl_id" => $tr_id,

);


$userpo->create($userpodata);


$userCurrentTotalpoint = $userCurrentTotalpoint + $upoints;
$userupdata = array(
"spUserTotalPoints" => $userCurrentTotalpoint
);


$u->update($userupdata, $_SESSION['uid']);



///////////////end sp-points    /////////////////

//////////////admin comminssion //////////////


$admcommi = new _admcommission;
$admcommi_result = $admcommi->read(1);
if ($admcommi_result) {
$admcommi_row = mysqli_fetch_assoc($admcommi_result);
$mcommi_amt = $admcommi_row['comm_amt'];
$mcommi_type = $admcommi_row['comm_type'];
if ($mcommi_type == 0) {

$commi = ($totalAmount * $mcommi_amt) / 100;

$final_commi = number_format($commi, 2, '.', '');
} elseif ($mcommi_type == 1) {
$final_commi = $mcommi_amt;
}
} else {
$final_commi = 0;
}


$admcmmdata = array(
"payment_tx_id" => $balanceTransaction,
"spProfile_idspProfile" => $_SESSION['pid'],
"totalAmount" => $totalAmount,
"totalComm" => $final_commi,
"commDate" => $paymentDate,
"spUser_idspUser" => $_SESSION['uid'],
"spCommFrom" => "Event",
"spComm_type" => "E",
"assoc_payment_tbl_id" => $tr_id,

);


$admcommi->create($admcmmdata);


/////////////////////end admin comminsion /////////


$update_qty = $Quantity - $orderQty;
$p->update(array('ticketcapacity' => $update_qty), "WHERE t.idspPostings =" . $_REQUEST["postid"]);


//if order inserted successfully
if ($tr_id && $paymentStatus == 'succeeded') {
$paymentMessage = "The payment was successful. Order ID: {$tr_id}";
} else {
//$paymentMessage = "failed";
}
} else {
//$paymentMessage = "failed";
}
}

///////// end code for stripe payment request , response////////////
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<!-- this script for slider art -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

<script>
Stripe.setPublishableKey('<?php echo PUBLIC_KEY ?>');

function checkqty(txb) {
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if (qty > actualQty) {
document.getElementById("newValue").value = actualQty;
}
if (qty < 1) {
document.getElementById("newValue").value = 1;
//alert("less");
}

$('#payqty').val($('#newValue').val());
}

function checkqtynew(txb, limit, id) {
var qty = parseInt(txb);

if (qty > limit) {
document.getElementById("newValue" + id).value = limit;
alert("you can not enter more than available qty");
}
if (qty < 1) {
document.getElementById("newValue" + id).value = 0;
//  alert("please enter more than 1 qty");
}
if (qty == "") {
document.getElementById("newValue" + id).value = 0;
//  alert("please enter more than 1 qty");
}


}

function checkqty() {
$checkboxTicket_Type = $('.Ticket_Typenew');
var chkArray = [];
chkArray = $.map($checkboxTicket_Type, function(el) {
return el.value;
});
var totval = 0;
$.each(chkArray, function(key, value) {

totval = totval + value;

});
if (totval > 0) {
return true;
} else {
alert("Please enter some ticket quantity.");
return false;
}

}
</script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/paymentjs1.js"></script>


<style type="text/css">
div#profileshow {
padding-left: 0 !important;
}

div#groupshow {
padding-left: 0 !important;
}

.rating-box {
position: relative !important;
vertical-align: middle !important;
font-size: 18px;
font-family: FontAwesome;
display: inline-block !important;
color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before {
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute !important;
left: 0;
top: 0;
white-space: nowrap !important;
overflow: hidden !important;
color: Gold !important;

}

.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.flag:hover {
color: #428bca !important;
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

#full-stars-example .rating__input--none:checked+.rating__label .rating__icon--none {
color: red;
}

#full-stars-example .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example .rating-group:hover .rating__label .rating__icon--star {
color: orange;
}

#full-stars-example .rating__input:hover~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
color: #eee;
}

#full-stars-example .rating__input--none:hover+.rating__label .rating__icon--none {
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

#half-stars-example .rating__input--none:checked+.rating__label .rating__icon--none {
color: red;
}

#half-stars-example .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#half-stars-example .rating-group:hover .rating__label .rating__icon--star,
#half-stars-example .rating-group:hover .rating__label--half .rating__icon--star {
color: orange;
}

#half-stars-example .rating__input:hover~.rating__label .rating__icon--star,
#half-stars-example .rating__input:hover~.rating__label--half .rating__icon--star {
color: #ddd;
}

#half-stars-example .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
color: #eee;
}

#half-stars-example .rating__input--none:hover+.rating__label .rating__icon--none {
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

#full-stars-example-two .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
color: orange;
}

#full-stars-example-two .rating__input:hover~.rating__label .rating__icon--star {
color: #ddd;
}

.ui-autocomplete li.ui-menu-item {
font-size: 10px;
}
</style>



</head>

<body class="bg_gray">
<?php include_once("../header.php"); ?>
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
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);

?>
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>"><?php echo $row7['spProfileName']; ?></a>
<?php
}
?>
)</label>
</div> -->
</div>
<form method="post" action="../friendmessage/sendSms.php" id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data">
<input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="<?php echo $OrganizerId; ?>">

<div class="modal-body">
<div class="row">
<div class="col-sm-12">
<div class="sp-post-edit">
<div class="form-group">
<label>Message</label>
<textarea class="form-control" name="spfriendChattingMessage"></textarea>
</div>
</div>
<button type="submit" class="btn pull-right btnSendSms" <?php echo ($_SESSION['pid'] == $OrganizerId) ? 'disabled' : ''; ?> id="sendEventSms" style="border-radius: 15px; ">Send Message</button>
<button type="button" class="btn pull-right" data-dismiss="modal" style="margin-right: 5px; border-radius: 15px;">Cancel</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<section class="topDetailEvent">
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 text-center">

<?php


if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
if ($_SESSION['count'] <= 1) {
$_SESSION['count'] += 1; ?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>

</div>
<div class="col-md-3"></div>
</div>
<div class="row">
<div class="col-sm-12 text-center">
<p class="titDetail"><?php echo $ProTitle; ?></p>
<p class="location eventcapitalize"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></p>
</div>
</div>
<div class="row">
<div class="col-md-offset-1 col-md-10">
<div class="transTop">
<div class="row">
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Start</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $startDate; ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Ends</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $expDate ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time Start</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtstrtTime); ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time End</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtendTime); ?></p>
</div>
</div>
</div>
</div>
<!--  <div class="transTopBtmFoot">
<?php
$today = date('Y-m-d');
$date1 = new DateTime($today);
$date2 = new DateTime($startDate);
$interval = $date2->diff($date1);
?>
<ul>
<li>&nbsp;</li>
<li><?php echo $interval->format('%m Months'); ?></li>
<li><?php echo $interval->format('%d Days'); ?></li>
<li>&nbsp;</li>
</ul>
</div> -->

</div>
</div>
</div>
</section>
<section class="main_box">
<div class="row" style="margin-top: -15px;">

<div class="col-sm-12 ">

<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl; ?>/events/">HOME</a></li>
<li style="font-weight: 600;font-size: 15px;">Order Process</li>

</ul>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-offset-1 col-md-10">
<div class="twolevelEvent">
<ul class="social">
<li>
<a href="<?php echo $BaseUrl . '/events'; ?>">
<span class="iconhover"><i class="fa fa-home"></i></span>
Home
</a>
</li>
<li class="bokmarktab">
<?php
//rating

$ev = new _event_favorites;
$res_ev = $ev->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
//$res_ev = $ev->read($_GET["postid"]);

// echo $ev->ta->sql; 




if ($res_ev != false) {


?>

<a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<!-- <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span> -->
<span id="removetofavouriteeve" class="iconhover"><i class="fa fa-heart"></i></span>
Bookmarked
</a>

<?php
} else {
?>
<a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<span id="addtofavouriteeve" class="iconhover"><i class="fa fa-heart-o"></i></span>
Bookmark
</a>
<?php
}
?>


</li>
<li>

<?php

$r = new _speventreview_rating;

$sumres = $r->readeventrating($_GET["postid"]);
if ($sumres != false) {
//echo $r->ta->sql;  



while ($sumrow = mysqli_fetch_assoc($sumres)) {


$sumrating += $sumrow['rating'];

$ratarr[] =  $sumrow['rating'];

//echo count($ratarr);


}



$countrate = count($ratarr);

$averagerate = $sumrating / $countrate;

$totalrate  = round($averagerate, 1);
}
?>

<div class="row reviewdetail">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'] ?>" />
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">


</div>
</li>
<li>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($_GET['postid'], $_SESSION['pid']);
if ($result != false) {
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];

if ($area == 2) {
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
} else if ($area == 1) {
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
} else if ($area == 0) {
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
} else {
$title = "Event";
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($_GET['postid'], 2);
// echo $ie->ta->sql;
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}

$resulti2 = $ie->chekGoing($_GET['postid'], 1);
// echo $ie->ta->sql;
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}


$resulti3 = $ie->chekGoing($_GET['postid'], 0);
// echo $ie->ta->sql;
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}
?>

<span id="">
<i class="fa fa-calendar"></i>
</span>
<div class="ie_<?php echo $_GET['postid']; ?>">

<div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
<button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;"><?php echo $title; ?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="2"><?php echo $area2; ?> Going (<?php echo $going; ?>) </a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="1"><?php echo $area1; ?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="0"><?php echo $area0; ?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div>
</li>

<li>
<?php
$pic = new _eventpic;
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
//echo "<img alt='Posting Pic' class='img-responsive img-big' src=' " . ($pic2) . "' >";
} else {
//echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive img-big'>";
}

?>
<a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'>

<span class='sp-share-art iconhover' data-postid='<?php echo $_GET['postid']; ?>' src='<?php echo ($pic2); ?>'>
<i class="fa fa-share-alt"></i>
</span>
Share
</a>
</li>
</ul>
</div>
</div>
</div>
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
<div class="row">
<div class="col-sm-12">
<div class="titleEvent">
<div class="row">
<div class="col-md-10">
<div class="hostedbyevent">
<h2 class="eventcapitalize">

<?php
if ($tr_id && $paymentStatus == 'succeeded') {
echo "Payment <span>Successful</span>";
} else {
echo "Order <span>Process</span>";
}
?> </h2>

</div>
</div>
<!--<div class="col-md-2" style="margin-top:30px;">
&larr;<a style="text-decoration: underline;" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $_GET['postid']; ?>"> Return to Event</a>
</div>-->
</div>
</div>

<div class="alert alert-danger" id="message" style="display:none;"></div>

<?php
if ($paymentMessage != "" && $paymentStatus != 'succeeded') {
?>
<div class="alert alert-danger">
<?php
echo $paymentMessage;
$paymentMessage = '';
?>
</div>
<?php
} elseif ($tr_id && $paymentStatus == 'succeeded') {
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
if ($tr_id && $paymentStatus == 'succeeded') {
?>

<div class="col-sm-12">
<div class="col-md-6" style="margin-bottom:50px;">

<a href="<?php echo $BaseUrl; ?>/events/dashboard" class="btn create_add no-radius" style="background-color: #c11f50!important;    border: 1px solid #c11f50 !important;">Go to dashboard</a>
</div>
</div>
<?php

} else {
//$itemQty = $_SESSION['spOrderQty'];
//$total_price = $price*$itemQty;
if (is_array($_SESSION['spOrderQty']) && count($_SESSION['spOrderQty']) > 0) {
$keyarr = array();
$totalqty = 0;
$untinprice = 0;
$totalPrice = 0;
foreach ($_SESSION['spOrderQty'] as $key => $value) {
if ($value > 0) {

$keyarr[] = $key;
$totalqty = $totalqty + $value;
$resultdata = $prictype->readtypid($key);
$pricedata = mysqli_fetch_assoc($resultdata);

if ($pricedata != false) {
if ($notax == 0) {
if ($taxrate != "" && $taxrate > 0) {
$taxamount = round(($pricedata['event_price'] / 100) * $taxrate, 2);
$untinprice += $pricedata['event_price'] + $taxamount;
$totalPricenotax = $value * $pricedata['event_price'];
$totaltaxamount = round(($totalPricenotax / 100) * $taxrate, 2);
$totalPrice += $totalPricenotax +  $totaltaxamount;
} else {
$untinprice += $pricedata['event_price'];
$totalPrice = $totalPrice + ($value * $pricedata['event_price']);
}
} else {
$untinprice += $pricedata['event_price'];
$totalPrice = $totalPrice + ($value * $pricedata['event_price']);
}
}
}
}
}

?>

<div class="col-sm-12">
<div class="col-md-6" style="border-right:1px solid #ddd;">
<h4 align="left">Payment Details</h4>
<?php
$trans_res   = $pet->readbuyer($_SESSION['uid']);
if ($trans_res != false) {
while ($tranrow = mysqli_fetch_assoc($trans_res)) {
if ($tranrow['card_detail'] != "") {
$decrypted_card = PHP_AES_Cipher::decrypt($encrypt_key, $tranrow['card_detail']);

$cads = explode("||", $decrypted_card);

?>
<!-- <div class="form-group">
<form action="<?php echo $BaseUrl; ?>/events/event-payment.php?postid=<?php echo $_GET['postid']; ?>" method="POST" >
Use card end with <?php echo substr($cads[1], -4); ?>
<div align="left">
<input type="hidden" name="spOrderQty" value="<?php echo $_SESSION['spOrderQty']; ?>">
<input type="hidden" name="customerName" id="customerName" value="<?php echo $cads[0]; ?>">
<input type="hidden" name="cardNumber" id="cardNumber" value="<?php echo $cads[1]; ?>">
<input type="hidden" name="cardExpMonth" id="cardExpMonth" value="<?php echo $cads[2]; ?>">
<input type="hidden" name="cardExpYear" id="cardExpYear" value="<?php echo $cads[3]; ?>">
<input type="hidden" name="cardCVC" id="cardCVC" value="<?php echo $cads[4]; ?>">

<input type="hidden" name="price" value="<?php echo $price; ?>">
<input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_details" value="<?php echo $ProTitle; ?>">
<button type="button" class="btn butn_cancel" name="payNow" id="payNow"  style="border-radius: 25px;" onclick="stripePay2(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>


</div>
</div>
</form> -->
<?php

}
}
}

?>
<?php if (isset($_GET['groupid'])) {

$gid = $_GET['groupid'];

?>

<form action="<?php echo $BaseUrl; ?>/events/event-payment.php?postid=<?php echo $_GET['postid']; ?>&groupid=<?php echo $gid; ?>" method="POST" id="paymentForm">
<?php } else { ?>

<form action="<?php echo $BaseUrl; ?>/events/event-payment.php?postid=<?php echo $_GET['postid']; ?>" method="POST" id="paymentForm">
<?php } ?>


<div class="form-group">
<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
<input type="text" name="customerName" id="customerName" style="width:300px;" class="form-control" value="" required>
<span id="errorCustomerName" class="text-danger"></span>
</div>

<div class="form-group">
<label>Card Number <span class="text-danger">*</span></label>
<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="cardNumber" id="cardNumber" style="width:300px;" class="form-control" maxlength="20">
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
<input type="text" name="cardCVC" id="cardCVC" style="width:90px;" class="form-control" maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardCvc" class="text-danger"></span>
</div>
</div>
</div>
<br>
<div align="left">



<input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>">
<input type="hidden" name="totalOrderQty" value="<?php echo $totalqty; ?>">
<input type="hidden" name="price" value="<?php echo $untinprice; ?>">
<input type="hidden" name="total_amount" value="<?php echo $totalPrice; ?>">
<input type="hidden" name="currency_code" value="<?php echo $curr ?>">
<input type="hidden" name="item_details" value="<?php echo $ProTitle; ?>">
<button type="submit" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow" onclick="stripePay(event)" value="Pay Now">
<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button>

<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
</div>
<br>
</div>
</form>

<div class="col-md-6">
<h4 align="center">Order Details</h4>
<div class="table-responsive" id="order_table">
<table class="table table-bordered table-striped">
<form action="<?php echo $BaseUrl; ?>/events/event-payment.php?postid=<?php echo $_GET['postid']; ?>" method="POST" onsubmit="return checkqty();">

<thead>
<tr>
<th>Ticket Type</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>
</thead>
<tbody style="text-align: left;">
<?php
//print_r($_SESSION);

$resultdata = $prictype->read($_GET["postid"]);
$subtotal = 0;
$taxamount = 0;


if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
//print_r($pricedata);
$keyarr = array();
$type_id = $pricedata['typeid'];
//if(in_array($pricedata['typeid'],$keyarr)){


$orderqty = $_SESSION['spOrderQty'][$type_id];
$totalpri = $orderqty * $pricedata['event_price'];
$subtotal = $subtotal + $totalpri;

if ($notax == 0) {
if ($taxrate != "" && $taxrate > 0) {
$taxamount += round(($totalpri / 100) * $taxrate, 2);
}
}



//}

?>
<tr>
<td><?php echo $pricedata['event_type']; ?></td>
<td><?php echo "Max: " . $pricedata['event_limit']; ?> <input type="number" class="form-control Ticket_Typenew" style="width: 60px;margin-right: 15px;float:right;" id="newValue<?php echo $pricedata['typeid']; ?>" name="spOrderQty[<?php echo $pricedata['typeid']; ?>]" value="<?php echo $orderqty; ?>" onkeyup="checkqtynew(this.value,<?php echo $pricedata['event_limit']; ?>,<?php echo $pricedata['typeid']; ?>);"></td>
<td><?php echo $curr . ' ' . round($pricedata['event_price'], 2); ?></td>
<td><?php echo $curr . ' ' . round($totalpri, 2); ?></td>
</tr>
<?php
}
}
?>



<tr>
<td></td>
<td align="right"><button type="submit" class="btn butn_submit_real  btn-border-radius" style="margin-left:5px;min-width:50px;">UPDATE</button></td>
<td align="right">Sub Total</td>
<td align="left"><strong><?php echo $curr . ' ' . round($subtotal, 2); ?></strong></td>
</tr>
<?php
if ($notax == 0) {
?>
<tr>
<td colspan="3" align="right">Tax</td>
<td align="left"><strong><?php echo $curr . ' ' . round($taxamount, 2); ?></strong></td>
</tr>
<?php
$totalval = $subtotal + $taxamount;
} else {
$totalval = $subtotal;
}
?>
<tr>
<td colspan="3" align="right">Total</td>
<td align="left"><strong><?php echo $curr . ' ' . round($totalval, 2); ?></strong></td>
</tr>


</form>
</tbody>
<tbody>



</tbody>
</table>
</div>
</div>
</div>
</div>
<?php
}
?>



</div>
</div>
</div>
</div>
</div>

</section>

<section class="eventGallery">
<div class="container">
<div class="row">
<div class="col-sm-12">
<ul class="nav nav-tabs" id="navtabFrnd" style="border-radius: 20px;">
<li class="active"><a data-toggle="tab" href="#home" style="border-top-left-radius: 20px;
border-bottom-left-radius: 20px;">Gallery</a></li>
<!-- <li><a data-toggle="tab" href="#menu1">Video</a></li> -->
<!--  <li><a data-toggle="tab" href="#menu2">Reviews</a></li> -->
<li><a data-toggle="tab" href="#menu3">Sponsors</a></li>
<li><a data-toggle="tab" href="#menu4">Featuring</a></li>
<li><a data-toggle="tab" href="#menu5">Contact Organizer</a></li>
<li><a data-toggle="tab" href="#menu6">Specification</a></li>
<li><a data-toggle="tab" href="#menu7">Seating Layout</a></li>
</ul>

<div class="tab-content" style="min-height: 300px;">
<div id="home" class="tab-pane fade in active">
<div class="space"></div>
<div class="row">
<?php
$pic = new _eventpic;
$res2 = $pic->read($_GET['postid']);

if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="col-md-3">
<div class="EvntImg">
<a class="thumbnail eventpostimg mag" data-effect="mfp-newspaper" href="<?php echo $pic2; ?>" title="<?php echo $ProTitle; ?>">
<img class="group1 eventpostimg" src="<?php echo $pic2; ?>">
</a>

</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
} ?>
</div>
</div>

<div id="menu1" class="tab-pane fade">
<div class="space"></div>
<div class="row">
<?php
$media = new _postingalbum;
$result = $media->read($_GET['postid']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp4') { ?>
<div class="col-md-offset-3 col-md-6">
<div style='margin-left:15px;margin-right:15px;'>
<video style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
</video>
</div>
</div>
<?php
}
} ?>
</div>
</div>
<div id="menu2" class="tab-pane fade">

</div>
<div id="menu3" class="tab-pane fade ">

<div class="">
<div class="space"></div>
<div class="SponsrTitle">

<?php
$SpCat = "General";
include('sponsor.php');
?>
</div>


</div>
</div>
<div id="menu4" class="tab-pane fade">
<h3>Featuring</h3>
<div class="row">

<?php

$splinkp = new _spevent;

$pro = new _spprofiles;
$allFeature = array();
if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$result6 = $splinkp->read($_GET['postid']);
if ($result6 != false) {
while ($row6 = mysqli_fetch_assoc($result6)) {
if ($row6['addfeaturning'] != '') {
$allFeature = explode(",", $row6['addfeaturning']);

for ($i = 0; $i < count($allFeature); $i++) {

if ($allFeature[$i] != '') {

$profileId = $allFeature[$i];
$result7 = $pro->read($profileId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>">
<div class="col-md-3 no-padding">
	<?php
	echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../assets/images/blank-img/default-profile.png") . "'>";
	?>
</div>
<div class="col-md-9 no-padding">
	<h4 class="eventcapitalize"><?php echo $row7['spProfileName']; ?></h4>
</div>
</a>
</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
}
}
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
?>


</div>
</div>
<div id="menu5" class="tab-pane fade">
<div class="space"></div>
<div class="row">
<?php
//organizer id......
$pro = new _spprofiles;
$result7 = $pro->read($OrganizerId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin" style=" border-radius: 15px;">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>">
<div class="col-md-3 no-padding">
<?php
echo "<img  alt='profile-Pic' style='border-radius: 10px;' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
?>
</div>
</a>
<div class="col-md-9 no-padding">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>">
<h4 class="eventcapitalize"><?php echo $row7['spProfileName']; ?></h4>
</a>
<span class="dropdown">
<button type="button" class="btn btnPosting db_btn db_primarybtn dropdown-toggle" data-sender="" data-reciver="<?php echo $_GET["profileid"]; ?>" style="margin:5px;padding: 5px 7px!important;font-size: 8px!important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane"></span> Send Message</button>

<div class="dropdown-menu bradius-15" id="popform" aria-labelledby="dropdownMenu1">
<form action="" method="post">
<div class="form-group" style="margin:3px;">
<textarea class="form-control frndmsg" rows="4" id="sndmsg" name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
</div>

<button type="button" class="btn btn-primary pull-right wthmsg db_btn db_primarybtn" data-reciver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" id="sendermesg">Send</button>
</form>
</div>
</span>
</div>

<div class="col-sm-12">

<!-- <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms">Contact Organizer</span> -->
</div>
</div>
</div>
<?php
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
//co-Host persons.
$pf  = new _postfield;
$pro = new _spprofiles;
$ei  = new _eventJoin;
if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$fieldName = "spPostingCohost_";
$result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
//echo $pf->ta->sql."<br>";
if ($result6 != false) {
while ($row6 = mysqli_fetch_assoc($result6)) {
if ($row6['spPostFieldValue'] != '') {
$profileId = $row6['spPostFieldValue'];
$result7 = $pro->read($profileId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
//print_r($row7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin" style="border-radius: 15px;">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>">
<div class="col-md-3 no-padding">
<?php
echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
?>
</div>
<div class="col-md-9 no-padding">
<h4><?php echo $row7['spProfileName']; ?></h4>
</a>
<div class="col-sm-12">
<span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms getCntactid">Contact Organizer</span>
</div>
</div>
</div>
<!-- <a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $row7['spProfileName']; ?></a>, -->
<?php
}
}
}
}
}
?>
</div>
</div>
<div id="menu6" class="tab-pane fade">

<div class="row">
<?php

if (!empty($specification)) {

?>
<div class="col-sm-12">
<p style="padding-top: 20px;padding-left: 20px;"><?php echo $specification; ?></p>
</div>
<?php


} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
?>


</div>
</div>

<div id="menu7" class="tab-pane fade in">
<div class="space"></div>
<div class="row">
<?php
$pic = new _eventpic;
$res2 = $pic->readGallery($_GET['postid']);


if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['image_name'];

?>
<div class="col-md-3">
<div class="EvntImg">
<a class="thumbnail eventpostimg mag" data-effect="mfp-newspaper" href="<?php echo $pic2; ?>" title="<?php echo $ProTitle; ?>">

<img class="group1 eventpostimg" src="<?php echo $pic2; ?>">
</a>

</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
} ?>
</div>
</div>

<!-- End tabs -->
</div>
</div>

</div>

</div>
</section>

<?php include('postshare.php'); ?>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
//alert();
$(".mySelect").select2();
$('.submitevent').click(function() {
//  alert();

var flagdesc = $('#flag_desc').val();
if (flagdesc == "") {
$('#flagdesc_error').text("This Field is Required111.");
$("#flag_desc").focus();
return false;

} else {
$("#addflagdata").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
$(function() {

$("#customerName").keydown(function(e) {

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
$('.thumbnail').magnificPopup({
type: 'image'
// other options
});
</script>

<script type="text/javascript">
function keyupflagfun() {

var flagdesc = $("#flag_desc").val()

if (flagdesc != "") {
$('#flagdesc_error').text(" ");

}


}
</script>
<script>
var _gaq = [
['_setAccount', 'UA-XXXXX-X'],
['_trackPageview']
];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s)
}(document, 'script'));
// Colorbox Call
$(document).ready(function() {
$("[rel^='lightbox']").prettyPhoto();
});
</script>

<!-- image gallery script end -->
</body>

</html>
<?php
}

?>