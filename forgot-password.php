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
	@media (min-width:241px) and (max-width:767px) {

.logo_forgot{
        left: 30%
    }

.forgot-pass{
	margin-left: -25px;
}
.forgot-desc{
	margin-left: -25px;
}
#spfregemail{
	margin-left: -5px;
}
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

input#spfregemail::placeholder {
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



input#spfregemail1::placeholder {
{
opacity:1;
color: #D3D3D3;

}

input#spfregemail1:focus {
color: #ffa;
}
input#spfregemail1 {
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
<a href="<?php echo $BaseUrl;?>" class="logo_forgot"><img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>

<h2 class="forgot-pass">Forgot Password</h2>
<p class="forgot-desc">Enter your email or phone and we'll send you a link to reset your password</p>
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
<form id="formgot" class="container-fluid" autocomplete="on" method="post" action="authentication/forgot.php">
<div class="form-group has-feedback">
<label for="text" class="lbl_1"><span class="red"><span class="spfregemail"></span></span></label>
<label for="text" class="lbl_1"><span class="red"><span class="spfregemail1"></span></span></label>
<div class="">
<input type="text" class="form-control" id="spfregemail" name="spfregemail" placeholder="Input your email or phone" >
</div>
<span class="help-block1" style="color: #00a3c0;font-weight: bold;"></span>
<span class="emailNotValid1" style="color: #F00;font-weight: bold;" ></span>


<span class="help-block" style="color: #00a3c0;font-weight: bold;"></span>
<span class="emailNotValid" style="color: #F00;font-weight: bold;" ></span>


</div>

<div class="text-center">
<button id="forreset" type="submit" data-loading-text="Emailing..." class="btn_forgotPass btn-border-radius">Reset </button>
<div id= "countdown"></div>
<div id= "countdown1"></div>
<a href="<?php echo $BaseUrl;?>/login.php" class="forgot_password">Already a Member? Sign in here!</a>
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

<?php include('component/f_btm_script.php'); ?>
</body>
</html>
