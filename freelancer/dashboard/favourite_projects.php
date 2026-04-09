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
$activePage = 19;

$fps = new _freelance_project_status;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>
<style>
#example1_length{
margin-top: 7px;
margin-bottom: 9px;
margin-left: 7px;

}
#example1_filter{
margin-top: 6px;
margin-right: 6px;
}
#example1_info{
margin-left: 9px;

}
#example1_paginate{
margin-bottom: 6px;
}
#profileDropDown li.active {
background-color: #c45508 ;
margin-top: -1px;
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
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li> Favourite Projects</li>

<td ><?php echo $row['idspPostings']; ?></td>

<td><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" target="_blank" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a></td>
<a href="javascript:void(0)" class="red freelancer_capitalize"  ><?php //echo $row['spPostingTitle'];?></a>




<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
</ul>
</div>
</div>

<!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li>Draft Projects</li>

</ul>
</div>
</div> -->
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

<div class="col-xs-12 dashboardtable">
<div class="table-responsive">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php

$sf  = new _freelancerposting;
$f= new _freelance_favorites;
$st1=$f->read_favourite_project($_SESSION['pid']);
//print_r($_SESSION['pid']);

$i = 1;
if($st1!=false){
$table='example12';
}
else{
$table='';
}
//echo $table;
//die('=========');
?>
<table class="table table-striped tbl_store_setting display" id="<?php echo $table;?>">
<thead  style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;"></th>
<th style="color:#fff;">ID</th>

<th style="color:#fff;">Project Name</th>

<th style="color:#fff;">Price ($)</th>
<!--<th style="color:#fff;">Expire Date</th>-->
</tr>
</thead>
<tbody>
<?php

$st= new _spuser;
$f= new _freelance_favorites;
$st1=$f->read_favourite_project($_SESSION['pid']);
//print_r($st1);
//die('==');
if($st1!=false){
$i=1;

//print_r(mysqli_fetch_assoc($st1));
$i=1;
while($stt=mysqli_fetch_assoc($st1)){

//print_r($stt);
//die('==');
$postid=$stt['spPostings_idspPostings'];
//echo $postid;
//die('==');

$sf  = new _freelancerposting;

$res = $sf->myProfileFavouriteFreelancer(5, $postid);
//print_r($res);
//die('==');
//echo $res->num_rows;
// echo $pv->ta->sql;

//echo $sf->ta->sql;
//echo $postid;

if($res){
$row = mysqli_fetch_assoc($res);
$dt = new DateTime($row['spPostingExpDt']);

// print_r($row);
// die('==');

?>
<tr>

<td></td>
<td><?php echo $i; ?></td>
<td ><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" target="_blank" class="red"  ><?php echo ucfirst($row['spPostingTitle']);?></a>
<td><?php echo  $row['Default_Currency'].' '.$row['spPostingPrice'];?>

</tr> <?php
$i++;

}}}else{
echo "<td colspan='5'><center>No  Favourite Projects Available</center></td>";
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

function  deletedraft(flagid){



swal({
title: "Are you sure you want Delete?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes,Delete",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
$.ajax({
type: "GET",
url: "delete_project.php",
cache:false,
data: {'post_id':flagid},
success: function(data) {
//alert(data);
window.location.reload();
} 
}); 
}
});




}




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


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script>
var table = $('#example12').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>	