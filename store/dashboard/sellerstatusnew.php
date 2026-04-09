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

if (isset($_POST['give_refund'])) {
                      $status = array("status" => 1);
                      $s = new _spprofiles;
                      $st = $s->updatestatus($status, $_GET['postid']); 



                      $pw = new _spstorewallet;

                    $result = $pw->readstore_order($_GET['postid']);

                    if ($result) {
                      
                      $row = mysqli_fetch_assoc($result);

                      $buyer_userid = $row['buyer_userid'];
                      //$buyer_userid = $row['seller_userid'];
                      $amount = $row['amount'];
                      $balanceTransaction = "Refund"; 

                       $pay = array(
                                 'buyer_userid' => $_SESSION['uid'],
                                 'seller_userid' => $buyer_userid, 
                                 'amount' => $amount,
                                 'balanceTransaction' => $balanceTransaction,
                                 'date_txn' =>  date("Y-m-d h:i:sa")
                              );


                               $pw->updatestoreorder($pay, $_GET['postid']);   


                    }
                    }




$obj = new _sellercomment;

$ress = $obj->getsellernewdata($postid);

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

$buyerprofileid = $r1['spByuerProfileId'];

$uname	= $st1->readusername($buyerprofileid);
while ($r2 = mysqli_fetch_assoc($uname)) {
//print_r($r2);
$name = $r2['spProfileName'];
$userid1 = $r2['idspProfiles'];
}
}
}



?>
<!DOCTYPE html>
<html lang="en-US">



<style>
.panel-body.shippment {
padding: 0px !important;
}

tfoot tr {
display: block !important;
}
</style>


<head>
<title>The SharePage</title>
<!-- order.html links--->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/A.style.css+design.css,Mcc.hQAhmIY5uF.css.pagespeed.cf.wVvL7jTLAe.css" />
<style type="text/css">
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
left: 20%;
}

.two {
left: 45%;
}

.three {
left: 70%;
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

.swal2-popup {

font-size: 12px !important;
}
</style>
<!-- order.html links end--->
<?php include('../../component/f_links.php'); ?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- <script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script> -->



</head>

<body class="bg_gray" cz-shortcut-listen="true">
<?php
//this is for store header
$header_store = "header_store";
include_once("../../header.php");
?>
<!-- order.html code -->


<section class="main_box">
<div class="container">
<div class="row">
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-sellermenu.php');
?>
</div>
</div>
<div class="col-md-7">
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
echo "<div class='progress-bar' style='width: 100%;background-image: -webkit-linear-gradient(top, #a4a6a5 0, #777e7a 100%);'></div>";
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
location.href = '<?php echo $BaseUrl; ?>/store/dashboard/order_mang.php?msg=notaccess';
</script>
<?php } ?>

<!--div class="progress-bar" style="width: 70%;"></div -->
</div>

</div>
</div>
<div class="row" id="printableArea">
<div class="col-md-12">
<div class="left_group_gray">
<div class="panel">
<div class="panel-heading">
<div class="d-flex justify-content-between">
<div>
Order Date: <strong><?php echo $date; ?></strong> |
Order#: <strong>#<?php echo $_GET['postid']; ?></strong> |
Payment: <strong>Stripe</strong> |
Buyer: <a href="<?php echo $BaseUrl; ?>/friends/?profileid=<?php echo $userid1; ?>"> <?php echo $name; ?></a>
</div>




</div>
</div>

<?php
$st1 = new _orderSuccess;
$status = $st1->readdetails($_GET['postid']);

if ($status) {
$i = 1;
while ($r1 = mysqli_fetch_assoc($status)) {
$prid = $r1['idspPostings'];
$price = $r1['sporderAmount'];
$qty = $r1['spOrderQty'];
$can = $r1['is_cancel'];
$ref = $r1['is_refund'];
$dat = $r1['can_ref_date'];
$prtitle = $r1['spPostingTitle'];
$qty = $r1['spOrderQty'];

$total = $qty * $price;


$n = $st1->readname_44($prid);
if($n){
$na = mysqli_fetch_assoc($n);
$prtitle = $na['spPostingTitle'];
$sippingch = $na['sippingcharge'];
$fixedamount = $na['fixedamount'];
//die('========');
}
if ($sippingch == 1) {
$sippingch = 0;
}
if ($sippingch == 2) {
$left_qty = $qty - 1;
//echo $left_qty;
//die('===');
$left_wty_amt = $left_qty * .25 * $fixedamount;
$sippingch = $fixedamount + $left_wty_amt;
}



$uname	= $st1->readusername($r1['spByuerProfileId']);
while ($r2 = mysqli_fetch_assoc($uname)) {
$name = $r2['spProfileName'];
$userid = $r2['idspProfiles'];
}

$prname = $st1->readproductname($r1['idspPostings']);
while ($r3 = mysqli_fetch_assoc($prname)) {
//print_r($r3);
$curr = $r3['default_currency'];
$productname = $r3['spPostingTitle'];
$sippingcharge = $r3['sippingcharge'];
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


$pic = new _productpic;
$res2 = $pic->read($prid);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$ppic = $rp['spPostingPic'];
}
?>
<img src="<?= $ppic ?>" width="70px" height="70px">

</div>
<div class="">

<p><a href="<?php echo $baseurl . '/store/detail.php?catid=1&postid=' . $prid; ?>" class="text-reset" style="color:black;"> <?php echo $productname; ?> </a></p>

</div>

</td>
<td></td>
<td><?php echo $qty; ?></td>

<?php
$userid = $_SESSION['uid'];
$c = new _orderSuccess;
$currency = $c->readcurrency($userid);
$res1 = mysqli_fetch_assoc($currency);
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

<input type="button" onclick="printDiv('printableArea')" id="invoicee" class="btn btn-primary" value="Invoice" />
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

<script>
function printDiv(divName) {


var printContents = document.getElementById(divName).innerHTML;


var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;
document.getElementById("invoicee").style.display = "none";
window.print();

document.body.innerHTML = originalContents;
}
</script>
<div class="col-md-12">



<?php if ($ref == 1) {
echo "	<div class='float-left' > Product Images</div>";
$p = new _spprofiles;
$pf = $p->readimg($_GET['postid']);

if ($pf != false) {
while ($img = mysqli_fetch_assoc($pf)) {
//print_r($img);
$image = $img['image'];
echo  "   <div class='col-md-3' style='display: inline-block; padding-top:20px;'><img src='$BaseUrl/store/dashboard/images/" . $image . "' alt='image' width='100' height='100' />"; ?>

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
</div>
</div>


<div class="col-md-3">
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

	$rd = new _spprofiles;
	$rad = $rd->readst($_GET['postid']);
	if ($rad != false) {
		$read = mysqli_fetch_assoc($rad);

		$st = $read['status'];	

	}

	if ($st != 1) {  

echo "<span style='color:red;'>Order Refund Request by Buyer on</span>" . ' ' . $dat;
?>
<form action="" method="post">

<button type="submit" name="give_refund" value="give_refund" class="btn btn-primary">Give Refund</button>
</form>  
<?php 
}
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
<button type="button" class="btn btn-info btn-sm" data-postid="<?= $_GET['postid'] ?>" data-toggle="modal" data-target="#myModal45">Tracking Details</button>
<?php } else { ?>
<br>
<b>Courier Service Name :</b> <?= $readship1['CourierService'] ?> <br><br>
<b>Shipped Date :</b> <?= $readship1['ShippedDate'] ?> <br><br>
<b>Tracking Number :</b> <?= $readship1['TrackingNumber'] ?>

<div class="row">
<div class="col-md-12">
<br> <?php


$spord3 = new _productposting;
$status3 = $spord3->readshiptm($_GET['postid']);
if ($status3 != false) {
$data99 = mysqli_fetch_assoc($status3);
//die('=======');
$shipst =  $data99['shipping_status'];
}


?>


<select class="form-control" onchange="myfun(this.value)">

<option value="new_sellerstatus.php?status=4&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '4') {
echo 'selected';
} ?>>Processed</option>

<option value="new_sellerstatus.php?status=2&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '2') {
echo 'selected';
} ?>>Shipped</option>

<option value="new_sellerstatus.php?status=3&buyerid=<?php echo $data99['spByuerProfileId']; ?>&id=<?= $_GET['postid'] ?>" <?php if ($shipst == '3') {
echo 'selected';
} ?>>Delivered</option>
</select>

</div>

</div>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function myfun(url) {
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure?',
text: "It will updated permanently !",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, update it!'
}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})

}
</script>




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
<br>
<label class="form-label">Shipped Date </label>
<input type="date" class="form-control" name="ShippedDate">
<br>
<label class="form-label">Tracking Number</label>
<input type="text" class="form-control" name="TrackingNumber">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success" name="sub3">Submit</button>
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

<div class="modal" id="myModal1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Cancel</h4>
<button type="button" class="close" data-dismiss="modal">×</button>
</div>

<div class="modal-body">
<form action="" method="post">
<input type="hidden" name="cancel" id="cancel" value="" />


<input type="textarea" name="reason" placeholder=" Why Are You Cancelling This?.." class="form-control" />
</form>
</div>

<div class="modal-footer">
<button type="submit" name="cancel" class="btn btn-danger btn-sm">Submit</button>

<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<div class="modal" id="myModal2">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Refund</h4>
<button type="button" class="close" data-dismiss="modal">×</button>
</div>

<div class="modal-body">
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="idspOrder" id="idspOrder" value="<?php echo $id; ?>">
<input type="hidden" name="idspPostings" id="idspPostings" value="<?php echo $prid; ?>">
<input type="hidden" name="spByuerProfileId" id="spByuerProfileId" value="<?php echo $bpid; ?>">
<input type="hidden" name="spBuyeruserId" id="spBuyeruserId" value="<?php echo $buid; ?>">
<input type="hidden" name="spSellerProfileId" id="spSellerProfileId" value="<?php echo $spid; ?>">

<input type="textarea" name="reason" placeholder=" Why Are You Returning This?.." class="form-control" />
<input type="file" name="image[]" accept="image/*" multiple="multiple" style="display: block;" />
</form>
</div>

<div class="modal-footer">
<button type="submit" name="refund" class="btn btn-success btn-sm">Submit</button>

<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<!-- order.html code end-->

<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
include '../../assets/mpdf/mpdf.php';
$mpdf = new mPDF();
$mpdf->WriteHTML($orderhtml);
$mpdf->Output("storeinvoice.pdf", 'F');
?>

</body>

</html>
<?php
}
?>


<script>
// A $( document ).ready() block.
$(document).ready(function() {

var posstid = $(this).attr("data-postid");
alert(posstid);
$("#postids").val(posstid);

});
</script>
<script type="text/javascript">
/*function printDiv(divName) {
var printContents = document.getElementById(divName).innerHTML;
w=window.open();
w.document.write(printContents);
w.print();
w.close();
}*/
</script>