<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../../univ/baseurl.php');
session_start();
$link .= $_SERVER['REQUEST_URI'];



if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once("../../authentication/check.php");
$_SESSION['afterlogin'] = "../../timeline/";
}

$_GET["categoryid"] = $_GET["categoryID"] = 13;

$activePage = 1;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->

<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
<style>
.bg-event {
background: #ff8ab8;
}

.bg-store {
background: #8cf6ba;
}

.bg-freelance {
background: rgba(255, 215, 190);
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
border-color: rgba(255, 215, 190);
}

.border-store {
border-color: rgb(140, 246, 186);
}

.bg_events:hover {
color: #000
}

.panel-footer {
width: 320px;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
border-radius: 0 0 25px 25px;
text-align: center;

}

.panel-footer>a {
color: #000;
text-transform: uppercase;
text-decoration: none;
padding: 10px 10px;
font-size: 20px;
font-weight: bolder;
}
</style>
</head>

<body class="bg_gray">
<?php
$header_photo = "header_photo";
include_once("../../header.php");
?>


<section class="">
<div class="container-fluid">

<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar">
<?php include('left-menu.php'); ?>


</div>
<div class="col-md-10" style="margin-top:10px;">
<ul class="breadcrumb" style="background-color: #fff;font-size: 20px;">
<li><a style=" color: #0B241E;">DASHBOARD</a></li>
<a data-toggle="modal" class="pointer pull-right" data-target="#inviteFriend" style="font-weight: 600;font-size: 15px;" ><span class="fa fa-user"></span> Invite and Earn </a>
</ul>
</div>
<div class="col-md-10" style="margin-top:10px;">

<?php if ($_GET['msg'] == "notverified") { ?>

<div class="alert alert-danger" role="alert">
<h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
</div>
<?php   } ?>

<?php if ($_GET['msg'] == "notacess") { ?>

<div class="alert alert-danger" role="alert">
<h1> It Looks Like Your Buisness Profile Not Verified or You Have Not Submitted Your Profile For Verification . Please Contact Support .</h1>
</div>
<?php   } ?>
<?php if ($_GET['msg'] == "notacess") { ?>

<div class="alert alert-danger" role="alert">
<h1> You can not access this product or this product not might exist.</h1>
</div>
<?php   } ?>


<?php

$oi = new _spcustomers_basket;
//$oid= $oi->readiddd($_SESSION['uid']);
$oid = $oi->readiddd($_SESSION['uid']);

if ($oid != false) {
$amount1 = 0;
while ($r = mysqli_fetch_assoc($oid)) {
//print_r($r);

$amount1 += (int)$r['amount'];
}
}

//echo $amount1;

?>

<?php
$module = "artandcraft";
$w = new _orderSuccess;
$res = $w->readid($_SESSION['uid'], $module);
if ($res != false) {
$amount2 = 0;
while ($ra = mysqli_fetch_assoc($res)) {
//print_r($r);

$amount2 += $ra['amount'];
//$dated = $ra['date'];
//echo $dated;

}
//echo $amount2;
$amount3 = ($amount1 - $amount2);
}



?>

<?php
//echo $_SESSION['uid'];
$sp = new _spuser;
$result = $sp->readcurrency($_SESSION['uid']);

if ($result != false) {

while ($row_n = mysqli_fetch_assoc($result)) {


$currency = $row_n['currency'];
}
}

//$currency 
//$amount1 
//die("========");

?>
<br>
<div class="row">
<div class="col-md-4">
<div class="">
<div class="panel-body border-event">
<div class="small-box bg_events">
<div class="inner">
<h3><?php if ($amount1) {
echo $currency . ' ' . $amount1;
} else {
echo $currency . " 0";
} ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-event">
<a href="https://thesharepage.com/dashboard/finance/event_wallet.php">Lifetime Sale </a>
</div>
</div>
</div>




<div class="col-md-4">
<div class="">
<div class="panel-body border-freelance">
<div class="small-box bg_events">
<div class="inner">
<h3><?php $amut = 0;
if ($amount2) {
echo $currency . ' ' . $amount2;
} else {
echo $currency . ' ' . $amut;
} ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-freelance">
<a href="#">Total Withdrawal </a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="">
<div class="panel-body border-store">
<div class="small-box bg_events">
<div class="inner">
<h3><?php if ($amount3) {
echo $currency . ' ' . $amount3;
} else {
echo $currency . " 0";
}

?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-store">
<a href="#">Total Amount left</a>
</div>
</div>
</div>


</div>
<br>

<div class="row">
<div class="col-md-6">
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Art Gallery</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div><!-- /.box-header -->
<div class="box-body">
<div class="table-responsive">
<?php
$p = new _postingview;
$po = new _postings;
$en = new _postenquiry;
$atb = new _addtoboard;
$ag = new _artgalleryenquiry;
$o = new _artcraftOrder;
$oa = new _postingviewartcraft;

// MY TOTAL ORDER WHICH I BUY
$st = new _orderSuccess;
$totBuyOrdr = 0;
$cancel_count = 0;
$return_request = 0;
$status1 = $st->readstatus_art($_SESSION['pid'], $_SESSION['uid']);
$totBuyOrdr = $status1->num_rows;

if ($totBuyOrdr == "") {
$totBuyOrdr = 0;
}


$status2 = $st->readstatus_art_cancel($_SESSION['pid'], $_SESSION['uid']);
$cancel_count = $status2->num_rows;
if ($cancel_count == "") {
$cancel_count = 0;
}

$status3 = $st->readstatus_art_refund($_SESSION['pid'], $_SESSION['uid']);
$return_request = $status3->num_rows;
if ($return_request == "") {
$return_request = 0;
}

$resultn = $atb->readMyBoard($_SESSION['pid']);

//$result = $atb->readMyBoard2_get($_SESSION['pid']);

$sum_board = 0;

if ($resultn == false) {
  $sum_board = 0;
}
else{
 
while($rows = mysqli_fetch_assoc($resultn)){
$res6 = $atb->readMyBoard2($rows['spPosting_idspPosting']);
//echo $rows['spPosting_idspPosting']; echo '-------------------------';
 if($res6 != false){
$sum_board =$sum_board+1;
}
}




}






//echo $numrows;
//die('---------');

//print_r($status);die;


// =========FAVOURITE POST
$no = new     _postingviewartcraft;
$totFav = 0;
$result5 = $no->event_favorite($_SESSION['pid'], $_SESSION['uid']);
//echo $p->ta->sql;
if ($result5) {
$totFav = $result5->num_rows;
}




$o = new _artcraftOrder;
$result = $o->readBuyerOrder($_SESSION['pid']);

//echo $o->ta->sql; die();
// $p = new _orderSuccess;
// $result = $p->readmyOrder($_SESSION['pid']);
// //echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);

$result1 = $o->readBuyerOrdertotalpro($id);
//echo $o->tad->sql; die();		
//print_r($result1); die('-=======================-===========');
if ($result1) {
while ($row1 = mysqli_fetch_assoc($result1)) {

$products_checkout_id = $row1['id'];
$productid = $row1['spPostings_idspPostings'];
$price = $row1['price'];


$p1 = new _postingviewartcraft;

$pres = $p1->singletimelines($productid);
/* if($pres=="")
{
$resrp=""; 
}
else{
$resrp = mysqli_fetch_array($pres);

$result2 = $o->existStatus($products_checkout_id);

$row2 = mysqli_fetch_assoc($result2);
//print_r($row2); die("-------------------");
if($row2['Cancel']==1){


$cancel_count = $cancel_count+1;

}

if($row2['return_request'] ==1){


$return_request = $return_request+1;

}

}*/
}
}
}
}








// ============YOUR BOARD

$result6 = $atb->readMyBoard($_SESSION['pid']);
// $numrowsw = $result6->num_rows; 
// echo $numrowsw;
//print_r($numrowsw);
// $n= new _postingview;
if ($result6) {
//print_r($result6);
while ($rows = mysqli_fetch_assoc($result6)) {

$res = $p->singletimelines($rows['spPosting_idspPosting']);
//var_dump($res);
if ($res != false) {
// print_r($res);


$board = $res->num_rows;
//echo $board;
/*  if ($result6) {

$board = $result6->num_rows;
}*/
}
}
}
?>
<table class="table table-striped no-margin">
<tbody>
<tr>
<td><a href="<?php echo $BaseUrl . $pageLink . 'my_order.php'; ?>">My Orders (New Purchased)</a></td>
<td><span class="label label-success"><?php if ($totBuyOrdr != false) {
echo $totBuyOrdr;
} else {
echo 0;
} ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/artandcraft/dashboard/cancel_order.php'; ?>">Cancel Orders</a></td>
<td><span class="label label-warning"><?php if ($cancel_count != false) {
echo $cancel_count;
} else {
echo 0;
} ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/artandcraft/dashboard/return_request.php'; ?>">Return Request</a></td>
<td><span class="label label-info"><?php if ($return_request != false) {
echo $return_request;
} else {
echo 0;
} ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/artandcraft/dashboard/your_board.php?page=1'; ?>">Your Board</a></td>
<td><span class="label label-danger"><?php  if($sum_board != false){
echo $sum_board;
} else{
    echo '0';
} ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/artandcraft/dashboard/my_favourite.php'; ?>">Favourite Photos</a></td>
<td><span class="label label-warning"><?php echo $totFav; ?></span></td>
</tr>

</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->

</div><!-- /.box -->
<!-- =======donut chart===== -->
<div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 292px;">
<div id="allmodule">

<canvas id="myChart" style="width:100%;max-width:600px; height:280px;"></canvas>

<script>
var xValues = ["My Orders", "Cancel Orders", "Return Request", "Your Board", "Favourite Photos"];
var yValues = [<?php echo $totBuyOrdr; ?>, <?php echo $cancel_count; ?>, <?php echo $return_request; ?>, <?php echo $numrows; ?>, <?php echo $totFav; ?>];
var barColors = [
"#b91d47",
"#00aba9",
"#2b5797",
"#e8c3b9",
"#1e7145"
];

new Chart("myChart", {
type: "pie",
data: {
labels: xValues,
datasets: [{
backgroundColor: barColors,
data: yValues
}]
},
options: {
title: {
display: true,

}
}
});
</script>



</div>
</div>
</div>
</div>

<!-- <div class="nav-tabs-custom">
<!-- Tabs within a box 
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="chart-two" style="position: relative; height: 292px;">   

</div>                                        
</div>
</div>-->
<!-- /.nav-tabs-custom -->
</div>

<div class="col-md-6">
<!-- Custom tabs (Charts with tabs)-->
<div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 210px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>

</div>
</div><!-- /.nav-tabs-custom -->

<!-- /.nav-tabs-custom -->


</div>
</div><!-- /.row -->
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo $BaseUrl ?>/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>


<script type="text/javascript">
// Create the chart
Highcharts.chart('jobBoardChart', {
chart: {
type: 'column'
},
title: {
text: 'Buyer Graph'
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
name: 'Art Gallery',
colorByPoint: true,
data: [{
name: "My Orders",
y: <?php echo $totBuyOrdr; ?>
},
{
name: "Cancel Orders",
y: <?php echo $cancel_count; ?>
},

{
name: "Return Request",
y: <?php echo $return_request; ?>
},
{
name: "Your Board",
y: <?php echo $numrows; ?>
},
{
name: "Favourite Photos",
y: <?php echo $totFav; ?>
}
]
}],

});
</script>
<script type="text/javascript">
$(function() {
//Donut Chart
var donut = new Morris.Donut({
element: 'chart-two',
resize: true,
colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
data: [{
label: "My Orders",
value: <?php echo $totBuyOrdr; ?>
},
{
label: "Cancel Orders",
value: <?php echo 0; ?>
},
{
label: "Return Request",
value: <?php echo 0; ?>
},
{
label: "Your Board",
value: <?php echo $board; ?>
},
{
label: "Favourite Photos",
value: <?php echo $totFav; ?>
}

],
hideHover: 'auto'
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
var ctoptions = { // My store pi chart
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
click: function() {
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
name: "My Orders",
y: <?php echo $totBuyOrdr; ?>
}, {
name: "Cancel Orders",
y: <?php echo 0; ?>
}, {
name: "Return Request",
y: <?php echo 0; ?>
}, {
name: "Your Board",
y: <?php echo $board; ?>
}, {
name: "Favourite Photos",
y: <?php echo $totFav; ?>
}]
}]
}
chart = new Highcharts.Chart(ctoptions);
});
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $BaseUrl ?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script>
</body>

</html>
<?php
}
?>