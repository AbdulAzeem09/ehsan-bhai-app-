<?php
//include('../univ/baseurl.php');
//session_start();
include '../common.php';

if(isset($_POST['spUserId'])){
  $profileData = [];
  $profileData[] = isset($_POST["spUserFirstName"]) ? htmlspecialchars(trim($_POST["spUserFirstName"])) : '';
  $profileData[] = isset($_POST["spUserPhone"]) ? htmlspecialchars(trim($_POST["spUserPhone"])) : '';
  $profileData[] = isset($_POST["spUserEmail"]) ? htmlspecialchars(trim($_POST["spUserEmail"])) : '';
  $profileData[] = isset($_POST["billAddress"]) ? htmlspecialchars(trim($_POST["billAddress"])) : '';
  $profileData[] = isset($_POST["spUserCountry"]) ? htmlspecialchars(trim($_POST["spUserCountry"])) : '';
  $profileData[] = isset($_POST["spUserState"]) ? htmlspecialchars(trim($_POST["spUserState"])) : '';
  $profileData[] = isset($_POST["spUserCity"]) ? htmlspecialchars(trim($_POST["spUserCity"])) : ''; 
  $profileData[] = isset($_POST["postalCode"]) ? htmlspecialchars(trim($_POST["postalCode"])) : '';
  $profileData[] = $_POST['spUserId'];
  
  $user = insertQ('UPDATE spuser  SET spUserFirstName = ?, phone_no = ?, spUserEmail = ?, address = ?, spUserCountry = ?, spUserState = ?, spUserCity = ?, spUserPostalCode = ?  WHERE idspUser = ?', 'ssssiiisi', $profileData);
  $percentage = 0;
  if(isset($_POST['couponId']) && $_POST['couponId'] != ""){
    $coupon = selectQ('SELECT percentage, expiry_date FROM discount_coupons WHERE id = ? AND status=? limit 1', 'ii', array($_POST['couponId'], 1), 'one');
    $today = date("Y-m-d");
    if((isset($coupon) && isset($coupon['expiry_date'])) && strtotime($coupon['expiry_date']) > strtotime($today)){
      $percentage = $coupon['percentage'];
    }
  }
  
  echo(trim($percentage));
  
}
?>
