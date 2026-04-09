<?php
include('../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="my-posts/";
}
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$rfqId = isset($_GET['rfq']) ? (int) $_GET['rfq'] : 0;

if (isset($rfqId) && $rfqId > 0) {

}else{
$re = new _redirect;
$re->redirect("index.php");
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<style type="text/css">

tbody > tr > td, .table > tfoot > tr > td {
padding: 5px!important;

}
/*tbody > tr > td {
width: 300px!important;
}*/

</style>
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!-- <div id="sidebar" class="col-md-2 hidden-xs no-padding">
<?php
// include('../component/left-store.php');
?>
</div> -->
<div class="col-md-12">

<?php 
//  $activePage = 8;
// $storeTitle = " (<small>RFQ Detail</small>)";
//  include('top-dashboard.php');

$r = new _rfq;
$result = $r->rfqRead($rfqId);
if ($result) {
$row = mysqli_fetch_assoc($result);

// print_r($row);
}

?>
<div class="row" style="margin-bottom: 10px;">
<div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 15px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 0px;"> 
<li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

<li><a href="<?php echo $BaseUrl.'/public_rfq'; ?>">Public RFQ</a></li>

<li><a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$rfqId;?>">RFQ Detail</a></li>

</ul>
</div>
</div>  

<?php  if ($row['spProfile_idspProfiles'] == $_SESSION['pid']) {?>
<div class="alert alert-danger">
<strong>This is your product, you can't submit any quote.</strong>
</div>
<?php }?>
<div class="bg_white_border quoteDetail bradius-15">
<div class="row">
<div class="col-md-12">

<div class="row">
<div class="col-md-2">


  <?php
$image = $row['rfqImage'];

$x=0;                                                
$car_img = explode(",",$image);
foreach($car_img as $images){                                                 
$x+=1;

}

if(!empty($images)){ ?>                                            
    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style=" height: 130px; width: 140px;"> 
    <?php
}else{
    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'> style='height: 130px; width: 140px;'";
}

?>     


</div>
<div class="col-md-10">
<h2 class="eventcapitalize">Request For Quote: <?php echo $row['rfqTitle'];?></h2>
<p class="text-justify"><?php echo $row['rfqDesc']; ?></p>
</div>
</div>
<div class="space"></div>
<h2>Features</h2>
<div class="table-responsive">
<table class="table table-striped">
<tbody>
<tr>
    <th style=" width: 300px!important;">Category</th>
   
    <td><?php echo $row['rfqCategory']; ?></td>

</tr>
<tr>
    <th>Quantity required</th>
    <td><?php echo $row['rfqQty']; ?></td>
</tr>
<tr>
    <th>Delivered (Days)</th>
    <td><?php echo $row['rfqDelivered']; ?> Days</td>
</tr>
<tr>
    <th>Country</th>
    <td>
        <?php
        $rc = new _country; 
        $result_cntry = $rc->readCountryName($row['rfqCountry']);
        if ($result_cntry) {
            $row4 = mysqli_fetch_assoc($result_cntry);
            echo $row4['country_title'];
        }
        ?>
    </td>
</tr>
<tr>
    <th>State</th>
    <td>
        <?php
        $st = new _state;
        $result_stat = $st->readStateName($row['rfqState']);
        if ($result_stat) {
            $row6 = mysqli_fetch_assoc($result_stat);
            echo $stateName = $row6['state_title'];
        }
        ?>
    </td>
    
</tr>
<tr>
    <th>City</th>
    <td>
        <?php
        $rcty = new _city;
        $result_cty = $rcty->readCityName($row['rfqCity']);
        if ($result_cty) {
            $row5 = mysqli_fetch_assoc($result_cty);
            echo $cityName = $row5['city_title'];
        }
        ?>
    </td>
</tr>

</tbody>
</table>
</div>
<?php

//  print_r($row['spProfile_idspProfiles']);

//  print_r($_SESSION['pid']);

$pt = new _spprofiles;

$result_profile = $pt->read($_SESSION['pid']);
if ($result_profile) {
$rowpro = mysqli_fetch_assoc($result_profile);
$ProfileTypeName = $rowpro['spProfileType_idspProfileType'];
        }

if ($row['spProfile_idspProfiles'] != $_SESSION['pid']) {                                                

if ($ProfileTypeName == 1) {


$r = new _rfq;
$result2 = $r->chckQuote($rfqId, $_SESSION['pid']);
if ($result2) {
if ($result2->num_rows == $row['spQuotereached']) {
?>
<!--   <a href="<?php echo $BaseUrl.'/public_rfq/quote-reach.php?rfq='.$_GET['rfq'];?>" class="btn butn_draf db_btn db_primarybtn">Quote Reached</a> -->

<!--    <a href="" class="btn butn_draf db_btn db_primarybtn">Quote Reached</a> -->

<button type="button" class="btn butn_draf db_btn db_primarybtn" disabled>Quote Reached!</button>

<?php
}else{
?>
<a href="<?php echo $BaseUrl.'/public_rfq/quote-form.php?rfq='.$rfqId;?>" class="btn butn_draf db_btn db_primarybtn btn-border-radius">Quote Now</a>
<?php
}
}else{
?>
<a href="<?php echo $BaseUrl.'/public_rfq/quote-form.php?rfq='.$rfqId;?>" class="btn butn_draf db_btn db_primarybtn btn-border-radius">Quote Now</a>
<?php
}

}else{ 
echo "<p style='font-size: 16px;font-weight: bold;'>Business profile is compulsory for submiting quote.</p>";
}
}

?>

</div>
</div>
</div>


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
