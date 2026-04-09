<?php
//  ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
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

<link rel="stylesheet" href="https://dixso.github.io/custombox/dist/custombox.min.css">

<script src="https://dixso.github.io/custombox/dist/legacy.min.js"></script>
<script src="https://dixso.github.io/custombox/dist/custombox.min.js"></script>

<style type="text/css">


body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}
div:where(.swal2-container).swal2-center>.swal2-popup {
height: 297px;
font-size: 15px;
}


table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

tr {
background-color: #333333;
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
</style>      







</head>


<body class="bg_gray">






<div id="testmodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Discription</h4>
</div>
<div class="modal-body">
<p><b>Discription : </b><span id="user_name"></span></p>
<!--- <p>Do you want to save changes you made to document before closing?</p>
<p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>--->
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<!-- <button type="button" class="btn btn-primary">Save changes</button>--->
</div>
</div>
</div>
</div>
<div id="testmodal-1" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Discription</h4>
</div>
<div class="modal-body">
<!--<p>Do you want to save changes you made to document before closing?</p>
<p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>--->
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary btn-border-radius">Save changes</button>
</div>
</div>
</div>
</div>






<?php


//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 24;
// include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-sellermenu.php'); 
?>
</div>
</div>
<div class="col-md-10">



<?php 

$storeTitle = " Dashboard / My Send Enquires";
// include('../top-dashboard.php');
// include('../searchform.php');

?>

<div class="row">
<!-- 
<div class="col-md-12">

<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
<li><a href="#">My Send Enquiries</a></li>

</ul>


<div class="text-right" style="margin-top: -10px;">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>

</div>
</div> -->
<div class="col-md-12">
<ul class="breadcrumb" style="background: white !important;  ">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>

<li><a href="#">My RFQ</a></li>

</ul>
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
<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 ">
<div class="">
<?php 
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$r = new _rfq;
$result = $r->readsubmittedRfqquote($_SESSION['pid']);
//echo $r->tcd->sql;

if ($result!=false) {
$tableid="example";
}
else{
$tableid='';
}

?>

<!-- san -->
<div id="composeNewTxt" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content no-radius sharestorepos">
<form method="post">
<div class="modal-header">
<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
</div>
<div class="modal-body">
<?php 
$rq = new _rfq;
$result1 = $rq->sp_rq();
$re_ss=mysqli_fetch_assoc($result1);
//print_r($re_ss);die('=======');
$re_ss['spProfileName']


?>




<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $SellId; ?>">
<div class="form-group">
<label>To <span class="rec_name"> * <span class="error_user"></span></span></label>

</div>
<div class="form-group">
<label>Message<span class="red"> * <span class="error_msg"></span></span></label>
<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-border-radius" data-dismiss="modal">Close</button>
<input type="button" class="btn btn-primary composTxtNow btn-border-radius" id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">
</div>
</form>
</div>
</div>
</div>

<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">
<!-- 		
<div class="form-group"> 			Show Numbers Of Rows 	
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="20">15</option>
<option value="30">20</option>
<option value="40">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>  -->
</div>





<div class="table-responsive1">

<?php
if ($result!=false) {
$pagination = "example";
}
else{
$pagination ="";
}
?>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class tbl_store_setting display" id= "<?php echo $pagination;?>">

<!-- <table class="table tbl_store_setting display" id="<?php echo $tableid;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>

<!-- <th class="text-center" style="width: 50px;">ID</th> -->

<!--   <th>Image</th> -->
<th></th>
<th>Id</th>
<th>Title</th>



<th class="text-center">Cost per item/piece ($)</th>

<th>Description</th>
<!---<th>Payment Status</th> ---->
<th>Action</th> 
<th>Delete</th>

</tr>
</thead>
<tbody>
<?php


$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
$r = new _rfq;
$result = $r->readsubmittedRfqquote_1();
//echo $r->tcd->sql;
//print_r($result);
//die('eeeeeee');
if ($result!=false) {

$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//   echo "<pre>";
// print_r($row);                                                 





?>
<tr>

<td class="text-center"></td> 
<td class="text-center"><?php echo $i; ?></td> 

<!--   <td>    <?php
$image = $row['rfqcImage'];

$x=0;                                                
$car_img = explode(",",$image);
foreach($car_img as $images){                                                 
$x+=1;

}

if(!empty($images)){ ?>                                            
<img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style="height: 60px; width: 70px;" > 
<?php
}else{
//echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
}
?></td>
--> 
<td></td>

<td  class="eventcapitalize"> <a href="<?php echo $BaseUrl.'/store/dashboard/quotation_detail.php?idrfqcomment='.$row['idspRfq']?>"><?php echo $row['rfqTitle'];?></a></td>

<td class="text-center"><?php echo $curr.' '.$row['rfqprice'];?></td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $row['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Description</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo substr($row['rfqDesc'], 0, 50); ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-danger headclosebtn btn-border-radius" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                                                            
<td class="buyer">
<a class=" show-modal" href="" data-toggle="modal" onclick="showdescription('<?php echo substr($row['rfqDesc'], 0, 50); ?>')"><?php echo substr($row['rfqDesc'], 0, 50); ?></a>
</td>
<?php

//$ff=$row['idspRfqComment'];

//print_r($ff);die('===============');

?>

<!---<td>


<?php   $qt = new _rfq_transection;
$rfqquote_res  = $qt->getpublicrfq_order($row['idspRfqComment']);

//echo $qt->ta->sql;

if ($rfqquote_res) {
$rfqquote_res = mysqli_fetch_assoc($rfqquote_res);
//echo $quote_row['spPostingTitle'];

echo "Paid";
}else{
echo "Unpaid";
} ?></td>  ---->

<td><!-- <a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $row['idspQuotation'];?>" 
style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;">Chat</a> -->
<?php

$profile = new _spprofiles;
$p_data = $profile->readuserdata($row['spProfile_idspProfiles']);


if($p_data != false){

$pro_data = mysqli_fetch_assoc($p_data);
$name=$pro_data['spProfileName'];
}

else {
$name='';
}

?>
<a href="javascript:void(0)" class="btn" style="color: #fff!important;  background-color: #55C94D; border-radius: 8px; padding: 2px 12px !important;" data-toggle="modal" data-target="#composeNewTxt" onclick= "sent_msg(<?php echo $row['spProfile_idspProfiles']; ?>,'<?php echo $name; ?>')">Chat</a>

</td>

<!--  <td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $row['idspQuotation'];?>" 
style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;"></a></td>
-->
<!--   <td><a href="javascript:void(0)" class="btn"  style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;" onclick="javascript:chatWith('<?php echo $row['spQuotationBuyerid']; ?>')">Chat</a>
</td>
-->

<!-- <td><a href="<?php echo $BaseUrl.'/store/dashboard/myprivatedelete.php?postid='.$row['idspRfq']; ?>"> Delete</a></td>  -->


<td><a  onclick="hello('<?php echo $BaseUrl.'/store/dashboard/myprivatedelete.php?postid='.$row['idspRfq']; ?>')"> <i title="Delete" class="fa fa-trash" ></i>
</a></td>



</tr>
<?php
$i++;
}
}
else{
?>
<tr>
<td colspan="7">
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

<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script> 

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]

});
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );

</script>



</div>


<div class="tab-pane fade" id="tab2warning">

<div class="col-md-12 ">
<div class="">
<?php 
$en = new _spquotation;
$result = $en->getsellerquotation($_SESSION['pid']);
//echo $en->ta->sql;

if ($result!=false) {
$tableid1="example2";
}
else{
$tableid1='';
}

?>


<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">
<!-- 		
<div class="form-group"> 		Show Numbers Of Rows 
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="20">15</option>
<option value="30">20</option>
<option value="40">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>  -->
</div>



<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class tbl_store_setting display" id= "example1">
<!-- <table class="table tbl_store_setting display" id="</?php echo $tableid1;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>

<!-- <th class="text-center" style="width: 50px;">ID</th> -->
<th></th>
<th>ID</th>
<th>Title</th>
<th>Quantity</th>
<th>Date and Time</th>
<!-- <th>Price</th> -->
<th>Comment</th>
<th>Seller Message</th>
<!--<th>Payment Status</th>--->
<th class="text-center">Action</th>
<th>Delete</th>

</tr>
</thead>

<?php 
/* print_r($_SESSION['pid']);*/
$en = new _spquotation;
$result = $en->getsellerquotation($_SESSION['pid']);
//echo $en->ta->sql;
if($account_status!=1){
if ($result!=false) {?>
<tbody>
<?php    $i = 1;
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
<?php   //print_r($row);die('==='); ?>
<td class="text-center"></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="eventcapitalize">

<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['spPostings_idspPostings']?>">

<?php 
$pst = new _productposting;
$result3 = $pst->read($row['spPostings_idspPostings']);

//print_r($result3);die('===');

if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['spPostingTitle'];
}
?>

</td>



<td><?php echo $row['spQuotationTotalQty'];?></td>
<td><?php echo $row['createddatetime'];?></td>

<!-- <td><?php if ($row['spQuotationPrice'] >= 0) {
// echo $row['spQuotationPrice'];
}else{

// echo "0";

}?></td>
-->

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

</div>
</div>
</div>
</div>
</div>                                                                                            
<td class="buyer">
<a href="" data-toggle="modal" data-target="#<?php echo $row['idspQuotation'];?>"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></a>
</td>

<td class="buyer">    

<?php if (isset($Sellercomment) && $row['idspQuotation'] == $commid) { ?>
<a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>

<?php  }else{ ?>
<p>No Message</p>
<?php } ?>


</td>



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

</div>
</div>
</div>
</div>
</div>                                    <!---<td>


<?php   $qu = new _quotation_transection;
$quote_res  = $qu->getrfqorder($row['idspQuotation']);

//echo $qu->ta->sql;

if ($quote_res) {
$quote_row = mysqli_fetch_assoc($quote_res);
//echo $quote_row['spPostingTitle'];

echo "Paid";
}else{
echo "Unpaid";
} ?></td>  ---->

<?php 
$profile = new _spprofiles;
$p_data = $profile->readuserdata($row['spProfile_idspProfiles']);
if($p_data != false){

$pro_data = mysqli_fetch_assoc($p_data);
$name=$pro_data['spProfileName'];
}

else {
$name='';
}

?>



<td><a href="" class="btn" data-toggle="modal"
onclick= "s_msg(<?php echo $row['spQuotationBuyerid']; ?>,'<?php echo $name; ?>')"  data-target="#mycomment<?php echo $row['idspQuotation'];?>" 
style="color: #fff!important; padding: 2px 12px !important; background-color: #55C94D; border-radius: 8px;">Chat</a> 

<!-- <a href="javascript:void(0)" class="btn" style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;"  onclick="javascript:chatWith('<?php //echo $row['spQuotationBuyerid']; ?>')">Chat</a> -->

</td>







<div class="modal fade" id="mycomment<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin: auto;width: 500px;background: none;">


<div class="modal-content no-radius sharestorepos">
<form method="post">
<div class="modal-header">
<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
</div>
<div class="modal-body">
<?php 
$rq = new _rfq;
$result1 = $rq->sp_rq();
$re_ss=mysqli_fetch_assoc($result1);
//print_r($re_ss);die('=======');
$re_ss['spProfileName']


?>

<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $SellId; ?>">
<div class="form-group">
<label>To <span class="rec_name" > * <span class="error_user"></span></span></label>

</div>
<div class="form-group">
<label>Message<span class="red"> * <span class="error_msg"></span></span></label>
<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<input type="button" class="btn btn-primary composTxtNow btn-border-radius" id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">
</div>
</form>
</div>



</div>




<!-- <td><a  onclick="rain('<?php echo $BaseUrl.'/store/dashboard/mydelete.php?postid='.$row['idspQuotation']; ?>')"> Delete</a></td> -->



<td><a  onclick="rain('<?php echo $BaseUrl.'/store/dashboard/mydelete.php?postid='.$row['idspQuotation']; ?>')"> <i title="Delete" class="fa fa-trash" ></i>
</a></td>




</tr>
<?php
$i++;
}?>
</tbody>
<?php   }}
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
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
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

});
//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
</div>

<!--  <div class="tab-pane fade" id="tab5warning">Warning 5</div> -->
</div>
</div>
</div>
</div>


<!--   
<div class="col-md-12 ">
<div class="">
<div class="table-responsive">
<table class="table tbl_store_setting" >
<thead>
<tr>
<th class="text-center" style="width: 50px;">ID</th>



<th>Whats are looking for every where</th>


<th>Quantity</th>
<th>Date and Time</th>
<th>Price</th>
<th>Comment</th>
<th>Seller Message</th>
<th>Payment Status</th>
<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php
$en = new _spquotation;
$result = $en->getsellerquotation($_SESSION['pid']);
//echo $en->ta->sql;

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
<td class="text-center"><?php echo $i; ?></td>


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
</td>



<td><?php echo $row['spQuotationTotalQty'];?></td>
<td><?php echo $row['createddatetime'];?></td>

<td><?php if ($row['spQuotationPrice'] >= 0) {
echo $row['spQuotationPrice'];
}else{

echo "0";

}?></td>


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

</div>
</div>
</div>
</div>
</div>                                                                                            
<td class="buyer">
<a href="" data-toggle="modal" data-target="#<?php echo $row['idspQuotation'];?>"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></a>
</td>

<td class="buyer">    

<?php if (isset($Sellercomment) && $row['idspQuotation'] == $commid) { ?>
<a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>

<?php  }else{ ?>
<p>No Message</p>
<?php } ?>


</td>

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

</div>
</div>
</div>
</div>
</div>                                    <td>


<?php   $qu = new _quotation_transection;
$quote_res  = $qu->getrfqorder($row['idspQuotation']);

//echo $qu->ta->sql;

if ($quote_res) {
$quote_row = mysqli_fetch_assoc($quote_res);
//echo $quote_row['spPostingTitle'];

echo "Paid";
}else{
echo "Unpaid";
} ?></td>  





<td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $row['idspQuotation'];?>" 
style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;">Chat</a></td>
<div class="modal fade" id="mycomment<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">


<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Chat</h3>

</div>
<div class="modal-body">

<input type="hidden" name="comment_id" id="comment_id<?php echo $row['idspQuotation'];?>" value="<?php echo $row['idspQuotation'];?>">    
<div class="form-group">
<label for="sell1">Enter Message <span class="red">*</span></label> 
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $row['idspQuotation'];?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
<button type="button" class="btn btn-primary" 

onclick="get_commentdata(<?php echo $row['idspQuotation'];?>)" style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Send</button>
</div>
</div>

</div>
</div>

</div>




</tr>
<?php
$i++;
}
}
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
</div>
</div>
</div> -->
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

function get_commentdata(id){
//alert();


var comment_id = $("#comment_id"+id).val()

var sellercommentid = $("#sellercommentid"+id).val()

if (sellercommentid == "") {

$("#sellercommentid_error").text("Please Enter Comment.");
$("#sellercommentid").focus();


return false;
}else{
$.ajax({
type: 'POST',
url: 'addchat_rfq.php',
data: {comment_id: comment_id, sellercomments: sellercommentid},


success: function(response){ 

//console.log(data);

swal({

title: "Message Submitted Successfully!",
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
function sent_msg(id,name){
$('#txtReceiver').val(id);
$('.rec_name').html(name);


}




function s_msg(id,name){
$('#sellercommentid').val(id);
$('.rec_name').html(name);
}


</script>

</body>
</html>
<?php
}?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->


<script>
function rain(ida){
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




















<script>
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












<script>

$(document).ready(function(){
var show_btn=$('.show-modal');
var show_btn=$('.show-modal');
//$("#testmodal").modal('show');

show_btn.click(function(){
$("#testmodal").modal('show');
})
});

$(function() {
$('#element').on('click', function( e ) {
Custombox.open({
target: '#testmodal-1',
effect: 'fadein'
});
e.preventDefault();
});
});
</script>











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
// function default_index() {
// $('table tr:eq(0)').prepend('<th> ID </th>')

// var id = 0;

// $('table tr:gt(0)').each(function(){	
// id++
// $(this).prepend('<td>'+id+'</td>');
// });
// }

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




<script>
function showdescription(a) {
$("#user_name").text(a);
}

</script>
