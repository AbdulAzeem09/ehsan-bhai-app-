<?php
include("univ/baseurl.php");
session_start();

function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;

$userid=$_GET['id'];

$uid=base64_decode($userid);

$res = $u->loginverifycode($uid);

$row = mysqli_fetch_assoc($res);

$idspuser = $row["idspUser"];

$is_phone_verify = $row["is_phone_verify"];
//echo "<pre>"; print_r($row); exit;
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
<?php if(!empty($row) &&  $is_phone_verify == 0) { ?>
<h3>Phone Verified</h3>
<p style="margin-bottom: 10px;   margin-top: 6px;   font-size: 13px;"> Enter the code you received on your cell phone so we know that this is your account.</p>
<?php } else { ?>
<h3>Your Phone Number Is Already Verify</h3>
<?php } ?>
</div>
</div>                                            
<div class="loginForm">
<div class="loginerrormsg"></div>
<?php if(!empty($row) && $is_phone_verify == 0) { ?>
<form id="blogin" method="post" action="">
<div class="form-group">

<label class="text-left">Enter the SMS code</label>

<input type="text" class="form-control" id="verifycode" name="verifycode"> 

</div>                                                
<div class="text-center">

<button type="button" id="verifyphone" onclick="checkverify(<?php echo $idspuser; ?>)" class="btn btn_sign">Submit Code</button>

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

<?php include('component/f_btm_script.php'); ?>
</body>

<script type="text/javascript">
function checkverify(uid){
var vcode = $("#verifycode").val();

if(vcode == "")
{
$(".loginerrormsg").html("<div class='alert alert-danger'>Please Enter Code</div>");
}
else 
{
$.ajax({
type: "POST",
url: BASE_URL+"/verifycode.php",
cache:false,
data: {vcode:vcode,uid:uid},
success: function(data) {
if(data.trim() == 1){
$(".loginerrormsg").html("<div class='alert alert-success'>Your Phone Number Is Verified Successfully.</div>");

}else{
$(".loginerrormsg").html("<div class='alert alert-danger'>Somthing Went Wrong</div>");
}
}
});
}
}

</script>
</html>
