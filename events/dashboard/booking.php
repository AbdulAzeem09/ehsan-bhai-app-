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

require_once '../../backofadmin/library/config.php';

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

.cancel-event {
  white-space: nowrap;
}


div:where(.swal2-container).swal2-center>.swal2-popup {
    font-size: 15px;
    height: 166px;
    width: 416px;
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
<li style="font-weight: 600;font-size: 15px;">EVENT BOOKING</li>

</ul>
</div>
</div>



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

<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="table-responsive">
<div  class="table table-striped table-bordered dashServ display" style="margin-top:10px;">
<!--<table class="table table-striped eventTable">-->

<?php

$pet = new _spevent_transection;
$res = $pet->mybooking($_SESSION['pid']);

if ($res) {

$table_1 = "example";
} else {
$table_1 = "";
}

?>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table tbl_store_setting display eventTable" id="example" cellspacing="0" width="135%">



<thead>
<tr>
<th></th>
<th>Order ID</th>
<th>Event Title</th>
<th>Venue</th>
<th>Organised By</th>
<th class="text-center">Tickets P.P.</th>
<th class="text-center">Quantity</th>
<th class="text-center">Ticket Type</th>
<th class="text-center">Total Amount </th>
<th class="text-center">Booked On </th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
//  $p      = new _postingview;
//$pf     = new _postfield;

//$fv = new _event_favorites;
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}

$p  = new _spevent;

$d = new _spprofiles;


//$res = $p->pastEvent($_GET['categoryID'], $today);
//$res = $p->draftEvent($_GET['categoryID']);
//echo $p->ta->sql;
if ($account_status != 1) {
if ($res != false) {
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {

 $txn_id = $row['id'];

 $curr = $row['currency'];
//echo $curr;die("=======");
//posting fields
$result_pf = $p->read($row['postid']);
// echo $p->ta->sql."<br>";

$sellerName = $d->getProfileName($row['sellid']);
//if($sellerName){ 

if ($result_pf) {

$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$catName = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
/*echo "<pre>";
print_r($row2);*/


$venu = $row2['spPostingEventVenue'];
$startDate = $row2['spPostingStartDate'];
$startTime = $row2['spPostingStartTime'];
$endTime = $row2['spPostingEndTime'];
$catName = $row2['eventcategory'];


/* if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

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
}*/

$strDate = new DateTime($startDate);


$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime); ?>

<tr>


<td></td>
<td><?php echo $row['id']; ?></td>
<td class="eventcapitalize event1"><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row2['idspPostings']; ?>"><?php echo $row2['spPostingTitle']; ?></a></td>
<td><?php echo $venu; ?></td>
<td><a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row['sellid'] ?>"><?php echo ucwords($sellerName); ?></a></td>

<?php 
//print_r($row2); die;

 // echo ($row2['event_payment_type']);die('=====');
?>

<td style="text-align: center;"><?php echo ($row2['event_payment_type'] == 1) ? 'Free' : 'Paid'; ?></td>
<td style="text-align: center;"><?php echo $row['quantity']; ?></td>

<?php

$prictype = new _spevent_type_price;
$resultdata = $prictype->readtypid($row['ticket_type']);

if ($resultdata != false) {

$pricedata = mysqli_fetch_assoc($resultdata);

$event_type = $pricedata['event_type'];
}


?>

<td style="text-align: center;"><?php echo $event_type; ?></td>


<td style="text-align: center;"><?php echo $curr . ' ' . $row['payment_gross']; ?></td>

<td><?php echo date("Y-m-d H:i:A", strtotime($row['payment_date'])); ?></td>
<td class="cancel-event"><a href="<?php echo $BaseUrl . '/events/dashboard/plus.php?postid=' . $row['postid'].'&txn_id='.$txn_id; ?>">Cancel Event Ticket</a></td>


<!--  <td><?php echo $strDate->format('d-M-Y'); ?></td>
<td><?php echo date("h:i A", $dtstrtTime); ?></td>
<td><?php echo $catName; ?></td> -->
<!--<td class="text-center">

 <a href="<?php echo $BaseUrl . '/events/dashboard/detail.php?postid=' . $row2['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a> -->
<?php

/*$er = new _speventreview_rating;
$re_res =  $er->read($_SESSION['pid'],$row['postid']);
if($re_res){
$row_re = mysqli_fetch_assoc($re_res);
}




if($re_res->num_rows == 0){
?>
<a href="<?php echo $BaseUrl.'/events/eventreview.php?postid='.$row2['idspPostings']; ?>" class=""><i class="fa fa-star"></i></a>
<?php
}*/

?>


<!-- <a href="<?php echo $BaseUrl . '/events/dashboard/event-booking-pdf.php?id=' . $row['id']; ?>" class="" id="btnPDF" target="_blank"><i class="fa fa-file-pdf-o "></i></a>-->


<!-- <a href="<?php echo $BaseUrl . '/events/dashboard/aprove.php?org=1&postid=' . $row2['idspPostings'] . '&pid=' . $_SESSION['pid'] . '&stat=1'; ?>">Aprove</a> | <a href="<?php echo $BaseUrl . '/events/dashboard/aprove.php?org=1&postid=' . $row2['idspPostings'] . '&pid=' . $_SESSION['pid'] . '&stat=0'; ?>">Reject</a> </td>-->
</tr> <?php
$i++;


$Date = new DateTime($row2['spPostingDate']);
$startTime = $row2['spPostingStartTime'];
$dtstrtTime = strtotime($startTime);
$firstname = $row['first_name'];
$lastname = $row['last_name'];
//echo date("h:i A", $dtstrtTime);

// $Starttime = new strtotime($eventdetail['spPostingStartTime']);

$html = '
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
padding-left : 40px;

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


<div class="col-sm-12">
<div class="bg_white detailEvent m_top_10">



<div class="row">
<div class="showeventrating">


<p style="text-align:center; padding-top:20px;"> <img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
<p style="font-size: 30px; text-align:center;">The SharePage</p>
<div class="textboxcenter">
<div class="col-md-6">                                 
<table class="table">


<tbody>
<tr class="trdata">
<td class="pdftablehead newtddata">Event Title :</td>
<td class="tddata newtddata">' . $row2['spPostingTitle'] . '</td>

</tr>
<tr class="trdata">
<td class="pdftablehead newtddata">Date :</td>
<td class="tddata newtddata">' . $Date->format('d M Y') . '</td>

</tr>
<tr class="trdata">
<td class="pdftablehead newtddata">Start Time :</td>
<td class="tddata newtddata" style="text-transform: uppercase;">' . date("h:i A", $dtstrtTime) . '</td>

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
<td class="tddata" style="font-weight:bold; border:none!important;">' . $firstname . '    ' . $lastname . '</td>

</tr>
<tr>
<td class="pdftablehead">Organized By :</td>
<td class="tddata">' . ucwords($sellerName) . '</td>

</tr>

<tr>
<td class="pdftablehead">Venue :</td>
<td class="tddata">' . $row2['spPostingEventVenue'] . '</td>

</tr>
</tbody>
</table>

</div>
<div class="col-md-6"  style="width:50%;float:right;">
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="padding-left:130px; border:none!important;">Ticket Quantity : </td>
<td class="tddata" style="padding-left:20px; border:none!important;">' . $row['quantity'] . '</td>

</tr>
<tr>
<td class="pdftablehead"></td>
<td class="tddata" style="padding-bottom:35px;"></td>

</tr>
<tr>
<td class="pdftablehead"></td>
<td class="tddata"  style="padding-left:30px;"></td> 

</tr>
</tbody>
</table>
</div>
</div>
</div>

<hr>                          

<div class="row">
<div class="col-md-4" style="width:30%; float:left;">                                 
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important;">Price P. P.<br><br>$' . $row2['spPostingPrice'] . '</td>



</tr>

</tbody>
</table>

</div>
<div class="col-md-4"  style="width:30%;">
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important; padding-left:100px;">Quantity<br><br> ' . $row['quantity'] . '</td>


</tr>

</tbody>
</table>

</div>

<div class="col-md-4"  style="width:50%; float:right; padding-left:150px;">
<table class="table">

<tbody>
<tr class="" style="border:none!important;">
<td class="pdftablehead " style="border:none!important; padding-left:240px; padding-top:-80px;">Total Price<br><br>$' . $row['payment_gross'] . '</td>


</tr>

</tbody>
</table>

</div>
</div>


<hr>
<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Booked on : ' . date("Y-m-d H:i:A", strtotime($row['payment_date'])) . '</p>


<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>' . $row['remark'] . ' <br> Transaction ID : ' . $row['txn_id'] . '</p>
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
}
}
} else { ?>

<td colspan="10">
<center>No Record Found</center>
</td><?php } ?>



</tbody>
</table>


</div>





</div>

</div>
</div>

<h4 style="font-weight:bold;margin: 40px 0 20px;">SHEREPAGE EVENT</h4>
<div class="box box-danger">
  <div class="box-body">
<div class="table-responsive">
<table class="table tbl_store_setting display eventTable" id="shere_event" cellspacing="0" width="135%">
<thead>
<tr>
<th></th>
<th class="text-center">ORDER ID</th>
<th>Buyer Name</th>
<th>Event Name</th> 
<th>Event Packages</th>                 
<th>Booking Date</th>
<th>Amount Paid</th>
<th>Transection Id</th>
<th>Status</th>
</tr>
</thead>
<tbody>
  
    <?php 
      $sql = "SELECT * FROM register_event where user_id = ".$_SESSION['uid'];
      $result = dbQuery($dbConn, $sql);
      //print_r($result);
      $i = 1;
      while($row = mysqli_fetch_assoc($result)) {
        if($row['formType'] == 'event'){
          if(isset($row['registration_type'])){                   
            $package = json_decode($row['registration_type']);
            $package_srt = '';
            foreach ($package as $value) {
              $package_srt .=  $value->reg_name.' : '.$value->price.' X '.$value->quantity.'<br>';
            }
          }
        }elseif($row['formType'] == 'sponsor'){
          if(isset($row['registration_type'])){                   
            $package = json_decode($row['registration_type']);    
            $package_srt =  $package->name.' : '.$package->value.'';            
          }
        }
        else{
          $package_srt = '';
        }

        $eventdsql = "SELECT * FROM sharepage_event where id = ".$row['event_id'];
        $eventresult = dbQuery($dbConn, $eventdsql);
        $event = mysqli_fetch_assoc($eventresult);       
        $eventName = '-';
        if($event['event_title'] != ''){
          $eventName = $event['event_title'];
        }
    ?>
    <tr>
      <td></td>
      <td class="text-center"><?php  echo $i;?></td>    
      <td><?php echo $row['fistname'];?> <?php echo $row['lastname'];?></td>                        
      <td class="text-center"><?php echo  $eventName;?></td>
      <td class="text-center"><?php echo $package_srt;?></td>
      <td class="text-center"><?php echo date("Y-m-d H:i:A",strtotime($row['created']));?></td>                       
      <td><?php echo '$'.number_format($row['ticket_price'], 2); ?></td>
      <td><?php echo $row['transactions_id'];?></td>    
      <td class="text-center"><?php echo $row['pyament_status'];?></td>
    </tr>
    <?php $i++;} ?>
</tbody>
</table>
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


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<?php


if(isset($_GET['submited']) && $_GET['submited']=='yes'){
?>
<script>

Swal.fire({
  title: 'Request Sent Successfully'
})  

</script>
<?php
}
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

var table = $('#shere_event').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
});

$('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
});
</script>

<?php
include '../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf


$mpdf->WriteHTML($html);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("eventticket.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); 
?>


</body>

</html>
<?php
}
?>





<script>
$(document).ready(function() {
$('#myTable').DataTable();
});
</script>
