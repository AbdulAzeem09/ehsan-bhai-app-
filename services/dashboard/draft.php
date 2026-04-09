<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="services/";
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
$activePage = 6;
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

<style type="text/css">

.sweet-alert h2 {

font-size: 21px!important;
margin: 10px 0px!important;

}


.sweet-alert {

width: 441px!important;
padding: 8px!important;

}


</style>

</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<?php //include('servicemoduledash.php'); ?> 
<div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10">


<div class="col-sm-12 nopadding dashboard-section" style="">
<div class="col-xs-12 nopadding dashboardbreadcrum">
<ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
<li><a href="<?php echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
<li>Draft Ads</li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn post-project postproject" style="float: right;background-color: #07a2ae;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post An AD</a>
</ul>
</div>


</div>


<!-- <div class="col-xs-12 serviceDashTop text-center">
<h1>Draft Ads</h1>
</div> -->
<div class="row">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="col-sm-12">
<div class="table-responsive bg_white" style="overflow:hidden;">

<?php 
$p      = new _classified; 
$pf     = new _postfield; 
$res = $p->readMyDraftprofile($_SESSION['pid']); 

if($res != false){
$draf="example";
}
else{
$draf="example1";
}
?>
<table class="table table-striped table-bordered display dashServ" id="<?php echo $draf; ?>">
<thead>
<tr>

<th>Service Name</th>
<th class="text-center">Creation Date </th>

<th class="text-center">Category </th>

<th class="text-center">Location </th>


<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php 
$p      = new _classified; 
$pf     = new _postfield; 
//$res = $p->myDraftJob($_GET['categoryID'] ,$_SESSION['pid']); 
$res = $p->readMyDraftprofile($_SESSION['pid']); 
//print_r($res);die('+++111');
//$res    = $p->myposted_service($_GET['categoryID'], $_SESSION['pid']);
//echo $p->ta->sql;
//echo $res->num_rows;
$i = 1; 
if($res != false){ 
while ($row = mysqli_fetch_assoc($res)) { 

$result_pf = $pf->read($row['idspPostings']);
$category = $row['servicecategory'];
$location = $row['spPostingsCity'];

$ci  = new _city; 

$result4 = $ci->readCityName($location);
if($result4 != false){ 
$row4 = mysqli_fetch_assoc($result4);
$city=$row4['city_title'];
 }
?>
<tr>

<td>
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']); ?></a>
</td>
<td><?php echo date("Y-m-d",strtotime($row['spPostingDate'])); ?></td>  

<td ><?php echo ucfirst($row['spPostSerComty']); ?></td>

<td ><?php echo ucwords($city); ?></td>

<td>
<a href="<?php echo $BaseUrl.'/post-ad/services/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>
<a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><i style="color:red;" title="Delete" class="fa fa-trash"></i></a>
</td>
</tr>

<?php


$i++;
}
}else{  

echo "<tr style='text-align:center;'><td colspan='6'><h4>No Draft Ads  Found</h4></td></tr>";


}  ?>


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


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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

</script>