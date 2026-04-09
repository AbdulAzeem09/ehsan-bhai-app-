
<?php
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');




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

if($_SESSION['ptid'] == 2 || $_SESSION['ptid'] == 5){ 
$re = new _redirect;
$location = $BaseUrl."/services/";
$re->redirect($location);
}

 
$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";
$header_servic = "header_servic";

$activePage = 15;

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<style type="text/css">

.sweet-alert h2 {

font-size: 21px!important;
margin: 10px 0px!important;

}


.sweet-alert {

width: 441px!important;
padding: 8px!important;

} 
#example_length{
margin-left: 9px;
margin-top: 10px;
padding-bottom: 5px;

}
.dataTables_filter{
margin-top: 5px;
margin-right: 6px;

}
#example_info{
margin-left: 9px;
}
#example_paginate{
margin-bottom: 7px;
}


</style>



<?php 
//$urlCustomCss = $_SERVER['DOCUMENT_ROOT'].'/component/custom.css.php';
//include $urlCustomCss;
?>





</head>

<body class="bg_gray">
<?php

include_once("../../header.php");

?>


<section class="main_box">
<div class="container">
<div class="row">
<?php  //include('servicemoduledash.php'); ?> 
<div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
<?php  include('left-menu.php');  ?> 
</div>
<div class="col-md-10">
<?php	if($_GET['msg'] == "notacess"){ ?>

<div class="alert alert-danger" role="alert">
<h1>You can not access this Page or this Page not might exist.</h1>
</div>
<?php   } ?>


<?php if(isset($_GET['msg1'])== "access"){ ?>
<div class="alert alert-success" role="alert" id="div2"><span>Publish Successful!</span></div>
<?php } 
?>

<div class="col-sm-12 nopadding dashboard-section" style="">
<div class="col-xs-12 nopadding dashboardbreadcrum">
<ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
<li><a href="<?php  echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
<li>Active Ads</li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn post-project postproject" style="float: right;background-color: #07a2ae;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post An Ad</a>
</ul>
</div>


</div>
<!--  <div class="col-xs-12 serviceDashTop text-center">
<h1>Active Ads</h1>
</div> -->
<div class="row">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="col-sm-12">
<div class="table-responsive bg_white" style="overflow:hidden;">

<?php 
$p      = new _classified;
$pf     = new _postfield;
$res    = $p->myposted_service($_SESSION['pid']);
if($res != false){
$page1="example";
}
else{
$page1="example1";
}
?>
<table class="table table-striped table-bordered dashServ display" id="<?php echo $page1; ?>"> 
<thead>
<tr>

<th class="text-center">Id</th>
<th class="text-center">Service Name</th>
<th class="text-center">Category</th>
<th class="text-center">Posted Date</th>
<th class="text-center">Expiry Date</th>
<!-- <th class="text-center">Location</th> -->

<!-- <th class="text-center">Total Views</th> -->
<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php
// echo $_SESSION['pid'];
$p      = new _classified;
$pf     = new _postfield;
$res    = $p->deactiv_service($_SESSION['pid']);
//echo $p->ta->sql;
$i = 1;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 

//print_r($row);
//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){*/

$location = $row['spPostCity'];
/*      while ($row2 = mysqli_fetch_assoc($result_pf)) {


if($location == ''){
if($row2['spPostFieldName'] == 'spPostCity_'){
    $location = $row2['spPostFieldValue'];
}
}

}*/
/*  $ci  = new _city;
// city name
$result4 = $ci->readCityName($location);
if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);
}*/

$ci  = new _city;
// city name
$result4 = $ci->readCityName($location);
if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);
}
?>
<tr>
<td><?php echo $i; ?></td>
<td>
<!--   <?php
$pic = new _classifiedpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
    $rp = mysqli_fetch_assoc($res2);
    $pic2 = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
    <?php
} else{
    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive'>"; ?>
    <?php
} ?> -->
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']); ?></a>
</td>
<td class="text-center"><?php echo ucfirst($row['spPostSerComty']); ?></td>
<td class="text-center"><?php echo $row['spPostingDate']; ?></td>
<td class="text-center"><?php echo $row['spPostingExpDt']?></td>
<!-- <td class="text-center"><?php //echo ucwords($row4['city_title']); ?></td> -->

<!-- <td class="text-center">0 Person</td> -->
<td class="text-center">
   
 <a href="javascript:void(0);" class="disable-btn" style="margin-right: 19px;" data-work="activated" title="Activate" data-Id="<?php echo $row['idspPostings'];  ?>"><i style="color: #21b925; font-weight: bolder;"></i>✔  </a> 


<a href="javascript:void(0);" class="disable-btn" title="Delete" data-work="delete_to" data-Id="<?php echo $row['idspPostings'];  ?>"><i style="color: red;" title="Delete" class="fa fa-trash disable-btn" data-disableId=""></i></a> 
</td>
</tr>

<?php
$i++;
/* }*/
}
}else{  

echo "<tr style='text-align:center;'><td colspan='6'><h4>No Active Ads  Found</h4></td></tr>";


} ?>


</tbody>
</table>


</div>
</div>

</div>
</div>
</div>
</div>
</section>

<div class="space-lg"></div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
});



setTimeout(function () {
$('#div2').hide();
}, 2000);


</script>

<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");
 
var work = $(this).attr("data-work");
//alert(work);
if(work=='activated'){
swal({
title: "Do You Want Activate this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Activate!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'update.php?id=' +dataId;
} 
});

}	
if(work=='delete_to'){
swal({
title: "Are you sure you want to delete ?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'delete_addclf.php?id=' +dataId+'&work='+work;
} 
});
}	

// alert(dataId);
});


});



</script>