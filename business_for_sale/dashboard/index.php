<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";
$header_servic = "business_for_sale";
?>
<!DOCTYPE html>
<html lang="en-US"> 

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>   


</head>

<body class="bg_gray">
<?php

//$activePage = 1;
//this is for store header
//$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-menu.php'); 
?>
</div>

<div class="col-md-10 ">

<?php if ($_GET['msg'] == "notverified") { ?>

<div class="alert alert-danger" role="alert">
<h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
</div>
<?php   } ?>  


<?php 

// $storeTitle = " (Buyer Dashboard)";
// include('../top-dashboard.php');
// include('../searchform.php');

?>
<style>


.header_store {
background-color: #3e2048;
padding: 0 10px 5px;
}


btn:hover, .btn:focus, .btn.focus {
color: #000;
text-decoration: none;
}
.bg-event {
background: #ff8ab8;
}

.bg-store {
background: #8cf6ba;
}

.bg-freelance {
background: rgba(255,215,190);
}
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.panel-body {
width: 300px;
border-radius: 25px 25px 0 0;
border: 1px solid;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
}
.border-event {
border-color: #ff8ab8;
}
.border-freelance {
border-color: rgba(255,215,190);
}
.border-store{
border-color: rgb(140,246,186); 
}

.bg_events:hover{color:#000}
.panel-footer {
width: 300px;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
border-radius: 0 0 25px 25px;
text-align: center;

}
.panel-footer  {
padding: 10px 13px;
}
.panel-footer > a {
padding: 10px 13px;
color: #000;
text-transform: uppercase;
text-decoration: none;
padding: 10px 10px;
font-size: 20px;
font-weight: bolder;
}
.rightContent{
background-color:#fff; 
}
</style>

<?php	/*if($_GET['msg'] == "notverified"){ ?>

<div class="alert alert-danger" role="alert">
<h4>It Looks Like Your Business Profile is  Not Verified , or Your Profile is Pending for Verification Approval . To Verify or See Status of Your Business Profile Verification , Please Visit Settings from Master  Dashboard.</h4>
</div>
<?php   }*/ ?>


<div class="row">
<div class="col-md-12">

<ul class="breadcrumb" style="background-color: #fff;font-size: 20px; text-align: center;">
<li><a href="#" style=" color: #0B241E;">Business Dashboard</a></li>

</ul>
</div>
</div>
<div class="row">
<div class="col-md-4" style="">
<div class="panel" style="border-radius: 25px;margin-left: -5px;">
<div class="panel-body border-event">
<div class="small-box bg_events">
<div class="inner">
<h3><?php $bu= new _businessrating;
$bu1=$bu->read_business_active($_SESSION['uid'],$_SESSION['pid']); 
if($bu1!=false){
echo $bu1->num_rows;
}else{
echo "0";
}
?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-event">
<a href="https://thesharepage.com/business_for_sale/dashboard/active_listing.php">Active Listing </a>
</div>
</div>
</div>




<div class="col-md-4">
<div class="panel" style="border-radius: 25px;margin-left: -5px;">
<div class="panel-body border-freelance">
<div class="small-box bg_events">
<div class="inner">
<h3><?php  $en = new _businessrating;
$result = $en->read_business_enquiry($_SESSION['pid']);
if($result!=false){
echo $result->num_rows;
}else{
echo "0";
}
?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-freelance">
<a href="https://thesharepage.com/business_for_sale/dashboard/enquiry.php">My Received Enquiries </a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="panel" style="border-radius: 25px;margin-left: -5px;">
<div class="panel-body border-store">
<div class="small-box bg_events">
<div class="inner">
<h3><?php $en = new _businessrating;
$result2 = $en->read_business_sent_enquiry($_SESSION['pid']);
if($result2!=false){
echo $result2->num_rows;
}else{
echo "0";
}
?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-store">
<a href="https://thesharepage.com/business_for_sale/dashboard/sent_enquiry.php">My Sent Enquiries</a>
</div>
</div>
</div>
</div>

<!--    <div class="text-right" style="margin-top: -10px;">






<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1)?'active':''?>">Buyer Dashboard</a></li>
</ul>






</div>
</div> -->

<!--   <div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

<li><a href="#">Quotation List</a></li>

</ul>
</div> -->
<!--<div class="col-md-3">
<div class="small-box bg-green">
<div class="inner">
<?php
/* $p = new _productposting;

$result = $p->myactiveauctionbid($_SESSION['pid']);
if ($result) {
echo "<h3>".$result->num_rows."</h3>";
}else{
echo "<h3>0</h3>";
}*/
?>
<p>My Bids</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"></i>
</div>
<a href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-aqua">
<div class="inner">

<?php   /*$st= new _orderSuccess;
$status= $st->readstatus($_SESSION['pid'],$_SESSION['uid']);
if ($status) {
echo "<h3>".$status->num_rows."</h3>";
}else{
echo "<h3>0</h3>";
} */?>

<p>Total Purchase Order</p>
</div>
<div class="icon">
<i class="fa fa-usd"></i>
</div>
<a href="<?php echo $BaseUrl.'/store/dashboard/myallproduct_orderhistory.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-yellow">
<div class="inner">
<?php   /* $en = new _sppostenquiry;
$result_e = $en->getbuyerEnquery($_SESSION['pid']);
if ($result_e) {
echo "<h3>".$result_e->num_rows."</h3>";
}else{
echo "<h3>0</h3>";
} */?>


<p>Total Enquiry Product</p>
</div>
<div class="icon">
<i class="fa fa-product-hunt"></i>
</div>
<a href="<?php echo $BaseUrl.'/store/dashboard/my_send_enguiry.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-red">
<div class="inner">
<?php
/* $fav = new _productposting;

$result_f = $fav->readallfavrouiteproduct(1, $_SESSION['pid']);

// print_r($result_f);
if ($result_f) {
echo "<h3>".$result_f->num_rows."</h3>";
}else{
echo "<h3>0</h3>";
}*/
?>
<p>Total Favourite Product</p>
</div>
<div class="icon">
<i class="fa fa-thumbs-o-up"></i>
</div>
<a href="<?php //echo $BaseUrl.'/store/dashboard/my-favourite.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>-->


<!-- <div class="row ">

<div class="col-md-6">

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">My Orders</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body">
<div class="table-responsive">
<?php
/*  $or = new _orderSuccess;
$result_or = $or->readmyOrder($_SESSION['pid']);
if ($result_or) {
$totOrdr = $result_or->num_rows;
}else{
$totOrdr = 0;
}*/
?>
<table class="table table-striped no-margin">
<tbody>
<tr>
<td><a href="<?php //echo $BaseUrl.'/store/dashboard/my_order.php';?>">New Orders (New Purchases)</a></td>
<td><span class="label label-success"><?php //echo $totOrdr; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">Cancel Order</a></td>
<td><span class="label label-info"><?php //echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">Return Request</a></td>
<td><span class="label label-danger"><?php //echo 0; ?></span></td>
</tr>
<tr>
<td><a href="<?php //echo $BaseUrl.'/store/dashboard/my_send_enguiry.php'; ?>">My Send Enquiries</a></td>
<td><span class="label label-info"><?php //echo 0; ?></span></td>
</tr>

</tbody>
</table>
</div>
</div>

</div>

</div> -->

<!--          <div class="col-md-6">

<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Purchase Summary</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body">
<div class="table-responsive">
<table class="table table-striped no-margin">
<tbody>
<tr>
<td><a href="javascript:void(0)">Today</a></td>
<td><span class="label label-success"><?php //echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">7 Days</a></td>
<td><span class="label label-info"><?php //echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">15 Days</a></td>
<td><span class="label label-danger"><?php //echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">30 Days</a></td>
<td><span class="label label-info"><?php //echo 0; ?></span></td>
</tr>

</tbody>
</table>
</div>
</div>
</div>
</div> -->

<!--                   
<div class="col-md-12">
<div class="">
<div class="table-responsive">
<table class="table tbl_store_setting" >
<thead>
<tr>
<th class="text-center" style="width: 50px;">Order#</th>
<th>TXN Number</th>
<th>Payer Id</th>
<th class="text-center">Price</th>
<th>Order Date</th>
<th>Status</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$p = new _orderSuccess;
$result = $p->readmyOrder($_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);

$dt = new DateTime($payment_date);
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $txn_id; ?></td>
<td><?php echo $payer_id; ?></td>
<td class="text-center"><?php echo $currency.' '. $amount; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td>Wait for ship</td>
<td>
<a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>">Invoice</a>
</td>

</tr>
<?php
$i++;
}
}
?>
</tbody>
</table>
</div>
</div>
</div>


</div><!-- /.row -->




</div>
</div>
</div>
</section>


<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
// <!-- ========DASHBOARD FOOTER CHARTS====== -->
// include('../../component/dash_btm_script.php');
?>
</body>
</html>
<?php
}
?>