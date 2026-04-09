<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) { 
$_SESSION['afterlogin'] = "store/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{ 
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<?php include('../component/f_links.php'); ?>
<?php include('../store/store_headpart.php'); ?>
<!--This script for sticky left and right sidebar END-->
<style>



.dropdown-toggle::after {
content: none;
}

.right_head_top a i {
font-size: 15px !important;
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
.fa-shopping-cart:before {
content: "\f07a";
margin: 4px;
}
.fa-commenting:before {
content: "\f27a";
margin: -22px;
}
.fa-comments:before {
content: "\f086";
margin: 4px;
}
.inner_top_form button{
    padding: 8.7px 12px !important;
}

.modal-header .close {
    margin-top: -2px;
    margin-left: 529px!important;
}
#header_name {
height: 71px;

}
.img-fluid{
    border-radius: 50%;
}


.modal-header {
    display: block;
}
</style>
</head>
<body class="bg_gray">
<?php
//this is for store header
$header_store = "header_store";
include_once("../header.php");

?>
<div class="col-md-4" style="float:right;position:fixed;
z-index:50;right: 0;">
<?php if ($_GET['msg'] == 'conf') {
//unset($_SESSION['cnf_msg']);
?>
<span id="pop_msg">
<div class="alert alert-success" style="background:#3da133">
<span style="color:white">Message Sent Successfully! </span>
</div>
</span>
<script>
setTimeout(function() {
$('#pop_msg').html("");
}, 3000);
</script>
<?php } ?>
</div>
<div class="wrapper d-flex align-items-stretch">
<nav id="leftsidebar" class="active">
<div class="custom-menu">
<button type="button" id="leftsidebarCollapse" class="btn btn-primary btn-border-radius">
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
<?php include('../store/top-dashboard.php'); ?>
<div class="breadcrumb_box m_btm_10 rounded shadow">
<div class="row d-flex justify-conent-between">
<div class="col-md-8 mt-3">
<form method="POST" action="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=wholesale&page=1'; ?>">
<div class="input-group">
<input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
<input type="text" class="form-control" name="txtStoreSearch" value="<?php if (isset($_POST['txtStoreSearch'])) {
echo $_POST['txtStoreSearch'];
} ?>" placeholder="Search For Products" />
<button type="submit" class="btn btn-primary btn-border-radius" name="btnSearchStore">
<i class="fa fa-search"></i>
</button>
<a type="button" class="btn btn-border-radius" href="<?php echo $BaseUrl ?>/wholesale/?condition=All&folder=wholesale&page=1">Reset</a>                     
</div>
</form>
</div>
<div class="col-md-4 mt-3">
<div class="d-flex justify-content-between mx-3">
<!-- <a href="<?php //echo $BaseUrl . '/post-ad/sell/?post' ?>" class="btn btn-warning  sell">Sell Product</a> -->
<form id="price_form" method="POST" action="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=retail&page=1'; ?>">
<!-- <select class="form-select" id="dynamic_price" name="pricedropdown">
<option value="">Select Price Order</option>
<option value="Asc" <?php if ($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
<option value="Desc" <?php if ($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
</select> -->
</form>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
  <div class="row list-wrapper">

<?php
$p = new _productposting;
if (isset($_POST['txtStoreSearch'])) {
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
if ($_GET['page'] == 1) {
$start = 0;
} else {
$r = $_GET['page'] - 1;
$start = $r * 5;
}
$limit = 5;
$res = $p->search_store("Wholesaler", 1, $txtStoreSearch);
$wholsale_store = $res->num_rows;
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
if ($_GET['page'] == 1) {
$start = 0;
} else {
$r = $_GET['page'] - 1;
$start = $r * 5;
}
$limit = 5;
$res = $p->readDESCwholesellsort(1, $_SESSION['pid'], $start, $limit);
$wholsale_store = $res->num_rows;
} else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
if ($_GET['page'] == 1) {
$start = 0;
} else {
$r = $_GET['page'] - 1;
$start = $r * 5;
}
$limit = 5;
$res = $p->readASCwholesellsort(1, $_SESSION['pid'], $start, $limit);
$wholsale_store = $res->num_rows;
} else {
if ($_GET['page'] == 1) {
$start = 0;
} else {
$r = $_GET['page'] - 1;
$start = $r * 5;
}
$limit = 5;
$res = $p->allwholesellpost($_SESSION['pid'], $start, $limit);
$wholsale_store = $res->num_rows;
}
if ($res != false) {
$active = 0;
$wholsale_store = $res->num_rows;
while ($rows = mysqli_fetch_assoc($res)) {
if ($rows['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($rows['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$SellName   = $rows['spProfileName'];
$SellEmail  = $rows['spProfileEmail'];
$SellPhone  = $rows['spProfilePhone'];
$SellAdres  = $rows['spprofilesAddress'];
$SellCity   = $rows['spProfilesCity'];
$SellCounty = $rows['spProfilesCountry'];
$SellId     = $rows['spProfiles_idspProfiles'];
$minQty = $rows['minorderqty'];
?>
<div class="row list-ite" style="width: 100%"> 

<div class="row">
<div class="item">
<?php if ($account_status != 1) { ?>
<div class="col-md-12 ws_box rounded shadow" id="ip6">
<span class="text_size26 p-4">
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>"><?php echo ucfirst(strtolower($rows['spPostingTitle'])); ?></a>
</span>
<br>
<span class="mcountry">
<a href="<?php echo $BaseUrl . '/wholesale/friend.php?pid=' . $rows['idspProfiles']; ?>"><?php echo $rows['spProfileName']; ?></a></span>

<div class="space"></div>
<div class="row p-4">
<?php                                        
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
$count = $result->num_rows;
if ($result) {
}
if ($rows['spCategories_idspCategory'] == 1) {
if ($result != false) {
if ($count == 1) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
$pictp = $rp['spPostingPic'];
?>
<div class="col-md-6 no-padding ws_single_img">
<?php
echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($picture) . "' >";
?>
</div><div class="col-md-6 no-padding ws_single_img">
<?php
echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($picture) . "' >";
?>
</div>
<?php
} else if ($count == 2) {
while ($rp = mysqli_fetch_assoc($result)) {
$pictp = $rp['spPostingPic'];
?>
<div class="col-md-6 no-padding ws_img_box_l p-4">
<?php
echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($rp['spPostingPic']) . "' >";
?>
</div>
<?php
}
} else if ($count == 3) {
while ($rp = mysqli_fetch_assoc($result)) {
$pictp = $rp['spPostingPic'];
?>
<div class="col-md-6 no-padding ws_img_box_l p-4">
<?php
echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($rp['spPostingPic']) . "' >";
?>
</div>
<?php
}
} else {
$k = 1;
while ($rp = mysqli_fetch_assoc($result)) {
if ($k <= 4) {
$pictp = $rp['spPostingPic'];
?>
<div class="col-md-6 no-padding ws_img_box_l p-4">
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($rp['spPostingPic']) . "' >";
?>
</a>
</div>
<?php
}
$k++;
}
}
} else { ?>
<div class="col-md-12 no-padding ws_single_img">
<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-fluid'>
</div>
<?php
}
}
?>
<div class="col-md-12 no-padding">
<div class="ws_btm_box">
<p style="font-size: 16px;">
<?php
if ($rows['sppostingShippingCharge'] > 0) {
echo "$" . $rows['sppostingShippingCharge'];
} else {
echo "Free ";
}
?>
Shipping
</p>
<p class="desc">
<?php
if (strlen($rows['spPostingNotes']) < 60) {
echo $rows['spPostingNotes'];
} else {
echo substr($rows['spPostingNotes'], 0, 60) . '...';
} ?>
</p>
<?php
$userid = $_SESSION['uid'];
$c = new _orderSuccess;
$currency = $c->readcurrency($userid);
$res1 = mysqli_fetch_assoc($currency);
$curr = $res1['currency'];
?>
<div class="row">
<p class="col-md-6 desc"><?php echo $rows['default_currency'] . ' ' . $rows['spPostingPrice']; ?> / Piece</p>
<?php
$minQty = 0;
$q = new _postfield;
$res_q = $q->readfield($rows['idspPostings']);
if ($res_q != false) {
while ($row_q = mysqli_fetch_assoc($res_q)) {
if ($row_q['spPostFieldLabel'] == 'Min Order Qty') {
$minQty = $row_q['spPostFieldValue'];
}
}
}
$minQty = $rows['minorderqty'];
?>
<p class="col-md-6 desc black_clr"><?php echo $minQty; ?> Pieces <span>(min. order)</span></p>
</div>
</div>

<!--modal for Enquery-->
<div class="modal fade" id="enqueryModal-<?php echo $rows['idspPostings'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">
   
<div class="modal-content no-radius sharestorepos bradius-15">
<div class="row">
<div class="col-sm-3 col-md-6" style="font-size: 17px; margin-left: 10px;" id="enquireModalLabel"><b>Send a Message</b></div>
<div class="col-sm-3 col-md-6">


<button type="button" class="close" data-dismiss="modal" aria-label="Close">


</button>

</div>
</div>
<?php
?>
<form action="../enquiry/addmsgenquire.php" method="post">
<div class="modal-body">
<input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid'] ?>" />
<input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php echo $rows['spProfiles_idspProfiles']; ?>" />
<input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $rows['idspPostings'] ?>">
<div class="form-group">
<!-- <label for="message-text" class="form-control-label contact">Message</label> -->
<textarea class="form-control" id="message-text" name="message" rows="5"></textarea>
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-submit db_btn db_primarybtn btn-border-radius"data-dismiss="modal">Close</button>
<!-- <button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button> -->
<button type="submit" class="btn btn-submit db_btn db_primarybtn">Send message</button>

</div>
</form>
</div>
</div>
</div>
</div>
<!-- The Modal -->
<!-- <div class="modal" id="enqueryModal-<?php echo $rows['idspPostings'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">

     
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

     
      <div class="modal-body">
        Modal body..
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div> -->



<div class="ws_footer social" style="border:none;font-size:15px;">
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<ul class="social">
<li><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>"><i class="fa fa-shopping-cart"></i> Buy</a></li>
<?php
if ($rows['spProfiles_idspProfiles'] == $_SESSION['pid']) { ?>
<li>
<a data-toggle='modal' class="wholeenqirymdl" data-target='#quotation_pidform' data-selrid="<?php echo $rows['spProfiles_idspProfiles']; ?>" data-postid="<?php echo $rows['idspPostings'] ?>" data-title="<?php echo $rows['spPostingTitle']; ?>" data-quantity="<?php echo $rows['minorderqty']; ?>"><i class="fa fa-commenting"></i>Request For Quote</a>
</li>
<?php } else { ?>
<li>
<a href="#" data-toggle='modal' class="wholeenqirymdl" data-target='#quotation_form' data-selrid="<?php echo $rows['spProfiles_idspProfiles']; ?>" data-postid="<?php echo $rows['idspPostings'] ?>" data-title="<?php echo $rows['spPostingTitle']; ?>" data-quantity="<?php echo $rows['minorderqty']; ?>"><i class="fa fa-commenting"></i> Request For Quote</a>
</li>
<?php }
if ($SellId != $_SESSION['pid']) { ?>
<li><a href="#" id="enquire" data-toggle="modal" data-target="#enqueryModal-<?php echo $rows['idspPostings'] ?>"><i class="fa fa-comments" aria-hidden="true"></i> Enquiry</a></li>
<?php } ?>
<li class="wholesocial">
<?php
$fv = new _store_favorites;
$res_fv = $fv->chekFavourite($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
if ($res_fv != false) {
?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<div class="showfav_<?php echo $rows['idspPostings']; ?>">

<span id="wholsaleunfavt<?php echo $rows['idspPostings']; ?>"><a onclick="wholsaleunfavte('<?php echo $rows['idspPostings']; ?>','<?php echo $_SESSION['pid']; ?>','<?php echo $rows['idspPostings']; ?>') " class="wholsaleunfav" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $rows['idspPostings']; ?>"><i class="fa fa-heart"></i></a> Unfavorite</span>
<?php
}
} else {
?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>

<span id="wholsalefavt<?php echo $rows['idspPostings']; ?>">
<a onclick="wholsalefavte('<?php echo $rows['idspPostings']; ?>','<?php echo $_SESSION['pid']; ?>','<?php echo $rows['idspPostings']; ?>')" class="wholsalefav" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $rows['idspPostings']; ?>"><i class="fa fa-heart-o"></i></a> &nbsp &nbsp Favorite</span>
<?php
}
}
?>
</li>
<?php if ($rows['supplyability'] > 0) { ?>
<li style="color:green"><b> Available </b></li>
<?php } else {    ?>
<li style="color:red"><b>Out Of Stock</b> </li>
<?php  } ?>

</ul>
<?php } ?>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>

<?php
$active++;

}
?>
</div>
<?php if ($account_status != 1) {
if ($_GET['page'] != "1") { ?>
<a class="float-left btn btn-primary" href="<?php echo $BaseUrl . '/wholesale/index.php?page=' . $_GET['page'] - 1; ?>">Previous</a>
<?php  } ?>
<?php
if ($res->num_rows == 5) { ?>
<a class="float-right  btn btn-primary" href="<?php echo $BaseUrl . '/wholesale/index.php?page=' . $_GET['page'] + 1; ?>">Next</a>
<?php  }
?>
<?php 
}
} else {
echo "<h4 class='text-center'>No Product Found</h4>";
} ?>
</div>
<!-- loop end -->
<div class="col-md-3 rounded" id="sidebar_right">
 <br> 
<div class="top_whole_right_btm b_t_r">
<h3>Top Wholesalers</h3>
</div>
<div class="bg_whole_right_btm b_b_r">
<?php
$p = new _productposting;
$res2 = $p->allwholeSaleProfiles();
//   echo $p->ta->sql;
if ($res2) {
while ($rows2 = mysqli_fetch_assoc($res2)) {
?>
<div class="row">
<div class="col-md-3">
<?php
if (!empty($rows2['spProfilePic'])) {
echo "<img alt='Posting Pic' class='img-fluid' src=' " . ($rows2['spProfilePic']) . "' >";
} else {
echo "<img alt='Posting Pic' class='img-fluid'  src='../assets/images/icon/blank-img.png' >";
}
?>
</div>
<div class="col-md-9 no-padding">
<a href="<?php echo $BaseUrl . '/wholesale/friend.php?pid=' . $rows2['idspProfiles']; ?>" style="text-transform: capitalize;"><?php echo $rows2['spProfileName']; ?></a>
</div>
</div>
<?php
}
} else { ?>
<center>
<p>No available top seller list</p>
</center>
<?php }
?>
</div>
<!-- <div class="saftey_box bg-white bradius-15"> -->
<!-- <h1 style="font-size:20px;">Safety Tips for Buyers</h1>
<ol>
<li>
<h4>Meet seller at a safe location</h4>
</li>
<li>
<h4>Check the item before you buy</h4>
</li>
<li>
<h4>Pay only after collecting item</h4>
</li>
</ol> -->
<!-- </div> -->
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
<?php include('../store/postshare.php'); ?>
<div class="modal fade" id="quotation_pidform" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content no-radius sharestorepos bradius-15">
<div class="modal-header bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="quotationModalLabel"><b>Request For Quotations(Private RFQ)</b></h3>
</div>
<div class="modal-body">
<p class="text-center" style="font-size: 19px;">This is your product you can not access RFQ.</p>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger db_btn  btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="quotation_form" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content no-radius sharestorepos bradius-15">
<div class="modal-header bg-white br_radius_top">
<h3 class="modal-title" id="quotationModalLabel"><b>Request For Quotations&nbsp;(Private RFQ)</b></h3>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

</div>
<form enctype="multipart/form-data" action="../buy-sell/sendquotation.php" method="post" id="quotationform">
<?php $timestamp = time(); ?>
<div class="modal-body">
<input type="hidden" name="buyeremail_" value="" />
<input type="hidden" name="buyername_" value="" />
<!-- jo product buy kr raha ha -->
<input type="hidden" name="spQuotationBuyerid" value="<?php echo $_SESSION['pid'] ?>" />
<!-- jo product sale kr raha ha -->
<input type="hidden" class="dynamic-pid" name="spQuotationSellerid" id="spQuotationSellerid" value="" />
<!--  <?php echo $_POST['data-selrid']; ?>  -->
<input type="hidden" name="spPostings_idspPostings" id="spPosting" value="<?php echo $rows['idspPostings'] ?>">
<input type="hidden" class="dynamic-pid" name="createddatetime" value="<?php echo (date("F d, Y h:i:s", $timestamp)); ?>" />
<input type="hidden" id="minquantity" name="quantity" value="<?php echo $rows['minorderqty'] ?>" />
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spQuotationTotalQty" class="control-label contact">Quantity Required <span class="red">*</span></label>
<span id="spQuotationTotalQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" id="spQuotationTotalQty" name="spQuotationTotalQty" onkeyup="keyupQuotationfun()">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="deleverytime" class="control-label contact">Delivery (Days) <span class="red">*</span></label>
<span id="deleverytime_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50" onkeyup="keyupQuotationfun()">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry">Country <span class="red">*</span></label>
<span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<select id="spUserCountry" class="form-control " name="spQuotationCountry" onkeyup="keyupQuotationfun()">
<option value="">Select Country</option>
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
</div>
<div class="col-md-4">
<div class="loadUserState">
<div class="form-group">
<label for="spPostingCity">State <span class="red">*</span></label>
<span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<select class="form-control" name="spQuotationState" id="spUserState" onkeyup="keyupQuotationfun()">
<option value="">Select State</option>
</select>
</div>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City <span class="red">*</span></label>
<span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<select class="form-control" name="spQuotationCity" id="spUserCity" onkeyup="keyupQuotationfun()">
<option value="">Select City</option>
</select>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="productdetails" class="control-label contact">Comments <span class="red">*</span></label>
<span id="productdetails_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea class="form-control" id="productdetails" name="spQuotatioProductDetails" onkeyup="keyupQuotationfun()"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" id="md_close" class="btn butn_cancel btn-close db_btn db_orangebtn btn-border-radius" data-dismiss="modal" style="height:22px!important;background: #cb3939!important; --bs-btn-close-opacity: 1 !important;" fdprocessedid="le63af">Close</button>

<button type="submit" class="btn btn-submit  db_btn db_primarybtn btn-border-radius" id="quotationsubmit" style="background: #189b18!important;">Submit</button>
</div>
</form>
</div>
</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js
"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script> -->

<script>
function wholsalefavte(postid, pid, id) {
// alert('++++');
$.post("addfavwholeshale.php", {
'postid': postid,
'pid': pid
}, function(response) {
$("#wholsalefavt" + id).html('<span id="wholsaleunfavt"' + id + '><a onclick="wholsaleunfavte(' + postid + ',' + pid + ',' + id + ') " class="wholsaleunfav" data-pid="' + pid + '" data-postid="' + postid + '"><i class="fa fa-heart" ></i></a>Unfavorite </span>');

window.location.reload();
});
}

function wholsaleunfavte(postid, pid, id) {

$.post("delfavwholeshale.php", {
'postid': postid,
'pid': pid
}, function(response) {
$("#wholsaleunfavt" + id).html('<span id="wholsalefavt"' + id + '><a onclick="wholsalefavte(' + postid + ',' + pid + ',' + id + ')" class="wholsalefav" data-pid="' + pid + '" data-postid="' + postid + '"><i class="fa fa-heart-o"></i></a> &nbsp &nbsp Favorite</span>  ');

var title = '<strong>Product Removed From favourite</strong>';
var icon = 'fa fa-heart';
showNofification(title, icon);
});
}

</script>




<script>
function addfavwhole(postid) {
alert('11111');
$.post("addfavwholeshale.php", {
"postid": postid
}, function(response) {
});
}
function delfavwhole(postid) {
$.post("delfavwholeshale.php", {
"postid": postid
}, function(response) {
window.location.reload();
});
}
</script>
<!--Modal For Quatation Complete-->
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!--Javascript-->


<script type="text/javascript">
$(document).ready(function() {
$('.loadpost').click(function() {
$(".seeproduct").show();
$(".loadpost").hide();
});
});
$(document).ready(function(e) {
$("#quotationsubmit").on("click", function() {
var spQuotationProduct = $("#spQuotationProduct").val()
var spQuotationTotalQty = $("#spQuotationTotalQty").val()
var quantity = $("#minquantity").val()
var deleverytime = $("#deleverytime").val()
var spUserCountry = $("#spUserCountry").val()
var spUserState = $("#spUserState").val()
var spUserCity = $("#spUserCity").val()
var productdetails = $("#productdetails").val()
if (spQuotationTotalQty < quantity) {
alert("Please Enter The Min. Order Value");
return false;
} else {
if (spQuotationProduct == "" && spQuotationTotalQty == "" && deleverytime == "" && spUserCountry.length == 0 && spUserState.length == 0 && spUserCity.length == 0 && productdetails == "") {
$("#spQuotationProduct_error").text("Enter Product Name.");
$("#spQuotationProduct").focus();
$("#spQuotationTotalQty_error").text("Enter Quantity.");
$("#spQuotationTotalQty").focus();
$("#deleverytime_error").text("Delivery (Days).");
$("#deleverytime").focus();
$("#spUserCountry_error").text("Select Country.");
$("#spUserCountry").focus();
$("#spUserState_error").text("Select State.");
$("#spUserState").focus();
$("#spUserCity_error").text("Enter City.");
$("#spUserCity").focus();
$("#productdetails_error").text("Enter Comments.");
$("#productdetails").focus();
return false;
} else if (spQuotationProduct == "") {
$("#spQuotationProduct_error").text("Enter Product Name.");
$("#spQuotationProduct").focus();
return false;
} else if (spQuotationTotalQty == "") {
$("#spQuotationTotalQty_error").text("Enter Quantity.");
$("#spQuotationTotalQty").focus();
return false;
} else if (deleverytime == "") {
$("#deleverytime_error").text("Delivery (Days).");
$("#deleverytime").focus();
return false;
} else if (spUserCountry.length == 0) {
$("#spUserCountry_error").text("Select Country.");
$("#spUserCountry").focus();
return false;
} else if (spUserState.length == 0) {
$("#spUserState_error").text("Select State.");
$("#spUserState").focus();
return false;
} else if (spUserCity.length == 0) {
$("#spUserCity_error").text("Enter City.");
$("#spUserCity").focus();
return false;
} else if (productdetails == "") {
$("#productdetails_error").text("Enter Comments.");
$("#productdetails").focus();
return false;
} else {
$("#quotationform").submit();
return true;
}
}
});
});
</script>
<script type="text/javascript">
function keyupQuotationfun() {
var spQuotationProduct = $("#spQuotationProduct").val()
var spQuotationTotalQty = $("#spQuotationTotalQty").val()
var deleverytime = $("#deleverytime").val()
var spUserCountry = $("#spUserCountry").val()
var spUserState = $("#spUserState").val()
var spUserCity = $("#spUserCity").val()
var productdetails = $("#productdetails").val()
if (spQuotationProduct != "") {
$('#spQuotationProduct_error').text(" ");
}
if (spQuotationTotalQty != "") {
$('#spQuotationTotalQty_error').text(" ");
}
if (deleverytime != "") {
$('#deleverytime_error').text(" ");
}
if (spUserCountry.length != 0) {
$('#spUserCountry_error').text(" ");
}
if (spUserState.length != 0) {
$('#spUserState_error').text(" ");
}
if (spUserCity.length != 0) {
$('#spUserCity_error').text(" ");
}
if (productdetails != "") {
$('#productdetails_error').text(" ");
}
}
</script>


<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<!-- <script>
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
$(function() {
$("#dynamic_price").on('change', function() {
//alert();
$("#price_form").submit();
return true;
});
});
</script> -->
</body>
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

// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 4;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });

</script>
</html>
<?php
}
?>