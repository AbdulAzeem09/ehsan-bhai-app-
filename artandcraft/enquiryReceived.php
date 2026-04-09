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


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php include_once("../header.php");?>
<div id="myEnquery" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">

</div>
</div>
</div>
<section class="innerArtBanner">
<div class="container">
<div class="row">
<div class="col-md-offset-2 col-md-8">
<h1>Enquiry Received</h1>
</div>
<div class="col-md-offset-2 col-md-8">
<div class="innerFormTop">
<form class="form-inline">
<div class="row">
<div class="col-md-12">
<div class="form-group" style="width: 100%;">
<input type="text" name="" class="form-control" placeholder="Search images, vector, illustration">
<select class="form-control">
<option>Images</option>
<option>Photo</option>
<option>video</option>
</select>
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

<li class="breadcrumb-item active" aria-current="page">Enquiry Received</li>
</ol>
</nav>
</div>
</div>
<?php
if($_SESSION['ptid'] == 3){ ?>
<div class="row">
<div class="col-md-12">
<a href="<?php echo $BaseUrl.'/photos/myenquiry.php';?>" class="btn btn_morePhoto pull-right m_btm_5 btn-border-radius">My Enquiry</a>
</div>
</div> <?php
} ?>
<div class="row">
<div class="col-md-12">

<div class="table-responsive">
<table class="table table-striped table-bordered text-center myEnqueryTab">
<thead>
<tr>
<th>Product Title</th>
<th>Profile</th>
<th>Date</th>
<th>Type</th>
<th>Detail</th>
</tr>
</thead>
<tbody>
<?php
$ag = new _artgalleryenquiry;
$result = $ag->readMyEnquery($_SESSION['pid']);
if($result != false){
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['enquiryDate']);
$p = new _postingview;
$pf  = new _postfield;

$result2 = $p->singletimelines($row['spPosting_idspPosting']);
//echo $p->ta->sql;
if($result2 != false){
$row2  = mysqli_fetch_assoc($result2);
$ProName = $row2['spPostingtitle'];
$ProId = $row2['idspPostings'];
}
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/photos/enquiry.php?event='.$ProId;?>"><?php echo $ProName;?></a></td>
<td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['spProfile_idspProfile'];?>"><?php echo $row['enquiryName'];?></a></td>
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
<td><a href="<?php echo $BaseUrl.'/photos/detailMyenqury.php?artgalleryid='.$row['idartenquiry'].'&event='.$ProId;?>" class="btn btn-success btn-border-radius" data-toggle="modal" data-target="#myEnquery">View Detail</a></td>
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
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}
?>
