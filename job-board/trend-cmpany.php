<?php

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-3">
<?php include('../component/left-jobboard.php');?>
</div>
<div class="col-md-9 no-padding">
<?php 
include('top-job-search.php');
//include('inner-breadcrumb.php');
?>
<div class="space"></div>
<!-- repeat able box -->
<div class="bg_white" style="min-height: 300px;border: 1px solid #CCC;padding: 10px 20px; ">
<h3 class="heading05">Trending Companies</h3>
<div class="row">
<div class="col-sm-12">
<?php
$limitpr = 10;
$p = new _postingview;
$pro = new _spprofiles;
$result3 = $pro->readBusProfiles($limitpr);
//echo $pro->ta->sql;
if($result3){
while ($row3 = mysqli_fetch_assoc($result3)) {

//get company
$c = new _profilefield;
$r = $c->read($row3['idspProfiles']);
if($r){
$cmpnyName = '';
$CmpnySize = '';
while ($row4 = mysqli_fetch_assoc($r)) {
if($cmpnyName == ''){
if($row4['spProfileFieldName'] == 'companyname_'){
$cmpnyName = $row4['spProfileFieldValue']; 
}
}
if($CmpnySize == ''){
if($row4['spProfileFieldName'] == 'CompanySize_'){
$CmpnySize = $row4['spProfileFieldValue']; 
}
}
}
}else{
$cmpnyName = "Not Define";
}

//get the total post which is open 
$result5 = $p->readOpenJobs($row3['idspProfiles']);
//echo $p->ta->sql;
if($result5){
$totalJob = $result5->num_rows;
}else{
$totalJob = 0;
}

?>
<div class="trndpost">
<?php
$result4 = $pro->read($row3['idspProfiles']);
if ($result4 != false) {
$row4 = mysqli_fetch_assoc($result4);
if (isset($row4["spProfilePic"])){
echo "<img alt='profile pic' class='img-responsive' src=' " . ($row4["spProfilePic"]) . "'  >";
}else{
echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
}
}
?>
<div class="">
<p class="titlejob">
<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$row4['idspProfiles'];?>"><?php echo $cmpnyName;?></a> 
<span class="pull-right">
<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$row4['idspProfiles'];?>"><?php echo $totalJob; ?> Position openings </a>
</span>
</p>
<p class="postingng">Company Size: <?php echo ($CmpnySize == '')? "Not Define": $CmpnySize;?></p>
</div>
</div><?php
}
}
?>
</div>
</div>
</div>
<!-- repeat able box end -->


</div>
</div>
</div>
</section>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
} ?>