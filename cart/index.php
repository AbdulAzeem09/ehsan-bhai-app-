<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/


include("../univ/main.php");
require_once("../common.php");
session_start();

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "cart/";
  include_once("../authentication/check.php");
} else {

  function sp_autoloader($class)
  {
    include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");

  $cu = new _spuser;
  $cur = $cu->readcurrency($_SESSION['uid']);
  if ($cur != false) {
    $currr = mysqli_fetch_assoc($cur);
    $seller_currency = $currr['currency'];
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../component/f_links.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <style type="text/css" media="screen">


/*button css*/
.btn_st_dash_s {
  border-radius: 18px !important;
}

.float-right {
  margin-right: 15px;
}

.butn_draf {
  color: #fff !important;
  border-radius: 0;
  background-image: -moz-linear-gradient(90deg, #f60 0, #fda649 99%);
  background-image: -webkit-linear-gradient(90deg, #f60 0, #fda649 99%);
  background-image: -ms-linear-gradient(90deg, #f60 0, #fda649 99%);
  font-size: 14px;
  min-width: 130px;
}




div:where(.swal2-container).swal2-center>.swal2-popup {

  font-size: 15px;
}

.butn_draf:focus,
.butn_draf:hover {
  color: #fff;
  opacity: .8;
  background-image: -moz-linear-gradient(90deg, #f60 0, #fda649 99%);
  background-image: -webkit-linear-gradient(90deg, #f60 0, #fda649 99%);
  background-image: -ms-linear-gradient(90deg, #f60 0, #fda649 99%);
}

.btn_st_post {
  border-radius: 18px !important;
  color: #fff !important;
  border: 1px solid #0c3c38 !important;
  background-color: #0c3c38 !important;
}

.btn_st_post:focus,
.btn_st_post:hover {
  color: #fff;
  background-color: #009688;
  border: 1px solid #0c3c38;
}
.cancel
{
  background-color:red!important;
  color:black!important;
}
.confirm{
  background-color:green!important;
  color:black!important;
}

.dot pulseWarningIns
{
  display: none;
}

ul {
  list-style-type: none;
}



.butn_save {
  color: #fff;
  border-radius: 30px;
  background-image: -moz-linear-gradient(90deg, #202548 0, #202548 39%, #202548 100%);
  background-image: -webkit-linear-gradient(90deg, #202548 0, #202548 39%, #202548 100%);
  background-image: -ms-linear-gradient(90deg, #202548 0, #202548 39%, #202548 100%);
  font-size: 14px;
  min-width: 130px;
}

.butn_update {
  color: #fff;
  border-radius: 40px;
  font-size: 14px;
  min-width: 100px;
  font-weight: 20px;
/*background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);*/
background-image: -webkit-linear-gradient(90deg, #0f8c19 0, #45be51 100%);
}

.rating-box {
  position: relative !important;
  vertical-align: middle !important;
  font-size: 18px;
  font-family: FontAwesome;
  display: inline-block !important;
  color: lighten(@grayLight, 25%);
  padding-bottom: 10px;
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

< !-- Saved for later card css -->img {
  height: 150px;
  width: 100%;
}

.item {
  padding-left: 5px;
  padding-right: 5px;
}

.item-card {
  transition: 0.5s;
  cursor: pointer;
}

.item-card-title {
  font-size: 15px;
  transition: 1s;
  cursor: pointer;
}

.item-card-title i {
  font-size: 15px;
  transition: 1s;
  cursor: pointer;
  color: #ffa710
}

.card-title i:hover {
  transform: scale(1.25) rotate(100deg);
  color: #18d4ca;
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
}

.card-text {
  height: 80px;
}

.card::before,
.card::after {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  transform: scale3d(0, 0, 1);
  transition: transform .3s ease-out 0s;
  background: rgba(255, 255, 255, 0.1);
  content: '';
  pointer-events: none;
}

.card::before {
  transform-origin: left top;
}

.card::after {
  transform-origin: right bottom;
}

.card:hover::before,
.card:hover::after,
.card:focus::before,
.card:focus::after {
  transform: scale3d(1, 1, 1);
}

#notification_count {
  margin-top: -40px;
  margin-left: 0px;
}

}
</style>
<style>
  .sweet-alert {
    width: 370px !important;

  }
</style>
<!--<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>-->
</head>

<body onload="pageOnload('cart')" class="bg_gray">
  <?php
  include_once("../header.php");
  ?>
  <section class="landing_page">
    <?php if ($_SESSION['pfailed'] == 2) {
      unset($_SESSION['pfailed']); 
      ?>
      <div class="alert alert-danger" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Payment Failed! </strong>
        <?php
        if(!empty($_SESSION['pfailed_reason'])){
          echo '<strong>'.$_SESSION['pfailed_reason'].' </strong>';
          unset($_SESSION['pfailed_reason']);
        }
        ?>
        
      </div>
      <?php
    }

    if ($_SESSION['psuccess'] == 1) {
      unset($_SESSION['psuccess']); ?>
      <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>The payment was successful.  You can visit the module's dashboard to view your order details.</strong>   
        <!--<a href="<?php echo $BaseUrl ?>/artandcraft/dashboard/my_order.php">Order History.</a>-->
      </div>
    <?php  }
//print_r($_SESSION);
    ?>


    <?php if ($_SESSION['shippo_error']) {
      ?>
      <div class="alert alert-danger" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong><?php echo $_SESSION['shippo_error']; ?></strong>
      </div>
      <?php
      unset($_SESSION['shippo_error']);
    }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="cartbox bradius-15" style="margin-top: 10px;">
            <div class="cart_header">
              <h3 style="color: #032350;"><i class="fa fa-shopping-cart"></i>&nbsp;Cart</h3>
            </div>
            <div class="cart_body">
              <?php
              $p = new _order;
              if ($_GET['action'] == 'addtocart') {
                $arr = array("saveforlater" => 0);
                $ad = $p->addtocart($arr, $_GET['id']);
              }
              $p = new _order;

              $rpvt = $p->readCartItemsavedforlater($_SESSION['uid']);

              if ($rpvt != false) {
                while ($row = mysqli_fetch_assoc($rpvt)) {
                  if ($row['cartItemType'] == 'Store') {
                  }
                }
              }




$p = new _spcustomers_basket;
$rpvsst = $p->readCartItemnew($_SESSION['uid']);

if ($rpvsst != false) {

  while ($rowss = mysqli_fetch_assoc($rpvsst)) {
    $sid = $rowss['spSellerProfileId'];
  }
}
$i = new _spprofiles;
$i1 = $i->read_img($sid);
//var_dump($i1);
if ($i1 != false) {
  $i11 = mysqli_fetch_assoc($i1);
//print_r($i11);
  $usid = $i11['spUser_idspUser'];
//echo $usid;
}


$paymentMessage = '';
if (!empty($_POST['stripeToken'])) {

  $pi = new _spcustomers_basket;
  $it = $pi->readtypeitembystore($_SESSION['uid'], $_POST['seller_id']);
//var_dump($it);
  if ($it != false) {
    $famount = 0;
    while ($itt = mysqli_fetch_assoc($it)) {
//print_r($itt);
      $quantity = $itt['spOrderQty'];
      $amount = $itt['sporderAmount'];
      $finalamount = $quantity * $amount;
      $famount = $famount + $finalamount;
    }
//echo $famount;
  }



//echo $sid;die;
  $it11 = $pi->readtypeitembyartandcraft($_SESSION['uid'], $_POST['seller_id']);
//var_dump($it11);
  if ($it11 != false) {
    $famt = 0;
    while ($itt11 = mysqli_fetch_assoc($it11)) {
//print_r($itt11);
      $quant = $itt11['spOrderQty'];
      $amot = $itt11['sporderAmount'];
      $finamt = $quant * $amot;
      $famt = $famt + $finamt;
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
  $cardString = strtolower($customerName) . "||" . $cardNumber . "||" . $cardExpMonth . "||" . $cardExpYear . "||" . $cardCVC;

//$cardDetails = PHP_AES_Cipher::encrypt($encrypt_key, $encrypt_iv, $cardString);


  $u = new _spuser;
  $resultbok = $u->read($_SESSION['uid']);
  if ($resultbok != false) {
    $bookedbuy = mysqli_fetch_array($resultbok);
//print_r($bookedbuy);
    $customerEmail =   $bookedbuy['spUserEmail'];
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
//die('====');
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
//$orderNumber ="WER12345";   
    $orderNumber = "WER" . rand(10000000, 99999999);
//print_r($_POST); die('=================');
// details for which payment performed
//die('dfhgsdfh');
//echo $customer->id.' '.$totalAmount.' '.$currency.' '.$orderNumber;

    $payDetails = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $totalAmount * 100,
      'currency' => $currency,
      'description' => 'ITEM NAME',
      'metadata' => array(
        'order_id' => $orderNumber
      )
    ));
/* print_r($payDetails).'<br>';
die('====');
print_r($paymenyResponse);*/


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

//die('00000');
$orderid = "";
$p = new _order;
$rpvtforss = $p->readselleritem_sold($_SESSION['uid'], $_POST['seller_id']);
if ($rpvtforss != false) {
  while ($rownewsold = mysqli_fetch_assoc($rpvtforss)) {
//print_r($rownewsold);

    $id = $rownewsold['idspOrder'];

    $orderid  = $id . '' . $orderid;
  }
}


if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {
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
    "payer_email" => $customerEmail,
    "payer_id" => $payer_id,
    "payer_status" => $payer_status,
    "payment_status" => $paymentStatus,
    "first_name" => $customerFname,
    "last_name" => $customerLname,
    "txn_id" => $balanceTransaction,
    "currency" => $currency,
    "quantity" => $orderQty,
    "payment_date" => $paymentDate,
    "buyer_uid" => $_SESSION['uid'],
    "buyer_pid" => $_SESSION['pid'],
    "payment_gross" => $totalAmount,
    "sellerid" => $seller_id,
    "shippAddress" => $shpping_Address1,
    "basketid" => $orderid
  );
  // $cardDetails

  $paass = new _spcustomers_basket;

  $paass->updateorderstatusnew($_SESSION['uid'], $seller_id);

  $uu = new _spprofiles;

  $resultu = $uu->read($ArtistId);
  if ($resultu != false) {
    $row6 = mysqli_fetch_array($resultu);
    $evetpostuid = $row6['spUser_idspUser'];
    $posteduseremail =    $row6['spProfileEmail'];
    $postedusername =  $row6['spProfileName'];

    $resultboku = $uu->read($_SESSION['pid']);
    if ($resultboku != false) {

      $bookedbuyu = mysqli_fetch_array($resultboku);


      $bokkedbynameu = $bookedbuyu['spProfileName'];
      $bookeduseremail =    $bookedbuyu['spProfileEmail'];
    }

    $event_title = '<a style="text-decoration: underline;" href="' . $BaseUrl . '/events/event-detail.php?postid=' . $_GET['postid'] . '">' . $ProTitle . '</a>';

    $e = new _email;
  ////// email to event Organizer
    $e->sendeventbooked($postedusername, $posteduseremail, $event_title, $bokkedbynameu, $orderQty, $totalAmount);


  //// email to buyer
    $e->sendeventbooked($postedusername, "ecommerceguru13@gmail.com", $event_title, $bokkedbynameu, $orderQty, $totalAmount);
  }

  /*$oi= new _spcustomers_basket;
  $oid= $oi->newupdate($_SESSION['uid'],$seller_id);
  print_r($oid);*/

  $orderid = "";
  $p = new _order;
  $rpvtforss = $p->readselleritem_sold($_SESSION['uid'], $_POST['seller_id']);
  if ($rpvtforss != false) {
    while ($rownewsold = mysqli_fetch_assoc($rpvtforss)) {

      $id = $rownewsold['idspOrder'];

  //echo $id;
      $orderid  = $id . ',' . $orderid;

  //echo "<br>";
  //echo $orderid; 
  //die("===================");
    }
  }

  //    echo $orderid;
  //    die('---------');




  $sppr = new _spprofiles;
  $spprofiole = $sppr->read($_POST['seller_id']);

  $spprofiole = mysqli_fetch_assoc($spprofiole);
  $spUser_idspUser = $spprofiole['spUser_idspUser'];





  $pet = new _spevent_transection;

  $tr_id = $pet->createagain($data);
  $orderid  = $id;

  //notification   for seller

  $msg = " <b>Order Recieved</b> : Congratulations , you have received a new order ,<a  href='$BaseUrl/store/dashboard/sellerstatusnew.php?postid=$orderid'>Click to View</a> ";

  $noti = new _notification;

  $data = array(
    'from_id' => $_SESSION['pid'],
    'to_id' => $_POST['seller_id'],
    'message' => $msg,
    'module' => "store",
    'by_seller_or_buyer' => 2
  );

  $postnoti = $noti->noti_create($data);



  //notification   for buyer

  //<b>Order Placed</b> : Congratulations ,  Your order of ORDER_10 has been successfully placed ,<a href="/artandcraft/dashboard/invoice.php?order=MTA=">Click to View</a>

  $msg1 = " <b>Order Placed</b> : Congratulations ,  Your order of ORDER_10 has been successfully placed ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$orderid'>Click to View </a> ";
  $data = array(
    'from_id' => $_POST['seller_id'],
    'to_id' => $_SESSION['pid'],
    'message' => $msg1,
    'module' => "store",
    'by_seller_or_buyer' => 1
  );

  $postnoti = $noti->noti_create($data);


  //from_id  = seesion pid
  //to_id  = _POST['seller_id']);
  //message = <b>Order Recieved</b> : Congratulations , you have received a new order ,<a href="/artandcraft/dashboard/order-invoice.php?order=MQ==">Click to View</a>
  //https://dev.thesharepage.com/store/dashboard/sellerstatus.php?postid=96  //$orderid

  //module = store
  //by_seller_or_buyer  = 2






  $p = new _order;
  $rpvt = $p->readselleritem($_SESSION['uid'], $seller_id);
  if ($rpvt != false) {
    $cartitem = 0;
    while ($row = mysqli_fetch_assoc($rpvt)) {
      $rpvtnew = $p->resdnewagain($row['idspOrder']);
      while ($rownew = mysqli_fetch_assoc($rpvtnew)) {

        $rpvtnewad = $p->resdnewagainnewsa($rownew['idspPostings']);

        if ($rpvtnewad != false) {
          $rownewadss = mysqli_fetch_assoc($rpvtnewad);
        }
        $datanew = array(
          "spPostings_idspPostings" => $rownew['idspPostings'],
          "spOrderQty" => $row['spOrderQty'],
          "price" => $rownewadss['spPostingPrice'],
          "sellerPid" => $rownewadss['spProfiles_idspProfiles'],
          "txn_id" => $tr_id
        );


        $dfgdfb = $pet->createagainnew($datanew);


        $n = new _notification;

        $to_id = $rownewadss['spProfiles_idspProfiles'];
        $from_id = $_SESSION['pid'];
        $module = 'artcraft';
        $by_seller_or_buyer = 2;
        $by_seller_or_buyer1 = 1;

        $message1 =  '<b>Order Placed</b> : Congratulations ,  Your order of ORDER_' . $tr_id . ' has been successfully placed ,<a href="/artandcraft/dashboard/invoice.php?order=' . base64_encode($tr_id) . '">Click to View</a>';

        $message =  '<b>Order Recieved</b> : Congratulations , you have received a new order ,<a href="/artandcraft/dashboard/order-invoice.php?order=' . base64_encode($tr_id) . '">Click to View</a>';

        $n->createCreatenotification($from_id, $to_id, $message, $module, $by_seller_or_buyer);

        $n->createCreatenotificationchart($to_id, $from_id, $message1, $module, $by_seller_or_buyer1);
      }
    }
  }







  $paymentMessage = "The payment was successful. Order ID: {$tr_id}";
  //$update_qty = $Quantity - $orderQty;
  //$p->update(array('ticketcapacity' => $update_qty),"WHERE t.idspPostings =" . $_REQUEST["postid"]);


  //if order inserted successfully
  if ($tr_id && $paymentStatus == 'succeeded') {
    $paymentMessage = "The payment was successful. Order ID: {$tr_id}";
  } else {
  //$paymentMessage = "failed";
  }

  //anoop
  $pay = array(
    'buyer_userid' => $_SESSION['uid'],
    'seller_userid' => $usid,
    'amount' => $famount,
    'orderid' => $orderid,
    'balanceTransaction' => $balanceTransaction,
    'date_txn' =>  date("Y-m-d h:i:sa")
  );



  $oi = new _spcustomers_basket;
  //die('=====');
  $oi->create1($pay);




  $pay1 = array(
    'buyer_userid' => $_SESSION['uid'],
    'seller_userid' => $usid,
    'amount' => $famt,
    'orderid' => $orderid,
    'balanceTransaction' => $balanceTransaction,
    'date_txn' =>  date("Y-m-d h:i:sa")
  );

  $wat = new _spcustomers_basket;
  $wat->createforartandcraft($pay1);

  ?>
  <?php ?>
  <div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>The payment was successful.  You can visit the module's dashboard to view your order details </strong>
  </div>
  <script>
    $(document).ready(function() {
  // $("#success-alert").hide();
      $("#payNow").click(function showAlert() {
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
          $("#success-alert").slideUp(500);
        });
      });
    });
  </script>
  <?php 
} 
else { 
  ?>
  <!--<div class="alert alert-danger" id="danger-alert">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Payment Failed! </strong>
</div>-->
<script>
  $(document).ready(function() {
  // $("#success-alert").hide();
    $("#payNow").click(function showAlert() {
      $("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
        $("#danger-alert").slideUp(500);
      });
    });
  });
</script>
<?php    
}
//echo $balanceTransaction;

?>
<?php
}  //die('========');
/*$pe = new _spcustomers_basket;
$anoop=$pe->readid($_SESSION['pid']);

$pi=mysqli_fetch_assoc($anoop);
print_r($pi);
$postid=$pi['idspPostings'];*/



/*$pr = new _productposting;
$pro = $pr->read($postid);



if ($pro != false) {
//print_r($pro);
while($pror = mysqli_fetch_assoc($pro)){
//print_r($pror);die;
//$spPostingTitle = $prorow['spPostingTitle'];
$sippingch=$pror['sippingcharge'];
$fixedamt=$pror['fixedamount'];

if($sippingch==0){
$sippingch=0;
}
if($sippingch==1){
$sippingch+=$fixedamt;
//echo $sippingch;die('========');
}
if($sippingch==2){
$sippingch=0;
}
}  
}*/


$p = new _spcustomers_basket;


$sippingch111 = 0;
$u_seller = array();

$rpvsst = $p->readCartItemnew($_SESSION['uid']);
if ($rpvsst != false) {

  while ($rowss = mysqli_fetch_assoc($rpvsst)) {
    $sid = $rowss['spSellerProfileId'];

    $u_seller[] =  $spOrderQtyghg = $rowss['spSellerProfileId'];
  }
}
$u_seller = array_unique($u_seller); // 1,2

if ($u_seller != false) {
  foreach ($u_seller as $values) {
    $total = 0;
    $total1 = 0;
    $totalcart = 0;
    $disc_price1 = 0;
    $sporderAmountnewnew = 0;
    $totalshippingcharge = 0;

    $rpvtforss = $p->readselleritem($_SESSION['uid'], $values);
    $totalpricenewnewforss = 0;
    $prs = new _spprofiles;
    $result12 = $prs->read($values);
    if ($result12 != FALSE) {
      $resprofile = mysqli_fetch_array($result12);
//print_r($resprofile);
      $usid = $resprofile['spUser_idspUser'];
      $userid = $resprofile['idspProfiles'];
      $sellerNmae = $resprofile['spProfileName'];
    } else {
      $sellerNmae = "";
    }

    $cu = new _spuser;
    $seller_currency = 0;
    $cur = $cu->readcurrency($usid);
    if ($cur != false) {
      $currr = mysqli_fetch_assoc($cur);
      $seller_currency = $currr['currency'];  


    }

    $rpvt = $p->readselleritem($_SESSION['uid'], $values);

//print_r($rpvt);
    if ($rpvt != false) {

      $cartitem = 0;
      $totalitem = 0;
      $totalpricenewnew = 0;
      $totalspOrderQtyamount = 0;
      $discprice = 0;
      while ($row = mysqli_fetch_assoc($rpvt)) {


//echo "<pre>";
// print_r($row);
        $itemType = $row['cartItemType'];
        $spOrderQtyghg = $row['spOrderQty'];

        $idspOrdedsfdsr = $row['idspOrder'];
        $baketorderid = $row['idspOrder'];

        $spOrderQty = $row['spOrderQty'];
        $totalitem = $totalitem + $spOrderQty;

        ?>
        <div class="row">
          <div class="col-md-6">
            <?php if ($itemType == 'Store') { ?>
              <b>Seller : <a href="/store/my-all-product.php?userid=<?php echo $userid; ?>"><?php echo $sellerNmae; ?></a></b>
            <?php } else { ?>
              <b>Seller : <a href="/artandcraft/seller-store.php?profileid=<?php echo $values; ?>&page=1"><?php echo $sellerNmae; ?></a></b>
            <?php } ?>
          </div>
          <div class="col-md-6">
            <span class="pull-right" style="font-size:15px;"><b>Currency:</b>&nbsp;<?php echo $seller_currency; ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9"></div>
        </div>
        <hr style="border: -1px solid Grey;margin-top: 0px;">
        <?php

//echo $totalitem.'====';
//$dc= new _spproducts;
        if ($itemType == 'Store') {
          $dc1 = $p->readp($row['idspPostings']);
          if ($dc1 != false) {
            $dc2 = mysqli_fetch_assoc($dc1);
            $sporderAmountnewnew = $dc2['spPostingPrice'];

            $disc_price = $dc2['discounted_price'];
          }
        }



        $pf  = new _postfield;

        if ($itemType == 'artandcraft') {
          $dc1 = $p->readart($row['idspPostings']);
          if ($dc1 != false) {
            $dc2 = mysqli_fetch_assoc($dc1);
//echo "<pre>";
// print_r($dc2);

            $price_art = $dc2['spPostingPrice'];
            $disco_art = $dc2['discountphoto'];
          }
          $result_pf = $pf->read_quantity($row['idspPostings']);
          $row2 = mysqli_fetch_assoc($result_pf);
//echo "<pre>";
//print_r($row2);
          $art_quantity = $row2['spPostFieldValue'];
//echo $art_quantity;
//die('====11');
        }




        $pr = new _productposting;
        $pro = $pr->read($row['idspPostings']);
//var_dump($pro);
        if ($pro != false) {

          $pror = mysqli_fetch_assoc($pro);
//print_r($pror);
//die('===');

          $qty_d = $pror['retailQuantity'];
          $pri = $pror['spPostingPrice'];

          if ($pror['sellType'] == 'Retail') {
            $disco = $pror['retailSpecDiscount'];
          }
          if ($pror['sellType'] == 'Wholesale') {
            $disco = $pror['spPostingPrice'];
          }

          if ($pror['sellType'] == 'Personal') {
            $disco = $pror['retailSpecDiscount'];
          }



//echo $disco;
          if ($disco != 0) {
//echo 'zz';
            $org_pr = ((int)$disco * (int)$pri) / 100;
          }



// $disc_price = ($pri-$org_pr);

//    $discprice= ($discprice + $disc_price);
//echo $discprice;


          $sippingch = $pror['sippingcharge'];
          $fixedamt = $pror['fixedamount'];
//echo $fixedamt;


        }


        if ($itemType == 'Store') {
          $disc_price = $disco;
        }


        if ($itemType == 'artandcraft') {
          $disc_price = $disco_art;
        }



//echo $spOrderQty.'<br>';
//echo $disc_price;

        $totalcart += ((int)$disc_price * (int)$spOrderQty);

        $at = $pr->readfromartcraft($row['idspPostings']);
        if ($at != false) {
          $art = mysqli_fetch_assoc($at);
          $sippingcharge1 = $art['sippingcharge'];
//echo $sippingcharge1.'<br>';
          $fixedamount1 = $art['fixedamount'];
//echo $fixedamount1;
        }



        $qty = $rowrpvtforss['spOrderQty'];
//$totalpricenewnewforss +=($qty*$fixedamount+$sippingch);
//echo $totalpricenewnewforss;


//$sippingch111 = $sippingch + $sippingch111 ;
//echo $sippingch111;

//echo $sporderAmountnewnew;die;
        $totalspOrderQtyamount = $totalspOrderQtyamount + ($spOrderQty * $sporderAmountnewnew);
//$disc_price1=$disc_price+($spOrderQty*$sporderAmountnewnew);
//echo $disc_price1;




        $cartitem++;
// Getting the item type

        $title = $row['spPostingTitle'];
        ?>
        <?php
/*$m = new _postfield;
$res = $m->readfield($row["idspPostings"]);*/

//Quantity Availability

$pr = new _postfield;
$re = $pr->quantity($row["idspPostings"]);

if ($re != false) {


  $i = 0;
  $rw = mysqli_fetch_assoc($re);
  $totalquantity = $rw["spPostFieldValue"];
} else {
  $totalquantity = 0;
}


$or = new _spcustomers_basket;
$soldquantity  = 0;
$res = $or->quantityavailable($row["idspPostings"]);

if ($res != false) {
//print_r($res);


  while ($order = mysqli_fetch_assoc($res)) {

//print_r($order);
    if ($order["spOrderStatus"] == 0) {
      $soldquantity += $order["spOrderQty"];
    }
  }
}
//die('======');
$available = 0;
if ($totalquantity) {
  $available = $totalquantity - $soldquantity;
//echo $available;
}
//echo $available;
if ($available == 0) {

  $max = 1;
}

//echo $available;die;
$max = $available;
//Quantity Availability Completed
$postingid = $row["idspPostings"];
$totalqtyprice = $spOrderQtyghg * $row['sporderAmount'];
$price = $row['sporderAmount'];
$totalprice += $totalqtyprice;

echo "<div class='row'>
<div class='col-md-2' style='width:100px;float:left;border: 1px solid gray;border-radius: 11px;padding-top: 10px;
padding-bottom: 10px;'>";
if ($itemType == 'Training') {
  echo "<a href='../trainings/detail.php?postid=" . $row["idspPostings"] . "'> ";
  $pc = new _postingpic;
  $tr = new _postingview;
  $result = $tr->singletimelines($postingid);

  $row = mysqli_fetch_assoc($result);
//print_r($row);
  $trTitle   = $row['spPostingTitle'];
  $res = $pc->readFeature($postingid);
  $active1 = 0;

  if ($res != false) {
    $active2 = 0;
    $postr = mysqli_fetch_assoc($res);
//print_r($postr);
    $picture = $postr['spPostingPic'];

    if ($active2 == 0) {
      $pic = $picture;
    } ?>
    <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" style='height: 90px; width: 100px;'>
    <?php
    $active2++;
  } else {
    echo "<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 90px; width:100px;'>";
  }

  echo "</a>";
} elseif ($itemType == 'artandcraft') {

  echo "<a href='../artandcraft/detail.php?postid=" . $postingid . "'> ";

  $pic = new _postingpicartcraft;
  $res2 = $pic->read($postingid);
//Quantity
  if ($res2 != false) {
    $rp = mysqli_fetch_assoc($res2);
//print_r($rp);

    $pic2 = $rp['spPostingPic'];

    ?>
    <img src="<?php echo ($pic2); ?>" alt="Posting Pic" class="img-responsive" style='height: 90px; width: 100px;'>
    <?php
    $active2++;
  } else {
    echo "<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 90px; width:100px;'>";
  }

  echo "</a>";
} else {

  echo "<a href='" . $BaseUrl . "/store/detail.php?postid=" . $row["idspPostings"] . "'> ";


  $pc = new _productpic;
  $res2 = $pc->read($row["idspPostings"]);

  if ($res2 != false) {
    $rp = mysqli_fetch_assoc($res2);
    $pic2 = $rp['spPostingPic'];
    ?>
    <img src="<?php echo ($pic2); ?>" alt="Posting Pic" class="img-responsive" style='height: 60px; width: 100px;'>
    <?php
    $active2++;
  } else {
    echo "<img src='../img/no.png' alt='Posting Pic' class='img-responsive' style='margin: 0 auto;'' style='height: 60px; width:100px;'>";
  }

  echo "</a>";
}

echo "</div>
<div class='col-md-10' style='padding-left:0%;float:left;padding-right: 0px;'>
<ul class='a-unordered-list a-nostyle a-vertical a-spacing-mini'>
<li>";
if ($itemType == 'Training') {

  echo "<a class='a-link-normal sc-product-link' href='../trainings/detail.php?postid=" . $row["idspPostings"] . "'
  style='font-size: 24px;'>" . ucfirst($row['spPostingTitle']) . "</a>";
} elseif ($itemType == 'artandcraft') {

  $pcraft = new _postingviewartcraft;

  $resultc = $pcraft->singletimelines($postingid);

  $pf  = new _postfield;



  $result_pf8 = $pf->read($row['idspPostings']);

  while ($row29 = mysqli_fetch_assoc($result_pf8)) {

    if ($row29['spPostFieldName'] == 'quantity_') {
      $retailQty = $row29['spPostFieldValue'];
    }
  }

//echo $Quantity;


//echo $p->ta->sql;
  if ($resultc != false) {

    $rowc = mysqli_fetch_assoc($resultc);


    $ProTitle   = $rowc['spPostingTitle'];

    $retailQty1   = $rowc['retailQuantity'];
    $curr   = $rowc['defaltcurrency'];
  }


  echo "<a class='a-link-normal sc-product-link' href='../artandcraft/detail.php?postid=" . $postingid . "'
  style='font-size: 21px;'>" . ucfirst($ProTitle) . "</a>";  
} else {
  $produ = new _productposting;
  $prodata = $produ->read($postingid);


// $poster_detail = $pro->read()
  if ($prodata != false) {
    while ($prorow = mysqli_fetch_assoc($prodata)) {
// print_r($prorow);
// $fixed=0;
//$curr=$prorow['default_currency'];
      $spPostingTitle = $prorow['spPostingTitle'];
      $sippingcharge = $prorow['sippingcharge'];

      echo "&nbsp<a class='a-link-normal sc-product-link' href='" . $BaseUrl . "/store/detail.php?postid=" . $row["idspPostings"] . "'style='font-size: 21px;    margin-left: -6px;'>" . ucfirst($spPostingTitle) . "</a><br>";

      if ($prorow['sellType'] == 'Retail') {
        $retailQty = $prorow['retailQuantity'];
        if ($retailQty > 0) {
          echo "In stock";
        } else {
          echo "Out of stock";
        }
      }

      if ($prorow['sellType'] == 'Personal') {
        $retailQty = $prorow['retailQuantity'];
        if ($retailQty > 0) {
          echo "In stock";
        } else {
          echo "Out of stock";
        }
      }
      if ($prorow['sellType'] == 'Wholesaler') {
        $retailQty = $prorow['supplyability'];
        if ($retailQty > 0) {
          echo "In stock";
        } else {
          echo "Out of stock";
        }
      }

      $fixedamount = $prorow['fixedamount'];
      $Quantity = $prorow['auctionQuantity'];
      $fixed = $fixedamount + $fixed;
//echo $fixed.'======';
/*echo $sippingcharge.'<br>';
echo $fixedamount;
die;*/
}
}


}
echo "<span class='a-dropdown-container' style='padding-left:30px;'>";
if ($itemType != 'Training') {
  echo "<label class='a-native-dropdown'>Qty:<span class='sc-offscreen-label' aria-label='Quantity'></span>
  </label>";
}

?>
<?php
//echo $row["retailQuantity"];
if ($itemType != 'Training') {

  if ($row['sellType'] == "Wholesaler") { ?>
    <input type="number" class="liveQty" id="liveQty" name="quantity" value="<?php echo $row['minorderqty']; ?>" min="0" min="5" onkeyup="this.value = minmax(this.value, <?php echo $row['minorderqty']; ?>, <?php echo $row['supplyability']; ?>)" style="width: 50px;" maxlength="5" />
  <?php } else {
    if ($itemType == 'artandcraft') {
      ?>
      <select name='quantity2' class='quantity' autocomplete='off' tabindex='0' class='a-native-dropdown' <?php echo $max ?> value='<?php echo $row['spOrderQty'] ?>' data-title='<?php echo $row['spPostingTitle'] ?>' data-available='<?php echo $available8 ?>' data-price='<?php echo $row['spPostingPrice'] ?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $idspOrdedsfdsr; ?>'>
        <?php

        for ($i = 1; $i <= $art_quantity; $i++) {
          ?>
          <option value='<?php echo $i; ?>' <?php if ($row['spOrderQty'] == $i) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>

    <?php } else { ?>
      <select name='quantity1' class='quantity' autocomplete='off' tabindex='0' class='a-native-dropdown' <?php echo $max ?> value='<?php echo $row['spOrderQty'] ?>' data-title='<?php echo $row['spPostingTitle'] ?>' data-available='<?php echo $available8 ?>' data-price='<?php echo $row['spPostingPrice'] ?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $idspOrdedsfdsr; ?>'>
        <?php

        for ($i = 1; $i <= $qty_d; $i++) {
          ?>
          <option value='<?php echo $i; ?>' <?php if ($row['spOrderQty'] == $i) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>
    <?php }
  }
}
if ($itemType != 'Training') {
  echo "&nbsp;<span class='sp-order a-link-normal' data-oid='" . $row['idspOrder'] . "' data-postid='" . $postingid . "' data-catid='" . $row['spCategories_idspCategory'] . "'  data-quantity='" . $quantity . "' data-remainingquant='" . $available . "' data-subtotal='" . $subtotal . "'  data-profileid='" . $_SESSION["pid"] . "' data-startdate='' data-enddate='' data-categoryid=''>
  <a href='javascript:void(0)' class='remove_order1' onclick='permanentDelete($idspOrdedsfdsr)'
  data-oid='" . $idspOrdedsfdsr . "'>Delete</a><span>
  &nbsp; | &nbsp;";
  echo "<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('" . $idspOrdedsfdsr . "',1)  data-oid='" . $idspOrdedsfdsr . "' data-savestatus='1' id='saveproduct' >Save for later</a>";
}
echo "</li>";

if ($itemType != 'Training') {
// echo $itemType;



// echo "<li><span class=''>In stock</span></li>";
}


echo "</li>";
if ($itemType == 'Store') {
//echo "<li><span class=''> </span></li>";
  if ($sippingcharge == 1) {
    echo "Shipping Charges:Free Shipping";
  }
  if ($sippingcharge == 2) {
    $left_qty = $row['spOrderQty'] - 1;
    $left_wty_amt = $left_qty * .25 * $fixedamt;
    $sippingch = $fixedamt + $left_wty_amt;
//var_dump($fixedamount); 
    echo "Shipping Charges: " . $sippingch . " (Fixed)";
    $total += $sippingch;
  }
/*if($sippingcharge==2){
echo "Shipping Charges: As Per Courier";
}*/

//echo $sippingch.'<br>';

}
// $total1=0;
if ($itemType == 'artandcraft') {
//echo "<li><span class=''> </span></li>";
  if ($sippingcharge1 == 1) {
    echo "Shipping Charges:Free Shipping";
  }
  if ($sippingcharge1 == 2) {
//echo $row['spOrderQty'];
    $left_qty = $row['spOrderQty'] - 1;
    $left_wty_amt = $left_qty * .25 * (int)$fixedamount1;
    $sippingcharge1 = (int)$fixedamount1 + $left_wty_amt;
    echo "Shipping Charges: " . $sippingcharge1 . " (Fixed)";
    $total1 += $sippingcharge1;
  }
/*if($sippingcharge1==2){
echo "Shipping Charges: As Per Courier";
}*/

//echo $total1;

}
//echo $total.' ========== '.$total1;
$totalshippingcharge = $total + $total1;
//echo $totalshippingcharge;

$userid = $_SESSION['uid'];


$c = new _orderSuccess;


$currency = $c->readcurrency($userid);
$res1 = mysqli_fetch_assoc($currency);
//$curr=$res1['currency'];


$baketattrib = $p->readattribute($postingid, $baketorderid, $itemType);

$optionvaues = new _spproductoptionsvalues;

if ($baketattrib != false) {

  while ($attribrow = mysqli_fetch_assoc($baketattrib)) {

    $idsopvdata = $optionvaues->singleread($attribrow['size_idsopv']);
    if ($idsopvdata == "") {
      $datavalues = "";
    } else {
      $datavalues = mysqli_fetch_assoc($idsopvdata);

      $idsopdata = $optionvaues->singleread($attribrow['color_idsopv']);

      $dataname = mysqli_fetch_assoc($idsopdata);


      echo "<li><strong>Color:</strong> " . $dataname['opton_values'] . "</li>";

      echo "<li><strong>Size:</strong> " . $datavalues['opton_values'] . "</li>";
    }
  }
}

echo "</ul>
<div class='a-row' style=''>
<span class='a-dropdown-container' style='padding-left: 40px;'>";
if ($itemType != 'Training') {
  echo "<label style='display:none;' class='a-native-dropdown'>
  Qty:<span class='sc-offscreen-label' aria-label='Quantity'></span>
  </label>";
}

?>
<?php
if ($itemType != 'Training') {

  if ($row['sellType'] == "Wholesaler") { ?>
    <input type="number" class="liveQty" id="liveQty" name="quantity" value="<?php echo $row['minorderqty']; ?>" min="0" min="5" onkeyup="this.value = minmax(this.value, <?php echo $row['minorderqty']; ?>, <?php echo $row['supplyability']; ?>)" style="width: 50px;" maxlength="5" />
  <?php } else {  ?>
    <select name='quantity' style='display:none;' class='quantity' autocomplete='off' tabindex='0' class='a-native-dropdown' <?php echo $max ?> value='<?php echo $row['spOrderQty'] ?>' data-title='<?php echo $row['spPostingTitle'] ?>' data-available='<?php echo $available ?>' data-price='<?php echo $row['spPostingPrice'] ?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $idspOrdedsfdsr; ?>'>
      <option value='1' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "1") {
        echo "selected";
      } ?>>1</option>
      <option value='2' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "2") {
        echo "selected";
      } ?>> 2 </option>
      <option value='3' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "3") {
        echo "selected";
      } ?>> 3 </option>
      <option value='4' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "4") {
        echo "selected";
      } ?>> 4 </option>
      <option value='5' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "5") {
        echo "selected";
      } ?>> 5 </option>
      <option value='6' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "6") {
        echo "selected";
      } ?>> 6 </option>
      <option value='7' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "7") {
        echo "selected";
      } ?>> 7 </option>
      <option value='8' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "8") {
        echo "selected";
      } ?>> 8 </option>
      <option value='9' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "9") {
        echo "selected";
      } ?>> 9 </option>
      <option value='10' data-a-css-class='quantity-option' <?php if ($spOrderQtyghg == "10") {
        echo "selected";
      } ?>> 10 </option>
    </select>
  <?php }
} ?>
<?php
if ($itemType != 'Training') {
//echo"&nbsp;  &nbsp";
  if ($row['subcategory'] == "Shoes") {
    $s = new _spproductsize;
    $allsize = $s->read($row['idspPostings']);
    $size = mysqli_fetch_assoc($allsize);
    $sizeselected === $row['size'];
    ?>
    <tr>
      <td><strong>Size:</strong></td>
      <td>
        <select id="showsize" class="cartproductsize" data-price='<?php echo $row['spPostingPrice'] ?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $row['idspOrder']; ?>'>
          <option value="shoesize1" style="<?php if ($size['shoesize1'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize1') {
            echo "selected";
          } ?>>1</option>
          <option value="shoesize2" style="<?php if ($size['shoesize2'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize2') {
            echo "selected";
          } ?>>2</option>
          <option value="shoesize3" style="<?php if ($size['shoesize3'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize3') {
            echo "selected";
          } ?>>3</option>
          <option value="shoesize4" style="<?php if ($size['shoesize4'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize4') {
            echo "selected";
          } ?>>4</option>
          <option value="shoesize5" style="<?php if ($size['shoesize5'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize5') {
            echo "selected";
          } ?>>5</option>
          <option value="shoesize6" style="<?php if ($size['shoesize6'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize6') {
            echo "selected";
          } ?>>6</option>
          <option value="shoesize7" style="<?php if ($size['shoesize7'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize7') {
            echo "selected";
          } ?>>7</option>
          <option value="shoesize8" style="<?php if ($size['shoesize8'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize8') {
            echo "selected";
          } ?>>8</option>
          <option value="shoesize9" style="<?php if ($size['shoesize9'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize9') {
            echo "selected";
          } ?>>9</option>
          <option value="shoesize10" style="<?php if ($size['shoesize10'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize10') {
            echo "selected";
          } ?>>10</option>
          <option value="shoesize11" style="<?php if ($size['shoesize11'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize11') {
            echo "selected";
          } ?>>11</option>
          <option value="shoesize12" style="<?php if ($size['shoesize12'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize12') {
            echo "selected";
          } ?>>12</option>
          <option value="shoesize13" style="<?php if ($size['shoesize13'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize13') {
            echo "selected";
          } ?>>13</option>
          <option value="shoesize14" style="<?php if ($size['shoesize14'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'shoesize14') {
            echo "selected";
          } ?>>14</option>
        </select>
      </td>
    </tr>
    <?php
  }
}
if ($itemType != 'Training') {

  if ($row['subcategory'] == "Clothing") {

    $cs = new _spproductsize;
    $csize = $cs->read($row['idspPostings']);
    $clothsize = mysqli_fetch_assoc($csize);
    ?>
    <tr>
      <td><strong>Size:</strong></td>
      <td>
        <select id="clothsize" style="width: 43px;" class="cartproductsize" data-price='<?php echo $row['spPostingPrice'] ?>' data-postid='<?php echo $postingid ?>' data-oid='<?php echo $row['idspOrder']; ?>'>
          <option value="sizeXS" style="<?php if ($clothsize['sizeXS'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeXS') {
            echo "selected";
          } ?>>XS</option>
          <option value="sizeS" style="<?php if ($clothsize['sizeS'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeS') {
            echo "selected";
          } ?>>S</option>
          <option value="sizeM" style="<?php if ($clothsize['sizeM'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeM') {
            echo "selected";
          } ?>>M</option>
          <option value="sizeL" style="<?php if ($clothsize['sizeL'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeL') {
            echo "selected";
          } ?>>L</option>
          <option value="sizeXL" style="<?php if ($clothsize['sizeXL'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeXL') {
            echo "selected";
          } ?>>XL</option>
          <option value="sizeXXL" style="<?php if ($clothsize['sizeXXL'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeXXL') {
            echo "selected";
          } ?>>XXL</option>
          <option value="sizeXXXL" style="<?php if ($clothsize['sizeXXXL'] <= 0) {
            echo "display: none;";
          }  ?>" <?php if ($row['size'] == 'sizeXXXL') {
            echo "selected";
          } ?>>XXXL</option>
        </select>
      </td>
    </tr>
    <?php
  }
} ?>
<?php
if ($itemType != 'Training') {
  echo "<span style='display:none;' class='sp-order a-link-normal' data-oid='" . $row['idspOrder'] . "' data-postid='" . $postingid . "' data-catid='" . $row['spCategories_idspCategory'] . "' idspOrdedsfdsr data-quantity='" . $quantity . "' data-remainingquant='" . $available . "' data-subtotal='" . $subtotal . "'  data-profileid='" . $_SESSION["pid"] . "' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='" . $idspOrdedsfdsr . "'>Delete</a><span>";
  echo "<a href='javascript:void(0)' style='display:none;' class='a-link-normal delete' onclick=saveproductcart('" . $idspOrdedsfdsr . "',1)  data-oid='" . $idspOrdedsfdsr . "' data-savestatus='1' id='saveproduct' >Save For later</a>";

  echo "</div>    
  </div>"


  ?>
  <?php

  if ($itemType == 'Store') {
    if ($disco != $pri) {
//echo $disco;
//die('=====');
      ?>
      <div class="pull-right" style='padding-right:20px;'><?php echo $disco; ?><br><del class=' text-success' style='color:green;'><?php echo $pri; ?></del></div>
    <?php } else {
//echo $sporderAmountnewnew; 
//echo 2;
      ?>
      <div class='pull-right' style='padding-right:20px;padding-top: 10px;'><?php echo $pri ?></div>
    <?php }
  }


  if ($itemType == 'artandcraft') {
    if ($price_art != $disco_art) { ?>
      <div class="pull-right" style='padding-right:20px;'><?php echo $disco_art ?><br><del class=' text-success' style='color:green;'><?php echo $price_art ?></del></div>
<?php } else { //echo $sporderAmountnewnew;  
  ?>
  <div class='pull-right' style='padding-right:20px;'><?php echo $price_art ?></div>
<?php }
}



if ($price != false) {
  echo "<div class='col-md-6' style='display:none; float:right;padding-right:0px;width: 200px;'>
  <span style='float: left;width: 20px;margin-left: 5px;'>" . $spOrderQty . "</span>
  <span style='width: 30px;margin-left: 10px;'>" . $curr . ' ' . $sporderAmountnewnew . "</span>
  <span style=' margin-left: 12px;font-size: 15px;color:red'>" . $curr . ' ' . ($spOrderQty * $sporderAmountnewnew) . "</span></div>";
  $totalpricenewnew += $sporderAmountnewnew;
} else {
//$mainpricenow = $spOrderQtyghg * $row['spPostingPrice'];

  echo " <div class='col-md-3' style='display:none; float:left;padding-right:0px;width: 200px;'>
  <span style='float: left;width: 30px;margin-left: 10px;'>" . $spOrderQty . "</span>
  <span style='width: 30px;margin-right: 8px;'>" . $curr . ' ' . $sporderAmountnewnew . "</span>
  <span style='margin-right: 0px;font-size: 15px;color:red'>" . $curr . ' ' . ($spOrderQty * $sporderAmountnewnew) . "</span></div>";
}
} else {
  $tr_quantity = 1;
  $tr_order = new _spcustomers_basket;
$p = new _postingview; //For price and discount price
$pf  = new _postfield;
$result_pr = $p->singletimelines($row['idspPostings']); //For price and discount price
$row_pr = mysqli_fetch_assoc($result_pr); //For price and discount price
$result_pf = $pf->read($row['idspPostings']); //For price and discount price
$txtDiscount = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {
  if ($txtDiscount == '') {
    if ($row2['spPostFieldName'] == 'txtDiscount_') {
      $txtDiscount = $row2['spPostFieldValue'];
    }
  }
}
$org_price = $row['spPostingPrice'];

$discountedPrice = $org_price - ($org_price * ($txtDiscount / 100));
//echo $discountedPrice;
$exactPrice = ceil($discountedPrice);


$tr_res = $tr_order->readIdOrder($_SESSION['pid'], $row['idspPostings']);
$tr_order = mysqli_fetch_assoc($tr_res);

echo "<span class='sp-order a-link-normal' data-oid='" . $tr_order['idspOrder'] . "' data-postid='" . $postingid . "' data-catid='" . $row['spCategories_idspCategory'] . "'  data-quantity='" . $tr_quantity . "' data-remainingquant='" . $available . "' data-subtotal='" . $exactPrice . "'  data-profileid='" . $_SESSION["pid"] . "' data-startdate='' data-enddate='' data-categoryid=''><a href='javascript:void(0)' class='remove_order' data-oid='" . $tr_order['idspOrder'] . "'>Delete</a><span>&nbsp; | &nbsp;";
echo "<a href='javascript:void(0)' class='a-link-normal delete' onclick=saveproductcart('" . $tr_order['idspOrder'] . "',1)  data-oid='" . $tr_order['idspOrder'] . "' data-savestatus='1' id='saveproduct' >Save For later</a>";
echo "</div>   
</div>";
if ($price != false) {
  echo "<div class='' style='float: right; padding-bottom: 25px; color:red;'>
  <h4 style='float: right';><b style='font-size: 20px;margin-right: 16px;'> $" . $sporderAmountnewnew . "</b></h4> </div>";
} else {
  $tr_price = $row['spPostingPrice'];

  echo " <div class='col-md-3' style='float: right; padding-bottom: 25px; padding-left: 0px; color:red;'>
  <h4><b style='font-size: 20px;margin-right: 4px;'> $" . $sporderAmountnewnew . "</b></h4> </div>";
}
$totalprice += $sporderAmountnewnew;
}


echo "</div>";
?>
<!--<div class='pull-right'><a class='btn btn-info text-right' href='#' data-toggle='modal' data-target='#exampleModal2'  onclick='payOnlyThisSeller('<?php //echo $values; 
?>','<?php //echo $totalpricenewnewforss; 
?>','<?php //echo $sellerNmae; 
?>');'>Pay This Product</a></div><br>-->
<?php echo "<hr style='border: 1px solid Grey;'> ";
} ?>
<div class="row">
  <div class="col-md-12" style="font-size: 18px;float:left;padding-right:5px;">
    <table class="table table-borderless">
      <tr>
        <td colspan="2">Quantity:</td>
        <td class="text-right"><?php echo $totalitem; ?></td>
      </tr>
      <td colspan="2">Total Shipping Charges:</td>
      <td class="text-right"><?php echo $totalshippingcharge; ?></td>
    </tr>
<?php //if($disco!=false){ 
//echo 1;

  ?>
<!--  <tr>
<td colspan="2">Total:</td>
<td class="text-danger text-right">
-->
<?php // echo (($discprice*$spOrderQty)+$totalshippingcharge);
?>
<!--
</td>
</tr> -->
<?php //}else{ //echo 2;
  ?>
  <tr>
    <td colspan="2">Total:</td>
    <td class="text-danger text-right"><?php echo ($totalcart + $totalshippingcharge); ?></td>
  </tr>
<?php //} 
?>
<tr class="fw-bold">
</tr>
</table>
</div>
<?php echo "<div class='row'>";
echo "<div class='col-md-12 ' style=' float: right; margin-bottom: 25px; '>

<h4 style='display: none;float: left; font-size: 22px; padding-left: 15px; padding-right: 22px; color:#202548;'>Cart Subtotal (" . $totalitem . " item): <span id='totalamount' class='pull-right;'>" . $curr . ' ' . $totalspOrderQtyamount + $sippingch . "</span></h4>

</div></div>   
"; ?>
<?php
$con =  mysqli_connect(DBHOST, UNAME, PASS);

if (!$con) {
  die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
  echo 'Database Not Selected';
}

$uid = $_SESSION["uid"];

//print_r($uid);

$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1";
$result34 = $con->query($shippingdata);
//var_dump($result34);
//if($result34!=false)
?>
<div class="col-md-6 float-right">
  <?php 
  $paynow = $totalcart + $totalshippingcharge;
  if ($result34->num_rows > 0) {

    ?>
<?php //if($disco!=false){
  ?>
  <p style="float:right;">
    <a class="btn btn-info text-right btn-border-radius" href="#" data-toggle="modal" data-target="#exampleModal" onclick="payOnlyThisSeller('<?php echo $values; ?>','<?php echo $paynow; ?>','<?php echo $sellerNmae; ?>','<?php echo $seller_currency; ?>');">Pay This Seller</a>


  </p>
<!-- <p style="float:right;">
<a class="btn btn-info text-right" href="<?php echo $BaseUrl; ?>/cart/text.php">Pay  Seller</a>
</p>-->


<?php } else { ?>
  <p style="float:right;">
    <a class="btn btn-info text-right btn-border-radius" href="#" data-toggle="modal" onclick="address_not()">Pay This Seller</a>
  </p>
<?php } ?>
</div>
</div>
<hr style='border: 1px solid Grey;'>
<?php    } else { ?>
  <center><img src='../img/emptycarticon.jpg' alt='Posting Pic' class='img-responsive' style='width: 60%;'>
  </center>
<?php }
}
} else { ?>
  <center><img src='../img/emptycarticon.jpg' alt='Posting Pic' class='img-responsive' style='width: 60%;'>
  </center>
<?php }
?>
<!---<hr  style='border: 1px solid Grey;'>--->
</div>
<!-- cardbody close -->
</div>
<!--    Add to Cart ENd -->
<!-- saved Product Start -->
<div class="cartbox bradius-15" style="margin-top: 10px;">
  <div class="cart_header">
    <h3 style="color: #032350;">
      <!-- <i class="fa fa-shopping-cart"></i> -->Saved For Later
    </h3>
  </div>
  <div class="cart_body">
    <?php
//

    $p = new _order;

    $rpvt = $p->readCartItemsavedforlater($_SESSION['uid']);
//print_r($rpvt);
    if ($rpvt != false) {
//$row = mysqli_fetch_assoc($rpvt);
//print_r($row);die('======');
//$cartitem=0;
      while ($row = mysqli_fetch_assoc($rpvt)) {
//print_r($row);
        if ($row['cartItemType'] == 'Store') {
        }
//$price=$row['sporderAmount'];


        $n = $p->readNameItemsavedforlater($row['idspPostings']);
        if ($n != false) {
          $na = mysqli_fetch_assoc($n);
//print_r($na);
          $pr_price = $na['retailSpecDiscount'];
          $title = $na['spPostingTitle'];
          $product_currency = $na['default_currency'];
        }

        $im = $p->readImageItemsavedforlater($row['idspPostings']);
        if ($im != false) {

          while ($img = mysqli_fetch_assoc($im)) {
            $picture = $img['spPostingPic'];
          }
        }

/* if($_GET['action']=='addtocart'){ die("-------");
$arr=array("saveforlater"=>0);
$ad=$p->addtocart($arr,$row['idspPostings']);

header("location:cart/index.php");
}*/

?>
<div class="card item-card card-block">
  <h4 class="card-title text-right"><i class="material-icons" style="margin-right:10px;">Price:<?php echo $product_currency . ' ' . $pr_price; ?></i></h4>
  <span class="pull-right" style="margin-right:10px;"><a href="/cart/save_to_cart.php?id=<?php echo $row['idspPostings']; ?>&action=addtocart"> Add To Cart</a></span>
  <?php
  ?>
  <div>
    <img src="<?php echo $picture; ?>" style="height:70px;width:100px;" alt="No Image">&nbsp;&nbsp;&nbsp;Title:<a href="<?php echo $BaseUrl . '/store/detail.php?postid=' . $row['idspPostings']; ?>"><?php echo $title; ?></a>
    <h5></h5>
  </div>
</div>
<?php }


} else { ?>
  <center>You Have Not Saved Anything Yet.</center>
  <?php
}
?>
</div>
<!-- cardbody close -->
</div>
<!-- saved Product End -->
</div>
<!-- <?php //print_r($_SESSION['uid']);
?>  -->
<div class="col-md-3 hidden-xs no-padding">
  <div class="" style="padding-left: 70px;">
    <!----<a href="../store/storeindex.php" class="btn btn_st_dash_s butn_draf">Countinue Shopping</a>--->
    <?php
// ===PAYPAL ACCOUNT LIVE SETTING
// RETURN CANCEL LINK
    $cancel_return = $BaseUrl . "/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
    $success_return = $BaseUrl . "/paymentstatus/payment_success.php?uid=" . $_SESSION['uid'];
// ===END
// ===LOCAL ACCOUNT SETTING
// RETURN CANCEL LINK
//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
// ===END



//Here we can use paypal url or sanbox url.
// sandbox$BaseUrl/
    $paypal_url    = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
// live payment
//$paypal_url     = 'https://www.paypal.com/cgi-bin/webscr';
//Here we can used seller email id. 
    $merchant_email = 'developer-facilitator@thesharepage.com';
// live email
//$merchant_email = 'sharepagerevenue@gmail.com';

//paypal call this file for ipn
//$notify_url  = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
    ?>
    <!--<a href="#" id="checkout" class="btn btn-success pull-right" data-postid="<?php echo $postingid; ?>" data-buyerid="<?php echo $_SESSION['pid']; ?>" data-categoryid="<?php echo $categoryid; ?>" data-expirydate="<?php echo $closingdate; ?>" data-quantity="1"><span class="glyphicon glyphicon-shopping-cart"></span>Checkout</a>-->
    <form action="<?php echo $paypal_url; ?>" method="post">
      <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
      <!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
      <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
      <input type="hidden" name="return" value="<?php echo $success_return; ?>">
      <input type="hidden" name="rm" value="2" />
      <input type="hidden" name="lc" value="" />
      <input type="hidden" name="no_shipping" value="1" />
      <input type="hidden" name="no_note" value="1" />
      <input type="hidden" name="currency_code" value="USD">
      <input type="hidden" name="page_style" value="paypal" />
      <input type="hidden" name="charset" value="utf-8" />
      <input type="hidden" name="cbt" value="Back to FormGet" />
      <!-- Redirect direct to card detail Page -->
      <input type="hidden" name="landing_page" value="billing">
      <!-- Redirect direct to card detail Page End -->
      <!-- Specify a Buy Now button. -->
      <input type="hidden" name="cmd" value="_cart">
      <input type="hidden" name="upload" value="1">
      <?php
      $p = new _order;
      $rpvt = $p->readCartItemnew($_SESSION['uid']);
      if ($rpvt != false) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($rpvt)) {
          $price = 0;
          if (isset($row['spPostingPrice'])) {
            $price = $row['spPostingPrice'];
          }
          if ($row['cartItemType'] == 'Training') {
            $price += $row['sporderAmount'];
          }
          $quantity = $row['spOrderQty'];



//print_r($price);


          $i = $i + 1;
          $string = str_replace(' ', '', $row['spPostingTitle']);
          echo "<input type='hidden' name='item_name_" . $i . "' value='" . $row['spPostingTitle'] . "'>";
          echo "<input type='hidden' name='item_number' value='143' >";
          echo "<input type='hidden' class='" . $row['idspPostings'] . "' name='amount_" . $i . "' value='" . $price . "'>";

          echo "<input type='hidden' id='" . $row['idspPostings'] . "' name='quantity_" . $i . "' value='" . $quantity . "'>";
        }
      }

      ?>
      <?php
      $cd = new _spuser;
      $cd1 = $cd->readcarddetails($_SESSION['uid']);
      if ($cd1 != false) {
        $cd2 = mysqli_fetch_assoc($cd1);
// print_r($cd2);
        $cardname = $cd2['customerName'];
        $cardnumber = $cd2['cardNumber'];
        $month = $cd2['cardExpMonth'];
        $year = $cd2['cardExpYear'];
        $cvc = $cd2['cardCVC'];
      }
      ?>
      <input type="hidden" name="shopping_url" value="http://www.a2zwebhelp.com">
<!--  <a href="" class="btn  btn_st_post text-right" style="margin-top: 15px!important;">Proceed to Checkout</a>
-->
<!--    <input class="pull-right"  type="image" name="submit" border="0" src="../assets/images/payment/paypal.png" alt="Buy Now" id="checkout"> -->
<!-- <input class="btn btn_st_post text-right"  type="button" value="Proceed to Checkout" name="submit" border="0"  alt="Buy Now" id="checkout"> -->
<!---- <button type="submit" id="checkout" name="submit" class="btn btn_st_post text-right" style="margin-top: 15px!important;">Proceed to Checkout</button>---->
<!--  <?php
if (isset($shipnotshow) && $shipnotshow == 1) {
?>
<div class="row no-margin">
<input class="pull-right"  type="image" name="submit" border="0" src="../assets/images/payment/paypal.png" alt="Buy Now" id="checkout" >
</div>
<?php
}
?> -->
<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
</form>
</div>
<style>
  .left_grid.left_group_black.left_sidebar.dfgdfgbdfbgdf {
    display: none;
    background-color: #fff;
    padding-left: 4px;
    padding-top: 15px;
    padding-bottom: 15px;
    border-radius: 15px;
    margin-top: 10px;
  }
</style>
<div class="left_grid left_group_black left_sidebar dfgdfgbdfbgdf">
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
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
  </script>
  <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>

</div>

<div class="row left_grid left_group_black left_sidebar" style="margin-left:3px; margin-top: -9px;">
  <div class="col-md-11">
    <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
      <a href="../my-profile/add-shipping.php" style="float: left; margin-bottom:10px;">Add / Update Shipping Address</a>
    <?php } ?>
    <h3 style="color: #032350; float-left;">Shipping Address</h3>
    <?php
    $con =  mysqli_connect(DBHOST, UNAME, PASS);

    if (!$con) {
      die('Not Connected To Server');
    }

//Connection to database
    if (!mysqli_select_db($con, DBNAME)) {
      echo 'Database Not Selected';
    }

    $uid = $_SESSION["uid"];

//print_r($uid);

    $shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1";
    $result34 = $con->query($shippingdata);
//var_dump($result34);
    /*print_r($result34);*/
//print_r($result);
/*if ($result->num_rows == 0) {
$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 0"; 

$result = $con -> query($shippingdata);

}
*/

$row34 = mysqli_fetch_assoc($result34);
//print_r($row34);
//print_r($row);
//print_r($shippingdata);

//print_r(expression)
?>
<?php if (!empty($row34)) { ?>
  <div class="a-section address-section-with-default">
    <div class="a-row a-spacing-small">
      <?php $co = new _country;
//echo $row34['country'];
      $result3 = $co->readCountryName($row34['country']);
      if ($result3) {
        $row3 = mysqli_fetch_assoc($result3);
//print_r($row3);


      } ?>
      <?php
      $co = new _state;
      $result4 = $co->readStateName($row34['state']);
      if ($result4) {
        $row5 = mysqli_fetch_assoc($result4);
//print_r($row4);

      }
      ?>
      <?php
      $co = new _city;
      $result4 = $co->readCityName($row34['city']);
      if ($result4) {
        $row4 = mysqli_fetch_assoc($result4);
//print_r($row4);die;
      }
      ?>
      <ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none;">
        <li>
          <b>
            <span class="a-list-item">
              <h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $row34['fullname']; ?></h5>
            </span>
          </b>
        </li>
        <li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $row34['fulladdress']; ?></span></span></li>
        <li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $row4['city_title']; ?>, <?php echo $row5['state_title']; ?> <?php echo $row1['zipcode']; ?></span></span></li>
        <li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $row3['country_title']; ?></span></span></li>
        <li><span class="a-list-item"><span id="address-ui-widgets-AddressLineTwo" class="id-addr-ux-search-text"> <?php echo $row34['landmark']; ?> </span></span></li>
        <li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php echo $row34['phone']; ?>&#8236;</span></span></li>
      </ul>
    </div>
  </div>
  <?php
  $shpping_Address = $row34['fullname'] . ' ' . $row34['fulladdress'] . ' <br>' . $row34['landmark'] . ' ' . $row34['city'] . '<br> ' . $row4['state_title'] . ' ' . $row1['zipcode'] . '<br> ' . $row34['country_title'] . ' ' . $row34['phone'];
// echo $shpping_Address;
} else { ?>
  <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
    <p style="text-align:center;"><a href="../my-profile/add-shipping.php" style="float: left;;">Add Now</a></p>
  <?php }
} ?>
</div>
</div>
<!-- Billing Address-->
<div class="row left_grid left_group_black left_sidebar" style="margin-left:3px;">
  <div class="col-md-11">
    <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
      <a href="<?php echo $BaseUrl; ?>/dashboard/settings/myAddress.php?id=cart" style="margin-bottom: 10px; font-size:14px">Add / Update Billing Address</a>
    <?php } ?>
    <br>
    <h3 style="color: #032350; font-size:20px" class="d-inline">Billing Address</h3>
    <?php
    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
//echo $u->ta->sql;
    if ($res != false) {
      $ruser = mysqli_fetch_assoc($res);
//print_r($ruser);
      $username = $ruser["spUserName"];
      $userphone = $ruser["spUserCountryCode"] . $ruser["spUserPhone"];
      $useremail = $ruser["spUserEmail"];
      $useraddress = $ruser["address"];
      $usercountry = $ruser["spUserCountry"];
      $userstate = $ruser["spUserState"];
      $usercity = $ruser["spUserCity"];
//echo $usercity;die;
      $address = $ruser["address"];
      $userZipCode = $ruser["spUserzipcode"];
      $isPhoneVerify = $ruser["is_phone_verify"];

      ?>
      <div class="a-section address-section-with-default">
        <div class="a-row a-spacing-small">
          <?php $co = new _country;
//echo $row34['country'];
          $result3 = $co->readCountryName($usercountry);
          if ($result3) {
            $row3 = mysqli_fetch_assoc($result3);
//print_r($row3);


          } ?>
          <?php
          $co = new _state;
          $result4 = $co->readStateName($userstate);
          if ($result4) {
            $row5 = mysqli_fetch_assoc($result4);
//print_r($row4);

          }
          ?>
          <?php
          $co = new _city;
          $result4 = $co->readCityName($usercity);
          if ($result4) {
            $row4 = mysqli_fetch_assoc($result4);
//print_r($row4);die;
          }
          ?>
          <ul class="a-unordered-list a-nostyle a-vertical" style="list-style-type: none;">
            <li>
              <b>
                <span class="a-list-item">
                  <h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $username; ?></h5>
                </span>
              </b>
            </li>
            <li><span class="a-list-item"><span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $useraddress; ?></span></span></li>
            <li><span class="a-list-item"><span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $row4['city_title']; ?>, <?php echo  $row5['state_title']; ?> <?php echo $row3['country_title']; ?></span></span></li>
            <li><span class="a-list-item"><span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $userZipCode; ?></span></span></li>
<!--<li><span class="a-list-item"><span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php //echo $userphone;
?>&#8236;</span></span></li>-->
</ul>
</div>
</div>
<?php
} else { ?>
  <p>Please Add Billing Address by Clicking on <a href="../my-profile/add-shipping.php" style="margin-bottom: 26px;">Add Billing Address</a></p>
<?php } ?>
</div>
</div>
<?php
$pv = new _spproduct_view;

$resv = $pv->readrecentcartview($_SESSION['uid']);
//var_dump($resv);
if ($resv != false) {


  while ($rowf = mysqli_fetch_assoc($resv)) {

    $p = new _productposting;
    $rd = $p->read($rowf['productid']);
    if ($rd != false) {
      $prodetail = mysqli_fetch_assoc($rd);
    }
    $rr = new _spstorereview_rating;
    $reviewres = $rr->readstorerating($rowf['productid']);
    if ($reviewres != FALSE) {

      $raterow = mysqli_fetch_assoc($reviewres);
      $pc = new _productpic;
      $respic = $pc->read($rowf['productid']);
      $active1 = 0;
      if ($respic != false) {
        $active2 = 0;
        $postr = mysqli_fetch_assoc($respic);
        $picture = $postr['spPostingPic'];

        if ($active2 == 0) {
          $pic = $picture;
        }
      }

      ?>
    <?php  }
  }
}

?>
</div>
</div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Payment To <span id="seller_name"> </span><?php //echo $sellerNmae; 
?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px;">
  <span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12 text-danger" id="message" style="text-align:center;">
    </div>
  </div>
  <form class="row marginRow" action="<?php echo $BaseUrl; ?>/cart/paymentforproduct.php" method="POST" id="paymentForm">
    
    <div class="col-md-1"></div>
    
    <div class="col-md-10">
      
      
      <div class="row marginRow">
        <div class="col-md-12 form-group">
          <label><b>Card Holder Name<span class="text-danger">*</span></b></label>
          <input type="text" name="customerName" id="customerName" class="form-control" maxlength="22" value="<?php echo $cardname ?>" onkeypress="return /[a-z ]/i.test(event.key)" required>
          <span id="errorCustomerName" class="text-danger"></span>
        </div>
      </div>
      
      <div class="row marginRow">  
        <div class="col-md-12 form-group">
          <label>Card Number <span class="text-danger">*</span></label>
          <input <?php if ($cardnumber) { echo "type='password'"; } else { echo "type='number'"; } ?> name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="" value="<?php if($cardnumber){echo decryptMessage($cardnumber); }?>" style="position: relative;">
          <i class="bi bi-eye-slash" id="togglePassword" style="position: absolute; top: 31px; right: 27px;"></i>
          <span id="errorCardNumber" class="text-danger"></span>
        </div>
      </div>
      
      <div class="row marginRow">  
        <div class="col-md-12">
          <div class="row marginRow">
            <div class="col-md-4">
              <label>Expiry Month</label>
              <input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);" value="<?php echo $month ?>">
              <span id="errorCardExpMonth" class="text-danger"></span>
            </div>

            <script>
              $(document).ready(function() {
                $("#cardExpMonth").keyup(function() {
                  var mm = $("#cardExpMonth").val();

                  if ((mm == 0) || (mm == 12) || (mm == 11) || (mm == 10) || (mm == 09) || (mm == 08) || (mm == 07) || (mm == 06) || (mm == 05) || (mm == 04) | (mm == 03) || (mm == 02) || (mm == 01) || (mm == 00)) {
                    $("#cardExpMonth").val(mm);
                  } else {
                    $("#cardExpMonth").val("");
                  }
                })
              })
            </script>
            
            <div class="col-md-4">
              <label>Expiry Year</label>
              <input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);" value="<?php echo $year ?>">
              <span id="errorCardExpYear" class="text-danger"></span>
            </div>
            
            <div class="col-md-4">
              <label>CVV</label>
              <input type="password" name="cardCVC" id="cardCVC" class="form-control" placeholder="XXX" maxlength="3" onkeypress="return validateNumber(event);" value="<?php if($cvc){echo $cvc;} ?>">
              <span id="errorCardCvc" class="text-danger"></span>
            </div>
            
          </div>
        </div>
        
      </div>
      
      <div class="row marginRow">  
        
        <br>
        <div class="col-md-offset-3 col-md-8" style="float:center;">
          <input type="hidden" id="total_amountforss" name="total_amount" value="<?php echo $totalspOrderQtyamount; ?>">
          <input type="hidden" id="selleridforss" name="seller_id" value="<?php echo $usid ?>">
          <input type="hidden" id="prodt_currency" name="currency_code" value="<?php echo $curren; ?>">
          <input type="hidden" id="spOrderQty" name="spOrderQty" value="<?php echo $totalitem; ?>">
          <input type="hidden" name="shipping_address" value="<?php echo $shpping_Address; ?>">
          <input type="hidden" name="product_title" id="product_title">
          <button type="button" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow" onclick="stripePay(event)" value="Pay Now" href="javascript:;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss">&nbsp;<span></button>
            <label class="btn" style="padding: 6px 9px !important;"><input type="checkbox" name="cardDetails" id="cardDetails"> Save Card</label>

        </div>
        <br>
        
      </div>
      
      
    </div>
    
    
    <div class="col-md-1"></div>
      
      
  </form>
</div>
  
<div class="modal-footer">
  <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close11</button>-->
</div>

</div>
</div>
</div>

</section>
<?php include('../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>
</body>

</html>
<?php
}
?>
<script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>

<script type="text/javascript">


  function address_not(){

    swal.fire("Please Select Shipping Address");


  }


  function saveproductcart(orderId, savestatus) {

    $.post("saveforlater.php", {
      orderId: orderId,
      savestatus: savestatus
    }, function(data) {
      window.location.reload();
    });
  }



  var number = document.getElementById('liveQty');
  if(number !== null){
    number.onkeydown = function(e) {
        if (!((e.keyCode > 95 && e.keyCode < 106) ||
          (e.keyCode > 47 && e.keyCode < 58) ||
          e.keyCode == 8)) {
          return false;
      }
    }
  }
  
function minmax(value, min, max) {
/* if(parseInt(value) < min || isNaN(parseInt(value))) 
return min; */
  if (parseInt(value) > max)
    return max;
  else return value;
}






function payOnlyThisSeller(sellerid, totalprice, sellerName, currency) {
  $('#selleridforss').val(sellerid);
  $('#total_amountforss').val(totalprice);
  $('#prodt_currency').val(currency);
  $('#totalpriceforss').html(currency +" "+  totalprice);
  $('#seller_name').html(sellerName);
  $('#product_title').val($('.sc-product-link').text());

}
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
  function permanentDelete(userId) {
//alert(userId);

    Swal.fire({
      title: 'Are You Sure You Want to Delete?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes',
      cancelButtonColor: '#FF0000',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("removefromcart.php", {
          orderId: userId
        }, function (data) {
          window.location.reload();
        });
      }
    });
  }
</script>
<script>
  const togglePassword = document.querySelector("#togglePassword");
  const cardNumber = document.querySelector("#cardNumber");

  togglePassword.addEventListener("click", function () {
// toggle the type attribute
    const type = cardNumber.getAttribute("type") === "password" ? "text" : "password";
    cardNumber.setAttribute("type", type);

// toggle the icon
    this.classList.toggle("bi-eye");
  });

// prevent form submit
  const form = document.querySelector("form");
  form.addEventListener('submit', function (e) {
    e.preventDefault();
  });
</script>
