<?php

// if ( ini_get( 'allow_url_fopen' ) ) {
//      echo "allow_url_fopen is ENABLED.\n";
//  } else {    
//      echo "allow_url_fopen is DISABLED.\n";
//  }
include("univ/baseurl.php" );
session_start();




function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if(empty($_SESSION['chkuid'])){
$re = new _redirect;

$location = $BaseUrl."/sign-up.php/";
$re->redirect($location);
} 

if(empty($_SESSION['email_verified'])){

$re = new _redirect;

$location = $BaseUrl."/verifyemail.php";
$re->redirect($location);

die;


}



if(isset($_SESSION['pid'])){ 
$re = new _redirect;
$location = $BaseUrl."/timeline/";
$re->redirect($location);
}else{

?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<style>
input {
height: 30px;
padding-left: 10px;
border-radius: 4px;
border: 1px solid rgb(186, 178, 178);
box-shadow: 0px 0px 12px #EFEFEF;
}

.bottm-agrrement {
margin-top: -25px;
margin-left: 20px;
}

.error, .erormsg {
color: #F00 !important;
}


.icon-view{
position: absolute;
right: 15px;
top: 21px;
color: #202020;
font-size: 14px;
opacity: 0.8;
}

.headersearch {
position: relative;
}

.headersearch i {
position: absolute;
right: 10px;
top: 11px;
}

input#respUserEphone::placeholder {
color: #80808091 !important;
opacity: 1;
}

.btn_signup {
padding: 7px 24px !important;
}
.alert {
padding: 8px !important; 
}

div iframe{
margin: 0px 60px;
} 

</style>

<!DOCTYPE html>
<html lang="en-US">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<head>
<?php include('component/header_link.php');?>

<!-- telephone -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/country/css/intlTelInput.css">
<script type="text/javascript">
$(function() {
$('#respUserEphone').keypress(function(event){
if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
event.preventDefault(); //stop character from entering input
}
});
});
</script> 

</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body class="bg_signup">

<section class="signupPage"> 
<div class="container">
<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-xs-12">
<div class="signup_widget" id="">
<div class="row">
<div class="col-sm-12">
<div class="pad_top_55">
<div class="row logo_signup">
<div class="col-sm-12 text-center">
<a href="<?php echo $BaseUrl;?>" class="">
<!-- <img src="assets/images/logo/logo.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /> -->

<img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" />
</a>
<h5>Discover The Most Exciting Features In</h5>
<h3>The SharePage!</h3>
<p style="color: #301934;font-weight: bold;margin-top: 10px;font-size: 18px;color:#003384">VERIFY PHONE</p>
<p style="color: #301934;font-weight: bold;margin-top: 5px;font-size: 12px;text-align: inherit;padding: 0px 60px;color:#c468c4">TO PROTECT AND SECURE YOUR ACCOUNT, WE WILL SEND YOU A TEXT MESSAGE CONTAINING A CODE TO VERIFY YOUR MOBILE NUMBER</p>
</div>
</div>

<div class="signupForm">
<div class="errormsg"></div>
<form id="sendOtpForm" method="post" action="authentication/sendOtp.php" autocomplete="chrome-off">
<input type="hidden" class="spProfileType_idspProfileType" name="spProfileType_idspProfileType_" value="4">
<input id="uType" type="hidden" value="3">
<input type="hidden" name="spUserIpLastLogin" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
<input type="hidden" name="txtCountryCode" id="txtCountryCode" value="+1" />


<div class="row">

<div class="col-sm-12">
<div class="form-group respUserEphoneDiv">
<label for="respUserEphone" class="lbl_9">Enter Cell No. <span style="color: #938b80;font-size: 10px;"> (select country code first)</span><span class="red">* </span></label>

<input type="text" class="form-control" id="respUserEphone" name="respUserEphone" onblur="this.value=removeSpaces(this.value);" value=""  required>
<span class="ph_no erormsg"></span>
</div>
</div>

<div class="g-recaptcha brochure__form__captcha mb-2" name="g-recaptcha-response" data-sitekey="6LdhaVseAAAAABXFYfmsWkm7JEe1PVY7XRwy8nAu" id="captcha"></div>  

<br><br><br><br>

<div class="col-sm-12 phone_verify_codeDiv" style="display: none;">
<div class="form-group">
<label for="phone_verify_code" class="lbl_9">Enter the verification code sent to your cell phone. <span class="red">* </span></label>
<input type="text" class="form-control" id="phone_verify_code" name="phone_verify_code" value="">
<span class="phone_verify_code erormsg"></span>
<span class="resend_code" style="text-decoration: underline;float: right;margin-top: 5px;color:red;cursor: pointer;display: none;"><b>Re-send Code</b></span>
<span class="resend_code_call" style="text-decoration: underline;float: right;margin-top: 5px;color:red;cursor: pointer;display: none;"><b>Re-send Code</b></span>
</div>
</div>



</div>



<div class="text-center">
<h3>SEND SMS CODE </h3>
<button id="otp_send" value="1" type="button" data-loading-text="Registering..."  name="submit" class="btn otp_send btn_signup"> VIA SMS</button>
<button id="otp_send_call" value="2" type="button" data-loading-text="Registering..."  name="submit" class="btn otp_send_call btn_signup"> VIA CALL</button>
<button id="otp_verify" type="button" data-loading-text="Registering..."  name="submit" class="btn otp_verify btn_signup" style="display:none;">VERIFY</button>

</div>

</form>
</div>

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

<?php include('component/f_btm_script.php'); ?>
<!-- telephone -->
<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>


var input = document.querySelector("#respUserEphone");
window.intlTelInput(input, {

// allowDropdown: false,
// autoHideDialCode: false,
// autoPlaceholder: "off",
// dropdownContainer: document.body,
// excludeCountries: ["us"],
// formatOnDisplay: false,
// geoIpLookup: function(callback) {
//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//     var countryCode = (resp && resp.country) ? resp.country : "";
//     callback(countryCode);
//   });
// },
// hiddenInput: "full_number",
// initialCountry: "auto",
// localizedCountries: { 'de': 'Deutschland' },
// nationalMode: false,
// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
// placeholderNumberType: "MOBILE",
preferredCountries: ['us', 'ca'],
separateDialCode: true,
// utilsScript: "<?php echo $BaseUrl;?>/assets/build/js/utils.js",
utilsScript: "<?php echo $BaseUrl;?>/assets/css/country/js/utils.js",
});
</script>

<script>
// Keep the form while checking terms and conditions
var formId = "buRegForm"; 
var url = location.href; 
var formIdentifier = `${url} ${formId}`; 
var form = document.querySelector(`#${formId}`); 
var formElements = form.elements;

document.onLoad = populateForm();

$(document).on('click', '.termsCond', function() {
$('#spUserCountry').val("");
data = getFormData();
localStorage.setItem(formIdentifier, JSON.stringify(data[formIdentifier]));
});

function getFormData (){
let data = { [formIdentifier]: {} };
for (const element of formElements) {
if (element.name.length > 0) {
data[formIdentifier][element.name] = element.value;
}
}
return data;
}

function populateForm () {
if (localStorage.key(formIdentifier)) {
const savedData = JSON.parse(localStorage.getItem(formIdentifier));
if (savedData != null) {
for (const element of formElements) {
if (element.name in savedData) {
element.value = savedData[element.name];
}
}
}
}
}
</script>
<script>
$(".otp_send").on('click', function() {
var formData = new FormData($("#sendOtpForm")[0]);
var cell_no = $("#respUserEphone").val();
if(cell_no == '')
{
$(".ph_no").html("<div class='alert alert-alert'>Please enter cell no.</div>");
}
else
{


$.ajax({
url: "authentication/sendOtp.php", 
method: 'POST',
data: formData,
dataType: "json",
contentType: false,
processData: false,
success: function(response) {
alert('310');
alert(response);
//alert(response);

console.log(response);
if (response == '1') {
$(".phone_verify_codeDiv").show();
$(".otp_send").hide();
$(".otp_send_call").hide();
$(".resend_code").show();
$(".resend_code_call").hide();
$(".otp_verify").show();
$(".errormsg").html("<div class='alert alert-success'>Code is sent to your phone, please check.</div>");

} 
},
});
}
});

$(".resend_code").on('click', function() {
var formData = new FormData($("#sendOtpForm")[0]);
var cell_no = $("#respUserEphone").val();
if(cell_no == '')
{
$(".ph_no").html("<div class='alert alert-alert'>Please enter cell no.</div>");
}
else
{


$.ajax({
url: "authentication/sendOtp.php",
method: 'POST',
data: formData,
dataType: "json",
contentType: false,
processData: false,
success: function(response) {
alert('347');
alert(response);

console.log(response);
if (response == '1') {
$(".phone_verify_codeDiv").show();
$(".otp_send").hide();
$(".otp_send_call").hide();
$(".resend_code_call").hide();
$(".otp_verify").show();
$(".errormsg").html("<div class='alert alert-success'>Code is re-sent to your phone, please check.</div>");

} 
},
});
}
});

$(".otp_send_call").on('click', function() {
var formData = new FormData($("#sendOtpForm")[0]);
// var num = $("#respUserEphone").val();
// var countrycd = $("#txtCountryCode").val();
// var mno = (countrycd + num);
// var data = $_SESSION(mno);
// alert(mno);
var cell_no = $("#respUserEphone").val();
if(cell_no == '')
{
$(".ph_no").html("<div class='alert alert-alert'>Please enter cell no.</div>");
}
else
{
$.ajax({
url: "authentication/sendotpcall.php",
method: 'POST',
dataType: "json",
data: formData,
contentType: false,
processData: false,
success: function(response) {
console.log(response);
if (response == '1') {
$(".phone_verify_codeDiv").show();
$(".otp_send").hide();
$(".otp_send_call").hide();
$(".resend_code_call").show();
$(".resend_code").hide();
$(".otp_verify").show();
$(".errormsg").html("<div class='alert alert-success'>Code is sent to your phone, please receive the call.</div>");

} 
},
});
}
});

$(".resend_code_call").on('click', function() {
var formData = new FormData($("#sendOtpForm")[0]);
var cell_no = $("#respUserEphone").val();
if(cell_no == '')
{
$(".ph_no").html("<div class='alert alert-alert'>Please enter cell no.</div>");
}
else
{


$.ajax({
url: "authentication/sendotpcall.php",
method: 'POST',
data: formData,
dataType: "json",
contentType: false,
processData: false,
success: function(response) {
console.log(response);
if (response == '1') {
$(".phone_verify_codeDiv").show();
$(".otp_send").hide();
$(".otp_send_call").hide();
$(".resend_code").hide();
$(".otp_verify").show();
$(".errormsg").html("<div class='alert alert-success'>Code is re-sent to your phone, please receive the call.</div>");

} 
},
});
}
});

$(".otp_verify").on('click', function() {
var formData = new FormData($("#sendOtpForm")[0]);
$.ajax({
url: "authentication/verifyOtp.php",
method: 'POST',
data: formData,
dataType: "json",
contentType: false,
processData: false,
success: function(response) {
console.log(response);
if (response == '1') {
window.location = BASE_URL+"/emailvarify.php";
} else {
$(".errormsg").html("<div class='alert alert-danger'>Code entered is not correct. Please enter the correct code.</div>");
}
},
});
});


</script>
<script language="javascript" type="text/javascript">
function removeSpaces(string) {
return string.split(' ').join('');
}
</script>
</body>
</html>
<?php
} ?>