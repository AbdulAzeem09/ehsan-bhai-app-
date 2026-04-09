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
$activePage = 13;

$fps = new _freelance_project_status;


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
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>
<style>
#example1_length{padding:8px;}
#example1_filter{padding-top:6px; padding-right:8px;}
#example1_info{padding-left:10px;}
#example1_paginate{margin-bottom:6px}
#profileDropDown li.active {
background-color: #c45508;
margin-top:-1px;
}
#profileDropDown li.active a {
color: #fff;
}
div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
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
<li>Closed Projects</li>

<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
</ul>
</div>
</div>

<!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
<li>Expired Projects</li>

</ul>
</div>
</div> -->


<?php


$sf  = new _freelancerposting;

$res = $sf->myExpireProduct1(5, $_SESSION['pid']);

if($res!=false){ 
$table="example1";
}
else{
$table="";
}

?>
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="overflow-x:hidden;margin-top:10px">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<table class="table table-striped tbl_store_setting display" id="example" >
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Project Title</th>
<th style="color:#fff;">Price ($)</th>
<th style="color:#fff;">Expired Date</th>
<th class="action" style="color:#fff;">Action</th>
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
$sf  = new _freelancerposting;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res = $sf->myExpireProduct1(5, $_SESSION['pid']);

//echo $sf->ta->sql;
if($account_status!=1){
if($res!=false){ 
while($row = mysqli_fetch_assoc($res)){
//print_r($row);
$dt = new DateTime($row['spPostingExpDt']);
?>
<tr>


<td><?php echo $i; ?></td>
<td><?php echo $i; ?></td>
<td ><a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo ucwords(strtolower($row['spPostingTitle']));?></a></td>

<td><?php echo  $row['Default_Currency'].' '.$row['spPostingPrice'];?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td class="text-center">

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red" ><i style="color: #428bca" title="View" class="fa fa-eye"></i></a>

<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'].'&exp=1'; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>
<a href="javascript:void(0);" onclick="deleteexpire(<?php echo $row['idspPostings']; ?>);" class="red freelancer_capitalize"><i title="Delete" class="fa fa-trash" style="color:black;"></i></a>


</td>

</tr> <?php
$i++;
}
}}else{
echo "<td colspan='6'><center>No Record Found</center></td>";
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



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php 
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>



<script type="text/javascript">
function deleteexpire(expireid) {
    Swal.fire({
title: 'Are You Sure You Want to Delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "GET",
url: "delete_expire.php",
cache: false,
data: {
'postexpireid': expireid
},
success: function(data) {
//alert(data);
window.location.reload();
}
});
}
});

}
</script>






<script>
var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>	


