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
$activePage = 11;
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

<style>
#profileDropDown li.active {
background-color: #c11f50 !important;
}
div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}


#profileDropDown li.active a {
color: #fff !important;
}
</style>

</head>

<body class="bg_gray">
<?php include_once("../../header.php"); ?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>All Events</h3>
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
<li style="font-weight: 600;font-size: 15px;">All EVENTS</li>
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
$res = $p->all_event();
//echo $res->num_rows;
//$res    = $p->publicpost_event($_GET["categoryID"]);
// echo $p->ta->sql;
$i = 1;
if ($res != false) {
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

<th class="text-center">Status</th>
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
$res = $p->all_event_pid($_SESSION['pid']);
//echo $res->num_rows;
//$res    = $p->publicpost_event($_GET["categoryID"]);
// echo $p->ta->sql;
$i = 1;
if ($account_status != 1) {




//die('----------------------------');


if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {
//echo '<pre>';
//print_r($row);
// die('hiiiiiiiiiiiii');

$prictype1 = new _spevent_type_price;
$resultdata2 = $prictype1->read($row['idspPostings']);

if ($resultdata2 != false) {
while ($pricedata1 = mysqli_fetch_assoc($resultdata2)) {
//print_r($pricedata1);
$remain = $pricedata1['event_limit'];
//echo $remain;die('=====');
}
}
//posting fields
//  $totTkt = $row2['spPostFieldValue'];
//  $catName = $row2['spPostFieldValue'];

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



if ($row) {


$totTkt = "";
$catName = "";


$totTkt = $row['ticketcapacity'];
$event_payment_type = $row['event_payment_type'];
// echo  $totTkt;die('jjjjjjjjjjjjjjjjjjjjjj');

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
<td><?php  echo ( $event_payment_type== 2) ? $curr . ' '.$num  : 'Free'; ?></td>
<td style="text-align: center;"><?php echo $catName; ?></td>


<td class="text-center">
<?php
$current_d = date("Y-m-d");
$exp_d = $row['spPostingExpDt'];
//echo $current_d;
//echo "<br>";
//echo $exp_d;
//die('===');
if ($current_d < $exp_d) {
if ($row['spPostingVisibility'] == -1) {
echo "Active";
} else if ($row['spPostingVisibility'] == 0) {
echo "Draft";
}
} else {
echo "Expired";
}
?>
</td>
<td>
<a href="<?php echo $BaseUrl . '/post-ad/events/?postid=' . $row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>
<a href="<?php echo $BaseUrl . '/events/dashboard/detail.php?postid=' . $row['idspPostings']; ?>" class=""><i title="View" class="fa fa-eye"></i></a>
<a onclick="delevent('<?php echo $BaseUrl.'/events/dashboard/eventdel.php?postid='.$row['idspPostings']; ?>')" data-postid="<?php echo $row['idspPostings']; ?>" ><i title="Delete" class="fa fa-trash"></i></a>


<!-- <a href="<?php echo $BaseUrl . '/events/dashboard/uploadGallery.php?postid=' . $row['idspPostings']; ?>" class=""><i class="fa fa-info-circle" aria-hidden="true"></i></a> -->


<a href="<?php echo $BaseUrl . '/membership/event_pay.php?postid=' . $row['idspPostings']; ?>" class=""><i class="fa fa-credit-card" aria-hidden="true"></i></a>
</td>
</tr> <?php
$i++;
}
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

<script>
function delevent(id){
   console.log("id:", id); // Log the value to the console for debugging
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
         window.location.href = id;
      }
   });
}


</script>
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
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
