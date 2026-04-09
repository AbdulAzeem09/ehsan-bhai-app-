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
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../timeline/";
}

$_GET["categoryID"] = 13;


?>
<!DOCTYPE html>

<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
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
<h1>Top Photos</h1>
</div>
<div class="col-md-offset-2 col-md-8">
<div class="innerFormTop">
<form class="form-inline" action="search.php">
<div class="row">
<div class="col-md-12">
<div class="form-group" style="width: 100%;">
<input type="hidden" name="txtSearchCategory" value="<?php echo $_GET["categoryID"];?>">
<input type="text" class="form-control" name="txtArtSearch" placeholder="aaaSearch images, vector, illustration">
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

<li class="breadcrumb-item" aria-current="page">Top Photos</li>

</ol>
</nav>
</div>
</div>
<div class="row">
<?php
$start = 0;
$p = new _postingview;
$res = $p->publicpost($start, $_GET["categoryID"]);
//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']); 
if ($res2 != false) {?>
<div class="col-md-3">
<div class="topPhoto">
<div class="mainOverlay">
<?php
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
?>
<div class="overlay">
<div class="text">
<a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingtitle']; ?>'><i class="fa fa-search-plus"></i></a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
</div>
</div>
</div>

</div>
</div>
<?php

}
}
} ?>

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