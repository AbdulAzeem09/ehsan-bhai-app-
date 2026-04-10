<?php session_start();?>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php 
include("./univ/baseurl.php");
include('component/f_links.php');?>
<!-- PAGE LINKS -->
<!-- CSS from /css directory -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/home.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/custom.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/style.css">
<!-- END CSS -->

<script src="<?php echo $BaseUrl; ?>/assets/js/register_script.js?<?php echo rand(); ?>"></script>
<!-- END -->
<link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">

<!--Bootstrap core css-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css">



<!-- Custom Style Sheet-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/custom.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" > -->
<!-- TABLE CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/table.css">
<!-- END -->

<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- for unminified version proxima fonts -->

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/proxima/fonts.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!-- EMOJI EMOTION SMILE -->
<link href="<?php echo $BaseUrl; ?>/assets/lib_emoji/css/emoji.css" rel="stylesheet">

<!--this is links for scroller Start-->
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/OverlayScrollbars.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/os-theme-round-dark.css" rel="stylesheet" type="text/css">
<!--this is links for scroller Start-->

<!-- chat box -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $BaseUrl; ?>/assets/chat/chat.css" />

<!-- DATE AND TIME PICKER -->
<!-- <link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet" media="screen"> -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<!-- another custome css (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<!-- css for font animation effect (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/font_animate.css">

<style>

@media only screen and (max-width: 600px) {
    #togglePassword {
        
  }
}
</style>
<style>
    .color{
        color: white;
    }
    .error_show{
        margin-left: 15px;
    }
        .forgotForm {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            position: relative;
        }

        .fa {
            position: absolute;
            font-size: 16px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .forgotForm {
                max-width: 100%;
            }
            .fa-eye-slash {
                right: 10px;
            }
        }
        .btn-border-radius{
        	border-radius: 10px !important;
        }
    </style>

</head>

<body class="bg_login">
<section class="homepage">
<div class="container">
<div class="">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-xs-12">
<div class="sign_widget m_top_150">
<div class="row">
<div class="col-sm-12">
<div class="pad_top_55">
<div class="row logo_login">
<div class="col-sm-12 text-center">
<a href="<?php echo $BaseUrl;?>" class=""><img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>
<h5>Sign in to Discover</h5>
<h3>The SharePage!</h3>
</div>
</div>
<div class="loginForm">
<?php
if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
<p class="alert alert-danger error_show"><strong>Error!</strong> <?php echo $_SESSION['err'];?></p><?php
$_SESSION['count']++;
unset($_SESSION['err']);
}else{
?><div class="space-lg"></div><?php
}
?>
<div id="invalid" style="display: none">
  <div class="alert alert-info error_show" role="alert">
    <p style="text-align: center;">Your email is not verified. Please verify your email.</p>(<span id="email"></span>).
    <br>
    <div class="row">
        <br>
        <div class="col-md-2"></div>
      <button class="btn btn-primary"><a class="color" href="https://dev.thesharepage.com/authentication/resnd_email_otp.php">RESEND CODE</a></button>
    </div>
  </div>
</div>
<form id="blogin" method="post" action="authentication/verifylogin.php" autocomplete="off">

<!--  <input type="hidden" id="custId" name="custId" value="3487"> -->


<div class="form-group">
<label for="email" class="lbl_1">Email<span class="red">* <span class="loginame"></span></span></label>
<input type="email" id="loginame" class="form-control " data-lo="1" name="spUserEmail"  autofocus autocomplete="off" minlength="4" >
</div>
<div class="form-group">
<label for="pwd" class="lbl_2">Password<span class="red">* <span class="lpass"></span></span></label>
<!-- <input type="password" class="form-control" id="lpass" name="spUserPassword"autocomplete="off"> -->
<input type="password" class="form-control" id="lpass" style="position:relative;" name="spUserPassword" autocomplete="current-password"><i class="fa fa-eye" id="togglePassword" style="right: 9px; top: 30px;"></i> 
</div>
<div class="text-center">
<button type="submit" id="signin" data-loading-text="Authenticating..." autocomplete="off" class="btn btn_sign">Sign In</button>
<!-- <a class="btn btn_sign" href="<?php echo $BaseUrl;?>/Login-OTP.php">Login with Code</a><br><br> -->
<!--                                                        <a  class="w-30 btn btn-lg btn-primary my-1" href="--><?php //echo $BaseUrl;?><!--/guest/index.php" style="border-radius:130px; padding:5px 14px; font-size:13px;">Continue as Guest</a>-->
<a href="<?php echo $BaseUrl;?>/forgot-password.php" class="forgot_password">Forgot password?</a>
</div>

</form>
<div class="footer_login text-center">
<a href="<?php echo $BaseUrl;?>/sign-up.php">Not a Member? Sign Up </a>
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
<script>
  $(document).ready(function () {
  // Listen for changes in the input field
  $("#loginame").on("input", function () {
    var inputValue = $(this).val();
    $("#email").text(inputValue);
  });
});  
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#lpass');

togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('fa-eye-slash');
});
</script>

<?php include('component/f_btm_script.php'); ?>
</body>
</html>
