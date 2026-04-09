<?php
/*error_reporting(E_ALL);
 ini_set('display_errors', '1');*/

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
$activePage = 7;


if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}
?>
<style>
th {
width: 0%;
font-size: 13px !important;
}

.dataTables_filter {
margin-bottom: 5px !important;

}

.event1 {
white-space: nowrap !important;
width: 50px !important;
overflow: hidden !important;
text-overflow: ellipsis !important;


}

span#car1 {
margin-top: 10px;
}

#profileDropDown li.active {
background-color: #c11f50 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}
</style>
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

<body class="bg_gray">
<?php include_once("../../header.php"); ?>
<style>



.inner_top_form button {

padding:9px 12px !important;
}
</style>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Event Booking</h3>
</div>
</div>
</div>
</section>
<section class="m_top_15">
<div class="container">
<?php //include('eventmodule.php'); 

?>
<div class="row">

<div class="col-sm-12 no-padding ">

<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl; ?>/events/">HOME</a></li>
<li style="font-weight: 600;font-size: 15px;">EVENT CANCELLATION FORM</li>

</ul>
</div>
</div>

<?php 
$txnid = isset($_GET['txn_id']) ? (int) $_GET['txn_id'] : 0;
$p = new _spevent;
$id = $txnid;
$result = $p->Refund($id);
//print_r($res);die('====');
if ($result != false) {
 

while ($row = $result->fetch_assoc()) {
$paymentDate = $row['payment_date'];
$currency = $row['currency'];
$txn_id = $row['txn_id'];
$paymentstatus = $row['payment_status'];
$payeremail = $row['payer_email'];
$amount = $row['payment_gross'];
$tickettype= $row['ticket_type'];
$quantity= $row['quantity'];
$totalamount = $amount / $quantity;
}
}

//die('====lopl=====');
$post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
$p = new _spevent;
$eventid=$post_id;
$rest = $p->sp_read($eventid);
if($rest)
{
$row3 = mysqli_fetch_assoc($rest);
}
$eventname = $row3['spPostingTitle'];

$p = new _spevent;
$event_id = $tickettype;
//echo $event_id; die('ghhhh'); 
$res = $p->ticket_type_price($event_id);
//print_r($res);die('====');
if($res){
$rows = mysqli_fetch_assoc($res);
}
$type = $rows['event_type'];
//echo $type;die('===========');

?>
<!-- //select * from spevent_cancellation where txn_id=$_GET['txn_id'] -->






<div class="row">
<div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-md-10">
	<div class="form-group">
<?php //include('top-button-dashboard.php'); 
?>

</div>
<div class="row">
	<div class="box box-danger">
		<div class="box-body">
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
	<div class="col-md-6" style="margin-top: 5px;">
<table>
	<tr style="height: 40px;"><th>Event Name </th><td style="width: 50px;"> : </td><td><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $eventid; ?>"><?php echo $eventname;?></a></td></tr>
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
$res = $p->spevent_update($txnid);
if ($res != false) {
$row = mysqli_fetch_assoc($res);
$cancellationcategory = $row['cancellation_category'];
$cancellationreason = $row['cancellation_reason'];
$cancellationdate = $row['cancellation_date'];
}else {
   $cancellationcategory ='--';
$cancellationreason = '--';
$cancellationdate = '--';
}

//echo $row['sponsorTitle'];die("==========");
?>

<div class="col-md-6" style="margin-top: 5px;">
<form action="action.php" method="POST">
<div class="col-sm-12">
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
<input type="hidden" name="postid" value="<?php echo $post_id; ?>">
<input type="hidden" name="txn_id" value="<?php echo $txnid; ?>">
</div>
<div class="col-sm-12">
<label for="Select">Select a Refund Reason</label>
<select id="select" class="form-control " id='option' name="option">
<option value="">Select a Refund Reason</option>
<option value="COVID-19">COVID-19</option>
<option value="Dissatisfied with event">Dissatisfied with event</option>
<option value="Duplicate order">Duplicate order</option>
<option value="Event cancelled or postponed">Event cancelled or postponed</option>
<option value="Forgot to use discount or promo code">Forgot to use discount or promo code</option>
<option value="No longer able to attend">No longer able to attend</option>
<option value="Other reason not listed">Other reason not listed</option>
<option value="Purchased the wrong ticket">Purchased the wrong ticket</option>
<option value="Refund within organizer policy">Refund within organizer policy</option>
<option value="Ticket price or taxes changed">Ticket price or taxes changed</option>
</select>

</div>
<div class="col-sm-12">
<br>
<label for="textarea">Write Event Cancellation Reason</label>
<textarea class="form-control" name="text" id="text"></textarea>

</div>
<div class="col-sm-12">

<br>

<?php
//die("====4444559955==");
$res = $p->read_canceldata($txnid);

if ($res != false) {
    $row4 = mysqli_fetch_assoc($res);
    $status = $row4['status'];

    if ($status == '0') {
        echo "<span style='color:#ff7208'>Cancellation Request Already Sent On {$row4['cancellation_date']}</span>";
?>
<div class="col-sm-12">
    <br>
<a href="#" onclick="showConfirmation('<?php echo $BaseUrl.'/events/dashboard/delete_request.php?req_id='.$row4['id']; ?>')">Click Here To Remove Your Request</a>
</div>
   <?php 

    } else if ($status == 1) {
        echo "<span style='color:green;'>Your Request for Cancellation of Ticket has been successfully Accepted on " . $row4['cancellation_date'] . ", you got ".$currency ." " . $row4['refund_amount'] . " Please check your Event Wallet, and this is Event Owner Comment \"{$row4['owner_comment']}\"</span>";
    } else if ($status == 2) {
        echo "<span style='color:red;'>Your Request for Cancellation of Ticket has been successfully Rejected on " . $row4['cancellation_date'] . ", you got ".$currency ." "  . $row4['refund_amount'] . " Please check your Event Wallet, and this is Event Owner Comment \"{$row4['owner_comment']}\"</span>";
    }
} else {
    ?>
    <input type="submit" class='btn btn-primary' name="" value="submit" style="margin-left: 336px;">
    <?php
}

?>





<br>
</div>
</form>
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


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function showConfirmation(deletedurl) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deletedurl;
            // Perform the delete operation here
            // You can call your "hello()" function or make an AJAX request to delete the item
            // Example: hello();
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
<!-- <?php
}
?> -->

<script>
$(document).ready(function() {
$('#myTable').DataTable();
});
</script>
