<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

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

$id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>:: The SharePage ::</title>

<?php include('../component/f_links.php'); ?>
<?php include('../component/links.php'); ?>
<!--  Favicon 
<link rel="shortcut icon" href="images/favicon.png">

<!-- CSS -->
<link rel="stylesheet" href="css/stylesheet.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
<style>
input.form-control {
height: 34px;
}

.fontuser {
position: relative;
}

.fontuser i {
position: absolute;
left: 80%;
top: 20px;
color: gray;
}

.chosen-container {
margin: 10px !important;
}

.category {
position: relative;
}

.category img {
position: absolute;
left: 90%;
top: 20px;

}

.row {
margin-right: 0px;
}

.chosen-container-single .chosen-single {
height: 30px !important;
line-height: 32px !important;
}

.fontuser i {
position: absolute;
left: 90%;
top: 6px;
color: gray;
}

.header_mg {
margin-left: 150px !important;
}

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

body {

line-height: 17px;

}

.btn_fb {
background-color: #3b5999;
font-size: 20px;
color: white;
padding: 7px 12px 7px 7px;
border-radius: 8px;
}

.btn_fb:hover {
color: white;
background-color: #6178ab;
}

.btn_google {
background-color: #3b5999;
font-size: 20px;
color: white;
padding: 7px 12px;
border-radius: 8px;
}

.btn_tweet {
background-color: #55acee;
font-size: 20px;
color: white;
padding: 7px 5px 7px 5px;
border-radius: 8px;
}

.btn_tweet:hover {
color: white;
background-color: #6178ab;
}

.btn_linkdin {
background-color: #3b5999;
font-size: 20px;
color: white;
padding: 7px 5px 7px 5px;
border-radius: 8px;
margin: 5px;
}

.btn_linkdin:hover {
color: white;
background-color: #6178ab;
}

.btn_whatsapp {
background-color: #0f8f46;
font-size: 20px;
color: white;
padding: 7px 12px;
border-radius: 8px;
}

.btn_whatsapp:hover {
color: white;
background-color: #35b96e;
}

.mt_d {
margin-top: -10px;
float: right;
margin-right: -125px;
}
</style>
<style>
#more {
display: none;
}
</style>
</head>

<body>
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
<?php include_once("../header.php"); ?>

<?php if (isset($_SESSION['succes']) == 2) { ?>

<div class="alert alert-success pull-right" role="alert" id="alert1" style="width: 534px;"><span>Message sent successfully!</span></div>
<script>
setTimeout(function() {

$("#alert1").hide();
}, 3000);
</script>
<?php } ?>

<div class="clearfix" style="color: white;"></div>

<!-- Banner -->

<?php
//$id=24;
//$id = $_GET['postid'];
$de = new _businessrating;
$de1 = $de->read_id_business($id);
// print_r($de1);
if ($de1 != false) {
while ($row = mysqli_fetch_assoc($de1)) {
$seller_id = $row['pid'];
//print_r($row);
//die("++++++++");
$seller_uid = $_SESSION['uid'];
$sales_revenue = $row['sales_revenue'];
$business_type = $row['business_type'];
$business_status = $row['business_status'];
$inventory_amount = $row['inventory_amount'];
$uid = $row['uid'];
$pid = $row['pid'];


$cash_flow = $row['cash_flow'];
$selling_reason = $row['selling_reason'];
$competition = $row['competition'];
$training_support = $row['training_support'];
$description = $row['description'];
$website_address = $row['website_address'];
$coid = $row['country'];
$stid = $row['state'];
$cid = $row['city'];
$headline = $row['listing_headline'];
$operation = $row['business_operation'];
$business_hours = $row['business_hours'];
$business_days = $row['business_days'];
$year = $row['year_established'];
$city_expansion = $row['city_expansion'];
$size = $row['business_size'];
$furniture = $row['furniture_value'];
$lease = $row['lease_per_month'];
$real_state_included = $row['real_state_included'];
$inventory_included = $row['inventory_includes'];
$furniture_included = $row['includes_furnitures'];
$sale_software = $row['sale_software'];
$business_category = $row['business_category'];
$location = $row['location'];

$start_description = substr($description, 0, 80);
$end_description = substr($description, 80, strlen($description));

//echo $row['idspbusiness'];
$de2 = $de->read_files($row['idspbusiness']);
$img = '';
if ($de2 != false) {
$ro = mysqli_fetch_assoc($de2);

$img = $ro['filename'];
}
}
}
$fav = $de->read_fav_business($id);

$co = new _country;
$co1 = $co->readCountryName($coid);
if ($co1 != false) {
$co2 = mysqli_fetch_assoc($co1);
$country = $co2['country_title'];
}

$st = new _state;
$st1 = $st->readStateName($stid);
if ($st1 != false) {
$st2 = mysqli_fetch_assoc($st1);
$state = $st2['state_title'];
}

$ci = new _city;
$ci1 = $ci->readCityName($cid);
if ($ci1 != false) {
$ci2 = mysqli_fetch_assoc($ci1);
$city = $ci2['city_title'];
}
?>

<!-- Slider -->
<div class="parallax titlebar" data-background="images/business.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.5" data-img-width="800" data-img-height="505" style="height: 250px;">
<div id="titlebar">
<div class="container">
<div class="row">
<div class="col-md-12" style="text-align: left; margin-top:100px;">

<!-- Breadcrumbs -->
<nav id="breadcrumbs" style="font-size:20px;">
<ul>
<li><a href="index.php?page=1">Home</a></li>
<li><?php echo $headline; ?>
</li>
</ul>
</nav>
</div>
</div>
</div>
</div>
</div>

<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="add_flag_business.php" class="sharestorepos">
<div class="modal-content no-radius bradius-15"> 
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $id; ?>">
<input type="hidden" name="admin_userId" value="<?php echo $seller_uid; ?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="20">
<div class="modal-header bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Flag Post</h4>
</div>
<div class="modal-body">
<div class="radio">
<label><input type="radio" name="why_flag" value="Duplicate post" checked="" style="height:20px;">Duplicate post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Posting Violation" style="height:20px;">Posting Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Suspicious Post" style="height:20px;">Suspicious Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Copied My Post" style="height:20px;"> Copied My Post</label>
</div>

<!-- <label>Why flag this post?</label> -->
<textarea class="form-control" name="flag_desc" placeholder="Add Comments" style="height:20px;"></textarea>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger db_btn db btn-border-radius" data-dismiss="modal">Cancel</button>
<button type="submit" name="" class="btn butn_cancel db_btn db_orangebtn btn-border-radius" style="background-color:#2D033B!important;">Submit</button>

</div>
</div>
</form>
</div>
</div>
<!--<div class="parallax titlebar" data-background="images/business.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.0" data-img-width="800" data-img-height="505" style="height: 350px;">
<div class="container">
<nav id="breadcrumbs" style="font-size:20px; color:red;margin-top:100px;">
<ul>
<li><a href="index.php?page=1">Home</a></li>
<li><?php //echo $headline;
?></li>

</ul>
</nav>
</div>
</div>-->



<!-- <div class="fullwidth-property-slider margin-bottom-65">
<a href="images/single-property-01.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
<a href="images/single-property-02.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
<a href="images/single-property-03.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
<a href="images/single-property-04.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
<a href="images/single-property-05.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
<a href="images/single-property-06.jpg" data-background-image="images/business.jpg" class="item mfp-gallery"></a>
</div> -->
<div class="container" style="margin-top:40px">
<div class="row">




<!-- Property Description -->
<div class="col-lg-8 col-md-7">
<!-- Titlebar -->
<div id="titlebar-dtl-item" class="property-titlebar margin-bottom-0">
<div class="property-title">

<h2><?php echo $headline; ?></h2>
<span class="utf-listing-address"><?php if ($business_type == 1) {
echo "Franchise";
} else {
echo "Independent Sale";
} ?></span>

</div>
<div class="like">
<?php if ($fav != false) { ?>
<a href="javascript:void(0)" class="pull-right" onclick="rtf('<?php echo $id; ?>','<?php echo $_SESSION['pid']; ?>','<?php echo $_SESSION['uid']; ?>')"; id="remtofavoritesbusiness" data-postid="<?php echo $id; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" data-uid="<?php echo $_SESSION['uid']; ?>">

<span id="removetofavouritebus" class="iconhover pull-right"><i class="fa fa-heart pull-right" style="margin-top:-80px;"></i></span>

</a>
<?php } else { ?>

<a href="javascript:void(0)" class="pull-right" onclick="atf('<?php $id; ?>','<?php echo $_SESSION['pid']; ?>','<?php echo $_SESSION['uid']; ?>')"; id="addtofavouritebusiness" data-postid="<?php echo $id; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" data-uid="<?php echo $_SESSION['uid']; ?>">
<span id="addtofavouritebus" class="iconhover pull-right"><i class="fa fa-heart-o pull-right" style="margin-top:-80px;"></i></span>

</a>

<?php } ?>
</div>

<?php
$s_pid=$_SESSION['pid'];
$resultid = $de->read_id_sess($s_pid,$id);
//print_r($resultid);die("====11==========111111");
?>

<?php
if($resultid){

//echo "Already Flag this post";

}else{
  ?>
  <p class="sel_chat pull-right" style="margin-right: -40px;margin-top:-32px;"><i class="fa fa-flag  " style="color: #035049;
  font-size: 15px;"></i> &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost">Flag this post</a><br>
<?php
}
?>
<?php
$title = "whatsapp";

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<div id="social-share" class="mt_d">
<strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
</div>






</p>
</div>

<div class="property-description">
<!-- Description -->
<div class="utf-desc-headline-item">
<h3><i class="icon-material-outline-description"></i> Business Description</h3>
</div>
<p><?php echo $start_description; ?><span id="dots">...</span><span id="more" style="word-break:break-all;"><?php echo $end_description; ?></span></p>
<?php if (strlen($description) > 100) { ?>
<button onclick="myFunction()" id="myBtn" style="margin-left: 300px;"><i class="sl sl-icon-plus"> Read more</i></button>
<?php } ?>
<script>
function myFunction() {
var dots = document.getElementById("dots");
var moreText = document.getElementById("more");
var btnText = document.getElementById("myBtn");

if (dots.style.display === "none") {
dots.style.display = "inline";
btnText.innerHTML = "<i class='sl sl-icon-plus'> Read more";
moreText.style.display = "none";
} else {
dots.style.display = "none";
btnText.innerHTML = "<i class='sl sl-icon-plus'> Read less";
moreText.style.display = "inline";
}
}
</script>

<!-- Details -->
<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i> Businesses Details</h3>
</div>
<ul class="property-features margin-top-0">
<!-- <li>Business ID: <span>HP1714</span></li> -->
<!-- <li>Price: <span>$180,000</span></li> -->

<li>Sales Revenue: <span> <?php echo $sales_revenue; ?></span></li>
<li>Cash Flow: <span><?php echo $cash_flow; ?></span></li>

<li>Business Hours: <span><?php echo $business_hours; ?></span></li>
<li>Business Operation: <span><?php echo $operation; ?></span></li>
<li>Business Days: <span><?php echo $business_days; ?></span></li>
<li>City Expansion: <span><?php echo $city_expansion; ?></span></li>
<li>Year Established: <span><?php echo $year; ?></span></li>
<li>Business Size: <span><?php echo $size; ?></span></li>



<li> Status: <span><?php if ($business_status == 1) {
echo "For Sale";
} else if ($business_status == 2) {
echo "Under Fffer";
} else {
echo "Sold";
}


?></span></li>
<li>Location: <span><?php echo $location; ?></span></li>
</ul>
<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i>Website Address</h3>
</div>
<ul class="property-features margin-top-0">
<!-- <li>Business ID: <span>HP1714</span></li> -->
<!-- <li>Price: <span>$180,000</span></li> -->
<li><span><?php echo $website_address; ?>

</span></li>
</ul>


<!-- Details -->
<div class="utf-desc-headline-item">
<h3><i class="icon-material-outline-business"></i> Additional Details</h3>
</div>
<ul class="property-features margin-top-0">
<li>Inventory / Stock value: <span><?php if ($inventory_amount != '') {
echo $inventory_amount;
} else {
echo "(0)";
} ?> - included in the asking price</span></li>
<li>Selling Reason: <span><?php echo $selling_reason; ?></span></li>
<li>Competition :<span><?php echo $competition; ?></span></li>
<li>Training Support : <span><?php echo $training_support; ?></span></li>
<li>Real State Include<span><?php if ($real_state_included == 1) {
echo "Yes";
} else {
echo "No";
} ?></span></li>
<li>Inventory Include : <span>(<?php if ($inventory_included == 1) {
echo "Per Annume if applicable ";
} else {
echo "Per sq. ft";
} ?>)</span></li>
<li>Furniture/Fixture Include : <span><?php if ($furniture_included == 1) {
  echo "Furniture ($furniture)";
} else {
  echo "Fixtures";
} ?></span></li>
<li>Sale Software : <span><?php if ($sale_software == 1) {
echo "Review listing ";
} else {
echo "Saved as draft";
} ?></span></li>
<li>Lease/Month : <span><?php echo $lease; ?></span></li>


</ul>

<!-- Features -->
<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i> Business Location</h3>
</div>

<?php echo $city . ' , ' . $state . ' , ' . $country; ?>




<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i> Business Category</h3>
</div>
<ul class="property-features checkboxes margin-top-0">
<li><?php
if ($business_category == 1) {
echo "Manufacturing";
} else if ($business_category == 2) {
echo "Hotel";
} else {
echo "Website Design";
}

?></li>



</ul>
<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i> Gallery</h3>
</div>
<ul class="property-features margin-top-0">
<li><?php
$de2 = $de->read_files($id);
if ($de2 != false) {
while ($ro = mysqli_fetch_assoc($de2)) {

$img = $ro['filename'];
//echo $img;
if ($img) {
echo "<div class='col-md-12'>
<img src='$BaseUrl/business_for_sale/uploads/$img' alt='' style='width: 100%;height: 200px;'><a href='" . $BaseUrl . '/business_for_sale/uploads/' . ($img) . "' download> Download</a>
</div>";
}
}
}

?>

</li>



</ul>

<div class="utf-desc-headline-item">
<h3><i class="sl sl-icon-briefcase"></i>Supportive Documents</h3>
</div>
<ul class="property-features margin-top-0">
<li><?php
$de3 = $de->read_support_files($id);
if ($de3 != false) {
while ($ro1 = mysqli_fetch_assoc($de3)) {

$img1 = $ro1['filename'];
//echo $img;
echo "<div class='col-md-12'>
<img src='$BaseUrl/business_for_sale/uploads/$img1' alt='' ><a href='" . $BaseUrl . '/business_for_sale/uploads/' . ($img1) . "' download> Download</a>
</div>";
}
}

?>

</li>



</ul>

<!-- Similar Listings Container -->
<div class="utf-desc-headline-item">
<h3><i class="icon-material-outline-description"></i> Similar Business</h3>
</div>

<!-- Layout Switcher -->
<div class="utf-layout-switcher hidden"><a href="#" class="list"><i class="fa fa-th-list"></i></a></div>
<div class="utf-listings-container-area list-layout">

<!-- Listing Item -->
<?php $si = $de->read_category_id_business($business_category);
if ($si != false) {
while ($si1 = mysqli_fetch_assoc($si)) {
//print_r($si1);
$fi = $de->read_files($rsi1['idspbusiness']);
$imgs = '';
if ($fi != false) {
$ro1 = mysqli_fetch_assoc($fi);

$imgs = $ro1['filename'];
}
?>
<div class="col-md-6">
<div class="utf-listing-item"> <a href="<?php echo $BaseUrl; ?>/business_for_sale/business_detail.php?postid=<?php echo $si1['idspbusiness']; ?>" class="utf-smt-listing-img-container">

<div class="utf-listing-img-content-item">
<!-- <img class="utf-user-picture" src="images/user_1.jpg" alt="user_1" /> -->
<!-- <span class="like-icon with-tip" data-tip-content="Bookmark"></span> 
<span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
<span class="video-button with-tip" data-tip-content="Video"></span>-->
</div>
<?php if ($imgs != false) { ?>
<img src="<?php echo $BaseUrl . '/business_for_sale/uploads/' . $imgs; ?>" alt="banner-add-2">
<?php } else { ?>
<img src="images/download.jpg" alt="banner-add-2">
<?php } ?>
</a>
<div class="utf-listing-content">
<div class="utf-listing-title">
<!-- <span class="utf-listing-price">$22,000/mo</span> -->
<h4><a href="<?php echo $BaseUrl; ?>/business_for_sale/business_detail.php?postid=<?php echo $si1['idspbusiness']; ?>">Hotel</a></h4>
<!-- <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> </span> -->
</div>
<!-- <ul class="listing-details">

</ul> -->
</div>
</div>
</div>
<?php }
} ?>
<span class="pull-right btn btn-primary btn-border-radius"><a href="<?php echo $BaseUrl ?>/business_for_sale/manufacturing_categories.php?page=1&catid=<?php echo $business_category ?>" style="color:white;">View All</a></span>
<!-- Listing Item / End -->

<!-- Listing Item -->

<!-- Listing Item / End -->

<!-- Listing Item -->

<!-- Listing Item / End -->

<!-- Listing Item -->

<!-- Listing Item / End -->
</div>
<!-- Similar Listings Container / End -->

<!-- Reviews -->

<div class="clearfix"></div>
<div class="margin-top-35"></div>

<!-- Add Comment -->

<div class="margin-top-15"></div>

<!-- Add Comment Form -->

</div>
</div>
<!-- Property Description / End -->

<!-- Sidebar -->
<div class="col-lg-4 col-md-5">
<div class="sidebar">
<div class="widget utf-sidebar-widget-item">
<div class="utf-detail-banner-add-section">
<?php if ($img != false) { ?>
<img src="<?php echo $BaseUrl . '/business_for_sale/uploads/' . $img; ?>" alt="banner-add-2">
<?php } else { ?>
<img src="images/download.jpg" alt="banner-add-2">
<?php } ?>
</div>
</div>

<!-- Widget -->

<!-- Widget / End -->

<!-- Widget -->

<!-- Widget / End -->

<!-- Widget -->

<!-- Widget / End -->

<!-- Widget -->
<?php
//------self product enquery form not showing---------
if (($uid != $_SESSION['uid']) && ($pid != $_SESSION['pid'])) {

?>
<div class="widget utf-sidebar-widget-item">
<div class="utf-boxed-list-headline-item">
<h3>Contact Seller</h3>
</div>
<form action="business_enquiry.php" method="post">
<fieldset>
<div class="row">
<div class="col-md-12">
<input type="hidden" name="sellerprofile_id" value="<?php echo $seller_id; ?>" />
<input type="hidden" name="postid" value="<?php echo $id; ?>" />
<input type="text" placeholder="Name *" name="name" value="" required />
</div>
<div class="col-md-12">

<input type="text" placeholder="Company Name" name="cname" value="" />
</div>
<div class="col-md-12">

<select class="select-single-item1" name="country" id="spUserCountry" required>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>'><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
</div>
<div class="col-md-12">

<span class="loadUserState">
<select class="select-single-item" name="state" id="spUserState" required>

</select>
</span>
</div>
<div class="col-md-12">
<span class="loadCity">
<select class="select-single-item" name="city" id="spUserCity" required>

</select>
</span>
</div>

<div class="col-md-12">

<input type="text" placeholder="Zipcode*" name="zipcode" value="" />
</div>
<div class="col-md-12">
<input type="email" placeholder="Email Address *" name="email" value="" required />
</div>
<div class="col-md-12">
<input type="number" placeholder="Phone Number *" name="phone" value="" required />
</div>
<div class="col-md-12">
<input type="text" placeholder="Address *" name="address" value="" required />
</div>
<div class="col-md-12">
<textarea cols="30" placeholder="Comment... *" name="comment" rows="2" required></textarea>
</div>
</div>
</fieldset>
<div class="utf-centered-button">
<input type="submit" class="button" name="submit" id="send1" value="Send Message" style="padding-top: 0px;">
</div>
<div class="clearfix"></div>
</form>
</div>
<?php } ?>
<!-- Widget / End-->

<!-- Widget -->

<!-- Widget / End-->

<!-- Widget -->

<!-- Widget / End-->

<!-- Widget -->
<div class="widget utf-sidebar-widget-item">
<div class="utf-boxed-list-headline-item">

<h3>Featured Business</h3>
</div>
<div class="utf-listing-carousel-item outer">
<!-- Item -->
<div class="item">
<div class="utf-listing-item compact">
<a href="images/download.jpg" class="utf-smt-listing-img-container">
<!-- <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div> -->
<div class="utf-listing-img-content-item">
<span class="utf-listing-compact-title-item">Recharges, Bill Payments,
Money Transfer Business</span>
</div>
<img src="images/download.jpg" alt="">
<ul class="listing-hidden-content">
<!-- <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
<li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
<li><i class="fa fa-car"></i> Garages <span>2</span></li>
<li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li> -->
</ul>
</a>
</div>
</div>
<!-- Item / End -->

<!-- Item -->
<div class="item">
<div class="utf-listing-item compact">
<a href="images/download.jpg" class="utf-smt-listing-img-container">
<!-- <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div> -->
<div class="utf-listing-img-content-item">
<span class="utf-listing-compact-title-item">Running Who GMP
Certified Pharma Unit</span>
</div>
<img src="images/download.jpg" alt="">
<ul class="listing-hidden-content">
<!-- <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
<li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
<li><i class="fa fa-car"></i> Garages <span>2</span></li>
<li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li> -->
</ul>
</a>
</div>
</div>
<!-- Item / End -->

<!-- Item -->
<div class="item">
<div class="utf-listing-item compact">
<a href="images/download.jpg" class="utf-smt-listing-img-container">
<!-- <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div> -->
<div class="utf-listing-img-content-item">
<span class="utf-listing-compact-title-item"> Recharges, Bill Payments,
Money Transfer Business</span>
</div>
<img src="images/download.jpg" alt="">
<ul class="listing-hidden-content">
<!-- <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
<li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
<li><i class="fa fa-car"></i> Garages <span>2</span></li>
<li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li> -->
</ul>
</a>
</div>
</div>
<!-- Item / End -->
</div>
</div>
<!-- Widget / End -->
</div>
</div>
<!-- Sidebar / End -->
</div>
</div>

<!-- Footer -->
<div class="margin-top-65"></div>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- Footer / End -->

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>
</div>
<!-- Wrapper / End -->

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
<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Log In
<i class="icon-feather-chevrons-right"></i></button>
<div class="utf-social-login-separator-item"><span>or</span></div>
<div class="utf-social-login-buttons-block">
<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</button>
<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</button>
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
<label for="two-step0"><span class="checkbox-icon"></span> By Registering You Confirm That You Accept <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></label>
</div>
</form>
<button class="margin-top-10 button full-width utf-button-sliding-icon ripple-effect" type="submit" form="utf-register-account-form">Register <i class="icon-feather-chevrons-right"></i></button>
<div class="utf-social-login-separator-item"><span>or</span></div>
<div class="utf-social-login-buttons-block">
<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</button>
<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</button>
<button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>
</div>
</div>
</div>
</div>
</div>
<!-- Sign In Popup / End -->

<!-- Scripts -->
<script src="scripts/jquery-3.3.1.min.js"></script>
<script src="http://codelocksolutions.in/track_site/jquerythesharepage.js"></script>
<script src="scripts/chosen.min.js"></script>
<script src="scripts/magnific-popup.min.js"></script>
<script src="scripts/owl.carousel.min.js"></script>
<script src="scripts/rangeSlider.js"></script>
<script src="scripts/sticky-kit.min.js"></script>
<script src="scripts/slick.min.js"></script>
<script src="scripts/mmenu.min.js"></script>
<script src="scripts/tooltips.min.js"></script>
<script src="scripts/masonry.min.js"></script>
<script src="scripts/custom_jquery.js"></script>

<!-- Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
<script src="scripts/infobox.min.js"></script>
<script src="scripts/markerclusterer.js"></script>
<script src="scripts/maps.js"></script>
</body>

</html>
<?php } ?>

<script>

// $(document).ready(function() {
//     $("#addtofavouritebusiness").click(function() {
//       alert("11111111111111");
//       var uid = $(this).attr("data-uid");
//       //alert(uid);
//       var pid = $(this).attr("data-pid");
//       //alert(pid);
//       var postid = $(this).attr("data-postid");
//       //alert(postid);
//       $.ajax({
//         url: "add_fav.php",
//         type: "POST",
//         data: {
//           uid: uid,
//           pid: pid,
//           postid: postid
//         },
//         cache: false,
//         success: function(html) {
//           $(".like").html('<a href="javascript:void(0)" class="pull-right" id="remtofavoritesbusiness" data-postid="'+postid+'" data-pid="'+pid+'" data-uid="'+uid+'"><span id="removetofavouritebus" class="iconhover pull-right"><i class="fa fa-heart pull-right" style="margin-top:-80px;"></i></span></a>');

//           //location.reload();
//           //activeElement.addClass("active");
//         }
//       });
//     });
//   });


//   $(document).ready(function() {
//     $("#remtofavoritesbusiness").click(function() {
//       alert("0000000000000");
//       var uid = $(this).attr("data-uid");
//       ///alert(uid);
//       var pid = $(this).attr("data-pid");
//       //alert(pid);
//       var postid = $(this).attr("data-postid");
//       //alert(postid);
//       $.ajax({
//         url: "del_fav.php",
//         type: "POST",
//         data: {
//           uid: uid,
//           pid: pid,
//           postid: postid
//         },
//         cache: false,
//         success: function(html) {
//          // location.reload();
//          $(".like").html('<a href="javascript:void(0)" class="pull-right" id="addtofavouritebusiness" data-postid="'+postid+'" data-pid="'+pid+'" data-uid="'+uid+'"><span id="addtofavouritebus" class="iconhover pull-right"><i class="fa fa-heart-o pull-right" style="margin-top:-80px;"></i></span> </a>');
//           //location.reload();
//         }
//       });
//     });
//   });

function atf(postid,pid,uid){

$.ajax({
url: "add_fav.php",
type: "POST",
data: {
uid: uid,
pid: pid,
postid: postid
},
cache: false,
success: function(html) {
$(".like").html('<a href="javascript:void(0)" onclick="rtf('+postid+','+pid+','+uid+')" class="pull-right" id="remtofavoritesbusiness" data-postid="'+postid+'" data-pid="'+pid+'" data-uid="'+uid+'"><span id="removetofavouritebus" class="iconhover pull-right"><i class="fa fa-heart pull-right" style="margin-top:-80px;"></i></span></a>');

//location.reload();
//activeElement.addClass("active");
}
});
}

function rtf(postid,pid,uid){


$.ajax({
url: "del_fav.php",
type: "POST",
data: {
uid: uid,
pid: pid,
postid: postid
},
cache: false,
success: function(html) {
// location.reload();
$(".like").html('<a href="javascript:void(0)" onclick="atf('+postid+','+pid+','+uid+')" class="pull-right" id="addtofavouritebusiness" data-postid="'+postid+'" data-pid="'+pid+'" data-uid="'+uid+'"><span id="addtofavouritebus" class="iconhover pull-right"><i class="fa fa-heart-o pull-right" style="margin-top:-80px;"></i></span> </a>');
//location.reload();
}
});
}




$("#spUserCountry").on("change", function() {
var countryId = this.value;
$.post("loadUserState.php", {
countryId: countryId
}, function(r) {
$(".loadUserState").html(r);
});
var state = 0;
$.post("loadUserCity.php", {
state: state
}, function(r) {
$(".loadCity").html(r);
});
});
</script>
