<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../../univ/baseurl.php');
session_start();
if ($_SESSION['guet_yes'] == 'yes') {

header("Location:$BaseUrl/real-estate/");
}


if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "real-estate/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET['categoryid'] = $_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";
$activePage = 10;

if ($_SESSION['ptid'] == 6) {
?>
<script>
window.location.replace('<?php echo $BaseUrl ?>/my-profile/?msg=mass');
</script>
<?php } ?>
<style>
.btn {
border-radius: 0px !important;
-webkit-box-shadow: none;
box-shadow: none;
border: 1px solid transparent;
}

#car1 {
margin-top: 11px;
}

ul#profileDropDown {
border: none;
}

#profileDropDown li.active {
background-color: #95ba3d !important;
}

#profileDropDown li.active a {
color: #fff !important;
}

@media(max-width:480px)
{
.box.box-info {
margin-top:30px!important;
}
}

.box.box-info {
border-top-color: #fff !important;
}

button#indent {
padding: 9px;
}
</style>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php include_once("../../header.php"); ?>
<section class="realTopBread">
<div class="container">
<div class="row">
<div class="col-md-6" style="margin-top: 15px;
margin-bottom: -35px;">

<div class="text-left agentbreadCrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a style="font-size: 14px;color:white!important;" href="<?php echo $BaseUrl . '/real-estate'; ?>">REAL ESTATE</a></li>
<li style="font-size: 14px;" class="breadcrumb-item active">DASHBOARD</li>
</ol>

</div>
</div>
<div class="col-md-6">
<div class="realTopBread-inner-right">
<?php include_once("../top-buttons.php"); ?>

</div>
</div>
</div>

</div>
</section>

<?php if ($_GET['msg'] == "notverified") { ?>

<div class="alert alert-danger" role="alert">
<h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
</div>
<?php   } ?>


<?php if ($_GET['msg'] == "notaceess") { ?>
<div class=" alert-danger" role="alert" style="padding:20px;">
<h2>You can not access this Page or this Page not might exist.</h2>
</div>
<?php   } ?>
<section class="" style="padding: 30px;">
<div class="container">

<div class="row m_top_15">
<div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-5">
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Real Estate</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div><!-- /.box-header -->
<div class="box-body">
<div class="table-responsive">
<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$p = new _realstateposting;
$po = new _postings;
$en = new _postenquiry;
// total Products
$totalProducts = 0;
$result = $p->mycatProduct($_GET['categoryid'], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$totalProducts = $result->num_rows;
} else {
$totalProducts = 0;
}
// =========ACTIVE POST
$totalActive = 0;
$type = "Sell";
$result4 = $p->myAllSellReal($_GET['categoryid'], $_SESSION['pid'], $type);
//$result4 = $p->profileactivepost($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($account_status != 1) {
if ($result4) {
$totalActive = $result4->num_rows;
}
}
// =========IN-ACTIVE POST
$totInActive = $totalProducts - $totalActive;
// ==========DRAFT
$totalDraft = 0;
$result3 = $p->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($account_status != 1) {
if ($result3) {
$totalDraft = $result3->num_rows;
}
} else {
$totalDraft = 0;
}
// =========FAVOURITE POST
$totFav = 0;
$result5 = $p->event_favorite($_GET["categoryid"], $_SESSION['pid'],$data1);

//echo $p->ta->sql;
if ($account_status != 1) {
if ($result5) {
$totFav = $result5->num_rows;
}
}

// =========RENT ENTIRE PLACE
$rent_entire_place = 0;
$type = "Rent";
$defaultType = "Rent Entire Place";
$result6 = $p->myAllRentEntire($_GET['categoryID'], $_SESSION['pid'], $type, $defaultType);
if ($account_status != 1) {
if ($result6) {
$rent_entire_place = $result6->num_rows;
}
}

// ========RENT A ROOM
$rentaroom = 0;
$fieldName = 'Rent A Room';
$result7 = $p->myRentRooms($_GET["categoryid"], $_SESSION['pid'], $fieldName);
// echo $result7;
if ($account_status != 1) {
if ($result7) {

$rentaroom = $result7->num_rows;
}
}
// ==========MY ENQUIRY
$myEnquiry = 0;
$p = new _realstateenquiry;

$result2 = $p->myEnquery($_GET['categoryID'], $_SESSION['pid']);
if ($account_status != 1) {
if ($result2) {
$myEnquiry = $result2->num_rows;
}
}
// ==========MY FLAG
$myFlag = 0;
$p = new _realstateposting;
$result8 = $p->myflagPostaaaa($_GET['categoryID'], $_SESSION['pid']);
if ($account_status != 1) {
if ($result8 != false) {
$myFlag = $result8->num_rows;
}
}

$p = new _realstateposting;

$type = "Sell";
$i = 1;
$result2 = $p->myAllSellActiveProperty_1($_SESSION['pid'], $type);
$all_active = $result2->num_rows;

?>
<table class="table table-striped no-margin">
<tbody>

<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/active-property.php'; ?>">All Property </a></td>
<td><span class="label label-info"><?php echo $all_active; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/rent-property.php'; ?>">Rent Entire Place</a></td>
<td><span class="label label-warning"><?php echo $rent_entire_place; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/rent-room.php'; ?>">Rent Room</a></td>
<td><span class="label label-primary"><?php echo $rentaroom; ?></span></td>
</tr>

<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/draft-property.php'; ?>">Draft Property</a></td>
<td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/my-enquiry.php'; ?>">My Enquiries</a></td>
<td><span class="label label-success"><?php echo $myEnquiry; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/favourite.php'; ?>">Favourite Listing</a></td>
<td><span class="label label-info"><?php echo $totFav; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl . '/real-estate/dashboard/myFlag.php'; ?>">Flagged Property</a></td>
<td><span class="label label-warning"><?php echo $myFlag; ?></span></td>
</tr>


</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->

</div><!-- /.box -->
<!-- =======donut chart===== -->
<!--     <div class="nav-tabs-custom">

<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="chart-two" style="position: relative; height: 287px;">   

</div>                                        
</div>
</div> -->
<!-- /.nav-tabs-custom -->
</div>

<div class="col-md-7">
<!-- Custom tabs (Charts with tabs)-->
<div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 287px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>
<!-- this is xxtra chart for dummy -->
<div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 287px;">

</div>
</div>
</div><!-- /.nav-tabs-custom -->

<!--       <div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
</ul>
<div class="tab-content no-padding">
<div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 287px;">   
<div id="allmodule"></div>
</div>                                        
</div>
</div> -->
<!-- /.nav-tabs-custom -->


</div>
</div>
</div>


</div><!-- /.row -->




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
text: 'Real Estate Graph'
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
name: 'Real Estate',
colorByPoint: true,
data: [{
name: "Active Property",
y: <?php echo $all_active; ?>
}, {
name: "Rent Entire Place",
y: <?php echo $rent_entire_place; ?>
}, {
name: "Rent Room",
y: <?php echo $rentaroom; ?>
}, {
name: "Draft Property",
y: <?php echo $totalDraft; ?>
}, {
name: "My Enquires",
y: <?php echo $myEnquiry; ?>
}, {
name: "Favourite Listing",
y: <?php echo $totFav; ?>
}, {
name: "Flagged Property",
y: <?php echo $myFlag; ?>
}]
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
label: "Active Property",
value: <?php echo $all_active; ?>
},
{
label: "Rent Entire Place",
value: <?php echo $rent_entire_place; ?>
},
{
label: "Rent Room",
value: <?php echo $rentaroom; ?>
},
{
label: "Draft Property",
value: <?php echo $totalDraft; ?>
},
{
label: "My Enquires",
value: <?php echo $myEnquiry; ?>
},
{
label: "Favourite Listing",
value: <?php echo $totFav; ?>
},
{
label: "Flagged Property",
value: <?php echo $myFlag; ?>
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
name: "Active Property",
y: <?php echo $all_active; ?>
}, {
name: "Rent Entire Place",
y: <?php echo $rent_entire_place; ?>
}, {
name: "Rent Room",
y: <?php echo $rentaroom; ?>
}, {
name: "Draft Property",
y: <?php echo $totalDraft; ?>
}, {
name: "My Enquires",
y: <?php echo $myEnquiry; ?>
}, {
name: "Favourite Listing",
y: <?php echo $totFav; ?>
}, {
name: "Flagged Property",
y: <?php echo $myFlag; ?>
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