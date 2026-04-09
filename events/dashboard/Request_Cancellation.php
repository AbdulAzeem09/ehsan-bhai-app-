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
$activePage = 77;
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
  
    height: 176px;
    font-size: 17px;
    width: 394px;
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
<h3>Booking Cancellation Request</h3>
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
<li style="font-weight: 600;font-size: 15px;">Booking Cancellation Request</li>
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
<th>Cancellation Category</th>
 <th>Cancellation Reason</th>
<th class="text-center">Cancellation Date</th>
<th class="text-center">Status</th>
<th> Event Name</th>
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
$res = $p->spevent_read($_SESSION['pid'], -1); 
 
$i = 1;

if ($account_status != 1) {
if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {
// print_r($row);
    $cancel_id=$row['id'];

$event_id=$row['event_id'];
$rest = $p->sp_read($event_id);
$row3 = mysqli_fetch_assoc($rest);


 
?>
<tr>
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><?php echo $row['cancellation_category']; ?></td>
 
<td style="text-align: center;"><?php echo $row['cancellation_reason']; ?></td>
<td class="text-center"><?php echo $row['cancellation_date'];   ?></td>



<td>
    <?php
    $status = $row['status'];

    if ($status == 0) {
        echo "<span style='color:#ff8320 ;'>Pending</span>";
    } elseif ($status == 1) {
        echo "<span style='color: green;'>Accepted</span>";
    } elseif ($status == 2) {
        echo "<span style='color: red;'>Rejected</span>";
    }
    ?>
</td>





<td class="text-center"><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['event_id']; ?>"><?php echo $row3['spPostingTitle'];  ?></a></td>

<td>
<?php
$txn_id=$row['txn_id'];
?>
<a href="<?php echo $BaseUrl . '/events/dashboard/modal.php?postid=' . $event_id . '&txn_id=' . $txn_id; ?>" class="" data-postid="<?php echo $row['event_id']; ?>">View</a>

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


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<?php


if(isset($_GET['update']) && $_GET['update']=='yes'){
?>
<script>

Swal.fire({
  title: 'Updated Successfully'
})  

</script>
<?php
}
?>
</body>

</html>
<?php
} ?>