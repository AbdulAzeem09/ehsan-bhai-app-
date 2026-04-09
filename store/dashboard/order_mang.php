





<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
//	echo $class; die('=======');
include '../../mlayer/' . $class . '.class.php';
}
// spl_autoload_register("sp_autoloader");




//$pty = new _spproducts;

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<?php include('../../component/dashboard-link.php'); ?>
<!--     <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
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
<!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php 
$activePage = 16;
//include('left-menu.php'); 
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
$msg=$_GET['msg'];
if($msg !=false){ 
?>
<div class="alert alert-danger" role="alert">
Permision Denied!
</div> 
<?php   } ?>




<?php 
$storeTitle = "Buyer Dashboard / My Orders Management";
//include('../top-dashboard.php');
//  include('../searchform.php');                       
?>

<div class="row no-margin">
<!--  <div class="col-md-12 no-padding">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">New Orders</a></li>

</ul>
<div class="text-right" style="margin-top: -10px;">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div>
</div> -->
<div class="col-md-12">
<ul class="breadcrumb" style="background: white !important; ">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">New Orders</a></li>

</ul>
</div>

<div class="col-md-12">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
<div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
border-color: #BACCE8;">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1warning" data-toggle="tab">New Order</a></li>
<!--<li><a href="#tab2warning" data-toggle="tab">Prepare to Shipment</a></li>  -->
<li><a href="#tab3warning" data-toggle="tab">Shipped Order</a></li>
<!--   <li class="dropdown">
<a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li><a href="#tab4warning" data-toggle="tab">Warning 4</a></li>
<li><a href="#tab5warning" data-toggle="tab">Warning 5</a></li>
</ul>
</li> -->
<li><a href="#tab4warning" data-toggle="tab">Delivered Order</a></li>
<li><a href="#tab5warning" data-toggle="tab">Refunded Order</a></li>
<li><a href="#tab6warning" data-toggle="tab">Cancelled Order</a></li>
</ul>
</div>
<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

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





.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-md-12 no-padding">
<div class="">
<div class="table-responsive">
<?php	


$userid=$_SESSION['uid'];
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$p = new _productposting;
$rd = $p->read($userid);

if($rd!=false){
$row = mysqli_fetch_assoc($rd);}
//$res1= mysqli_fetch_assoc($currency);
//$curr=$row['default_currency'];

$p = new _spcustomers_basket;
//$result = $p->read_prod_sell($_SESSION['pid']);
if($result!=false){
$table1="example";
}
else{
$table1="";
}
?>


<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
<select class  ="form-control" name="state" id="maxRows">


<option value="1">10</option>
<option value="2">15</option>
<option value="4">20</option>
<option value="40">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div> 
</div>



<table class="table table-striped table-class tbl_store_setting display" id="table-id">
<!-- <table class="table tbl_store_setting display" id="<?php  echo $table1; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th class="text-center" style="width: 70px;">Order #</th>
<th>Date</th>
<th>Title</th>
<th class="text-center">Qty</th>
<th class="text-center">Price / Item</th>
<th class="text-center">Total Amount</th>
<th class="text-center">Action</th>
</tr>
</thead>
<?php	$p = new _spcustomers_basket;
$result = $p->readseller($_SESSION['pid']);

if($result){
?>
<tbody>
<?php
//$pty = new _spproducts;
// echo $p->ta->sql;
if($account_status!=1){
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td><?php echo $row['idspOrder']; ?></td>
<td><?php echo $row['sporderdate']; ?></td>
<td><?php $productid =  $row['idspPostings']; 
$pv = new _productposting;
$rdf = $pv->read($productid);
if ($rdf != false) {
$rowf = mysqli_fetch_assoc($rdf);
//print_r($rowf);
$pr_id=$rowf['idspPostings'];
$title = $rowf['spPostingTitle'];
$curr=$rowf['default_currency'];

}
//echo $curr; die("-----");?>

<a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $pr_id; ?>"><?php echo $title;?></a>
</td>
<td class="text-center"><?php echo $row['spOrderQty']; ?></td>
<td class="text-center"><?php echo $curr.' '.$row['sporderAmount']; ?></td>
<td class="text-center"><?php echo $curr.' '.$row['spOrderQty']*$row['sporderAmount']; ?></td>
<td><a href="<?= $BaseUrl; ?>/store/dashboard/sellerstatusnew.php?postid=<?= $row['idspOrder']; ?>"><i title="View" style="color:#428bca" class="fa fa-eye"></i></a></td>
</tr>
<?php
$i++;
}
}}
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


<div class="tab-pane fade " id="tab5warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">
<div class="table-responsive">
<?php


$p = new _spcustomers_basket;

$result = $p->readst($_SESSION['pid']);
if($result!=false){
$table5="example5";
}
else{
$table5="";
}
?>

<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
<select class  ="form-control" name="state" id="maxRows">


<option value="2">10</option>
<option value="2">15</option>
<option value="4">20</option>
<option value="40">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div> 
</div>


<table class="table table-striped table-class tbl_store_setting display" id= "table-id">
<!-- <table class="table tbl_store_setting display" id="<?php echo $table5; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th class="text-center" style="width: 50px;">No.</th>
<th>Buyer Name</th>
<th>Product Name</th>
<th>Buyer Comment</th>
<th>Seller Comment</th>
<th>Action</th>
<th>Comment</th>
<th>View</th>

</tr>
</thead>
<tbody>

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

$result = $p->readst($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);die('=======');
if($account_status!=1){
if ($result != false) {
$i = 1;
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

$pr_id=$prn['idspPostings'];																			$prname=$prn['spPostingTitle'];
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
<td class="eventcapitalize"><?php echo $buyername; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $pr_id; ?>"><?php echo $prname;?></a></td>
<td><?php echo $Response; ?></td>




<td class="buyer">    

<?php if (isset($sellerComment)) { ?>
<a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $sellerComment; ?></a>

<?php  }else{ ?>
<p>No Comment</p>
<?php } ?>


</td>



<td>

<?php  

$rd= new _spprofiles;
$rad= $rd->readst($basket_id);
if($rad != false){
$read=mysqli_fetch_assoc($rad);
$st=$read['status'];
}else{
$st=0;
}
//echo $st;


?>
<!-- <select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $row['idspOrder'];?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
<option value="" style="display:none">Status</option>  
<option  value="Accepted"<?php if ($row['status'] == 'Accepted') {echo "disabled"; }?> <?php if ($row['status'] == 'Accepted') {echo "selected";  }?>>Accepted</option>



<option  value="Review In Request" <?php if($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

<option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {echo "disabled";

}?> <?php if ($row['status'] == 'Decline Request') {echo "selected"; }?>>Decline Request</option>



</select>-->

<?php    
//	die("+++++++++++++++++");
if(isset($_GET['action'])){

//die("+++++++++++++++++");

$da=array("status"=>$_GET['value']);


$st1= new _spprofiles;

$sta= $st1->updatestatus($da,$_GET['basket_id']);
//echo $this->tast->sql;

//var_dump($sta);



}
?>
<select class="form-control" onchange="location = this.value;">
<option>Option</option>
<option value="order_mang.php?value=0&basket_id=<?= $basket_id; ?>&action=pending"<?php if($st == '0'){ echo 'selected'; } ?>>Pending</option>
<option value="order_mang.php?value=1&basket_id=<?= $basket_id; ?>&action=accepted" <?php if($st == '1'){ echo 'selected'; } ?>  >Accepted</option>
<option value="order_mang.php?value=2&basket_id=<?= $basket_id; ?>&action=rejected"<?php if($st == '2'){ echo 'selected'; } ?>>Rejected</option> 
</select>
<?php   ?>
</td>

<td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $basket_id;?>" 
style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>
<td><a href="<?= $BaseUrl; ?>/store/dashboard/sellerstatusnew.php?postid=<?= $row['idspOrder']; ?>">View</a></td>


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
<div class="modal-body"><p style="padding: 8px;"><?php echo $sellerComment; ?>

</p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                        


<!-- Modal -->
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

var table = $('#example5').DataTable({ 
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
<div class="tab-pane fade " id="tab6warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">
<div class="table-responsive">
<?php
$p = new _spcustomers_basket;

$result = $p->readcancel($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if ($result != false) {
$table6="example6";
}else{
$table6="";
}
?>

<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
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
</div> 
</div>
<table class="table table-striped table-class tbl_store_setting display" id= "table-id">
<!-- <table class="table tbl_store_setting display" id="<?php echo $table6; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>

<th class="text-center" style="width: 50px;">No.</th>
<th>Buyer Name</th>
<th>Product Name</th>
<th>Buyer Reason</th>

<th>Seller Comment</th>
<!--<th>Action</th>-->
<th>Comment</th>

</tr>
</thead>
<tbody>
<?php
$p = new _spcustomers_basket;

$result = $p->readcancel($_SESSION['pid']);
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

$Sellercomment = $commrow["sellercomments"];
$Scommentid = $commrow["id"];
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

<td><?php echo $i; ?></td>
<td class="eventcapitalize"><?php echo $buyername; ?></td>
<td class="eventcapitalize"><?php echo $prname; ?></td>
<td><?php echo $Response; ?></td>





<td class="buyer">    

<?php if (isset($sellerComment)) {
// echo $sellerComment; 
?>

<!-- <a href="" data-toggle="modal3" data-target="#p<?php echo $$order_id;?>"><?php  echo $sellerComment; ?></a> -->



<button data-toggle="modal" onclick="data_append('<?php  echo $sellerComment; ?>')" data-target="#myModal" data-target="#p<?php echo $$order_id;?>"  ><?php  echo $sellerComment; ?></button>

<?php  }else{ ?>
<p>No Comment</p>
<?php } ?>


</td>



<!-- <td>


<select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $basketid;?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
<!--   <option value="" style="display:none">Status</option>  
<option  value="Accepted"<?php if ($row['status'] == 'Accepted') {echo "disabled"; }?> <?php if ($row['status'] == 'Accepted') {echo "selected";  }?>>Accepted</option>



<option  value="Review In Request" <?php if($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

<option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {echo "disabled";

}?> <?php if ($row['status'] == 'Decline Request') {echo "selected"; }?>>Decline Request</option>



</select>

</td>-->

<td><a href="" class="btn" data-toggle="modal" data-target="#mycomment<?php echo $basketid;?>" 
style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>


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
<div class="modal-body"><p style="padding: 8px;"><?php echo $sellerComment; ?>

</p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
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
<!-- Modals -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Modal Header</h4>
</div>
<div class="modal-body">
<p><b>Data :</b><span id="user_name"></span></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

<script>

function  data_append(data)
{

$("#user_name").text(data);

}
</script>




<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example6').DataTable({ 
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

<div class="tab-pane fade" id="tab3warning">  
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-md-12 no-padding">
<div class="">
<!--<div class="table-responsive">
<?php 	$p = new _order;
$result = $p->readSellerOrderStatus($_SESSION['pid'], 1); 
if($result){
?>
<table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" >
<?php } else {	  ?>
<table class="table tbl_store_setting display" id="" cellspacing="0" width="100%" >

<?php } ?>
<thead>
<tr>
<th class="text-center" style="width: 50px;">Order#</th>
<th class="text-center" style="width: 50px;">Order#</th>

<th>Ship Company Name</th>
<th>Track Id</th>
<th>Ship Date</th>


</tr>
</thead>

<?php 	$p = new _order;
$result = $p->readSellerOrderStatus($_SESSION['pid'], 1); 
if($result){
?>

<tbody>
<?php

//$result = $p->readSellerOrder($_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);

$dt = new DateTime($ship_date);
?>
<tr>
<td></td>
<td><?php echo $idspOrder; ?></td>
<td><?php echo $txn_id; ?></td>
<td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
<td><?php echo $ship_track_id; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>


<td>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
<span>|</span>

<a href="<?php echo $BaseUrl.'/store/dashboard/shipedorder.php?oid='.$idspOrder;?>">Shipped Order</a>



<!--  <span>|</span>
<a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a> 
</td>

</tr>
<?php
$i++;
}
}
else{
?>
<tr>
<td colspan="6">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>
</tbody>
<?php
}
?>
</table>
</div>-->

<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
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
</div> 
</div>
<div class="table-responsive1">
<?php	$p = new _spcustomers_basket;
$result = $p->readseller($_SESSION['pid']);
if($result){

?>
<table class="table table-striped table-class tbl_store_setting display" id= "table-id">



<!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" > -->
<?php } else {	  ?>
<table class="table tbl_store_setting display" id="" cellspacing="0" width="100%" >

<?php } ?>
<thead>
<tr>

<th class="text-center" style="width: 50px;">Order#</th>

<th>Date</th>
<th>Title</th>
<th class="text-center">Qty</th>
<th class="text-center">Price / Item</th>

<th class="text-center">Total Amount</th>
<th class="text-center">Action</th>
</tr>
</thead>
<?php	$p = new _spcustomers_basket;
$result = $p->readseller1($_SESSION['pid']);

if($result){
?>
<tbody>
<?php

//$pty = new _spproducts;

// echo $p->ta->sql;
if($account_status!=1){
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {


?>
<tr>

<td><?php echo $row['idspOrder']; ?></td>
<td><?php echo $row['sporderdate']; ?></td>
<td><?php $productid =  $row['idspPostings']; 


/*  $titl = $row['idspPostings'];

$dat22 = $pty->readp($titl);
$dta11 = mysqli_fetch_assoc($dat22);
echo $title = $dta11['spPostingTitle'];
*/

$pv = new _productposting;
$rdf = $pv->read($productid);

if ($rdf != false) {

$rowf = mysqli_fetch_assoc($rdf);
$title = $rowf['spPostingTitle'];
$curr= $rowf['default_currency'];
}
echo $title;


?></td>

<td class="text-center"><?php echo $row['spOrderQty']; ?></td>
<td class="text-center"><?php echo $curr.' '.$row['sporderAmount']; ?></td>
<td class="text-center"><?php echo $curr.' '. $row['spOrderQty']*$row['sporderAmount']; ?></td>
<td><a href="<?= $BaseUrl; ?>/store/dashboard/sellerstatusnew.php?postid=<?= $row['idspOrder']; ?>">View</a></td>


</tr>
<?php
$i++;
}
}}
else{
?>
<tr>
<td colspan="7"><p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>
</tbody>
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
</div></div>


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>--->

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

});
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );

</script>
<div class="tab-pane fade" id="tab4warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">
<!--<div class="table-responsive">
<?php
$p = new _order;
$p = new _spcustomers_basket;
$result = $p->readseller_shipped($_SESSION['pid']);
//			if($result){

//		$result = $p->readSellerOrderStatus(//$_SESSION['pid'], 2);
if($result){

?>
<table class="table tbl_store_setting display" id="example2" cellspacing="0" width="100%" >
<?php } else {	  ?>
<table class="table tbl_store_setting display" id="" cellspacing="0" width="100%" >

<?php } ?>
<thead>
<tr>
<th class="text-center" style="width: 50px;">Order#</th>
<th class="text-center" style="width: 50px;">Order#</th>

<th>Ship Company Name</th>
<th>Track Id</th>
<th>Ship Date</th>

<th></th>
</tr>
</thead>
<?php
$p = new _order;
$result = $p->readSellerOrderStatus($_SESSION['pid'], 2);
if($result){

?>
<tbody>
<?php

//$result = $p->readSellerOrder($_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);

$dt = new DateTime($ship_date);
?>
<tr>
<td></td> 
<td><?php echo $idspOrder; ?></td>
<td><?php echo $txn_id; ?></td>
<td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
<td><?php echo $ship_track_id; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>


<td>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
<span>|</span>                                                                
<a href="<?php echo $BaseUrl.'/store/dashboard/shipedorder.php?oid='.$idspOrder.'&do=1';?>">Delivered Order</a>
<!--   <span>|</span>
<a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a> 																</td>

</tr>
<?php
$i++;
}
}
else{
?>
<tr>
<td colspan="6">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>
</tbody>
<?php
}
?>
</table>
</div>-->

<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
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
</div> 
</div>

<div class="table-responsive1">
<?php	$p = new _spcustomers_basket;
$result = $p->readseller($_SESSION['pid']);
if($result){
?>
<table class="table table-striped table-class tbl_store_setting display" id= "table-id">
<!-- <table class="table tbl_store_setting display" id="example22" cellspacing="0" width="100%" > -->
<?php } else {	  ?>
<table class="table tbl_store_setting display" id="example22" cellspacing="0" width="100%" >

<?php } ?>
<thead>
<tr>

<th class="text-center" style="width: 50px;">Order#</th>

<th>Date</th>
<th>Title</th>
<th class="text-center">Qty</th>
<th class="text-center">Price / Item</th>

<th class="text-center">Total Amount</th>
<th class="text-center">Action</th>
</tr>
</thead>
<?php	$p = new _spcustomers_basket;
$result = $p->readseller2($_SESSION['pid']);

if($result){
?>
<tbody>
<?php

//$pty = new _spproducts;

// echo $p->ta->sql;
if($account_status!=1){
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {


?>
<tr>

<td><?php echo $row['idspOrder']; ?></td>
<td><?php echo $row['sporderdate']; ?></td>
<td><?php $productid =  $row['idspPostings']; 


/*  $titl = $row['idspPostings'];

$dat22 = $pty->readp($titl);
$dta11 = mysqli_fetch_assoc($dat22);
echo $title = $dta11['spPostingTitle'];
*/

$pv = new _productposting;
$rdf = $pv->read($productid);

if ($rdf != false) {

$rowf = mysqli_fetch_assoc($rdf);
$pr_id=$rowf['idspPostings'];												$title = $rowf['spPostingTitle'];
$curr=$rowf['default_currency'];

} ?>
<a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $pr_id; ?>"><?php echo $title;?></a>


</td>

<td class="text-center"><?php echo $row['spOrderQty']; ?></td>
<td class="text-center"><?php echo $curr.' '.$row['sporderAmount']; ?></td>
<td class="text-center"><?php echo $curr.' '.$row['sporderAmount']; ?></td>
<td><a href="<?= $BaseUrl; ?>/store/dashboard/sellerstatusnew.php?postid=<?= $row['idspOrder']; ?>">View</a></td>


</tr>
<?php
$i++;
}
}}
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
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example22').DataTable({ 
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
<div class="tab-pane fade" id="tab4warning">  
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-md-12 no-padding">
<div class="">
<div class="table-responsive">
<?php
$p = new _order;  
// $po = new _orderSuccess;
//  $result1 = $po->readmyOrder($_SESSION['pid']);


$result = $p->readSellerOrderStatus($_SESSION['pid'], 3);
if($result){
?>
<table class="table tbl_store_setting display" id="example3" cellspacing="0" width="100%" >
<?php } else {	  ?>
<table class="table tbl_store_setting display" id="example3" cellspacing="0" width="100%" >

<?php } ?>
<thead>
<tr>

<th class="text-center" style="width: 50px;">Order#</th>

<th>Ship Company Name</th>
<th>Track Id</th>
<th>Ship Date</th>

<th></th>
</tr>
</thead>
<?php
$p = new _order;  
// $po = new _orderSuccess;

//  $result1 = $po->readmyOrder($_SESSION['pid']);


$result = $p->readSellerOrderStatus($_SESSION['pid'], 3);
if($result){
?>
<tbody>
<?php

//$result = $p->readSellerOrder($_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);


//  echo "<pre>";
//  print_r($row);


$buyerprofilid = $row['spByuerProfileId'];

$sellerprofilid = $row['spSellerProfileId'];

$orderdate = $row['sporderdate'];

$trancsectionid = $row['txn_id'];


$sellproducttitle = $row["spPostingTitle"];

$sporderAmount = $row["sporderAmount"];


$spOrderQty = $row['spOrderQty'];


$sp = new _spprofiles;
$spsellresult  = $sp->read($sellerprofilid);

//  echo $sp->ta->sql;
if($spsellresult != false)
{
$sellrow = mysqli_fetch_assoc($spsellresult);
$sellername = $sellrow["spProfileName"];
}



$spbuyresult  = $sp->read($buyerprofilid);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];



}

$po = new _orderSuccess;
$result1 = $po->readmyOrder($sellerprofilid);
if($result1 != false)
{
$success_row = mysqli_fetch_assoc($result1);


$firstname = $success_row['first_name'];
$lastname = $success_row['last_name'];




}


$dt = new DateTime($ship_date);
?>
<tr>

<td><?php echo $idspOrder; ?></td>
<td><?php echo $txn_id; ?></td>
<td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
<td><?php echo $ship_track_id; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>


<td>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
<span>|</span>
<a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.pdf'?>" id="btnPDF">Invoice</a>


</td>

</tr>
<?php
$i++;



/*
$Date = new DateTime($eventdetail['spPostingDate']);
$startTime = $eventdetail['spPostingStartTime'];
$dtstrtTime = strtotime($startTime);*/


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
else{
?>
<tr>
<td colspan="6">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>
</tbody>
<?php
}
?>
</table>
</div>
</div>
</div></div>

</div>

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

});
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );

</script>

<!--  <div class="col-md-12 no-padding">
<div class="">
<div class="table-responsive">
<table class="table tbl_store_setting" >
<thead>
<tr>
<th class="text-center" style="width: 50px;">Order#</th>
<th>Reference</th>
<th>Date</th>
<th>Title</th>
<th class="text-center">Qty</th>
<th class="text-center">Price / Item</th>

<th></th>
</tr>
</thead>
<tbody>
<?php
$p = new _order;
$result = $p->readSellerOrder($_SESSION['pid']);
// echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);

$dt = new DateTime($sporderdate);
?>
<tr>
<td><?php echo $idspOrder; ?></td>
<td><?php echo $txn_id; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td class="eventcapitalize"><?php echo $spPostingTitle; ?></td>
<td class="text-center"><?php echo $spOrderQty; ?></td>
<td class="text-center"><?php echo "$".$sporderAmount; ?></td>

<td>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
<span>|</span>
<?php
if ($idspShip == 0) {
?>
<a href="<?php echo $BaseUrl.'/store/dashboard/add_ship.php?oid='.$idspOrder;?>">Add Shipment</a>
<?php
}else{
?>
<a href="javascript:void(0)">View Shipment</a>
<?php
}
?>



</td>

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
</div>
</div>
</div> -->
</div>

</div>
</div>
</div>


<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 

include '../../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf

$mpdf->WriteHTML($orderhtml);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("buyerinvoice.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?>
</body>
</html>
<?php
}?>									






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
