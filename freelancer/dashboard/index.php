<?php 
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 1;

$fps = new _freelance_project_status;
$p = new _postingview;
$po = new _postings;
 
$_GET["categoryid"] = "5";
?>
<style>

span#car1 {
margin-top: 10px;
}

#profileDropDown li.active {
background-color: #c45508!important;
margin-top:-1px;
}
#profileDropDown li.active a {
color: white!important;
}
ul#profileDropDown {
border: none;
}
button#indent {
			padding: 9px;
		}
</style>

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
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
</head>

<body class="bg_gray">
<?php
//session_start();
if(($_SESSION['ptid']==1)||($_SESSION['ptid'])==2){

$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">

<div class="sidebar col-xs-3 col-sm-3" id="sidebar" >

<?php include('left-menu.php');?>
</div>


<div class="col-xs-12 col-sm-9 nopadding">

    <?php if ($_GET['msg'] == "notverified") { ?>

                            <div class="alert alert-danger" role="alert" style="margin-top: 27px;">
                                <h4>It looks like your Business profile is not yet verified. To verify your profile or check the status of your profile, please visit Settings from this link <a href="<?= $BaseUrl; ?>/dashboard/settings/"> Here</a></h4>
                            </div>
                        <?php   } ?>



<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
<a data-toggle="modal" class="pointer pull-right" data-target="#inviteFriend" style="font-weight: 600;font-size: 15px;"><span class="fa fa-user"></span> Invite and Earn </a>
<!-- <li><?php echo $title;?></li> -->

</ul>
</div>
</div>



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




<?php }?>

<?php if($_SESSION["ptname"] == "Bussiness"){ ?>

<div class="col-xs-12 project_list_banner text-center projectbanner">
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
<h1 style="margin-bottom:5px;" ><i class="fa fa-info" aria-hidden="true"></i></h1>
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
<p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
</div>


<!--     <div class="col-xs-12 search-for-project projectsearch ">
<form class="col-xs-12" method="post" action="search.php" >
<div class="form-group">
<input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
<input class="btn search-btn searchborder" value="Search" name="btnSearchProject" type="submit">
</div>
</form>
</div> -->


<div class="col-sm-12 menunbar projectmenu">
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
<!--  <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li> -->

<!-- <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 21)?'red' : '';?>">My Feeds</a></li>
-->
<!-- 
<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">All Freelancer</a></li>

<li class="hidden-xs"><a href="#" class="seprator">|</a></li> -->
<li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 22)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 23)?'red' : '';?>">Payment</a></li>


</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</div>



<?php }?>







<!-- <?php if($_SESSION["ptname"] == "Bussiness"){ ?>
<div class="col-xs-12 nopadding dashboard-section bradius-15 " >
<div class="col-xs-12 dashboardbreadcrum bradius-15 ">
<ul class="breadcrumb bradius-15 " >
<li>Dashboard / Freelancer Dashboard</li>
</ul>
</div>

</div>
<?php }?> -->

<?php if($_SESSION["ptname"] == "Freelancer"){?>
<div class="row m_top_15">
<!--  <div class="col-md-3" style="margin-top: 10px;">
<div class="small-box bg-green green_aqua_radius">
<div class="inner">
<h3>0</h3>
<p>Sp Points</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"></i>
</div>
<a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div> -->
<div class="col-md-3" style="margin-top: 10px;">
<div class="small-box bg-aqua green_aqua_radius">
<div class="inner">
<?php
$fa     = new _freelance_account;
$result3 = $fa->readProBlnc($_SESSION['pid']);
/* print_r($result3);*/
if($result3){
while ($row3 = mysqli_fetch_assoc($result3)) {
# code...
$myBlnc += $row3['fa_current_amount'];
}



}
?>
<h3>$<?php echo isset($myBlnc)?$myBlnc:'0';?></h3>
<p>My Balance</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v" style="margin-top: 6px;"></i>
</div>
<!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a> -->
</div>
</div>

<div class="col-md-3" style="margin-top: 10px;">
<div class="small-box bg-aqua green_aqua_radius">
<div class="inner">
<?php
$fps = new _freelance_project_status;
$res4 = $fps->myAssignProject($_SESSION['pid']);
/* print_r($result3);*/
if($res4){

/*$row4 = mysqli_fetch_assoc($res4)*/

$award = $res4->num_rows;

}
?>
<h3><?php echo isset($award)?$award:'0';?></h3>
<p>Award</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v" style="margin-top: 6px;"></i>
</div>
<!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a> -->
</div>
</div>

<div class="col-md-3" style="margin-top: 10px;">
<div class="small-box bg-aqua green_aqua_radius">
<div class="inner">
<?php
$sf  = new _freelance_chat_project;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res5 = $sf->getfreelancerConversation($_SESSION['pid']);
/* print_r($result3);*/
if($res5){

/*$row4 = mysqli_fetch_assoc($res4)*/

$direct = $res5->num_rows;

}
?>
<h3><?php echo isset($direct)?$direct:'0';?></h3>
<p>Direct</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v" style=" margin-top: 6px;"></i>
</div>
<!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a> -->
</div>
</div>




<div class="col-md-3" style="margin-top: 10px;">
<div class="small-box bg-aqua green_aqua_radius">
<div class="inner">
<?php
$p = new _freelancerposting;
$res6 = $p->freelancer_completed_project($_SESSION['pid']);
$comp = 0;
/* print_r($res6);*/
if($res6){

$posted = $res6->num_rows;

}
$sf  = new _freelance_chat_project;

$res7 = $sf->freelancecompletedproject($_SESSION['pid']);

/*  print_r($res7);*/
if($res7){

$chathire = $res7->num_rows;

}

$comp = $chathire + $posted;



?>
<h3><?php echo isset($comp)?$comp:'0';?></h3>
<p>Completed</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"style="margin-top: 6px;" ></i>
</div>
<!--  <a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a> -->
</div>
</div>






</div>

<?php }?>

<?php if($_SESSION["ptname"] == "Bussiness"){ ?>

<div class="row m_top_15">
<!--  <div class="col-md-3">
<div class="small-box bg-green green_aqua_radius">
<div class="inner">
<h3>0</h3>
<p>Sp Points</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"></i>
</div>
<a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div> -->
<div class="col-md-3" >
<div class="small-box bg-aqua green_aqua_radius">
<div class="inner">
<?php
$fa     = new _freelance_account;
$result3 = $fa->readProBlnc($_SESSION['pid']);

// print_r($result3);
if($result3){
$row3 = mysqli_fetch_assoc($result3);
$myBlnc = $row3['fa_current_amount'];
}
?>
<h3>$<?php echo isset($myBlnc)?$myBlnc:'0';?></h3>
<p>My Balance</p>
</div>
<div class="icon">
<i class="fa fa-ellipsis-v"></i>
</div>
<a href="javascript:void(0)" class="small-box-footer green_aquaboxbuttom">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
<?php }?>
<style>
.btn:hover {
color: #585151!important;
opacity: .8;
}
btn:hover, .btn:focus, .btn.focus {
color:#585151!important;
text-decoration: none;
}


</style>



<div class="row ">
<div class="col-md-5 " >
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Freelancer</h3>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" id="btn1" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div>
</div><!-- /.box-header -->

<div class="box-body">
<div class="table-responsive">
<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}

$p = new _freelancerposting;

// TOTAL ACTIVE PROJECTS
$totalActive = 0; 
$result = $p->myAllProject1(5, $_SESSION['pid']);
//echo $p->ta->sql;
/*print_r($result);*/


$fps = new _freelancerposting; 
$result = $fps->myProfileDraftFreelancer1(5,$_SESSION['pid']);

/* print_r($result3);*/
if($account_status!=1){
if ($result) { 
$totalActive = $result->num_rows;
} 
}


/*    $totActBid = 0;
$result2 = $po->client_publicpost_posting(5, $_SESSION['pid']);
if ($result2) {
$totActBid = $result2->num_rows;
}*/

// =========EXPIRE PROJECTS
$totalExpire = 0;
/*   $result4 = $p->myExpireProduct1(5, $_SESSION['pid']);
//echo $p->ta->sql;
if ($result4) {
$totalExpire = $result4->num_rows;
}*/

$sf  = new _freelancerposting;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$result4 = $sf->myExpireProduct1(5,$_SESSION['pid']);
/* print_r($result3);*/
if($account_status!=1){
if($result4){

/*$row4 = mysqli_fetch_assoc($res4)*/

$totalExpire = $result4->num_rows;

}}

// ==========DRAFT
$totalDraft = 0;
$result3 = $p->myProfileDraftFreelancer1($_GET["categoryid"], $_SESSION['pid']);
//echo $p->ta->sql;
if($account_status!=1){
if ($result3) {
$totalDraft = $result3->num_rows;
}
}
// =========COMPLETE PROJECTS
$totCmpPro = 0;
/*   $res = $p->myCmpPro1(5, $_SESSION['pid']);
if ($res) {
$totCmpPro = $res->num_rows;
}*/



$p = new _freelancerposting;
$res6 = $p->freelancer_completed_project($_SESSION['pid']);
$comp = 0;
/* print_r($res6);*/
if($res6){

$posted = $res6->num_rows;

}
$sf  = new _freelancerposting;

$res7 = $sf->awardedproject($_SESSION['pid']);

 //print_r($res7);

$sf_new  = new _freelance_chat_project;
$res_new = $sf_new->getbussinesConversation($_SESSION['pid']);


if($account_status!=1){
if($res_new){

$chathire = $res_new->num_rows;

}}

if($chathire==""){
$chathire=0;
}

// $totCmpPro = $chathire + $posted;

// ==========FLAGGED PROJECTS
$totFlagPost = 0;
$result5 = $p->flag_post1(5, $_SESSION['pid']);
if ($result5) {
$totFlagPost = $result5->num_rows;
}

// ===========active bids

$sfp = new _freelancerposting;
$res33 = $sfp->client_publicpost1(5, $_SESSION['pid']);
$speed = 0;
if($res33!=false){
while($row = mysqli_fetch_assoc($res33)){
    if($row['spPostingExpDt'] > date('Y-m-d')){

      $speed++;

  }

}
}


//var_dump($res33);

if($account_status!=1){

if($res33 ){
//die('==');

$submProp = mysqli_num_rows($res33);
//echo $submProp;
//die('==');
}}


if($submProp==""){
$submProp=0;
}

?>
<table class="table table-striped no-margin">
<tbody>

<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php'; ?>">Active Projects</a></td>

<td><span class="label label-success"><?php echo $speed; ?></span></td>


</tr>

<!--<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php'; ?>">Draft Projects</a></td>
<td><span class="label label-info"><?php echo $totalActive; ?></span></td>
</tr>
<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php';?>">Active Bids</a></td>
<td><span class="label label-warning"><?php  echo $totActBid; ?></span></td>
</tr> -->
<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/expire.php'; ?>">Closed Projects</a></td>
<td><span class="label label-info"><?php echo $totalExpire; ?></span></td>
</tr>

  <tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php';?>">Draft Projects</a></td>
<td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
</tr> 

<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_hire_project.php'; ?>">Hired Freelancers</a></td>
<td><span class="label label-warning"><?php echo $chathire; ?></span></td>   
</tr>
<!--  <tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/myFlag.php'; ?>">Flagged Projects</a></td>
<td><span class="label label-success"><?php echo $totFlagPost; ?></span></td>
</tr>  -->



</tbody>
</table>
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->

</div><!-- /.box -->
<!-- =======donut chart===== -->
</div>

<div class="col-md-7">
<!-- Custom tabs (Charts with tabs)-->
<div class="nav-tabs-custom ">
<ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
</ul>
<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 177px;">
<div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
</div>
<!-- this is xxtra chart for dummy -->
<div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 292px;">

</div>
</div>
</div><!-- /.nav-tabs-custom -->



<!-- solid sales graph -->

</div>
</div><!-- /.row -->





</div>
</div>
</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
}else{		
?>

<script>
window.location.replace('<?php echo $BaseUrl?>/timeline?msg=alert');
</script>

<?php } ?>



<!-- ========DASHBOARD FOOTER CHARTS====== -->

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
y: <?php echo  $speed;?>
},{
name: "Draft Projects",
y: <?php echo $totalActive;?>
},{
name: "Closed Projects",
y: <?php echo $totalExpire;?>
},/*{
name: "Draft Projects",
y: <?php echo $totalDraft; ?>
},*/ {
name: "Hired Freelancers",
y: <?php echo $chathire;?>
}/*, {
name: "Flagged Projects",
y: <?php echo $totFlagPost;?>
}*/]
}],

});
</script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 






</body>
</html>
<?php
}
?>