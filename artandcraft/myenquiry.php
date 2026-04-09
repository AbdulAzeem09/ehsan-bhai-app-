<?php 
include('../univ/baseurl.php');
session_start();
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
<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
</head>

<body class="bg_gray">
<?php 
$header_photo = "header_photo";
include_once("../header.php");
?>
<section class="innerArtBanner">
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center;">My Enquiry</h1>
</div>
<?php include('top-search.php');?>
</div>
</div>
</section>
<!---- <section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>
</div>
</section> --->
<div class="space"></div> 
<section class="">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>

<li class="breadcrumb-item active" aria-current="page">My Enquiry</li>
</ol>
</nav>
</div>
</div>
<?php
if($_SESSION['ptid'] == 3){ 
$totalEnquery = 0;
$ag = new _artgalleryenquiry;
$result2 = $ag->readMyEnquery($_SESSION['pid']);
if($result2 != false){
$totalEnquery = $result2->num_rows;
}else{
$totalEnquery = 0;
}
?>
<div class="row">
<div class="col-md-12">
<a href="<?php echo $BaseUrl.'/artandcraft/enquiryReceived.php';?>" class="btn btn_morePhoto pull-right m_btm_5 btn-border-radius">Enquiry Received(<?php echo $totalEnquery;?>)</a>
</div>
</div> <?php
} 

include('top-dashboard.php');
?>

<div class="row">
<div class="col-md-12">

<div class="table-responsive">
<table class="table table-striped table-bordered text-center myEnqueryTab">
<thead>
<tr>
<th>Id</th>
<th>Id</th>
<th>Product Title</th>
<th>Date</th>
<th>Type</th>
<th>Detail</th>
</tr>
</thead>
<tbody>
<?php
$ag = new _artgalleryenquiry;
$result = $ag->readMyEnquery($_SESSION['pid']);
var_dump($result);
if($result != false){
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
$dt = new DateTime($row['enquiryDate']);
$p = new _postingview;
$pf  = new _postfield;

$result2 = $p->singletimelines($row['spPosting_idspPosting']);
//echo $p->ta->sql;
if($result2 != false){
$row2  = mysqli_fetch_assoc($result2);
//print_r($row2);
$ProName = $row2['spPostingTitle'];
$ProId = $row2['idspPostings'];
}
?>
<tr>
<td></td>
<td><a href="<?php echo $BaseUrl.'/artandcraft/enquiry.php?event='.$ProId;?>"><?php echo $ProName;?></a></td>
<td><?php echo $dt->format('d-M-y');?></td>
<td>
<?php 
if($row['enquiryType'] == -2){
echo "Exebition";
}elseif($row['enquiryType'] == -3){
echo "Events";
}else{
echo "Art Gallery";
}
?>
</td>
<td><a href="<?php echo $BaseUrl.'/artandcraft/enquiry.php?event='.$ProId;?>" class="btn btn-success btn-border-radius">View Detail</a></td>
</tr>
<?php
}
}
?>



</tbody>
</table>
</div>
</div>
</div>
</div>
</section>

<div class="space"></div>
<?php 
include('../component/footer.php');
include('../component/btm_script.php'); 
?>
</body>
</html>
