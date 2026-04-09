<?php
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION);
 //  ini_set('display_errors', 1);
 // ini_set('display_startup_errors', 1);
 //  error_reporting(E_ALL);

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
<li style="font-weight: 600;font-size: 15px;">TICKET CANCELLATION REQUEST</li>
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
// // echo $p->ta->sql;
// $i = 1;
// if ($res_1 != false) {
// $table = "example";
// } else {
// $table = "";
// }
?>
<div class="row">

<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>



<div class="row">
<form action="updatemodal.php" method="POST">

<div class="col-md-6">


<?php 
$p = new _spevent;
$id = $_GET['txn_id'];
$result = $p->Refund($id);
//print_r($res);die('====');
if ($result != false) {
while ($row3 = $result->fetch_assoc()) {
$paymentDate = $row3['payment_date'];
$currency = $row3['currency'];
$txn_id = $row3['txn_id'];
$paymentstatus = $row3['payment_status'];
$payeremail = $row3['payer_email'];
$postid = $row3['postid'];
$quantity= $row3['quantity'];
$tickettype= $row3['ticket_type'];
$amount = $row3['payment_gross'];
$totalamount = $amount / $quantity;


}
}
$p = new _spevent;
$event_id=$postid;
$rest = $p->sp_read($event_id);
if($rest != false){
$row2 = mysqli_fetch_assoc($rest);
$eventname = $row2['spPostingTitle'];
}
else {
	$eventname = '';
}
$p = new _spevent;
$event_id = $tickettype;
//echo $event_id; die('ghhhh'); 
$res = $p->ticket_type_price($event_id);
//print_r($res);die('====');
if($res){
$rows = mysqli_fetch_assoc($res);
$type = $rows['event_type'];}
//echo $type;die('===========');
?>

<table>
	<tr style="height: 40px;"><th>Event Name </th><td style="width: 50px;"> : </td><td><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $event_id; ?>"><?php echo $eventname;?></a></td></tr>
	<tr style="height: 40px;"><th>Ticket Type </th><td style="width: 50px;"> : </td><td><?php echo $type;?></td></tr>
<tr><th style="width: 150px;display: inline-block;height: 25px;">Payment Status </th><td> : </td><td><?php echo $paymentstatus;?></td></tr>

<tr style="height: 40px;"><th>Payment Date </th><td style="width: 50px;"> : </td><td><?php echo $paymentDate;?></td></tr>

<tr style="height: 40px;"><th>Payment txn id </th><td> : </td><td><?php echo $txn_id;?></td></tr>

<!-- <tr style="height: 40px;"><th>Currency </th><td> : </td><td><?php echo $currency;?></td></tr> -->

<tr style="height: 40px;"><th>Ticket Per Price </th><td> : </td><td><?php echo $currency .' '. $totalamount;?></td></tr>

<tr style="height: 40px;"><th>Ticket Quantity </th><td> : </td><td><?php echo $quantity;?></td></tr>

<tr style="height: 40px;"><th>Total Amount </th><td> : </td><td><?php echo $currency .' '. $amount;?></td></tr>

<tr style="height: 40px;"><th>Payer Email </th><td> : </td><td><?php echo $payeremail;?></td></tr>

</table>


</div>

<?php
$p = new _spevent;
$res = $p->spevent_update($_GET['txn_id']);
if ($res) {
$row = mysqli_fetch_assoc($res);
}
$cancellationcategory = $row['cancellation_category'];
$cancellationreason = $row['cancellation_reason'];
$cancellationdate = $row['cancellation_date'];
//echo $row['sponsorTitle'];die("==========");
?>


<div class="col-md-6">
<div class="form-group">
	<table style="width: 100%;">
		<tr>
		<th style="width: 35.33%;">Cancellation Date</th>
		<td style="width: 31.33%; text-align: center;">:</td>
		<td style="width: 33.33%;height: 30px;"><?php echo $cancellationdate;?></td>
	</tr>
	<tr>
		<th>Cancellation Category</th>
		<td style="text-align: center;">:</td>
		<td style="width: 33.33%;height: 30px;"><?php echo $cancellationcategory;?></td>
	</tr>
	<tr>
		<th>Cancellation Reason</th>
		<td style="text-align: center;">:</td>
		<td><?php echo $cancellationreason;?></td>
	</tr>
	</table><br>
<input type="hidden" name="hiddenField" value="<?php echo $_GET['postid']; ?>">
<input type="hidden" name="event_id" value="<?php echo $_GET['postid']; ?>">
<input type="hidden" name="buyer_userid" value="<?php echo $row['buyer_userid']; ?>">
<input type="hidden" name="txn_id" value="<?php echo $row['txn_id']; ?>">
<label for="sponsorTitle">Event Owner Response</label><br>
<textarea type="textarea" class="form-control" id="sponsorTitle" name="comment" required ><?php echo $row['owner_comment']?></textarea><br>
<?php

$result = $p->spevent_red_data($_GET['txn_id']);
//print_r($result);die("====43-333---");
if($result){
$row2 = mysqli_fetch_assoc($result);
}
///print_r($row2);die("=======");
//echo $row2['spPostingTitle'];die("=======");
?>
<div class="col-sm-12">
<div class="col-md-6" style="margin-left: -30px;">
<label for="sponsorTitle">Refund Amount </label><br>
<input type="text" class="form-control" id="" name="refund" value="<?php echo $row['refund_amount']?>" required />
</div>
<div class="col-md-6" style="margin-top: 27px;">
<input type="radio" id="<?php echo $row['id']; ?>_approve" name="status" value="1" <?php if ($row2['status'] === '1') echo ' checked'; ?>>
<label for="<?php echo $row['id']; ?>_approve" required>Approve</label>
<input type="radio" id="<?php echo $row['id']; ?>_reject" name="status" value="2" <?php if ($row2['status'] === '2') echo ' checked'; ?> required>
<label for="<?php echo $row['id']; ?>_reject">Reject</label><br>
</div>
</div>

<div class="col-sm-12">
	<br>
<?php if($row2['status'] != 0) {
	$date = $row2['owner_comment_date'];
		echo "<label for='Date' style='margin-left:-12px;'>Action Taken Date & Time :</label> ";
    if($row2['status'] != 2){
	echo '<span style="color: green;">' . $date . '</span>';
}
else{
	echo '<span style="color: red;">' . $date . '</span>';
}
}?>
</div>
<div class="form-group">
	<?php if($row2['status'] == 0){?>
<input type="submit" value="Take Action" class="btn btn-primary" name="spSponsorPic"  style="margin-left: 328px;">
	<?php } 
	 else if ($row2['status'] == 1){
	 	echo '';
echo '<h4 style="color:green;">You have Already Accepted this Refund Request</h4>';
}
else{
	echo '<h4 style="color:red;">You have Already Rejected this Refund Request<h4>';
}
?>
</div>
</div>
</div>
</div>

<!-- <div class="col-md-12">
<div class="form-group">
<label for="sponsorDesc">Short Description</label>
<textarea class="form-control" name="sponsorDesc"><?php echo $row['sponsorDesc'];?></textarea>
</div>
</div> -->
<div class="col-sm-12">
<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">

</div>
</div>
</div>

</form>
</div>


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