<?php
//  ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
//   error_reporting(E_ALL);
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

$postid = $_GET['postid'];

$obj = new _sellercomment;

$ress = $obj->getsellernewdata($postid);
$activePage = 11;

//print_r($ress);
//die("=====");
if ($ress != "") {
$roww = mysqli_fetch_assoc($ress);
//print_r($roww);

//	die("=====");
}
$del_address = $roww['shipping_address'];
$date = $roww['sporderdate'];
//die("=====");


if (isset($_POST['sub3'])) {
$CourierService4 = $_POST['CourierService'];
$postid4 = $_POST['postid'];
$ShippedDate4 = $_POST['ShippedDate'];
$TrackingNumber4 = $_POST['TrackingNumber'];

$datat = array(
"CourierService" =>  $CourierService4,
"PostId" =>  $postid4,
"ShippedDate" =>  $ShippedDate4,
"TrackingNumber" =>  $TrackingNumber4,

);
$ship = new _spevent_transection;
$ship->createshipm($datat);
}
$st1 = new _orderSuccess;
$status = $st1->readdetails($_GET['postid']);

if ($status) {
$i = 1;
while ($r1 = mysqli_fetch_assoc($status)) {
//print_r($r1);
$buyerprofileid = $r1['spByuerProfileId'];

$uname	= $st1->readusername($r1['spByuerProfileId']);
while ($r2 = mysqli_fetch_assoc($uname)) {
$name = $r2['spProfileName'];
$userid = $r2['idspProfiles'];
}
}
}

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>

<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>

</head>

<style>
.left_group_gray {
box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

}

.progress-bar {
background-image: -webkit-linear-gradient(top, #0f8f46 0, #2bc46f 100%);
background-image: -o-linear-gradient(top, #0f8f46 0, #2bc46f 100%);
background-image: -webkit-gradient(linear, left top, left bottom, from(#0f8f46), to(#2bc46f));
background-image: linear-gradient(to bottom, #0f8f46 0, #2bc46f 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff286090', GradientType=0);
background-repeat: repeat-x;
}

.one,
.two,
.three {
position: absolute;
margin-top: -10px;
z-index: 1;
height: 40px;
width: 80px;
border-radius: 25px;
text-align: center;
padding: 10px 0;
}

.one {
left: 25%;
}

.two {
left: 50%;
}

.three {
left: 75%;
}

.primary-color {
background-color: #aff8d0;
}

.no-color {
background-color: #aff8d0;
}

.text-end {
text-align: right !important;
}
</style>

<body class="bg_gray">
<?php
//this is for store header
$header_photo = "header_photo";

include_once("../../header.php");
?>


<section class="">
<div class="container-fluid">
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar">
<?php
include('left-menu.php');
?>
</div>

<div class="col-md-10">
<div class="panel panel-default">
<div class="panel-heading"> Dashboard / Cancelled </div>
</div>
<div class="col-md-8" id="print-content">
<div class="left_group_gray">
<div class="panel">
<div class="panel-heading">
<div class="d-flex justify-content-between">
<div>
Order Date: <strong><?php echo $date; ?></strong> |
Order#: <strong>#<?php echo $_GET['postid']; ?></strong> |
Payment: <strong>Stripe</strong> |
Buyer:<a href="<?php echo $BaseUrl; ?>/friends/?profileid=<?php echo $userid; ?>"> <?php echo $name; ?></a>
</div>

<div class="row"><br />
<div class="col-md-12">
<div class="progress">
<div class="one primary-color">Processed</div>
<div class="two primary-color">Shipped</div>
<div class="three no-color">Delivered</div>

<?php

$spord3 = new _productposting;
$status3 = $spord3->readshiptm($_GET['postid']);
if ($status3 != false) {

$data99 = mysqli_fetch_assoc($status3);
//echo "<br>";
//print_r($data99);
}
//die('=======');
$shipst =  $data99['shipping_status'];
//echo$BaseUrl;
//die("===========");
$spSellerProfileId = $data99['spSellerProfileId'];
$pid = $_SESSION['pid'];
//echo $pid;
// $spSellerProfileId;
//  die("===========");


//die("===========");


switch ($shipst) {
case "1":
echo "<div class='progress-bar' style='width: 15%;'></div>
<style>
.one {
background-color: #777 !important;
color:white;

}

.two {
background-color: #777 !important;
color:white;
}

.three{
background-color: #777 !important;
color:white;
}

</style>
";
break;
case "4":
echo "<div class='progress-bar' style='width: 46%;'></div>
<style>

.two {
background-color: #777 !important;
color:white;
}

.three
{
background-color: #777 !important;
color:white;
}

</style>
";
break;
case "2":
echo "<div class='progress-bar' style='width: 70%;'></div>
<style>

.three
{
background-color: #777 !important;
color:white
}

</style>
";
break;
case "3":
echo "<div class='progress-bar' style='width: 100%;'></div>";
case "0":
echo "<div class='progress-bar' style='width: 100%;    background-image: linear-gradient(to bottom, #d7dad8 0, #818581 100%);'></div>";
break;
}
// echo $spSellerProfileId;
//echo $pid ;
// die("===========");
if ($pid != $spSellerProfileId) {
//die("+++++++++++");
//header("location:https://dev.thesharepage.com/timeline/");
// header("location:$BaseUrl/store/dashboard/order_mang.php?msg=notaccess");


?>
<script>
location.href = '<?php echo $BaseUrl; ?>/artandcraft/dashboard/view-order.php?msg=notaccess';
</script>
<?php } ?>

<!--div class="progress-bar" style="width: 70%;"></div -->
</div>

</div>
</div>


</div>
</div>

<?php
$st1 = new _orderSuccess;
$status = $st1->readdetails($_GET['postid']);

if ($status) {
$i = 1;
while ($r1 = mysqli_fetch_assoc($status)) {
//print_r($r1);
$buyerprofileid = $r1['spByuerProfileId'];
$prid = $r1['idspPostings'];
$price = $r1['sporderAmount'];
$qty = $r1['spOrderQty'];
$can = $r1['is_cancel'];
$ref = $r1['is_refund'];
$dat = $r1['can_ref_date'];
$prtitle = $r1['spPostingTitle'];
$qty = $r1['spOrderQty'];

$total = $qty * $price;


$n = $st1->readname_art($prid);
$na = mysqli_fetch_assoc($n);
$prtitle = $na['spPostingTitle'];
$sippingch = $na['sippingcharge'];
$fixedamount = $na['fixedamount'];
//die('========');

if ($sippingch == 1) {
$sippingch = 0;
}
if ($sippingch == 2) {
$left_qty = $qty - 1;
//echo $left_qty; new_sellerstatus
//die('===');
$left_wty_amt = $left_qty * .25 * $fixedamount;
$sippingch = $fixedamount + $left_wty_amt;
}







$p = new _postingviewartcraft;
$prname = $p->singletimelines($r1['idspPostings']);

while ($r3 = mysqli_fetch_assoc($prname)) {
//print_r($r3);

$productname = $r3['spPostingTitle'];
$sippingcharge = $r3['sippingcharge'];
$curr = $r3['defaltcurrency'];



//$del_address=$r3['shipping_address'];
//echo $del_address;
}
}
}

?>

<div class="panel-body">
<table class="table table-borderless">
<tbody>
<tr>
<th>Product</th>
<th></th>
<th>Quantity</th>
<th class="text-end">Price</th>
</tr>
<tr>
<td>

<div class="pull-left" style="padding-right: 10px;">

<?php


$pic = new _postingpicartcraft;
$res2 = $pic->read($prid);

if ($res2 != false) {




while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];


?>

<?php
}
}
?>

<img src="<?= $pic2 ?>" width="70px" height="70px">

</div>
<div class="">
<p><a href="<?php echo $baseurl . '/artandcraft/detail.php?postid=' . $prid; ?>" class="text-reset" style="color:black;"> <?php echo $productname; ?> </a></p>

</div>

</td>
<td></td>
<td><?php echo $qty; ?></td>

<?php
/*$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency); */
//$curr=$res1['currency'];

?>

<td class="text-end"><?php echo '  ' . $price . '.00' . ' ' . $curr; ?></td>
</tr>

</tbody>



<tr>
<td colspan="3">Subtotal</td>
<td class="text-end"><?php echo '  ' . $total . '.00' . ' ' . $curr;  ?></td>
</tr>
<tr>
<td colspan="3">Shipping</td>
<td class="text-end">
<?php

/*	if($sippingcharge==1){
echo "Shipping Charges:Free Shipping";
}
if($sippingcharge==2){
$left_qty=$row['spOrderQty']-1;
$left_wty_amt= $left_qty *.25*$fixedamt;
$sippingch=$fixedamt+$left_wty_amt;
//var_dump($fixedamount); 
echo "Shipping Charges: ".$sippingch." (Fixed)";
$total+=$sippingch;
}
*/

?>
<?php echo ''  . $sippingch . '.00' . ' '  . $curr; ?></td>
</tr>
<!--    <tr>
<td colspan="2">Discount (Code: NEWYEAR)</td>
<td class="text-danger text-end">-$10.00</td>
</tr>  -->
<tr class="fw-bold">
<td colspan="3">TOTAL</td>
<td class="text-end"><?php echo '' . $sippingch + $total . '.00' . ' ' . $curr; ?></td>
</tr>

</table>
</div>
<div class="panel-footer">
<div class="d-flex">
<form>

<input type="button" onclick="window.print()" class="btn btn-primary btn-border-radius" value="Invoice" />
</form>
<!--<button class="btn btn-primary" onclick="">Invoice</button>-->
</div>
</div>
</div>
</div>
<div class="left_group_gray">
<div class="panel">
<div class="panel-body">
<div class="row">
<!--    <div class="col-lg-6">
<h3 class="h6">Payment Method</h3>  
<p>


</p>
</div>
-->


<?php
$sptr = new _spevent_transection;
$readship = $sptr->readshipm($_GET['postid']);
if ($readship) {
$readship1 = mysqli_fetch_assoc($readship);
}
$ordertr = $sptr->readtr($_GET['postid']);
//var_dump($ordertr);
if ($ordertr != false) {
$ordertrs = mysqli_fetch_assoc($ordertr);
//print_r($ordertrs);
$addresss = $ordertrs['shippAddress'];
}


?>




<div class="col-lg-6">
<h3 class="h3">Billing address</h3>
<address>
<h5><?php
$spBuyeruserId = $data99['spBuyeruserId'];

// print_r($data99);
// die("++++++++++++++");
$objj = new _spuser;
$res12 = $objj->readdatabybuyerid($spBuyeruserId);
if ($res12 != false) {

$row12 = mysqli_fetch_assoc($res12);
echo "<pre/>";
}
echo $row12['default_country'] . "<br>";
echo $row12['default_state'] . "<br>";
echo $row12['default_city'] . "<br>";
echo $row12['address'] . "<br>";
echo $row12['spUserzipcode'];
?><h5>
</address>
</div>

<div class="col-lg-6">
<h3 class="h3">Delivery address</h3>
<?php if ($del_address != false) { ?>
<address>

<h5>
<pre><?php echo  $del_address; ?></pre>
<h5>
</address>
<?php } else { ?>
<address>

<h4>
<pre>No Delivery Address Found</pre>
<h4>
</address>
<?php } ?>
</div>


<div class="col-md-12">



<?php if ($ref == 1) {
echo "	<div class='float-left' > Product Images</div>";
$p = new _spprofiles;
$pf = $p->readimg($_GET['postid']);

if ($pf != false) {
while ($img = mysqli_fetch_assoc($pf)) {
//print_r($img);
$image = $img['image'];
echo  "   <div class='col-md-3' style='display: inline-block; padding-top:20px;'><img src='$BaseUrl/artandcraft/dashboard/images/" . $image . "' alt='image' width='100' height='100' />"; ?>

</div>&nbsp;&nbsp;&nbsp;

<?php 	}
} ?>

<?php }


?>

</div>

</div>
</div>
</div>
</div>
</div>


<div class="col-md-4">
<!--<div class="left_group_gray">
<div class="panel">
<div class="panel-body">
<h4>Customer Notes</h4>
<p>Sed enim, faucibus litora velit vestibulum habitasse. Cras lobortis cum sem aliquet mauris rutrum. Sollicitudin. Morbi, sem tellus vestibulum porttitor.</p>
</div>
</div>
</div>-->

<div class="left_group_gray">
<div class="panel">
<div class="panel-body shippment">
<h4>Shipping Information</h4>
<div class="col-md-12">



<br>

<?php
$sell = new _productposting;
$sellty = $sell->read($prid);

if ($sellty) {
$selltype = mysqli_fetch_assoc($sellty);
$cancel = $selltype['is_cancel'] . "<br>";
$refund = $selltype['is_refund'] . "<br>";
$type = $selltype['sellType'];
if ($type == 'Retail') {
if ($can == 1 || $ref == 1) {
if ($can == 1) {
echo "You have cancelled The order";
}
if ($ref == 1) {
echo "<span style='color:red;'>Order Refund Request by Buyer on</span>" . ' ' . $dat;
}
} else {

if ($cancel == 1) { ?>
<form action="" method="post">
<input type="hidden" name="cancel" id="cancel" value="<?php echo $cancel; ?>">
<!--<button type="submit" name="cancel" onclick="return confirm('Are you sure you want to Cancel this item?');"  class="btn btn-danger btn-sm ">Cancel</button>-->
</form>
<?php }
if ($refund == 1) { ?>

<form action="" method="post">
<input type="hidden" name="refund" id="refund" value="<?php echo $refund; ?>"><br>
<!--<button type="submit" name="refund" onclick="return confirm('Are you sure you want to Refund this item?');" class="btn btn-success btn-sm">Refund</button>-->
</form>

<?php
}
}
}
}

if ($readship1  == "") {
?>
<?php
$p = new _spcustomers_basket;

$result = $p->readcancel_artcraft_d($_SESSION['pid'], $_GET['postid']);
//  echo $p->ta->sql;


if ($result != false) {
$i = 1;
$row = mysqli_fetch_assoc($result);
//print_r($row);
//die('=========');
$cancel_date = $row['can_ref_date'];
$buyerprofilid = $row['spByuerProfileId'];
$reason = $row['reason'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if ($spbuyresult != false) {
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];
}

?><br>
<div style="border: 1px solid black;margin-left: -5px;padding-left: 5px;
}">

<p><b>This Order has been Cancelled by <?php echo $buyername; ?></b></p>
<span><b>Date : </b><?php echo $cancel_date; ?></span>
<span><b>Reason : </b><?php echo $reason; ?></span>
</div>
<?php
} else {
?>
<button type="button" class="btn btn-info btn-sm btn-border-radius" data-postid="<?= $_GET['postid'] ?>" data-toggle="modal" data-target="#myModal45">Tracking Details</button>
<?php }
} else { ?>
<br>
<b>Courier Service Name :</b> <?= $readship1['CourierService'] ?> <br><br>
<b>Shipped Date :</b> <?= $readship1['ShippedDate'] ?> <br><br>
<b>Tracking Number :</b> <?= $readship1['TrackingNumber'] ?>

<div class="row">
<div class="col-md-12">

<?php
$p = new _spcustomers_basket;

$result = $p->readcancel_artcraft_d($_SESSION['pid'], $_GET['postid']);
//  echo $p->ta->sql;


if ($result != false) {
$i = 1;
$row = mysqli_fetch_assoc($result);
//print_r($row);
//die('=========');
$cancel_date = $row['can_ref_date'];
$buyerprofilid = $row['spByuerProfileId'];
$reason = $row['reason'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if ($spbuyresult != false) {
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];
}

?><br>
<div style="border: 1px solid black;margin-left: -5px;padding-left: 5px;
}">

<p><b>This Order has been Cancelled by <?php echo $buyername; ?></b></p>
<span><b>Date : </b><?php echo $cancel_date; ?></span>
<span><b>Reason : </b><?php echo $reason; ?></span>
</div>
<?php
} else {
?>
<br> <?php


$spord3 = new _productposting;
$status3 = $spord3->readshiptm($_GET['postid']);
if ($status3 != false) {
$data99 = mysqli_fetch_assoc($status3);
//die('=======');
$shipst =  $data99['shipping_status'];
}


?>


<select class="form-control" onchange="location = this.value;">
<option value="" selected="selected">Option</option>
<option value="new_sellerstatus.php?status=4&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '4') {
echo 'selected';
} ?>>Proccessed</option>

<option value="new_sellerstatus.php?status=2&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '2') {
echo 'selected';
} ?>>Shipped</option>

<option value="new_sellerstatus.php?status=3&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '3') {
echo 'selected';
} ?>>Delivered</option>
</select>
<?php } ?>
</div>

</div>





<?php } ?>
<div id="myModal45" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Tracking Details </h4>
</div>
<form action="" method="post">
<div class="modal-body">
<label class="">Courier Service Name </label>
<input type="text" class="form-control" name="CourierService">
<input type="hidden" class="form-control" name="shipStatus" value="1">
<input type="hidden" class="form-control" id="postids" value="<?= $_GET['postid']; ?>" name="postid">

<label class="form-label">Shipped Date </label>
<input type="date" class="form-control" name="ShippedDate">

<label class="form-label">Tracking Number</label>
<input type="text" class="form-control" name="TrackingNumber">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success btn-border-radius" name="sub3">Submit</button>
</div>
</form>
</div>

</div>

</div>

</div>
<hr />
<br>
<!--<div class="col-md-12">
<h4 style="font-weight:bold;">Delivery Address</h4>
<address>

<h5><?php //echo  $addresss; 
?><h5>

</address>
</div>   -->
</div>
</div>
</div>
</div>

</div>


</div>
</div>
</section>



<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>

</body>

</html>
<?php
} ?>