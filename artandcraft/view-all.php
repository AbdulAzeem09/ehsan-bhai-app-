<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1'); 
include('../univ/baseurl.php');

require_once '../backofadmin/library/config.php';


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
<?php include('top-search.php');?>
</section>
<section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<div class="row">
<div class="col-md-12">
<!---<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>--->
</div>
</section>  

<section class="m_btm_40">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/artandcraft';?>"><i class="fa fa-home"></i></a></li>
<?php
$ac = new _artCategory;
if(isset($_GET['catName'])){

$m = new _subcategory;
$result7 = $m->showName($_GET['catName']);
if ($result7) {
$row7 = mysqli_fetch_assoc($result7);
$CatNameNew = $row7['subCategoryTitle'];
}else{
$CatNameNew = "";
}
?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $CatNameNew;?></li><?php

}else{ ?>
<li class="breadcrumb-item active" aria-current="page">All <?php echo ucfirst($_GET['for']); ?></li> <?php
}
?>
</ol>
</nav>
</div>
</div>
<div class="row">
<div class="col-md-3">


<?php include('../component/left-artGallery.php');?> 


</div> 
<div class="col-md-9 no-padding">
<!-- this is plugin for sorting or searching. -->
<!-- <div class="row">
<div class="col-md-9">
<form class="form-inline searchArtRight">
<div class="form-group">
<label>Sorty By</label>
<select class="form-control">
<option>In Stock</option>
<option>Out Stock</option>
</select>
</div>
<div class="form-group">
<label>Show</label>
<select class="form-control">
<option>909000</option>
<option>25</option>
</select>
</div>
</form> 
</div>
</div> -->
<?php include('shop_top_prod.php');?>

<?php if(isset($_GET['catId'])&&isset($_GET['page'])){ ?>	
<div class="row">	
<div class="col-md-6" style=" text-align: left; ">
<?php
//die('===========');

$resallcount = $p->publicpostallcountcat($_GET["catId"], 13, $_GET['for']);
//echo 1;

if($resallcount){
$allprocount = mysqli_num_rows($resallcount);
}

else {
$allprocount = 0;
}
$pre = $_GET['page']-1;
$nex = $_GET['page'];
$c2 = $nex*$numrowsw;

if($pre==0){

$c1 = 1;
}else{
$c1 = $pre*15;			
if($c1*2 != $c2){
$c2 = $allprocount;
}
}

//echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';

?>
</div>	

<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

<a href="shop-top-category.php?catId=<?php echo $_GET['catId']; ?>&for=<?=$_GET['for'];?>&page=<?php echo $_GET['page']-1 ;?>">Previous</a>

<?php } ?>

<?php if($_GET['page']!=1 && $numrowsw==15){ ?>

<span> || </span>

<?php } ?>

<?php if($numrowsw==15){ ?>	

<a href="shop-top-category.php?catId=<?php echo $_GET['catId']; ?>&for=<?=$_GET['for'];?>&page=<?php echo $_GET['page']+1 ;?>">Next</a>

<?php } ?>
</div>
</div>
<?php }else{ ?>						
<div class="row">	
<div class="col-md-6" style=" text-align: left; ">
<?php

$resallcount = $p->publicpostallcount($_GET["categoryID"]);
$allprocount = mysqli_num_rows($resallcount);

$pre = $_GET['page']-1;
$nex = $_GET['page'];
$c2 = $nex*$numrowsw;

if($pre==0){
$c1 = 1;
}else{
$c1 = $pre*15;			
if($c1*2 != $c2){
$c2 = $allprocount;
}
}



echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';

?>
</div>	

<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

<a href="shop-top-category.php?page=<?php echo $_GET['page']-1 ;?>">Previous</a>

<?php } ?>

<?php if($_GET['page']!=1 && $numrowsw==15){ ?>

<span> || </span>

<?php } ?>

<?php if($numrowsw==15){ ?>	

<a href="shop-top-category.php?page=<?php echo $_GET['page']+1 ;?>">Next</a>

<?php } ?>
</div>
</div>
<?php } ?>
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