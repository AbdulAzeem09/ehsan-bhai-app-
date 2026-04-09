<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION); 
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "freelancer/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 22;

$fps = new _freelance_project_status;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>

<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>


<style>
#example1_length {
margin-top: 7px;
margin-bottom: 9px;
margin-left: 7px;

}
div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}

#example1_filter {
margin-top: 6px;
margin-right: 6px;
}

#example1_info {
margin-left: 9px;

}

#example1_paginate {
margin-bottom: 6px;
}

.dataTables_empty {
text-align: center !important;
}

#profileDropDown li.active {
background-color: #c45508;
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

<div class="sidebar col-xs-3 col-sm-3" id="sidebar">

<?php include('left-menu.php'); ?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">

<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li>Favorite Freelancer</li>

<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a project</a>
</ul>
</div>
</div>

<!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php //echo $BaseUrl;
?>/freelancer">Dashboard</a></li>
<li>Expired Projects</li>

</ul>
</div>
</div> -->
<div class="col-xs-12 nopadding dashboard-section" >

<div class="col-xs-12 dashboardtable">
<div class="table-responsive" >
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped tbl_store_setting display" id="example1">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Name</th>
<th style="color:#fff;">HOURLY RATE</th>
<th style="color:#fff;">Delete</th>

<!-- <th style="color:#fff;">Email</th>
<th style="color:#fff;">Date Of Birth</th>
-->
</tr>
</thead>
<tbody>
<?php
$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];
$fr = new _spprofiles;
// $sr = new _spuser;
$freeid = $fps->readid($uid, $pid);
// print_r($freeid);die;
if (!empty($freeid)) {
while ($frid = mysqli_fetch_assoc($freeid)) {

$freename = $frid['freelancer_id'];
$frname = $fr->read($freename);

if ($frname) {
$frnm = mysqli_fetch_array($frname);

// print_r($frnm);

$id_s = $frnm['idspProfiles'];//id

//    print_r($id_s); 
$getcurrency = $fr->get_currency($id_s);



//getting currency
if($getcurrency){
$get_cr = mysqli_fetch_assoc($getcurrency);
$curr =  $get_cr['currency'];
}

$result_fi = $fr->read_hourly_new($id_s);
if ($result_fi) {
$row_fi = mysqli_fetch_assoc($result_fi);
$hourlyrate = $row_fi['hourlyrate'];
}
?>
<tr>
<td> <?php echo $freename; ?></td>
<td> <?php echo $freename; ?></td>
<td><a href="<?php echo $BaseUrl . '/freelancer/user-profile.php?profile=' . $freename; ?>"><?php echo $frnm['spProfileName']; ?> </a> </td>
<td><?php echo $curr . ' ' . $row_fi['hourlyrate']; ?></td>


<td>
   <a onclick="remove_member('<?php echo $BaseUrl.'/freelancer/dashboard/favourite_freelancer_delete.php?postid='.$frid['id']; ?>')"><i title="Delete" class="fa fa-trash" ></i></a>
</td>


<!-- <td><?php  //echo $frnm['spProfileEmail']."hello"; 
?></td>
<td><?php  //echo $frnm['spProfilesDob']; 
?></td> -->
</tr>
<?php }
}
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
}
?>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script>
var table = $('#example1').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
});
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function remove_member(a){
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