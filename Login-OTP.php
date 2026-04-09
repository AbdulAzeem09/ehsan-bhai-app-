<?php
include("univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html> 
<html lang="en-US">

<head>
<?php include('component/f_links.php');?>
<style type="text/css">
    h2#swal2-title {
    font-size: 15px;
}
/*
h2#swal2-title {
font-size: 20px;
}*/
.has-feedback .form-control {
    padding-right: 0.5px;
}
.forgot-pass {
font-size: 35px;
margin-top: 18px;

color: #282828;
}
.forgot-desc {
padding-left: 40px;
padding-right: 40px;
font-weight: bolder;
color: #777;
}
.swal2-popup { 
font-size: medium!important;
}


body {
font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}

.captchatext22 {
background-color: #d6d4d4;
border: 1px solid #CCC;
height: 34px;
text-align: center;
/* width: 85px; */
display: inline-block;
border-left: none;
padding: 5px;
font-size: 16px;
}



input#spfregemail::placeholder 
{
opacity:1;
color: #D3D3D3;

}

input#spfregemail:focus {
color: #ffa;
}
input#spfregemail {
color: #141111!important;
opacity: 0.9!important;
font-size: 15px;
}
</style>
</head>

<body class="bg_forgot">
<section class="homepage">
<div class="container">
<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="forgot_widget">
<div class="row">
<div class="col-sm-12">
<div class="pad_top_55">
<div class="row logo_forgot">
<div class="col-sm-12 text-center">
<a href="<?php echo $BaseUrl;?>" class=""><img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>

<!-- <h2 class="forgot-pass">Login With OTP</h2> -->
<p class="forgot-desc" style="font-size:20px;">Please Enter Your Email or Phone<br> To send Code</p>
</div>
</div>

<?php
//print_r($_SESSION);  
if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
<p class="alert alert-danger error_show"><strong>Error!</strong> <?php echo $_SESSION['err'];?></p><?php
$_SESSION['count']++;
unset($_SESSION['err']);
}else{
?><?php
}
?>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>


<div class="forgotForm">
<form id="formId" class="container-fluid" autocomplete="on" method="post" action="authentication/sendloginotp.php">
<div class="row">
<div class="col-md-6">
<input type="radio" name="radio" value="0" id="numberRadio" onchange="showInput(this)" checked style="margin-bottom: 1.9px;"><label for="numberRadio">&nbsp;Phone</label> 
</div>
<div class="col-md-6">
<input type="radio" name="radio" value="1" id="emailRadio" onchange="showInput(this)" style="margin-bottom: 1.9px;"><label for="emailRadio">&nbsp;Email</label>
</div>

</div>
<div class="form-group has-feedback">
<label for="email" class="lbl_1"><span class="red"><span class="spfregemail"></span></span></label>
<input type="tel" id="phoneInput" class="form-control ggggg" placeholder="Enter Number" name="spfregemail" 
<?php if($_SESSION['validdataemail']=='yes'){ ?>
style="display:none;
<?php } ?>
">
<input type="tel" id="email" class="form-control hhhhh" placeholder="Enter Email" name="spfregemail" 
<?php if($_SESSION['validdataemail']=='yes'){ ?>
style="display:block; "
<?php } else {?>
style="display:none;"
<?php } ?>
>
<input type="hidden" id="hiddenDialCode" name="c_code" value="91">

<?php 
$randomno = rand(111111,999999);
?>

<input type="hidden" name="" id="h1" value="<?php echo $randomno ?>">
<!-- <div class="form-group">
<input type="text" id="mobile_code" class="form-control" placeholder="Phone Number" name="name">
</div> -->
<div class="row">
<br><input type="text" id="u1" name="userin" class="form-control" placeholder="Type The Number Here" style="width: 163px!important;float:left;border-radius: 0px;margin-bottom: 15px;" required/> 
<div class="captchatext22" style="user-select:none;"><?php echo $randomno; ?>&nbsp;<a href="" class="refresh" id="clikk1"><i class="fa fa-refresh"></i></a></div>
</div>

<span class="help-block" style="color: #00a3c0;font-weight: bold;"></span>
<span class="emailNotValid" style="color: #F00;font-weight: bold;" ></span>

</div>

<div class="text-center">



<button type="submit"  class="btn_forgotPass btn-border-radius" name="save" id="sent1">Send Code</button>




<div id= "countdown"></div>
<a href="<?php echo $BaseUrl;?>/login.php" class="forgot_password"> Login with Email</a>
</div>        

</form>
</div>

<div class="space-lg"></div>








</div>
</div>

</div>                                
</div>
</div>
</div>
</div>

</div>
</section>


<?php 

if($_SESSION['emaillogin'] == 'yes'){
unset($_SESSION['emaillogin']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'Please enter the email address that was used at registration', 
)
</script>
<?php } ?>


<?php 

if($_SESSION['mail_notverify'] == 'yes'){
unset($_SESSION['mail_notverify']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'Email ID Not verify or Email Locked', 
)
</script>
<?php } ?>





<?php 

if($_SESSION['phonelogin'] == 'yes'){
unset($_SESSION['phonelogin']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'Please Enter Valid phone number , Phone number not Exist!', 
)
</script>
<?php } ?>



<?php
if($_SESSION['phone_notverify'] == 'yes'){
unset($_SESSION['phone_notverify']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'The phone number entered is not linked to any account or it is not verified. Please enter a verified phone number or login using your email.', 
)
</script>
<?php } ?>


<?php
if($_SESSION['validdata'] == 'yes'){
unset($_SESSION['validdata']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
    

/*const yesBtn = document.getElementById('emailRadio');*/
/*yesBtn.checked = true;
*/
Swal.fire(
'The phone number entered is not linked to any account or it is not verified. Please enter a verified phone number or login using your email.', 
);

  //   document.getElementById("emailRadio").click();

</script>
<?php } ?>




<?php
if($_SESSION['validdataemail'] == 'yes'){
unset($_SESSION['validdataemail']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>



 const yesBtn = document.getElementById('emailRadio');

yesBtn.checked = true; 


Swal.fire(
'Please enter the email address that was used at registration.', 
)
</script>
<?php } ?>













<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
$("#sent1").on("click",function(e){
e.preventDefault();
var hiden = document.getElementById("h1").value;
var user  = document.getElementById("u1").value;
if(user == ""){
Swal.fire('Please fill the capcha code');
return false;

}


if(hiden == user){
$("#formId").submit();
}

else{

Swal.fire('Captcha Not Match')

}
});


</script>
<script type="text/javascript">
$("#phoneInput").intlTelInput({
initialCountry: "in",
separateDialCode: true,
utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var emailInput = document.getElementById("email");

    if (emailInput.style.display === "block") {
        var phoneInputs = document.querySelectorAll(".iti__flag-container");
        phoneInputs.forEach(function(input) {
            input.style.display = "none";
        });
    }

function showInput(radio) {
    var phoneInputs = document.querySelectorAll(".iti__flag-container");
    var phoneInput = document.querySelectorAll(".ggggg");
    var emailInputs = document.querySelectorAll(".hhhhh");
     // Select all elements with the specified class

    if (radio.value === "1") {
        // Loop through all elements with the class and hide each one
        phoneInputs.forEach(function(input) {
            input.style.display = "none";
        });
          phoneInput.forEach(function(input) {
            input.style.display = "none";
        });
            emailInputs.forEach(function(input) {
            input.style.display = "block";
        });
    } else {
        // Loop through all elements with the class and show each one
        phoneInputs.forEach(function(input) {
            input.style.display = "block";
        });
         phoneInput.forEach(function(input) {
            input.style.display = "block";
        });
            emailInputs.forEach(function(input) {
            input.style.display = "none";
        });
        // Initialize intlTelInput only when the phone input is shown
        
    }
}
$('li').click(function () {

var clickedValue = $(this).data('dial-code');

// alert(clickedValue);
$('#hiddenDialCode').val(clickedValue);
});
</script>


<?php include('component/f_btm_script.php'); ?>
</body>
</html>
