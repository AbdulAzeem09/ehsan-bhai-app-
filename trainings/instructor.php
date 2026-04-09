<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 'On'); 
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

$_GET["categoryID"] = 8;
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";

$con=mysqli_connect("localhost","theshare_page","mgB81jXxxafr","theshare_share");


$topPage = 2;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>
<style>
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
<li class="breadcrumb-item active" aria-current="page">Instructors</li> 

</ol>
</nav>
</div>
</div>

<div class="bg_white" style="padding: 20px;">

<div class="row ">
<?php
$pr = new _spprofiles;
$f = new _followmusic;
$p = new _postings;
$limit = 10;
$sql = "SELECT DISTINCT spprofiles_idspprofiles FROM  sptraining;";
//echo $sql;
if($res){
$res=mysqli_query($con,$sql);
}

// $res = $p->unique_ids();die;

//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {

$p1=$pr->readprofileid22($row['spprofiles_idspprofiles']);
if($p1!=false){
while($rrr=mysqli_fetch_assoc($p1)){
$pic=$rrr['spProfilePic'];
?>
<div class="col-md-5ths">
<div class="bg_white FollowerBox margin_left_right_10 text-center" id="" style="margin-bottom: 10px;">
<?php
if($pic != ''){
echo "<img alt='Posting Pic' class='img-responsive bigImg' src=' " . ($pic) . "' >"; 
}else{
echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive bigImg'>";
}
?>
<div class="footArtist" style="padding: 10px;">   
<a  style = "color: white;" href="<?php echo $BaseUrl.'/trainings/intructor-detail.php?intructor='.$row['spprofiles_idspprofiles'];?>" class="titleBox" >
<?php 
echo  ucfirst($rrr['spProfileName']);
?>  
</a>
</div>
</div>
</div>
<?php
}} }
} ?>
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
include('postshare.php');
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>