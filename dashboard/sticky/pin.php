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
<body class="lockscreen" onload="pageOnload('details')">
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



<div class="content">
<div class="row">
<div class="col-md-12">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

<!-- User name -->
<div class="lockscreen-name">Marina</div>

<!-- START LOCK SCREEN ITEM -->
<div class="lockscreen-item">
<!-- lockscreen image -->
<div class="lockscreen-image">
<img src="<?php echo $BaseUrl;?>/assets/admin/img/boxed-bg.jpg" alt="user image"/>
</div>
<!-- /.lockscreen-image -->

<!-- lockscreen credentials (contains the form) -->
<form class="lockscreen-credentials" method="POST" action="proSticy.php" >
<input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">
<div class="input-group">
<input type="password" name="txtPin" class="form-control" maxlength="4" placeholder="PIN" />
<div class="input-group-btn">
<button class="btn" type="submit" name="btnPin"><i class="fa fa-arrow-right text-muted"></i></button>
</div>
</div>
</form><!-- /.lockscreen credentials -->

</div><!-- /.lockscreen-item -->
<div class="help-block text-center">
Enter your pin to retrieve your session
</div>
<div class='text-center'>
<a href="javascript:void(0)">Forgot Your Pin</a>
</div>

</div><!-- /.center -->

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