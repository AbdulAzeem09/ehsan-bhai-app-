<?php 
// error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../../univ/baseurl.php');
include('../../univ/main.php');

session_start();
// print_r($_SESSION);
// die('=====');
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="freelancer/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$f = new _spprofiles;
$sl = new _shortlist;
$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;

$_GET['categoryID'] = 5;

$activePage = 19;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->

<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>	
<style>

div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}
</style>
<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">



<!--  <div class="sidebar col-xs-1 col-sm-1" id="sidebar" >


</div> -->
<div class="col-xs-12 col-sm-12 nopadding">

<p class="back-to-projectlist" style="margin-top: 28px;">
<a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_hire_project.php';?>" style="color:#ff6b04;"><i class="fa fa-chevron-left"></i>&nbsp; Back to Hire list</a>
</p>

<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 12px;"> 
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/freelancer_hire_project.php">Hired Freelancer </a></li>
<li>Project detail</li>
<!-- <li><?php echo $title;?></li> -->
<?php if($_SESSION['ptid'] != 2){?>
<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>

<?php } ?>
</ul>
</div>
</div>
<?php

//print_r($_SESSION);
?>
<!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
<li>Project Detail</li>

</ul>
</div>
</div> -->
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

<?php
$sf  = new _freelance_chat_project;

$res = $sf->read($postid);



if($res->num_rows > 0){
$row = mysqli_fetch_assoc($res);
//   print_r($row);
$overview = $row['chat_conversation'];

$res_new =$row['id'];
$pro_new = $sf->read_reciver($res_new);
$reci=mysqli_fetch_assoc($pro_new);
if($reci){
$sender_pro=$reci['sender_idspProfiles'];
}

$f = new _spprofiles;
$iduser=$row['receiver_idspProfiles'];
$pro = $f->read($row['receiver_idspProfiles']);
if($pro!=false){
$pro_data = mysqli_fetch_assoc($pro);
$spuser_idspuser=$pro_data['spUser_idspUser'];
}
//print_r($pro_data);
/*  echo "<pre>";
print_r($row);*/
$cu= new _spuser;
$cu1=$cu->readdatabybuyerid($spuser_idspuser);
if($cu1!=false){
$cu2=mysqli_fetch_assoc($cu1);
$curren=$cu2['currency'];

}



$fi = new _spfreelancer_profile;
$result_fi = $fi->read($row['receiver_idspProfiles']);
$count = $result_fi->num->rows;

//var_dump($result_fi); 

$row_fi = mysqli_fetch_assoc($result_fi);


$skills = $row_fi['skill'];
$perhour = $row_fi['hourlyrate'];

$skilldata = explode(',', $skills);

} ?>
<div class="col-xs-12 freelancer-post-detail">
<h2 class="designation-haeding freelancer_capitalize"><?php echo "Project for " .ucfirst($pro_data['spProfileName']);?>



<?php if($row['complete_status'] == 0){   




?>

<?php if($_SESSION['ptid'] != 2){?>
<?php   if($_SESSION['pid']==$sender_pro){ ?>
<a class="btn btn-warning incomplete btn-border-radius" style="float:right;color: #fff;" href="<?php echo $BaseUrl.'/freelancer/dashboard/complete_project.php?status=2&postid='.$row['id'];?>">InComplete</a>&nbsp;&nbsp;
<a class="btn btn-info complete btn-border-radius" style="float:right;color: #fff;margin-right: 10px;" href="<?php echo $BaseUrl.'/freelancer/dashboard/complete_project.php?status=1&postid='.$row['id'];?>">Complete</a> 

<?php   } ?> 
<?php   } ?>  


<?php }elseif($row['complete_status'] == 1){

echo "<span style='float:right;'>Project is Completed</span>";

}else{

echo "<span  style='float:right;'>InCompleted</span>";

} ?>                                  

</h2>



<div class="col-xs-12 nopadding">
<?php
if (is_countable($count) && count($skilldata) > 0) 
{
foreach($skilldata as $key => $value){
if($value != ''){
echo "<span class='skills-tags freelancer_uppercase'>".$value."</span>";
}

}
}
?>

</div>
<div class="col-xs-12 nopadding margin-top-13">
<?php if(!empty($perhour)){  ?>
<div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
&nbsp;&nbsp;<span class="red "><?php echo $curren;  ?><?php echo $perhour;?>/hr</span></div>
<?php } ?>

</div>
<div class="col-xs-12 detail-description text-justify">
<p style="word-break: break-word;padding-top: 14px;"><?php echo $overview;?></p>
</div>
</div>
</div>

<!--    milestone -->




<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;"> 

<?php if($_SESSION['ptid'] != 2){?>
<?php   if($_SESSION['pid']==$sender_pro){ ?>
<a class="btn btn-info btn-md btn-border-radius" data-toggle="modal" data-target="#myModal" style="color: #fff;float: right;margin: 3px 6px 0px 0px;">Create Milestone</a>
<?php } ?>
<?php } ?>

<h4 style="padding-left: 10px;">Milestone  </h4>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Craete Milestone <span id="seller_name"> </span><?php //echo $sellerNmae; ?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px;">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form class="row" action="<?php echo $BaseUrl;?>/paymentstatus/payment_success_milestone.php" method="POST" id="paymentForm">
<div class="col-md-2"></div>
<div class="col-md-10">
<div class="row">
<div class="col-md-9 form-group">
<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
<input type="text" name="customerName" id="customerName" class="form-control" maxlength="22" value="<?php echo $cardname ?>" onkeypress="return /[a-z ]/i.test(event.key)" required>
<span id="errorCustomerName" class="text-danger"></span>
</div>
<div class="col-md-9 form-group">
<label>Card Number <span class="text-danger">*</span></label>
<input type="number" name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="" value="<?php echo $cardnumber ?>">
<span id="errorCardNumber" class="text-danger"></span>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-4">
<label style="font-size: 13px;">Expiry Month</label>
<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);" value="<?php echo $month ?>">
<span id="errorCardExpMonth" class="text-danger"></span>
</div>
<script>
$(document).ready(function(){
$("#cardExpMonth").keyup(function(){
var mm = $("#cardExpMonth").val();

if((mm ==0)||(mm ==12)||(mm ==11)||(mm ==10)||(mm ==09)||(mm ==08)||(mm ==07)||(mm ==06)||(mm ==05)||(mm ==04)|(mm ==03)||(mm ==02)||(mm ==01)||(mm ==00)) 
{
$("#cardExpMonth").val(mm);
}
else{
$("#cardExpMonth").val("");
}
})
})
</script>
<div class="col-md-4">
<label>Expiry Year</label>
<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);" value="<?php echo $year ?>">
<span id="errorCardExpYear" class="text-danger"></span>
</div>
<div class="col-md-4">
<label>CVV</label>
<input type="password" name="cardCVC" id="cardCVC" class="form-control" placeholder="XXX"  maxlength="3" onkeypress="return validateNumber(event);" value="<?php echo $cvc ?>">
<span id="errorCardCvc" class="text-danger"></span>
</div>
</div>
</div>
<br>


<div class="col-md-9" align="left" style=" margin-top: 12px; ">

<div class="">
<label><b>Amount <span class="text-danger">*</span></b></label>
<input type="number" name="total_amount" id="total_amountforss" class="form-control" value="" required>

</div>
<br>

<input type="hidden" name="postid" value="<?php echo $postid ?>">
<input type="hidden" id="prodt_currency" name="currency_code" value="<?php echo $curren; ?>">
<input type="hidden" name="shipping_address" value="<?php  echo $shpping_Address; ?>">
<button type="button" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow"  onclick="stripePay(event)" value="Pay Now" href="javascript:;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss"><span></button>
<!--<span class="btn"><input type="checkbox" name="cardDetails" id="cardDetails"> Save Card</span>
<input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
</div>
<br>
</div>
</div>
<div class="col-md-2"></div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close11</button>-->
</div>
</div>
</div>
</div>


<div class="table-responsive">

<table class="table table-striped tbl_store_setting">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Date </th>


<th style="color:#fff;">Amount</th>
<!-- <th style="color:#fff;">Txn ID </th> -->
<th style="color:#fff;">Action </th>


</tr>
</thead>
<tbody>
<?php
//  $p = new _postingview;
$i = 1;
$sf  = new _payment_milestone;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res = $sf->read_miles($postid);

// echo $sf->ta->sql;

if($res!=false){
while($row = mysqli_fetch_assoc($res)){
$amount=$row['payment_gross'];
$cur=$row['mc_currency'];
$status=$row['status'];
$payid=$row['pay_id'];
?>
<tr>

<td><?php echo $i; ?></td>
<td ><p><?php echo date('d-m-Y',(strtotime($row['payment_date']))); ?></p></td>


<td><?php echo $cur.' '.$amount ?></td>
<!-- <td></?php echo $row['txn_id'];?></td> -->
<td>
<?php 
if($status == 0){
?>
<?php   if($_SESSION['pid']==$sender_pro){ ?>
<a id="realease" href="<?php echo $BaseUrl . '/freelancer/dashboard/milestoneUpdate_1.php?status=1&postid=' . $payid .'&pageid=' . $_GET['postid'].'&sellerid=' . $iduser. '&amt='. $amount; ?>" class="btn btn-info btn-border-radius" style="color:#fff;">Release</a>
<a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestoneUpdate_1.php?status=2&postid=' . $payid .'&pageid=' . $_GET['postid'].'&sellerid='. $iduser.'&amt=' .$amount; ?>" class="btn btn-danger rejmile btn-border-radius" style="color:#fff;">Cancel</a>
<?php }  else {}

//echo "Pending";
?>
<?php
}
else if ($status == 1){

echo "released";
}
else if ($status == 2){
echo "Canceled";
}
else{
echo "";
}
?>


</td>                                                
</tr> <?php
$i++;
}
}else{
echo "<td colspan='5'><center>No Milestone </center></td>";
}
?>


</tbody>
</table>
</div>
</div>

</div>
</div>


<script type="text/javascript">

Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');

$(".complete").click(function(e){
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

Swal.fire({
title: 'Are you sure you want to Complete Project?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = link;
}
});

});
$("#realease").click(function(e){
// alert();
e.preventDefault();

var link = $(this).attr('href');

// alert(link)
;
// alert(postid);

swal({
title: "Are you sure you want to Realease?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});



$(".incomplete").click(function(e){
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

Swal.fire({
title: 'Are you sure you want to Incomplete Project?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
if (result.isConfirmed) {
window.location.href = link;
}
});

});




$(".rejmile").click(function(e){
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

swal({
title: "Are you sure you want to Cancel Milestone?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});


$('#m_submit').on('click', function() {

var amount = $("#amount").val();
var description = $("#description").val();

if(amount == "" && description == ""){

$("#amt_err").text("Please Enter Amount");
$("#desc_err").text("Please Enter Milestone Name");
$("#amount").focus();

}else if(amount == ""){

$("#amt_err").text("Please Enter Amount");
$("#amount").focus();

}else if(description == ""){

$("#desc_err").text("Please Enter Milestone Name");
$("#amt_err").text("");
$("#description").focus();
}else{

$("#milestone_frm").submit();

}


});



</script>                                                  

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
} ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
