<?php
include('../univ/baseurl.php');
include( "../univ/main.php");
session_start();
include '../common.php';
header('Content-Type: application/json');
if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "membership/";
  include_once ("../authentication/check.php");

}

if(!isset($_SESSION['afterMembership'])){
  $_SESSION['afterMembership'] = "/";
}

function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
}
if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  unset($_SESSION['sign-up']);
}
if(isset($_SESSION['pro-ac']) && $_SESSION['pro-ac'] == 1){
  unset($_SESSION['pro-ac']);
}
spl_autoload_register("sp_autoloader");
$paymentMessage = "";
$totalAmount = 0;
$packageAmount = 0;
$currency = isset($_POST['currency_code']) ? $_POST['currency_code'] : 'CAD';
$couponId = !empty($_POST['couponId']) ? $_POST['couponId'] : "";
$package_id = isset($_POST['packageId']) ? trim($_POST['packageId']) : "";
$package = selectQ("SELECT * from spmembership where idspMembership=?", "i", [$package_id], "one");
$discountObj = [];
$tansation = '';
$discountPercentage = 0;
if(!$package){
  $paymentMessage = "Package invalid";
} else{
  $packageAmount = $package['spMembershipAmount'];
  $totalAmount = $package['spMembershipAmount'];
}
if(!empty($couponId) && $package){
  $discountObj = selectQ('SELECT * FROM discount_coupons WHERE id = ? AND status=? limit 1', 'ii', array($couponId, 1), 'one');
  if($discountObj){  
    $today = date("Y-m-d");
    if(strtotime($discountObj['expiry_date']) < strtotime($today)){
      $paymentMessage = "Coupon code expired";
    } else{
      $discountPercentage = $discountObj['percentage'];
      $deduct_amount = ($discountPercentage*$totalAmount)/100;
      $totalAmount = $totalAmount-$deduct_amount; //discount amount;    
    }
  } else {
    $paymentMessage = "Coupon invalid";
  }
}
if($discountPercentage != 100){
  $cvvVerify = selectQ('SELECT id, status FROM cvvOtpVerification WHERE userId = ? order by id desc limit 1', 'i', array($_SESSION['uid']));
  if(!$cvvVerify){
    die("CVV not verified");
  }
  if($cvvVerify && $cvvVerify[0]['status'] !== 2){
    die("CVV verification invalid");
  }
}
$otpVerify = selectQ('SELECT id, status FROM subscriptionOtpVerification WHERE userId = ? order by id desc limit 1', 'i', array($_SESSION['uid']));
if(!$otpVerify){
  die("OTP not verified");
}
if($otpVerify && $otpVerify[0]['status'] !== 2){
  die("OTP verification invalid");
}
if($discountPercentage != 100){
  insertQ('update cvvOtpVerification set status=4 where id=?', 'i', [$cvvVerify[0]['id']]);
}
insertQ('update subscriptionOtpVerification set status=4 where id=?', 'i', [$otpVerify[0]['id']]);

if(isset($_POST['stripeToken']) && $discountPercentage != 100){
  
  $stripeToken  = $_POST['stripeToken'];
  if(!empty($_POST['customerName'])){
    $customerName = $_POST['customerName'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Card holder name should not be empty']);
    die;
  }
  if(!empty($_POST['cardNumber'])){
    $cardNumber = $_POST['cardNumber'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Card number should not be empty']);
    die;
  }
  if(!empty($_POST['cardCVC'])){
    $cardCVC = $_POST['cardCVC'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Security code should not be empty']);
    die;
  }
  if(!empty($_POST['expiryDate'])){
    $expiryDate = $_POST['expiryDate'];
    $cardExpMonth = "";
    $cardExpYear = "";
    if($expiryDate){
      $cardExpMonth = substr($expiryDate, 0, 2);
      $cardExpYear = substr($expiryDate, 3, 5); 
    }
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Expiry date should not be empty']);
    die;
  }
  /*if($_POST['saveCardBtn'] == 'true'){

    $arr[] = encryptMessage($cardNumber);
    $arr[] = $customerName;
    $arr[] = $cardExpMonth;
    $arr[] = $cardExpYear;
    $arr[] = $cardCVC;
    if(isset($_POST['card_id']) && $_POST['card_id'] > 0){
      $arr[] = $_POST['card_id'];
      insertQ('update spcarddetail set cardNumber = ?, customerName = ?, cardExpMonth = ?, cardExpYear = ?, cardCVC = ? where id = ?', 'sssssi', $arr);
    } else {
      $arr[] = $_SESSION['pid'];
      $arr[] = $_SESSION['uid'];
      $arr[] = date("Y-m-d h:i:s");
      insertQ('insert into spcarddetail (cardNumber, customerName, cardExpMonth, cardExpYear, cardCVC, pid, uid, createdDate) values (?, ?, ?, ?, ?, ?, ?, ?)', 'sssssiis', $arr);
    }
  }*/
  $cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;

  if(!$paymentMessage){
    
    require_once('../stripe-php/init.php'); 

    $stripe = array(
      "secret_key"      => SECRET_KEY,
      "publishable_key" => PUBLIC_KEY
    );    
    
    \Stripe\Stripe::setApiKey($stripe['secret_key']);    

    try{
      $customer = \Stripe\Customer::create(array(
        'name' => $customerName,
        'description' =>  'PRO TITLE',
        'email' => $customerEmail ?? '',
        'source'  => $stripeToken,
        "address" => [
          "city" => $customerCity ?? '', 
          "country" => $customerCountry ?? '', 
          "line1" => $customerAddress ?? '', 
          "line2" => "", 
          "postal_code" => $customerZipcode ?? '', 
          "state" => $customerState ?? ''
        ]
      ));  
      
      $currency = $_POST['currency_code'];
      $orderNumber ="WER12345";   

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
    }
    catch (Error\Card $e) {
      $paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();
    }
    catch (Error\InvalidRequest $e) {
      $paymentMessage = ucfirst($e->getStripeParam())." ".$e->getMessage();
    } 
    catch (\Exception $e) {
      $paymentMessage = ucfirst($e->getStripeParam())." ".$e->getMessage();
    }
      
  } else {
    echo json_encode(['status' =>  0 , 'message' => $paymentMessage, 'url' => $_SESSION['afterMembership']]);
    die;
  }
}

if(!empty($paymentMessage)){
  echo json_encode(['status' =>  0 , 'message' => $paymentMessage, 'url' => $_SESSION['afterMembership']]);
  die;
}

$userData = selectQ("select * from spuser where idspuser = ?", "i", [$_SESSION['uid']], "one");
if($userData){
  $trial=$userData['duration'];
  $recurring_duration=$userData['recurring_duration'];
  if($trial==0){
    $new_duration = $package['spMembershipDuration']+30;
  } else{
    $new_duration = $package['spMembershipDuration'];
  }
}
if(($discountPercentage == 100) || ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1)){ //$cardDetails
  
  if(!empty($discountObj)){
    insertQ("update discount_coupons set used_count = ? where id = ?", "ii", [$discountObj['used_count'] + 1, $couponId]);
  }
  
  $tansation = ($discountPercentage == 100) ? "" : $paymenyResponse['balance_transaction'];
  $uid = $_SESSION['uid'];
  $pid = $_SESSION['pid'];
  $dat = [];
  $dat[] = $package_id;
  $dat[] = $totalAmount;
  $dat[] = $tansation;
  $dat[] = $uid;
  $dat[] = date('Y-m-d H:i:s');
  $dat[] = $pid;
  $dat[] = $new_duration;

  insertQ("update spuser set duration = ? and recurring_duration = ?  where idspuser = ?", "iii", [ 1, 1, $_SESSION['uid']]);
  insertQ("insert into spmembership_transaction (membership_id, amount, txn_numberpid, uid, createdon, pid, duration) values (?, ?, ?, ?, ?, ?, ?)", "iisisii", $dat);
  if($userData){
    $usedcode = $userData['refferalcodeused'];
    $getwhichusercode = selectQ("select * from spuser where userrefferalcode = ?", "s", [$usedcode], "one");
    if($getwhichusercode){
      $getserid= $getwhichusercode['idspUser'];
    }
  }
  
  $u = new _spuser;

  $com = $u->getcom($getserid);

  $com2 = $u->getcom1();
  if($com2 != false){
    $r2 = mysqli_fetch_assoc($com2);
    $first_level_co =  $r2['first_level_co'];    
    $second_level_co =  $r2['second_level_co'];
    $third_level_co =  $r2['third_level_co'];
  } else {
    $first_level_co =  0;    
    $second_level_co =  0;
    $third_level_co =  0;
  }

  if($com != false){
    $r = mysqli_fetch_assoc($com);
    $first_level_co = $r['friend_value'];
  }
  
  //1 level insert

  $mycommison = $packageAmount*$first_level_co/100;
  $spadmin_commission = $packageAmount-$mycommison;
  date_default_timezone_set('Asia/Kolkata');
  $date=date("Y-m-d");

  $m = new _spmembership;

  $mainUSer = $m->getreferrelUser($_SESSION["uid"]);
  if($mainUSer != false){
    $mainuserrefferalcodeused = mysqli_fetch_assoc($mainUSer);
    $refferalcodeused = $mainuserrefferalcodeused['refferalcodeused'];
  } else {
    $refferalcodeused = '';
  }
  $tier1_user = $m->getReferrelUserByCode($refferalcodeused);
  if($tier1_user != false){
    $tier1_userid = mysqli_fetch_assoc($tier1_user);
    $tier1_user_refferalcodeused = $tier1_userid['refferalcodeused'];
  } else {
    $tier1_userid = [];
    $tier1_user_refferalcodeused = "";
  }

  $tier2_user = $m->getReferrelUserByCode($tier1_user_refferalcodeused);
  if($tier2_user != false){
    $tier2_userid = mysqli_fetch_assoc($tier2_user);
    $tier2_user_refferalcodeused = $tier2_userid['refferalcodeused'];
  } else {
    $tier2_user_refferalcodeused = "";
    $tier2_userid = [];
  }
  $tier3_user = $m->getReferrelUserByCode($tier2_user_refferalcodeused);
  if($tier3_user != false){
    $tier3_userid = mysqli_fetch_assoc($tier3_user);
  } else {
    $tier3_userid = [];
  }

  $commissiontype = $m->getuserCommission();
  if($commissiontype != false){
    $commission_type = mysqli_fetch_assoc($commissiontype);
    if($tier2_userid){
      if($tier2_userid['role']){
        if($tier2_userid['role'] == "super vip"){
          $tier1_commission =($packageAmount*$commission_type['super_vip_sub_commission'])/100;
        }
        if($tier2_userid['role'] == "vip"){
          $tier1_commission =($packageAmount*$commission_type['vip_sub_commission'])/100;
        }
      }else{
        $tier1_commission =($packageAmount*$commission_type['general_sub_commission'])/100;
      }
    }else{
      $tier1_userid = '';
      $tier1_commission = '';
    }

    if($tier2_userid){
      $tier2_commission = ($packageAmount*5)/100;
    }else{
      $tier2_userid = '';
      $tier2_commission = '';
    }
    if($tier3_userid){
      $tier3_commission=($packageAmount*5)/100;
    }else{
      $tier3_userid = [];
      $tier3_commission = '';
    }
  } else {
    $tier1_userid = '';
    $tier1_commission = '';
    $tier2_userid = '';
    $tier2_commission = '';
    $tier3_userid = '';
    $tier3_commission = '';
  }

  $data = [
    'purchaser_user_id '=>$_SESSION['uid'],
    'purhcaser_pid'=> $_SESSION['pid'],
    "purcahse_amount"=>$packageAmount,
    'mycommsion'=>$first_level_co,
    'refred_user '=>$getserid,
    'module'=> 'membership',
    'sale_type'=>'subscription',
    'date'=>$date,
    'currency'=>'CAD',
    'spuser_commission '=> $mycommison,
    'spadmin_commission '=> $spadmin_commission,
    'tier1_userid'=> (isset($tier1_userid['idspUser'])) ? $tier1_userid['idspUser'] : "",
    'tier2_userid'=>(isset($tier2_userid['idspUser'])) ? $tier2_userid['idspUser'] : "",
    'tier3_userid'=>(isset($tier3_userid['idspUser'])) ? $tier3_userid['idspUser'] : "",
    'tier1_commission'=>$tier1_commission,
    'tier2_commission'=>$tier2_commission,
    'tier3_commission'=>$tier3_commission,
  ];
  
  $mb = new _spmembership;
  $commission = $mb->insert_comm($data);

  $resultbok_1 = $u->read_reffer($_SESSION['uid']);	
  if($resultbok_1 != false){
    $refer = mysqli_fetch_assoc($resultbok_1 );
    $used_code= $refer['refferalcodeused']; 
    $used_refer_id=$refer['idspUser'];
  } else {
    $used_code= "";
    $used_refer_id= "";
  }

  $resultbok_2 = $u->user_reffer_code($used_code);	
  if($resultbok_2 != false){
    $rr = mysqli_fetch_assoc($resultbok_2 );
    $name_1=$rr['spUserName'];
    $used_ref_id=$rr['idspUser'];
  } else {
    $name_1='';
    $used_ref_id='';
  }

  $super_vip = $mb->user_roles_supr_vip($used_refer_id);
  $vip_com = $mb->user_roles_vip($used_refer_id);

  date_default_timezone_set('Asia/Kolkata');

  $date=date("Y-m-d h:i:s");

  $admin = $u->get_admin_commission();
  if($admin != false){
    $admin_com = mysqli_fetch_assoc($admin); 
    $per=$admin_com['comm_amt'];
  } else {
    $per = 0;
  }
  $admin_commission=($packageAmount*$per)/100;

  $ss = $u->get_super_vip_comm();
  if($ss != false){
    $super_commission = mysqli_fetch_assoc($ss); 
    $sale_commission=$super_commission['sales_commission'];
  } else {
    $sale_commission=0;
  }
  $total_sale_commission=($admin_commission*$sale_commission)/100;

  if($super_vip != false){
    $ss = $u->get_sub_comm();
    if($ss != false){
      $super_commission = mysqli_fetch_assoc($ss); 
      $total_comm=($packageAmount*$super_commission['super_vip_sub_commission'])/100;
    } else {
      $total_comm = 0;
    }

    $data = array(
      "purchaser_user_id"=>$_SESSION['uid'] ,
      "purhcaser_pid"=>$_SESSION['pid'],
      "purcahse_amount"=>$packageAmount,
      "mycommsion"=>$total_comm,
      "refred_user"=>$used_ref_id,
      "module"=>'membership',
      "sale_type"=>'subscription',
      "currency"=>'CAd',
      "date"=>$date,
      "spadmin_commission"=>'0',
      "spuser_commission"=>$total_comm
    );
  } else if($vip_com != false){
    $ss = $u->get_sub_comm();
    if($ss != false){
      $super_commission = mysqli_fetch_assoc($ss);
      $total_comm=($packageAmount*$super_commission['vip_sub_commission'])/100;
    } else {
      $total_comm = 0;
    }
  } else {
    $ss = $u->get_sub_comm();
    if($ss != false){
      $super_commission = mysqli_fetch_assoc($ss);
      if(isset($super_commission['general_sub_commission'])){
        $total_comm=($packageAmount*$super_commission['general_sub_commission'])/100;
      } else {
        $total_comm = 0;
      }
    } else {
      $total_comm = 0;
    }

    $data= array(
      "purchaser_user_id"=>$_SESSION['uid'] ,
      "purhcaser_pid"=>$_SESSION['pid'],
      "purcahse_amount"=>$packageAmount,
      "mycommsion"=>$total_comm,
      "refred_user"=>$used_ref_id,
      "module"=>'membership',
      "sale_type"=>'subscription',
      "currency"=>'CAD',
      "date"=>$date,
      "spadmin_commission"=>'0',
      "spuser_commission"=>$total_comm
    );

  }

  $cur = new _currency;

  $fromCurrency=$currency;
  $toCurrency="USD";
  $amount=$packageAmount;

  $detail = $cur->convert_Currency($fromCurrency,$toCurrency,$amount);
  $point=round($detail['convertedAmount'], 0);
  date_default_timezone_set('Asia/Kolkata');

  $date=date("Y-m-d h:i:s");
  $resultbok_1 = $u->read_reffer($_SESSION['uid']);	
  if($resultbok_1 != false){
    $refer = mysqli_fetch_assoc($resultbok_1 );
    $used_code= $refer['refferalcodeused']; 
    $used_refer_id=$refer['idspUser'];
  } else {
    $used_code= ''; 
    $used_refer_id='';
  }

  $resultbok_2 = $u->user_reffer_code($used_code);	
  if($resultbok_2 != false){
    $rr = mysqli_fetch_assoc($resultbok_2 ); 
    $name_1=$rr['spUserName'];
    $used_ref_id=$rr['idspUser'];
  } else {
    $name_1='';
    $used_ref_id='';
  }

  $sppoint_buyer = ($point*80)/100;

  $sppoint_refred = ($point*20)/100;

  $data = array(
    "payment_id"=>$tansation,
    "spProfile_idspProfile"=>$_SESSION['pid'],
    "pointAmount"=>$sppoint_buyer,
    "pointBalance"=>$sppoint_buyer,
    "pointDate"=>$date,
    "uid"=>$_SESSION['uid'],
    "spUser_idspUser"=> 1,
    "spPointComment"=>'Purchase',
    "spPoint_type"=>'D'
  );

  $rr = new _spPoints;
  $last_id = $rr->create_point($data); 

  $data = array(
    "payment_id"=>$tansation,
    "spProfile_idspProfile"=>'0',
    "pointAmount"=>$sppoint_refred,
    "pointBalance"=>$sppoint_refred,
    "pointDate"=>$date,
    "uid"=>$used_ref_id,
    "spUser_idspUser"=> 1,
    "spPointComment"=>'Referred User Purchased',
    "spPoint_type"=>'D'
  );
  $rr = new _spPoints;
      
  $last_id = $rr->create_point($data); 
  
  echo json_encode(['status' =>  1 , 'message' => 'Payment Successful', 'url' => $_SESSION['afterMembership']]);
} else {
  echo json_encode(['status' =>  0 , 'message' => $paymentMessage, 'url' => $_SESSION['afterMembership']]);
}
?>
