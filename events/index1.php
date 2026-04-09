<?php

/* error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../authentication/check.php");
}
else {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
$result2 = $pr->readStateName($countryId);
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
$result3 = $co->readCityName($stateId);
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
<?php
if(!empty($_POST['type'] === "intrestedData")) {
$p = new _spevent;

$data = $_POST['data'];
print_r($data);
$user_id = $_POST['user_id'];
$id = $_POST['id'];

$final['post_id'] = $id;
$final['user_id'] = $user_id;

$data = trim($data,' ');

$find = 0;

$resultIntrested = $p->read_intrested_data($id,$user_id);

if($resultIntrested){
if ($rows = mysqli_fetch_assoc($resultIntrested)) {
print_r($rows);
$find = $rows['id'];
}
}


if($data == "Interested"){
$final['interested'] = "1";
}else{
$final['interested'] = "0";
}

if($data == "Going"){
$final['going'] = "1";
}else{
$final['going'] = "0";
}

if($data == "May Be"){
$final['may_be'] = "1";
}else{
$final['may_be'] = "0";
}

if($find ==  0){
$dataId = $p->create_intrest($final);
}else{
$dataId = $p->update_intrested_data($final,$id,$user_id);
}

echo $dataId->id;

}?>
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

.tile {
display: -webkit-inline-box;
display: -ms-inline-flexbox;
display: inline-flex;
-webkit-box-orient: horizontal;
-webkit-box-direction: normal;
-ms-flex-direction: row;
flex-direction: row;
height: 54px;
width: 100%;
border: 1px solid #eeedf2;
border-radius: 2px;
box-shadow: 2px 1px 5px  gray;
}
.tile--icon, .tile--name {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}
.tile--name {
padding-left: 16px;
background: #f8f7fa;
-webkit-box-flex: 1;
-ms-flex-positive: 1;
flex-grow: 1;
}
.event-type-filed{
background: none;
color: #39364f;
color: var(--eds-ui-800,#39364f);
font-size: 16px;
line-height: 23px;
min-height: 23px;
white-space: nowrap;
outline: none;
padding: 12px;
-webkit-transition: padding .16s cubic-bezier(.4,0,.3,1),color .4s cubic-bezier(.4,0,.3,1);
transition: padding .16s cubic-bezier(.4,0,.3,1),color .4s cubic-bezier(.4,0,.3,1);
}
.nav-link.event-nav:hover, .nav-link.event-nav:focus{
border-bottom: 2px solid #428bca !important;
color:#428bca;
}
.nav-link.event-nav.active{
border-bottom: 2px solid #c11f50;
}
.nav-link.event-nav{
padding:5px;
}
.eds-dropdown li.eds-dropdown_title:hover{
color: #1e0a3c;
color: var(--eds-ui-900,#1e0a3c);
background-color: #f8f7fa;
/* background-color: var(--eds-ui-100,#f8f7fa); */
text-decoration: none;
outline: none;
}

.eds-dropdown{
background-color: #fff;
/* background-color: var(--eds-background,#fff); */
-webkit-box-shadow: 0 1px 17px 0 rgba(40,44,53,.1), 0 2px 4px 0 rgba(40,44,53,.1);
box-shadow: 0 1px 17px 0 rgba(40,44,53,.1), 0 2px 4px 0 rgba(40,44,53,.1);
-webkit-box-sizing: border-box;
box-sizing: border-box;
position: absolute;
z-index: 1000;
text-align: left;
margin-top: -20px;
margin-left: 190px;
min-width: 230px;
}
.eds-dropdown_title{
color: #c91f74;
font-size: 25px;
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
<a href="<?php echo $BaseUrl . '/events/dashboard/booking.php'; ?>" class="btn butn_cancel eventdashboard"></i> My Bookings</a>
<?php  } else { ?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_cancel eventdashboard">My Bookings</a>
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
<a href="<?php echo $BaseUrl . '/post-ad/events/?post' ?>" class="btn butn_save submitevent">Submit an event</a>
<?php
} else {
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
}
?>
<a href="<?php echo $BaseUrl . '/events/dashboard/'; ?>" class="btn eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
<?php
} else { ?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
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

<section>
<div class="container">
<div class="row">
<div >
<div class="col-12 d-flex" style="align-items: center;">
<label>
<h2>
<b>Popular in</b>
<i class="fa-solid fa-chevron-down"></i>
</h2>
</label>
<?php
if($_GET['type'] == "online"){
$event_type_filter = 'online';
}else if($_GET['type'] == "city"){
$event_type_filter = $_GET['filter'];
}else{
$event_type_filter = "select filter";
}
?>
<input style="margin-left: 10px;" type="text" class="form-control me-2 event-type-filed w-25" value="<?=$event_type_filter?>">
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$ip_response = file_get_contents('http://ip-api.com/json/'.$ip);
$ip_array=json_decode($ip_response);
?>
</div>
<div class="search_event d-none">
<ul class="eds-dropdown p-2">
<li class="eds-dropdown_title"> <a href="../events/index1.php">No Filter</a></li>
<li class="eds-dropdown_title"> <a href="../events/index1.php?type=city&filter=<?= $ip_array->city;?>"><i class="fa-solid fa-location-crosshairs me-3"></i><?= $ip_array->city; ?></a></li>
<li class="eds-dropdown_title event_type"> <a href="../events/index1.php?type=online&filter=Online_event"><i class="fa-solid fa-globe me-3"></i>Online</a></li>
</ul>
</div>
</div>



<div class="col-12 mt-2">
<ul style="display:flex;justify-content: space-between;">
<li class="nav-link event-nav active">
<a  class="event-link" href="#"  onclick="get_filter_data('all_events')">All</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#online_event"  onclick="get_filter_data('online_event')">Online</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#today_event"  onclick="get_filter_data('today_event')">Today</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#this_weekend_event"  onclick="get_filter_data('this_weekend_event')">This weekend</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#free_event"  onclick="get_filter_data('free_event')">Free</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#music_event"  onclick="get_filter_data('music_event')">Music</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#food_drink_event"  onclick="get_filter_data('food_drink_event')">Food & Drink</a>
</li>
<li class="nav-link event-nav">
<a class="event-link" href="#charity_causes_event"  onclick="get_filter_data('charity_causes_event')">Charity & Causes</a>
</li>
</ul>
</div>


</div>
</div>
</section>

<div class="all_events  events_detail">
<section class="UpcomingSec">
<div class="container">
<div class="row">
<div class="col-12 mt-2">
<h1>Check out trending categories</h1>
</div>

<div class="col-12 mt-2">
<div class="tile-group">
<div class="row">
<div class="col-3 mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-music me-3"></i>Music</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"> <i class="fa-solid fa-masks-theater me-3"></i>Performing &amp; Visual Arts</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">

<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-car me-3"></i>Holiday</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-regular fa-heart me-3"></i>Health</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">

<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-gamepad me-3"></i>Hobbies</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-suitcase me-3"></i>Business</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-champagne-glasses me-3"></i>Food &amp; Drink</div>
</div>
</a>
</div>
<div class="col-3  mt-2">
<a href="#">
<div class="tile">
<div class="tile--name eds-text-weight--heavy"><i class="fa-solid fa-dumbbell me-3"></i>Sports &amp; Fitness</div>
</div>
</a>
</div>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-sm-12">
<?php
$ecg = new _eventCategoryGroups;
$ecgresult = $ecg->readAll();
if ($ecgresult) {
while ($esgrows = mysqli_fetch_assoc($ecgresult)) {
?>
</div>

<div class="row mt-4">
<?php $p  = new _spevent; ?>

<?php

if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_all_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_all_data_with_online_filter();
}
}else{
$eventData =  $p->event_all_data();
}

?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">
<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' || $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
<?php }
} ?>
</div>
</div>
</section>
</div>

<div class="online_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_online_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_online_data();
}
}else{
$eventData =  $p->event_online_data();
}
?>

<?php if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) { ?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' ||  $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>
<div class="today_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_todays_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_todays_data_with_online_filter();
}
}else {
$eventData = $p->event_todays_data();
}
?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu'||  $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>

<div class="this_weekend_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_weekend_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_weekend_data_with_online_filter();
}
}else {
$eventData = $p->event_weekend_data();
}
?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' ||  $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>

<div class="free_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_free_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_free_data_with_online_filter();
}
}else {
$eventData = $p->event_free_data();
}
?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' ||  $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>

<div class="music_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_music_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_music_data_with_online_filter();
}
}else {
$eventData = $p->event_music_data();
}
?>


<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' ||  $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>
<div class="food_drink_event  events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_food_drink_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_food_drink_data_with_online_filter();
}
}else {
$eventData = $p->event_food_drink_data();
}
?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' || $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>
<div class="charity_causes_event events_detail d-none">
<section class="UpcomingSec">
<div class="container">
<div class="row mt-5">
<?php $p  = new _spevent; ?>
<?php
if(isset($_GET['type']) && isset($_GET['filter'])){
if($_GET['type'] == "city"){
$eventData =  $p->event_charity_causes_event_data_with_city_filter($_GET['filter']);
}else{
$eventData =  $p->event_charity_causes_event_data_with_online_filter();
}
}else {
$eventData = $p->event_charity_causes_event_data();
}
?>

<?php   if(!empty($eventData)) { while ($eventRow = mysqli_fetch_assoc($eventData)) {?>
<div class="col-md-3 d-flex align-items-stretch mb-5">
<div class="card bg-light rounded-4 shadow">
<div class="card-header img_fe_box 2222222">
<a href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>" class="">

<img alt="Posting Pic" src="../img/noevent.jpg" class="img-responsive aa">                                                                </a>
</a>
</div>
<div class="card-body">
<div class="d-flex flex-column fs-5">
<span class="fs-5 fw-bold float-right text-event"><?php $date = strtotime($eventRow['start_date']); echo date('d M Y', $date); ?></span>
<span class=" fs-5 float-right"><svg class="svg-inline--fa fa-location-pin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-pin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"></path></svg>
<?php
if($eventRow['event_platform_title'] == 'Venu' || $eventRow['event_platform_title'] == '' ){
$co = new _country;
$countyData = $co->readCountryName($eventRow['county']);

$pr = new _state;
$stateData = $pr->readStateName($eventRow['state']);

$co = new _city;
$cityData = $co->readCityName($eventRow['city']);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}
echo ''.$eventRow['event_address'].','.$city.','.$state.','.$county.'';
}else if($eventRow['event_platform_title'] == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</span>
</div>
<div class="d-flex text-event fs-3 fw-bold">
<a class="text-event fs-3 fw-bold" href="<?php echo $BaseUrl ?>/events/event-detail1.php?postid=<?php echo $eventRow['id']?>"><?php echo $eventRow['event_title']?></a>
</div>
<div class="">
<p class="text-justify ">
<?php echo $eventRow['catchy_phrase']?>
</p>
</div>
<div class="d-flex">
<p>
</p><p class="text-success">
<?php
if($eventRow['event_type'] == '1'){
echo 'Free';
}else if($eventRow['event_type']  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<p></p>
</div>
<div class="ie_702">
<div class="dropdown intrestEvent">
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><svg class="svg-inline--fa fa-star" aria-hidden="true" style="margin: 0px; color: #ff8400;" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg>
<span class="user_intrest_title">

<?php  $Interested = $p->event_user_intres_data($eventRow['id'],$_SESSION['uid']); ?>
<?php
if($Interested){
if ($rowint = mysqli_fetch_assoc($Interested)) {
if($rowint['interested'] == '1'){
echo 'Interested';
}else if($rowint['going']  == '1'){
echo 'Going';
}else if($rowint['may_be']  == '1'){
echo 'May Be';
}
}
}
?>

</span>
</button>
<ul class="dropdown-menu 22 p-4" style="cursor: pointer;">
<li onclick="interested('<?=$eventRow['id'];?>','Interested','<?=$_SESSION['uid'];?>');">
<?php  if($rowint['interested'] == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Interested (1)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','Going ','<?=$_SESSION['uid'];?>');">
<?php if($rowint['going']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
Going (0)
</li>
<li onclick="interested('<?=$eventRow['id'];?>','May Be','<?=$_SESSION['uid'];?>');">
<?php if($rowint['may_be']  == '1'){ echo ' <svg class="svg-inline--fa fa-check" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>';} ?>
May Be (0)
</li>
</ul>
</div>
</div>
</div>
<div class="card-footer">
<p><span class="date"><svg class="svg-inline--fa fa-calendar" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"></path></svg>
<?php  $date = strtotime($eventRow['start_time']); echo date('h:i A', $date); ?> - <?php  $date = strtotime($eventRow['end_time']); echo date('h:i A', $date); ?></span></p>
</div>
</div>
</div>
<?php } } else {echo "<h3 class='text-center'>No Record Found!</h3>";}?>
</div>
</div>
</section>
</div>

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

<h4 class="modal-title">Change Current Location </h4>
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
$result2 = $pr->readStateName($_SESSION['spPostCountry']);
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
$result3 = $co->readCityName($_SESSION['spPostState']);
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
<button type="submit" class="btn btn-primary btn-border-radius" name="changelc">Change</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
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
<script>
$('.nav-link.event-nav').on('click', function() {
$('.event-nav').removeClass('active');
$(this).addClass('active');
});

function get_filter_data(name) {
console.log(name);
if(name != ""){
$('.events_detail').addClass('d-none');
$('.'+name+'').removeClass('d-none');
}
}

$('.intestDetail').on('click',function () {
console.log($(this).text());
});

function interested(id,data,user_id) {
var type = "intrestedData";
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
url: "<?php echo $BaseUrl;?>/events/index1.php",
method: 'POST',
data: {data:data,user_id:user_id,id:id,type:type},
error : function(err) {
console.log('Error!', err)
},
success: function(data) {
if(data == 'sussess'){

}
}
});
$('.user_intrest_title').text(data);
}

$('.event-type-filed').on('click',function (){
if($('.search_event').hasClass('d-none')){
$('.search_event').removeClass('d-none')
}else{
$('.search_event').addClass('d-none')
}
});

$('.eds-dropdown_title').on('click',function (){
$('.event-type-filed').val($(this).text());
if($('.search_event').hasClass('d-none')){
$('.search_event').removeClass('d-none')
}else{
$('.search_event').addClass('d-none')
}
});
</script>
</body>
</body>

</html>
<?php
}
?>