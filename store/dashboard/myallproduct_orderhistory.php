<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

*/
?>


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
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->       
<?php include('../../component/dashboard-link.php'); ?>
<style>
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


.dataTables_empty{text-align:center!important;}
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
$activePage = 133;
//include('left-menu.php'); 
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
$storeTitle = "Buyer Dashboard / My Orders";
$folder = "store";
// include('../top-dashboard.php');
// include('../searchform.php');                       
?>

<div class="row">
<!--   <div class="col-md-12">


<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
<li><a href="#">My Order History</a></li>

</ul>



<div class="text-right" style="margin-top: -10px;">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>

<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||$activePage == 133)?'active':''?>">Buyer Dashboard</a></li>
</ul>


</div>
</div>
-->

<div class="col-sm-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

<li><a href="#">My Order History</a></li>

</ul>
</div>


<div class="col-sm-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
<div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
border-color: #BACCE8;">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1warning" data-toggle="tab">Recent Orders</a></li>
<li><a href="#tab2warning" data-toggle="tab">Refunded Orders</a></li>
<li><a href="#tab3warning" data-toggle="tab">Cancelled Orders</a></li>



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
#example1_length{
margin-bottom:8px;
}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color: white;
}
</style>
<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group"> 			Show Numbers Of Rows 		
<select class  ="form-control" name="state" id="maxRows">


<option value="1">1</option>
<option value="1">2</option>
<option value="10">20</option>
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

<div class="col-sm-12">
<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example" style="width: 100%;">
<!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- <th class="text-center" >ID</th> -->
<th class="text-center" ></th> 
<th class="text-center" >ID</th> 
<th class="text-center">Product Name</th>

<th class="text-center">Product Price</th>
<th class="text-center">Quantity</th>
<th class="text-center" >Order Date</th>

<th  class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}

$st= new _orderSuccess;
$status= $st->readstatus($_SESSION['pid'],$_SESSION['uid']);
//var_dump($status);

$userid=$_SESSION['uid'];

$currency= $st->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
//$curr=$res1['currency']; 
//print_r($status);die;
$i=1;
if($account_status!=1){
//die('=================');
if($status!=false){


while($r1=mysqli_fetch_assoc($status)){
// print_r($r1);die('========>');
//die('=================11111111122');
$n= new _orderSuccess;
$name=$n->readname_74($r1['idspPostings']);
// print_r($name);die('========>');
if($name!=false){
while($r2 =  mysqli_fetch_assoc($name)){



$curr=$r2['default_currency'];

$spPostingTitle= $r2['spPostingTitle'];
}
}


else {
    $spPostingTitle= 'Product Removed';

}

 ?>
<tr>
<td class="text-center"></td>
<td class="text-center"><?php echo $i; ?></td>
<!-- <td class="text-center"></?php echo $i; ?></td> -->
<td class="text-center"><a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $r1['idspPostings']?>"><?php echo $spPostingTitle;?></a></td>
<td class="text-center"><?php echo $curr.' '.$r1['sporderAmount'];?></td>
<td class="text-center"><?php echo $r1['spOrderQty'];?></td>
<td class="text-center"><?php echo $r1['sporderdate'];?></td>
<td class="text-center"><a href="<?php echo $BaseUrl.'/store/dashboard/statusnew.php?postid='.$r1['idspOrder'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" > <i style="color:#428bca" class="fa fa-eye"></i> </a></td>




<?php 
$i++;
 
}}}?>

</tr>


<?php 



$p = new _orderSuccess;
$or = new _order; 
$result = $p->readmyOrder($_SESSION['pid']);
//   echo $p->ta->sql;


if ($result!=false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

/*echo "<pre>";   
print_r($row);*/
extract($row);
$dt = new DateTime($payment_date);


$sp = new _spprofiles;

$spbuyresult  = $sp->read($spProfile_idspProfile);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];



}



$result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);


//   echo $or->ta->sql;
if ($result2) {

while ($row2 = mysqli_fetch_assoc($result2)) {

// echo"<pre>";
// print_r($row2);

$buyerprofilid = $row2['spByuerProfileId'];

$sellerprofilid = $row2['spSellerProfileId'];

$orderdate = $row2['sporderdate'];

$trancsectionid = $row2['txn_id'];


$sellproducttitle = $row2["spPostingTitle"];

$sporderAmount = $row2["sporderAmount"];


$spOrderQty = $row2['spOrderQty'];


$sp = new _spprofiles;
$spsellresult  = $sp->read($sellerprofilid);

//  echo $sp->ta->sql;
if($spsellresult != false)
{
$sellrow = mysqli_fetch_assoc($spsellresult);
$sellername = $sellrow["spProfileName"];
}
$pp = new _productpic;  

$sellpic = $pp->read($sellpostid);
// echo $pp->ta->sql;
if($sellpic != false){

$sellrowpic = mysqli_fetch_assoc($sellpic);
$sellProductimg   = $sellrowpic['spPostingPic'];



}         




// echo $orderdate;
// echo $trancsectionid;       
/*
$Date = new DateTime($eventdetail['spPostingDate']);
$startTime = $eventdetail['spPostingStartTime'];
$dtstrtTime = strtotime($startTime);*/
$firstname = $row['first_name'];
$lastname = $row['last_name'];


$orderhtml ='
<html lang="en-US">

<head>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<style>

.showeventrating{
margin-left: 45px;
margin-right: 45px;
margin-bottom: 10px;
}

.pdftablehead{
font-weight: bold;
font-size: 16px;
}
tr td{
padding: 15px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ddd;
}
.tddata{
padding-left : 14px;
text-transform: capitalize;
}
.textboxcenter{

border:1px solid black;
width:50%;
height:100px;
margin-left: 180px;

}
.trdata .newtddata{
padding: 7px!important;
border:none!important;
vertical-align: top!important;
padding-left : 60px;

}
.bordernone{
border:none!important;
}


</style> 

</head>    

<body class="bg_gray">

<section class="main_box">            
<div class="container">


<div class="row">


<div class="col-md-12">
<div class="bg_white detailEvent m_top_10">



<div class="row">
<div class="showeventrating">


<p style="text-align:center; padding-top:20px;"> <img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
<p style="font-size: 30px; text-align:center;">The SharePage</p>
<div class="textboxcenter">
<div class="col-md-6">                                 
<table class="table">


<tbody>
<tr class="trdata">
<td class="pdftablehead newtddata" style="padding-top:40px;">Title :</td>
<td class="tddata newtddata" style="padding-top:40px;">'.$sellproducttitle.'</td>

</tr>

</tbody>
</table>

</div>

</div>



<br>



<div class="row">
<div class="col-md-6" style="width:50%; float:left;">                                 
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important;" >Name : </td>
<td class="tddata" style="font-weight:bold; border:none!important;">'.$firstname.'    '.$lastname.'</td>

</tr>
<tr>
<td class="pdftablehead">Sold By :</td>
<td class="tddata">'.ucwords($sellername).'</td>

</tr>

<tr>
<td class="pdftablehead">Total Price :</td>
<td class="tddata">$'.$sporderAmount.'</td>

</tr>
</tbody>
</table>

</div>
<div class="col-md-6"  style="width:50%;float:right;">
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important;">Quantity : </td>
<td class="tddata" style="padding-left:20px; border:none!important;">'.$spOrderQty.'</td>

</tr>
<tr>
<td class="pdftablehead">Ship To :</td>
<td class="tddata" style="padding-bottom:35px;">'.$buyername.'</td>

</tr>

</tbody>
</table>

</div>
</div>



<hr>
<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Order Placed : '.date("Y-m-d H:i:A",strtotime($orderdate)).'</p>



<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>'.$row['remark'].' <br> Transaction ID : '.$trancsectionid.'</p>
</div>

<p style="text-align:center; padding-top:230px;">Paid Online From- www.TheSharePage.com</p>
</div>
</div>
</div>
</div>
</div>
</div>

</section>
</body>
</html>';                                                            

}
}


?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $txn_id; ?></td>

<td><?php echo  $amount; ?></td>
<td><?php echo  $buyername;?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>

<td  class="text-center">
<a href="<?php echo $BaseUrl.'/store/dashboard/storeinvoice.pdf'?>" class="btn"  id="btnPDF" style="color: #fff!important;  background-color: #CCA5C6;">Invoice</a>

<!--  <a href="<?php echo $BaseUrl.'/events/eventticket.pdf' ?>" class="" id="btnPDF"><i class="fa fa-file-pdf-o "></i></a> -->


<a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php?txnid='.$txn_id?>" class="btn" style="color: #fff!important;background-color: #A2DE54;">Order Detail</a>
</td>

</tr>
<?php
$i++;



//echo $orderhtml;                                                    
}
}
/*else{
?>
<tr>
<td colspan="7">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}*/
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
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">


$(document).ready(function(){
$(".sellerComment").click(function(){

var mesage  = ($(this).attr("data-message"));
$('#sellermessage').html(mesage);
});
});








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

} );
table.destroy();
} );

</script>
<div class="tab-pane fade " id="tab2warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">

<?php


$p = new _spcustomers_basket;

$result = $p->readrefundbuyer($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if ($result != false) {
$tableid2="example2";
}
else{
$tableid2='';
}
?>

<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group"> 		Show Numbers Of Rows
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
<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example1">

<!-- <table class="table tbl_store_setting " id="<?php echo $tableid2;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th></th>
<th class="text-center" style="width: 50px;">No.</th>
<th>Buyer Name</th>
<th>Product Name</th>
<th>Buyer Comment</th>
<th>Seller Comment</th>
<th>Action</th>
<!--<th>Comment</th>-->

</tr>
</thead>


<?php 

if(isset($_POST['submit'])){
//die('==========');
$comment=array("seller_comment"=>$_POST['sellercomments']); 

$s=new _spcustomers_basket;
$st= $s->updatecomment($comment,$_POST['idspOrder']);

}


?>

<?php


$p = new _spcustomers_basket;

$result = $p->readrefundbuyer($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if($account_status!=1){
if ($result != false) {?>
<tbody>
<?php   $i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//extract($row);


//echo "<pre>";
// print_r($row);


$basket_id = $row['idspOrder'];

$order_id  = $row['idspPostings'];

//echo $order_id;die('=====');

$buyerprofilid  = $row['spByuerProfileId'];
$sellerprofilid  = $row['spSellerProfileId'];


$Response  = $row['reason'];
$sellerComment  = $row['seller_comment'];

$buyerComment  = $row['comments'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];

}
$p=new _productposting;
$pr=$p->read($order_id);

//print_r($pr);
if($pr !=false){

$prn=mysqli_fetch_assoc($pr);

$prname=$prn['spPostingTitle'];
//echo $prname;die('=======');

}                   


$sl = new _sellercomment;
$commresult  = $sl->getsellercomment($row['id']);
//  echo $sl->ta->sql;            

if($commresult != false)
{
while ($commrow = mysqli_fetch_assoc($commresult)) {

$Sellercomment = $commrow["sellercomments"];
$Scommentid = $commrow["id"];
$commid = $commrow["comment_id"];                                                                    

}
}

// echo  $Sellercomment;

?>

<!-- Modal -->
<div class="modal fade" id="<?php echo $basket_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Buyer Comment</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo $buyerComment; ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>

<tr>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl; ?>/friends/?profileid=<?php echo $buyerprofilid; ?>"><?php echo $buyername; ?></a></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $order_id; ?>"><?php echo $prname; ?></a></td>
<td><?php echo $Response; ?></td>




<td class="buyer">    

<?php if (isset($sellerComment)) { ?>
<a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $sellerComment; ?></a>

<?php  }else{ ?>
<p>No Comment</p>
<?php } ?>


</td>

<td class="text-center"><a href="<?php echo $BaseUrl.'/store/dashboard/statusnew.php?postid='.$basket_id;?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top"> <i style="color:#428bca" class="fa fa-eye" ></i> </a></td>

<!-- <td>


<select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $row['id'];?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
<!--   <option value="" style="display:none">Status</option>  
<option  value="Accepted"<?php if ($row['status'] == 'Accepted') {echo "disabled"; }?> <?php if ($row['status'] == 'Accepted') {echo "selected";  }?>>Accepted</option>



<option  value="Review In Request" <?php if($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

<option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {echo "disabled";

}?> <?php if ($row['status'] == 'Decline Request') {echo "selected"; }?>>Decline Request</option>



</select>

</td>

<td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $basket_id;?>" 
style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>-->


</tr>



<div class="modal fade" id="mycomment<?php echo $basket_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<form  action="" method="post" enctype="multipart/form-data"> 

<!--   <form id="sellercommentfrm"action="addsellercomment.php" method="post" enctype="multipart/form-data"> -->
<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Comment</h3>

</div>
<div class="modal-body">

<input type="hidden" name="idspOrder" id="comment_id<?php echo $basket_id;?>" value="<?php echo $basket_id;?>">    

<div class="form-group">
<label for="sell1">Enter Comment <span class="red">*</span></label> 
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $row['id'];?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>

<button type="submit" class="btn btn-primary"  name="submit"

style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
</div>
</div>
</form>  
</div>
</div>

</div>

<?php
$i++;
}?>
</tbody>
<?php   }}
else{
?>
<tr>
<td colspan="8">
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


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
table.destroy();
} );

</script>

</div>
<div class="tab-pane fade " id="tab3warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">
<?php
$p = new _spcustomers_basket;

$result = $p->readcancelbuyer($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if ($result != false) {
$tableid3="example3";
}
else{
$tableid3='';
}

?>

<div class="container-fluid">
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
<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example2">
<!-- <table class="table tbl_store_setting display" id="<?php echo $tableid3;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th><th>
<th class="text-center" style="width: 50px;">No.</th>
<th class="text-center">Buyer Name</th>
<th class="text-center">Product Name</th>
<th class="text-center"> Buyer Reason</th>

<th class="text-center"> Seller Comment</th>
<th>Action</th>
<!-- <th>Comment</th>-->

</tr>
</thead>
<tbody>
<?php
$p = new _spcustomers_basket;

$result = $p->readcancelbuyer($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if($account_status!=1){
if ($result != false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//extract($row);


//echo "<pre>";
// print_r($row);

$basketid=$row['idspOrder'];

$order_id  = $row['idspPostings'];

//echo $order_id;die('=====');
$comment=$row['seller_comment'];
$buyerprofilid  = $row['spByuerProfileId'];
$sellerprofilid  = $row['spSellerProfileId'];


$Response  = $row['reason'];
$buyerComment  = $row['comments'];
$sellerComment  = $row['seller_comment'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];

}
$p=new _productposting;
$pr=$p->read($order_id);

//print_r($pr);
if($pr !=false){

$prn=mysqli_fetch_assoc($pr);

$prname=$prn['spPostingTitle'];
//echo $prname;die('=======');

}                   


$sl = new _sellercomment;
$commresult  = $sl->getsellercomment($row['id']);
//  echo $sl->ta->sql;            

if($commresult != false)
{
while ($commrow = mysqli_fetch_assoc($commresult)) {

// $Sellercomment = $commrow["sellercomments"];
// echo $Sellercomment;die;
$Scommentid = $commrow["id"];
// echo $Scommentid;die;
$commid = $commrow["comment_id"];                                                                    

}
}


?>
<?php 

if(isset($_POST['submit'])){
//die('==========');
$comment=array("seller_comment"=>$_POST['sellercomments']); 

$s=new _spcustomers_basket;
$st= $s->updatecomment($comment,$_POST['idspOrder']);

}


?>

<!-- Modal -->
<div class="modal fade" id="<?php echo $basketid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Buyer Comment</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo $buyerComment; ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>

<tr>
<td></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl; ?>/friends/?profileid=<?php echo $buyerprofilid; ?>"><?php echo $buyername; ?></a></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $order_id; ?>"><?php echo $prname; ?></a></td>
<td class="text-center"><?php echo $Response; ?></td>





<td class="buyer text-center">    

<?php if (isset($sellerComment)) {
// echo $sellerComment; 
?>

<a href="" data-toggle="modal" class="sellerComment" data-message="<?php echo $sellerComment; ?>" data-target="#p" id=""><?php echo $sellerComment; ?></a>


<?php  }else{ ?>
<p>No Comment</p>
<?php } ?>


</td>

<td class="text-center"><a href="<?php echo $BaseUrl.'/store/dashboard/statusnew.php?postid='.$basketid;?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-red"> <i style="color:#428bca" class="fa fa-eye" ></i> </a></td>

<!--  <td>


<select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $basketid;?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
<!--   <option value="" style="display:none">Status</option>  
<option  value="Accepted"<?php if ($row['status'] == 'Accepted') {echo "disabled"; }?> <?php if ($row['status'] == 'Accepted') {echo "selected";  }?>>Accepted</option>



<option  value="Review In Request" <?php if($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

<option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {echo "disabled";

}?> <?php if ($row['status'] == 'Decline Request') {echo "selected"; }?>>Decline Request</option>



</select>

</td>

<td><a href="" class="btn" data-toggle="modal" data-target="#mycomment<?php echo $basketid;?>" 
style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>-->


</tr>


<!-- Modal -->
<div class="modal fade" id="p<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Comment</h4>

</div>
<div class="modal-body"><p style="padding:8px;" id="sellermessage" ><?php echo $sellerComment; ?></p>

</div>
<div class="modal-footer">
<!--  <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                        


<!-- Modal -->
<div class="modal fade" id="mycomment<?php echo $basketid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

<form  action="" method="post" enctype="multipart/form-data"> 
<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Comment</h3>

</div>
<div class="modal-body">
<!--   <input type="hidden" name="cid" value="<?php echo $row['id'];?>"> -->
<!--   <input type="hidden" name="spByuerProfileId" value="<?php echo $buyerprofilid;?>">
<input type="hidden" name="spSellerProfileId" value="<?php echo $sellerprofilid;?>">

<input type="hidden" name="order_id" value="<?php echo $order_id;?>">

-->

<input type="hidden" name="idspOrder" id="comment_id<?php echo $basketid;?>" value="<?php echo $basketid;?>">    
<div class="form-group">
<label for="sell1">Enter Comment <span class="red">*</span></label> 
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $basketid;?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>


<button type="submit" class="btn btn-primary" name="submit"

style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
</div>
</div>
</form>  
</div>
</div>

</div>

<?php
$i++;
}
}}
else{
?>
<tr>
<td colspan="8">
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


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example3').DataTable({ 
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

} );
} );
</script>

</div>

</div>
</div>
</div>
</div>



<!-- new design -->
<!--  <div class="col-md-12 ">
<div class="store_detailcenter_1 bg_white">
<div class="row">
<div class="col-md-4">
<h3 class="eventcapitalize">My Order History</h3>
</div>

</div>

<?php   $p = new _orderSuccess;
$or = new _order; 
$result = $p->readmyOrder($_SESSION['pid']);
//   echo $p->ta->sql;
// print_r($result);

if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);
$dt = new DateTime($payment_date);


$result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);



// echo $or->ta->sql;
if ($result2) {

while ($row2 = mysqli_fetch_assoc($result2)) {

// print_r($row2);


$buyerprofilid = $row2['spByuerProfileId'];

$sellerprofilid = $row2['spSellerProfileId'];
$sellpostid = $row2["idspPostings"];

$idspOrder = $row2["idspOrder"];



$spOrderQty = $row2['spOrderQty'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];



}



$pp = new _productpic;  

$sellpic = $pp->read($sellpostid);
// echo $pp->ta->sql;
if($sellpic != false){

$sellrowpic = mysqli_fetch_assoc($sellpic);

$sellProductimg   = $sellrowpic['spPostingPic'];



}         

?>

<div class="row">
<div class="col-md-12" style="margin-top: 15px;">
<div class="panel with-nav-tabs panel-info">
<div class="panel-heading" style="padding: 22px 10px;">
<ul class="nav nav-tabs">
<div class="col-md-3">
<li class="active">Order Placed  <br>
<?php echo $dt->format('d-M-Y'); ?></li>
</div>

<div class="col-md-3">
<li>TOTAL <br>
<?php echo'$'. $amount; ?>
</li>
</div>

<div class="col-md-3">
<li class="eventcapitalize">SHIP TO  <br>
<?php echo $buyername;?></li>
</div>

<div class="col-md-3">
<li>ORDER <?php echo $txn_id; ?><br>

</div>


</ul>
</div>
<div class="panel-body">
<div class="tab-content">
<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
<div class="col-md-8">


<div class="col-md-4"> 
<?php  
if ($sellProductimg) {
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($sellProductimg) . "' style='height: 130px;' >";

}else{
echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive' style='height: 130px;'>";
}



?>
</div>
<div class="col-md-8">

</div>
</div>

<div class="col-md-4">
<a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php';?>" class="btn btntrackorder">Order Detail</a>



<a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>" class="btn btnwithorder">Invoice</a>

</div>
</div>   


</div>
</div>
</div>
</div>
</div>

<?php

}
}
}
}else{  ?>

<center><div style='min-height: 300px; font-size: 16px; padding-top: 100px;' >No Record Found</div></center>



<?php }  ?>



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
            var table = $('#example2').DataTable({
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



<?php   
include '../../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf

$mpdf->WriteHTML($orderhtml);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("storeinvoice.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?>




</body>
</html>
<?php
}
?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
