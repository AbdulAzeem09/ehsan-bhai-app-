<?php
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}

$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
$activePage = 8;
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>

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

div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}

#profileDropDown li.active {
background-color: #c11f50;
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
<h3>Active Events</h3>
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
<li style="font-weight: 600;font-size: 15px;">ACTIVE EVENTS</li>
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
<?php



$p = new _spevent;
$res_1 = $p->myActPost($_SESSION['pid'], -1, $_GET["categoryID"]);
//echo $res->num_rows;
//$res    = $p->publicpost_event($_GET["categoryID"]);
// echo $p->ta->sql;
$i = 1;
if ($res_1 != false) {
$table = "example";
} else {
$table = "";
}
?>
<div class="row">

<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>







<div class="table-responsive">
<table class="table table-striped " class="table table-striped table-bordered dashServ display" id="<?php echo $table; ?>">
<thead>
<tr>
<th></th>
<th>ID</th>
<th>Event Title</th>
<th>Price</th>
<th>Category</th>
<th class="text-center">Remaining Tickets</th>
<th class="text-center">Purchase Tickets</th>
<th class="text-center">Intrested</th>
<th class="text-center">Going</th>
<th>Action</th>

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

$p = new _spevent;
$res = $p->myActPost_active($_SESSION['pid'], -1);
//print_r($res);

//echo $res->num_rows;
//$res    = $p->publicpost_event($_GET["categoryID"]);
//echo $p->ta->sql;
$i = 1;





if ($account_status != 1) {
if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {
// print_r($row);
$prictype1 = new _spevent_type_price;
$resultdata2 = $prictype1->read($row['idspPostings']);

if ($resultdata2 != false) {
while ($pricedata1 = mysqli_fetch_assoc($resultdata2)) {
$remain = $pricedata1['event_limit'];
}
}

$pf = new _spevent_transection;
//echo $row['idspPostings'];die('========');
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



//if($row){


$totTkt = "";
$catName = "";


$totTkt = $row['ticketcapacity'];
$event_payment_type = $row['event_payment_type'];
 //echo  $event_payment_type.'++++++';

$catName = $row['eventcategory']; 

// print_r($row);	
//exit;
$soldticket = 0;
//echo $result_pf;
if ($result_pf != false) {
while ($row21 = mysqli_fetch_assoc($result_pf)) {
// print_r($row21);die('=========');

$soldticket += $row21['quantity'];

$curr = $row21['currency'];
}
}



$num= number_format((float)$eventprice, 2, '.', '');
?>
<tr>
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>
<td><?php echo ( $event_payment_type== 2) ? $curr . ' ' . $num : 'Free'; ?></td>
<td style="text-align: center;"><?php echo $catName; ?></td>
<td class="text-center"><?php echo ($remain > 0) ? $remain : '0'; ?></td>
<td class="text-center"><?php echo ($soldticket > 0) ? $soldticket : '0'; ?></td>
<td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $row['idspProfiles']; ?>" data-intrest="1">
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($row['idspPostings'], 1);
// echo $ie->ta->sql;
if ($result != false && $result->num_rows > 0) {

echo $result->num_rows;
} else {

echo 0;
}
?>
</a>
</td>
<td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $row['idspProfiles']; ?>" data-intrest="2">
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($row['idspPostings'], 2);
if ($result != false && $result->num_rows > 0) {
echo $result->num_rows;
} else {
echo 0;
}
?>
</a>
</td>
<td>
<a href="<?php echo $BaseUrl . '/post-ad/events/?postid=' . $row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings']; ?>"><i title="Edit" class="fa fa-pencil"></i></a>
<a href="<?php echo $BaseUrl . '/events/dashboard/detail.php?postid=' . $row['idspPostings']; ?>" class=""><i title="View" class="fa fa-eye"></i></a>
<a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost"><i title="Delete" class="fa fa-trash"></i></a>


<a href="<?php echo $BaseUrl . '/events/dashboard/uploadGallery.php?postid=' . $row['idspPostings']; ?>" class=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
</td>
</tr> <?php
$i++;
//}
}
}
} else { ?>
<td colspan="9">
<center>No Record Found</center>
</td>
<?php } ?>


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