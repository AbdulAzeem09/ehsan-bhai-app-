<?php 
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "photos/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = 13;

if(isset($_GET['exe']) && $_GET['exe'] > 0){
$exe = $_GET['exe'];
$ex = new _exhibition;
$result = $ex->readName($exe);
if($result != false){
$rowe = mysqli_fetch_assoc($result);
$ExhibitionName = $rowe['spExhibitionTitle'];
}

}else{
header('location:../photos');
}

?>
<!DOCTYPE html>

<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
</head>

<body class="bg_gray">
<?php include_once("../header.php");?>
<section class="innerArtBanner">
<div class="container">
<div class="row">
<div class="col-md-offset-2 col-md-8">
<h1>Exhibition</h1>
</div>
<div class="col-md-offset-2 col-md-8">
<div class="innerFormTop">
<form class="form-inline" method="post" action="search.php">
<div class="row">
<div class="col-md-12">
<div class="form-group" style="width: 100%;">
<input type="hidden" name="txtSearchCategory" value="<?php echo $_GET["categoryID"];?>">
<input type="text" class="form-control" name="txtArtSearch" placeholder="Search images, vector, illustration">
<input type="submit" name="btnArtSearch" class="btn btn_searchArt btn-border-radius" value="Search">
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>
</div>
</section> 
<div class="space"></div> 
<section class="">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>

<li class="breadcrumb-item" aria-current="page"><a href="<?php echo $BaseUrl.'/photos/all-exhibition.php?cat='.$_GET['cat'];?>">Exhibition</a></li>
<li class="breadcrumb-item" aria-current="page"><?php echo $ExhibitionName;?></li>
</ol>
</nav>
</div>
</div>
<div class="row">
<?php
$start = 0;
$limit = 1;
$p = new _postingview;
$pf  = new _postfield;
$eventVisibility = -2;
$res = $p->showExhibitionArt($eventVisibility, $_GET["categoryID"], $exe);
//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {
//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$imgSize    = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($imgSize == ''){
if($row2['spPostFieldName'] == 'imagesize_'){
$imgSize = $row2['spPostFieldValue'];

}
}

}
}
?>
<div class="col-md-3">
<div class="righEngquiryProduct">
<div class="mainOverlay">
<?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<div class="overlay">
<div class="text">
<a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingtitle']; ?>'><i class="fa fa-search-plus"></i></a>
<a href="<?php echo $BaseUrl.'/photos/enquiry.php?event='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
</div>
</div> <?php
} else{
echo "<a href='../img/no.png' class='test-popup-link' title='".$row['spPostingtitle']."'><img alt='Posting Pic' src='../img/no.png' class='img-responsive'></a>"; ?>
<div class="overlay">
<div class="text">No Image</div>
</div> <?php
} ?>
</div>
<a href="<?php echo $BaseUrl.'/photos/enquiry.php?event='.$row['idspPostings'];?>">

<h3><?php echo $row['spProfileName'];?><br>
<?php echo $imgSize;?> Code: EX00<?php echo $row['idspPostings'];?><br>
<?php echo $row['spPostingtitle'];?>
</h3>
<div class="text-center">
<span class="btn btn_art_orng btn-border-radius">Enquiry</span>
</div>
</a>
</div>
</div>
<?php
}
}
?>

</div>
</div>
</section>
<section class="cateHomeArt">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="titleTop text-center m_btm_40">
<h2>Browse Pictures by category</h2>
</div>
</div>
<?php
$p = new _postingview;
$m = new _masterdetails;
$masterid = 14;
$rowCount = 1;
$colCount = 1;
$result = $m->read($masterid);
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
$count = 0;
$res = $p->sameCategoryPic($rows["masterDetails"], 13);
if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}
if($rowCount == 1){
echo '<div class="col-md-3">';
}

?>
<a href="<?php echo $BaseUrl.'/photos/shop-top-category.php?catName='.$rows['idmasterDetails'];?>" class=""><?php echo $rows["masterDetails"];?> <span>(<?php echo $count;?>)</span></a> <?php

if($colCount == 6){
$rowCount = 0;
$colCount = 0;
}

if($rowCount == 0){
echo '</div>';
}
$rowCount++;
$colCount++;

}
if($rowCount != 0){
echo '</div>';
}
}
?>
</div>
</div>
</section>
<div class="space"></div>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}
?>