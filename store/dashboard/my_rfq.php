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
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


<style type="text/css">

body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}


.buyer{
max-width: 100px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
display:table;
height: 100%;
width: 100%;
}
.vertical-align-center {

display: table-cell;
vertical-align: middle;
}
.modal-content {

width:inherit;
height:inherit;

margin: 0 auto;
}
#example1_wrapper{
margin-top: -12px;

}
#example1_filter{
margin-bottom: 6px;
}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color: white;
}
</style>         
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php 
$activePage = 54;
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
$storeTitle = " Dashboard / Active Products";
// include('../top-dashboard.php');
//include('../searchform.php');     
/*
$activePage = 52;    */    
$activePage = 54;          
?>

<div class="row">

<!--    <div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
<li><a href="#">Paid Bid</a></li>

</ul>


<div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>

<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||  $activePage = 50 ||  $activePage = 51 ||  $activePage = 52 ||  $activePage = 54)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div>

</div>
-->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
.panel .panel-body {
padding: 15px 0px 9px!important;
}

</style>
<div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

<li><a href="#">My RFQ</a></li>

</ul>
</div>

<div class="col-md-12">

<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>

</div>







<div class="col-md-12">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
<div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
border-color: #BACCE8;">
<ul class="nav nav-tabs">

<li class="active"><a href="#tab1warning" data-toggle="tab">Public RFQ</a></li>
<li><a href="#tab2warning" data-toggle="tab">Private RFQ</a></li>


</ul>
</div>
<?php    $r = new _rfq;
$result = $r->readrfqprofile($_SESSION['pid']);
if($result!=false){
$table1="example1";

}else{
$table1="";

}

?>




<div class="">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group"> 			Show Numbers Of Rows 	
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div> -->
<!-- <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div> -->
</div>




<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">


<div class="col-sm-12 ">
<div class="">
<div class="table-responsive1">
<table class="table tbl_store_setting" >
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example" style="width: 100%;">
<!-- <table class="table tbl_store_setting display " id="<?php echo $table1; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- <th>ID</th> -->
<th></th>
<th>Title</th>
<th>Category</th>
<th>Quantity</th>
<th>Expected date of arrival</th>


<th>Date and Time</th>
<th>No. of Quote</th>
<th>Price</th>
<th>View Quotation</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php

$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}

$r = new _rfq;
$result = $r->readrfqprofile($_SESSION['pid']);

// echo $r->ta->sql; 
if($account_status!=1){
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
/*print_r($row);*/

$result1 = $r->readRfqComment($row['idspRfq']);

// echo $r->tcd->sql; 

//$row['rfqprice'];
$Quatationcount  = $result1->num_rows;



/* if ($result1) {

while ($row1 = mysqli_fetch_assoc($result1)) {



}
}*/

?>
<tr>
<!-- <td class="text-center"></?php echo $i; ?></td> -->
<td></td>
<td class="eventcapitalize"><?php echo $row['rfqTitle'];?></td>
<td><?php echo $row['rfqCategory']; ?></td>
<td class="text-center" ><?php echo $row['rfqQty']; ?></td>

<td><?php echo $row['rfqDelivered']; ?></td>




<td><?php echo $row['created']; ?></td>



<td class="text-center"><?php if ($Quatationcount) {
echo $Quatationcount; 
}else{
echo "0";
}
?></td>



<td>
<?php if ($row['rfqprice'] >= 0) {
echo $curr.' '.$row['rfqprice'];
}else{

echo "0";

}?>

</td>

<td class="text-center" ><a href="<?php echo $BaseUrl.'/store/dashboard/quotation_list.php?idspRfq='.$row['idspRfq'];?>" style="font-weight: bold;  text-decoration: underline;  font-size: 16px; color:green;"><i class="fa fa-eye" style="font-size: 18px;color:#428bca"></i></a></td>

<div class="modal fade" id="myquotation<?php echo $row['idspRfq'];?>" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content no-radius sharestorepos bradius-15">
<div class="modal-header bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="quotationModalLabel"><b>Public RFQ (<small>Request For Quote</small>)</b></h3>
</div>


<?php $timestamp = time();?>
<div class="modal-body">
<input type="hidden" name="buyeremail_" value=""/>
<input type="hidden" name="buyername_" value=""/>


<input type="hidden" name="quote_id" id="quote_id<?php echo $row['idspRfq'];?>" value="<?php echo $row['idspRfq'];?>">    
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label>Category<span class="red">*</span></label><span id="rfqCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>


<input type="text"class="form-control" name="rfqCategory" id="rfqCategory"  value="<?php echo $row['rfqCategory']; ?>">
</div>
</div>




<div class="col-md-4">
<div class="form-group">
<label>Quantity required<span class="red">*</span></label><span id="rfqQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" name="rfqQty" id="rfqQty"  value="<?php echo $row['rfqQty']; ?>" />
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Expected date of arrival<span class="red">*</span></label><span id="rfqDelivered_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>


<input class="form-control" data-filter="1" size="16" id="rfqDelivered" name="rfqDelivered" type="text" value="<?php echo $row['rfqDelivered']; ?>">


</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry">Country <span class="red">*</span></label>
<span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>



<?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($row['rfqCountry']);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry); ?>

<input type="text" id="spUserCountry" class="form-control " name="spQuotationCountry" value="<?php echo $row4['country_title'];?>">
<?php  }
?>




</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<div class="form-group">
<label for="spPostingCity">State <span class="red">*</span></label>
<span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>


<?php
$st = new _state;
$result_stat = $st->readStateName($row['rfqState']);
if ($result_stat) {
$row6 = mysqli_fetch_assoc($result_stat);?>


<input type="text" id="spUserState" class="form-control " name="spQuotationState" value="<?php echo $row6['state_title']; ?>">
<?php   }
?>
</div>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City <span class="red">*</span></label>
<span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>


<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($row['rfqCity']);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);?>

<input type="text" id="spUserCity" class="form-control " name="spQuotationCity" value="<?php echo $row5['city_title']; ?>">
<?php  }
?>
</div>
</div>
</div>

</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="Quotereached">Quote Reached<span class="red">*</span></label><span id="quotereached_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>


<input type="text"  class="form-control"  name=" spQuotereached" id="Quotereached" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotereached']; ?>"/> 
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Payment<span class="red">*</span></label><span id="deleveryprice_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>

<input type="number" class="form-control" id="deleveryprice<?php echo $row['idspRfq'];?>" name="spQuotationPrice" min="1" max="50" onkeyup="keyupQuotationfun()" >
</div>
</div>
</div>
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label>Description<span class="red">*</span></label><span id="rfqDesc_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea class="form-control" name="rfqDesc" rows="6" id="rfqDesc" onkeyup="keyupQuotationfun()" maxlength="500" value="<?php echo $row['rfqDesc']; ?>"><?php echo $row['rfqDesc']; ?></textarea>
</div>
</div>


</div>


</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-submit  db_btn db_primarybtn" id="quotationsubmit"  onclick="get_Quotationdata(<?php echo $row['idspRfq'];?>)">Submit</button>
</div>
</form>
</div>
</div>
</div>                                            

<td> <a href="#" data-toggle='modal' class="btn" style="background-color: #55C94D; color: #fff;"  data-target="#myquotation<?php echo $row['idspRfq'];?>">Re-submit RFQ</a>
<a  onclick="hello('<?php echo $BaseUrl.'/store/dashboard/delete_my_rfq.php?postid='.$row['idspRfq']; ?>')"> <i title="Delete" class="fa fa-trash" ></i></a>
<!-- 
<a href="javascript:void(0)" class="btn" style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;    margin-top: 10px;"  onclick="javascript:chatWith('<?php echo $row['spProfiles_idspProfiles']; ?>')">Chat</a> -->



</td>






</tr>
<?php
$i++;


?>

<?php

}

}}else{
?>
<tr>
<td colspan="9">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
<!--		Start Pagination -->
<div class='pagination-container'>
<nav>
<ul class="pagination">
<!--	Here the JS Function Will Add the Rows -->
</ul>
</nav>
</div>

</div> <!-- 		End of Container -->


</div>
</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {

var table = $('#example1').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

});
table.destroy();
});
</script>

<?php
$en = new _spquotation;
$result = $en->getbuyerquotation($_SESSION['pid']);
if($result!=false){
$table2="example2";
}
else{

$table2="";
}
?>


<div class="tab-pane fade" id="tab2warning">
<div class="col-md-12 ">
<!--  <div class=""> -->
<div class="table-responsive1">
<table class="table tbl_store_setting">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example1">
<!-- <table class="table tbl_store_setting display " id="<?php echo $table2; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- <th class="text-center">ID</th> -->

<!-- <th>Image</th> -->
<th></th>
<th>Title</th>

<!--  <th>Title</th> -->

<th>Quantity</th>
<th>Date and Time</th>
<th>Price</th>
<th>Comment</th>
<!--  <th>Status</th> -->
<th>Seller message</th>
<th>Status</th>
<th class="text-center">Action</th>
<!--   <th class="text-center">Action</th> -->

</tr>
</thead>
<tbody>
<?php
$en = new _spquotation;
$result = $en->getbuyerquotation($_SESSION['pid']);
//echo $en->ta->sql;
if($account_status!=1){
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {




$ch = new _rfqchat;
$commresult  = $ch->getsellercomment($row['idspQuotation']);
// echo $ch->ta->sql;            

if($commresult != false)
{
while ($commrow = mysqli_fetch_assoc($commresult)) {

//  print_r($commrow);

$Sellercomment = $commrow["sellercomments"];
$Scommentid = $commrow["id"];
$commid = $commrow["comment_id"];                                                                    

}
}






?>
<tr>
<td></td>
<td class="text-center"><?php echo $i; ?></td>

<!--   <td>  <?php  

$pic = new _productpic;
$resultpic = $pic->read($row['spPostings_idspPostings']);

if ($resultpic != false) {
$rowpic = mysqli_fetch_assoc($resultpic);
$picture = $rowpic['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' style='height:70px; width:80px;'>";
} else{
echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?></td> -->

<td class="eventcapitalize">




<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['spPostings_idspPostings']?>">

<?php 
$pst = new _productposting;
$result3 = $pst->read($row['spPostings_idspPostings']);



if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['spPostingTitle'];
}
?>
</td>


<!--  <td class="eventcapitalize"><?php echo $row['spQuotationProductName'];?></td> -->

<td><?php echo $row['spQuotationTotalQty'];?></td>
<td><?php echo $row['createddatetime'];?></td>
<td><?php if ($row['spQuotationPrice'] >= 0) {
echo $curr.' '.$row['spQuotationPrice'];
}else{

echo "0";

}?></td>



<!-- Modal -->
<div class="modal fade" id="<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Comment</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                                                            
<td class="buyer">
<a href="" data-toggle="modal" data-target="#<?php echo $row['idspQuotation'];?>"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></a>
</td>

<!--   <td>status</td> -->

<!-- Modal -->
<div class="modal fade" id="p<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Message</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo $Sellercomment; ?>

</p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                                 
<td class="buyer">    

<?php if (isset($Sellercomment) && $row['idspQuotation'] == $commid) { ?>
<a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>

<?php  }else{ ?>
<p>No Message</p>
<?php } ?>


</td>

<td>


<?php   $qu = new _quotation_transection;
$quote_res  = $qu->getrfqorder($row['idspQuotation']);

//   echo $qu->ta->sql;

if ($quote_res) {
$quote_row = mysqli_fetch_assoc($quote_res);
//echo $quote_row['spPostingTitle'];

echo "Pyament Successful";
}else{
echo "Waiting for reply";
} ?></td>  


<td>
<?php   

// ===PAYPAL ACCOUNT LIVE SETTING
// RETURN CANCEL LINK
$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK

$success_return = $BaseUrl."/paymentstatus/quotation_payment_success.php?idspQuotation=".$row['idspQuotation']."&sell_idquotation=".$row['spQuotationSellerid'];


// print_r($success_return);
// ===END
// ===LOCAL ACCOUNT SETTING
// RETURN CANCEL LINK
//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
// ===END



//Here we can use paypal url or sanbox url.
// sandbox
$paypal_url     = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
// live payment
//$paypal_url       = 'https://www.paypal.com/cgi-bin/webscr';
//Here we can used seller email id. 
$merchant_email = 'developer-facilitator@thesharepage.com';
// live email
//$merchant_email = 'sharepagerevenue@gmail.com';

//paypal call this file for ipn
//$notify_url   = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";



?>



<form action="<?php echo $paypal_url; ?>" method="post" class="form-inline text-right">
<input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
<!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
<input type="hidden" name="return" value="<?php echo $success_return; ?>">
<input type="hidden" name="rm" value="2" />
<input type="hidden" name="lc" value="" />
<input type="hidden" name="no_shipping" value="1" />
<input type="hidden" name="no_note" value="1" />
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="page_style" value="paypal" />
<input type="hidden" name="charset" value="utf-8" />
<input type="hidden" name="cbt" value="Back to FormGet" />

<!-- Redirect direct to card detail Page -->

<input type="hidden" name="landing_page" value="billing">

<!-- Redirect direct to card detail Page End -->


<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">



<?php

echo "<input type='hidden' name='item_name_1' value='".$row3['spPostingTitle']."'>";

echo "<input type='hidden' name='item_number' value='143' >";

echo "<input type='hidden' class='".$row['idspQuotation']."' name='amount_1' value='".$row['spQuotationPrice']."'>";

echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
?>




<!-- <?php 
/*
// print_r($row['idspQuotation']);

$ch = new _rfqchat;
$ch_res =  $ch->getsellercomment($row['idspQuotation']);

$row_ch = mysqli_fetch_assoc($ch_res);
//echo $ch->ta->sql; 
//    echo "here";    print_r($row_ch);

if($ch_res->num_rows == 0){ ?>


<a href="#"  data-toggle='tooltippay' title="The button will activate after seller response." class="btn" style="background-color: #00c0ef;
color: #fff; font-size: 10px; height: 38px;width: -webkit-fill-available;" disabled>Pay</a>
<br>
<a href="#" data-toggle='tooltippay' title="The button will activate after seller response." class="btn" style="background-color: #55C94D; color: #fff;   font-size: 9px; max-width: 72px;margin-top: 8px;    border-radius: 25px;
float: left;width: -webkit-fill-available;
"  data-target="#myquotation<?php echo $row['idspQuotation'];?>" disabled>Re-submit<br>Quote</a>

<?php  }else{ ?>

<button type="submit" class="btn" style="background-color: #00c0ef;
color: #fff; font-size: 10px; height: 29px;border-radius: 25px;float: left;">Pay</button>
<br>   
<a href="#" data-toggle='modal' class="btn" style="background-color: #55C94D; color: #fff;  font-size: 9px;  max-width: 72px;margin-top: 8px;    border-radius: 25px;
float: left;width: -webkit-fill-available;"  data-target="#myquotation<?php echo $row['idspQuotation'];?>">Re-submit<br>Quote</a>
<?php  }  */?> -->

<!-- <button type="submit" class="btn" style="background-color: #00c0ef;
color: #fff; border-radius: 25px; min-width: 100px;">Pay</button>
<br>    -->
<a href="#" data-toggle='modal' class="btn  btn-border-radius" style="background-color: #55C94D;
color: #fff;font-size: 9px; margin-top: 6px; margin-bottom: 6px;min-width: 100px;"  data-target="#myquotation<?php echo $row['idspQuotation'];?>">Re-submit<br>Quote</a>


<a href="javascript:void(0)" class="btn  btn-border-radius" style="background-color: #00c0ef;
color: #fff; min-width: 100px;"  onclick="javascript:chatWith('<?php echo $row['spQuotationSellerid']; ?>')">Chat</a>
</form>


</td>

<div class="modal fade" id="myquotation<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content no-radius sharestorepos bradius-15">
<div class="modal-header bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="quotationModalLabel"><b>Request For Quotations(Private RFQ)</b></h3>
</div>
<!--  <form enctype="multipart/form-data" action="../buy-sell/sendquotationprice.php" method="post" id="quotationform"> -->

<?php $timestamp = time();?>
<div class="modal-body">
<input type="hidden" name="buyeremail_" value=""/>
<input type="hidden" name="buyername_" value=""/>
<!-- ==================== -->
<!-- jo product buy kr raha ha -->
<!--  <input type="hidden" name="spQuotationBuyerid" value="<?php echo $_SESSION['pid']?>" /> -->

<!-- jo product sale kr raha ha -->
<!--    <input type="hidden" class="dynamic-pid" name="spQuotationSellerid" id="spQuotationSellerid" value="" />
-->
<!--    <input type="hidden" name="spPostings_idspPostings" id="spPosting" value="<?php echo $rows['idspPostings']?>">

<input type="hidden" class="dynamic-pid" name="createddatetime"  value="<?php echo(date("F d, Y h:i:s", $timestamp));?>" /> -->

<input type="hidden" name="quote_id" id="quote_id<?php echo $row['idspQuotation'];?>" value="<?php echo $row['idspQuotation'];?>">    
<div class="row">
<!-- <div class="col-md-4">
<div class="form-group">
<label for="productname" class="control-label contact">Product Name <span class="red">*</span></label>
<span id="spQuotationProduct_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>

<input type="text" class="form-control" name="spQuotationProductName" value=""  id="spQuotationProduct" onkeyup="keyupQuotationfun()">

</div>
</div> -->

<div class="col-md-4">
<div class="form-group">
<label for="spQuotationTotalQty" class="control-label contact">Quantity Required <span class="red">*</span></label>
<span id="spQuotationTotalQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" id="spQuotationTotalQty" name="spQuotationTotalQty" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationTotalQty']; ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="deleverytime" class="control-label contact">Delivery (Days) <span class="red">*</span></label>
<span id="deleverytime_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationTotalQty']; ?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="deleveryprice" class="control-label contact">Payment <span class="red">*</span></label>
<span id="deleveryprice_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" id="deleveryprice<?php echo $row['idspQuotation'];?>" name="spQuotationPrice" min="1" max="50" onkeyup="keyupQuotationfun()" >
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry">Country <span class="red">*</span></label>
<span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<!--  <select id="spUserCountry" class="form-control " name="spQuotationCountry" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationDelevery']; ?>">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select> -->


<?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($row['spQuotationCountry']);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry); ?>

<input type="text" id="spUserCountry" class="form-control " name="spQuotationCountry" value="<?php echo $row4['country_title'];?>">
<?php  }
?>




</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<div class="form-group">
<label for="spPostingCity">State <span class="red">*</span></label>
<span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<!--    <select class="form-control" name="spQuotationState" id="spUserState" onkeyup="keyupQuotationfun()">
<option value="">Select State</option>
</select> -->


<?php
$st = new _state;
$result_stat = $st->readStateName($row['spQuotationState']);
if ($result_stat) {
$row6 = mysqli_fetch_assoc($result_stat);?>


<input type="text" id="spUserState" class="form-control " name="spQuotationState" value="<?php echo $row6['state_title']; ?>">
<?php   }
?>
</div>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City <span class="red">*</span></label>
<span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<!--  <select class="form-control" name="spQuotationCity" id="spUserCity" onkeyup="keyupQuotationfun()">
<option value="">Select City</option>
</select> -->

<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($row['spQuotationCity']);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);?>

<input type="text" id="spUserCity" class="form-control " name="spQuotationCity" value="<?php echo $row5['city_title']; ?>">
<?php  }
?>
</div>
</div>
</div>

</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="productdetails" class="control-label contact">Comments <span class="red">*</span></label>
<span id="productdetails_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea class="form-control" id="productdetails" name="spQuotatioProductDetails" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotatioProductDetails']; ?>"><?php echo $row['spQuotatioProductDetails']; ?></textarea>

</div>
</div>
</div>


</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-submit  db_btn db_primarybtn" id="quotationsubmit"  onclick="get_Privaterfq(<?php echo $row['idspQuotation'];?>)">Submit</button>
</div>
<!--      </form> -->
</div>
</div>
</div>

<!--Modal For Quatation Complete-->




</tr>
<?php
$i++;
}
}}
else{
?>
<tr>
<td colspan="9">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

</tbody>
</table>

<!--		Start Pagination -->
<div class='pagination-container'>
<nav>
<ul class="pagination">
<!--	Here the JS Function Will Add the Rows -->
</ul>
</nav>
</div>

</div> <!-- 		End of Container -->
</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">
$(document).ready(function() {

var table = $('#example2').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

});
});
function hello(ida){
//alert('====');
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
if (result.isConfirmed) {
window.location.href =ida;
} 
});

}
</script>
<!--  <div class="tab-pane fade" id="tab5warning">Warning 5</div> -->
</div>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var table = $('#example').DataTable({
paging: true, // Enable pagination
select: false,
columnDefs: [{
className: "Name",
targets: [0],
visible: false,
searchable: false
}]
});

$('#example tbody').on('click', 'tr', function() {
// Handle row click event here
});
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var table = $('#example1').DataTable({
paging: true, // Enable pagination
select: false,
columnDefs: [{
className: "Name",
targets: [0],
visible: false,
searchable: false
}]
});

$('#example tbody').on('click', 'tr', function() {
// Handle row click event here
});
});
</script>



<script type="text/javascript">
//function get_approvedata(id){


$(document).ready(function(){
$('[data-toggle="tooltippay"]').tooltip();   
});




function get_Privaterfq(id){
//alert();


var quote_id = $("#quote_id"+id).val()

var deleveryprice = $("#deleveryprice"+id).val()

if (deleveryprice == "") {

$("#deleveryprice_error").text("Please Enter Price.");
$("#deleveryprice").focus();


return false;
}else{
$.ajax({
type: 'POST',
url: '../../buy-sell/sendquotation.php',
data: {quote_id: quote_id, deleveryprice: deleveryprice},


success: function(response){ 

//console.log(data);

swal({

title: "Submitted Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});


}
});

}
}





</script>   

<script type="text/javascript">
function get_Quotationdata(id){
//alert();


var quote_id = $("#quote_id"+id).val()

var deleveryprice = $("#deleveryprice"+id).val()

if (deleveryprice == "") {

$("#deleveryprice_error").text("Please Enter Price.");
$("#deleveryprice").focus();


return false;
}else{
$.ajax({
type: 'POST',
url: '../../public_rfq/addrfq.php',
data: {quote_id: quote_id, deleveryprice: deleveryprice},


success: function(response){ 

//console.log(data);

swal({

title: "Submitted Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});


}
});

}
}

</script>
</body>
</html>
<?php
} ?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>

getPagination('#table-id');
$('#maxRows').trigger('change');
function getPagination (table){

$('#maxRows').on('change',function(){
$('.pagination').html('');						// reset pagination div
var trnum = 0 ;									// reset tr counter 
var maxRows = parseInt($(this).val());			// get Max Rows from select option

var totalRows = $(table+' tbody tr').length;		// numbers of rows 
$(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
trnum++;									// Start Counter 
if (trnum > maxRows ){						// if tr number gt maxRows

$(this).hide();							// fade it out 
}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
});											//  was fade out to fade it in 
if (totalRows > maxRows){						// if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
//	numbers of pages 
for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
$('.pagination').append('<li data-page="'+i+'">\
<span>'+ i++ +'<span class="sr-only">(current)</span></span>\
</li>').show();
}											// end for i 


} 												// end if row count > max rows
$('.pagination li:first-child').addClass('active'); // add active class to the first li 


//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
showig_rows_count(maxRows, 1, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

$('.pagination li').on('click',function(e){		// on click each page
e.preventDefault();
var pageNum = $(this).attr('data-page');	// get it's number
var trIndex = 0 ;							// reset tr counter
$('.pagination li').removeClass('active');	// remove active class from all li 
$(this).addClass('active');					// add active class to the clicked 


//SHOWING ROWS NUMBER OUT OF TOTAL
showig_rows_count(maxRows, pageNum, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL



$(table+' tr:gt(0)').each(function(){		// each tr in table not the header
trIndex++;								// tr index counter 
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
$(this).hide();		
}else {$(this).show();} 				//else fade in 
}); 										// end of for each tr in table
});										// end of on click pagination list
});
// end of on select change 

// END OF PAGINATION 

}	




// SI SETTING
$(function(){
// Just to append id number for each row  
default_index();

});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
//Default rows showing
var end_index = maxRows*pageNum;
var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
$('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
$('table tr:eq(0)').prepend('<th> ID </th>')

var id = 0;

$('table tr:gt(0)').each(function(){	
id++
$(this).prepend('<td>'+id+'</td>');
});
}

// All Table search script
function FilterkeyWord_all_table() {

// Count td if you want to search on all table instead of specific column

var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

// Declare variables
var input, filter, table, tr, td, i;
input = document.getElementById("search_input_all");
var input_value =     document.getElementById("search_input_all").value;
filter = input.value.toLowerCase();
if(input_value !=''){
table = document.getElementById("table-id");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 1; i < tr.length; i++) {

var flag = 0;

for(j = 0; j < count; j++){
td = tr[i].getElementsByTagName("td")[j];
if (td) {

var td_text = td.innerHTML;  
if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
//var td_text = td.innerHTML;  
//td.innerHTML = 'shaban';
flag = 1;
} else {
//DO NOTHING
}
}
}
if(flag==1){
tr[i].style.display = "";
}else {
tr[i].style.display = "none";
}
}
}else {
//RESET TABLE
$('#maxRows').trigger('change');
}
}
</script>
