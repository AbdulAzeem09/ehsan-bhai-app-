<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include "../univ/baseurl.php";
session_start();
//print_r($_POST);
function sp_autoloader($class)
{
	//echo $class; die("----------");
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$siteKey   = '6LdhaVseAAAAABXFYfmsWkm7JEe1PVY7XRwy8nAu';
$secretKey = '6LdhaVseAAAAAKdsDneId9_QsUSjH6m-6LUaGnKl';

 $u  = new _spuser;
 $result = $u->phone_check_1($_POST['respUserEphone']);
 $result1 = $u->account_phone_check($_POST['respUserEphone']);
 
 if($result || $result1){ ?>
	
	<script>
	
	window.location.replace("https://dev.thesharepage.com/otp.php?action=phone");
	</script>
	
	 
	<?php  }

else{
	$u  = new _spuser;
	
	$data = array("phone_no" => $_POST['respUserEphone']);
	
	
	
	
	$result = $u->account_phone($data);
	
}
	
if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    // Verify the reCAPTCHA response
    // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
    $URL = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response'];
    $c   = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $verifyResponse = curl_exec($c);
    curl_close($c);

    // Decode json data
    $responseData = json_decode($verifyResponse);
	
	
if (isset($_POST['respUserEphone'])) {
    $u          = new _spuser;
    $re         = new _redirect;
    $redirctUrl = $BaseUrl . "/sign-up.php";
    $uid        = $_SESSION['chkuid'];

  echo $u->sendMobileOtp($_POST, $uid);
}

}

else {
	
	echo "no";
	//die('captcha not done');
}
