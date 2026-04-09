<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
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
$activePage = 33;
?> 
<!DOCTYPE html>
<html lang="en-US">
 
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

</head>
<style>
#profileDropDown li.active {
background-color: #c45508;
}
#profileDropDown li.active a {
color: white;
}
</style>
<body class="bg_gray">
<?php
$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">               
<div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
<?php include('left-menu.php');?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">
<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
<li>SUCCESSFUL WORK</li>

<!-- <li><?php echo $title;?></li> -->

</ul>
</div>
</div>
<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard" style="margin-top: 10px;">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
<li>SUCCESSFUL WORK</li>

</ul>
</div>
</div> -->
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 15px;">

<div class="col-xs-12 dashboardtable">

<div class="table-responsive">

<table class="table table-striped tbl_store_setting" id="example1">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Title</th>
<th style="color:#fff;">Date </th>
<th style="color:#fff;">Description </th>

<th style="color:#fff;">Amount</th>
<th style="color:#fff;">Status</th>

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
//  $p = new _postingview;
$i = 1;
$sf  = new _milestone;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res = $sf->allpaymentsuccess($_SESSION['pid']);
//echo $sf->ta->sql; 
if($account_status!=1){
if($res!=false){
while($row = mysqli_fetch_assoc($res)){
$f = new _spprofiles;
$pro = $f->read($row['bussiness_profile_id']);
if($pro!=false){
$pro_data = mysqli_fetch_assoc($pro);
}
?>
<tr>
<td><?php echo $i; ?></td>
<td>
<?php
if($row['hired'] == 1){
echo "Project by ".$pro_data['spProfileName'];
}else{
$sf  = new _freelancerposting;
$res1 = $sf->singletimelines1($row['freelancer_projectid']);

//echo $sf->ta->sql;
if($res1!=false){
$row1 = mysqli_fetch_assoc($res1);
$title = $row1['spPostingTitle'];
echo "<a href='".$BaseUrl."/freelancer/dashboard/project-bid.php?postid=".$row1['idspPostings']."'>".ucfirst($title)."</a>";
$currency_new = $row1['Default_Currency'];



}
} 
?>
</td>
<td ><p><?php echo date('d-m-Y',(strtotime($row['created']))); ?></p></td>
<td><?php echo $row['description'];?></td>
<td><?php echo $currency_new .' '. $row['amount']; ?></td>
<td class="">
<?php if($row['request_status'] == 0){
if($row['bussiness_profile_id'] == $_SESSION['pid']){
?>
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=1&postid='.$row['id'];?>">Realease</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=2&postid='.$row['id'];?>">Cancel</a></li>
</ul>
<?php
}else{
echo "Pending";
}
}elseif ($row['request_status'] == 1) {
echo "Released";
?>
<?php
}elseif ($row['request_status'] == 2) {
echo "cancelled";
}
?>
</td>
</tr> <?php
$i++;
}
}}else{
echo "<td colspan='7'><center>No Milestone </center></td>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</section>

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

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
} ?>
