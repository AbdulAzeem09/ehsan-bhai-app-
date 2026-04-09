<?php


include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";





?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
.headerBtnSearch {
height: 35px!important;
}
.dropdown-toggle::after {
display: inline-block;
width: 0;
height: 0;
margin-left: 0.255em;
vertical-align: 0.255em;
content: "";
border-top: none !important;
border-right: 0.3em solid transparent;
border-bottom: 0;
border-left: 0.3em solid transparent;
}
.modal-header .close {
    margin-top: -10px!important;
    margin-left: 295px!important;
}
.foot {
background-color: #8c5d25 !important;

}

#profileDropDown li.active {
background-color: #8c5d25 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}

select.form-control:not([size]):not([multiple]) {
height: calc(3.25rem + 3px) !important; 
}


.dashboard button,
input[type=text],
input[type=button],
select,
textarea,
.select {

height: 35px !important;
}

.explore_data {
display: block;
/*width:50%;
margin:10px auto;
background:#fff;
line-height:50px;
border-radius:30px;*/
display: none;
}

a#seeMore {
display: block;
color: #fff;
margin: 0 auto;
line-height: 33px;
width: 12%;
border-radius: 30px;
text-decoration: none;
border: 3px #8c5d25 solid;
background: #8c5d25;
opacity: 0.7;
margin-bottom: 50px;
text-align: center;
}



a#seeMore:hover {
opacity: 1;
}


.btn:hover,
.btn:focus,
.btn.focus {
color: #333;
text-decoration: none;
color: white !important;


}

.card {
margin-right: 14px !important;
}

h3 {
margin-top: 5px !important;

}



.btnsubmit {
margin-left: 40%;
}

.card-title {
color: black;
padding-top: 10px;
}

.cart_div {
margin-top: -10px;
}

#btnSearch {
background-color: white;
color: black;
border-radius: 5px;
padding: 7px 12px;
}

#btnSearch:hover {
background-color: black;
color: white;
}

#btn_search {
background-color: white;
color: black;
border-radius: 5px;
}

input,
input::placeholder {
font: 13px/3 sans-serif;
}

#cat_t {
background-color: #8c5d25;
color: white;
border-radius: 10px;
}
.dropdown-toggle i, .right_head_top a i {

font-size: 15px!important;
}


</style>
<!-- basic -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
<!-- site metas -->
<title>TheSharePage Business Listing</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css" />
<!-- Style-->
<link rel="stylesheet" href="css/style.css" />
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php include('../component/f_links.php'); ?>
<?php include '../component/custom.css.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<!-- body -->

<body class="main-layout">

<?php
include("../header.php");
?>
<!-- loader  -->
<!--   <div class="loader_bg">
<div class="loader"><img src="images/loading.gif" alt="#" /></div>
</div> -->
<!-- end loader -->
<!-- header -->
<header>
<!-- header inner -->

<?php
if (isset($_SESSION["uid"]) && $_SESSION['spPostCountry_search'] == '') {
  $u = new _spuser;
  $res = $u->read($_SESSION["uid"]);
  if ($res != false) {
    $ruser = mysqli_fetch_assoc($res);
    // print_r($ruser);
    // die('==');
    $_SESSION['spPostCountry_search'] = $ruser["spUserCountry"];
    $_SESSION['spUserState_search'] = $ruser["spUserState"];
    $_SESSION['spUserCity_search'] = $ruser["spUserCity"];
  }
}
if (isset($_POST['changelc'])) {


$country = $_POST['spPostCountry'];
$state = $_POST['spUserState'];
$city = $_POST['spUserCity'];

$_SESSION['spPostCountry_search'] = $country;
$_SESSION['spUserState_search'] = $state;
$_SESSION['spUserCity_search'] = $city;
} ?>
<div class="head_top">
<div class="container-fluid">
<!-- banner -->
<section class="banner_main">
<div class="container">
<div class="row d_flex">
<div class="col-md-12">
<!--<div class="text-bg">
<span class="h1"> Business Listing</span>
<h3 class="text-white">List up your business with us FREE</h3>
</div>-->
<!--Tabs Search-->
<div class="col-sm-12 col-md-8 offset-md-2 align-content-end">
<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="business-tab" data-toggle="tab" href="#home" role="tab" aria-controls="business" aria-selected="true">Search Business</a>
</li>
<li class="nav-item">
<a class="nav-link" id="searchprofile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="searchprofile" aria-selected="false">Search Profile</a>
</li>
</ul>
<!-- <div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
<form>
<div class="row py-4 px-2 mx-2">
<div class="col-md-6 col-sm-12 py-1">
<input type="text" class="" placeholder="Search keywords" />
</div>
<div class="col-md-4 col-sm-12 py-1">
<select class="select">
<option>Select Category</option>
<option>Food</option>
<option>Handi Craft</option>
</select>
</div>
<div class="col-md-2 col-sm-12 py-1">
<input type="button" class="btn btn-dark btn-block border border-light" name="search" value="Search" />
</div>
</div>
</form>
</div>
<div class="tab-pane fade" id="searchprofile" role="tabpanel" aria-labelledby="profile-tab">
<form>
<div class="row py-4 px-2 mx-2">
<div class="col-md-10 col-sm-12 py-1">
<input type="text" class="form-control" placeholder="Search keywords" />
</div>
<div class="col-md-2 col-sm-12 py-1">
<input type="button" class="btn btn-dark btn-block border border-light" name="search" value="Search" />
</div>
</div>
</form>
</div>
</div> -->
<div class="tab-content " id="tab_s">
<div id="home" class="tab-pane fade in active">
<div class="in_ser_serch">
<form class="" action="<?php echo $BaseUrl; ?>/business-directory/search.php?business" method="post">
<input type="hidden" name="txtForm" value="1">
<div class="form-group no-margin">
<div class="row">
<div class="col-md-6">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Type a Business name here" required>
</div>

<div class="col-md-4" style="margin-top: 18px;">
<select class="form-control form-select" id="inputGroupSelect" placeholder="Type a Business name here" name="category" style="margin-top: 2px;">
<option value="">Select by Category</option>
<?php


$m = new _subcategory;
$catid = 8;
$results = $m->read_cat($catid);

if ($results) {

while ($rows = mysqli_fetch_assoc($results)) {


?>
<option value="<?php echo $rows['idmasterDetails']; ?>"><?php echo ucwords(strtolower($rows["masterDetails"])); ?></option>

<?php
}
}
?>

</select>


</div>
<div class="col-md-2">
<button type="submit" name="btnSearch" class="" id="btnSearch">Search</button>

</div>
</div>
</div>
</form>
</div>
</div>
<div id="menu1" class="tab-pane fade in">
<div class="in_ser_serch">
<form class="" action="<?php echo $BaseUrl; ?>/business-directory/search.php?business" method="post">
<input type="hidden" name="txtForm" value="2">
<div class="row">
<div class="form-group col-md-9">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Search By Profile" required>
</div>
<div class="cal-md-2">
<button type="submit" name="btnSearch" id="btn_search">Search</button>
</div>
</div>
</form>
</div>
</div>

</div>
</div>
<!-- End Tabs Search -->
</div>
</div>
</div>
</section>
</div>
<!-- end header inner -->
<!-- end header -->
</div>
</header>
<section class="container" id="demos">
<div class="row">
<div class="col-md-12 text-center py-2">
<?php 
// echo $_SESSION['ptid'];
if($_SESSION['ptid']==1 || $_SESSION['ptid']==3 ){ ?>
<a href="<?php echo $BaseUrl; ?>/business-directory/dashboard.php" class="btn read_more btn-outline-dark btn-lg p-2" style="border: 1px solid black;margin-left:0px;margin-top:15px;"><i class="fa fa-dashboard"></i> Dashboard</a>
<?php } ?>

<div style="margin-right: -1020px;margin-top:-40px;">
<p>
<?php
$usercountry = $_SESSION['spPostCountry_search'];
$userstate = $_SESSION['spUserState_search'];
$usercity = $_SESSION['spUserCity_search'];


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
//echo $co->ta->sql;
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
if ($currentcountry != "") {
if ($currentcity) echo $currentcity . ', ';
if ($currentstate) echo  $currentstate . ', ';
if ($currentcountry) echo  $currentcountry;

//echo $currentcity . ', ' . $currentstate . ', ' . $currentcountry;   
} else {
echo "All";
}
?>
<small> <?php //echo $currentcountry.', '.$currentstate.', '.$currentcity ; 
?><br>
<!-- <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<?php //if($_SESSION['guet_yes'] != 'yes'){ 
?>
<!--<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<a style="cursor:pointer; color: #337ab7;" onclick="openModal()">Change Location</a>

</small>
</p>
</div>
<h2 class="h2 py-2 border border-dark border-left-0 border-right-0 border-top-0">Explore Business Pages</h2>
</div>
</div>
<div class="container">

<ul class="cards">
<!-- <div class="col-md-12" style="display:flex;margin-bottom: 10px;">-->
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=A">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'A') {
echo 'cat_t';
} ?>">A</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=B">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'B') {
echo 'cat_t';
} ?>">B</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=C">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'C') {
echo 'cat_t';
} ?>">C</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=D">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'D') {
echo 'cat_t';
} ?>">D</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=E">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'E') {
echo 'cat_t';
} ?>">E</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=F">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'F') {
echo 'cat_t';
} ?>">F</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=G">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'G') {
echo 'cat_t';
} ?>">G</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=H">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'H') {
echo 'cat_t';
} ?>">H</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=I">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'I') {
echo 'cat_t';
} ?>">I</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=J">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'J') {
echo 'cat_t';
} ?>">J</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=K">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'K') {
echo 'cat_t';
} ?>">K</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=L">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'L') {
echo 'cat_t';
} ?>">L</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=M">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'M') {
echo 'cat_t';
} ?>">M</h4>
</div>
</a>
</li>
<!--</div>
<div class="col-md-12" style="display:flex;">-->
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=N">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'N') {
echo 'cat_t';
} ?>">N</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=O">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'O') {
echo 'cat_t';
} ?>">O</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=P">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'P') {
echo 'cat_t';
} ?>">P</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Q">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Q') {
echo 'cat_t';
} ?>">Q</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=R">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'R') {
echo 'cat_t';
} ?>">R</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=S">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'S') {
echo 'cat_t';
} ?>">S</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=T">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'T') {
echo 'cat_t';
} ?>">T</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=U">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'U') {
echo 'cat_t';
} ?>">U</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=V">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'V') {
echo 'cat_t';
} ?>">V</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=W">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'W') {
echo 'cat_t';
} ?>">W</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=X">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'X') {
echo 'cat_t';
} ?>">X</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Y">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Y') {
echo 'cat_t';
} ?>">Y</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Z">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Z') {
echo 'cat_t';
} ?>">Z</h4>
</div>
</a>
</li>
<!--  </div>-->
</ul>
</div>
</section>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; 
?></h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
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

//	echo $usercountry; die; 
?>

<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry_search']) && $_SESSION['spPostCountry_search'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
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

if (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($_SESSION['spPostCountry_search']);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
// $stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($_SESSION['spUserState_search']);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spUserCity_search']) && $_SESSION['spUserCity_search'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
        }
    } ?>
</select>

<!--													  <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
?>">   -->
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


<section class="container py-5">
<div class="row">
<?php
$m = new _subcategory;
$catid = 8;
if ($_GET['category']) {
$results = $m->read_catrgory($_GET['category'], $catid);
} else {
$results = $m->read_cat($catid);
}
if ($results) {

while ($rows = mysqli_fetch_assoc($results)) {
?>
<div class="col-md-4 py-3 explore_data">
  <a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=' . $rows['idmasterDetails']; ?>" style="color: black;font-size: 16px;"><?php echo ucwords(strtolower($rows["masterDetails"])); ?></a>
</div>

<?php
}
}
else{
echo '<h4>No Category Found.</h4>';
}

?>

<!-- <div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=accounting'; ?>">Accounting</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=advertising_and_marketing '; ?>">ADVERTISING AND MARKETING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=apparel '; ?>">APPAREL</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive_services '; ?>">AUTOMOTIVE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive '; ?>">Automotive</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=business_professional '; ?>">Business & Professional</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=beauty_services '; ?>">BEAUTY SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Computer_services '; ?>">Computer Services</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=consulting '; ?>">CONSULTING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=creative_services '; ?>">CREATIVE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=direct_marketing '; ?>">DIRECT MARKETING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=events_entertainment '; ?>">Events & Entertainment</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=electronics'; ?>">ELECTRONICS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=energy_and_natural_resources '; ?>">ENERGY AND NATURAL RESOURCES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=entertainment '; ?>">ENTERTAINMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=event_management '; ?>">EVENT MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=family_community '; ?>">Family & Community</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=food_restaurants '; ?>">Food & Restaurants</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=facilities_management '; ?>">FACILITIES MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=farm_garden_services '; ?>">FARM & GARDEN SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=financial_services '; ?>">FINANCIAL SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=grocery '; ?>">Grocery</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=gourmet '; ?>">GOURMET</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=government '; ?>">GOVERNMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_Medical'; ?>">Health & Medical</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_construction '; ?>">Home & Construction</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_and_personal_care '; ?>">HEALTH AND PERSONAL CARE</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Home_construction '; ?>">HOME & CONSTRUCTION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_and_garden '; ?>">HOME AND GARDEN</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=household_services '; ?>">HOUSEHOLD SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=it_training '; ?>">It Training</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=information_management '; ?>">INFORMATION MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=international_trade '; ?>">INTERNATIONAL TRADE</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_financial '; ?>">Legal & Financial</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=local_shopping '; ?>">Local Shopping</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Labor_moving '; ?>">LABOR & MOVING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_services'; ?>">LEGAL SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=lessons_tutoring '; ?>">LESSONS & TUTORING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=marine_services '; ?>">MARINE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=mining '; ?>">MINING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=online_addvertising '; ?>">Online Advertising</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=office_supplies_and_equipment '; ?>">OFFICE SUPPLIES AND EQUIPMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=pet_supplies_services '; ?>">PET SUPPLIES & SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=public_relations '; ?>">PUBLIC RELATIONS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=real_estate_services '; ?>">REAL ESTATE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=recruitment_agencies '; ?>">RECRUITMENT AGENCIES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=retail_grocery '; ?>">RETAIL-GROCERY</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=skilled_trade_services '; ?>">SKILLED TRADE SERVICES</a>
</div>

<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports '; ?>">SPORTS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports_Recreation '; ?>">Sports & Recreation</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=travel_transportation '; ?>">Travel & Transportation</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=tax_services '; ?>">TAX SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=telecommunication '; ?>">TELECOMMUNICATION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=therapeutic_services '; ?>">THERAPEUTIC SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=toys_and_games '; ?>">TOYS AND GAMES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=training '; ?>">TRAINING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=transportation '; ?>">TRANSPORTATION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=_vacation_services '; ?>">TRAVEL & VACATION SERVICES</a>
</div> -->

<!--  <a href="#" id="seeMore">Show More</a>-->
</div>

</section>

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".explore_data").slice(0, 15).show();
$("#seeMore").click(function(e) {
e.preventDefault();
$(".explore_data:hidden").slice(0, 15).fadeIn("slow");

if ($(".explore_data:hidden").length == 0) {
$("#seeMore").fadeOut("slow");
}
});
})
</script>
<script>
function openModal() {
$('#myModal').modal('show');
}
</script><?php


include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";





?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
.headerBtnSearch {
height: 35px!important;
}
.dropdown-toggle::after {
display: inline-block;
width: 0;
height: 0;
margin-left: 0.255em;
vertical-align: 0.255em;
content: "";
border-top: none !important;
border-right: 0.3em solid transparent;
border-bottom: 0;
border-left: 0.3em solid transparent;
}

.foot {
background-color: #8c5d25 !important;

}

#profileDropDown li.active {
background-color: #8c5d25 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}

select.form-control:not([size]):not([multiple]) {
height: calc(3.25rem + 3px) !important; 
}


.dashboard button,
input[type=text],
input[type=button],
select,
textarea,
.select {

height: 35px !important;
}

.explore_data {
display: block;
/*width:50%;
margin:10px auto;
background:#fff;
line-height:50px;
border-radius:30px;*/
display: none;
}

a#seeMore {
display: block;
color: #fff;
margin: 0 auto;
line-height: 33px;
width: 12%;
border-radius: 30px;
text-decoration: none;
border: 3px #8c5d25 solid;
background: #8c5d25;
opacity: 0.7;
margin-bottom: 50px;
text-align: center;
}



a#seeMore:hover {
opacity: 1;
}


.btn:hover,
.btn:focus,
.btn.focus {
color: #333;
text-decoration: none;
color: white !important;


}

.card {
margin-right: 14px !important;
}

h3 {
margin-top: 5px !important;

}



.btnsubmit {
margin-left: 40%;
}

.card-title {
color: black;
padding-top: 10px;
}

.cart_div {
margin-top: -10px;
}

#btnSearch {
background-color: white;
color: black;
border-radius: 5px;
padding: 7px 12px;
}

#btnSearch:hover {
background-color: black;
color: white;
}

#btn_search {
background-color: white;
color: black;
border-radius: 5px;
}

input,
input::placeholder {
font: 13px/3 sans-serif;
}

#cat_t {
background-color: #8c5d25;
color: white;
border-radius: 10px;
}
.dropdown-toggle i, .right_head_top a i {

font-size: 15px!important;
}


</style>
<!-- basic -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
<!-- site metas -->
<title>TheSharePage Business Listing</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css" />
<!-- Style-->
<link rel="stylesheet" href="css/style.css" />
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php include('../component/f_links.php'); ?>
<?php include '../component/custom.css.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<!-- body -->

<body class="main-layout">

<?php
include("../header.php");
?>
<!-- loader  -->
<!--   <div class="loader_bg">
<div class="loader"><img src="images/loading.gif" alt="#" /></div>
</div> -->
<!-- end loader -->
<!-- header -->
<header>
<!-- header inner -->

<?php
if ($_SESSION['spPostCountry_search'] == '') {
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {

$ruser = mysqli_fetch_assoc($res);
// print_r($ruser);
// die('==');
$_SESSION['spPostCountry_search'] = $ruser["spUserCountry"];
$_SESSION['spUserState_search'] = $ruser["spUserState"];
$_SESSION['spUserCity_search'] = $ruser["spUserCity"];
}
}
if (isset($_POST['changelc'])) {


$country = $_POST['spPostCountry'];
$state = $_POST['spUserState'];
$city = $_POST['spUserCity'];

$_SESSION['spPostCountry_search'] = $country;
$_SESSION['spUserState_search'] = $state;
$_SESSION['spUserCity_search'] = $city;
} ?>
<div class="head_top">
<div class="container-fluid">
<!-- banner -->
<section class="banner_main">
<div class="container">
<div class="row d_flex">
<div class="col-md-12">
<!--<div class="text-bg">
<span class="h1"> Business Listing</span>
<h3 class="text-white">List up your business with us FREE</h3>
</div>-->
<!--Tabs Search-->
<div class="col-sm-12 col-md-8 offset-md-2 align-content-end">
<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="business-tab" data-toggle="tab" href="#home" role="tab" aria-controls="business" aria-selected="true">Search Business</a>
</li>
<li class="nav-item">
<a class="nav-link" id="searchprofile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="searchprofile" aria-selected="false">Search Profile</a>
</li>
</ul>
<!-- <div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
<form>
<div class="row py-4 px-2 mx-2">
<div class="col-md-6 col-sm-12 py-1">
<input type="text" class="" placeholder="Search keywords" />
</div>
<div class="col-md-4 col-sm-12 py-1">
<select class="select">
<option>Select Category</option>
<option>Food</option>
<option>Handi Craft</option>
</select>
</div>
<div class="col-md-2 col-sm-12 py-1">
<input type="button" class="btn btn-dark btn-block border border-light" name="search" value="Search" />
</div>
</div>
</form>
</div>
<div class="tab-pane fade" id="searchprofile" role="tabpanel" aria-labelledby="profile-tab">
<form>
<div class="row py-4 px-2 mx-2">
<div class="col-md-10 col-sm-12 py-1">
<input type="text" class="form-control" placeholder="Search keywords" />
</div>
<div class="col-md-2 col-sm-12 py-1">
<input type="button" class="btn btn-dark btn-block border border-light" name="search" value="Search" />
</div>
</div>
</form>
</div>
</div> -->
<div class="tab-content " id="tab_s">
<div id="home" class="tab-pane fade in active">
<div class="in_ser_serch">
<form class="" action="<?php echo $BaseUrl; ?>/business-directory/search.php?business" method="post">
<input type="hidden" name="txtForm" value="1">
<div class="form-group no-margin">
<div class="row">
<div class="col-md-6">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Type a Business name here" required>
</div>

<div class="col-md-4" style="margin-top: 19px;">
<select class="form-control form-select" id="inputGroupSelect" placeholder="Type a Business name here" name="category">
<option value="">Select by Category</option>
<?php


$m = new _subcategory;
$catid = 8;
$results = $m->read_cat($catid);

if ($results) {

while ($rows = mysqli_fetch_assoc($results)) {


?>
<option value="<?php echo $rows['idmasterDetails']; ?>"><?php echo ucwords(strtolower($rows["masterDetails"])); ?></option>

<?php
}
}
?>

</select>


</div>
<div class="col-md-2">
<button type="submit" name="btnSearch" class="" id="btnSearch">Search</button>

</div>
</div>
</div>
</form>
</div>
</div>
<div id="menu1" class="tab-pane fade in">
<div class="in_ser_serch">
<form class="" action="<?php echo $BaseUrl; ?>/business-directory/search.php?business" method="post">
<input type="hidden" name="txtForm" value="2">
<div class="row">
<div class="form-group col-md-9">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Search By Profile" required>
</div>
<div class="cal-md-2">
<button type="submit" name="btnSearch" id="btn_search">Search</button>
</div>
</div>
</form>
</div>
</div>

</div>
</div>
<!-- End Tabs Search -->
</div>
</div>
</div>
</section>
</div>
<!-- end header inner -->
<!-- end header -->
</div>
</header>
<section class="container" id="demos">
<div class="row">
<div class="col-md-12 text-center py-2">
<?php  if($_SESSION['ptid']==1){ ?>
<a href="<?php echo $BaseUrl; ?>/business-directory/dashboard.php" class="btn read_more btn-outline-dark btn-lg p-2" style="border: 1px solid black;margin-left: 100px;"><i class="fa fa-dashboard"></i> Dashboard</a>
<?php } ?>

<div style="margin-right: -1020px;">
<p>
<?php
$usercountry = $_SESSION['spPostCountry_search'];
$userstate = $_SESSION['spUserState_search'];
$usercity = $_SESSION['spUserCity_search'];


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
//echo $co->ta->sql;
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
if ($currentcountry != "") {
if ($currentcity) echo $currentcity . ', ';
if ($currentstate) echo  $currentstate . ', ';
if ($currentcountry) echo  $currentcountry;

//echo $currentcity . ', ' . $currentstate . ', ' . $currentcountry;   
} else {
echo "All";
}
?>
<small> <?php //echo $currentcountry.', '.$currentstate.', '.$currentcity ; 
?><br>
<!-- <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<?php //if($_SESSION['guet_yes'] != 'yes'){ 
?>
<!--<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<a style="cursor:pointer; color: #337ab7;" onclick="openModal()">Change Location</a>

</small>
</p>
</div>
<h2 class="h2 py-2 border border-dark border-left-0 border-right-0 border-top-0">Explore Business Pages</h2>
</div>
</div>
<div class="container">

<ul class="cards">
<!-- <div class="col-md-12" style="display:flex;margin-bottom: 10px;">-->
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=A">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'A') {
echo 'cat_t';
} ?>">A</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=B">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'B') {
echo 'cat_t';
} ?>">B</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=C">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'C') {
echo 'cat_t';
} ?>">C</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=D">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'D') {
echo 'cat_t';
} ?>">D</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=E">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'E') {
echo 'cat_t';
} ?>">E</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=F">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'F') {
echo 'cat_t';
} ?>">F</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=G">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'G') {
echo 'cat_t';
} ?>">G</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=H">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'H') {
echo 'cat_t';
} ?>">H</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=I">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'I') {
echo 'cat_t';
} ?>">I</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=J">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'J') {
echo 'cat_t';
} ?>">J</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=K">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'K') {
echo 'cat_t';
} ?>">K</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=L">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'L') {
echo 'cat_t';
} ?>">L</h4>
</div>
</a>
</li>
<li class="card" id="newcard">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=M">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'M') {
echo 'cat_t';
} ?>">M</h4>
</div>
</a>
</li>
<!--</div>
<div class="col-md-12" style="display:flex;">-->
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=N">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'N') {
echo 'cat_t';
} ?>">N</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=O">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'O') {
echo 'cat_t';
} ?>">O</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=P">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'P') {
echo 'cat_t';
} ?>">P</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Q">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Q') {
echo 'cat_t';
} ?>">Q</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=R">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'R') {
echo 'cat_t';
} ?>">R</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=S">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'S') {
echo 'cat_t';
} ?>">S</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=T">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'T') {
echo 'cat_t';
} ?>">T</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=U">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'U') {
echo 'cat_t';
} ?>">U</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=V">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'V') {
echo 'cat_t';
} ?>">V</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=W">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'W') {
echo 'cat_t';
} ?>">W</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=X">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'X') {
echo 'cat_t';
} ?>">X</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Y">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Y') {
echo 'cat_t';
} ?>">Y</h4>
</div>
</a>
</li>
<li class="card">
<a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=Z">
<div class="cart_div">
<h4 class="card-title" id="<?php if ($_GET['category'] == 'Z') {
echo 'cat_t';
} ?>">Z</h4>
</div>
</a>
</li>
<!--  </div>-->
</ul>
</div>
</section>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; 
?></h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
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

//  echo $usercountry; die; 
?>

<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry_search']) && $_SESSION['spPostCountry_search'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
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

if (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($_SESSION['spPostCountry_search']);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
// $stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($_SESSION['spUserState_search']);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spUserCity_search']) && $_SESSION['spUserCity_search'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
        }
    } ?>
</select>

<!--                                                      <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
?>">   -->
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


<section class="container py-5">
<div class="row justify-content-center  text-center">
<?php
$m = new _subcategory;
$catid = 8;
if ($_GET['category']) {
$results = $m->read_catrgory($_GET['category'], $catid);
} else {
$results = $m->read_cat($catid);
}
if ($results) {

while ($rows = mysqli_fetch_assoc($results)) {
?>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=' . $rows['idmasterDetails']; ?>" style="color: black;font-size: 20px;"><?php echo ucwords(strtolower($rows["masterDetails"])); ?></a>
</div>

<?php
}
}
else{
echo '<h4>No Category Found.</h4>';
}

?>

<!-- <div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=accounting'; ?>">Accounting</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=advertising_and_marketing '; ?>">ADVERTISING AND MARKETING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=apparel '; ?>">APPAREL</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive_services '; ?>">AUTOMOTIVE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive '; ?>">Automotive</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=business_professional '; ?>">Business & Professional</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=beauty_services '; ?>">BEAUTY SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Computer_services '; ?>">Computer Services</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=consulting '; ?>">CONSULTING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=creative_services '; ?>">CREATIVE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=direct_marketing '; ?>">DIRECT MARKETING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=events_entertainment '; ?>">Events & Entertainment</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=electronics'; ?>">ELECTRONICS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=energy_and_natural_resources '; ?>">ENERGY AND NATURAL RESOURCES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=entertainment '; ?>">ENTERTAINMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=event_management '; ?>">EVENT MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=family_community '; ?>">Family & Community</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=food_restaurants '; ?>">Food & Restaurants</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=facilities_management '; ?>">FACILITIES MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=farm_garden_services '; ?>">FARM & GARDEN SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=financial_services '; ?>">FINANCIAL SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=grocery '; ?>">Grocery</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=gourmet '; ?>">GOURMET</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=government '; ?>">GOVERNMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_Medical'; ?>">Health & Medical</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_construction '; ?>">Home & Construction</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_and_personal_care '; ?>">HEALTH AND PERSONAL CARE</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Home_construction '; ?>">HOME & CONSTRUCTION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_and_garden '; ?>">HOME AND GARDEN</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=household_services '; ?>">HOUSEHOLD SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=it_training '; ?>">It Training</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=information_management '; ?>">INFORMATION MANAGEMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=international_trade '; ?>">INTERNATIONAL TRADE</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_financial '; ?>">Legal & Financial</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=local_shopping '; ?>">Local Shopping</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Labor_moving '; ?>">LABOR & MOVING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_services'; ?>">LEGAL SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=lessons_tutoring '; ?>">LESSONS & TUTORING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=marine_services '; ?>">MARINE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=mining '; ?>">MINING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=online_addvertising '; ?>">Online Advertising</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=office_supplies_and_equipment '; ?>">OFFICE SUPPLIES AND EQUIPMENT</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=pet_supplies_services '; ?>">PET SUPPLIES & SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=public_relations '; ?>">PUBLIC RELATIONS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=real_estate_services '; ?>">REAL ESTATE SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=recruitment_agencies '; ?>">RECRUITMENT AGENCIES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=retail_grocery '; ?>">RETAIL-GROCERY</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=skilled_trade_services '; ?>">SKILLED TRADE SERVICES</a>
</div>

<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports '; ?>">SPORTS</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports_Recreation '; ?>">Sports & Recreation</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=travel_transportation '; ?>">Travel & Transportation</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=tax_services '; ?>">TAX SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=telecommunication '; ?>">TELECOMMUNICATION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=therapeutic_services '; ?>">THERAPEUTIC SERVICES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=toys_and_games '; ?>">TOYS AND GAMES</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=training '; ?>">TRAINING</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=transportation '; ?>">TRANSPORTATION</a>
</div>
<div class="col-md-4 py-3 explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=_vacation_services '; ?>">TRAVEL & VACATION SERVICES</a>
</div> -->

<!--  <a href="#" id="seeMore">Show More</a>-->
</div>

</section>

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
}
?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".explore_data").slice(0, 15).show();
$("#seeMore").click(function(e) {
e.preventDefault();
$(".explore_data:hidden").slice(0, 15).fadeIn("slow");

if ($(".explore_data:hidden").length == 0) {
$("#seeMore").fadeOut("slow");
}
});
})
</script>
<script>
function openModal() {
$('#myModal').modal('show');
}
</script>
