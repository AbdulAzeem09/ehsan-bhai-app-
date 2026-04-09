<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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
$activePage = 4;
?>
<style> 
#composTxtNow1{ 
background-color:#ff7208!important;

}
.btn:hover {
color: #080505!important;
opacity: 0.8;
/* padding: 6px 12px; */
}
.btn_c{    color: white!important;
border-radius: 3px!important;
background-color: #d91b1b!important;
}
#profileDropDown li.active {
background-color: #c45508!important;
}
#profileDropDown li.active a {
color: white!important;
}
.dashboardpage .dashboard-section .dashboardtable .table thead tr th {
background-color: #3e3e3e;
color: #fff!important;
}
span#car1 {
margin-top: 10px;
}
</style>
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
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body class="bg_gray">
<?php
//session_start();

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
<li>Awarded Project</li>

<!-- <li><?php echo $title;?></li> -->

</ul>
</div>
</div>
<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard" style="margin-top: 10px;">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard" >
<li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
<li>Active Projects</li>

</ul>
</div>
</div> -->
<script>

function pass(a,b){

$('#txtReceiver').val(a);

$('#name').text(b);

}





</script>
<div id="composeNewTxt" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content no-radius sharestorepos">
<form method="post"  >
<div class="modal-header">
<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
</div>
<div class="modal-body">
<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $receiver;?>" >
<div class="form-group">
<label >To (<span id="name"></span>)<span class="red"> * <span class="error_user"></span></span></label>

</div>
<div class="form-group">
<label>Message<span class="red"> * <span class="error_msg"></span></span></label>
<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn_c" data-dismiss="modal">Close</button>
<input type="button" class="btn btn-primary composTxtNow" id="composTxtNow1" name="" value="Send Message"  data-dismiss="modal" > 
</div>
</form>
</div>
</div>
</div>


<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="height: auto;">

<table class="table text-center tbl_activebid" id="example1">
<thead>
<tr>
<th></th>
<th>ID</th>
<th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Project Name</th>
<th >Price</th>
<th>Chat</th>
<th>Assigned Date</th>
<th class="action">Action</th>
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
$fps = new _freelance_project_status;
$res = $fps->myAssignProject($_SESSION['pid']);


//echo $fps->ta->sql;

if($account_status!=1){
if(!empty($res)){

while($row = mysqli_fetch_assoc($res)){

//echo "<pre>"; print_r($row);
//$id=$row['spProfiles_idspProfiles'];
$dt = new DateTime($row['fps_start_date']);

$f = new _spprofiles;

$pro = $f->read($row['spProfiles_idspProfiles']);
if($pro!=false){
$pr=mysqli_fetch_assoc($pro);
//print_r($pr);
// $id=$pr['idspProfiles'];
$freelancer_name=$pr['spProfileName'];
// $p = new _postings;
}


$sf = new _freelancerposting;

/*$result = $p->singletimelines($row['spPosting_idspPostings']);*/

$result = $sf->singletimelines1($row['spPosting_idspPostings']);


// echo $sf->ta->sql;

if($result){
$row2 = mysqli_fetch_assoc($result);
$id=$row2['spProfiles_idspProfiles'];
//print_r($row2);
?>
<tr>
<!-- Modal -->
<div id="myproject-<?php echo $row['spPosting_idspPostings'];?>" class="modal fade" role="dialog">
<div class="modal-dialog sharestorepos">
<!-- Modal content-->
<form method="post" action="addmilestone.php">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $row2['spPostingTitle'];?></h4>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['spPosting_idspPostings']; ?>">
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
<td></td>
<td><?php echo $row['spPosting_idspPostings'];?></td>
<td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['spPosting_idspPostings'];?>" title="<?php echo $row2['spPostingTitle']; ?>" class="red freelancer_capitalize" style="margin-left:43px;"  ><?php echo substr($row2['spPostingTitle'],0,15).'...';?></a></td>

<td><?php echo $row2['Default_Currency'].' '.$row['fps_price'];?></td>
<td><div class="col-sm-12 zoom" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;" > <a href="javascript:void(0)"  id="composeNewTxt2"  class="red" data-id="<?php echo $id; ?>" data-receiver_name="<?php echo $freelancer_name;?>" onclick="pass(<?php echo $id;?>,'<?php echo $freelancer_name;?>')"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a></div></td>
<td><?php echo $dt->format('M d, Y'); ?></td>

<td class="text-center">
<?php


$status  =  $fps->readFreelanceProject($row['spPosting_idspPostings']);
if($status!=false){
$srow = mysqli_fetch_assoc($status);
}
/*      print_r($srow);*/


if($row['status'] == 0){  ?>


<a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=1&postid='.$row['spPosting_idspPostings'].'&project='.$row2['spPostingTitle'];?>" class="btn btn-info accepro" style="background-color: #c45508; border:1px solid black;">Accept</a>

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=2&postid='.$row['spPosting_idspPostings'];?>" class="btn btn-danger rejpro"  style="border:1px solid black;">Reject</a> 


<!--    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=1&postid='.$row['spPosting_idspPostings'];?>">Accept</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=2&postid='.$row['spPosting_idspPostings'];?>">Reject</a></li>

</ul>
-->



<?php

}else if ($row['status'] == 1) {

echo "Accepted";

/*         ?>

<?php
$m = new _milestone;

$checkm = $m->checkmilestone($row['id']);

//print_r($checkm);
if($checkm->num_rows>0){
?>
<br>

<a href="view_milestone.php?project_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-md"  style="color: #fff;margin-top: 10px;">View Milestone</a>

<?php   
}*/

}else if ($row['status'] == 3) {
echo "Canceled By Client";
}else if ($row['status'] == 2) {

echo "Rejected";
} 



?>


<!--  <a href="javascript(0)" class="red" data-toggle="modal" data-target="#myproject-<?php echo $row['spPosting_idspPostings'];?>">Request Milestone</a> -->
</td>
</tr> <?php
}

}
}}
else{

echo "
<td colspan='6' >No Record Found</td>";
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

<script type="text/javascript">

$(".rejpro").click(function(e){
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

swal({
title: "Are you sure you want to Reject?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});
$(".accepro").click(function(e){
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

swal({
title: "Are you sure you want to ACCEPT this project?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});



</script>
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
}
?>