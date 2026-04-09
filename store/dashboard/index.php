<?php

//ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);

include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

<style>
#profileDropDown li.active {
background-color: #0f8f46;
}

#profileDropDown li.active a {
color: white;
}

@media screen and (min-width: 480px) {
ul.breadcrumb1 {
display: none;
}
}
</style>

</head>

<body class="bg_gray">
<?php

$activePage = 1;
//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--  <div class="sidebar col-md-2 no-padding left_store_menu1" id="sidebar" style="border-radius: 11px;" > -->
<!--  <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar"  >

<?php

$activePage = 1;

// include('left-menu.php'); 


?> 

</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php');
?>
</div>
</div>


<div class="col-md-10">


<?php

$storeTitle = " (Buyer Dashboard)";
// include('../top-dashboard.php');
// include('../searchform.php');

?>


<?php if ($_GET['msg'] == "notverified") { ?>

<div class="alert alert-danger" role="alert">
<h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
</div>
<?php   } ?>


<div class="row ">
<div class="col-sm-12">

<ul class="breadcrumb1" style="background-color: #fff;font-size: 20px; text-align: center;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" " style=" color: #0B241E;">Go to Seller Dashboard</a></li>


</ul>

<ul class="breadcrumb" style="background-color: #fff;font-size: 20px; text-align: center;">
<li><a href="#" style=" color: #0B241E;">BUYER DASHBOARD</a></li>
<a data-toggle="modal" class="pointer pull-right" data-target="#inviteFriend"><span class="fa fa-user"></span> Invite and Earn </a>

</ul>
<!--	<?php if ($_SESSION['ptid'] == 1) { ?>
<a href="<?php echo $BaseUrl . '/store/pos_dashboard1/index.php'; ?>" class="pull-right" style=" color: #0B241E; margin-top: -57px;
margin-right: 19px;"><b style=" font-size: 23px;">Switch To POS</b></a>
<?php } ?>-->
</div>


<!--    <div class="text-right" style="margin-top: -10px;">

<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21) ? 'active' : '' ?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>" class="<?php echo ($activePage == 1) ? 'active' : '' ?>">Buyer Dashboard</a></li>
</ul>
</div>
</div> -->

<!--   <div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></li>

<li><a href="#">Quotation List</a></li>

</ul>
</div> -->
<div class="col-md-3">
<div class="small-box bg-green">
<div class="inner">
<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$p = new _productposting;

$result = $p->myactiveauctionbid($_SESSION['pid']);

//print_r($result);die('========================');

if ($result->num_rows) {

echo "<h3>" . $result->num_rows . "</h3>";
} else {
echo "<h3>0</h3>";
}
?>
<p>My Bids</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"></i>
</div>
<a href="<?php echo $BaseUrl . '/store/dashboard/activebid.php' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-aqua">
<div class="inner">

<?php $st = new _orderSuccess;
$status = $st->readstatus_count($_SESSION['pid'], $_SESSION['uid']);





$n= new _orderSuccess;
$name=$n->readname_product($_SESSION['pid']);

if($name != false){

    echo "<h3>" .$name->num_rows. "</h3>";
}
 else {
echo "<h3>0</h3>";
} 


?>

<p>Total Purchased Order</p>
</div>
<div class="icon">
<i class="fa fa-usd"></i>
</div>
<a href="<?php echo $BaseUrl . '/store/dashboard/myallproduct_orderhistory.php'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-yellow">
<div class="inner">
<?php $en = new _sppostenquiry;
$result_e = $en->getbuyerEnquery($_SESSION['pid']);
if ($account_status != 1 && $result_e) {

echo "<h3>" . $result_e->num_rows . "</h3>";
} else {
echo "<h3>0</h3>";
} ?>


<p>Total Enquiry Product</p>
</div>
<div class="icon">
<i class="fa fa-product-hunt"></i>
</div>
<a href="<?php echo $BaseUrl . '/store/dashboard/my_send_enguiry.php'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-md-3">
<div class="small-box bg-red">
<div class="inner">
<?php
$fav = new _productposting;

$result_f = $fav->readallfavrouiteproduct(1, $_SESSION['pid']);

// print_r($result_f);
//die("++");
if (($account_status != 1) && $result_f) {

echo "<h3>" . $result_f->num_rows . "</h3>";
} else {
echo "<h3>0</h3>";
}
?>
<p>Total Favorite Product</p>
</div>
<div class="icon">
<i class="fa fa-thumbs-o-up"></i>
</div>
<a href="<?php echo $BaseUrl . '/store/dashboard/my-favourite.php'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>

<div class="row ">

<!--  <div class="col-md-6">

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
$or = new _orderSuccess;
$result_or = $or->readmyOrder($_SESSION['pid']);
if ($result_or) {
$totOrdr = $result_or->num_rows;
} else {
$totOrdr = 0;
}
?>
<table class="table table-striped no-margin">
<tbody>
<tr>
<td><a href="<?php echo $BaseUrl . '/store/dashboard/my_order.php'; ?>">New Orders (New Purchases)</a></td>
<td><span class="label label-success"><?php echo $totOrdr; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">Cancel Order</a></td>
<td><span class="label label-info"><?php echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">Return Request</a></td>
<td><span class="label label-danger"><?php echo 0; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/store/dashboard/my_send_enguiry.php'; ?>">My Send Enquiries</a></td>
<td><span class="label label-info"><?php echo 0; ?></span></td>
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
<td><span class="label label-success"><?php echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">7 Days</a></td>
<td><span class="label label-info"><?php echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">15 Days</a></td>
<td><span class="label label-danger"><?php echo 0; ?></span></td>
</tr>
<tr>
<td><a href="javascript:void(0)">30 Days</a></td>
<td><span class="label label-info"><?php echo 0; ?></span></td>
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
<td class="text-center"><?php echo $currency . ' ' . $amount; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td>Wait for ship</td>
<td>
<a href="<?php echo $BaseUrl . '/store/dashboard/invoice.php?order=' . $cid ?>">Invoice</a>
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
-->

</div><!-- /.row -->





<!--	<?php
$objstore = new _state;
$resultstor = $objstore->readstore($_SESSION['pid']);
//print_r($resultstor);

?> -->


</div>
</div>
</div>
</section>



<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
// <!-- ========DASHBOARD FOOTER CHARTS====== -->
include('../../component/dash_btm_script.php');
?>
</body>

</html>
<?php
}
?>