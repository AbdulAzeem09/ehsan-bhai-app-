<?php



// ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);



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
<style>
.rating-box {
position:relative!important;
vertical-align: middle!important;
font-size: 14px;
font-family: FontAwesome;
display:inline-block!important;
color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before{
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute!important;
left:0;
top:0;
white-space:nowrap!important;
overflow:hidden!important;
color: Gold!important;

}
.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}
.dropdown-menu {
	border: none!important;
}
#profileDropDown li.active {
    background-color: #417281!important;
}
#profileDropDown li.active a {
color: #fff!important; 
}
</style>
</head>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
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
<li class="breadcrumb-item active" aria-current="page">Available Course</li> <?php
}
?>
</ol>
</nav>
</div>
</div>
<div class="bg_white" style="padding: 20px;">

<div class="row ">
<?php
$p = new _postings;
if(isset($_GET["filter_btn"])){
	$data=$_GET["subCategory_id"];
	$i=0;
	$st=" ";
	 if($i){
	while($i<sizeof($data)){
		$d=$data[$i];
		$st .= "'$d',";
		
		$i++;
	}
}
	
	$res = $p->read_all_training_category(substr($st, 0, -1));
	
}

else{

$res = $p->read_all_training();
}
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {
	//print_r($row);
	//die('=====');
?>
<div class="col-md-3">
<div class="course_Box">
<div class="img_fe_box">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">
<?php
$pic = new _postings;
//echo $row['id'];
$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
if($res2 != false){                                                
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['filename'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' >"; 

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>

</a>
</div>
<div class="innerBoxvdo" style="height: 100px!important;">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingTitle'];?>" >
<?php 
if(strlen($row['spPostingTitle']) < 12){
echo $row['spPostingTitle'];
}else{
echo substr($row['spPostingTitle'], 0,12)."...";
} 
?>     
</a><br>
<?php 
$bR = new _trainingrating;
$resultsum1 = $bR->readrating($row['id']);
//$totalmyreviews1=0;
if($resultsum1 != false){
$sumrevrating1 = 0;
$totalmyreviews1 = $resultsum1->num_rows;
while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
$sumrevrating1 += $rowreview1['rating'];

}  

$reviewaveragerate1 = $sumrevrating1 / $totalmyreviews1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
} else{
	$totalmyreviews1=0;
}
?>
<p class="rating_box">

<div class="rating-box">
<?php if($totalreviewrate1 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate1 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate1 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate1 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate1 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate1 <= "0") { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>
<small>(<?php echo $row['trainingcategory']; ?>)</small> 
</p>
<?php
$p = new _spprofiles;
$pres1 = $p->readUserId($row['idspProfiles']);
if($pres1 != false){
$prow = mysqli_fetch_assoc($pres1);
?>
<a href="<?php echo $BaseUrl.'/trainings/intructor-detail.php?intructor='.$prow['idspProfiles']?>" class="name"><?php echo $prow['spProfileName']; ?></a>
<?php

}
?>
<br>
<!--<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="btn butn_train_cart" style="margin-left:-8px; ">Add To Cart</a>-->
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
<p id = "piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$discountedPrice:'Free';?>

	<del class="text-success" style="/* color:green; */"><?php echo ($price > 0)?$row['default_currency'].' '.$price:'';?></del>   
</p>
<?php
}else{

?>

<p id = "piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$row['spPostingPrice']:'Free';?></p>

<?php } ?>  
</div>
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
include('../component/btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>