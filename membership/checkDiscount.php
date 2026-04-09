<?php
require_once('../univ/baseurl.php');
require_once('../common.php');


$coupon_code = isset($_REQUEST['coupon_code']) ? trim($_REQUEST['coupon_code']) : "";
$package_id_check = isset($_REQUEST['package_id_check']) ? trim($_REQUEST['package_id_check']) : "";

if(!$coupon_code || !$package_id_check){
  errorOut("Params invalid");
}

$discountObj = selectQ("SELECT * from tsp_discount_coupons where coupon_code=? and status=1 limit 1", "s", [$coupon_code], "one");
if($discountObj){
  
  $package = selectQ("SELECT * from spmembership where idspMembership=?", "i", [$package_id_check], "one");
  if(!$package){
    errorOut("Package invalid");
  }
  
  $today = date("Y-m-d");
  if(strtotime($discountObj['expiry_date']) < strtotime($today)){
    errorOut("Coupon code expired");
  }
  else{
    $text = "Discount is of ".$discountObj['percentage']."%.";
    $actual_value = 0;
    $deduct_amount = 0;
    
    $actual_value = $package['spMembershipAmount'];           
    $deduct_amount = ($discountObj['percentage']*$actual_value)/100;
    $actual_value = $actual_value-$deduct_amount; //discount amount;
    $text .= " -- $deduct_amount$ OFF";            
  
    successOut(["id" => $discountObj['id'], "deduct_amount" => $deduct_amount, "percentage" => $discountObj['percentage'], "actual_value" => $actual_value, "discountText" => $text]);
  }
}
else{
  errorOut("Coupon invalid");
}

?>
