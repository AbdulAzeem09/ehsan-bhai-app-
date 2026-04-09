<?php
// error_reporting(E_ALL);
//ini_set('display_errors', '1');




include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business_for_sale/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../component/f_links.php'); ?>
<?php //include('../component/links.php'); 
?>

<!-- owl carousel -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->

<?php include('../../component/dashboard-link.php'); ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>


<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>:: The SharePage - The SharePage ::</title>

<!--  Favicon 
<link rel="shortcut icon" href="images/favicon.png">

<!-- CSS -->
<link rel="stylesheet" href="css/stylesheet.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
<style>
.parallax-overlay {
z-index: 0px !important;
}

.parallax {
z-index: 0px !important;
}

input.form-control {
height: 34px;
}

.cardimg img {
margin: 0px !important;
height: 169px !important;
width: 100% !important;
border-radius: 30px !important;
}

.custom-pr {
padding-right: 0px;
}

.custom-pl {
padding-left: 0px;
}

.header_mg {
margin-left: 150px !important;
}

/* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 600px) {
.custom-pr {
padding-right: 15px;
}

.custom-pl {
padding-left: 15px;
}

.header_mg {
margin-left: 0px !important;
}
}

.cadtext {
margin-top: 9px;
}

.cadtext row {
padding-top: 10px;
padding-left: 20px;
}

.cadtext row p {
line-height: 23px;
}

.fontuser {
position: relative;
}

.fontuser i {
position: absolute;
left: 90%;
top: 6px;
color: gray;
}

.category {
position: relative;
}

.category img {
position: absolute;
left: 89%;
top: 20px;

}

.row {
margin-right: 0px;
}

body {

line-height: 17px;

}

.zoom1:hover {
-ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
font-size: 17px;
}

.sweet-alert fieldset {
border: none !important;
position: relative !important;
display: none !important;
}

.reload_btn {
position: absolute;
left: 94%;
top: 13px;
padding: 5px;
}
</style>
</head>

<body style="width: auto;">
<!--Loader
<div class="vfx-loader">
<div class="loader-wrapper">
<div class="loader-content">
<div class="loader-dot dot-1"></div>
<div class="loader-dot dot-2"></div>
<div class="loader-dot dot-3"></div>
<div class="loader-dot dot-4"></div>
<div class="loader-dot dot-5"></div>
<div class="loader-dot dot-6"></div>
<div class="loader-dot dot-7"></div>
<div class="loader-dot dot-8"></div>
<div class="loader-dot dot-center"></div>
</div>
</div>
</div>
<!-- Loader end -->

<!-- Wrapper -->

<!-- Compare Property Widget -->

<!-- Compare Property Widget / End -->

<!-- Header Container -->
<?php

$business_for_sale ="business_for_sale";
include_once("../header.php"); ?>


<div class="clearfix" style="color: white;"></div>

<!-- Banner -->
<div class="row" style="background-color: white;height: 2px;">

</div>
<div class="parallax" data-background="images/home-parallax-2.jpg" data-color="#7DBA41" data-color-opacity="0.72" data-img-width="" data-img-height="1600">
<div class="utf-parallax-content-area">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="utf-main-search-container-area">
<div class="utf-banner-headline-text-part">
<h2>The World’s largest marketplace of 57,319
Businesses for sale.</h2>

</div>

  

</div>
</div>
</div>
</div>
</div>
</div>

<!-- Content -->





<div class="col-md-12">
<div class="carousel">
<?php
$de = new _businessrating;
if ($_GET['search']) {
if ($_GET['category'] == 0) {
$de1 = $de->read_search_business1($_GET['search']);
//echo $de->$pst->sql;
//print_r($de12);
//die("#######################----");
} else {
$de1 = $de->read_searchCat_business($_GET['search'], $_GET['category']);
}
} else {
$de1 = $de->read_all_business_limit();
}
//print_r($de1);
if ($de1 != false) {
  //die("0000000000");
while ($row = mysqli_fetch_assoc($de1)) {
//echo $row['country'].'=====';
$de2 = $de->read_files($row['idspbusiness']);
//print_r($de2);

if ($row['uid'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['uid']);
if ($st1 != false) {
  $stt = mysqli_fetch_assoc($st1);
  $account_status = $stt['deactivate_status'];
}
}

$co = new _country;
$co1 = $co->readCountryName($row['country']);
if ($co1 != false) {
$co2 = mysqli_fetch_assoc($co1);
$country = $co2['country_title'];
}


$ci = new _city;
$co2 = $ci->readCityName($row['city']);
if ($co2 != false) {
$co3 = mysqli_fetch_assoc($co2);
$city = $co3['country_title'];
}


$img = '';
if ($de2 != false) {
$ro = mysqli_fetch_assoc($de2);
//print_r($ro);
$img = $ro['filename'];
}
//echo $img;
if ($account_status != 1) {
?>

<a href="business_detail.php?postid=<?php echo $row['idspbusiness']; ?>">
  <div class="col-md-4" style="padding: 20px;">
    <div class="row zoom1" style="border-radius: 30px;border:  solid 2px;background-color: white;">
      <div class="col-md-6 cardimg" style="padding: 0px; margin:5px;">
        <?php if ($img != false) { ?>

          <img class="form-control" src="<?php echo $BaseUrl . '/business_for_sale/uploads/' . $img; ?>" alt="">

        <?php } else { ?>
          <img class="form-control" src="download.jpg" alt="">
        <?php } ?>
      </div>
      <div class="col-md-5">

        <div class="row" style="padding-top: 10px;padding-left: 20px;">
          <label>
            <p style="line-height:17px;"><b>

                <?php echo $row['listing_headline']; ?></br>
                <label style="color: #468E4F;"><?php echo $row['location']; ?></label></br>
                <?php if ($row['business_type'] == 1) {
                  echo "Franchise";
                } else {
                  echo "Independent Sale";
                } ?>
              </b></p>
          </label><b><?php echo $country; ?></b>,<b>
            <?php echo $city; ?></b>
        </div>
      </div>
    </div>
  </div>
</a>

<?php }
}
}

else{

    echo "no data found";   
  }
    


?>




<!--  <a href="business_detail.php">
<div class="col-md-4" style="padding: 20px;">
<div class="row"
style="border-radius: 30px;border:  solid 2px;background-color: white;">
<div class="col-md-6 cardimg" style="padding: 0px;">
<img class="category" src="download.jpg" alt="">
</div>
<div class="col-md-5 cadtext">
<div class="row" style="padding-top:0px;padding-left:20px;">
<label>
<p style="line-height:20px;">
<b>
Running Who GMP
Certified Pharma Unit</br>
<label style="color: #468E4F;">Himachal Pradesh</label></br>
On Request
</b>
</p>
</label>
</div>
</div>
</div>
</div>
</a>
<a href="business_detail.html">
<div class="col-md-4" style="padding: 20px;">
<div class="row"
style="border-radius: 30px;border:  solid 2px;background-color: white;">
<div class="col-md-6 cardimg" style="padding: 0px;">
<img class="" src="download.jpg"
alt="">
</div>
<div class="col-md-5" style="margin:5px;">

<div class="row" style="padding-top: 0px;padding-left: 20px;">
<label>
<p style="line-height:17px;"><b>

Recharges, Bill Payments,
Money Transfer Business
<label style="color: #468E4F;"> Delhi</label></br>
On Request
</b></p>
</label>
</div>
</div>
</div>
</div>
</a>-->


</div>

</div>
<?php 
if($de1){
if(mysqli_num_rows($de1)>=3){

  ?>
 <span class="pull-right btn btn-primary"><a href="<?php echo $BaseUrl ?>/business_for_sale/all_listings.php?page=1" style="color:white;">View More</a></span>
<?php
}
}
?>

</div>
</div>
</section>



<!--<section class="fullwidth" data-background-color="linear-gradient(to bottom, #7dba41 0%, #468e4f 100%)"
style="color: white;">
<div class="container">
<div class="row">

<div class="col-md-10">
<h1 style="color: white;"><b>Subscribe to our email updates</b></h1>
<div style=" width: 100px; height: 5px;background-color:white;border-radius: 30px;"></div>

</div>




</div>
</br>
<div class="row">
<div class="col-md-3" style="color: white;">
<div class="carousel">

<p style="margin-left: 12px;">Enter your email for daily update !
</p>

</div>
</div>
<div class="col-md-9" style="text-align: center;">
<div class="col-md-4"></div>
<div class="col-md-6">
<h4 id="subsmsg"></h4>

<form class="subscription-form" action="subscriber.php" method="POST" onsubmit="successmsg()" >
<input type="email" name="email" required class="form-control" placeholder="E.g. Info@gmail.com" value="<?php //echo $_SESSION['spUserEmail'];
                                ?>"
style="border-radius: 30px;" /><button type="submit" class="subscription-form-btn btn btn-primary" 
style="border-radius: 30px;background: linear-gradient(to bottom, #eb6f33 0%, #eb6f33 100%);height: 40px;"><a
href="" style="color: white;" class="log_in"><b>Subscribe</b></a></button>


</form>


</div>


</div>


</div>



</div>
</div>
</section>-->


<!--<section class="fullwidth" data-background-color="#f5f5f0">
<div class="container">
<div class="row">
<div class="row">

<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: #468E4F;"><b>Buy a Business</b></h4>

<a href="#"><span style="color: black;"><b>All Listings</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Advanced Search</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Register</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Email Alerts</b></span> </a></br>



</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: #468E4F;"><b>Buy a Franchise</b></h4>
<a href="#"><span style="color: black;"><b>Franchise Home</b></span> </a></br>
<a href="#"><span style="color: black;"><b>All Franchises</b></span> </a></br>
<a href="#"><span style="color: black;"><b>A-Z</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Resales</b></span> </a></br>
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: #468E4F;"><b>Sell a Business</b></h4>
<a href="#"><span style="color: black;"><b>Create Listing</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Selling Guides</b></span> </a></br>
<a href="#"><span style="color: black;"><b>Services
Directory</b></span> </a></br>
<a href="#"><span style="color: black;"><b></b></span> </a></br>
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: #468E4F;"><b>For Brokers</b></h4>
<a href="#"><span style="color: black;"><b>Sign Up</b></span> </a></br>

</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: #468E4F;"><b>Advice & Features </b></h4>
<a href="#"><span style="color: black;"><b>All Articles</b></span> </a></br>
<a href="#"><span style="color: black;"><b>For Buyers</b></span> </a></br>
<a href="#"><span style="color: black;"><b>For Sellers</b></span> </a></br>
<a href="#"><span style="color: black;"><b>By Industry</b></span> </a></br>
</div>

</div>
</div>
</div>
</section>-->






<!-- Footer 
<div id="" style="background-color: #202447;color: white;">
<div class="container" >
<div class="row" style="color: white;">
</br>
<div class="col-md-4 col-sm-12 col-xs-12">
<h1 style="color: white;">THE SharePage</h1>
<p>BusinessesForSale.com is the world's
most popular website for buying or selling a
business. BusinessesForSale.com is the
world's most popular website for buying or
selling a business.
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>HELPFUL LINKS</b></h4>
Contact us</br>
Company Info
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>GUIDE</b></h4>
Navigation</br>

</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>OUR POLICIES</b></h4>  
Copyrights</br>
Privacy Policy
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4 style="color: white;"><b>MORE RESOURCES</b></h4>
Investment Oppoutunutues</br>

</div>
</div>
</br>
<div class="row">
<img style="height: 30px;width: 30px;" src="images/web 0021.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0022.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0023.png" alt="">&nbsp;&nbsp;&nbsp;
<img style="height: 30px;width: 30px;" src="images/web 0024.png" alt="">&nbsp;&nbsp;&nbsp;
</div>
<div class="row">
<div class="col-md-12">
<div class="copyrights" style="color: white;"><b>© Thesharepage by <a href="codelocksolutions.com">Codelock</a>, 2021 All rights reserved</b></div>
</div>
</div>
</div>
</div>-->
<div id="backtotop"><a href="#"></a></div>
</div>

<!-- Sign In Popup -->
<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
<div class="utf-signin-form-part">
<ul class="utf-popup-tabs-nav-item">
<li><a href="#login">Log In</a></li>
<li><a href="#register">Register</a></li>
</ul>
<div class="utf-popup-container-part-tabs">
<!-- Login -->
<div class="utf-popup-tab-content-item" id="login">
<div class="utf-welcome-text-item">
<h3>Welcome Back Sign in to Continue</h3>
<span>Don't Have an Account? <a href="#" class="register-tab">Sign Up!</a></span>
</div>
<form method="post" id="login-form">
<div class="utf-no-border">
<input type="text" name="emailaddress" id="emailaddress" placeholder="Email Address" required />
</div>
<div class="utf-no-border">
<input type="password" name="password" id="password" placeholder="Password" required />
</div>
<div class="checkbox margin-top-0">
<input type="checkbox" id="two-step">
<label for="two-step"><span class="checkbox-icon"></span> Remember Me</label>
</div>
<a href="forgot_password.html" class="forgot-password">Forgot Password?</a>
</form>
<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Log In <i class="icon-feather-chevrons-right"></i></button>
<div class="utf-social-login-separator-item"><span>or</span></div>
<div class="utf-social-login-buttons-block">
<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i>
Facebook</button>
<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i>
Google+</button>
<button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>
</div>
</div>

<!-- Register -->
<div class="utf-popup-tab-content-item" id="register">
<div class="utf-welcome-text-item">
<h3>Create your Account!</h3>
<span>Don't Have an Account? <a href="#" class="register-tab">Sign Up!</a></span>
</div>
<form method="post" id="utf-register-account-form">
<div class="utf-no-border margin-bottom-20">
<select class="utf-chosen-select-single-item utf-with-border" title="Single User">
<option>Single User</option>
<option>Agent</option>
<option>Multi User</option>
</select>
</div>
<div class="utf-no-border">
<input type="text" name="name" id="name" placeholder="User Name" required />
</div>
<div class="utf-no-border">
<input type="text" name="emailaddress-register" id="emailaddress-register" placeholder="Email Address" required />
</div>
<div class="utf-no-border">
<input type="password" name="password-register" id="password-register" placeholder="Password" required />
</div>
<div class="utf-no-border">
<input type="password" name="password-repeat-register" id="password-repeat-register" placeholder="Repeat Password" required />
</div>
<div class="checkbox margin-top-0">
<input type="checkbox" id="two-step0">
<label for="two-step0"><span class="checkbox-icon"></span> By Registering You Confirm That
You Accept <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></label>
</div>
</form>
<button class="margin-top-10 button full-width utf-button-sliding-icon ripple-effect" type="submit" form="utf-register-account-form">Register <i class="icon-feather-chevrons-right"></i></button>
<div class="utf-social-login-separator-item"><span>or</span></div>
<div class="utf-social-login-buttons-block">
<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i>
Facebook</button>
<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i>
Google+</button>
<button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>
</div>
</div>
</div>
</div>
</div>
<!-- Sign In Popup / End -->

<!-- Scripts -->
<!--<script src="scripts/jquery-3.3.1.min.js"></script>-->
<script src="http://codelocksolutions.in/track_site/jquerythesharepage.js"></script>
<script src="scripts/chosen.min.js"></script>
<script src="scripts/magnific-popup.min.js"></script>
<script src="scripts/owl.carousel.min.js"></script>
<script src="scripts/rangeSlider.js"></script>
<script src="scripts/sticky-kit.min.js"></script>
<script src="scripts/slick.min.js"></script>
<script src="scripts/masonry.min.js"></script>
<script src="scripts/mmenu.min.js"></script>
<script src="scripts/tooltips.min.js"></script>
<script src="scripts/typed.js"></script>
<script src="scripts/custom_jquery.js"></script>
<script>
function successmsg() {


swal("You Have Successfully Subscribe to us !");




}
</script>
<script>
var typed = new Typed('.typed-words', {
strings: ["Dream Home.", " Apartments.", " Residential.", " Commercial."],
typeSpeed: 80,
backSpeed: 80,
backDelay: 4000,
startDelay: 1000,
loop: true,
showCursor: true
});

function show() {
$("#advance_area").show();
}

function hide() {
$("#advance_area").hide();
}
</script>
<script>
$("#search_btn").click(function() {
var data = $("#search").val();
var cat = $(".category").val();

window.location.replace('<?php echo $BaseUrl ?>/business_for_sale/index.php?category=' + cat + '&search=' + data + '&page=1');

});
</script>


<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>


</body>

</html>
<?php } ?>