<?php 
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="event/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}


spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../../authentication/check.php");
$_SESSION['afterlogin'] = "../timeline/";
}

$_GET["categoryid"] = $_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
$activePage = 1;


if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

}else{
$re = new _redirect;
$re->redirect($BaseUrl."/events");
}





//print_r($_SESSION['pid']);
?>



<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<?php include '../component/custom.css.php';?>



<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<style>
.bg-event {
background: #ff8ab8;
}

.bg-store {
background: #8cf6ba;
}

.bg-freelance {
background: rgba(255,215,190);
}

.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.panel-body {
width: 320px;
border-radius: 25px 25px 0 0;
border: 1px solid;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
}
.border-event {
border-color: #ff8ab8;
}
.border-freelance {
border-color: rgba(255,215,190);
}
.border-store{
border-color: rgb(140,246,186); 
}

.bg_events:hover{color:#000}
.panel-footer {
width: 320px;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
border-radius: 0 0 25px 25px;
text-align: center;

}
.panel-footer > a {
color: #000;
text-transform: uppercase;
text-decoration: none;
padding: 10px 10px;
font-size: 20px;
font-weight: bolder;
}
#profileDropDown li.active {
background-color: #c11f50;
}
#profileDropDown li.active a {
color: #fff;
}

</style>
</head>

<body class="bg_gray">
<?php include_once("../../header.php");?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Dashboard</h3>
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
<li style="font-weight: 600;font-size: 15px;">DASHBOARD</li>

<a data-toggle="modal" class="pointer pull-right" data-target="#inviteFriend" style="font-weight: 600;font-size: 15px;"><span class="fa fa-user"></span> Invite and Earn </a>

</ul>
</div>
</div>

<div class="row">

<?php //include('eventmodule.php'); ?>    

<div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
<!--   <div class="left_event_top"> -->
<?php include('left-menu.php'); ?> 
<!-- </div> -->
</div>
<!--<div class="col-md-3 pull-right" > 
<a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent" style="    margin-top: -135px;
margin-left: 153px;padding-top: 11px;
padding-bottom: 11px;">Submit an event</a></div>--> <br>

<div class="col-md-10">

<?php if ($_GET['msg'] == "notverified") { ?>

<div class="alert alert-danger" role="alert">
<h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
</div>
<?php   } ?>


<?php	/*if($_GET['msg'] == "notverified"){ ?>

<div class="alert alert-danger" role="alert">
<h1>It Looks Like Your Buisness Profile Not Verified or You Have Not Submitted Your Profile For Verification . Please Contact Support .</h1>
</div>
<?php   }*/ ?>
<div class="row">
<?php

$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}

$or = new _orderSuccess;
$result8 = $or->readMyBalance($_SESSION['pid']);
if ($result8) {
$row8 = mysqli_fetch_assoc($result8);
$balance = $row8['blance'];
}else{
$balance = 0;
}



$ev = new _spevent;
$result9 = $ev->readeventPost($_SESSION['pid']);
//echo $ev->ta->sql;

if($result9){
$postevent = $result9->num_rows;

//  echo $postevent;
}else{
$postevent = 0;
}

$pet = new _spevent_transection;

$result10 = $pet->mybooking($_SESSION['pid']); 
// echo $pet->ta->sql;
if($result10){
$mybooking = $result10->num_rows;

//  echo $postevent;
}else{
$mybooking = 0;
}

/*     $wt = new _spwithdraw;

$result11 = $wt->withdrawread($_SESSION['uid']);

//print_r($result12);

//echo $et->ta->sql;

if($result11){

while ($row2 = mysqli_fetch_assoc($result13)) {


$withdraw_amount += $row2['withdraw_amount'];

}

//echo $t_eventtotalearn;


}
echo "here";
$total_balance = $t_eventtotalearn - $withdraw_amount;*/

//print_r($total_balance);          
$total_balance = 0;

?>
<?php  

//echo $_SESSION['uid'];die;
$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet($_SESSION['uid']);
//echo $_SESSION['uid'];
$amount1=0;
if($oid!=false){

while($r=mysqli_fetch_assoc($oid)){
//print_r($r);
if($account_status!=1){
$amount1+=$r['amount'];

}}}else{$amount1=0;}?>

<?php  
$module = "event";
$w= new _orderSuccess;
$res= $w->readid($_SESSION['uid'],$module); 
//var_dump($res);
$amount2=0;
if($res!=false){ 

while($ra=mysqli_fetch_assoc($res)){
//print_r($ra);
if($account_status!=1){
$amount2+=$ra['amount'];
}
//$dated = $ra['date'];
//echo $dated;
if($amount2==0)
{
$amount2=0;
}
}
//echo $amount2;

}
$amount3 = ($amount1 - $amount2);
//echo $amount3.'======';

?>

<?php    
//echo $_SESSION['uid'];
$sp= new _spuser;
$result = $sp->readcurrency($_SESSION['uid']);

if($result!=false){ 

while($row_n=mysqli_fetch_assoc($result)){


$currency=$row_n['currency'];


}
}

?>
<div class="row" style="margin-left:0px;">
<div class="col-md-4">
<div class="">
<div class="panel-body border-event">
<div class="small-box bg_events">
<div class="inner">
<h3><?php echo $currency.' '.$amount1; ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-event">
<h4 style="font-weight:bolder; color:black;">LIFETIME SALE</h4>
</div>
</div>
</div>




<div class="col-md-4">
<div class="">
<div class="panel-body border-freelance">
<div class="small-box bg_events">
<div class="inner">
<h3><?php $amut=0;  if($amount2){  echo $currency.' '.$amount2; } else { echo $currency.' '.$amut;} ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-freelance">
<h4 style="font-weight:bolder; color:black;">TOTAL WITHDRAWAL</h4>
</div>
</div>
</div>

<div class="col-md-4">
<div class="">
<div class="panel-body border-store">
<div class="small-box bg_events">
<div class="inner">
<h3><?php if($amount3) {echo $currency.' '.$amount3; } else {  echo $currency.' '.$amount1; }

?></h3>          

</div>
<div class="icon">
<i class="fa fa-dollar"></i>
</div>

</div>


</div>
<div class="panel-footer bg-store"style="margin-left: 0px;" >
<h4 style="font-weight:bolder; color:black;">TOTAL AMOUNT LEFT</h4>

</div>

</div>

</div>


<div class="col-md-5">
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info" style="height: 286px;    margin-top: 35px; ">
<div class="box-header with-border">
<h3 class="box-title">Events</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div><!-- /.box-header -->
<div class="box-body" style="padding-top: 20px;">
<div class="table-responsive">
<?php
/*$p = new _postingview;
$po = new _postings;
$en = new _postenquiry;*/

$ev = new _spevent;
$fv = new _event_favorites;

// =========ACTIVE POST
$totalActive = 0;



$result2 = $ev->myActPost($_SESSION['pid'], -1, $_GET["categoryid"]);

/* echo $ev->ta->sql;*/
if($account_status!=1){
if ($result2) {
$totalActive = $result2->num_rows;

//echo  $totalActive;
}}
// =========IN-ACTIVE POST
$totPast = 0;
$today  = date('Y-m-d');
$result4 = $ev->myExpireProduct($_GET['categoryid'], $_SESSION['pid']);
//$result4 = $p->pastEvent($_GET['categoryid'], $today);
if($account_status!=1){
if ($result4) {
$totPast = $result4->num_rows;
}}
// ==========DRAFT
$totalDraft = 0;
$result3 = $ev->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
//echo $ev->ta->sql;
if($account_status!=1){
if ($result3) {
$totalDraft = $result3->num_rows;
}}else{
$totalDraft = 0;
}
// =========FAVOURITE POST
$totFav = 0;
$result5 = $fv->myfavourite_event($_SESSION['pid']);

// echo $fv->ta->sql;
if ($result5) {
$p = new _spevent;
$i = 0;
while($result99 = mysqli_fetch_assoc($result5)){
$result_pf = $p->read($result99['spPostings_idspPostings']);
if($account_status!=1){
if($result_pf){
$totFav =  ++$i;
}
}

}


// $totFav = $result5->num_rows;
}
// ===========TOTAL SPONSORS
$totSpon = 0;
$sp  = new _sponsorpic;
$result6 = $sp->readAll($_SESSION['pid']);
//echo $sp->ta->sql;
if($account_status!=1){
if ($result6) {
$totSpon = $result6->num_rows;
}}
// ========TOTAL FLAG EVENT
$fl = new _flagpost;
$totFlag = 0;
$result7 = $fl->myflagPost($_GET['categoryid'], $_SESSION['pid']);
//echo $fl->ta->sql;
if($account_status!=1){
if ($result7) {
$totFlag = $result7->num_rows;
}}
// ====END
?>
<table class="table table-striped no-margin">
<tbody>

<tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/active-event.php'; ?>">Active Events</a></td>
<td><span class="label label-info"><?php echo $totalActive; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/past-event.php';?>">Past Events</a></td>
<td><span class="label label-info"><?php echo $totPast; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/draft-event.php';?>">Draft Events</a></td>
<td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/sponsor-list.php'; ?>">Total Sponsors</a></td>
<td><span class="label label-success"><?php echo $totSpon; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/bookmark.php';?>">Bookmark Events</a></td>
<td><span class="label label-warning"><?php echo $totFav; ?></span></td>
</tr> 
<!-- <tr>
<td><a href="<?php echo $BaseUrl.'/events/dashboard/myFlag.php';?>">Flagged Events</a></td>
<td><span class="label label-success"><?php echo $totFlag; ?></span></td>
</tr>    -->

</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->

</div><!-- /.box -->
<!-- =======donut chart===== -->
<!--  <div class="nav-tabs-custom">

<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="chart-two" style="position: relative; height: 292px;">   

</div>                                        
</div>
</div> --><!-- /.nav-tabs-custom -->
</div>

<div class="col-md-7">
<!-- Custom tabs (Charts with tabs)-->
<div class="nav-tabs-custom" style="margin-top: 35px;">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 250px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>
<!-- this is xxtra chart for dummy -->
<div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 213px;">

</div>
</div>
</div><!-- /.nav-tabs-custom -->

<!--  <div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 292px;">   
<div id="allmodule"></div>
</div>                                        
</div>
</div> --><!-- /.nav-tabs-custom -->


</div>






</div>


</div>
</div>

</div>
</div>
</div>
</section>



<?php 

include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>




<!-- ========DASHBOARD FOOTER CHARTS====== -->

<!-- Morris.js charts -->

<script src="<?php echo $BaseUrl?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo $BaseUrl?>/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>


<script type="text/javascript">
// Create the chart
Highcharts.chart('jobBoardChart', {
chart: {
type: 'column'
},
title: {
text: 'Event Graph'
},
subtitle: {
text: ''
},
xAxis: {
type: 'category'
},
yAxis: {
title: {
text: ''
}

},
legend: {
enabled: false
},
plotOptions: {
series: {
borderWidth: 0,
dataLabels: {
enabled: true,
format: '{point.y:.0f}'
}
}
},

tooltip: {
headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
},

series: [{
name: 'Events',
colorByPoint: true,
data: [{
name: "Active Events",
y: <?php echo $totalActive;?>
},{
name: "Past Events",
y: <?php echo $totPast; ?>
},{
name: "Draft Events",
y: <?php echo $totalDraft; ?>
},{
name: "Total Sponsors",
y: <?php echo $totSpon;?>
},{
name: "Bookmark Events",
y: <?php echo $totFav;?>
}]/*{
name: "Flagged Events",
y: <?php echo $totFlag;?>
}]*/
}],

});
</script>
<script type="text/javascript">
$(function () {
//Donut Chart
var donut = new Morris.Donut({
element: 'chart-two',
resize: true,
colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
data: [
{label: "Active Events", value: <?php echo $totalActive;?>},
{label: "Past Events", value: <?php echo $totPast; ?>},
{label: "Draft Events", value: <?php echo $totalDraft; ?>},
{label: "Total Sponsors", value: <?php echo $totSpon; ?>},
{label: "Bookmark Events", value: <?php echo $totFav; ?>}
/*{label: "Flagged Events", value: <?php echo $totFlag;?>}*/
],
hideHover: 'auto'
});
});
</script>
<script type="text/javascript">
$(document).ready(function () {
var ctoptions = {// My store pi chart
chart: {
height: 290,
renderTo: 'allmodule',
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false
},
title: {
text: 'All Module',
style: {
fontWeight: 'normal',
fontSize: '13px'
}
},
tooltip: {
pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
},
legend: {
itemStyle: {
color: '#777',
fontWeight: 'normal',
fontSize: '9px'
}
},
credits: {
enabled: false
},
plotOptions: {
pie: {
size: 200,
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: false
},
showInLegend: true,
point: {
events: {
click: function () {
console.log('events');
//window.location.href = "../my-store/";
}
}
}
}
},
series: [{
type: 'pie',
name: 'John',
data: [{
name: "Active Events",
y: <?php echo $totalActive;?>
},{
name: "Past Events",
y: <?php echo $totPast; ?>
},{
name: "Draft Events",
y: <?php echo $totalDraft; ?>
},{
name: "Total Sponsors",
y: <?php echo $totSpon;?>
},{
name: "Bookmark Events",
y: <?php echo $totFav;?>
}]/*{
name: "Flagged Events",
y: <?php echo $totFlag;?>
}]      */                 
}]
}
chart = new Highcharts.Chart(ctoptions);
});
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 
</body>
</html>
<?php
}
?>