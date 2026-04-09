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
$activePage = 6;
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
.dashboardpage .dashboard-section .dashboardtable .table thead tr th {
font-size: 18px;
font-family: MarksimonRegular;
color: #fff;
text-transform: uppercase;
text-align: left;
font-weight: 500;
padding-left: 85px!important;
padding-right: 68px!important;
}
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
<li>Completed Projects</li>

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


<!-- <ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#home">Completed Project</a></li>
<li><a data-toggle="tab" href="#menu1">Hire Freelancer Project</a></li>
<li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
<li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
</ul> -->





<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="height: auto;">


<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<table class="table text-center tbl_activebid" id="example1">
<thead style="background-color: #3e3e3e;">
<tr>
<th>ID</th>
<th>Project Name</th>

<th>Price</th>
<th>Status</th>
<!--  <th>Milestone</th> -->
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
$fps = new _freelancerposting;
$res = $fps->freelancer_completed_incompleted_project($_SESSION['pid']);
if($account_status!=1){
if($res){
while($row = mysqli_fetch_assoc($res)){
$dt = new DateTime($row['fps_start_date']);
$result = $fps->completeincompletedProject($row['idspPostings']);
if($result){
$row2 = mysqli_fetch_assoc($result);
?>
<tr>
<!-- Modal -->
<div id="myproject-<?php echo $row['idspPostings'];?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addmilestone.php">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $row2['spPostingTitle'];?></h4>
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
<button type="submit" class="btn btn-primary" >Save</button>
</div>
</div>
</form>
</div>
</div>
<td><?php echo $row['idspPostings'];?></td>
<td ><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row2['spPostingTitle'];?></a></td>
<td><?php echo $row2['Default_Currency'].' '.$row2['spPostingPrice'];?></td>
<!-- <td><?php echo $dt->format('M d, Y'); ?></td> -->
<td><?php 
if($row['complete_status'] == 1){
echo "Completed";
}else{
echo "In-Completed";
}
?></td>
<!--   <td>
<a href="<?php echo $BaseUrl.'/freelancer/complete-milestone.php?postid='.$row['idspPostings'];?>" class="red" >Complete Milestone</a>

</td> -->
</tr> <?php
}

}
}}
else{

echo "<td colspan='4'>No Record Found</td>";
}

?>

</tbody>
</table>
</div>


<div id="menu1" class="tab-pane fade">

<table class="table text-center tbl_activebid">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Project Title</th>
<th style="color:#fff;">Price</th>
<th style="color:#fff;">Status</th>
<!--  <th class="action text-center" style="color:#fff;text-align: center;">Review</th> -->
</tr>
</thead>
<tbody>
<?php
$sf  = new _freelance_chat_project;
$res2 = $sf->freelancecompletedincompletedproject($_SESSION['pid']);
$i=0;
if($account_status!=1){
if($res2){
while($row2 = mysqli_fetch_assoc($res2)){
$i++;
$f = new _spprofiles;
$pro = $f->read($row2['receiver_idspProfiles']);
$pro_data = mysqli_fetch_assoc($pro);
$dtf = new DateTime($row2['chat_date']);
?>
<tr>
<td><?php echo $row2['id']; ?></td>
<td >
<a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row2['id'];?>" class="red freelancer_capitalize"  ><?php echo "Project for " .ucfirst($pro_data['spProfileName']);?></a></td>
<td>$<?php echo $row2['bidPrice'];?></td>
<td><?php 
if($row['complete_status'] == 1){
echo "Completed";
}else{
echo "In-Completed";
}
?></td>
<?php
}
}}else{
echo "<td colspan='5'><center>No Record Found</center></td>";
}
?>
</tr>
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
