<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){	
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "store/";
}

function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_POST['txtStoreSearch']) && isset($_POST['btnSearchStore'])){
$txtStoreSearch = $_POST['txtStoreSearch'];
$txtSearchCategory 	= $_POST['txtSearchCategory'];

}else{
$re = new _redirect;
$re->redirect("../store");
}
$pageTitle = 'categorystore';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/links.php');?>
<?php include('store_headpart.php') ?>

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
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
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script>
<!--This script for sticky left and right sidebar END--> 
<style type="text/css">



/* body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
} */

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #3fc770;
    border-color: #3fc770;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #0f8f46;
}






















.navbar-nav li {
padding:  0px 5px !important;
}
#storenavbar_ ul li a {
font-size: 12px !important;
}
.btnd {
width: 130px;
background-color: #032350;
color: #fff;
border-radius: 18px;
height: 35px !important;
padding:  0px !important;
}

.featured_box h4 {

}
.featured_box img {
margin: 0 auto;
height: 150px;
width: 150px;
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
//include('../component/left-store.php');
include('../component/left-store.php'); 
?>
<style>
.b1
{
color:black!important;
}


</style>

</div>

<div class="col-md-10">
<?php
include('top-dashboard.php');
?>
<div class="store_searchbox " style="background-color: #ffff">
<div class="row">
<form method="POST" action="search.php">
<div class="col-md-10" style="display: inline-flex;">
<input type="hidden" name="txtSearchCategory" value="1">
<input style="border-radius: 19px;background-color: #e6eeff;width: 220%;font-size:15px;" type="text"  class="form-control " name="txtStoreSearch" value="<?php if(isset($_POST['txtStoreSearch'])){
echo $_POST['txtStoreSearch'];
}

?>" id="search" placeholder="Search For Products" />
&nbsp;
<select class="form-control" name="storeCategory" style="font-size:15px;">
<option value="AllCategory" <?php echo ($_POST['storeCategory'] == 'AllCategory')?'selected':''?>>All Category</option>
<option value="Retail" <?php echo ($_POST['storeCategory'] == 'Retail')?'selected':''?>>Retail</option>
<option value="Personal" <?php echo ($_POST['storeCategory'] == 'Personal')?'selected':''?>>Personal</option>


<option value="Wholesale" <?php echo ($_POST['storeCategory'] == 'Wholesale')?'selected':''?>>Wholesale</option>
<option value="Auction" <?php echo ($_POST['storeCategory'] == 'Auction')?'selected':''?>>Auction</option>
</select>
</div> 
<div class="col-md-2">
<button type="submit" class="btn btnd" name="btnSearchStore">Search</button>
</div>                               
</form>
</div>
</div>

<div class="row list-wrapper no-margin">
<?php
if(isset($_POST['txtStoreSearch'])){
//$storeCategory 	= 'Retail';
$txtSearchCategory 	= $_POST['txtSearchCategory'];
$txtStoreSearch 	= $_POST['txtStoreSearch'];
if (isset($_POST['storeCategory'])) {
$storeCategory 	= $_POST['storeCategory'];
}

//$p = new _postingview;
$p = new _productposting;

if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
//my store
$res = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
}else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
//friend store
$res = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
}else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
//group post
$res = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
}else if(isset($_POST['storeCategory'])  && $_POST['storeCategory'] == 'AllCategory'){
//public store
$res = $p->searchProductsByAll(isset($start), 1, $txtStoreSearch);

}else if(isset($_POST['storeCategory'])){
	$res = $p->searchProductsByTypeAndText(isset($start), 1, $txtStoreSearch, $storeCategory);
	
}else{
	$res = $p->searchProductsByAll(isset($start), 1, $txtStoreSearch);
}

if($res != false) { ?>
<div class="heading03">
<h3>
<?php  
if (isset($txtStoreSearch) && $txtStoreSearch !='') {
echo $res->num_rows." results found for ".$txtStoreSearch;
} else {
echo $res->num_rows." results found";
}
?>
</h3> 
</div>
<?php 
while ($rows = mysqli_fetch_assoc($res)) {
$dt = new DateTime($rows['spPostingDate']);
$defauttcurrency=$rows['default_currency'];
//echo $defauttcurrency ;
//die('==');
?>

<div class="col-md-3 list-item no-padding">
<div class="featured_box text-center" style="height: 315px !important;">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
<?php
$pic = new _productpic;


$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;



if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];



echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}

?>
</a>
</div>
<h4>
<?php 
//echo $rows['spPostingtitle'];


if(!empty($rows['spPostingTitle'])){
if(strlen($rows['spPostingTitle']) < 15){
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo $rows['spPostingTitle']; ?></a><?php
}else{
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo substr($rows['spPostingTitle'], 0,15).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>    
</h4>
<h5 >
<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>".$defauttcurrency." ". $rows['spPostingPrice'] . "</div>";
}else{
echo "Expires on ".$rows['spPostingExpDt'];
}
?>
</h5>
<h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$rows['idspProfiles']?>"><?php echo ucwords(strtolower($rows['spProfileName']));?></a></h6>
<!-- <h6 class="name"><?php echo $rows['spProfileName'];?></h6> -->
<p class="date"><?php echo $dt->format('d F'); ?> | <?php echo $dt->format('H:i a'); ?></p>
<p class="name"><?php echo $rows['sellType']; ?></p>
</div>
</div>
<?php

}
}else{ ?>
<center>
<div style='min-height: 300px; font-size: 16px;'>No products found.</div>
</center>
<?php    }

}
?>	
</div>
<div id="pagination-container"></div>

</div>




</div>
</div>
</section>



<?php 
include('../component/footer.php');
include('../component/btm_script.php'); 
?>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 12;

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