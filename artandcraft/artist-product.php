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

if(isset($_GET['cat']) AND $_GET['cat']>0){
if($_GET['cat'] == 1){
$breadcrumb = "Visual Artist";
}else if($_GET['cat'] == 2){
$breadcrumb = "Graphics Designer";
}else if($_GET['cat'] == 3){
$breadcrumb = "Contemporary";
}else if($_GET['cat'] == 4){
$breadcrumb = "Animation";
}else if($_GET['cat'] == 5){
$breadcrumb = "Musician";
}
}
//read the artist detail
if(isset($_GET['artist']) && $_GET['artist'] >0){
$p = new _spprofiles;
$result2 = $p->read($_GET['artist']);
if($result2 != false){
$row2 = mysqli_fetch_assoc($result2);
$ArtistName = $row2['spProfileName'];
}
}else{
$re = new _redirect;
$redirctUrl = "../photos";
$re->redirect($redirctUrl);
//header('location:../photos');
}
$header_photo = "header_photo";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<link rel='stylesheet prefetch' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>

<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
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
<h1>Art Gallery</h1>
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

<section class="m_btm_40">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/photos/artist.php?cat='.$_GET['cat'];?>"><?php echo $breadcrumb;?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo $ArtistName;?></li>
</ol>
</nav>
</div>
</div>
<div class="row">
<div class="col-md-3">
<?php
$m = new _masterdetails;
include('../component/left-artGallery.php');
?>
</div>
<div class="col-md-9 no-padding">
<div class="row">
<?php
$pv = new _postingview;
$result3 = $pv->totalArtistArt($_GET['artist'], $_GET["categoryID"]);
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<div class="col-md-4">
<div class="artBox m_btm_20">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>" >
<?php
$pic = new _postingpic;
$res2 = $pic->read($row3['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else{
echo "<a href='../img/no.png' class='test-popup-link' title='".$row3['spPostingtitle']."'><img alt='Posting Pic' src='../img/no.png' class='img-responsive'></a>"; ?>
<?php
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>"><?php echo $row3['spPostingtitle'];?></a>
<p>
<?php
if(strlen($row3['spPostingNotes']) < 80){
echo $row3['spPostingNotes'];
}else{
echo substr($row3['spPostingNotes'], 0,80)."...";

} ?>
</p>

<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row3['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
echo '<span class="price">$ '.$row3['spPostingPrice'].'</span>';
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul class="social">
<li><a href="javascrpit:void(0)" class="addtoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>
<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row3['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="Add to cart"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-cart.png" alt="" class="img-responsive"></a></li>
</ul>
</div>
</div>
</div>
<?php
}
}

?>

</div>

</div>
</div>

</div>
</section>

<?php include('postshare.php');?>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<script type="text/javascript">
$( function() {
$( "#slider-range" ).slider({
range: true,
min: 0,
max: 5000,
values: [ 1000, 4000 ],
slide: function( event, ui ) {
$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
}
});
$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
} );
</script>
<!-- price ranger end -->
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
}
?>