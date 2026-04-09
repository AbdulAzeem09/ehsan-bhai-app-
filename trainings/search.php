<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "trainings/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "8";
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";

$topPage = 1;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>

<section>
<div class="row no-margin">
<div class="col-md-3 no-padding">
<?php 
include('../component/left-training.php');
?>
</div>
<div class="col-md-9 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active" id="video1">
<div class="row">
<div class="col-md-12 topVdoBread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/trainings';?>"><i class="fa fa-home"></i></a></li>
<?php
$ac = new _artCategory;
if(isset($_GET['catName'])){
?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['catName'];?></li><?php

}else{ ?>
<li class="breadcrumb-item active" aria-current="page">Search</li> <?php
}
?>
</ol>
</nav>
</div>
</div>
<div class="bg_white" style="padding: 20px;">

<div class="row ">
<?php

$start = 0;
$limit = 15;
$p = new _postings;
$trainingname =$_POST['txtSearchProject'];
if (isset($trainingname)) {
$res = $p->find_project($trainingname);
}

//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {
?>
<div class="col-md-3">
<div class="course_Box">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">
<?php
$pic = new _postings;
$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
if($res2 != false){                                                
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['filename'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' ".$BaseUrl .'/post-ad/uploads/'. ($pic2) . "' >"; 

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>
</a>
</div>
<div class="innerBoxvdo" style="padding:6px;">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingTitle'];?>" style="font-size:16px;">
<?php 
if(strlen($row['spPostingTitle']) < 15){
echo $row['spPostingTitle'];
}else{
echo substr($row['spPostingTitle'], 0,15)."...";
} 
?>     
</a>
<?php
$p = new _spprofiles;
$pres1 = $p->readUserId($row['buyer_uid']);
if($pres1 != false){
$prow = mysqli_fetch_assoc($pres1);
?>
<a href="<?php echo $BaseUrl.'/trainings/intructor-detail.php?intructor='.$prow['idspProfiles']?>" class="name"><?php echo $prow['spProfileName']; ?></a>
<?php

}
?>
<!--<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="btn butn_train_cart" style="margin-left:-8px;">Add To Cart</a>-->
</div>

<?php 
$price      = $row['spPostingPrice'];
$txtDiscount=$row['txtDiscount'];

//echo $price.'hello';
//echo $txtDiscount;   

if($price!='' && $txtDiscount!=''){

$discountedPrice = $price - ($price* ($txtDiscount/100));   
?>

<style>
	#piddd{
		float: left!important; 
	}
	</style>  
	<small style="margin-left:5px!important;">(<?php echo $row['trainingcategory']; ?>)</small> 
<p  style="margin-left: 5px;"><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$discountedPrice:'Free';?>

	<del class="text-success" style="/* color:green; */"><?php echo ($price > 0)?$row['default_currency'].' '.$price:'';?></del>  
	
</p>
<?php
}else{

?>
<p style="margin-left: 5px;"><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$row['spPostingPrice']:'Free';?></p>

<?php } ?>

</div>
</div>
<?php
}
}else{
echo "No more categories!";
}

?>
</div>
</div>


</div>
</div>
</div>


</div>
</div>

</div>
</div>
</section>
<div class="space-lg"></div>

<?php 
include('../component/f_footer.php');
//include('../component/btm_script.php'); 
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>