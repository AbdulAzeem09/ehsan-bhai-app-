<?php
require_once("../../univ/baseurl.php" );
session_start();
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../../authentication/check.php");
$_SESSION['afterlogin'] = $BaseUrl."/my-profile/";
}
$pageactive = 3;

$re = new _redirect;

// if (!isset($_SESSION['pin']) && $_SESSION['pin'] != 1) {
//     $redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
//     $re->redirect($redirctUrl);
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<link href="https://api.highcharts.com/highcharts">


</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Sticy Notes</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Sticky Notes</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-md-12">
<div class="box">
<div class="box-header text-right">
<a href="<?php echo $BaseUrl.'/dashboard/sticky/add.php';?>" class="btn butn btn-border-radius"><i class="fa fa-plus"></i> Add Sticky Notes</a>
</div><!-- /.box-header -->
<div class="box-body">
<table id="example1" class="table table-bordered table-striped text-center">
<thead>
<tr>
<th>ID</th>
<th class="text-left">Title</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i =1;
$p = new _spAllStoreForm;
$type = 0;
$result = $p->readSticky($_SESSION['pid'], $type);
if ($result) {
while ($row = mysqli_Fetch_assoc($result)) {
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $row['spStickyTitle']?></td>
<td><?php echo $row['spStickyDate']; ?></td>
<td class="menu-action">
<a href="<?php echo $BaseUrl.'/dashboard/sticky/detail.php?id='.$row['idspSticky'];?>" data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-green vd_green"> <i class="fa fa-eye"></i> </a> 
<a href="<?php echo $BaseUrl.'/dashboard/sticky/modify.php?id='.$row['idspSticky'];?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"> <i class="fa fa-pencil"></i> </a> 
<a href="<?php echo $BaseUrl.'/dashboard/sticky/proSticy.php?action=delete&id='.$row['idspSticky'];?>" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
</td>
</tr>
<?php
$i++;
}
}
?>
</tbody>

</table>
</div><!-- /.box-body -->
</div><!-- /.box -->



</div>
</div>

</div>
</div>
</div>
</div>





</div>
</section>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

<script src="http://code.highcharts.com/highcharts.js"></script>
<?php include('../../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/btm_script.php'); ?>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function () {
$("#example1").dataTable();
$('#example2').dataTable({
"bPaginate": true,
"bLengthChange": false,
"bFilter": false,
"bSort": true,
"bInfo": true,
"bAutoWidth": false
});
});
</script>
</body>	
</html>