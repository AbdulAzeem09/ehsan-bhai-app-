<?php
include("univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;

$userid=$_GET['uid'];

$uid=base64_decode($userid);

//print_r($uid);

$res = $u->loginverifycode($uid);

$row = mysqli_fetch_assoc($res);

$phone_verify_code = $row['phone_verify_code'];

$spUserEmail = $row['spUserEmail'];

$spUserPassword = $row['spUserPassword'];



//  print_r($row['phone_verify_code']);


?>


<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('component/f_links.php');?>
<!-- PAGE LINKS -->
<script src="<?php echo $BaseUrl; ?>/assets/js/register_script.js"></script>
<!-- END -->
</head>

<body class="bg_login">        
<section class="homepage">
<div class="container">
<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-xs-12">
<div class="sign_widget m_top_150" style="border-radius: 25px; padding-bottom: 20px;">
<div class="row">
<div class="col-sm-12">
<div class="pad_top_55">
<div class="row logo_login">
<div class="col-sm-12 text-center">
<a href="<?php echo $BaseUrl;?>" class=""><img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>
<h3>Authentication Required </h3>
<p style="margin-bottom: 10px;   margin-top: 6px;   font-size: 13px;"> Enter the code you received on your cell phone so we know that this is your account.</p>
</div>
</div>                                            
<div class="loginForm">

<!--   <?php echo"hereid"; print_r($uid);?> --> 

<?php if(isset($_SESSION['err'])){ ?>
<div class="alert alert-danger error_show">
<?php echo $_SESSION['err'];?></div><?php

unset($_SESSION['err']);
}else{
?><div class="loginerrormsg"></div><?php
}?>
<!--  <div class="errormsg"></div> -->

<div id="invalid"></div>
<form id="blogin" method="post" action="authentication/login.php">


<input type="hidden" name="uid" value="<?php echo $uid;?>" id="logintxtuid">

<input type="hidden" name="spUserEmail" value="<?php echo $spUserEmail ;?>">

<input type="hidden" name="spUserPassword" value="<?php echo $spUserPassword;?>">



<input type="hidden" name="verifycode" value="<?php echo $phone_verify_code;?>">



<div class="form-group">

<label class="text-left">Enter the SMS code</label>

<input type="text" class="form-control"
name="verifycode"> 

</div>
<a href="#" onclick="get_loginresendcode(<?php print_r($uid);?>);"><p style="text-decoration: underline;"><b>Re-Send OTP</b></p></a>


<div class="text-center">

<button type="submit" id="" autocomplete="off" class="btn btn_sign">Submit Code</button>

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
</section>

<?php include('component/f_btm_script.php'); ?>
</body>

<script type="text/javascript">

// ===RESEND CODE SEND TO THE USER
//$("#loginresendcode").on("click", function(){

function get_loginresendcode(u_id){

var uid = u_id;
//  alert(uid);

if(uid > 0){
$.ajax({
type: "POST",
url: BASE_URL+"/authentication/resend-login.php",
cache:false,
data: 'uid='+uid,
success: function(data) {
//console.log(data.trim());
//window.location.reload();
if(data.trim() == 1){
$(".loginerrormsg").html("<div class='alert alert-success'>Code Sent To Your Mobile Number.</div>");

}else{
$(".loginerrormsg").html("<div class='alert alert-danger'>Some error is occoured kindly refresh you page and try to login.</div>");
}
}
});
}
}
// ===end
</script>
</html>
