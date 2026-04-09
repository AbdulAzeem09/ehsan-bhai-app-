<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="store/";
}else{
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_GET['userid']) && $_GET['userid'] > 0){

$profileId = $_GET['userid'];
$storeName = "";
$pro = new _spprofiles; 
$result = $pro->read($profileId);
if ($result) {
$row = mysqli_fetch_assoc($result);
$currentUserProfileName = $row['spProfileName'];
$currentUserStoreName = $row['store_name'];
$spUserid = $row['spUser_idspUser'];
$spProfileType = $row['spProfileType_idspProfileType'];
}

if(isset($currentUserStoreName) && !empty($currentUserStoreName) && !is_null($currentUserStoreName)) {
$storeName = $currentUserStoreName;
} else {
$storeName = $currentUserProfileName;
}
}else{
$re = new _redirect;
$re->redirect($BaseUrl.'/store');
}

//   echo $profiletype;

$result1 = $pro->readbussinessdata($spUserid);

if ($result1) {
$row1 = mysqli_fetch_assoc($result1);
$bussinessid = $row1['idspProfiles'];


}
// echo  $pro->ta->sql;
// echo  $bussinessid;



$bs = new _spbusiness_profile;

$rpvt = $bs->read($bussinessid);


//  echo $bs->ta->sql;
if ($rpvt != false){


$bussinessrow = mysqli_fetch_assoc($rpvt);
// $Storeusername = $bussinessrow['spDynamicWholesell'];

// echo "<pre>";
// print_r($bussinessrow);

$bussid= $bussinessrow['spprofiles_idspProfiles'];


$bussinessdesc = $bussinessrow['BussinessOverview'];
$storeuser = $bussinessrow['spDynamicWholesell'];

$ProfilesAboutStore = $bussinessrow['spProfilesAboutStore'];
$shippingtext = $bussinessrow['spshippingtext'];
$Profilerefund = $bussinessrow['spProfilerefund'];
$Profilepolicy = $bussinessrow['spProfilepolicy'];
} 

$b = new _storebanner;
$result2  = $b->getStoreBannerByProfileId($_GET['userid']);
if($result2 != false)
{
$bannerrow = mysqli_fetch_assoc($result2);
$bannerpicture = $bannerrow["spStorebanner"];
$company_banner = $bannerrow["company_banner"];
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>

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

function cheform() {

var imgval = $("#basestorebannerid").val();
if (imgval == "") {
alert("Please select a banner.");
return false;
} else {
return true;
}

}
</script>
<!--This script for sticky left and right sidebar END-->
<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script type="text/javascript">
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});

});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('#itemslider').carousel({
interval: 3000
});
$('.carousel-showmanymoveone .item').each(function() {
var itemToClone = $(this);
for (var i = 1; i < 5; i++) {
itemToClone = itemToClone.next();
if (!itemToClone.length) {
itemToClone = $(this).siblings(':first');
}
itemToClone.children(':first-child').clone()
.addClass("cloneditem-" + (i))
.appendTo($(this));
}
});
});
</script>
<style>
.storeUpdateBtn {
position: absolute;
top: -14px;
right: -9px;
background-color: #ffffff;
border-radius: 21px;
padding: 1px 9px;
}

.storeUpdateBtnIcn {
font-size: 21px;
}

.storeBannerEditBtn {
position: absolute !important;
font-size: 26px;
background-color: white;
min-width: 5%;
right: 0;
top: 0;
text-align: center;
text-transform: capitalize;
border-radius: 0px 10px 0px 13px;
}

.storeBannerEditBtnAnchor {
background: #fff;
padding: 0px 8px;
border-radius: 0px 0px 0px 21px;
color: #1c6121 !important;
font-size: 30px;
position: absolute;
right: 0;
}
.featured_box h4 {
    background-color: white!important;
}
.companyBannerEditBtnAnchor {
background: #fff;
padding: 0px 8px;
border-radius: 0px 0px 0px 21px;
color: #1c6121 !important;
font-size: 30px;
position: absolute;
right: 0;
}

.text-center {
text-align: center;
margin-top: -4px;
margin-bottom: 5px;
}

.db_primarybtn {
background: #237e23 !important;
}

.db_orangebtn {
background: #d71212 !important;
border: 1px solid transparent !important;
}
</style>
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<div id="sidebar" class="col-md-2 no-padding">
<?php
include('../component/left-store.php');
?>
</div>
<?php /*print_r($_SESSION['pid']);*/

$p = new _spprofiles;
$result  = $p->profilestore($_SESSION["pid"]);

if($result != false)
{
$rowss = mysqli_fetch_assoc($result);

}
?>
<div id="storeNameUpdateModal" class="modal fade" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form action="<?php echo $BaseUrl ?>/store/updatestorename.php" method="post" class="">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Update Store Name</b></h3>
</div>

<div class="modal-body">
<div class="form-group">
<label for="store_name" class="control-label contact">Store Name:</label>
<input type="text" class="form-control" id="store_name" name="store_name"
value="<?php echo ((isset($storeName))? $storeName : '');?>">
</div>
</div>
<input type="hidden" class="form-control" id="profileId" name="profileId"
value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-footer bg-white br_radius_bottom">

<button type="button" class="btn btn-danger btn-border-radius"
data-dismiss="modal" >Close</button>
<button type="submit" id="change_store_name" name="change_store_name"
class="btn btn-submit db_btn db_primarybtn btn-border-radius"
style="background: #237e23!important;">Save</button>

</div>
</form>
</div>
</div>
</div>

<div id="StorebannerUpload" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
<form action="<?php echo $BaseUrl ?>/store/uploadstorebanner.php" method="post"
enctype="multipart/form-data">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Banner</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<h4>Choose your store banner</h4>
<div id=""></div>
<br />
<input type="file" name="bannerfile" class="basestorebanner"
id="basestorebannerid" style="display: block;" />
<input type="hidden" id="spProfileId" name="profileid"
value="<?php echo  $profileId;?>">

<input type="hidden" id="spuserId" name="userid" 
value="<?php echo $spUserid;?>">
</div>

<div class="col-md-6">
<h4>Your selected banner will appear here...</h4>
<div id="bannerresults"
style="width: 100%; height: 200px;overflow: hidden;"></div>
</div>

</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger  btn-border-radius" data-dismiss="modal">Close</button>
&nbsp;
<button type="submit" class="btn btn-primary btn-border-radius">Save</button>
</div>
</form>
</div>
</div>
</div>



<div id="companybannerUpload" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
<form action="<?php echo $BaseUrl ?>/store/uploadcompanybanner.php" method="post"
enctype="multipart/form-data">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Company Banner</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<h4>Choose your Company banner</h4>
<div id=""></div>
<br />
<input type="file" name="combannerfile" class="basestorebanner"
id="basestorebannerid" style="display: block;" />
<input type="hidden" id="spProfileId" name="profileid"
value="<?php echo  $profileId;?>">

<input type="hidden" id="spuserId" name="userid"
value="<?php echo $spUserid;?>">
</div>

<div class="col-md-6">
<h4>Your selected banner will appear here...</h4>
<div id="bannerresults"
style="width: 100%; height: 200px;overflow: hidden;"></div>
</div>

</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger btn-border-radius " data-dismiss="modal">Close</button>

&nbsp;
<button type="submit" class="btn btn-primary btn-border-radius">Save</button>
</div>
</form>
</div>
</div>
</div>


<div class="col-md-10">
<div class="row no-margin">
<div class="col-md-12 no-padding">
<div class="top_banner">


<?php
$result22 = $pro->read($profileId);
$row22 = mysqli_fetch_assoc($result22);
$currentUserProfileName22 = $row22['spProfileName'];

if ($profileId == $_SESSION['pid']) { ?>
<a style="font-size:17px"
href="<?php echo $BaseUrl;?>/friends/?profileid=<?= $profileId ?>"><?= $currentUserProfileName22 ?></a>


<i class="fa fa-share-alt btn" onclick="copyToClipboard('#p1')" style="margin-left: 24px; font-size: 20px;"></i><span id="p1" style="visibility: hidden;"><?php echo $BaseUrl;?>/store/my-all-product.php?userid=<?= $profileId ?></span>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  swal("Shop Link Successfully Copied");
}

</script>


<div class="storeBannerEditBtn">
<a href="javascript:void(0)" class="storeBannerEditBtnAnchor" data-toggle="modal"
data-target="#StorebannerUpload"><i class="fa fa-edit"></i></a>
<!-- <p class="text-left"><p> -->
</div>
<?php  } ?>



<?php  
if (isset($bannerpicture) && $bannerpicture != '') {
?>

<div class="col-md-12">
<div class="col-md-3">
<div class="storeBannerEditBtn">

<?php

if( $_SESSION['pid']==$_GET['userid']){ ?>
<a href="javascript:void(0)" class="companyBannerEditBtnAnchor"
data-toggle="modal" data-target="#companybannerUpload"><i
class="fa fa-edit"></i></a>

<?php } ?>
<!-- <p class="text-left"><p> -->
</div>

<img id="profilepic "
data-media="<?php echo (isset($company_banner)?"1":"0");?>"
src="<?php echo (isset($company_banner))?($company_banner):''; ?>"
alt="Profile Pic" class="img-responsive" style="width: 100%;">

</div>
<div class="col-md-9">

<img id="profilepic " data-media="<?php echo (isset($bannerpicture)?"1":"0");?>"
src="<?php echo (isset($bannerpicture))?($bannerpicture):''; ?>"
alt="Profile Pic" class="img-responsive" style="width: 100%;">
</div>
</div>




<div style="position: absolute!important;
bottom: 120px!important;
font-size: 26px;
background-color: white;
min-width: 42%;
text-align: center;
text-transform: capitalize;
border-radius:6px 6px 6px 6px;
left:280px;
padding: 9px;">
<?php
echo $storeName;
if ($spProfileType != 5 && $profileId == $_SESSION['pid']) {
?>
<a href="javascript:void(0)" class="storeUpdateBtn" data-toggle="modal"
data-target="#storeNameUpdateModal"><i
class="fa fa-edit storeUpdateBtnIcn"></i></a>
<?php
}
?>
</div>

<?php } else {?>


<div class="col-md-12">
<div class="col-md-3" style="margin-left:-20px!important;">
<div class="storeBannerEditBtn">
<?php

if( $_SESSION['pid']==$_GET['userid']){ ?>
<a href="javascript:void(0)" class="companyBannerEditBtnAnchor"
data-toggle="modal" data-target="#companybannerUpload"><i
class="fa fa-edit"></i></a>
<?php } ?>
<!-- <p class="text-left"><p> -->
</div>
<img src="<?php echo $BaseUrl;?>/assets/images/bg/top_banner.jpg"
class="img-responsive" style="width: 100%;" alt="" />



</div>
<div class="col-md-9" style="width:77%!important;">
<img src="<?php echo $BaseUrl;?>/assets/images/bg/top_banner.jpg"
class="img-responsive" style="width: 100%;" alt="" />

</div>
</div>




<div style="position: absolute!important;
bottom: 120px!important;
font-size: 26px;
background-color: white;
min-width: 42%;
text-align: center;
text-transform: capitalize;
border-radius:6px 6px 6px 6px;
left:237px;
padding: 9px;">

<?php
echo $storeName;
if ($spProfileType != 5 && $profileId == $_SESSION['pid']) {
?>
<a href="javascript:void(0)" class="storeUpdateBtn" data-toggle="modal"
data-target="#storeNameUpdateModal"><i
class="fa fa-edit storeUpdateBtnIcn"></i></a>
<?php
}
?>
</div>
<?php
}
?>



</div>
</div>
</div>


<!-- close banner -->



<!-- search start -->
<div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px;margin-top:20px;">
<div class="row no-margin">
<div class="col-md-12 no-padding right_link">

<!-- <form method="POST" action="<?php echo $BaseUrl.'/store/search.php'; ?>" style="margin-block-end: 2px!important;"> profileid='.$_GET['userid']; ?>-->

<form method="POST"
action="<?php echo $BaseUrl.'/store/my-all-product.php?userid='.$_GET['userid'];?>"
style="margin-block-end: 2px!important;">

<div class="" style="padding-top: 3px;padding-left: 3px;">
<input type="hidden" name="txtSearchCategory"
value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">

<input type="hidden" name="searchprofileId" value="
<?php if(isset($_GET['userid'])){ echo $_GET['userid'];  }?>">

<input
style="border-radius: 19px;background-color: #e6eeff;width:80%!important;display:inline-block; "
type="text" class="form-control" name="txtStoreSearch"
value="<?php if(isset($_POST['txtStoreSearch'])){ echo $_POST['txtStoreSearch'];  }?>"
placeholder="Search For Products" />
<button type="submit" class="btn btnd_store" name="btnSearchStore">Search
<!-- store -->
</button>
</div>
</form>


</div>


</div>

</div>

<!-- close search -->


<!-- Personal Open --> 
<?php 
$p = new _productposting;

$res = $p->myallretailproduct_pp(1,$_GET['userid']);
if($res){ ?>


<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03" style="margin-top:-15px;">
<h3>Personal</h3>
</div>

<div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_seven">
<div class="">

<?php
// $p = new _postingview;

$p = new _productposting;




if(isset($_POST['txtStoreSearch'])){
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];

$searchprofileId   = $_GET['userid'];



//print_r($_GET['mystore']);
//$p = new _postingview;
/*$p = new _productposting;*/


//public store
$res = $p->search_mystore("Retail", 1, $txtStoreSearch,$searchprofileId);
//echo $p->ta->sql;

}else{

$res = $p->myallretailproduct_pp(1,$_GET['userid']);
//print_r($res); die('==============');
}  
/* echo $p->ta->sql;*/



//  echo $p->ta->sql;

$active = 0;

if($res != false){

while ($rows = mysqli_fetch_assoc($res)) {
?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box">
<a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>


</a>
</div>
<h4 style="background-color:#028900;">

<?php 

if(!empty($rows['spPostingTitle'])){
if(strlen($rows['spPostingTitle']) < 15){
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
}else{
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>

</h4>

<h5>

<?php
//print_r($rows);die("000000");
$curr=$rows['default_currency'];
$price=$rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if ($rows['spPostingPrice'] != false) {
if($rows['sellType']=='Personal'){
if($rows['retailSpecDiscount']!=''){
$discount   = $rows['retailSpecDiscount'];
}
else{
$discount   = $rows['spPostingPrice'];
}
}
echo $curr.' '.$discount;
if(($discount!='')&& ($rows['sellType']=="Personal")){
if($discount!= $price ){

//echo $curr.' '.$discount; ?> &nbsp; <del class="text-success"
style="color:green;"><?php echo $curr.' '.$price; ?></del>
<?php } ?>
<?php
}else{
 //echo '-----';
echo '<del class="text-success" style="color:green;">'.$curr.' '.$price.'</del>';
}					
//echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on".$rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div> <?php

}
}else{

echo "<h4 class='text-center'>No Record Found</h4>";
}
?>

</div>
<?php  if($res != false){ ?>
<div id="slider-control" class="scndSlideStr">
<a class="left carousel-control" href="#itemslider_seven" data-slide="prev"></a>
<a class="right carousel-control" href="#itemslider_seven" data-slide="next"></a>
</div>
<?php } ?>
</div>



</div>
</div>
<?php } ?>




<!-- Personal Open -->




<!-- Retail Open --> 
<?php 
$p = new _productposting;

$res = $p->myallretailproduct(1,$_GET['userid']);
if($res){ ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Retail</h3>
</div>

<div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_one">
<div class="">

<?php
// $p = new _postingview;

$p = new _productposting;




if(isset($_POST['txtStoreSearch'])){
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];

$searchprofileId   = $_GET['userid'];



//print_r($_GET['mystore']);
//$p = new _postingview;
/*$p = new _productposting;*/


//public store
$res = $p->search_mystore("Retail", 1, $txtStoreSearch,$searchprofileId);
//echo $p->ta->sql;

}else{

$res = $p->myallretailproduct(1,$_GET['userid']);
//print_r($res); die('==============');
}  
/* echo $p->ta->sql;*/



//  echo $p->ta->sql;

$active = 0;

if($res != false){

while ($rows = mysqli_fetch_assoc($res)) {
?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box">
<a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>


</a>
</div>
<h4 style="background-color:#028900;">

<?php 

if(!empty($rows['spPostingTitle'])){
if(strlen($rows['spPostingTitle']) < 15){
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
}else{
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>

</h4>

<h5>

<?php
//print_r($rows);die;
$curr=$rows['default_currency'];
$price=$rows['spPostingPrice'];
$discount   = $rows['retailSpecDiscount'];
if ($rows['spPostingPrice'] != false) {
if($rows['sellType']=='Retail'){
if($rows['retailSpecDiscount']!=''){
$discount   = $rows['retailSpecDiscount'];
}
else{
$discount   = $rows['spPostingPrice'];
}
}
echo $curr.' '.$discount;
if(($discount!='')&& ($rows['sellType']=="Retail")){
//echo $curr.' '.$discount; ?> &nbsp; <del class="text-success"
style="color:green;"><?php echo $curr.' '.$price; ?></del>
<?php
}else{
echo $curr.' '.$price;
}					
//echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on".$rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div> <?php
$active++;
}
}else{

echo "<h4 class='text-center'>No Record Found</h4>";
}
?>

</div>
<?php  if($res != false){ ?>
<div id="slider-control" class="scndSlideStr">
<a class="left carousel-control" href="#itemslider_one" data-slide="prev"></a>
<a class="right carousel-control" href="#itemslider_one" data-slide="next"></a>
</div>
<?php } ?>
</div>


</div>
</div>
<?php } ?>




<!-- Retail Open -->



<!-- Wholesale Open -->
<?php $resw = $p->myallwholesaleproduct(1,$_GET['userid']);

if($resw){ ?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>WholeSale</h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_four">
<div class="">


<?php 
//$p = new _productposting;


if(isset($_POST['txtStoreSearch'])){
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$searchprofileId   = $_GET['userid'];

//print_r($_GET['mystore']);
//$p = new _postingview;
/*$p = new _productposting;*/

//public store
$resw = $p->search_mystore("Wholesaler", 1, $txtStoreSearch,$searchprofileId);
//echo $p->ta->sql;


}else{
$resw = $p->myallwholesaleproduct(1,$_GET['userid']);
}


//   echo $p->ta->sql;


$active = 0;
if($resw != false){
while ($rowsw = mysqli_fetch_assoc($resw)) {


// print_r($rows);

?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box">
<a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>">
<?php
$pic = new _productpic;
$result = $pic->read($rowsw['idspPostings']);
//echo $pic->ta->sql;
if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<h4 style="background-color:#028900;">

<?php 

if(!empty($rowsw['spPostingTitle'])){
if(strlen($rowsw['spPostingTitle']) < 15){
?><a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
}else{
?><a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0,15)).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>

</h4>
<h5>

<?php
if ($rowsw['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>" .$rowsw['default_currency'].' ' . $rowsw['spPostingPrice'] . "</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on ".$rowsw['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div> <?php
$active++;
}
}else{

echo "<h4 class='text-center'>No Record Found</h4>";
}
?>

</div>
<?php   if($resw != false){ ?>
<div id="slider-control" class="scndSlideStr">
<a class="left carousel-control" href="#itemslider_four" data-slide="prev"></a>
<a class="right carousel-control" href="#itemslider_four" data-slide="next"></a>
</div>
<?php } ?>
</div>


</div>
</div>
<?php } ?>



<!-- wholesaler close  -->

<!-- Auction open -->



<?php 

$a = new _productposting;
$resa = $a->myallauctionproduct(1,$_GET['userid']);

if($resa) { ?>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Auction</h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_five">
<div class="">



<?php
$a = new _productposting;

if(isset($_POST['txtStoreSearch'])){
$txtSearchCategory  = $_POST['txtSearchCategory'];
$txtStoreSearch   = $_POST['txtStoreSearch'];
$searchprofileId   = $_GET['userid'];

//print_r($_GET['mystore']);
//$p = new _postingview;
/*$p = new _productposting;*/

//public store
$resa = $a->search_mystore("Auction", 1, $txtStoreSearch,$searchprofileId);

}else{


$resa = $a->myallauctionproduct(1,$_GET['userid']);
}
$active = 0;
if($resa != false){
while ($rows = mysqli_fetch_assoc($resa)) {
/* echo "<pre>";
print_r($rows) ; */

?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box">
<a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' style='width: 100% !important; height: 100% !important;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<h4 style="background-color:#028900;">

<?php 

if(!empty($rows['spPostingTitle'])){
if(strlen($rows['spPostingTitle']) < 15){
?><a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
}else{
?><a
href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>"
data-toggle="tooltip"
title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>

</h4>
<h5>

<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on ".$rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div> <?php

}
}else{

echo "<h4 class='text-center'>No Record Found</h4>";
}
?>

</div>
<?php if($resa!=false){ ?>
<div id="slider-control" class="scndSlideStr">
<a class="left carousel-control" href="#itemslider_five" data-slide="prev"></a>
<a class="right carousel-control" href="#itemslider_five" data-slide="next"></a>
</div>
<?php } ?>
</div>


</div>
</div>
<?php } ?>


<!-- Auction close -->

















</div>
</div>
</div>
</section>



<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>


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
var img = $(
"<span class='fa fa-remove dynamicspimg closed'></span><img class='divbannerimg overlayImage' style='width: 100%; height: 200px;overflow: hidden;' src='" +
e.target.result + "'/></div>");

bannerresults.append(img);
document.getElementById("bannerresults").classList.remove(
'hidden');
}
reader.readAsDataURL(file[0]);
} else {
alert(file[0].name + " is not a valid image file.");
//spPreview.html("");
return false;
}
} else {
alert(file[0].name +
" is too large. Please upload image less then 2Mb.");
return false;
}
});
} else {
alert("This browser does not support HTML5 FileReader.");
}
});

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
</script>
</body>

</html>
<?php } ?>