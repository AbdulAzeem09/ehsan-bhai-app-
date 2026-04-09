<?php

require_once("../../univ/baseurl.php" );

session_start();
$phone = $_POST['spAccountnumber'];
$otp = $_SESSION['bank_otp'];

// echo "OTP received: " . $otp;
// echo '<br>';

if ($phone == $otp) {
 
  $_SESSION['bank_otp_verified'] = 1;

  //$BaseUrl = "https://dev.thesharepage.com";
  header("Location: $BaseUrl/dashboard/BankDetails");
}
else {
  // echo "<script>alert('Your OTP did not match');</script>";
  // $BaseUrl = "https://dev.thesharepage.com";
  header("Location: $BaseUrl/dashboard/enterotp?msg=wrong");
}
?>
