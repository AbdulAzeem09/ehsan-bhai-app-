<?php
 //error_reporting(E_ALL);
//ini_set('display_errors', 'On');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
if ($_SESSION['spPostCountry'] == '') {
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$_SESSION['spPostCountry'] = $ruser["spUserCountry"];
$_SESSION['spPostState'] = $ruser["spUserState"];
$_SESSION['spPostCity'] = $ruser["spUserCity"];
}
}
if (isset($_POST['changelc'])) {
$userCountry = $_POST['spPostCountry'];
$userState = $_POST['spUserState'];
$userCity = $_POST['spUserCity'];
$_SESSION['spPostState'] = $userState;
$_SESSION['spPostCity'] =  $userCity;
$_SESSION['spPostCountry'] =   $userCountry;
$usercountry =  $_SESSION['spPostCountry'];
$userstate = $_SESSION['spPostState'];
$usercity = $_SESSION['spPostCity'];
} else {
$usercountry = $_SESSION['spPostCountry'];
$userstate = $_SESSION['spPostState'];
$usercity = $_SESSION['spPostCity'];
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<?php include('../component/f_links.php'); ?>
</head>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercountry) && $usercountry == $row3['country_id']) {
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];
}
}
}
if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {
if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}
if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
}
?>
<?php if ($_SESSION['guet_yes'] == 'yes') { ?>
<style>
button.btn.btn_group_join.dropdown-toggle.eventiconbtn {
display: none;
}
</style>
<?php } ?>
<style>
/*------------------Edit-button-css---------------*/
.upEventBox.upcomingbox {
position: relative;
}

.upEventBox.upcomingbox .eidt-con {
position: absolute;
left: auto;
right: 9px;
margin-top: 14px;
}

.aa {
height: 100%;
width: 100%;
}

.aa1:hover {
color: #100202 !important;
opacity: 3.8 !important;
}

.aa1:hover {
color: var(--bs-btn-hover-color) !important;
background-color: aliceblue !important;
border-color: var(--bs-btn-hover-border-color) !important;
}

.carousel-control-next,
.carousel-control-prev {
width: 2% !important;
}

.upEventBox.upcomingbox .eidt-con a {
color: #fff;
}

.upEventBox.upcomingbox .eidt-con i.fa {
border: 1px solid #da1919;
background: -webkit-linear-gradient(90deg, #9c0202 0, #da1919 100%);
text-align: center;
border-radius: 6px;
padding: 4px 4px;
}

.btn:hover {
color: #100202 !important;
opacity: 0.8;
}

#profileDropDown li.active {
background-color: #c11f50 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}

.featured_box {
margin: 5px;
border: 1px solid #ccc;
border-radius: 19px !important;
height: 480px !important;
padding: 20px 5px;
background-color: #fff;
}

.img_fe_box {
height: 200px !important;
}

.dropdown-menu {
display: none;
position: absolute;
background-color: #E0E0E0 !important;
min-width: 142px;
box-shadow: 0 8px 16px 0 rgb(0 0 0 / 20%);
z-index: 1;
padding: 0;
}

.dropdown-menu>li>a {
display: block;
padding: 0px 20px;
}

.location-details {
margin-top: -20px !important;
}

.dropdown-toggle::after {
display: none;
}

.text-event {
color: var(--events);
}

.btn-event {
background-color: var(--events);
color: white;
padding: 8px;
}

h4 {
font-weight: bold;
}

label {
display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 300;
}

/**** Side Bar *****/
a {
color: var(--events);
text-decoration: none;
}

h1,
h2,
h3,
h4,
h5,
.h1,
.h2,
.h3,
.h4,
.h5 {
line-height: 1.5;
font-weight: 400;
font-family: "Poppins", Arial, sans-serif;
}

.ftco-section {
padding: 7em 0;
}

.ftco-no-pt {
padding-top: 0;
}

.ftco-no-pb {
padding-bottom: 0;
}

.heading-section {
font-size: 28px;
color: #000;
}

.heading-section small {
font-size: 18px;
}

.img {
background-size: cover;
background-repeat: no-repeat;
background-position: center center;
}

.btn-header-search {
border-left: solid #959595;
}

.wrapper {
width: 100%;
}

#leftsidebar {
min-width: 230px;
max-width: 230px;
background: var(--events);
color: #fff;
-webkit-transition: all 0.3s;
-o-transition: all 0.3s;
transition: all 0.3s;
position: relative;
z-index: 100;
}

#leftsidebar .h6 {
color: #fff;
}

#leftsidebar.active {
margin-left: -230px;
}

#leftsidebar h1 {
margin-bottom: 20px;
font-weight: 700;
font-size: 30px;
}

#leftsidebar h1 .logo {
color: #fff;
}

#leftsidebar h1 .logo span {
font-size: 14px;
color: #44bef1;
display: block;
}

#leftsidebar ul.components {
padding: 0;
}

#leftsidebar ul li {
font-size: 16px;
}

#leftsidebar ul li>ul {
margin-left: 10px;
}

#leftsidebar ul li>ul li {
font-size: 14px;
}

#leftsidebar ul li a {
padding: 10px 0;
display: block;
color: rgba(255, 255, 255, 0.6);
border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

#leftsidebar ul li a span {
color: #44bef1;
}

.p2 {
text-align: justify;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
width: 248px;
}

#leftsidebar ul li a:hover {
color: #fff;
}

#leftsidebar ul li.active>a {
background: transparent;
color: #fff;
}

@media (max-width: 991.98px) {
#leftsidebar {
margin-left: -230px;
}

#leftsidebar.active {
margin-left: 0;
}
}

#leftsidebar .custom-menu {
display: inline-block;
position: absolute;
top: 20px;
right: 0;
margin-right: -20px;
-webkit-transition: 0.3s;
-o-transition: 0.3s;
transition: 0.3s;
}

@media (prefers-reduced-motion: reduce) {
#leftsidebar .custom-menu {
-webkit-transition: none;
-o-transition: none;
transition: none;
}
}

#leftsidebar .custom-menu .btn {
width: 60px;
height: 60px;
border-radius: 50%;
position: relative;
}

#leftsidebar .custom-menu .btn i {
margin-right: -40px;
font-size: 14px;
}

#leftsidebar .custom-menu .btn.btn-primary {
background: transparent;
border-color: transparent;
}

#leftsidebar .custom-menu .btn.btn-primary:after {
z-index: -1;
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
content: "";
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
background: var(--events);
border-radius: 10px;
}

#leftsidebar .custom-menu .btn.btn-primary:hover,
#leftsidebar .custom-menu .btn.btn-primary:focus {
background: transparent !important;
border-color: transparent !important;
}

a[data-toggle="collapse"] {
position: relative;
}

@media (max-width: 991.98px) {
#leftsidebarCollapse span {
display: none !important;
}
}

#rightcontent {
width: 100%;
padding: 0;
min-height: 100vh;
-webkit-transition: all 0.3s;
-o-transition: all 0.3s;
transition: all 0.3s;
}

#expend {
display: none;
}

#expend+.expendable {
max-height: 75px;
overflow: hidden;
transition: all .3s ease;
}

#expend:checked+.expendable {
max-height: 102vh;
}

label.view {
color: #bcbcf1;
text-decoration: underline;
cursor: pointer;
}

label.view:hover {
text-decoration: none;
}
</style>
<style type="text/css">
	.modal-backdrop.fade.in{
	opacity: 0;
	z-index: 1;
}
</style>
<body class="bg_gray">
<?php include_once("../header.php"); ?>
<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">
<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Your current profile does not have access to this page. Please create or switch your current profile to either <span>"Professional Profile, Business Profile or Personal profile"</span> to access this page.</h2>
<div class="space-md"></div>
<a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
<a href="<?php echo $BaseUrl . '/events'; ?>" class="btn">Back to Home</a>
</div>
</div>
</div>
</div>
<div class="wrapper d-flex align-items-stretch">
<nav id="leftsidebar" class="active">
<form action="" method="get">
<div class="custom-menu">
<button type="button" id="leftsidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
<span class="sr-only">Toggle Menu</span>
</button>
</div>
<div class="p-4">
<h2>Filters</h2>
<h4>Price</h4>
<div class="">
<div class="form-check">
<input class="form-check-input" type="radio" name="price" id="price1" value="1" <?php
if ($_GET['price'] == 1) {
echo 'checked';
}
?>>
<label class="form-check-label" for="price1">Free</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="price" id="price2" value="2" <?php
if ($_GET['price'] == 2) {
echo 'checked';
}
?>>
<label class="form-check-label" for="flexRadioDefault2">Paid</label>
</div>
</div>
<hr>
<h4>Dates</h4>
<div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates1" value="1" <?php if ($_GET['dates'] == 1) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates1">Today</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates2" value="2" <?php if ($_GET['dates'] == 2) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates2">Tomorrow</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates3" value="3" <?php if ($_GET['dates'] == 3) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates3">This Week</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates4" value="4" <?php if ($_GET['dates'] == 4) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates4">Next Week</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates5" value="5" <?php if ($_GET['dates'] == 5) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates5">This Month</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="dates" id="dates6" value="6" <?php if ($_GET['dates'] == 6) {
echo 'checked';
} ?>>
<label class="form-check-label" for="dates6">Next Month</label>
</div>
</div>
<hr>
<h4>Category</h4>
<input type="checkbox" id="expend" />
<div class="expendable">
<?php $m = new _eventCategory;
$catid = 9;
$result = $m->readAll($catid);
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) {
?>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $rows["speventTitle"]; ?>" id="category<?php echo $rows["idspevent"]; ?>" <?php if (isset($_GET['category'])) {                                                                                                                                                                                                            echo (in_array($rows["speventTitle"], $_GET['category'])) ? "checked" : "";
} ?>>
<label class="form-check-label" for="category<?php echo $rows["idspevent"] ?>"><?php echo $rows["speventTitle"]; ?></label>
</div>
<?php }
}  ?>
</div>
<label class="view float-end text-white" for="expend"><i class="fa fa-arrow-down"></i></label>
</div>
<hr>
<div class="d-flex justify-content-evenly">
<input type="submit" name="filter_submit" class="btn btn-light" value="Filter">
<a href="<?php echo $BaseUrl . '/events'; ?>" class="btn btn-outline-light text-white">Reset</a>
</div>
</form>
</nav>
<!-- Page Content  -->
<div id="rightcontent" class="p-4 p-md-5 pt-5">
<section class="main_box no-padding">
<div class="container eventExplrthefun explorecontainer shadow">
<div class="row ">
<div class="col-sm-12">
<div class="topBoxEvent text-right">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) { ?>
<a href="<?php echo $BaseUrl . '/events/dashboard/booking.php'; ?>" class="btn butn_cancel eventdashboard btn-border-radius"></i> My Bookings</a>
<?php  } else { ?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_cancel eventdashboard btn-border-radius">My Bookings</a>
<?php
}
}
?>
<?php
if (($_SESSION['ptid'] == 3) || ($_SESSION['ptid'] == 1) || ($_SESSION['ptid'] == 4) || ($_SESSION['ptid'] == 6)) {
$u = new _spuser;
$p_result = $u->isverify($_SESSION['uid']);
if (($_SESSION['ptid'] == 3) || ($_SESSION['ptid'] == 1) || ($_SESSION['ptid'] == 4)) {
?>
<a href="<?php echo $BaseUrl . '/post-ad/events/?post' ?>" class="btn butn_save submitevent btn-border-radius ">Submit an event</a>
<?php
} else {
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent btn-border-radius">Submit an event</a> <?php
}
?>
<a href="<?php echo $BaseUrl . '/events/dashboard/'; ?>" class="btn eventdashboard btn-border-radius"><i class="fa fa-dashboard btn-border-radius"></i> Dashboard</a>
<?php
} else { ?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent btn-border-radius">Submit an event</a> <?php
}
}
?>
</div>
</div>
</div>
<div class="row justify-content-between">
<div class="col-md-6">
<h1>Explore Nearest <span>Events</span></h1>
</div>
<div class="col-md-6 mt-5">
<div class="location-details float-end">
<p>
<?php
if (!empty($currentcountry)) {
echo $currentcountry;
}
if (!empty($currentstate)) {
echo ', ' . $currentstate;
}
if (!empty($currentcity)) {
echo ', ' . $currentcity;
}
?></p>
<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
</div>
</div>
</div>
</div>
</section>
<?php
$p  = new _spevent;
$country = $_SESSION['spPostCountry'];
$state = $_SESSION['spPostState'];
$city = $_SESSION['spPostCity'];
if (($city != "Select City") && ($state != "Select State") && ($city != "")) {
      $res = $p->homepage_events_top_feature($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
} else if (($state > 0) && ($state != "Select State")) {
      $res = $p->homepage_events_top1_feature($_SESSION['spPostCountry'], $_SESSION['spPostState']);
} else if ($_SESSION['spPostCountry']) {
      $res = $p->homepage_events_top2_feature($_SESSION['spPostCountry']);
} 
if ($res != false) {
?>
<section>
<div class="container">
<div class="row">
<div class="heading03">
<h3>FEATURE EVENTS 
<span class="pull-right seemore">
<a class="pull-right" href="<?php echo $BaseUrl . '/events/feature_event.php?page=1'; ?>">See More</a>
</span>
</h3>
</div>
<div class="carousel carousel-showmanymoveone c_four slide" style="padding:25px!important;" id="itemslider_four" data-bs-theme="dark" data-interval="3000">
<div class="carousel-inner">
<?php
$start = 0;
$limit = 2;
$count = 1;
$i = 0;
$pp = 0;
$p = new _spevent;
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$country = $_SESSION['spPostCountry'];
$state = $_SESSION['spPostState'];
$city = $_SESSION['spPostCity'];
if (($city != "Select City") && ($state != "Select State") && ($city != "")) {
      $res = $p->homepage_events_top_feature($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
} else if (($state > 0) && ($state != "Select State")) {
      $res = $p->homepage_events_top1_feature($_SESSION['spPostCountry'], $_SESSION['spPostState']);
} else if ($_SESSION['spPostCountry']) {
      $res = $p->homepage_events_top2_feature($_SESSION['spPostCountry']);
}
$active = 0;
$wholesaleRecordCount = 0;
if ($res != false) {
$wholesaleRecordCount = mysqli_num_rows($res);
while ($rowsw = mysqli_fetch_assoc($res)) {
// echo '<pre>';
//   print_r($rowsw);
if ($rowsw['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rowsw['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$gid = $rowsw['groupid'];
$venu = $rowsw['spPostingEventVenue'];
$startDate = $rowsw['spPostingStartDate'];
$startTime = $rowsw['spPostingStartTime'];
$endTime = $rowsw['spPostingEndTime'];
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
// $idposting = $rowsw['idspPostings'];
// $flagcmd = $p->flagcount(1, $idposting);
// $flagnums = $flagcmd->num_rows;
// if ($flagnums == '9') {
// $updatestatus = $p->productstatus($idposting);
// }
?>
<div class="carousel-item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php if ($account_status != 1) { ?>
<div class="col-xs-5ths sha">
<div class="featured_box shadow">
<div class="img_fe_box 11">
<a href="<?php echo $BaseUrl . '/events/event-detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>">
<?php
$pic = new _eventpic;
$prictype1 = new _spevent_type_price;
$resultdata = $prictype1->read1($_GET["ptid"]);
$res2 = $pic->readFeature($rowsw['idspPostings']);
if ($res2 != false) {
if ($res2->num_rows > 0) {
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive'>";
}
} else {
$res2 = $pic->read($rowsw['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
} else {
$res2 = $pic->read($rowsw['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src=' " . ($pic2) . "'>";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
?>
</a>
</div>
<div class="m-3">
<div class="d-flex flex-column fs-5">
<?php if (!empty($startDate)) {
echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
} else {
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<span class="fs-5 fw-bold float-right text-event"><?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?></span>
<span class=" fs-5 float-right"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 6) {
if ($gid > 0) {
//echo '++++'; 
?>
<a class="fs-2 text-event" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $rowsw['idspPostings'] . '&groupid=' . $gid . '&groupname=' . $spGroupName; ?>" class="eventcapitalize"><?php echo $rowsw['spPostingTitle']; ?></a>
<?php } else {
//echo '==='; 
?>
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $rowsw['idspPostings']; ?>" class="eventcapitalize"><?php echo $rowsw['spPostingTitle']; ?></a>
<?php }
} else {
echo '100'; ?>
<a class="text-event fs-3 fw-bold" href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize"><?php echo $rowsw['spPostingTitle']; ?></a>
<?php } ?>
</div>
<div class="">
<p class="text-justify p2">
<?php
if (strlen($rowsw['specification']) < 50) {
// echo substr($rowsw['specification'],30).'....';
echo $rowsw['specification'];
} else {
//echo substr($rowsw['specification'],15).'....';
echo $rowsw['specification'];
} ?>
</p>
</div>
<div class="d-flex">
<p>
<?php if ($rowsw['event_payment_type'] == 1) {
?>
<p class="text-success">Free</p>
<?php
} else {
$prictype1 = new _spevent_type_price;
$resultdata1 = $prictype1->read1($rowsw['idspPostings']);
$prictype = new _spevent_type_price;
$resultdata = $prictype->read($rowsw['idspPostings']);
$sum = 0;
if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
//print_r($pricedata);
//echo $pricedata['event_price'];
if ($pricedata['event_price'] == 0) {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $rowsw['default_currency'] . ' 0'; ?></p>
<?php
} else {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $rowsw['default_currency'] . ' ' . number_format((float)$pricedata['event_price'], 2, '.', ''); ?></p>
<?php
}
//$sum = $sum + $pricedata['event_limit'];
}
}
}
?>
</p>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$title = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($rowsw['idspPostings'], $_SESSION['pid']);
if ($result != false) {
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];
if ($area == 2) {
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
} else if ($area == 1) {
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
} else if ($area == 0) {
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}
$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($rowsw['idspPostings'], 2);
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}
$resulti2 = $ie->chekGoing($rowsw['idspPostings'], 1);
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}
$resulti3 = $ie->chekGoing($rowsw['idspPostings'], 0);
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}
?>
</div>
</div>
<div class="ie_<?php echo $rowsw['idspPostings']; ?>">

</div>
<div class="footEventBox footupcoming m-3">
      <p>
            <span class="date bg-light text-event"><i class="fa fa-calendar"></i> 
            <?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?> , Starts At </span><span><?php echo date("h:i A", $dtstrtTime); ?></span>
      </p>
</div>
</div>
</div>
<?php } ?>
</div>
<?php
$active++;
}
} else {
echo "<h4 class='text-center'>No Feature Events</h4>";
}
?>
</div>
<?php //if ($resw != false) { 
?>
<button class="carousel-control-prev" type="button" data-bs-target="#itemslider_four" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_four" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
</div>
</div>
</div>
</section>
<?php } ?>
<section class="UpcomingSec">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-sm-12">
<?php
$ecg = new _eventCategoryGroups;
$ecgresult = $ecg->readAll();
if ($ecgresult) {
while ($esgrows = mysqli_fetch_assoc($ecgresult)) {
?>
<div class="heading03">
<h3 class="text-uppercase">Events Happening Near You</h3>
</div>
</div>
<div class="row">
<?php
if (isset($_GET['category'])) {
$str = "'" . implode("','", $_GET['category']) . "'";
}
$totalcatid = explode(",", $esgrows['event_category_ids']);
if (count($totalcatid) > 0) {
?>
<?php
$start = 0;
$limit = 2;
$count = 1;
$i = 0;
$pp = 0;
$p      = new _spevent;
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$country = $_SESSION['spPostCountry'];
$state = $_SESSION['spPostState'];
$city = $_SESSION['spPostCity'];
if (isset($_GET['filter_submit'])) {
$where = "t.spPostingVisibility = -1 ";
if (isset($_GET['dates'])) {
if ($_GET['dates'] == 1) {
$date = date('Y-m-d');
$where .= 'and t.spPostingStartDate  ="' . $date . '"';
} elseif ($_GET['dates'] == 2) {
$date = date('Y-m-d', strtotime("+1 day"));
$where .= 'and t.spPostingStartDate="' . $date . '"';
} elseif ($_GET['dates'] == 3) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+7 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} elseif ($_GET['dates'] == 4) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+14 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} elseif ($_GET['dates'] == 5) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+30 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} else {
$date = date('Y-m-d', strtotime("+30 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
}
}
if (isset($_GET['price'])) {
$where .= ' and t.event_payment_type =' . $_GET['price'];
}
if (isset($_GET['category'])) {
$where .= "and t.eventcategory IN ($str)";
}
$res = $p->get_filter_event($where, $country, $state, $city);

} else {
      if (($city != "Select City") && ($state != "Select State") && ($city != "")) {
            $res = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
      } else if (($state > 0) && ($state != "Select State")) {
            $res = $p->homepage_events_top1($_SESSION['spPostCountry'], $_SESSION['spPostState']);
      } else if ($_SESSION['spPostCountry']) {
            $res= $p->homepage_events_top2($_SESSION['spPostCountry']);
      }
}

$data_count= $res->num_rows;

if ($account_status != 1) {
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {



      //die("==========");
if ($row['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$gid = $row['groupid'];
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
if ($pp == 0) {
?>
<?php }
?>
<?php if ($account_status != 1) { ?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4  || $_SESSION['ptid'] == 6) { ?>
<?php $sg = new _spgroup;
$result = $sg->readdatabyspid($gid);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$spGroupName = $r['spGroupName'];
} ?>
<?php if ($gid > 0) { ?>
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $gid . '&groupname=' . $spGroupName; ?>" class=""></a>
<?php } else { ?>
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class=""></a>
<?php }
} else { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="">
<?php } ?>
<?php
$pic = new _eventpic;
$prictype1 = new _spevent_type_price;
$resultdata = $prictype1->read1($_GET["ptid"]);
$res2 = $pic->readFeature($row['idspPostings']);
?>

<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class="">
<?php
if ($res2 != false) {
if ($res2->num_rows > 0) {
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
?>
</a>
<?php
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src=' " . ($pic2) . "'>";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
?>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<?php if (!empty($startDate)) {
echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
} else {
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<span class="fs-5 fw-bold float-right text-event"><?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?></span>
<span class=" fs-5 float-right"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 6) {
if ($gid > 0) { ?>
<a class="fs-2 text-event" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $gid . '&groupname=' . $spGroupName; ?>" class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php } else { ?>
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php }
} else { ?>
<a class="text-event fs-3 fw-bold" href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php } ?>
</div>
<div class="">
<p class="text-justify p2">
<?php
if (strlen($row['specification']) < 50) {
echo $row['specification'];
} else {
echo $row['specification'];
} ?>
</p>
</div>
<div class="d-flex">
<p>
<?php if ($row['event_payment_type'] == 1) {
?>
<p class="text-success">Free</p>
<?php
} else {
$prictype1 = new _spevent_type_price;
$resultdata1 = $prictype1->read1($row['idspPostings']);
$prictype = new _spevent_type_price;
$resultdata = $prictype->read($row['idspPostings']);
$sum = 0;
if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
if ($pricedata['event_price'] == 0) {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $row['default_currency'] . ' 0'; ?></p>
<?php
} else {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $row['default_currency'] . ' ' . number_format((float)$pricedata['event_price'], 2, '.', ''); ?></p>
<?php
}
}
}
}
?>
</p>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$title = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
if ($result != false) {
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];
if ($area == 2) {
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
} else if ($area == 1) {
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
} else if ($area == 0) {
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}
$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($row['idspPostings'], 2);
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}
$resulti2 = $ie->chekGoing($row['idspPostings'], 1);
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}
$resulti3 = $ie->chekGoing($row['idspPostings'], 0);
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}
?>
</div>
<div class="ie_<?php echo $row['idspPostings']; ?>">
</div>
</div>
<div class="card-footer">
      <p>
            <span class="date text-event"><i class="fa fa-calendar"></i>   <?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?> <b> ,Starts At </b></span><span class="date"> <?php echo date("h:i A", $dtstrtTime); ?> </span>
      </p>
</div>
</div>
</div>
<?php }
$pp++;
if ($pp == 3) {
$pp = 0;
}
$i++;
}
}
} else {
echo "<h3 class='text-center'>No Record Found!</h3>";
}
} ?>
</div>
<?php }
} ?>
</div>
</div>
</section>
<section> 
<div class="row mt-5">
<div class="col-sm-12 text-center">
<div class="viewAllEvent">
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
$p      = new _spevent;

$res    = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
if ($data_count > 8) {  ?>
<a href="<?php echo $BaseUrl . '/events/all-event.php?page=1'; ?>" class="btn btn_event viewallbtn">View All</a>
<?php
} else { ?> <h2><?php
echo "There are no upcoming Events in ";
if (!empty($currentcountry)) {
echo $currentcountry;
}
if (!empty($currentstate)) {
echo ', ' . $currentstate;
}
if (!empty($currentcity)) {
echo ', ' . $currentcity;
}
?></h2><?php
}
} else {
$p      = new _spevent;

$res    = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
if ($res != false) {  ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn btn_event viewallbtn">View All</a>
<?php
} else { ?> <h2><?php
echo "There are no upcoming Events in ";
if (!empty($currentcountry)) {
echo $currentcountry;
}
if (!empty($currentstate)) {
echo ', ' . $currentstate;
}
if (!empty($currentcity)) {
echo ', ' . $currentcity;
}
?></h2><?php
}
}
}
?>
</div>
</div>
</div>
</section>


<section class="UpcomingSec">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-sm-12">
<?php
$ecg = new _eventCategoryGroups;
$ecgresult = $ecg->readAll();
if ($ecgresult) {
while ($esgrows = mysqli_fetch_assoc($ecgresult)) {
?>
<div class="heading03">
<h3 class="text-uppercase">Top Events</h3>
</div>
</div>
<div class="row">
<?php
if ($_GET['category']) {
$str = "'" . implode("','", $_GET['category']) . "'";
}
$totalcatid = explode(",", $esgrows['event_category_ids']);
if (count($totalcatid) > 0) {
?>
<?php
$start = 0;
$limit = 2;
$count = 1;
$i = 0;
$pp = 0;
$p      = new _spevent;
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$country = $_SESSION['spPostCountry'];
$state = $_SESSION['spPostState'];
$city = $_SESSION['spPostCity'];
if (isset($_GET['filter_submit'])) {
$where = "t.spPostingVisibility = -1 ";
if (isset($_GET['dates'])) {
if ($_GET['dates'] == 1) {
$date = date('Y-m-d');
$where .= 'and t.spPostingStartDate  ="' . $date . '"';
} elseif ($_GET['dates'] == 2) {
$date = date('Y-m-d', strtotime("+1 day"));
$where .= 'and t.spPostingStartDate="' . $date . '"';
} elseif ($_GET['dates'] == 3) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+7 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} elseif ($_GET['dates'] == 4) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+14 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} elseif ($_GET['dates'] == 5) {
$curr = date('Y-m-d');
$date = date('Y-m-d', strtotime("+30 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
} else {
$date = date('Y-m-d', strtotime("+30 day"));
$where .= 'and t.spPostingStartDate>="' . $curr . '" and t.spPostingStartDate<="' . $date . '"';
}
}
if (isset($_GET['price'])) {
$where .= ' and t.event_payment_type =' . $_GET['price'];
}
if (isset($_GET['category'])) {
$where .= "and t.eventcategory IN ($str)";
}
$res = $p->get_filter_event($where, $country, $state, $city);
} else {
      if (($city != "Select City") && ($state != "Select State") && ($city != "")) {
            $res = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
      } else if (($state > 0) && ($state != "Select State")) {
            $res = $p->homepage_events_top1($_SESSION['spPostCountry'], $_SESSION['spPostState']);
      } else if ($_SESSION['spPostCountry']) {
            $res = $p->homepage_events_top2($_SESSION['spPostCountry']);
      }
}
if ($account_status != 1) {
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {


if ($row['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$gid = $row['groupid'];
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
if ($pp == 0) {
?>
<?php }

//die("gfhgfuytfvytg");

?>
<?php if ($account_status != 1) { 
      //die("pppppppppppppppppppppppp");?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 111111">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4  || $_SESSION['ptid'] == 6) { ?>
<?php $sg = new _spgroup;
$result = $sg->readdatabyspid($gid);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$spGroupName = $r['spGroupName'];
} ?>
<?php if ($gid > 0) { ?>
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $gid . '&groupname=' . $spGroupName; ?>" class=""></a>
<?php } else { ?>
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class=""></a>
<?php }
} else { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="">
<?php } ?>
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class="">
<?php
$pic = new _eventpic;
$prictype1 = new _spevent_type_price;
$resultdata = $prictype1->read1($_GET["ptid"]);
$res2 = $pic->readFeature($row['idspPostings']);
if ($res2 != false) {
if ($res2->num_rows > 0) {
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src='" . $pic2 . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
?>
</a>
<?php
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive aa' src=' " . ($pic2) . "'>";
} else {
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive aa'>";
}
}
?>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<?php if (!empty($startDate)) {
echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
} else {
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<span class="fs-5 fw-bold float-right text-event"><?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?></span>
<span class=" fs-5 float-right"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 6) {
if ($gid > 0) { ?>
<a class="fs-2 text-event" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings'] . '&groupid=' . $gid . '&groupname=' . $spGroupName; ?>" class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php } else { ?>
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>" class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php }
} else { ?>
<a class="text-event fs-3 fw-bold" href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize"><?php echo $row['spPostingTitle']; ?></a>
<?php } ?>
</div>
<div class="">
<p class="text-justify p2">
<?php
if (strlen($row['specification']) < 50) {
echo $row['specification'];
} else {
echo $row['specification'];
} ?>
</p>
</div>
<div class="d-flex">
<p>
<?php if ($row['event_payment_type'] == 1) {
?>
<p class="text-success">Free</p>
<?php
} else {
$prictype1 = new _spevent_type_price;
$resultdata1 = $prictype1->read1($row['idspPostings']);
$prictype = new _spevent_type_price;
$resultdata = $prictype->read($row['idspPostings']);
$sum = 0;
if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
if ($pricedata['event_price'] == 0) {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $row['default_currency'] . ' 0'; ?></p>
<?php
} else {
?>
<p style="color:green;float:right"><?php echo 'Starts At ' . $row['default_currency'] . ' ' . number_format((float)$pricedata['event_price'], 2, '.', ''); ?></p>
<?php
}
}
}
}
?>
</p>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$title = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
if ($result != false) {
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];
if ($area == 2) {
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
} else if ($area == 1) {
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
} else if ($area == 0) {
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}
$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($row['idspPostings'], 2);
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}
$resulti2 = $ie->chekGoing($row['idspPostings'], 1);
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}
$resulti3 = $ie->chekGoing($row['idspPostings'], 0);
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}
?>
</div>
<div class="ie_<?php echo $row['idspPostings']; ?>">

</div>
</div>
<div class="card-footer">
      <p>
            <span class="date text-event"><i class="fa fa-calendar"></i> <?php echo $month . ' ' . $day; ?><?php echo ' ' . $weak; ?> <b> ,Starts At </b> </span><span><?php echo date("h:i A", $dtstrtTime); ?></span>
      </p>
</div>
</div>
</div>
<?php }
$pp++;
if ($pp == 3) {
$pp = 0;
}
$i++;
}
}
} else {
echo "<h3 class='text-center'>No Record Found!</h3>";
}
} ?>
</div>
<?php }
} ?>
</div>
</div>
</section>
<section>
<div class="row mt-5">
<div class="col-sm-12 text-center">
<div class="viewAllEvent">
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<?php if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
$p      = new _spevent;
$count= $res->num_rows;
$res    = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
if ($count > 8) {  ?>
<a href="<?php echo $BaseUrl . '/events/all-event.php?page=1'; ?>" class="btn btn_event viewallbtn">View All5</a>
<?php
} else { ?> <h2><?php
echo "There are no upcoming Events in ";
if (!empty($currentcountry)) {
echo $currentcountry;
}
if (!empty($currentstate)) {
echo ', ' . $currentstate;
}
if (!empty($currentcity)) {
echo ', ' . $currentcity;
}
?></h2><?php
}
} else {
$p      = new _spevent;

$res    = $p->homepage_events_top($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity']);
if ($res != false) {  ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn btn_event viewallbtn">View All6</a>
<?php
} else { ?> <h2><?php
echo "There are no upcoming Events in ";
if (!empty($currentcountry)) {
echo $currentcountry;
}
if (!empty($currentstate)) {
echo ', ' . $currentstate;
}
if (!empty($currentcity)) {
echo ', ' . $currentcity;
}
?></h2><?php
}
}
}
?>
</div>
</div>
</div>
</section>



<section class="UpcomingSec">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="titleEvent text-center">
<h2>Event <span>Schedule</span></h2>
<p>Your local upcoming events</p>
</div>
</div>
</div>
<div class="row bg_white no-margin schedulecontainer">
<div class="col-sm-12 no-padding">
<div class="">
<div class="board">
<div class="board-inner">
<ul class="nav nav-tabs" id="myTab">
<?php
$arrWeek = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
?>
<li class="active">
<a href="#sun" data-toggle="tab" title="">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today = new DateTime(date('M-d-Y'));
echo $today->format('l') . PHP_EOL;
?>
</p>
<p><?php echo date('M-d-Y'); ?></p>
</div>
</a>
</li>
<li>
<a href="#mon" data-toggle="tab" title="">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$day1 = strtotime("+1 day", strtotime(date('M-d-Y')));
$today1 = new DateTime(date("M-d-Y", $day1));
echo $today1->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+1 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li>
<a href="#tue" data-toggle="tab" title="">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today2 = new DateTime(date('M-d-Y'));
$today2->modify('+2 day');
echo $today2->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+2 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li>
<a href="#wed" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today3 = new DateTime(date('M-d-Y'));
$today3->modify('+3 day');
echo $today3->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+3 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li>
<a href="#thu" data-toggle="tab" title="">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today4 = new DateTime(date('M-d-Y'));
$today4->modify('+4 day');
echo $today4->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+4 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#fri" data-toggle="tab" title="">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today5 = new DateTime(date('M-d-Y'));
$today5->modify('+5 day');
echo $today5->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+5 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sat" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+6 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+6 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sun1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+7 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+7 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#mon1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+8 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+8 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#tue1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+9 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+9 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#wed1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+10 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+10 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
</li>
<li style="padding: 10px 8px;">
<a href="#thu1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+11 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+11 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
</li>
<li style="padding: 10px 8px;">
<a href="#fri1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+12 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+12 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
</li>
<li style="padding: 10px 8px;">
<a href="#sat1" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+13 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+13 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sun2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+14 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+14 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#mon2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+15 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+15 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#tue2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+16 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+16 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#wed2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+17 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+17 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#thu2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+18 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+18 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#fri2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+19 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+19 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sat2" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+20 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+20 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sun3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+21 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+21 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#mon3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+22 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+22 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#tue3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+23 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+23 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#wed3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+24 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+24 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#thu3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+25 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+25 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#fri3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+26 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+26 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
<li style="padding: 10px 8px;">
<a href="#sat3" data-toggle="tab">
<span class="round-tabs one">
<i class="fa fa-calendar"></i>
</span>
<div class="eventTab">
<p>
<?php
$today6 = new DateTime(date('M-d-Y'));
$today6->modify('+27 day');
echo $today6->format('l') . PHP_EOL;
?>
</p>
<p>
<?php
$date1 = strtotime("+27 day", strtotime(date('M-d-Y')));
echo date("M-d-Y", $date1);
?>
</p>
</div>
</a>
</li>
</ul>
</div>
<div class="tab-content">
<div class="tab-pane fade in active" id="sun">
<?php
$showtoday = date('Y-m-d');
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="mon">
<?php
$day1 = strtotime("+1 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day1);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="tue">
<?php
$day2 = strtotime("+2 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day2);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="wed">
<?php
$day3 = strtotime("+3 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day3);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="thu">
<?php
$day4 = strtotime("+4 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day4);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="fri">
<?php
$day5 = strtotime("+5 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day5);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sat">
<?php
$day6 = strtotime("+6 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day6);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sun1">
<?php
$day = strtotime("+7 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="mon1">
<?php
$day1 = strtotime("+8 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day1);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="tue1">
<?php
$day2 = strtotime("+9 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day2);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="wed1">
<?php
$day3 = strtotime("+10 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day3);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="thu1">
<?php
$day4 = strtotime("+11 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day4);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="fri1">
<?php
$day5 = strtotime("+12 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day5);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sat1">
<?php
$day6 = strtotime("+13 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day6);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sun2">
<?php
$day = strtotime("+14 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="mon2">
<?php
$day1 = strtotime("+15 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day1);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="tue2">
<?php
$day2 = strtotime("+15 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day2);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="wed2">
<?php
$day3 = strtotime("+16 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day3);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="thu2">
<?php
$day4 = strtotime("+17 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day4);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="fri2">
<?php
$day5 = strtotime("+18 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day5);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sat2">
<?php
$day6 = strtotime("+19 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day6);
include('event-show.php');
?>
</div>
<div class="tab-pane fade " id="sun3">
<?php
$day = strtotime("+20 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="mon3">
<?php
$day1 = strtotime("+21 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day1);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="tue3">
<?php
$day2 = strtotime("+22 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day2);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="wed3">
<?php
$day3 = strtotime("+23 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day3);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="thu3">
<?php
$day4 = strtotime("+24 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day4);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="fri3">
<?php
$day5 = strtotime("+25 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day5);
include('event-show.php');
?>
</div>
<div class="tab-pane fade" id="sat3">
<?php
$day6 = strtotime("+26 day", strtotime(date('Y-m-d')));
$showtoday = date("Y-m-d", $day6);
include('event-show.php');
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">

<h4 style="margin-right:67px;" class="modal-title">Change Current Location </h4>
<button type="button" class="close" data-dismiss="modal" style="margin-right: -130px;">&times;</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control " name="spPostCountry" id="spUserCountry">
<option value="">Select Country </option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" style="float:left;" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spUserState">
<option>Select State</option>
<?php
if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($_SESSION['spPostCountry']);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" style="float: left;" class="">City</label>
<select class="form-control" name="spUserCity">
<option>Select City</option>
<?php
$co = new _city;
$result3 = $co->readCity($_SESSION['spPostState']);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
} ?>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius" name="changelc">Change</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script type="text/javascript">
$('#itemslider_four').carousel({
interval: false
});
var wholesaleProductCount = <?php echo json_encode($wholesaleRecordCount); ?>;
if (wholesaleProductCount != 0) {
$('.c_four .item').each(function() {
var itemToClone = $(this);
for (var i = 1; i < wholesaleProductCount; i++) {
itemToClone = itemToClone.next();
if (!itemToClone.length) {
itemToClone = $(this).siblings(':first');
}
itemToClone.children(':first-child').clone()
.addClass("cloneditem-" + (i))
.appendTo($(this));
}
});
}
// $('#itemslider_one<?php echo $esgrows["idspeventgr"]; ?>').carousel({
// interval: false
// });
var wholesaleProductCount = <?php echo json_encode($wholesaleRecordCount); ?>;
if (wholesaleProductCount != 0) {
$('.c_four .item').each(function() {
var itemToClone = $(this);
for (var i = 1; i < wholesaleProductCount; i++) {
itemToClone = itemToClone.next();
if (!itemToClone.length) {
itemToClone = $(this).siblings(':first');
}
itemToClone.children(':first-child').clone()
.addClass("cloneditem-" + (i))
.appendTo($(this));
}
});
}
let items = document.querySelectorAll('.carousel .carousel-item')
items.forEach((el) => {
const minPerSlide = 4
let next = el.nextElementSibling
for (var i = 1; i < minPerSlide; i++) {
if (!next) {
// wrap carousel by using first child
next = items[0]
}
let cloneChild = next.cloneNode(true)
el.appendChild(cloneChild.children[0])
next = next.nextElementSibling
}
})
</script>
<script>
(function($) {
"use strict";
var fullHeight = function() {
$(".js-fullheight").css("height", $(window).height());
$(window).resize(function() {
$(".js-fullheight").css("height", $(window).height());
});
};
fullHeight();
$("#leftsidebarCollapse").on("click", function() {
$("#leftsidebar").toggleClass("active");
});
})(jQuery);
</script>
</body>
</body>

</html>
<?php
}
?>