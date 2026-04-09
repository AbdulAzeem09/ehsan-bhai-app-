<?php 
 

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="freelancer/";
include_once ("../../authentication/islogin.php");

}else{  
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 11;
 
$fps = new _freelance_project_status;
$p = new _postingview;
$po = new _postings;
//print_r($_SESSION);
//die('==');
$_GET["categoryid"] = "5";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>
<style>
body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}







#profileDropDown li.active {
background-color: #c45508;
margin-top:-1px;
}
#profileDropDown li.active a {
color: #fff;
}
ul#profileDropDown {
border: none;
}
</style>
<body class="bg_gray">
<?php
//session_start();
//$_SESSION['count']='0';

$header_select = "freelancers";
include_once("../../header.php");

?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">

<div class="sidebar col-xs-3 col-sm-3" id="sidebar" >

<?php include('left-menu.php');?>
</div>

<div class="col-xs-12 col-sm-9 nopadding">
<br>


<?php	if($_GET['msg'] == "notverified"){ ?>

<div class="alert alert-danger" role="alert">
<h1> It looks like your Business Profile is not verified or have not submitted your profile for verification . Please contact support .</h1>
</div>
<?php   } ?> 

<?php	if($_GET['msg'] == "notacess"){ ?>

<div class="alert alert-danger" role="alert">
<h1> You can not access this project or this project might not exist.</h1>
</div>

<?php   } ?>

<?php
$fc = new _freelance_chat;
$result_chat = $fc->chekunreadmessage($_SESSION['pid']);
//echo $fc->ta->sql;
if($result_chat){
$totalchat = $result_chat->num_rows;
}
?>



<?php if($_SESSION["ptname"] == "Freelancer"){ ?> 

<!--  <div class="col-xs-12 project_list_banner text-center projectbanner">
<h1 class="heading">Find Freelance Projects</h1>
<?php
$p = new _postingview;
if(isset($_GET['cat']) && $_GET['cat'] >0){
$result = $p->total_post_freelancer($_GET['cat']);
}else{
$result = $p->publicpost(isset($start), 5);
}

if($result){
$count = $result->num_rows;
}else{
$count = '0';
}
$f = new _spprofiles;
if($_SESSION['ptid'] == 1){ 
$u = new _spuser;
// IS EMAIL IS VERIFIED
$p_result = $u->isverify($_SESSION['uid']);
if ($p_result == 1) {
?>
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn btn_freelancer postproject">Post a project - It’s Free</a>
<?php
}
}else{ ?>

<div id="Notabussiness" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content no-radius sharestorepos bradius-10">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body nobusinessProfile">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
<a href="javascript:void(0)" class="btn btn_freelancer postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
}



?>

<a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="btn btn_freelancer postproject">Find Freelancer</a>
<p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
</div>

-->

<div class="col-sm-12 menunbar projectmenu" style="margin-top: 25px;">
<nav class="navbar navbar_free">
<div class="container-fluid nopadding">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse no-padding header_po projecttoggle" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li>


<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 21)?'red' : '';?>">Find Project </a></li>


<!--       <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">All Freelancer</a></li> -->

<!--       <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li ><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 22)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>


<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 23)?'red' : '';?>">Payment</a></li>-->


</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</div>

<div class="col-xs-12 search-for-project projectsearch " style="margin-top: 0px!important;">
<form class="col-xs-12" method="post" action="search.php" >
<div class="form-group">
<input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
<input class="btn search-btn searchborder" value="Search" name="btnSearchProject" type="submit">
</div>
</form>

</div>

<?php }?>

<?php if($_SESSION["ptname"] == "Bussiness"){ ?>

<div class="col-xs-12 project_list_banner text-center projectbanner">
<h1 class="heading" style="color:yellow;">Find And Hire Freelancers From Across The World</h1>
<?php
$p = new _postingview;
if(isset($_GET['cat']) && $_GET['cat'] >0){
$result = $p->total_post_freelancer($_GET['cat']);
}else{
$result = $p->publicpost(isset($start), 5);
}

if($result){
$count = $result->num_rows;
}else{
$count = '0';
}
$f = new _spprofiles;
if($_SESSION['ptid'] == 1){ 
$u = new _spuser;
// IS EMAIL IS VERIFIED
$p_result = $u->isverify($_SESSION['uid']);
if ($p_result == 1) {
?>
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn btn_freelancer postproject">Post a project - It’s Free</a>
<?php
}
}else{ ?>

<div id="Notabussiness" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content no-radius sharestorepos bradius-10">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body nobusinessProfile">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
<a href="javascript:void(0)" class="btn btn_freelancer postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
}

?>

<a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>" class="btn btn_freelancer postproject">Find Freelancer</a>
<!--<p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>-->
</div>


<!--     <div class="col-xs-12 search-for-project projectsearch ">
<form class="col-xs-12" method="post" action="search.php" >
<div class="form-group">
<input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
<input class="btn search-btn searchborder" value="Search" name="btnSearchProject" type="submit">
</div>
</form>
</div> -->


<!--     <div class="col-md-12 menunbar projectmenu">
<nav class="navbar navbar_free">
<div class="container-fluid nopadding">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

<div class="collapse navbar-collapse no-padding header_po projecttoggle" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li>

<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 21)?'red' : '';?>">My Feeds</a></li>


<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">All Freelancer</a></li>

<li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
<li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 22)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 23)?'red' : '';?>">Payment</a></li>


</ul>
</div> 
</div>
</nav>
</div>
-->
<div class="col-sm-12 menunbar projectmenu" style="border: unset;
background-color: unset;">
</div>

<?php }?>


<style>
#example1_length{
margin-top: 4px;
margin-bottom: 10px;
margin-left: 6px;

}
#example1_info{
margin-left: 6px;

}
.current{
margin-bottom: 5px;
}
#example1_filter{
margin-right: 7px;
margin-top: 4px;
}
.dashboardpage .dashboard-section .dashboardbreadcrum li .open_b{color:#000!important;}

</style>












<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li>Dashboard / Poster Dashboard</li>
</ul>
</div>
</div> -->
<div class="row m_top_15">


</div>
<?php if(isset($_GET["chart"])) { ?>
<div class="row">

<div class="col-md-5">
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info ">
<div class="box-header with-border">
<h3 class="box-title">Freelancer</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div><!-- /.box-header -->
<div class="box-body">
<div class="table-responsive" style="margin-top:6px;" >
<?php
$p = new _freelancerposting;

// TOTAL ACTIVE PROJECTS
$totalActive = 0; 
$result = $p->myAllProject1(5, $_SESSION['pid']);
//echo $p->ta->sql;
/*print_r($result);*/
if ($result) {
$totalActive = $result->num_rows;
}

$totalExpire = 0;
$result4 = $p->myExpireProduct1(5, $_SESSION['pid']);
//echo $p->ta->sql;
if ($result4) {
$totalExpire = $result4->num_rows;
}

// ==========DRAFT
$totalDraft = 0;
$result3 = $p->myProfileDraftFreelancer1($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result3) {
$totalDraft = $result3->num_rows;
}

// =========COMPLETE PROJECTS
$totCmpPro = 0;
$res = $p->myCmpleteincompletePro1(5, $_SESSION['pid']);
if ($res) {
$totCmpPro = $res->num_rows;
}

// ==========FLAGGED PROJECTS
$totFlagPost = 0;
$result5 = $p->flag_post1(5, $_SESSION['pid']);
if ($result5) {
$totFlagPost = $result5->num_rows;
}

// ===========active bids

?>
 

<table class="table table-striped no-margin" id="example1">
<tbody>

<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active.php'; ?>">Active Projects</a></td>
<td><span class="label label-info"><?php echo $totalActive; ?></span></td>
</tr>
<!--     <tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php';?>">Active Bids</a></td>
<td><span class="label label-warning"><?php  echo $totActBid; ?></span></td>
</tr> -->
<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/expire.php'; ?>">Expired Projects</a></td>
<td><span class="label label-info"><?php echo $totalExpire; ?></span></td>
</tr>

<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php';?>">Draft Projects</a></td>
<td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/complete.php'; ?>">Complete Projects</a></td>
<td><span class="label label-danger"><?php echo $totCmpPro; ?></span></td>
</tr>
<!-- 	<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/myFlag.php'; ?>">Flagged Projects</a></td>
<td><span class="label label-success"><?php echo $totFlagPost; ?></span></td>
</tr> 
-->

</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->

</div><!-- /.box -->
<!-- =======donut chart===== -->
<!-- 	<div class="nav-tabs-custom ">

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
<div class="nav-tabs-custom ">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 248px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>
<!-- this is xxtra chart for dummy -->
<div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 292px;">

</div>
</div>
</div><!-- /.nav-tabs-custom -->

<!-- 	<div class="nav-tabs-custom ">
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
</div><!-- /.row -->
<?php } ?>

<div class="col-sm-12 nopadding dashboard-section">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
<li><a class="open_b" href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">OPEN PROJECTS</a></li>
<a href="<?php echo $BaseUrl ?>/freelancer/" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Home</a>
</ul>
</div>
</div>

<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
<li>Active Projects</li>

</ul>
</div>
</div> -->

<style>
.dashboardpage .dashboard-section .dashboardtable .table tbody tr td {
color: #282828;
font-size: 18px;
font-family: MarksimonRegular;
padding: 21px 8px 24px 13px;
}
</style>
<?php  $sf  = new _freelancerposting;

// print_r($_SESSION['pid']);

// $res = $p->client_publicpost(5, $_SESSION['pid']);

$res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);
// var_dump($res);die('=========================');
if($res!=false){
$table= $res->num_rows;

if($table!=""){
$example="example1";
}
else{
$example="example1";
}
}


?>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

<div class="col-xs-12 dashboardtable">

<?php if($res!=false){
$example ="example";
}else{
$example =" ";
}
	?>
<div class="container-fluid" style="margin-top:10px;" >
<!-- 
<table class="table text-center tbl_activebid1 display" id="</?php echo $example;?>"> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id="<?php echo $example;?>" >
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<!-- <th style="color:#fff;"></th> -->
<th></th>
<th style="color:#fff;">ID</th> 
<th style="color:#fff;">Project Name</th>
<th style="color:#fff;">Total Bids</th>
<th style="color:#fff;">Bid Price </th>
<th style="color:#fff;">Expire Date</th>

<!-- <th style="color:#fff;">Created Date</th> -->
<th class="action" style="color:#fff;">Action</th>
</tr>
</thead>
<tbody>
<?php
$p = new _freelancerposting;

// TOTAL ACTIVE PROJECTS
$totalActive = 0; 
$result = $p->myAllProject1(5, $_SESSION['pid']);
//echo $p->ta->sql;
/*print_r($result);*/
if ($result) {
$totalActive = $result->num_rows;
}

$totalExpire = 0;
$result4 = $p->myExpireProduct1(5, $_SESSION['pid']);
//echo $p->ta->sql;
if ($result4) {
$totalExpire = $result4->num_rows;
}

// ==========DRAFT
$totalDraft = 0;
$result3 = $p->myProfileDraftFreelancer1($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if ($result3) {
$totalDraft = $result3->num_rows;
}

// =========COMPLETE PROJECTS
$totCmpPro = 0;
$res = $p->myCmpleteincompletePro1(5, $_SESSION['pid']);
if ($res) {
$totCmpPro = $res->num_rows;
}

// ==========FLAGGED PROJECTS
$totFlagPost = 0;
$result5 = $p->flag_post1(5, $_SESSION['pid']);
if ($result5) {
$totFlagPost = $result5->num_rows;
}

// ===========active bids

?>
<?php
// $p = new _postings;

$sf  = new _freelancerposting;

// print_r($_SESSION['pid']);

// $res = $p->client_publicpost(5, $_SESSION['pid']);

$res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);

// echo $sf->ta->sql; die('======');

$i = 1;
if($res){
while($row = mysqli_fetch_assoc($res)){
$dt = new DateTime($row['spPostingExpDt']);

$cr = new DateTime($row['spPostingDate']);
$sfbid = new  _freelance_placebid;
$bids = $sfbid->totalbids1($row['idspPostings']);
if($bids){
$totalbids = $bids->num_rows;
}else{
$totalbids = 0;
}
?>

<tr>
<!-- Modal -->
<div id="myproject-<?php echo $row['idspPostings'];?>" class="modal fade" role="dialog">
<div class="modal-dialog sharestorepos" >
<!-- Modal content-->
<form method="post" action="addmilestone.php">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $row['spPostingTitle'];?></h4>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
<input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $row['spProfiles_idspProfiles']; ?>">
<input type="hidden" name="milestoneStatus" value="0" >
<input type="hidden" name="milestoneSubmitDate" value="<?php echo date('Y-m-d'); ?>">
<div class="row add_form_body">
<div class="col-md-6">
<div class="form-group">
<label for="Amount">Amount</label>
<input type="text" class="form-control" name="milestonePrice" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="Deliver Day">Deliver Day</label>
<input type="date" class="form-control" name="milestoneDeliverDay" >
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label for="Description">Description</label>
<textarea name="milestoneDescription" class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary"  >Save</button>
</div>
</div>
</form>
</div>
</div>

<!-- <td><?php //echo $row['idspPostings']; ?></td>
 -->

 <td><?php echo $row['idspPostings']; ?></td>
<td width="20%"> <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="red freelancer_capitalize" id="dash<?php echo $row['idspPostings']; ?>" ><?php echo $row['spPostingTitle'];?></a> 

<!--<a href="javascript:void(0)" class="red freelancer_capitalize"  ><?php //echo $row['spPostingTitle'];?></a>-->

</td>

<td width="5%"><?php echo $totalbids;?></td>
<td><?php echo $row['Default_Currency'].' '.$row['spPostingPrice'];?></td>
<td><?php echo $dt->format('M d, Y'); ?></td>
<!-- <td></?php echo $cr->format('M d, Y'); ?></td> -->

<td>
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'];?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top"> <i class="fa fa-eye" aria-hidden="true"></i>

 </a>
 
<a onclick="deletedata('<?php echo $BaseUrl.'/freelancer/dashboard/deleteposter.php?postid='.$row['idspPostings']; ?>')"><i title="Delete" class="fa fa-trash" ></i></a>




<!-- 
<?php  if($row['spPostingVisibility'] != -1) { ?>
<a onclick="deactivate(<?php echo $row['idspPostings'];?>)" data-original-title="De-active" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" id="deact<?php echo $row['idspPostings']; ?>" ><i class="fa fa-lock" aria-hidden="true" style="color:white;" <?php
 if($row['spPostingVisibility'] == -2) { 
   echo 'disabled';
}


 ?>  ></i>

 



</a>
<?php } else { ?>
<a onclick="activate(<?php echo $row['idspPostings'];?>)" data-original-title="Activate" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" id="act<?php echo $row['idspPostings']; ?>" ><i class="fa fa-unlock-alt" aria-hidden="true" style="color:white;" <?php
 if($row['spPostingVisibility'] == -1) { 
   echo 'disabled';
  
}
 
?> 
></i>

</a>
<?php } ?> -->
<span id="deact1<?php echo $row['idspPostings']; ?>">
<?php if($row['spPostingVisibility'] == -1) {   ?>
<a onclick="actheartunlock('<?php echo $row['idspPostings']; ?>')" id="act<?php echo $row['idspPostings']; ?>"  data-original-title="De-active" data-toggle="tooltip"><i class="fa fa-unlock" style="color:#23709e !important;"></i></a>

<?php  } else {  ?>
<a onclick="actheartlock1('<?php echo $row['idspPostings']; ?>')" id="deact<?php echo $row['idspPostings']; ?>"  data-original-title="activate" data-toggle="tooltip"><i class="fa fa-lock" style="color:#23709e !important;"></i></a>
<?php  } ?>
</span>
<!-- <a href="<?php //echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red" >View Detail</a> -->




</td>









</tr> 
<?php
$i++;
}
}else{
echo "<td colspan='8'>No Record Found</td>";
}

?>


</tbody>
</table>


<!--		Start Pagination -->
<div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>

</div> <!-- 		End of Container -->


</div>
</div>



</div>
</div>
</section>



<?php

include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 


?>


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
<script>
function deletedata(a){
//alert(a);
Swal.fire({
title: 'Are you sure you  want to delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>


<!-- ========DASHBOARD FOOTER CHARTS====== -->

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
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

<!-- 
<script type="text/javascript">
// Create the chart
Highcharts.chart('jobBoardChart', {
chart: {
type: 'column'
},
title: {
text: ' Graph'
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
data: [
{
name: "Active Projects",
y: <?php echo $totalActive;?>
},
{
name: "Expired Projects",
y: <?php echo $totalExpire;?>
},
{
name: "Draft Projects",
y: <?php echo $totalDraft; ?>
}, 
{
name: "Complete Projects",
y: <?php echo $totCmpPro;?>
}
 /*{
name: "Flagged Projects",
y: <?php //echo $totFlagPost;?>
}*/
]
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
{ label: "Active Projects", value: <?php echo $totalActive; ?> },
{ label: "Expired Projects", value: <?php echo $totalExpire; ?> },
{ label: "Draft Projects", value: <?php echo $totalDraft; ?> },
{ label: "Complete Projects", value: <?php echo $totCmpPro; ?> }
/*  {label: "Flagged Projects", value: <?php echo $totFlagPost;?>}*/
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
data: [
{
name: "Active Projects",
y: <?php echo $totalActive;?>
},
{
name: "Expired Projects",
y: <?php echo $totalExpire;?>
},
{
name: "Draft Projects",
y: <?php echo $totalDraft; ?>
}, 
{
name: "Complete Projects",
y: <?php echo $totCmpPro;?>
}, 
{
name: "Flagged Projects",
y: <?php echo $totFlagPost;?>
}
]                     
}]
}
chart = new Highcharts.Chart(ctoptions);
});
</script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 
</body>
</html>
<?php
} ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

                          <script>
                            var table = $('#example1').DataTable({ 
                             select: false,
                             "columnDefs": [{
                              className: "Name", 
                              "targets":[0],
                              "visible": false,
                              "searchable":false
                            }]
                          });
                        </script>	

<script>

var table = $('<?php echo $example;  ?>').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false,
order:[
       [1, "desc"]
     ]
}]
});
</script>	

<!-- 
<script>
var table = $('#example1').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false,
}]
});
</script>	 --> 

<script>

// var table = $('#example1_1').DataTable({ 
// select: false,
// "columnDefs": [{
// className: "Name", 
// "targets":[0],
// "visible": false,
// "searchable":false
// }]
// });

function deactivate(visible){
//alert(visible);

$.ajax({
type: "POST",
url: "deactive.php",
cache:false,
data: {'visible':visible},

success: function(data) {
$("#deact"+visible).addClass("disabled");
$("#act"+visible).removeClass("disabled");

}
});

}

function activate(visible){
//alert(visible);

$.ajax({
type: "POST",
url: "activate.php",
cache:false,
data: {'visible':visible},

success: function(data) {
//$("#dash"+visible).attr("disabled");
$("#act"+visible).addClass("disabled");
$("#deact"+visible).removeClass("disabled");

}
});

}






function actheartunlock(id){
  
$.ajax({
type: "POST",
url: "actheart.php",
cache:false,
data: {'visible':id},

success: function(data) {



  $("#deact1"+id+"").html('<a onclick="actheartlock1('+id+')" ><i class="fa fa-lock" ></i></a>');
  

}
});

}

function actheartlock1(id){
  
  $.ajax({
  type: "POST",
  url: "actheart.php",
  cache:false,
  data: {'visible':id},
  
  success: function(data) {
 
 $("#deact1"+id+"").html('<a onclick="actheartunlock('+id+')" ><i class="fa fa-unlock" ></i></a>');
  
  }
  });
  
  }
</script>	






<script>

getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>

