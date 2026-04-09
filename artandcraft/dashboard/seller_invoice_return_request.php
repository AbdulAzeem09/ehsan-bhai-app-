<?php






include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION); die;
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="photos/";
include_once ("../../authentication/islogin.php");

}else{


function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = 13;
$activePage = 19;
?>
<!DOCTYPE html>
<html lang="en-US">  

<head>
<?php include('../../component/f_links.php');?>


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


<style type="text/css">
.order-tracking{
text-align: center;

position: relative;
display: block;
}
.order-tracking .is-complete{
display: block;
position: relative;
border-radius: 50%; 
height: 25px;
width: 25px;
border: 0px solid #AFAFAF;
background-color: #f7be16;
margin: 0 auto;
transition: background 0.25s linear;
-webkit-transition: background 0.25s linear;
z-index: 2;
}
.order-tracking .is-complete:after {
display: block;
position: absolute;
content: '';
height: 14px;
width: 7px;
top: -2px;
bottom: 0;
left: 5px;
margin: auto 0;
border: 0px solid #AFAFAF;
border-width: 0px 2px 2px 0;
transform: rotate(45deg);
opacity: 0;
}
.order-tracking.completed .is-complete{
border-color: #27aa80;
border-width: 0px;
background-color: #27aa80;
}
.order-tracking.noocompleted .is-complete{
border-color: red;
border-width: 0px;
background-color: red;
}
.order-tracking.completed .is-complete:after {
border-color: #fff;
border-width: 0px 3px 3px 0;
width: 7px;
left: 11px;
opacity: 1;
}
.order-tracking.noocompleted .is-complete:after {
border-color: #fff;
border-width: 0px 3px 3px 0;
width: 7px;
left: 11px;
opacity: 1;
}
.order-tracking p {
color: #A4A4A4;
font-size: 16px;
margin-top: 8px;
margin-bottom: 0;
line-height: 20px;
}
.order-tracking p span{font-size: 14px;}
.order-tracking.completed p{color: #000;}
.order-tracking.noocompleted p{color: #000;}
.order-tracking::before {
content: '';
display: block;
height: 3px;
width: calc(100% - 40px);
background-color: #f7be16;
top: 13px;
position: absolute;
left: calc(-50% + 20px);
z-index: 0;
}
.order-tracking:first-child:before{display: none;}
.order-tracking.completed:before{background-color: #27aa80;}
.order-tracking.noocompleted:before{background-color: red;}

.justify-content-between{-ms-flex-pack:justify!important;justify-content:space-between!important}
</style>   
</head>

<body class="bg_gray">
<?php
//this is for store header




$header_photo = "header_photo";

include_once("../../header.php");

$o = new _artcraftOrder;



if($_GET['action']=='order_complete'){
//if($_GET['product_check_id']){
//if($_GET['order_id']){

$product_check_id=$_GET['product_check_id'];
$order_id=$_GET['order_id'];
$o->refundComplete($order_id,$product_check_id);
//	die("hhhhhhh");
//	header("location: ".$BaseUrl."/artandcraft/dashboard/seller-return.php");

$redirectUrl = $BaseUrl . '/artandcraft/dashboard/seller-return.php';
header("Location: " . $redirectUrl);

//header("location: https://dev.thesharepage.com/artandcraft/dashboard/seller-return.php");




// }
//	 }	
}	



if(isset($_POST['Tracking_Id_Save_Submit'])){
//  print_r($_POST); die;
$Carrier=$_POST['Carrier'];  
$Tracking_Id=$_POST['Tracking_Id']; 
$order_products_id=$_POST['order_products_id'];  
$o->updateBuyerOrder($order_products_id, $Carrier, $Tracking_Id);
echo '<script>window.location = "'.$BaseUrl.'/artandcraft/dashboard/seller_invoice_return_request.php?order='.$_POST['r'].'";</script>';
}







$resulttt = $o->readBuyerOrdertotal($_GET['order']);
$rerre = mysqli_fetch_array($resulttt);

if(isset($_GET['orderPid'])){
$orderPid = $_GET['orderPid'];
if(isset($_GET['action'])){
$datastuts=$_GET['action'];
}	  	  
$datastutsdate = $datastuts.'_date';
$resulttt = $o->existStatus($orderPid);	


if(isset($_GET['done_by'])){
$done_by = $_GET['done_by'];
if(!$resulttt){	
$o->createStatusorderdone_by($orderPid,$datastuts,$datastutsdate,$done_by);	
}else{
$o->updateStatusorderdone_by($orderPid,$datastuts,$datastutsdate,$done_by);	
}
}




else{
if(!$resulttt){	
$o->createStatusorder($orderPid,$datastuts,$datastutsdate);	
}else{
//die('===========');
$o->updateStatusorder($orderPid,$datastuts,$datastutsdate);	
//echo $o->tr->sql; die;
}
}
$newURL = $BaseUrl."/dashboard/view-order.php";
echo '<script>window.location = "'.$BaseUrl.'/artandcraft/dashboard/invoice.php?order='.$_GET['r'].'";</script>';

}  
// $resulttt = $o->readBuyerOrdertotal($_GET['order']);
// $rerre = mysqli_fetch_array($resulttt);


?>


<section class="">
<div class="container-fluid">
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
<?php 
include('left-menu.php'); 
?> 
</div>

<div class="col-md-10">
<div class="panel panel-default">
<div class="panel-heading"> Dashboard / Return</div>
</div>
<div class="row" style=" margin-top: 12px; ">
<div class="col-md-6 mb-3">
<div class="panel panel-default">
<div class="panel-heading">
Delivery Address:
</div>
<div class="panel-body">
<address style=" height: 105px; ">



<?php  

$con =  mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
die('Not Connected To Server');
}

//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}

$uid=$_SESSION["uid"];

//print_r($uid); die;

$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 1"; 
$result34 = $con -> query($shippingdata);
/*print_r($result34);*/
//print_r($result);
/*if ($result->num_rows == 0) {
$shippingdata = "SELECT * FROM addshipping_address WHERE uid= $uid AND status= 0"; 

$result = $con -> query($shippingdata);

}
*/

$row34 = mysqli_fetch_assoc($result34);

//print_r($row);
//print_r($shippingdata);

//print_r(expression)
?>
<?php if (!empty($row34)) { ?>

<div class="a-section address-section-with-default">
<div class="a-row a-spacing-small">               

<?php $co = new _country;
$result3 = $co->readCountryName($row34['country']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);


} ?>

<?php
$co = new _state;
$result4 = $co->readStateName($row34['state']);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);

}
?>


<h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text  a-text-bold" style="font-weight: bold; text-transform: capitalize;"><?php echo $row34['fullname'];?></h5></span></b>

<span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text"><?php echo $row34['fulladdress'];?>


<span id="address-ui-widgets-AddressLineTwo" class="id-addr-ux-search-text"> <?php echo $row34['landmark'];?>


<span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text"><?php echo $row34['city'];?>, <?php echo  $row4['state_title'];?> <?php echo $row1['zipcode'];?>


<span id="address-ui-widgets-Country" class="id-addr-ux-search-text"> <?php echo $row34['country_title'];?><br>


<span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Phone Number: &#8234;<?php echo $row34['phone'];?>&#8236;


<?php } ?>
<br><br>
Order Id : ORDER_<?php echo base64_decode($_GET['order']); ?>





</address>
</div>
</div>                
</div>
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">
More Action:
</div>
<div class="panel-body">
<address style=" height: 105px; ">
<strong>Download Invoice <br></strong>
<div class="text-right">
<a href="#" class="btn btn-success btn-border-radius">Download</a>
<div>
</address>
</div>
</div>
</div>
</div>




<div class="pro_detail_box">
<?php

$result = $o->readBuyerOrdertotalpropar(base64_decode($_GET['order']),$_SESSION['pid']);

if ($result) {
$i = 1;
$totalprice=0;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);
$resultstatus = $o->existStatus($id);	

//echo $o->tr->sql; die;
$rowststus = mysqli_fetch_array($resultstatus);

$p = new _postingviewartcraft;
$pres = $p->singletimelines($spPostings_idspPostings);
$resrp = mysqli_fetch_array($pres);

$pic = new _postingpicartcraft;
$res2 = $pic->read($spPostings_idspPostings);

while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
}

?>                      
<div class="row mb-5" style="margin-bottom: 34px;margin: 10px;">
<div class="col-1 col-md-1">
<a href="/artandcraft/detail.php?postid=<?php echo $spPostings_idspPostings; ?>"><img width="100px" src="<?php echo $pic2; ?>" class="img-responsive"></a>
</div>
<div class="col-2 col-md-2">
<a href="/artandcraft/detail.php?postid=<?php echo $spPostings_idspPostings; ?>"><?php echo $resrp['spPostingTitle']; ?>  </a><br>
Quantity: <?php echo $spOrderQty; ?><br>
<?php
$subtotal = $spOrderQty*$price;
echo $spOrderQty.'*$'.$price.' = $'.$subtotal; 

$totalprice = $totalprice+$subtotal; 
?><br>

<a href="<?php echo $BaseUrl.'/friends/?profileid='.$resrp['idspProfiles']; ?>">
<?php
$prs = new _spprofiles;
$result12 = $prs->read($resrp['idspProfiles']);
$resprofile = mysqli_fetch_array($result12);
echo 'Seller : '.$resprofile['spProfileName'];
?>


</a>
</div>
<div class="col-6 col-md-6 hh-grayBox pt45 pb20">
<div class="justify-content-between" style="width:100%;">
<div class="order-tracking completed" style="width:25%; float: left;">
<span onclick="work('Ordered',<?php echo $id; ?>);" class="is-complete" style=" cursor: pointer; "></span>
<small>Ordered<br><span><?php 
$dt1 = new DateTime($payment_date);
echo $dt1->format('d-M-Y'); 

?></span></small>
</div>
<div class="order-tracking <?php if($rowststus['Shipped'] == 1){ echo 'completed' ; } ?>" style="width:25%; float: left;">
<span onclick="work('Shipped',<?php echo $id; ?>);" class="is-complete" style=" cursor: pointer; "></span>
<small>Shipped<br>
<span>
<?php  
if($rowststus['Shipped'] == 1){ 
$dt1 = new DateTime($rowststus['Shipped_date']);
echo $dt1->format('d-M-Y'); 
}					 
?>
</span>
</small>
</div>
<div class="order-tracking <?php if($rowststus['Out_Of_Delivery'] == 1){ echo 'completed' ; } ?>" style="width:25%; float: left;">
<span  onclick="work('Out Of Delivery',<?php echo $id; ?>);" class="is-complete" style=" cursor: pointer; "></span>
<small>Out Of Delivery<br>
<span>
<?php  
if($rowststus['Out_Of_Delivery'] == 1){ 
$dt2 = new DateTime($rowststus['Out_Of_Delivery_date']);
echo $dt2->format('d-M-Y'); 
}					 
?>
</span>
</small>
</div>
<div class="order-tracking  <?php if($rowststus['Cancel'] == 1){ echo 'noocompleted' ; }elseif($rowststus['Delivered'] == 1){ echo 'completed' ; } ?>" style="width:25%; float: left;">
<span class="is-complete" style=" cursor: pointer; "></span> 
<small><?php if($rowststus['Cancel'] == 1){ echo 'Canceled' ;}else{ echo 'Delivered'; } ?><br>

<span>

<?php  
if($rowststus['Cancel'] == 1){ 
$dt3 = new DateTime($rowststus['Cancel_date']);
echo $dt3->format('d-M-Y'); 
}elseif($rowststus['Delivered'] == 1){ 
$dt3 = new DateTime($rowststus['Delivered_date']);
echo $dt3->format('d-M-Y'); 
}					 
?>
</span>
</small>

</div>  
</div>

</div>



<?php
$order_id2=base64_decode($_GET['order']);

$res=$o->refundStatus($order_id2,$spPostings_idspPostings);
// print_r($res);
foreach($res as $row){
if($row['refund_complete']==1){
?>
<span style="color:green"><?=$msg?></span>

<?php
}else{
?>
<div class="col-2 col-md-2">


<?php  
if($rowststus['Cancel'] == 0 && $rowststus['Delivered'] ==0){  ?>

<a class="btn btn-danger btn-border-radius" href="<?php echo $BaseUrl.'/artandcraft/dashboard/invoice.php?orderPid='.$id.'&action=Cancel&r='.$_GET['order'].'&done_by=0';?>">Cancel</a>

<?php	} ?>
<?php if($rowststus['Delivered'] == 1 && $rowststus['Cancel'] == 0){
if($rowststus['return_request'] == 0){  	 ?>
<a class="btn btn-primary btn-border-radius" href="<?php echo $BaseUrl.'/artandcraft/dashboard/invoice.php?orderPid='.$id.'&action=return_request&r='.$_GET['order'];?>">Refund Request</a>	 
<?php }else{ 






if(!empty($Carrier) and !empty($Tracking_Id)){
echo "Refund Proccessed<br><br>";
?>
<button type="button" class="btn btn-primary btn-border-radius" data-toggle="modal" data-target="#exampleModal">Action</button><br><br>

<?php 
$order_id1=base64_decode($_GET['order']);
echo "<a  class='btn btn-success btn-border-radius'   href='?order_id={$order_id1}&product_check_id={$spPostings_idspPostings}&action=order_complete'>Refund Complete</a>";


}

else{
echo "Refund Requested";
}







?>


<?php	} } ?>
<?php if($rowststus['Cancel'] == 1){  
if($rowststus['done_by']==0){ 
echo "Cancelled By Buyer";
}elseif($rowststus['done_by']==1){
echo "Cancelled By Seller";
}

} 
?>



</div>
</div>
<?php
}
}
}
}
?>						
<div style="float:right;">						
Total Price : <?php echo '$'.$totalprice; ?>
</div>				
</div>

</div>         


</div>
</div>
</section>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"> Refund Requested</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="post">
<div class="modal-body">
<div class="row">
<input type="hidden" value="<?php echo $id; ?>" name="order_products_id">
<input type="hidden" value="<?php echo $_GET['order']; ?>" name="r">
<div class="col-md-6">
<span>Carrier</span>
<input type="text" class="form-control" name="Carrier" value="<?php echo $Carrier; ?>">
</div>
<div class="col-md-6">
<span>Tracking Id</span>
<input type="text" class="form-control" name="Tracking_Id" value="<?php echo $Tracking_Id; ?>">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius" name="Tracking_Id_Save_Submit">Save changes</button>
</div>
</div>
</form>
</div>
</div>
</div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>


</body>
</html>
<?php
} ?>