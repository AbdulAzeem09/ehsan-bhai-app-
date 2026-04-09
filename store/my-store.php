<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../univ/baseurl.php');
session_start();
// print_r($_SESSION['pid']);
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$_GET['categoryID'] = 1;
$folder = 'store';
// Handle store name
$profileId = $_SESSION['pid'];
$pro = new _spprofiles;
$result = $pro->read($profileId);
if ($result) {
$row = mysqli_fetch_assoc($result);
$currentUserProfileName = $row['spProfileName'];
$currentUserStoreName = $row['store_name'];
$spUserid = $row['spUser_idspUser'];
$spProfileType = $row['spProfileType_idspProfileType'];
}
if (isset($currentUserStoreName) && !empty($currentUserStoreName) && !is_null($currentUserStoreName)) {
$storeName = $currentUserStoreName;
} else {
$storeName = $currentUserProfileName;
}
$b = new _storebanner;
$result2  = $b->getStoreBannerByProfileId($_SESSION['pid']);
if ($result2 != false) {
$bannerrow = mysqli_fetch_assoc($result2);
$bannerpicture = $bannerrow["spStorebanner"];
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php 
include('../component/f_links.php');
?>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<?php include('store_headpart.php') ?>
<style>
 
.storHeading{
width:30%!important;
}

.dropdown-toggle::after {
content: none;
}
.navbar-nav li a {
padding: 10px 6px !important;
}
.navbar-nav .nav-link {
font-size: 15px!important;
}
.form-select {
font-size:1.5rem!important;
}  
.form-control {
font-size:1.5rem!important;
}
.input-group .btn {
font-size:1.5rem!important;
}
</style>

</head>
<body class="bg_gray">
<?php
//this is for store header
$header_store = "header_store";
include_once("../header.php");
//echo $_SESSION["pid"]; 
?>
<style>
.inner_top_form button {
padding:8.5px 12px!important;
}
.fade:not(.show) {
opacity: 1;
margin-top:55px;
}
</style>
<div class="wrapper d-flex align-items-stretch">
<nav id="leftsidebar" class="active">
<div class="custom-menu">
<button type="button" id="leftsidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
<span class="sr-only">Toggle Menu</span>
</button>
</div>
<div class="p-4">
<h1>Categories</h1>
<?php include('../component/left-storecategory.php'); ?>
</div>
</nav><!-- Page Content p-4 p-md-5 pt-5 -->
<div id="rightcontent" class="">
<section class="main_box">
<div class="container">
<div class="row">         
<div class="col-md-12">
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">       
<li class="nav-item">
<a id="home1" class="classpadding nav-link <?php if ($_GET['folder'] == "home") {
echo "store_active";
}  else if (str_contains($url, 'storeindex.php')) { 
echo ' store_active';
}?>" href="<?php echo $BaseUrl . '/store/storeindex.php?condition=All&folder=home&page=1'; ?>">Home</a>
</li>
<li class="nav-item">

<a id="store1" class="classpadding nav-link <?php if ($_SERVER['REQUEST_URI'] == "/my-store/" || $_SERVER['PHP_SELF'] == "/my-store/index.php") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/my-store/?condition=All&folder=retails&page=1'; ?>">My Store</a>
</li>
<!-- <li><a href="<?php echo $BaseUrl . '/store/'; ?>">Public Store</a></li> -->
<li class="nav-item">
<?php //sharepagedevelopersecho $_SERVER['PHP_SELF']; die; ?>
<a id="personal" class="classpadding nav-link <?php if ($_SERVER['PHP_SELF'] == "/store/personal.php") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/personal.php'; ?>">Personal</a>
</li>
<li class="nav-item">

<a id="retail1" class="classpadding nav-link <?php if ($_GET['folder'] == "retail") {
echo "store_active";
}  ?>" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=1'; ?>">Retail Store</a>
</li>
<li class="nav-item">
<a id="wholesale1" class="classpadding nav-link <?php if ($_GET['folder'] == "wholesale") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=wholesale&page=1'; ?>">Wholesale</a>
</li>
<li class="nav-item">
<a  class="classpadding nav-link <?php if ($_GET['type'] == "auction") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/view-all-auction.php?type=auction&folder=store&page=1'; ?>">Auction</a>
</li>
<!-- <li class="nav-item">
<a id="group1" class="classpadding nav-link <?php if ($_GET['folder'] == "grpstore") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/group-store.php?condition=All&folder=grpstore&page=1'; ?>">Group Store</a>
</li> -->
<li class="nav-item">
<a id="friend1" class="classpadding nav-link <?php if ($_GET['folder'] == "frdstore") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/friend-store.php?condition=All&folder=frdstore&page=1'; ?>">Friends Store</a>
</li>
<li class="nav-item">
<a id="rfq1" class="classpadding nav-link <?php if ($_GET['folder'] == "rfq") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/public_rfq/?condition=All&folder=rfq&page=1'; ?>">RFQ</a>
</li>
<li>
<a id="categories1" class="classpadding nav-link <?php if ($_GET['folder'] == "cat") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/category_search.php?condition=All&folder=cat&page=1'; ?>">Categories</a>
</li>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<li class="nav-item text-left">
<a id="dashboard1" class="classpadding nav-link <?php if ($_SERVER['REQUEST_URI'] == "/store/dashboard/") {
echo "store_active";
} ?>" href="<?php echo $BaseUrl . '/store/dashboard/?condition=All&folder=retail&page=1'; ?>">My Dashboard</a>
</li>
<?php } ?>
</ul>
</div>
</div>
</nav>
<?php
/*print_r($_SERVER['PHP_SELF']);*/
if ($_SERVER['REQUEST_URI'] == "/my-store/" || $_SERVER['PHP_SELF'] == "/my-store/index.php") { ?>
<div class="row no-margin">
<div class="col-md-12 no-padding">
<div class="top_banner">
<?php if ($spUserid == $_SESSION['uid']) { ?>
<div class="storeBannerEditBtn">
<a href="javascript:void(0)" class="storeBannerEditBtnAnchor" data-toggle="modal" data-target="#StorebannerUpload"><i class="fa fa-edit"></i></a>
</div>
<?php  } ?>
<?php if (isset($bannerpicture) && $bannerpicture != '') { ?>
<img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo (isset($bannerpicture)) ? ($bannerpicture) : ''; ?>" alt="Profile Pic" class="img-responsive" style="border-radius: 12px;">
<div class="storHeading pull-right"><span id="storeName_s"><?php echo $storeName; ?></span>
<?php
if ($spProfileType != 5) {
?>
<a href="javascript:void(0)" class="storeUpdateBtn" data-toggle="modal" data-target="#storeNameUpdateModal"><i class="fa fa-edit storeUpdateBtnIcn"></i></a>
<?php } ?>
</div>
<?php } else { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg" class="img-responsive" alt="" style="border-radius:12px; height: 100%; width: 100%;" />
<div class="storHeading pull-right">
<?php
echo $storeName;
if ($spProfileType != 5) {
?>
<a href="javascript:void(0)" class="storeUpdateBtn" data-toggle="modal" data-target="#storeNameUpdateModal"><i class="fa fa-edit storeUpdateBtnIcn"></i></a>
<?php
}
?>
</div>
<?php } ?>
</div>
</div>
</div>
<?php } ?>

<div class="breadcrumb_box m_btm_10 rounded shadow">
<div class="row d-flex justify-conent-between">
<div class="col-md-8 mt-3">
<form method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>">
<div class="input-group ">
<input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
<input type="text" class="form-control" name="txtStoreSearch" value="<?php if (isset($_POST['txtStoreSearch'])) {
echo $_POST['txtStoreSearch'];
} ?>" placeholder="Search For Products" required />
<button type="submit" class="btn btn-primary" name="btnSearchStore"><i class="fa fa-search"></i>
</button>
<a href="<?php echo $BaseUrl ?>/my-store/?condition=All&page=1" class="btn">Reset</a>
<!-- <button type="button" class="btn" href="<?php echo $BaseUrl ?>/store/storeindex.php?folder=home">Reset</button>   -->
</div>
</form>
</div>
<div class="col-md-4 mt-3">
<div class="d-flex justify-content-between mx-3">
<?php if ($profileType != '2' && $profileType != '5') { ?>
<!-- <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn btn-warning sell"> 
Sell Product
</a> -->
<?php } ?>
<form id="price_form" method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;display:inline;">
<?php if ($profileType != '2' && $profileType != '5') {
$priceWidth = "165px";
} else {
$priceWidth = "50%";
}
?>
<select class="form-select" id="dynamic_price"  name="pricedropdown">  
<option value="">Select Price Order</option>
<option value="Asc" <?php if ($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
<option value="Desc" <?php if ($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
</select>
</form>
</div>
</div>
</div>
</div>
<!-- Bread Crum_Box End -->
<!-- Personal Start -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Personal<span class="pull-right"></span></h3>
</div>
<div class="">
<div class="">
<?php
$p = new _productposting;
if (isset($_GET["pid"])) {
//echo 1;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
//public store
$res = $p->search_mystore("Personal", 1, $txtStoreSearch, $_GET["pid"]);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->myretailDESCproduct(1, $_GET["pid"]);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->myretailASCproduct(1, $_GET["pid"]);
} else {
$res = $p->myretailproduct_pp(1, $_GET["pid"]);
}
} else {
//echo 2;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
//public store
$res = $p->search_mystore("Personal", 1, $txtStoreSearch, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->myretailDESCproduct(1, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->myretailASCproduct(1, $_SESSION['pid']);
} else {
//echo 3;
$res = $p->myretailproduct_pp(1, $_SESSION['pid']);
}
}
$active = 0;
$retailRecordCount = 0;
if ($res != false) {
$retailRecordCount = mysqli_num_rows($res);
while ($rows = mysqli_fetch_assoc($res)) {
if ($rows['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rows['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($account_status != 1) {
?>
<div class="">
<div class="col-xs-5ths">
<!-- <div class="featured_box text-center"> -->
<div class="featured_box ">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
}
?>
</a>
</div>
<ul style="padding-left: 10px;display: grid;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px;">
<?php
if (!empty($rows['spPostingTitle'])) {
if (strlen($rows['spPostingTitle']) < 15) {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?></h4>
</li>
<li>
<h5 style="float: left; font-size:14px;">
<?php
if ($rows['spPostingPrice'] != false) {
$curr = $rows['default_currency'];
$price = $rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if ($rows['spPostingPrice'] != false) {
if ($rows['sellType'] == 'Personal') {
$discount   = $rows['retailSpecDiscount'];
} else {
$discount   = $rows['spPostingPrice'];
}
}
echo $curr . ' ' . $discount;
if (($discount != '') && ($rows['sellType'] == "Personal")) {
//echo $curr.' '.$discount; 
?> &nbsp; <del class="text-success" style="color:green;"><?php echo $curr . ' ' . $price; ?></del>
<?php
} else {
echo $curr . ' ' . $price;
}
}
?>
</h5>
</li>
<?php
$mr = new _spstorereview_rating;
$mb = new _spproduct_review;
$totalreviewrate1=0;
//echo $rows['idspPostings'].'///++++++==';
$resultsum1 = $mb->readstorerating_for_review_store($rows['idspPostings'],'Store');
// echo $mr->ta->sql;
if ($resultsum1 != false) {
$totalmyreviews1 = $resultsum1->num_rows;
//echo"here";  
//  echo $totalreviews;
while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {
$sumrevrating1 += $rowreview1['review_star'];
$rateingarr1[] =  $rowreview1['review_star'];
}
$count1 = count($rateingarr1);
$reviewaveragerate1 = $sumrevrating1 / $count1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
// echo $totalreviewrate1.'+++++';
}
?>
<!------
<li>
<p class="rating_box">
<div class="rating-box">
<?php /* if ($totalreviewrate1 >= "5") {
echo '<div class="ratings" style="width:100%;"></div>';
} else  if ($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") {
echo '<div class="ratings" style="width:92%;"></div>';
} else  if ($totalreviewrate1 >= "4") {
echo '<div class="ratings" style="width:80%;"></div>';
} else  if ($totalreviewrate1 > "3" && $totalreviewrate1 < "4") {
echo '<div class="ratings" style="width:72%;"></div>';
} else  if ($totalreviewrate1 >= "3") {
echo '<div class="ratings" style="width:60%;"></div>';
} else  if ($totalreviewrate1 > "2" && $totalreviewrate1 < "3") {
echo '<div class="ratings" style="width:51%;"></div>';
} else  if ($totalreviewrate1 >= "2") {
echo '<div class="ratings" style="width:38%;"></div>';
} else  if ($totalreviewrate1 > "1" && $totalreviewrate1 < "2") {
echo '<div class="ratings" style="width:29%;"></div>';
} else  if ($totalreviewrate1 >= "1") {
echo '<div class="ratings" style="width:16%;"></div>';
} else {
echo '<div class="ratings" style="width:0%;"></div>';
}
*/
?>

</div>                                        
</p>
</li> 
---->
</ul>
</div>
</div>
</div>
<?php }
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($res != false) { ?>
<!-- <button class="carousel-control-prev" type="button" data-bs-target="#itemslider_seven" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_seven" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button> -->
<?php } ?>
</div>
</div>
</div>
<!--Personal close-->
<!-- Retail Open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Retail<span class="pull-right"></span></h3>
</div>
<div class="">
<div class="">
<?php
$p = new _productposting;
if (isset($_GET["pid"])) {
//echo 1;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
//public store
$res = $p->search_mystore("Retail", 1, $txtStoreSearch, $_GET["pid"]);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->myretailDESCproduct(1, $_GET["pid"]);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->myretailASCproduct(1, $_GET["pid"]);
} else {
$res = $p->myretailproduct(1, $_GET["pid"]);
}
} else {
//echo 2;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
//public store
$res = $p->search_mystore("Retail", 1, $txtStoreSearch, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->myretailDESCproduct(1, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->myretailASCproduct(1, $_SESSION['pid']);
} else {
//echo 3;
$res = $p->myretailproduct(1, $_SESSION['pid']);
}
}
$active = 0;
$retailRecordCount = 0;
if ($res != false) {
$retailRecordCount = mysqli_num_rows($res);
while ($rows = mysqli_fetch_assoc($res)) {
if ($rows['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rows['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($account_status != 1) {
?>
<div class="">
<div class="col-xs-5ths">
<!-- <div class="featured_box text-center"> -->
<div class="featured_box ">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
}
?>
</a>
</div>
<ul style="padding-left: 10px;display: grid;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px;">
<?php
if (!empty($rows['spPostingTitle'])) {
if (strlen($rows['spPostingTitle']) < 15) {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?></h4>
</li>
<li>
<h5 style="float: left;">

<?php
if ($rows['spPostingPrice'] != false) {
$curr = $rows['default_currency'];
$price = $rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if ($rows['spPostingPrice'] != false) {
if ($rows['sellType'] == 'Retail') {
$discount   = $rows['retailSpecDiscount'];
} else {
$discount   = $rows['spPostingPrice'];
}
}
echo $curr . ' ' . $discount;
if (($discount != '') && ($rows['sellType'] == "Retail")) {
if($discount !=$price){
//echo $curr.' '.$discount; 
?> &nbsp; <del class="text-success" style="color:green;"><?php echo $curr . ' ' . $price; ?></del>
<?php } ?>
<?php
} else {
echo $curr . ' ' . $price;
}
}
?>
</h5>
</li>
<?php
$mr = new _spstorereview_rating;
$mb = new _spproduct_review;
$resultsum1 = $mb->readstorerating_for_review($rows['idspPostings']);
// echo $mr->ta->sql;
if ($resultsum1 != false) {
$totalmyreviews1 = $resultsum1->num_rows;
//echo"here";  
//  echo $totalreviews;
while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {
$sumrevrating1 += $rowreview1['review_star'];
$rateingarr1[] =  $rowreview1['review_star'];
}
$count1 = count($rateingarr1);
$reviewaveragerate1 = $sumrevrating1 / $count1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
//   echo $totalreviewrate1;
}
?>
<!---------------
<li>
<p class="rating_box">
<div class="rating-box">
<?php /*  if ($totalreviewrate1 >= "5") {
echo '<div class="ratings" style="width:100%;"></div>';
} else  if ($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") {
echo '<div class="ratings" style="width:92%;"></div>';
} else  if ($totalreviewrate1 >= "4") {
echo '<div class="ratings" style="width:80%;"></div>';
} else  if ($totalreviewrate1 > "3" && $totalreviewrate1 < "4") {
echo '<div class="ratings" style="width:72%;"></div>';
} else  if ($totalreviewrate1 >= "3") {
echo '<div class="ratings" style="width:60%;"></div>';
} else  if ($totalreviewrate1 > "2" && $totalreviewrate1 < "3") {
echo '<div class="ratings" style="width:51%;"></div>';
} else  if ($totalreviewrate1 >= "2") {
echo '<div class="ratings" style="width:38%;"></div>';
} else  if ($totalreviewrate1 > "1" && $totalreviewrate1 < "2") {
echo '<div class="ratings" style="width:29%;"></div>';
} else  if ($totalreviewrate1 >= "1") {
echo '<div class="ratings" style="width:16%;"></div>';
} else  if ($totalreviewrate1 <= "0") {
echo '<div class="ratings" style="width:0%;"></div>';
}
*/    
?>
</div>
</p>
</li>
-------------->
</ul>
</div>
</div>
</div>
<?php }
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($res != false) { ?>
<!-- <button class="carousel-control-prev" type="button" data-bs-target="#itemslider_one" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_one" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button> -->
<?php } ?>
</div>
</div>
</div>
<!-- Retail Close -->
<!-- Wholesale Open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>WholeSale<span class="pull-right"></span></h3>
</div>
<div class="carousel carousel-showmanymoveone c_four slide" id="itemslider_four">
<div class="carousel-inner">
<?php
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$resw = $p->search_mystore("Wholesaler", 1, $txtStoreSearch, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$resw = $p->myWholesalerDESCproduct(1, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$resw = $p->myWholesalerASCproduct(1, $_SESSION['pid']);
} else {
$resw = $p->mywholesaleproduct(1, $_SESSION['pid']);
}
$active = 0;
$wholesaleRecordCount = 0;
if ($resw != false) {
$wholesaleRecordCount = mysqli_num_rows($resw);
while ($rowsw = mysqli_fetch_assoc($resw)) {
if ($rowsw['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rowsw['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($account_status != 1) {
?>
<div class="">
<div class="col-xs-5ths">  
<div class="featured_box">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rowsw['idspPostings']);
if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
}
?>
</a>
</div>
<ul style="padding-left: 10px;display: grid;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px;">
<?php
if (!empty($rowsw['spPostingTitle'])) {
if (strlen($rowsw['spPostingTitle']) < 15) {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
} else {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?>
</h4>
</li>
<li>
<h5 style="float: left;">
<?php
if ($rowsw['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>" . $rowsw['default_currency'] . ' ' . $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
$dbDate = strtotime($rowsw['spPostingExpDt']);
$formattedDate = date('Y-m-d', $dbDate);
echo "Expires on " . $formattedDate;
}
?>
</h5>
<?php
$mr = new _spstorereview_rating;
$resultsum3 = $mr->readstorerating($rowsw['idspPostings']);
if ($resultsum3 != false) {
$totalmyreviews3 = $resultsum3->num_rows;
while ($rowreview3 = mysqli_fetch_assoc($resultsum3)) {
$sumrevrating3 += $rowreview3['rating'];
$rateingarr3[] =  $rowreview3['rating'];
}
$count3 = count($rateingarr3);
$reviewaveragerate3 = $sumrevrating3 / $count3;
$totalreviewrate3  = round($reviewaveragerate3, 1);
}
?>
</li> 
<li>
<h5>Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>
</li>
<!-----------
<li>
<p class="rating_box">
<div class="rating-box">
<?php /* if ($totalreviewrate3 >= "5") {
echo '<div class="ratings" style="width:100%;"></div>';
} else  if ($totalreviewrate3 >= "4" && $totalreviewrate3 < "5") {
echo '<div class="ratings" style="width:92%;"></div>';
} else  if ($totalreviewrate3 >= "4") {
echo '<div class="ratings" style="width:80%;"></div>';
} else  if ($totalreviewrate3 > "3" && $totalreviewrate3 < "4") {
echo '<div class="ratings" style="width:72%;"></div>';
} else  if ($totalreviewrate3 >= "3") {
echo '<div class="ratings" style="width:60%;"></div>';
} else  if ($totalreviewrate3 > "2" && $totalreviewrate3 < "3") {
echo '<div class="ratings" style="width:51%;"></div>';
} else  if ($totalreviewrate3 >= "2") {
echo '<div class="ratings" style="width:38%;"></div>';
} else  if ($totalreviewrate3 > "1" && $totalreviewrate3 < "2") {
echo '<div class="ratings" style="width:29%;"></div>';
} else  if ($totalreviewrate3 >= "1") {
echo '<div class="ratings" style="width:16%;"></div>';
} else  if ($totalreviewrate3 <= "0") {
echo '<div class="ratings" style="width:0%;"></div>';
}
*/
?>
</div>                                            
</p>
</li>
------------>
</ul>
</div>
</div>
</div>
<?php }
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($resw != false) { ?>
<!-- <button class="carousel-control-prev" type="button" data-bs-target="#itemslider_four" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_four" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button> -->
<?php } ?>
</div>
</div>
</div>
<!-- wholesaler close  --> 
<!-- Auction open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Auction<span class="pull-right"></span></h3>
</div>
<div class="carousel carousel-showmanymoveone c_five slide" id="itemslider_five">
<div class="carousel-inner">
<?php
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$resa = $p->search_mystore("Auction", 1, $txtStoreSearch, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$resa = $p->myAuctionDESCproduct(1, $_SESSION['pid']);
// echo $p->ta->sql;
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$resa = $p->myAuctionASCproduct(1, $_SESSION['pid']);
//  echo $p->ta->sql;
} else {
$resa = $p->myauctionproduct(1, $_SESSION['pid']);
}
$active = 0;
$auctionRecordCount = 0;
if ($resa != false) {
$auctionRecordCount = mysqli_num_rows($resa);
while ($rows = mysqli_fetch_assoc($resa)) {
if ($rows['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rows['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($account_status != 1) {
?>
<div class="">
<div class="col-xs-5ths">
<div class="featured_box ">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' style='height: 100%;  width: 100%;' class='img-responsive'>";
}
?>
</a>
</div>
<ul style="padding-left: 10px;display: grid;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px;">
<?php
if (!empty($rows['spPostingTitle'])) {
if (strlen($rows['spPostingTitle']) < 15) {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
?><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?>
</h4>
</li>
<li>
<h5 style="float: left;">
<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" . $rows['default_currency'] . ' ' . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
$dbDate = strtotime($rows['spPostingExpDt']);
$formattedDate = date('Y-m-d', $dbDate);
echo "Expires on " . $formattedDate;
}
?>
</h5>
</li>
<input type="hidden" id="auctionexpid<?php echo $rows['idspPostings'] ?>" value="<?php echo $rows['idspPostings'] ?>">
<input type="hidden" id="auctionexp<?php echo $rows['idspPostings'] ?>" value="<?php echo $rows['spPostingExpDt'] ?>">
<script type="text/javascript">
$(document).ready(function() {
get_auctionexpdata("<?php echo $rows['idspPostings']; ?>");
});
</script>
<li style="padding-top: 10px;">
<span id="auction_enddate<?php echo $rows['idspPostings'] ?>"></span>
</li>
</ul>
</div>
</div>
</div>
<?php }
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($resa != false) { ?>
<!-- <button class="carousel-control-prev" type="button" data-bs-target="#itemslider_five" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_five" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button> -->
<?php } ?>
</div>
</div>
</div>
<!-- Auction close -->
</div>
</div>
</div>
</section>
</div>
</div>
<div id="StorebannerUpload" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content sharestorepos bradius-15" style="margin-top:80px!important;">
<form action="<?php echo $BaseUrl ?>/store/uploadstorebanner.php" method="post" enctype="multipart/form-data" onsubmit="return cheform();">
<div class="modal-header br_radius_top bg-white">

<h4 class="modal-title">Upload Banner</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<h4>Choose your store banner</h4>
<div id=""></div>
<br />
<input type="file" name="bannerfile" class="basestorebanner" id="bannerfile" style="display: block;font-size: 15px;" />
<input type="hidden" id="spProfileId" name="profileid" value="<?php echo  $profileId; ?>">
<input type="hidden" id="spuserId" name="userid" value="<?php echo $spUserid; ?>">
</div>

</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">

<button type="button" id="cancel_modal" class="btn btn-danger btn-border-radius" style="font-size: 15px;" data-dismiss="modal">Close</button>
<button type="button" id="uplode_banner" class="btn btn-primary btn-border-radius" style="font-size: 15px;">Save</button>
&nbsp;
</div>
</form>
</div>
</div>
</div>
<div id="storeNameUpdateModal" class="modal fade" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15" style="margin-top:80px!important;">
<form action="<?php echo $BaseUrl ?>/my-store/updatestorename.php" method="post" class="">
<div class="modal-header br_radius_top bg-white" style="display: inline-block;">
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-bottom: -30px; margin-left: 450px;"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title1" id="changeModalLabel"><b style="font-size: 15px;">Update Store Name</b></h3>

</div>
<div class="modal-body">
<div class="form-group">
<label for="store_name" class="control-label contact" style="font-size: 18px;">Store Name:<span id="err_store" class="red"></span></label>
<input type="text" maxlength="20" class="form-control"  id="store_name" name="store_name" value="<?php echo ((isset($storeName)) ? $storeName : ''); ?>">
</div>
</div>
<input type="hidden" class="form-control" id="profileId" name="profileId" value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" id="md_close" class="btn butn_cancel btn-close db_btn db_orangebtn btn-border-radius" data-dismiss="modal" style="height:22px!important;background: #cb3939!important; --bs-btn-close-opacity: 1 !important;">Close</button>
<button type="button" id="change_store_name" name="change_store_name" class="btn btn-submit db_btn db_primarybtn btn-border-radius" style="background: #318b33!important;">Save</button>

</div>
</form>
</div>
</div>
</div>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!--Javascript-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script type="text/javascript">

$(function() {
$(".basestorebanner").change(function() {
// alert();
if (typeof(FileReader) != "undefined") {
var bannerresults = $("#bannerresults");
//spPreview.html("");
var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
$($(this)[0].files).each(function() {
var file = $(this);
//alert(file[0].size);
if (file[0].size <= 2097152) {
if (regex.test(file[0].name.toLowerCase())) {
var reader = new FileReader();
reader.onload = function(e) {
var img = $("<span class='fa fa-remove dynamicspimg closed'></span><img class='divbannerimg overlayImage' style='width: 100%; height: 200px;overflow: hidden;' src='" + e.target.result + "'/></div>");
bannerresults.append(img);
document.getElementById("bannerresults").classList.remove('hidden');
}
reader.readAsDataURL(file[0]);
} else {
alert(file[0].name + " is not a valid image file.");
//spPreview.html("");
return false;
}
} else {
alert(file[0].name + " is too large. Please upload image less then 2Mb.");
return false;
}
});
} else {
alert("This browser does not support HTML5 FileReader.");
}
});
$("#btnbannerimg").click(function() {
var form_data = new FormData();
var pid = $("#spProfileId").val();
var uid = $("#spuserId").val();
form_data.append('profileid', pid);
form_data.append('userid', uid);
form_data.append("bannerfile", document.getElementById('basestorebannerid').files[0]);
$.ajax({
url: "../store/uploadstorebanner.php",
type: "POST",
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
success: function(data) {
//alert(data);
//console.log(data);
window.location.reload();
}
});
});
});
function cheform() {
var imgval = $("#basestorebannerid").val();
if (imgval == "") {
alert("Please select a banner.");
return false;
} else {
return true;
}
}
function get_auctionexpdata(id) {
var auction_exp = $("#auctionexp" + id).val()
// alert(auction_exp);
//if(selltype == "Auction"){
var countDownDate = new Date(auction_exp).getTime();
var x = setInterval(function() {
// Get today's date and time
var now = new Date().getTime();
/* alert(now);*/
// Find the distance between now and the count down date
var distance = countDownDate - now;
/*
alert(distance);*/
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
if (days > 0 && hours > 0 && minutes > 0 && seconds > 0) {
document.getElementById("auction_enddate" + id).innerHTML = days + "d " + hours + "h " +
minutes + "m " + seconds + "s ";
document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h " +
minutes + "m " + seconds + "s ";
document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h " +
minutes + "m " + seconds + "s ";
} else if (days <= 0 && hours > 0 && minutes > 0 && seconds > 0) {
document.getElementById("auction_enddate" + id).innerHTML = hours + "h " +
minutes + "m " + seconds + "s ";
document.getElementById("oldbidtime").innerHTML = hours + "h " +
minutes + "m " + seconds + "s ";
document.getElementById("lowbidtime").innerHTML = hours + "h " +
minutes + "m " + seconds + "s ";
} else if (days <= 0 && hours <= 0 && minutes > 0 && seconds > 0) {
document.getElementById("auction_enddate" + id).innerHTML = minutes + "m " + seconds + "s ";
document.getElementById("oldbidtime").innerHTML = minutes + "m " + seconds + "s ";
document.getElementById("lowbidtime").innerHTML = minutes + "m " + seconds + "s ";
} else if (days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0) {
document.getElementById("auction_enddate" + id).innerHTML = seconds + "s ";
document.getElementById("oldbidtime").innerHTML = seconds + "s ";
document.getElementById("lowbidtime").innerHTML = seconds + "s ";
}
// Output the result in an element with id="demo"
if (days == 0 && hours == 0 && minutes <= 5) {
$('#auction_end').show();
$('#AuctionPrice').hide();
$('.placebidAuction').hide();
$('#bidmsg').hide();
/*alert();*/
}
// If the count down is over, write some text 
if (distance < 0) {
clearInterval(x);
document.getElementById("auction_enddate" + id).innerHTML = "EXPIRED";
}
}, 1000);
//alert(auction_exp);
}
</script>
<script>
$(document).ready(function() {
$('#itemslider_one').carousel({
interval: 5000
});
var retailProductsCount = <?php echo json_encode($retailRecordCount); ?>;
if (retailProductsCount != 0) {
$('.c_one .item').each(function() {
var itemToClone = $(this);
for (var i = 1; i < retailProductsCount; i++) {
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
$('#itemslider_four').carousel({
interval: 5000
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
$('#itemslider_five').carousel({
interval: 5000
});
var auctionProductCount = <?php echo json_encode($auctionRecordCount); ?>;
if (auctionProductCount != 0) {
$('.c_five .item').each(function() {
var itemToClone = $(this);
for (var i = 1; i < auctionProductCount; i++) {
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
});
setTimeout(function() {
$("#div2").hide();
}, 2000);
let items = document.querySelectorAll('.carousel .carousel-item')
items.forEach((el) => {
const minPerSlide = 5
let next = el.nextElementSibling
for (var i=1; i<minPerSlide; i++) {
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
$("#change_store_name").click(function() {
var profileId = $("#profileId").val();
var store_name = $("#store_name").val();
if (store_name == "") {
//alert(store_name);
$("#err_store").text("Please fill store name.");
return false;
}
$.ajax({
url: 'updatestorename.php',
type: 'post',
data: {
profileId: profileId,
store_name: store_name
},
success: function(response) {
$("#storeName_s").text(store_name);
$("#md_close").click();
}
});
});
</script>
<script>
$("#uplode_banner").click(function() {
//alert("++==");
//var bannerfile = $('#bannerfile')[0].files[0];
var spProfileId = $("#spProfileId").val();
var spuserId = $("#spuserId").val();
var formData = new FormData();
formData.append('bannerfile', $('#bannerfile')[0].files[0]);
formData.append('profileid', spProfileId);
formData.append('spuserId', spuserId);
$.ajax({
url: '/store/uploadstorebanner.php',
type: 'post',
data: formData,
processData: false, // tell jQuery not to process the data
contentType: false, // tell jQuery not to set contentType
success: function(data) {
document.getElementById('profilepic').src = '' + data + '';
$("#cancel_modal").click();
window.location.reload();

}
});
});
</script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});
function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});
</script>
<script>
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});
});
$(function() {
$("#dynamic_price").on('change', function() {
// alert();
$("#price_form").submit();
return true;
});
});
</script>
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script>
(function ($) {
"use strict";
var fullHeight = function () {
$(".js-fullheight").css("height", $(window).height());
$(window).resize(function () {
$(".js-fullheight").css("height", $(window).height());
});
};
fullHeight();
$("#leftsidebarCollapse").on("click", function () {
$("#leftsidebar").toggleClass("active");
});
})(jQuery);
</script>
</body>
</html>
<?php
}
?>