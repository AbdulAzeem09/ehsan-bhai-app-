<?php 
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="events/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
$activePage = 9;


if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

}else{

$re = new _redirect;
$re->redirect($BaseUrl."/events");
}


?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
</head>
<style>
.dropdown-menu {
border: none;
}
#profileDropDown li.active {
background-color: #c11f50;
}
#profileDropDown li.active a {
color: #fff;
}
</style>
<body class="bg_gray">
<?php include_once("../../header.php");?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Booked Ticket</h3>
</div>
</div>
</div>
</section>
<section class="m_top_15">
<div class="container">
<div class="row">
<div class="col-sm-12 no-padding ">
<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl;?>/events/">HOME</a></li>
<li style="font-weight: 600;font-size: 15px;">BOOKED TICKET</li>	
</ul>
</div>
</div>
<div class="row">
<?php //include('eventmodule.php'); ?>
<div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10">
<div class="form-group" >
<?php //include('top-button-dashboard.php'); ?>
</div>
<div class="row">
<?php

$pet = new _spevent_transection;

$res = $pet->read($_SESSION['pid']); 

if($res != false){
$table="example";
}else{
$table="";
}


?>
<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="<?php echo $table;?>" >
<thead>
<tr>
<th>ID</th>
<th>Event Title</th>
<th>Event Venue</th>
<th>Booked By</th>
<th>Quantity</th>
<!--<th class="text-center">Tickets price(Each Person)</th>-->
<th class="text-center">Total Price </th>
<th class="text-center">Booked On </th>
<th class="text-center">Action</th>

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
//$p      = new _postingview;
// $pf     = new _postfield;
$pet = new _spevent_transection;

$res = $pet->read($_SESSION['pid']); 


/* $p = new _spevent;
$res = $p->myActPost($_SESSION['pid'], -1, $_GET["categoryID"]);*/

$i = 1; 
if($account_status!=1){
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {

/* if($row){*/

$p = new _spevent;
$res1 = $p->read($row['postid']);

$eventdetail = mysqli_fetch_assoc($res1);

/*echo "<pre>";*/
/* print_r($row);
print_r($eventdetail);*/
/* print_r($row);*/
$totTkt = "";
$catName = "";
$d = new _spprofiles;
$buyernameName = $d->getProfileName($row['buyer_pid']);

$totTkt = $row['ticketcapacity'];
$catName = $row['eventcategory'];


?>
<tr>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$eventdetail['idspPostings'];?>"><?php echo $eventdetail['spPostingTitle'];?></a></td>
<td><?php echo $eventdetail['spPostingEventVenue'];?></td>

<td><?php echo ucwords($buyernameName);?></td>
<td><?php echo $row['quantity'];?></td>
<!--<td><?php echo ($eventdetail['spPostingPrice'] > 0)? '$'.$eventdetail['spPostingPrice']:'Free';?></td>-->
<?php 

$c= new _spuser;
$cu=$c->readcurrency($_SESSION['uid']);
if($cu){
$cur=mysqli_fetch_assoc($cu);
$currency=$cur['currency'];
  }  

?>
<td><?php echo $currency.' '.$row['payment_gross'];?></td> 
<td><?php echo date("Y-m-d H:i:A",strtotime($row['payment_date']));?></td>
<!--  <td class="text-center"><?php echo ($totTkt > 0)?$totTkt:'0';?></td> -->
<!--  <td class="text-center">0</td> -->
<!--    <td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $eventdetail['idspProfiles'];?>" data-intrest="1" >
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($eventdetail['idspPostings'], 1);
if($result != false && $result->num_rows >0){
echo $result->num_rows;
}else{
echo 0;
}
?>
</a>  
</td> -->
<!--   <td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="2" >
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($row['idspPostings'], 2);
if($result != false && $result->num_rows >0){
echo $result->num_rows;
}else{
echo 0;
}
?>
</a>
</td> -->
<td>
<!--     <a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit"></i></a> -->
<a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$eventdetail['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a>
</td>
</tr> <?php
$i++;
}
/* }*/

}}else{?>
<td colspan="9"><center>No Record Found</center></td> 
<?php }?>


</tbody>
</table>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>
</section>

<div class="space"></div>



<?php 
include('loaddetail.php');
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
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
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
</body>
</html>
<?php
} ?>