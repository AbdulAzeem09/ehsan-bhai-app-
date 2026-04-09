<?php
include('../univ/baseurl.php');
session_start();
//print_r($_SESSION);
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once("../authentication/check.php");
} else {


function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = 13;
$header_photo = "header_photo";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl; ?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- this script for slider art -->
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: false
}
}
});
});
</script>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->

<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>

<style>
.topartBox {
height: 365px;
}
.bg_orange {
background-color: #000080;
}

.section_event_art {
display: none;
}

.artExhibition {
display: none;
}

.artBox p a {
color: #333;
padding-top: 10px;
display: block;
}

.badge.badge-success {
background: #24bd9d !important;
margin-top: 10px;
}

#profileDropDown li.active {
background-color: #99068a !important;
}

#profileDropDown li.active a {
color: #fff !important;
}
.art_banner a {
padding: 10px 29px !important;
}
</style>
</head>

<body class="bg_gray">
<?php include_once("../header.php"); ?>
<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">

<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business, Professional, Personal"</span> modules can sell product.</h2>
<div class="space-md"></div>
<a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
<a href="<?php echo $BaseUrl . '/artandcraft'; ?>" class="btn">Back to Home</a>
</div>
</div>
</div>
</div>
<section class="main_box no-padding" id="art-page">
<div class="col-xs-12 art_banner text-center">
<div class="container">

<h1>Beautiful, High-Resolution Free Photos with No Restrictions</h1>
<p>For personal or commercial projects, Photos added every day. No royalties, no fees, no worries. Enjoy !</p>
<?php
if ($_SESSION['guet_yes'] != 'yes') {
if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 2) {
/*$u = new _spuser;
// IS EMAIL IS VERIFIED
$p_result = $u->isverify($_SESSION['uid']);
if ($p_result == 1) {
$pv = new _postingviewartcraft;
$reuslt_vld = $pv->chekposting(13,$_SESSION['pid']);
if ($reuslt_vld == false) {*/
?>
<?php if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 4 ) { ?>
<a href="<?php echo $BaseUrl . '/post-ad/photos/?post'; ?>" style="background-color:<?php echo $artcraft_clr; ?>;color:white" class="btn-border-radius">Sell Your Art Work Today!</a><?php
}else {?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' style="background-color:<?php echo $artcraft_clr; ?>;color:white" class="btn-border-radius">Sell Your Art Work Today!</a>
<?php
}
/*}

}else{
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' >Sell Your Art Work today!</a>
<?php
}*/
} else {
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile'  class="btn-border-radius">Sell Your Art Work Today!</a> <?php
}
}
?>

<form class="form-inline" method="" action="search.php">
<div class="row">
<div class="col-md-offset-2 col-md-8">
<div class="form-group" style="width: 100%;">
<input type="hidden" name="txtSearchCategory" value="<?php echo $_GET["categoryID"]; ?>">
<input type="text" class="form-control" name="txtArtSearch" placeholder="Search images, vector, illustration" required>
<!-- <select class="form-control">
<option value="visual Artist">Visual Artist</option>
<option value="Graphics Designer">Graphics Designer</option>
<option value="Contemporary">Contemporary</option>
<option value="Animation">Animation</option>
<option value="Musician">Musician</option>
</select> -->
<input type="submit" name="btnArtSearch" class="btn btn_searchArt " value="Search">
</div>
</div>
</div>
</form>
</div>
</div>
</section>
<section class="m_btm_40">
<div class="container">
<div class="row">
<div class="col-md-3" style=" margin-top: 20px; ">
<div class="art_box bg_green_art">
<a href="<?php echo $BaseUrl . '/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&btnArtSearch=Search' ?>">
<p>View All <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl ?>/assets/images/art/art-2.jpg" class="img-responsive">
</a>
</div>
</div>

<div class="col-md-3" style=" margin-top: 20px; ">
<div class="art_box bg_orange">
<!--best-seller.php-->
<a href="<?php echo $BaseUrl . '/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Art=art&btnArtSearch=Search' ?>">
<p>View All Arts<span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl ?>/assets/images/art/art-1.jpg" class="img-responsive">
</a>
</div>
</div>

<div class="col-md-3" style=" margin-top: 20px; ">
<div class="art_box bg_purple">
<a href="<?php echo $BaseUrl . '/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Craft=craft&btnArtSearch=Search'; ?>">
<p>View All Crafts<span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl ?>/assets/images/art/art-3.jpg" class="img-responsive">
</a>
</div>
</div>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<div class="col-md-3" style=" margin-top: 20px; ">
<div class="art_box bg_green_parot">
<a href="<?php echo $BaseUrl . '/artandcraft/dashboard/'; ?>">
<p>Dashboard <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl ?>/assets/images/art/art-4.jpg" class="img-responsive">
</a>
</div>
</div> <?php } ?>
</div>
<div class="space-lg"></div>
<section class="section_event_art">
<div class="row">

<div class="col-md-12 text-center">
<h2>New <span>Listings</span></h2>
</div>


<div class="col-md-12">
<div class="tab-content no-radius otherTimleineBody m_top_20">
<!--NewarivalArt-->
<div role="tabpanel" class="tab-pane active" id="newarivalArt">
<?php
include('new-arrival.php');
?>
</div>

</div>
</div>
</div>
</section>
</div>
</section>

<section class="section_event_art">
<div class="container">
<div class="row">

<div class="col-md-12 text-center">
<h2>Art <span>Events</span></h2>

</div>

</div>
<div class="owl-carousel owl-theme ">
<?php
$start = 0;
$limit = 1;
$p      = new _postingviewartcraft;
$pf     = new _postfield;
//9 is a category id of events
$res    = $p->publicpost_event(9);

//echo $p->ta->sql;
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
//posting fields
//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if ($result_pf) {
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if ($venu == '') {
if ($row2['spPostFieldName'] == 'spPostingEventVenue_') {
$venu = $row2['spPostFieldValue'];
}
}
if ($startDate == '') {
if ($row2['spPostFieldName'] == 'spPostingStartDate_') {
$startDate = $row2['spPostFieldValue'];
}
}
if ($startTime == '') {
if ($row2['spPostFieldName'] == 'spPostingStartTime_') {
$startTime = $row2['spPostFieldValue'];
}
}
if ($endTime == '') {
if ($row2['spPostFieldName'] == 'spPostingEndTime_') {
$endTime = $row2['spPostFieldValue'];
}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}
?>
<div class="item">
<div class="artEventBox">
<p class="date"><?php echo $startDate; ?></p>
<a href="<?php echo $BaseUrl . '/artandcraft/event-detail.php?postid=' . $row['idspPostings']; ?>">
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}
?>
</a>
<div class="artEventBox-body">
<?php
if (strlen($row['spPostingtitle']) < 20) {
?>
<a class="title" href="<?php echo $BaseUrl . '/artandcraft/event-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo ucfirst(strtolower($row['spPostingtitle'])); ?></a>
<?php
} else {
?>
<a class="title" href="<?php echo $BaseUrl . '/artandcraft/event-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo ucwords(substr(strtolower($row['spPostingtitle']), 0, 20)) . '...'; ?></a>
<?php
}
?>

<!-----<p class="desc">
<?php
// if(strlen($row['spPostingNotes']) < 55){

//     echo $row['spPostingNotes'];

// }else{

//  echo substr($row['spPostingNotes'], 0,55)."...";

// }
?>
</p>---->
<div class="text-center">
<a href="<?php echo $BaseUrl . '/artandcraft/event-detail.php?postid=' . $row['idspPostings']; ?>" class="btn btn-tsp text-center btn-border-radius">View Detail</a>
</div>
</div>

</div>
</div> <?php
}
}
?>



</div>
</div>

</section>
<section class="topPohotoshome">
<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6 titleTop text-center">
<h2>New <span>Listings</span></h2>
<!--<h2>Top <span>artandcraft</span> this week</h2>
<p>Stunning new images available exclusively on TSP</p>-->
</div>
<!---<div class="col-md-3 text-right">
<a class="btn btn-tsp" href="<?php echo $BaseUrl . '/artandcraft/top-artandcraft.php'; ?>">More artandcraft</a>
</div>-->
</div>
<div class="space-lg"></div>
<div class="row">
<?php

$start = 0;
$limit = 1;
$p = new _postingviewartcraft;
$res = $p->publicpost($_GET["categoryID"]);

//var_dump($res);die;
$numrowsw = $res->num_rows;

//echo $p->ta->sql;
if ($account_status != 1) {
if ($res) {

while ($row = mysqli_fetch_assoc($res)) {
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($row['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($res2 != false) { ?>

<?php

$rp = mysqli_fetch_assoc($res2);

if (empty($pic2)) {
$pic2 =  $BaseUrl .'/img/no.png';
} else {
$pic2 = $rp['spPostingPic'];
}
//echo "<pre/>";
// print_r($row);					//die('-----000----');
?>


<div class="col-md-3">
<div class="artBox">
<div class="topartBox">
<?php if (!empty($row['discountphoto'])) { ?>
<a class="btn btn_custom bg_purple btn-border-radius" style="cursor: default;">Sale</a>
<?php } ?>
<a class="btn btn_custom bg_green_art btn-border-radius" style="cursor: default;">New</a>
<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row['idspPostings']; ?>">

<img alt="Posting Pic" src="<?php echo $pic2; ?>" class="img-responsive"> </a>
<a class="title22" href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row['idspPostings']; ?>" title="" data-toggle="tooltip" data-original-title="">
</a>
<p>

<a class="title111" href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row['idspPostings']; ?>">
<?php echo $row['spPostingTitle']; ?></a>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php if($row['spPostingPrice'] > $row['discountphoto']) { ?>

<?php

$curr = "";


if (empty($row['spPostingPrice'])) {
echo "<span class='price'>Free</span>";
} else {
if (empty($row['discountphoto'])) {
echo '<span class="price">' . $row['defaltcurrency'] . ' ' . $row['spPostingPrice'] .  '  </span>';
} else {
echo '<span class="price">' . $row['defaltcurrency'] . ' ' . $row['discountphoto'] .  '  </span>';
}
}
if (empty($row['discountphoto'])) {
} else {
echo '<span class="price text-success" style="color:green;"> <del> ' . $row['defaltcurrency'] . ' ' . $row['spPostingPrice'] .  '  </del></span>';

$perto =  ($row['spPostingPrice'] - $row['discountphoto']) / $row['spPostingPrice'] * 100;
echo '  (' . round($perto, 2) . '%)  ';
}
if ($row['sippingcharge'] == 1) {

echo '<br>  <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
} else {

echo '<br><br>';
}
?>
<?php } else {
if (empty($row['spPostingPrice'])) {
echo "<span class='price'>Free</span>";
} else {
if (empty($row['discountphoto'])) {
echo '<span class="price">' . $row['defaltcurrency'] . ' ' . $row['spPostingPrice'] .  '  </span>';
} else {
echo '<span class="price">' . $row['defaltcurrency'] . ' ' . $row['discountphoto'] .  '  </span>';
}
}
?>

<?php } ?> 

</div>
</div>
</div>
<div class="btmartBox">
<ul class="social">

<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<li>


<div id="adremovetoboard<?php echo $row['idspPostings']; ?>">
<?php

$aap = new _addtoboard;

$result = $aap->chkExist($row['idspPostings'], $_SESSION['pid']);
if ($result != false) {  ?>

<a class="removetoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" data-toggle="tooltip" title="Remove to board"><i class="fa fa-times-circle-o" style="color:white;font-size:27px;"></i></a>
<?php	} else { ?>

<a class="addtoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" data-toggle="tooltip" title="Add to board">
<img src="<?php echo $BaseUrl ?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php		}
?>

</div>


</li>

<!--	<li data-toggle="tooltip" title="" data-original-title="Share"><a href="javascrpit:void(0)" data-toggle="modal" data-target="#myshare"><span class="sp-share-art" data-postid="<?php echo $row['idspPostings']; ?>" src="<?php echo $pic2; ?>"><img src="https://dev.thesharepage.com/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>-->
<?php } ?>
<li><a href="<?php echo $BaseUrl ?>/artandcraft/detail.php?postid=<?php echo $row['idspPostings']; ?>" data-toggle="tooltip" title="" data-original-title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>


</ul>
</div>
</div>
</div>
<?php
$limit++;
}
if ($limit > 8) {
break;
}
}
}
} else {
echo "<span style='font-size:20px;margin-left:512px;'>No New Listings</span>";
}
?>



</div>
</div>
</section>


<section class="artExhibition">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="titleTop text-center">
<h2>Art <span>Exhibition</span></h2>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="fulmainarttab">
<ul class='nav nav-tabs' id='navtabart' style="width: 26%;">
<li role="presentation" class="active"><a href="#upcomingArt" aria-controls="home" role="tab" data-toggle="tab">Upcoming</a></li>
<li role="presentation"><a href="#recentArt" aria-controls="home" role="tab" data-toggle="tab">Recent</a></li>
<li role="presentation"><a href="#previousArt" aria-controls="home" role="tab" data-toggle="tab">Previous</a></li>

</ul>
<div class="linebtm"></div>
</div>
</div>
<div class="col-md-12">
<div class="tab-content no-radius m_top_20">
<!--upcomingArt-->
<div role="tabpanel" class="tab-pane active" id="upcomingArt">
<?php
include('upcoming.php');
?>
</div>
<!--recentArt-->
<div role="tabpanel" class="tab-pane" id="recentArt">
<?php
include('recent.php');
?>
</div>
<!--previousArt-->
<div role="tabpanel" class="tab-pane" id="previousArt">
<?php
include('previous.php');
?>
</div>

</div>
</div>
</div>
</div>
</section>
<?php if ($account_status != 1) { ?>
<section class="cateHomeArt">
<div class="container">
<div class="row keywordbox ">
<div class="col-md-12">
<div class="titleTop text-center m_btm_40">
<h2>Browse Arts by Category</h2>
</div>
</div>

<?php
$m = new _subcategory;
$catid = 13;
$result = $m->art_subcategoryalllist();

//echo $m->ta->sql; die;

$p = new _postingviewartcraft;

$rowCount = 1;
$colCount = 1;
if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
$count = 0;
$res = $p->sameCategoryPiccateart($rows["idspArtgallery"], 13);

//echo $p->ta->sql; die;

if ($res != false) {
$count = $res->num_rows;
} else {
$count = 0;
}
if ($rowCount == 1) {
echo '<div class="col-md-3 pad_left_right_5">';
}
if (strlen($rows["subCategoryTitle"]) < 20) {
?>
<a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspArtgallery']; ?>&for=art&page=1" class=""><?php echo ucfirst(strtolower($rows["spArtgalleryTitle"])); ?> <span class="pull-right">(<?php echo $count; ?>)</span></a>
<?php
} else {
?>
<a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspArtgallery']; ?>&for=art&page=1" class=""><?php echo substr(ucfirst(strtolower($rows["spArtgalleryTitle"])), 0, 20) . "..."; ?> <span class="pull-right">(<?php echo $count; ?>)</span></a>
<?php
}

?>
<?php
if ($colCount == 4) {
$rowCount = 0;
$colCount = 0;
}

if ($rowCount == 0) {
echo '</div>';
}
$rowCount++;
$colCount++;
}
if ($rowCount != 0) {
echo '</div>';
}
}
?>
</div>
</div>
</section>
<section class="cateHomeArt">
<div class="container">
<div class="row keywordbox ">
<div class="col-md-12  del">

<div class="titleTop text-center m_btm_40">
<h2>Browse Crafts by Category</h2>
</div>
</div>

<?php
$m = new _subcategory;
$catid = 13;
$result = $m->craft_categoryalllist();

$p = new _postingviewartcraft;

$rowCount = 1;
$colCount = 1;
if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
//print_r($rows); die;
$count = 0;
$res = $p->sameCategoryPiccatecraft($rows["idspCraftgallery"], 13);

//echo $p->ta->sql; die;

if ($res != false) {
$count = $res->num_rows;
} else {
$count = 0;
}
if ($rowCount == 1) {
echo '<div class="col-md-3 pad_left_right_5">';
}
if (strlen($rows["subCategoryTitle"]) < 20) {
?>
<a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspCraftgallery']; ?>&for=craft&page=1" class=""><?php echo ucfirst(strtolower($rows["spCraftgalleryTitle"])); ?> <span class="pull-right">(<?php echo $count; ?>)</span></a>
<?php
} else {
?>
<a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspCraftgallery']; ?>&for=craft&page=1" class=""><?php echo substr(ucfirst(strtolower($rows["spCraftgalleryTitle"])), 0, 20) . "..."; ?> <span class="pull-right">(<?php echo $count; ?>)</span></a>
<?php
}

?>
<?php
if ($colCount == 4) {
$rowCount = 0;
$colCount = 0;
}

if ($rowCount == 0) {
echo '</div>';
}
$rowCount++;
$colCount++;
}
if ($rowCount != 0) {
echo '</div>';
}
}
?>
</div>
</div>
</section>
<?php } ?>
<?php include('postshare.php'); ?>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
}
?>
