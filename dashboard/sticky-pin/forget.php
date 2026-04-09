<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include_once("../../univ/baseurl.php");
session_start();

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$pageactive = 116;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>

<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->
<link href="http://api.highcharts.com/highcharts">


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
<?php if ($_SESSION['hasVault'] == 1) {

unset($_SESSION['hasVault']);

echo "<div class='alert alert-danger hidewrong'>
Wrong Pin !
</div>";
}
?>

<script>
setTimeout(function() {
$(".hidewrong").hide();
}, 2000);
</script>

<div class="row">
<div class="col-md-12">
<?php /*
if(isset($_SESSION['msg']) && isset($_SESSION['count'])){  $_SESSION['hasVault']
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['msg'];  ?>
</div> 
<?php
unset($_SESSION['msg']);
}
} 
*/ ?>
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

<?php
$p = new _spprofiles;
$result = $p->read($_SESSION['pid']);
if ($result != false) {
$row = mysqli_fetch_assoc($result);

?>

<?php
}
?>
<!-- User name -->
<div class="lockscreen-name"><?php if (strlen($row['spProfileName']) <= 20) {
echo $row['spProfileName'];
} else {
echo (substr($row['spProfileName'], 0, 20));
} ?></div>

<!-- START LOCK SCREEN ITEM -->
<div class="lockscreen-item">
<!-- lockscreen image -->
<div class="lockscreen-image">
<?php
if (isset($row["spProfilePic"])) {
echo "<img alt='' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
} else {
echo "<img alt='' class='img-circle' src='" . $BaseUrl . "/img/noman.png' >";
}

$pin = new _spAllStoreForm;
$pn = $pin->readpindata($_SESSION['pid']);
?>

</div>
<!-- /.lockscreen-image -->

<!-- lockscreen credentials (contains the form) -->
<form class="lockscreen-credentials" method="POST" action="<?php echo $BaseUrl; ?>/dashboard/sticky/forgetSticky.php">

<input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="otp" id="otp" value="<?php echo $_SESSION['code']; ?>">
<div class="input-group">
<?php if ($pn != false) {
$text = "Enter your pin to retrieve your session";
$attrib = "";
} else {
$text = "Create your pin to start your session";
$attrib = "disabled";
} ?>
<input type="password" name="txtPin" class="form-control" id="txtPin" placeholder="PIN" <?= $attrib ?> />
<div class="input-group-btn">
<button class="btn" type="button" name="btnPin" onClick="validation(event)" <?= $attrib; ?>><i class="fa fa-arrow-right text-muted"></i></button>
</div>
</div>
</form><!-- /.lockscreen credentials -->

</div><!-- /.lockscreen-item -->
<!-- <p>We have sent a code to the email you have used to create this account, please check your email and enter the code here to update your pin.</p> -->

<div class="help-block text-center" style="display:none;">
Please enter the OTP that we have sent in your email..
</div>

<!-- <?php
if ($pn != false) {
?>
<div class='text-center'>
<a href="<?php echo $BaseUrl . '/dashboard/sticky-pin/?action=update'; ?>">Update pin</a>
<a href="<?php echo $BaseUrl . '/dashboard/sticky-pin/?action=update'; ?>">Forget pin</a>
</div>
<?php } else { ?>
<div class='text-center'>
<a href="<?php echo $BaseUrl . '/dashboard/sticky-pin/'; ?>">Create pin</a>
</div>
<?php } ?>-->
<a href="javascript:void(0)" class="btn btn-primary getnrateOtp_f" style="margin-left: 135px;">Generate Code</a>
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
<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function() {
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

function validation(e) {

var fname = document.getElementById("txtPin").value; // Typo here ID should be Id.
var inputpin = document.getElementById("otp").value; // Typo here ID should be Id.
// var inputpin = $.session.get("code"); // Typo here ID should be Id.
if (fname == "") {
e.preventDefault();
alert("Please Enter Pin");
} else if (inputpin == fname) {
window.location.replace('<?php echo $BaseUrl ?>/dashboard/sticky/forgetSticky.php');
} else {
alert("Please Enter Correct pin !");
}

}
</script>
<script>
$(".getnrateOtp_f").click(function() {
$(".help-block").show();
});
</script>
</body>

</html>
<?php
} ?>