<?php
include("univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");


if($_SESSION['emailsend'] == ""){

$re = new _redirect;

$location = $BaseUrl."/Login-OTP.php";
$re->redirect($location);


}


?>
<!DOCTYPE html> 
<html lang="en-US">

<head>
<?php include('component/f_links.php');?>
<style type="text/css">
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

input#spfregemail::placeholder 
{
opacity:1;
color: #D3D3D3;

}
#retime{
pointer-events: none;
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

<!-- <h2 class="forgot-pass">Enter the  OTP</h2> -->
<p class="" style="font-size:20px;">We have sent you one time code to <b style="font-weight:bolder;color:#777;"><?php echo $_SESSION['emailsend'] ?></b></p>
<a class="desble" href="<?php echo $BaseUrl ?>/resendotp.php" id="retime" style="margin-top:178px;">Click here to resend</a><br>
<div id= "countdown2"></div>

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
<div class="forgotForm">
<form id="" class="container-fluid" autocomplete="on" method="post" action="authentication/validotp.php">
<div class="form-group has-feedback">
<label for="email" class="lbl_1"><span class="red"><span class="spfregemail"></span></span></label>
<div class="">
<input type="number" class="form-control" id="spotp" name="spotp" placeholder=" Enter Code" required/>

</div>
<span class="help-block" style="color: #00a3c0;font-weight: bold;"></span>
<span class="emailNotValid" style="color: #F00;font-weight: bold;" ></span>

</div>

<div class="text-center">
<button type="submit"  class="btn_forgotPass" name="save">Validate Code</button>

<div id= "countdown"></div>
<a href="<?php echo $BaseUrl;?>/login.php" class="forgot_password"> </a>
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

<script>
const myTimeout = setTimeout(myGreeting,40100);

function myGreeting() {
document.getElementById("retime").style="pointer-events: revert;margin-top:178px;";
}
var timeleft = 20;
var downloadTimer = setInterval(function(){
if(timeleft <= 0){
clearInterval(downloadTimer);
document.getElementById("countdown2").style= "display:none";
} else {
document.getElementById("countdown2").innerHTML = timeleft + " seconds remaining";
}
timeleft -= 1;
}, 2000);
//window.setTimeout("f2()",300);
//.style="background-image:radial-gradient

</script>




<?php 

if($_SESSION['validOTP'] == 'yes'){
unset($_SESSION['validOTP']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'Please Enter Valid Code', 
)
</script>
<?php } ?>



<?php 
if($_SESSION['resend'] == 'yes'){
unset($_SESSION['resend']);
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Swal.fire(
'Code is sent to your email.', 
)
</script>
<?php } ?>





<?php include('component/f_btm_script.php'); ?>
</body>
</html>
