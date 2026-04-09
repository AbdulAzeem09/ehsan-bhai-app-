<?php
include '../common.php';
if(isset($_POST['couponCode'])){
  $coupon = selectQ("select * from discount_coupons where coupon_code = ? and status = ?", "si", [$_POST['couponCode'], 1], "one");
  if($coupon){
    if( $coupon['expiry_date'] < date("Y-m-d")){
      echo json_encode(['status' =>  0 , 'message' => 'Coupon has expired']);
    } else {
      $actual_value = 0;
      $deduct_amount = 0;
      if($_POST['packageId']){
        $package = selectQ("select * from spmembership where idspMembership = ?", "i", [$_POST['packageId']], "one");
        if($package){
          $actual_value = $package['spMembershipAmount'];
          $deduct_amount = ($coupon['percentage']*$actual_value)/100;
          if ($deduct_amount != floor($deduct_amount)) {
            $deduct_amount = round($deduct_amount, 2);
            $deduct_amount = number_format($deduct_amount, 2, '.', '');
          }
          $actual_value = $actual_value-$deduct_amount;
          if ($actual_value != floor($actual_value)) {
            $actual_value = round($actual_value, 2);
            $actual_value = number_format($actual_value, 2, '.', '');
          }
          echo json_encode(['status' =>  1 , 'discount' => $deduct_amount, 'discount_price' => $actual_value, 'couponId' => $coupon['id'], 'couponPercentage' => $coupon['percentage']]);
        }
      } else {
        echo json_encode(['status' =>  1 , 'message' => 'Discount is of '.$coupon['percentage']."%", 'couponId' => $coupon['id'], 'couponPercentage' => $coupon['percentage']]);
      }
    }
  } else {
    echo json_encode(['status' =>  0 , 'message' => 'Invalid Coupon']);
  }
} else {
 echo json_encode(['status' =>  0 , 'message' => 'Invalid Coupon']);
}
?>
