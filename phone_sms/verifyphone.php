<?php
 // error_reporting(E_ALL);
 // ini_set('display_errors', '1');

include("../univ/baseurl.php");
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

require_once "../helpers/common.php";

$u = new _spuser;
$userid = $_SESSION['last_user'];
$res_1 = $u->phone($userid);
if($res_1){
  $row = mysqli_fetch_assoc($res_1);
  $spUserPhone = $row['phone_code']. $row['spUserPhone'];
}
$uid=base64_decode($userid);

$res = $u->loginverifycode($uid);
if($res){
  $row = mysqli_fetch_assoc($res);
  $spUserPhone = $row['phone_code']. $row['spUserPhone'];
}
$idspuser = $row["idspUser"];

$is_phone_verify = $row["is_phone_verify"];

$errorMessage = "";
if(!isset($_SESSION["phone_otp"])){
  $otp = rand(10000,99999);
  $_SESSION["phone_otp"] = $otp;
  $txt = 'The SharePage phone verification code  is  '.$otp.'.Do not share this code with anyone.';
  $errorMessage = callSmsApi($spUserPhone, $txt);

}

if(isset($_GET['resend']) && $_GET['resend']=='yes'){
  unset($_SESSION['phone_otp']);
  $otp = rand(10000,99999);
  $_SESSION["phone_otp"] = $otp;
  $txt = 'The SharePage phone verification code  is  '.$otp.'.Do not share this code with anyone.';
  
  $errorMessage = callSmsApi($spUserPhone, $txt);

  $BaseUrl1 = $BaseUrl."/phone_sms/verifyphone.php"; 

  header("Location: $BaseUrl1");

}

?>


<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!-- PAGE LINKS -->
<script src="<?php echo $BaseUrl; ?>/assets/js/register_script.js"></script>
<!-- END -->
<style>
  @media (max-width: 480px) {
.img-responsive{
margin-left: -10px;
}
}
</style>
</head>

<body class="bg_login">        
<section class="homepage">
<div class="container">
<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-xs-12">
<div class="sign_widget m_top_150" style="border-radius: 25px; padding-bottom: 20px;">
<div class="row">
<div class="col-md-12">
<div class="pad_top_55">
<div class="row logo_login">
<div class="col-md-12 text-center"><p style="color: #301934;font-weight: bold;margin-top: 5px;font-size: 12px;text-align: inherit;margin-left: -25px;">
  We have sent a code to your mobile phone. Please enter the code<br> below to verify your phone</p>
<a href="<?php echo $BaseUrl;?>" class=""><img src="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>

 <p style="margin-bottom: 10px;   margin-top: 6px;   font-size: 13px;">  
</p>
 
</div>
</div>                                            
<div class="loginForm">
<div class="loginerrormsg"><?php if($errorMessage){echo $errorMessage;} ?></div>
<?php if(!empty($_SESSION["phone_otp"])) { ?>
<form id="blogin" method="post" action="">
<div class="form-group">

<label class="text-left">Enter the SMS code</label>
<a href="<?php echo $BaseUrl; ?>/phone_sms/verifyphone.php?resend=yes"><span class="resend_code" style="text-decoration: underline;float: right;color:red;cursor: pointer;"><b>Re-send Code</b></span></a>

<input type="text" class="form-control" id="verifycode" name="verifycode"> 

</div>                                                
<div class="text-center">

<button type="button" id="verifyphone" onclick="checkverify()" class="btn btn_sign">Submit Code</button>
<a href="<?php echo $BaseUrl; ?>/?msg=regsuccess"><span class="resend_code" style="text-decoration: underline;float: right;margin-top: 20px;color:red;cursor: pointer;"><b>Skip</b></span></a>

</div>                                                   
</form> 
<?php } ?>
</div>
</div>
</div>   
</div>                                
</div>
</div>
</div>
</div>
</div>
</section>

<?php include('../component/f_btm_script.php'); ?>
</body>

<script type="text/javascript">
function checkverify(){
var vcode = $("#verifycode").val();

if(vcode == "")
{
$(".loginerrormsg").html("<div class='alert alert-danger'>Please Enter Code</div>");
}
else 
{
$.ajax({
type: "POST",
url: BASE_URL+"phone_sms/verifycode.php",
cache:false,
data: {vcode:vcode},
success: function(data) {
  
if(data.trim() == 1){
$(".loginerrormsg").html("<div class='alert alert-success'>Your Phone Number Is Verified Successfully.</div>");
window.location.href = BASE_URL+"?msg=regsuccess";
}else{
$(".loginerrormsg").html("<div class='alert alert-danger'>Somthing Went Wrong</div>");
}
}
});
}
}

</script>
</html>
