<?php
require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "5";
$pageactive = 6;
// background color
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>

<!-- custom page script -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="http://api.highcharts.com/highcharts">


</head>
<body class="bg_gray">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php include('../../component/left-dashboard.php'); ?>

</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Freelance Module Dashboard</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Freelance</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-md-5">
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Freelance</h3>
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
// total Products
$totalProducts = 0; 
$result = $p->mycatProduct($_GET['categoryid'], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$totalProducts = $result->num_rows;
}else{
$totalProducts = 0;
}
// =========ACTIVE POST
$totalActive = 0;
$result4 = $p->profileactivepost($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result4) {
$totalActive = $result4->num_rows;
}
// =========IN-ACTIVE POST
$totInActive = $totalProducts - $totalActive;
// ==========DRAFT
$totalDraft = 0;
$result3 = $p->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result3) {
$totalDraft = $result3->num_rows;
}else{
$totalDraft = 0;
}
// =========FAVOURITE POST
$totFav = 0;
$result5 = $p->myfavourite_music($_SESSION['pid'], $_GET['categoryid']);
//echo $p->ta->sql;
if ($result5) {
$totFav = $result5->num_rows;
}

// =========ACTIVE BIDS
$totalbids = 0;
$result2 = $po->client_publicpost($_GET['categoryid'], $_SESSION['pid']);
if ($result2) {
$totalbids = $result2->num_rows;
}


                                            
?>
<table class="table table-striped no-margin">
<tbody>
   
    <tr>
	
	<?php 
			$sf  = new _freelancerposting; 

// print_r($_SESSION['pid']);

 $res = $sf->client_publicpost1(5, $_SESSION['pid']); 

//$res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);

//echo $sf->ta->sql;
?>

<?php
$i = 1;
if($res){
$totalActive = $res->num_rows;
while($row = mysqli_fetch_assoc($res)){
$dt = new DateTime($row['spPostingExpDt']);

$cr = new DateTime($row['spPostingDate']);
	//$totalActive = $row->num_rows;
//   echo "<pre>";
// print_r($row);

// $pf = new _postfield;
//$result_pf = $pf->totalbids($row['idspPostings']);

$sfbid = new  _freelance_placebid;

// $respos = $pos->totalbids($_GET['project']);

//$respos = $sfbid->totalbids1($_GET['project']);
// $bids = $po->totalbids($_GET['project']);


}
}
	
	?>
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php'; ?>">Active Projects</a></td>
        <td><span class="label" style="background-color: rgb(229 124 74);"><?php echo $totalActive; ?></span></td>
    </tr>
    
    <tr>
	<?php     $sf  = new _freelancerposting;

$res = $sf->myProfileDraftFreelancer1(5, $_SESSION['pid']);
// echo $pv->ta->sql;

//echo $sf->ta->sql;
$i = 1;
if($res){
$totalDraft = $res->num_rows;
while($row = mysqli_fetch_assoc($res)){
$dt = new DateTime($row['spPostingExpDt']);

// print_r($row);
}}
?>
	
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php'; ?>">Draft Projects</a></td>
        <td><span class="label" style="background-color: rgb(144, 237, 125);"><?php echo $totalDraft; ?></span></td>
    </tr>
	
	 <tr>
	 
	 <?php 
	
$sf  = new _freelancerposting;

$res = $sf->myCmpleteincompletePro1(5, $_SESSION['pid']);

if($res){
$totInActive = $res->num_rows;
while($row = mysqli_fetch_assoc($res)){


$dt = new DateTime($row['spPostingExpDt']);

}}
?>
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/complete.php';?>">Completed Projects</a></td>
        <td><span class="label" style="background-color: rgb(67, 67, 72);"><?php echo $totInActive; ?></span></td>
    </tr>
    <tr>
	<?php 

	
	 $sf  = new _freelancerposting;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res1 = $sf->myExpireProduct1(5, $_SESSION['pid']);

//echo $sf->ta->sql;
//print_r($res);
if($res1){
$totFav = $res1->num_rows;
while($row = mysqli_fetch_assoc($res1)){

$dt = new DateTime($row['spPostingExpDt']);
}}  ?>
	
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/expire.php';?>">Closed Projects</a></td>
        <td><span class="label" style="background-color: rgb(253, 236, 109);"><?php echo $totFav; ?></span></td>
    </tr>
    <tr>
	<?php 
	
	  $sf  = new _freelance_chat_project;

$res = $sf->getbussinesConversation($_SESSION['pid']);

if($res){ 
$totalbids = $res->num_rows;
}
	
	?>
	
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_hire_project.php';?>">Awarded Freelancers</a></td>
        <td><span class="label" style="background-color: rgb(153, 158, 255);"><?php  echo $totalbids; ?></span></td>
    </tr>       
   <tr>
   
	<?php 
	
	 $f = new _spprofiles;
	
		
		 

//$result = $f->freelancers($_SESSION['uid']);

$result = $f->get_all_category_freelancers($_SESSION['uid']);

$find = 0;
if($result){
$find= $result->num_rows;
}
	
	?>
	
        <td><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>">Find Freelancer</a></td>
        <td><span class="label" style="background-color: rgb(255, 117, 153);"><?php  echo $find; ?></span></td>
    </tr>     

<tr>
	<?php 
	
	 $fps = new _freelance_project_status;
	 
	 $uid=$_SESSION['uid']; 
$pid=$_SESSION['pid'];

$fr=new _spprofiles;



$freeid= $fps->readid($uid,$pid);
$no = 0;
//print_r($freeid);die;
if(!empty($freeid)){
while($frid=mysqli_fetch_assoc($freeid)){

// print_r($frid);die;

$freename= $frid['freelancer_id'];
$frname=$fr->read($freename);
$no +=  $frname->num_rows;
if($frname){
$frnm=mysqli_fetch_assoc($frname);
// $man += $frnm->num_rows;

//echo $man;
//print_r($frnm);die;
}
} //echo $no;
}
	?>
	
        <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/favourite_freelancer.php';?>">Favourite Freelancer</a></td>
        <td><span class="label" style="background-color: rgb(253, 236, 109);"><?php  echo $no; ?></span></td>
    </tr>       															
                                                               
</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->
<div class="box-footer clearfix">
<a href="<?php echo $BaseUrl.'/freelancer/dashboard/poster_dashboard.php';?>" class="btn btn-sm btn-info btn-flat pull-left btn-border-radius">View Module Dashboard</a>
<a href="<?php echo $BaseUrl.'/freelancer/';?>" class="btn btn-sm btn-primary btn-flat pull-right btn-border-radius">View Module</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->
</div>

<div class="col-md-7">
<!-- Custom tabs (Charts with tabs)-->
<div class="nav-tabs-custom">
<!-- Tabs within a box -->
<ul class="nav nav-tabs pull-right">
<li class="active"><a href="#bar-chart" data-toggle="tab">Bar Chart</a></li>
<!-- <li class=""><a href="#chart-two" data-toggle="tab">Donut Chart</a></li>
<li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>-->
<li class="pull-left header"><i class="fa fa-pie-chart"></i> Charts</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 292px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>
<!-- this is xxtra chart for dummy -->
<div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 292px;">


</div>
<div class="chart tab-pane" id="chart-two" style="position: relative; height: 292px;">


</div>
<div class="chart tab-pane" id="pie-chart" style="position: relative; height: 292px;">
<div id="allmodule"></div>

</div>
</div>
</div><!-- /.nav-tabs-custom -->




<!-- solid sales graph -->
<!--<div class="box box-solid bg-teal-gradient">
<div class="box-header">
<i class="fa fa-th"></i>
<h3 class="box-title">Sales Graph</h3>
<div class="box-tools pull-right">
<button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div>
<div class="box-body border-radius-none">
<div class="chart" id="line-chart" style="height: 250px;"></div>
</div><!-- /.box-body -->
<!--<div class="box-footer no-border">
<div class="row">
<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
<div class="knob-label">Mail-Orders</div>
</div><!-- ./col -->
<!--  <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
<input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
<div class="knob-label">Online</div>
</div><!-- ./col -->
<!--  <div class="col-xs-4 text-center">
<input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
<div class="knob-label">In-Store</div>
</div><!-- ./col -->
<!--  </div><!-- /.row -->
<!--  </div><!-- /.box-footer -->
<!--  </div><!-- /.box -->
<!--  </div>-->



</div><!-- /.row -->
</div>
</div>
</div>
</div>
</div>
</section>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

<script src="http://code.highcharts.com/highcharts.js"></script>
<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>




<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
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
text: 'Graph'
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
name: 'Freelance',
colorByPoint: true,
data: [{
name: "Active Projects",
y: <?php echo $totalActive;?>
},{
name: "Completed Projects",
y: <?php echo $totInActive; ?>
},{
name: "Draft Projects",
y: <?php echo $totalDraft; ?>
}, {
name: "Closed Projects",
y: <?php echo $totFav;?>
}, {
name: "Awarded Freelancers",
y: <?php echo $totalbids;?>
},{
name: "Find Freelancer",
y: <?php echo $find;?>
},{
name: "Favourite Freelancer",
y: <?php echo $no;?>
}]
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
{label: "Total Projects", value: <?php echo $totalProducts;?>},
{label: "Active Projects", value: <?php echo $totalActive;?>},
{label: "Past Projects", value: <?php echo $totInActive; ?>},
{label: "Draft Projects", value: <?php echo $totalDraft; ?>},
{label: "Active Bids", value: <?php echo $totalbids;?>},
{label: "Favourite Projects", value: <?php echo $totFav;?>}
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
name: "Total Projects",
y: <?php echo $totalProducts;?>
},{
name: "Active Projects",
y: <?php echo $totalActive;?>
},{
name: "Past Projects",
y: <?php echo $totInActive; ?>
},{
name: "Draft Projects",
y: <?php echo $totalDraft; ?>
}, {
name: "Active Bids",
y: <?php echo $totalbids;?>
}, {
name: "Favourite Projects",
y: <?php echo $totFav;?>
}]                        
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
} ?>