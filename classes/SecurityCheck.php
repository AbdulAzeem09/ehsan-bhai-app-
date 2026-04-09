<?php

class SecurityCheck extends Base{

  /**
   * To call all defaults 
   *
   */
  public function __construct(){ 
    $this->loginCheck();
  }

  /**
   * Security check at the time of payment
   *
   * @param string $class The class parameter
   * @param string $action The action parameter
   * @return string JSON-encoded response
   */
    public function pay() {
    
        $response = array();
        $percentage = 0;
        if(isset($_POST['couponId'])){
          $coupon = selectQ('SELECT percentage, expiry_date FROM discount_coupons WHERE id = ? AND status=? limit 1', 'ii', array($_POST['couponId'], 1), 'one');
          $today = date("Y-m-d");
          if((isset($coupon) && isset($coupon['expiry_date'])) && strtotime($coupon['expiry_date']) > strtotime($today)){
            $percentage = $coupon['percentage'];
          }
        }
        if($percentage != 100){
          $cardCvc = isset($_POST["cardcvc"]) ? (int)trim($_POST["cardcvc"]) : '';
          $cardNumber = isset($_POST["cardNumber"]) ? trim($_POST["cardNumber"]) : '';
          $expiryDate = isset($_POST["expiryDate"]) ? trim($_POST["expiryDate"]) : '';
          $customerName = isset($_POST["customerName"]) ? trim($_POST["customerName"]) : '';
          if(!$cardCvc){
             errorOut("Card CVV not provided");
          }
          if(!$cardNumber){
             errorOut("Card number not provided");
          }
          if(!$expiryDate){
             errorOut("Expiry date not provided");
          }
          if(!$customerName){
             errorOut("Customer name not provided");
          }
          
          $attemptCount = selectQ('SELECT COUNT(id) as attempt_count FROM cvvOtpVerification WHERE userid = ? AND status=1', 'i', array($this->userId));

          if($attemptCount && isset($attemptCount[0]['attempt_count']) && $attemptCount[0]['attempt_count'] >= 3){
            errorOut("You have reached the maximum number of cvv attempts.");
          }

          $insertData = array(
              'userId' => $this->userId,
              'datetime' => date('Y-m-d H:i:s'),
              'cvc' => $cardCvc
          );
          $cardDetails = selectQ('SELECT cardCVC FROM spcarddetail WHERE uid=? and cardNumber=?', 'is', array($this->userId, encryptMessage($cardNumber)));
        }
        if ($percentage == 100 || ($cardDetails && isset($cardDetails[0]['cardCVC']) && $cardCvc == $cardDetails[0]['cardCVC'])) {
            $response['status'] = "success";
            $response['percentage'] = $percentage;
            $otpSent = rand(1000, 9999);
            
            $userDetails = selectQ('SELECT phone_code, spUserPhone FROM spuser WHERE idspUser = ?', 'i', array($this->userId));
            $spUserPhone = $userDetails[0]['phone_code']. $userDetails[0]['spUserPhone'];
            $smsSuccess = callSmsApi($spUserPhone, "Subscription validation OTP is: ".$otpSent);
            
            if($smsSuccess){
              errorOut("Unable to send SMS for OTP validations.");
            }
            if($percentage != 100){
              insertQ('update cvvOtpVerification set status=3 where userid=? and status=1', 'i', [$this->userId]);
            
              insertQ('INSERT INTO cvvOtpVerification (userid, datetime, cvc, status) VALUES (?, ?, ?, 2)', 'iss', array_values($insertData));
            }
            
            $insertData = [$otpSent, $this->userId];
            
            insertQ('update spuser set subscription_otp=? where idspUser=?', 'ii', $insertData);
            
        } else {
            insertQ('INSERT INTO cvvOtpVerification (userid, datetime, cvc, status) VALUES (?, ?, ?, 1)', 'iss', array_values($insertData));

            errorOut("Please provide correct CVV!");
            
        }
        return ['data' => $response, 'format' => 'skipSuccess']; 
   }

}

?>
