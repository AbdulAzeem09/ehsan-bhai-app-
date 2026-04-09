<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
// if ( ini_get( 'allow_url_fopen' ) ) {
//      echo "allow_url_fopen is ENABLED.\n";
//  } else {    
//      echo "allow_url_fopen is DISABLED.\n";
//  } 
error_reporting(0);
include("univ/baseurl.php" );
session_start();
$email_otp = $_SESSION['email_otp'];
function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if(empty($_SESSION['last_user'])){
    $re = new _redirect;

    $location = $BaseUrl."/sign-up.php";
    $re->redirect($location);
    die;
} 
if($_GET['email']=='not'){

?>	
<br><br><div class="alert alert-danger 1 text-center" style='color:red;margin-left: 50px;margin-right: 50px;' role="alert">	
<strong>Warning!</strong> Please Verify Your Email First!</div>
<?php }

$errorotp = '';
if(isset($_POST['Verify'])){
    if($_POST['emailcode']==$_SESSION['email_otp'])
    {  
        $data=array('email_verify_code' => 0, 'is_email_verify' => 1, 'spUserLock' => 0, 'deactivate_status' => 0);

        $st= new _spuser;
        $sta= $st->updatemailstatus($data,$_SESSION['last_user']);

        $_SESSION['email_verified']= 1 ;
        $uid = $_SESSION['chkuid'];
        $u= new _spuser;
        $res = $u->loginverifycode($uid);
        $row = mysqli_fetch_assoc($res);


        $e = new _email;
        $au_email = $row["spUserEmail"];
        $_SESSION["email"] =  $row["spUserEmail"];
        $au_username =$row["spUserName"];
        $au_me =$row["idspUser"];

        $BaseUrl1=$BaseUrl; 
        header("Location: $BaseUrl1/registration-steps.php");
    }
    else{
        $errorotp =  "<div class='text-danger'><strong >Warning!</strong> Verification Code doesn't Match</div>";
    }

}


if(isset($_SESSION['pid'])){
$re = new _redirect;
$location = $BaseUrl."/timeline/";
$re->redirect($location);
}else{
$_SESSION['pageid'] = 'verifyemail';
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<style>

.user_email{
    font-weight: 500;
    text-align: center;
    padding-bottom: 13px;
    font-size: 18px;
}
.error, .erormsg {
    color: #F00 !important;
}
</style>

<!DOCTYPE html>
<html lang="en-US">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<head>
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="image/bootstartp-5/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="assets/css/signupcss/style.css">
    <title>Confirm Your Email</title>
</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body class="bg_signup">

    <section class="container cnfm_mail">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <img src="image/logosharepage 1.png" class="img-fluid" alt="">
            </div>
            <h2 class="pb-1">The SharePage</h2>
        </div>
       
        <form id="sendOtpForm" class="col-12 cont" method="post" action="verifyemail.php" autocomplete="chrome-off">
        <input id="uType" type="hidden" value="3">
        <input type="hidden" name="spUserIpLastLogin" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
        <input type="hidden" name="txtCountryCode" id="txtCountryCode" value="+1" />

            <h3 class="text-center">Confirm Your Email</h3>
            <hr>
            <p class="my-lg-3 my-2 text-center">Enter the code we sent to your email address</p>
           
            <div class="inpt_email d-grid my-lg-4 my-lg-3 my-2">
            <span class="user_email"> <?php echo $_SESSION['new_email']; ?></span>
            <div class="vfy_eml_btn d-flex">
                <input type="text"  class="form-control" id="" name="emailcode" onblur="this.value=removeSpaces(this.value);" value=""  required>
                <button  type="Submit" class="col-4" value="Verify" name="Verify" class="btn btn-primary">VERIFY</button>                    
            </div>
            <?php if($errorotp){ echo $errorotp; }?> 
            </div>
            <span class="ph_no erormsg"></span>
            <P class="rec_cnt text-center">Didn't receive the code? 
            <a onclick="notification()" href="<?php echo $BaseUrl; ?>/authentication/resnd_email_otp.php"><span class=" ps-2 resend_code"><b>Send Again</b></span></a>

            </P>
        
        </form>
    </section>

<?php include('component/f_btm_script.php'); ?>
<!-- telephone -->
<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>


//  var input = document.querySelector("#respUserEphone");
//     window.intlTelInput(input, {
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
        // preferredCountries: ['us', 'ca'],
        // separateDialCode: true,
        // utilsScript: "<?php //echo $BaseUrl;?>/assets/build/js/utils.js",
        // utilsScript: "<?php //echo $BaseUrl;?>/assets/css/country/js/utils.js",
    // });
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
var em_otp = $("#emailcode").val();
if(em_otp == '')
{
$(".ph_no").html("<div class='alert alert-alert'>Please enter email OTP</div>");
}
else
{


$.ajax({
url: "verifyemail.php",
method: 'POST',
data: formData,
dataType: "json",
contentType: false,
processData: false,
success: function(response) {

alert(response);

console.log(response);
if (response == '1') {
$(".phone_verify_codeDiv").show();
$(".otp_send").hide();
$(".otp_send_call").hide();
$(".resend_code").show();
$(".resend_code_call").hide();
$(".otp_verify").show();
$(".errormsg").html("<div class='alert alert-success'>Code is sent to your email, please check your inbox/spam folder.</div>");

} 
},
});
}
});

/* $(".resend_code").on('click', function() {
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
});*/

/*  $(".otp_send_call").on('click', function() {
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
});*/

/* $(".resend_code_call").on('click', function() {
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
});*/

/* $(".otp_verify").on('click', function() {
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
});*/


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
