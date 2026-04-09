<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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

if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  unset($_SESSION['sign-up']);
  //$_SESSION['afterMembership']="/store/storeindex.php";
  //header('location:'.$BaseUrl.'/membership/dash_index.php');
}

$_GET['categoryID'] = 1;
$pr = new _spprofiles;
$result  = $pr->read($_SESSION["pid"]);
if ($result != false) {
$sprows = mysqli_fetch_assoc($result);
$profileType = $sprows["spProfileType_idspProfileType"];
// 2 and 5 are employment and freelance types
}
if (isset($_GET['msg']) == "notverified") {
// die('kkkkkkk');
?>
<div class="alert alert-danger" role="alert">
your business account not verified yet
</div>
<?php } ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); */
include '../component/custom.css.php';
include('store_headpart.php');
?>

<style>


.dropdown-toggle::after {
content: none;
}

.header_store {
padding: 5px 0px 0px !important;
}

.form-select {
font-size: 1.5rem !important;
}

.form-control {
font-size: 1.5rem !important;
}

.input-group .btn {
font-size: 1.5rem !important;
}

* {
font-size: 14px;
}

.inner_top_form button {
margin-top: 5px !important;
border-radius: 0px !important;
padding: 8.5px 12px !important;
}

.carousel-control-prev-icon {
margin-left: -100px !important;
}

.carousel-control-next-icon {
margin-right: -100px !important;
}

.header_store {
padding: 0px 0px 0px !important;
}
.col-xs-5ths {
  width: 20% !important;
  float: left;
}
/*mb*/
@media screen and (max-width: 800px) {
.carousel-item .col-xs-5ths {
    width: 100% !important;
}
}
</style>
</head>

<body class="bg_gray">
<?php
//this is for store header
$header_store = "header_store";
include_once("../header.php");
?>
<?php if (isset($_SESSION['publish1']) == 5) { ?>
<div id="div2" class="alert alert-success pull-right" style="width: 615px;">Publish Successfully !</div>
<?php
unset($_SESSION['publish1']);
} ?>
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
</nav>
<!-- Page Content p-4 p-md-5 pt-5 -->
<div id="rightcontent" class="">
<section class="main_box">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
include('top-dashboard.php');
?>
<?php $folder = "store";
$a = new _spAllStoreForm;
$resban = $a->readbanner('store');
?>
<div class="breadcrumb_box m_btm_10 rounded-4 shadow">
<div class="row d-flex justify-conent-between">
<div class="col-md-8 mt-3">
<form method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>">
<div class="input-group">
<input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
<input type="text" class="form-control" name="txtStoreSearch" value="<?php if (isset($_POST['txtStoreSearch'])) {
echo $_POST['txtStoreSearch'];
} ?>" placeholder="Search For Products" required />
<button type="submit" class="btn btn-primary" name="btnSearchStore"><i class="fa fa-search"></i></button>
<a href="<?php echo $BaseUrl ?>/store/storeindex.php?folder=home" class="btn">Reset</a>
<!-- 
<button type="button" class="btn" href="<?php echo $BaseUrl ?>/store/storeindex.php?folder=home">Reset</button>   -->
</div>
</form>
</div>
<div class="col-md-4 mt-3">
<div class="d-flex justify-content-between mx-3">

<form id="price_form" method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;display:inline;">
<?php if ($profileType != '2' && $profileType != '5') {
$priceWidth = "165px";
} else {
$priceWidth = "50%";
}
?>
<select class="form-select" id="dynamic_price" name="pricedropdown">
<option value="">Select Price Order</option>
<option value="Asc" <?php if ($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Low to High</option>
<option value="Desc" <?php if ($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>High To Low</option>
</select>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Personal -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Personal<span class="pull-right seemore">
<a class="pull-right" href="<?php echo $BaseUrl . '/store/personal.php' ?>" style="color: #0b241e;">See More</a></span>
</h3>
</div>
<div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_one" data-bs-theme="dark" data-interval="3000">
<div class="carousel-inner">
<?php
$p = new _productposting;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$p = new _productposting;
if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
$res = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
$res = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
$res = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
} else {
$res = $p->search_store("Personal", 1, $txtStoreSearch);
}
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->limitDESCretailsort_p(1, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->limitASCretailsort_p(1, $_SESSION['pid']);
} else {
$res = $p->limitallpersonalproduct(1, $_SESSION['pid']);
}
$active = 0;
$personalRecordCount = 0;
if ($res != false) {
$personalRecordCount = mysqli_num_rows($res);
while ($rows = mysqli_fetch_assoc($res)) {
if ($rows['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rows['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$price = $rows['spPostingPrice'];
if ($rows['retailQuantity'] != 0) {
$special_discount = $rows['retailQuantity'];
} else {
$special_discount = $rows['spPostingPrice'];
}
$spec_dis = (((int)$price * (int)$special_discount) / 100);
$disc_price = $price - $spec_dis;
$idposting = $rows['idspPostings'];
$default_currency = $rows['default_currency'];
$flagcmd = $p->flagcount(1, $idposting);
$flagnums = $flagcmd->num_rows;
if ($flagnums == '9') {
$updatestatus = $p->productstatus($idposting);
}
?>
<div class="carousel-item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php if ($account_status != 1) { ?>
<div class="col-xs-5ths">
<div class="featured_box " >
<div class="img_fe_box">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive ' style='border-radius:6px; height: 100%; width: 100%;' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive ' style='border-radius:6px; height: 100%; width: 100%;'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='border-radius:7px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:8px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
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
<h5 style="float: left;font-size:14px;">
<?php
$userid = $_SESSION['uid'];
$c = new _orderSuccess;
$currency = $c->readcurrency($userid);
if ($currency) {
$res1 = mysqli_fetch_assoc($currency);
}
?>
<?php
if ($rows['spPostingPrice'] != '') {
$curr = $rows['default_currency'];
$price = $rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if (($rows['sellType'] == 'Retail') || ($rows['sellType'] == 'Personal')) {
if ($rows['retailSpecDiscount'] != '') {
$discount   = $rows['retailSpecDiscount'];
} else {
$discount   = $rows['spPostingPrice'];
}
}
echo $curr . ' ' . $discount;
if (($discount != '') && ($rows['sellType'] == "Retail") || ($rows['sellType'] == 'Personal')) {
if ($price != $discount) {
?> &nbsp;
<del class="text-success" style="color:green;">
<?php echo $curr . ' ' . $price; ?>
</del>
<?php
}
} else {
echo $curr . ' ' . $price;
}
}
?>
</h5>
</li>
<li>
<h5>
<?php
$c = new _spproduct_review;
$available = $rows['supplyability'];
$idposting_new = $rows['idspPostings'];
$product = $c->read_product($idposting_new);
$rows1 = mysqli_fetch_array($product);
$retail = $rows1['retailQuantity'];
if ($retail <= 0) {
echo "<span style='font-size:15px;color:red;'><b>Out of Stock</b></span>";
} else {
//echo "<span style='font-size:15px; color:green;'><b>In Stock</b></span>";
}
?>
</h5>
</li>
<?php
$mr = new _spstorereview_rating;
$resultsum1 = $mr->readstorerating($rows['idspPostings']);
if ($resultsum1 != false) {
$totalmyreviews1 = $resultsum1->num_rows;
while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {
$sumrevrating1 += $rowreview1['rating'];
$rateingarr1[] =  $rowreview1['rating'];
}
$count1 = count($rateingarr1);
$reviewaveragerate1 = $sumrevrating1 / $count1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
}
?>
</ul>
</div>
</div>
<?php } ?>
</div>
<?php
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($res != false) { ?>
<button class="carousel-control-prev" type="button" data-bs-target="#itemslider_one" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_one" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
<?php } ?>
</div>
</div>
</div>
<!-- Retail Open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">Retail<span class="pull-right seemore">
<a class="pull-right" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=1' ?>" style="color: #0b241e;">See More</a></span>
</h3>
</div>
<div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_two" data-bs-theme="dark" data-interval="3000">
<div class="carousel-inner">
<?php
$p = new _productposting;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$p = new _productposting;
if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
$res = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
$res = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
$res = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
} else {
$res = $p->search_store("Retail", 1, $txtStoreSearch);
}
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$res = $p->limitDESCretailsort(1, $_SESSION['pid']);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$res = $p->limitASCretailsort(1, $_SESSION['pid']);
} else {
$res = $p->limitallretailproduct(1, $_SESSION['pid']);
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
$price = $rows['spPostingPrice'];
if ($rows['retailQuantity'] != 0) {
$special_discount = $rows['retailQuantity'];
} else {
$special_discount = $rows['spPostingPrice'];
}
$spec_dis = (((int)$price * (int)$special_discount) / 100);
$disc_price = $price - $spec_dis;
$idposting = $rows['idspPostings'];
$default_currency = $rows['default_currency'];
$flagcmd = $p->flagcount(1, $idposting);
$flagnums = $flagcmd->num_rows;
if ($flagnums == '9') {
$updatestatus = $p->productstatus($idposting);
}
?>
<div class="carousel-item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php if ($account_status != 1) { ?>
<div class="col-xs-5ths">
<div class="featured_box">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
if ($rows['featuredImageCrop'] != NULL) {
    echo "<img alt='Posting Pic' style='border-radius:4px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($rows['featuredImageCrop']) . "' >";
 } else{
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive ' style='border-radius:1px; height: 100%; width: 100%;' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive ' style='border-radius:7px; height: 100%; width: 100%;'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='border-radius:2px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:3px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
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
$userid = $_SESSION['uid'];
$c = new _orderSuccess;
$currency = $c->readcurrency($userid);
if ($currency) {
$res1 = mysqli_fetch_assoc($currency);
}
?>
<?php
if ($rows['spPostingPrice'] != '') {
$curr = $rows['default_currency'];
$price = $rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if ($rows['sellType'] == 'Retail') {
if ($rows['retailSpecDiscount'] != '') {
$discount   = $rows['retailSpecDiscount'];
} else {
$discount   = $rows['spPostingPrice'];
}
}
echo $curr . ' ' . $discount;
if (($discount != '') && ($rows['sellType'] == "Retail")) {
if ($price != $discount) {
?> &nbsp;
<del class="text-success" style="color:green;">
<?php echo $curr . ' ' . $price; ?>
</del>
<?php }
} else {
echo $curr . ' ' . $price;
}
}
?>
</h5>
</li>
<li>
<h5>
<?php
$c = new _spproduct_review;
$available = $rows['supplyability'];
$idposting_new = $rows['idspPostings'];
$product = $c->read_product($idposting_new);
$rows1 = mysqli_fetch_array($product);
$retail = $rows1['retailQuantity'];
if ($retail <= 0) {
echo "<span style='font-size:15px;color:red;'><b>Out of Stock</b></span>";
} else {
//echo "<span style='font-size:15px; color:Green;'><b>In Stock</b></span>";
}
?>
</h5>
</li>
<?php
$mr = new _spstorereview_rating;
$resultsum1 = $mr->readstorerating($rows['idspPostings']);
if ($resultsum1 != false) {
$totalmyreviews1 = $resultsum1->num_rows;
while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {
$sumrevrating1 += $rowreview1['rating'];
$rateingarr1[] =  $rowreview1['rating'];
}
$count1 = count($rateingarr1);
$reviewaveragerate1 = $sumrevrating1 / $count1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
}
?>
</ul>
</div>
</div>
<?php } ?>
</div>
<?php
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($res != false) { ?>
<button class="carousel-control-prev" type="button" data-bs-target="#itemslider_two" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_two" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button><?php } ?>
</div>
</div>
</div>
<!-- Retail Close -->
<!-- Wholesale Open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">WholeSale<span class="pull-right seemore"><a class="pull-right" href="<?php echo $BaseUrl . '/wholesale/index.php?page=1&folder=wholesale'; ?>" style="color: #0b241e;">See More</a></span></h3>
</div>
<div class="carousel carousel-showmanymoveone c_four slide" id="itemslider_four" data-bs-theme="dark" data-interval="3000">
<div class="carousel-inner">
<?php
$p = new _productposting;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
$resw = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
$resw = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
$resw = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
} else {
$resw = $p->search_store("Wholesaler", 1, $txtStoreSearch);
}
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$resw = $p->limitDESCwholesellsort(1);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$resw = $p->limitASCwholesellsort(1);
} else {
$resw = $p->allwholesellpost($_SESSION['pid'], '0', '4');
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
$idposting = $rowsw['idspPostings'];
$flagcmd = $p->flagcount(1, $idposting);
$flagnums = $flagcmd->num_rows;
if ($flagnums == '9') {
$updatestatus = $p->productstatus($idposting);
}
?>
<div class="carousel-item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php if ($account_status != 1) { ?>
<div class="col-xs-5ths">
<div class="featured_box">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>">
<?php

if ($rowsw['featuredImageCrop'] != NULL) {
    echo "<img alt='Posting Pic' style='border-radius:4px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($rowsw['featuredImageCrop']) . "' >";
 } else{
$pic = new _productpic;
$result = $pic->read($rowsw['idspPostings']);
if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='border-radius:4px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:12px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='border: radius 6px;px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:7px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
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
echo "<div class='postprice text-center' style='margin-bottom:-5px;' data-price='" . $rowsw['spPostingPrice'] . "'>" . $rowsw['default_currency'] . ' ' . $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
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
<h5 style="margin-bottom:-5px;">Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>
</li>
<li>
<h5>
<?php
$available = $rowsw['supplyability'];
if ((($rowsw['minorderqty'] || $available) != false) && ($rowsw['minorderqty'] <= $available)) {
//echo "<span style='font-size:15px; color:green;'><b>In Stock</b></span>";
} else {
echo "<span style='font-size:15px; color:red;'><b>Out Of Stock</b></span>";
}
?>
</h5>
</li>
</ul>
</div>
</div>
<?php } ?>
</div>
<?php
$active++;
}
} else {
echo "<h4 class='text-center'>No Record Found</h4>";
}
?>
</div>
<?php if ($resw != false) { ?>
<button class="carousel-control-prev" type="button" data-bs-target="#itemslider_four" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_four" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
<?php } ?>
</div>
</div>
</div>
<!-- wholesaler close  -->
<!-- Auction open -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">Auction<span class="pull-right seemore"><a class="pull-right" href="<?php echo $BaseUrl . '/store/view-all-auction.php?condition=All&type=auction&folder=store&page=1'; ?>">See More</a></span></h3>
</div>
<div class="carousel carousel-showmanymoveone c_five slide" id="itemslider_five" data-bs-theme="dark" data-interval="3000">
<div class="carousel-inner">
<?php
$a = new _productposting;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
$resa = $a->search_myall_store($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
$resa = $a->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
} else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
$resa = $a->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
} else {
$resa = $a->search_store("Auction", 1, $txtStoreSearch);
}
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
$resa = $p->limitDESCauctionsort(1);
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
$resa = $p->limitASCauctionsort(1);
} else {
$resa = $a->limitallauctionproduct(1, $_SESSION['pid']);
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
$idposting = $rows['idspPostings'];
$flagcmd = $p->flagcount(1, $idposting);
$flagnums = $flagcmd->num_rows;
if ($flagnums == '9') {
$updatestatus = $p->productstatus($idposting);
}
if ($account_status != 1) {
?>
<div class="carousel-item <?php echo ($active == 0) ? 'active' : ''; ?>">
<div class="col-xs-5ths">
<div class="featured_box">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
if ($rows['featuredImageCrop'] != NULL) {
    echo "<img alt='Posting Pic' style='border-radius:4px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($rows['featuredImageCrop']) . "' >";
 } else{
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic'  style='border-radius:8px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:9px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='border-radius:10px; height: 100%; width: 100%;' class='img-responsive ' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='border-radius:11px; height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
}
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
echo "<div class='postprice text-center' style='margin-bottom:-5px;' data-price='" . $rows['spPostingPrice'] . "'>
Starts at



" . $rows['default_currency'] . ' ' . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
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
<button class="carousel-control-prev" type="button" data-bs-target="#itemslider_five" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#itemslider_five" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
<?php } ?>
</div>
</div>
</div><!-- Auction close -->
</div>
</section>
</div>
</div>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!--Javascript-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<?php
$aa = rand();
?>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js?<?php echo $aa; ?>"></script>
<!-- chart api see in future -->
<!-- <link rel="stylesheet" href="http://api.highcharts.com/highcharts"> -->
<!-- zoom effect -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script> -->
<!-- youtube links -->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/youtube.js"></script>
<!-- SWEET ALERT MSG -->
<link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!-- END -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$('.thumbnail').magnificPopup({
type: 'image'
// other options
});
</script>
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#leftsidebar').hcSticky(settings);
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
$('#leftsidebar_right').hcSticky(settings);
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
$(function() {
$("#dynamic_price").on('change', function() {
//alert();
$("#price_form").submit();
return true;
});
});
</script>
<!--This script for sticky left and right sidebar END-->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript">
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});
});
</script>
<script type="text/javascript">
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
<script type="text/javascript">
$(document).ready(function() {
$('#itemslider_one').carousel({
interval: false
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
$('#itemslider_five').carousel({
interval: false
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
}, 5000);
let items = document.querySelectorAll('.carousel .carousel-item')
items.forEach((el) => {
const minPerSlide = 5
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

</html>
<?php
}
?>
