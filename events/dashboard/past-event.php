<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
$activePage = 3;


if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!--This script for posting timeline data End-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

</head>
<style>
.dropdown-menu {
border: none;
}

#profileDropDown li.active {
background-color: #c11f50;
}

div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}

#profileDropDown li.active a {
color: #fff;
}

</style>

<body class="bg_gray">
<?php include_once("../../header.php"); ?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Past Event</h3>
</div>
</div>
</div>
</section>
<section class="m_top_15">
<div class="container">
<div class="row">
<div class="col-sm-12 no-padding ">
<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl; ?>/events/">HOME</a></li>
<li style="font-weight: 600;font-size: 15px;">PAST EVENT</li>

</ul>
</div>
</div>
<div class="row">

<?php //include('eventmodule.php'); 
?>


<div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-md-10">
<div class="form-group">
<?php //include('top-button-dashboard.php'); 
?>
</div>
<?php $p      = new _spevent;

$res = $p->myExpireProduct($_GET['categoryID'], $_SESSION['pid']);

if ($res != false) {
$table = "example";
} else {
$table = "";
}


?>

<style> 
.aa{
text-align: center!important;
}
</style>
<div class="row">

<div class="col-sm-12" style="width: 1000px;">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped " class="table table-striped table-bordered dashServ display" id="<?php echo $table; ?>">
<thead>
<tr>
<th></th>
<th class="text-center aa">ID</th>
<th class="text-center aa">Event Title</th>
<th class="text-center aa">Date / Time</th>
<th class="text-center aa">Price</th>
<th class="text-center aa">Ticket Sold</th>
<th class="text-center aa">Earning</th>
<th class="text-center aa">Category</th>
<th class="text-center aa">Action</th>

</tr>
</thead>
<tbody>
<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$p      = new _spevent;
//$pf     = new _postfield;
$or     = new _order;
//$res    = $p->publicpost_event($_GET["categoryID"]);
$today  = date('Y-m-d');
$res = $p->myExpireProduct($_GET['categoryID'], $_SESSION['pid']);
//$res = $p->pastEvent($_GET['categoryID'], $today, $_SESSION['pid']);
//echo $p->ta->sql;
if ($account_status != 1) {
if ($res != false) {
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row);
//posting fields

// $result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";

$pf = new _spevent_transection;
$result_pf = $pf->postread($row['idspPostings']);

$result_pf = $pf->postread($row['idspPostings']);
//$pricedata1 = mysqli_fetch_assoc($result_pf);
//print_r($pricedata1);die;
//echo $pf->ta->sql."<br>";
$pdata = $pf->readprice($row['idspPostings']);
if ($pdata != false) {

$pricedata = mysqli_fetch_assoc($pdata);
$eventprice = $pricedata['event_price'];

//	echo $eventprice;
//$curr=$pricedata1['currency'];
}
else{
$eventprice = 0;
}
if ($row) {

$startDate = "";
$endDate = "";
$startTime    = "";
$endTime = "";
$catName = "";

$startDate = $row['spPostingStartDate'];
$endDate = $row['spPostingEndDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$catName = $row['eventcategory'];
$currency=$row['default_currency'];

$event_payment_type = $row['event_payment_type'];
//$eventprice = $pricedata['event_price'];

if ($result_pf) {
while ($row2 = mysqli_fetch_assoc($result_pf)) {
/* echo "<pre>";
print_r($row2);*/
$curr = $row2['currency'];

$soldticket += $row2['quantity'];

$totalearnprice +=  $row2['payment_gross'];
}
} else {

$soldticket = 0;

$totalearnprice =  0;
}




/*  while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($endDate == ''){
if($row2['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row2['spPostFieldValue'];
}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue'];

}
}
if($catName == ''){
if($row2['spPostFieldName'] == 'eventcategory_'){
$catName = $row2['spPostFieldValue'];

}
}
}
*/

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
$todaydate = date('Y-m-d');
//echo "<br>";
if ($endDate < $todaydate) {
$strDate = new DateTime($startDate);
$endingDate = new DateTime($endDate);

// TOTAL TICKET SOLD
$result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $row['idspPostings']);
if ($result4) {
$totSoldTkt = $result4->num_rows;
} else {
$totSoldTkt = 0;
}



$num= number_format((float)$eventprice, 2, '.', '');
?>
<tr>
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>

<td><?php echo $strDate->format('d-M-Y') . ' / ' . date("h:i A", $dtstrtTime); ?></td>
<td><?php echo ($event_payment_type== 2) ? $currency.' '.$num  : 'Free'; ?></td>
<td class="text-center"><?php echo $totSoldTkt; ?></td>
<td class="text-center"><?php echo $totalearnprice; ?></td>
<td><?php echo $catName; ?></td>
<td class="text-center">
<a href="<?php echo $BaseUrl . '/events/dashboard/detail.php?postid=' . $row['idspPostings']; ?>" class=""><i title="View" class="fa fa-eye"></i></a>
<a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost"><i title="Delete" class="fa fa-trash"></i></a>

</td>
</tr> <?php
$i++;
}
}
}
}
} else { ?>

<td colspan="8">
<center>No Record Found</center>
</td><?php } ?>


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

include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
}); //End of create main table


$('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
});
</script>

</body>

</html>
<?php
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>