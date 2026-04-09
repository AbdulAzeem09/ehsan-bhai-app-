<?php

/*error_reporting(E_ALL);
ini_set("display_errors", "On");*/

class OtpVerification extends Base{

  /**
   * To call all defaults 
   */
  public function __construct(){ 
      $this->loginCheck();
  }

  /**
   * OtpVerification verify at the time of payment
   * Status info -- 1-not verified, 2=verified, 3=old non verified, 4=after full payment
   * 
   * @param string $class The class parameter
   * @param string $action The action parameter
   * @return string JSON-encoded response
   */
  public function verification() {

    $response = array(); 
    $otp = isset($_POST["enteredOTP"]) ? (int)trim($_POST["enteredOTP"]) : '';
    
    $attemptCount = selectQ('SELECT COUNT(id) as attempt_count FROM subscriptionOtpVerification WHERE userId = ? AND status=1', 'i', array($this->userId));

    if($attemptCount && isset($attemptCount[0]['attempt_count']) && $attemptCount[0]['attempt_count'] >= 3){
      errorOut("You have reached the maximum number of otp attempts.");
    }
    
    $getotp = selectQ('SELECT subscription_otp FROM spuser WHERE idspUser = ?', 'i', array($this->userId));
    
    if(!empty($getotp) && $otp == $getotp[0]['subscription_otp']) {
      insertQ('insert into subscriptionOtpVerification(userId, otp, status, datetime) values(?, ?, 2, now())', 'ii', array($this->userId, $otp));
      
      insertQ('update subscriptionOtpVerification set status=3 where userId=? and status=1', 'i', [$this->userId]);
      insertQ('update spuser set subscription_otp="" where idspUser=?', 'i', [$this->userId]);
      
      $response['status'] = "success";
    } else {
      insertQ('insert into subscriptionOtpVerification(userId, otp, status, datetime) values(?, ?, 1, now())', 'ii', array($this->userId, $otp));
      
      errorOut("OTP does not match");
    }

    return ['data' => $response, 'format' => 'skipSuccess']; 
  }

}
?>
