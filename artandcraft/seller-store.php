<?php 
// 	error_reporting(E_ALL);
// ini_set('display_errors', 'On');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once ("../authentication/check.php");

}else{


function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = 13;
$header_photo = "header_photo";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- this script for slider art -->



<style>
body {
font-family: 'Roboto', sans-serif;
font-size: 14px;
line-height: 18px;
background: #f4f4f4;
}

.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-item {
border: 1px solid #EEE;
background: #FFF;
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
background-color: #e7a0ff;
border-color:  #cf2deb;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #cf2deb;
}



</style>
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
</head>

<body class="bg_gray">
<?php include_once("../header.php");?>
<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">

<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Your current profile does not have <br>access to this page. Please create or  switch<br> your current profile to either  <span>"Professional Profile"</span> to access this page.</h2>
<div class="space-md"></div>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
<a href="<?php echo $BaseUrl.'/artandcraft';?>" class="btn">Back to Home</a>
</div>

</div>
</div>
</div>
<section class="main_box no-padding" id="art-page">
<div class="col-xs-12 art_banner text-center">
<div class="container">

<h1>Beautiful, High-Resolution Free artandcraft with No Restrictions</h1>
<p>For personal or commercial projects, artandcraft added  every day. No royalties, no fees, no worries. Enjoy !</p>
<?php
if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 1){ 
$u = new _spuser;
// IS EMAIL IS VERIFIED
$p_result = $u->isverify($_SESSION['uid']);
if ($p_result == 1) {
$pv = new _postingview;
$reuslt_vld = $pv->chekposting(13,$_SESSION['pid']);
if ($reuslt_vld == false) {
?>
<a href="<?php echo $BaseUrl.'/post-ad/photos/?post';?>">Sell Your Art Work today!</a>
<?php
}

}else{
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' >Sell Your Art Work today!</a>
<?php
}
}else{
?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' >Sell Your Art Work today!</a> <?php
}
?>

<form class="form-inline" method="post" action="search.php">
<div class="row">
<div class="col-md-offset-2 col-md-8">
<div class="form-group" style="width: 100%;">
<input type="hidden" name="txtSearchCategory" value="<?php echo $_GET["categoryID"];?>">
<input type="text" class="form-control" name="txtArtSearch" placeholder="Search images, vector, illustration" required>
<!-- <select class="form-control">
<option value="visual Artist">Visual Artist</option>
<option value="Graphics Designer">Graphics Designer</option>
<option value="Contemporary">Contemporary</option>
<option value="Animation">Animation</option>
<option value="Musician">Musician</option>
</select> -->
<input type="submit" name="btnArtSearch" class="btn btn_searchArt btn-border-radius" value="Search">
</div>
</div>
</div>
</form>
</div>
</div>
</section>
<section class="m_btm_40">
<div class="container">
<!---<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>--->

<?php
$prs = new _spprofiles;
$result12 = $prs->read($_GET['profileid']);
$resprofile = mysqli_fetch_array($result12);
$profile_name=$resprofile['spProfileName'];
?>
<div class="space-lg"></div>
<section class="section_event_art">
<div class="row">

<div class="col-md-12 " style=" margin-top: 20px; ">

<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl ?>/artandcraft"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item active" aria-current="page" style="  text-transform: uppercase;
"><?=$profile_name?></li>                             </ol>
</nav>
</div>

<h2 class="text-center">More Work By <span>

<?=$profile_name?>

</span></h2>
</div>


<div class="col-md-12">
<div class="tab-content no-radius otherTimleineBody m_top_20">
<!--NewarivalArt-->
<div role="tabpanel" class="tab-pane active" id="newarivalArt">


<div class="row list-wrapper">
<?php

$p = new _postingviewartcraft;
$res = $p->publicpostprofileid($_GET['profileid'], $_GET["categoryID"]);
         // print_r($res);
	   // die("++++++++++++++++++++++++++++++++");
	   $count=mysqli_num_rows($res);
//var_dump($res);
//if($res!=false){
$numrowsw =$res->num_rows; 
//echo $numrowsw; die;
//echo $p->ta->sql; die;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 
// print_r($row);
?>
<div class="col-md-3 list-item">
<div class="artBox">

<div class="topartBox">
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">

<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";

} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" title="<?php echo $row['spPostingtitle']; ?>" data-toggle="tooltip" >
<?php 
if (strlen($row['spPostingtitle']) < 28) {
echo $row['spPostingtitle'];
}else{
echo substr($row['spPostingtitle'], 0,28)."...";
}

?>
</a>
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

<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>


</ul>
</div>
</div>
</div> <?php
$limit++; 

}
}
?>
</div>
<?php
if($count >=8){

?>
<div id="pagination-container"></div>
<?php
}
?>
<?php 
if($res==false){
echo "<span style='font-size:20px; margin-left:430px;'>No Products Found</span>";

}

?>




<div class="row">	
<div class="col-md-6" style=" text-align: left; ">
<?php

/*  $psn = new _postingview;
$resallcount = $psn->publicpostprofileidcount($_GET['profileid'],13);
//echo $psn->tur->sql; die;
// print_r($resallcount);die('====');
$allprocount = mysqli_num_rows($resallcount);

$pre = $_GET['page']-1;
$nex = $_GET['page']; 
$c2 = $nex*$numrowsw;

if($pre==0){
$c1 = 1;
}else{
$c1 = $pre*16;			
if($c1*2 != $c2){
$c2 = $allprocount;
}
}



echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';
*/
?>
</div>	

<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

<a href="seller-store.php?profileid=<?php echo $_GET['profileid']; ?>&page=<?php echo $_GET['page']-1 ;?>">Previous</a>

<?php } ?>

<?php if($_GET['page']!=1 && $numrowsw==15){ ?>

<span> || </span>

<?php } ?>

<?php if($numrowsw==16){ ?>	

<a href="seller-store.php?profileid=<?php echo $_GET['profileid']; ?>&page=<?php echo $_GET['page']+1 ;?>">Next</a>

<?php } ?>
</div>
</div>






</div>

</div>    
</div>
</div>
</section>
</div>
</section>


<?php include('postshare.php');?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 8;

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

