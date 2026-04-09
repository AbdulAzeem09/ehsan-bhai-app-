<?php 
/*error_reporting(E_ALL);
 ini_set('display_errors', '1');*/
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
$activePage = 4;
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
th {
text-align: center!important;
}
</style>
<body class="bg_gray">
<?php include_once("../../header.php");?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Draft Event</h3>
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
<li style="font-weight: 600;font-size: 15px;">DRAFT EVENT</li>	
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
<?php
$p      = new _spevent;
// $pf     = new _postfield;
//$res    = $p->publicpost_event($_GET["categoryID"]);
//$res = $p->pastEvent($_GET['categoryID'], $today);
$res = $p->readMyDraftprofile($_GET['categoryID'], $_SESSION['pid']);
// $res = $p->draftEvent($_GET['categoryID']);
//echo $p->ta->sql;
$i = 1;
if($res != false){
$table="example";
}else{
$table="";
}

?>
<div class="row">
<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="<?php echo $table;?>" >
<thead>
<tr>
<th></th>
<th>ID</th>
<th>Event Title</th>
<th>Price</th>
<th>Start Date</th>
<th>Start Time</th>
<th>Category</th>
<th>Action</th>

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
$p      = new _spevent;
// $pf     = new _postfield;
//$res    = $p->publicpost_event($_GET["categoryID"]);
//$res = $p->pastEvent($_GET['categoryID'], $today);
$res = $p->readMyDraftprofile($_GET['categoryID'], $_SESSION['pid']);
// $res = $p->draftEvent($_GET['categoryID']);
//echo $p->ta->sql;
$i = 1;
if($account_status!=1){
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 
//print_r($row);
//die('==');

if($row){
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$catName = "";

$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$catName = $row['eventcategory'];
$event_payment_type = $row['event_payment_type'];
/*  while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($venu == ''){
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
}
}
*/
//print_r($row);
$strDate = new DateTime($startDate);

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime); 
$num= number_format((float)$row['spPostingPrice'], 2, '.', '');
$currency=$row['default_currency'];
?>
<tr>
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></td>
<!-- <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$num:'Free';?></td> -->

<td><?php echo ($event_payment_type== 2) ? $currency.' '. $num : 'Free'; ?></td>
<td><?php echo $strDate->format('d-M-Y');?></td>
<td><?php echo date("h:i A", $dtstrtTime); ?></td>
<td><?php echo $catName;?></td>
<td>
<a href="<?php echo $BaseUrl.'/post-ad/events/?draft=1&postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i title="Edit" class="fa fa-pencil"></i></a>

<!--  <a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$row['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a> -->
<a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><i title="Delete" class="fa fa-trash"></i></a>
</td>
</tr> <?php
$i++;
}
}
}}else{ ?>

<td colspan="7"><center>No Record Found</center></td><?php }?>


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
</body>
</html>
<?php
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>