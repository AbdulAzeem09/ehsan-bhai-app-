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
<!--This script for posting timeline data End-->
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
</head>

<body class="bg_gray">
<?php 
$header_photo = "header_photo";
include_once("../header.php");
?>
<section class="innerArtBanner">
<div class="container">
<div class="row">
<div class="col-md-offset-2 col-md-8">
<h1>Your Board</h1>
</div>
<?php include('top-search.php');?>
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

<li class="breadcrumb-item active" aria-current="page">Your Board</li>
</ol>
</nav>
</div>
</div>
<div class="row" style="min-height: 300px;">
<?php
$atb = new _addtoboard;
$p = new _postingview;

$result = $atb->readMyBoard($_SESSION['pid']);
if($result != false){
while ($rows = mysqli_fetch_assoc($result)) {

$res = $p->singletimelines($rows['spPosting_idspPosting']);
//echo $p->ta->sql;
if($res != false){
$row = mysqli_fetch_assoc($res); 
?>
<div class="col-md-3 <?php echo $row['idspPostings']; ?>">
<div class="artBox">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
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
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
</div>
</div> <?php
} else{
echo "<a href='../img/no.png' class='test-popup-link' title='".$row['spPostingtitle']."'><img alt='Posting Pic' src='../img/no.png' class='img-responsive'></a>"; ?>
<div class="overlay">
<div class="text">No Image</div>
</div> <?php
} ?>
</div>

<a class="title" href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 80){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,80)."...";

} ?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
echo '<span class="price">$ '.$row['spPostingPrice'].'</span>';
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul>
<li><a href="javascrpit:void(0)" class="removetoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove from board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>
<li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Add to cart"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-cart.png" alt="" class="img-responsive"></a></li>
</ul>
</div>
</div>
</div> <?php
}
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
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
}
?>