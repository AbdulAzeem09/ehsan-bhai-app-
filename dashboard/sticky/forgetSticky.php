<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


include "../../univ/baseurl.php";
session_start();
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once("../../authentication/check.php");
$_SESSION['afterlogin'] = $BaseUrl . "/my-profile/";
}
$pageactive = 4;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/links.php'); ?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->
<link href="http://api.highcharts.com/highcharts">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<style>
.leftDashboard {
background-color: #dda0dd;
height: 900px;
}
</style>

<body class="bg_gray">
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
<?php
$pin = new _spAllStoreForm;
$pn = $pin->readpindata($_SESSION['pid1']); ?>
<?php
if ($pn != false) {
?>
<h1>Update your unique key for your vault</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Update unique key</li>
</ol>
<?php } else { ?>
<h1>Create your unique key for your vault</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Create unique key</li>
</ol>
<?php } ?>
</section>
<div class="content">
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<?php
if (isset($_SESSION['msg']) && isset($_SESSION['count'])) {
if ($_SESSION['count'] <= 1) {
$_SESSION['count'] += 1;
if ($_SESSION['pinmsg'] == 0) {
echo "<div class='alert alert-danger'>";
} else { ?>
<div class="alert alert-sucess">
<?php      } ?>
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['msg'];  ?>
</div>
<?php
unset($_SESSION['msg']);
}
} ?>
</div>
<!-- /.box-header -->
<div class="box-body">
<form role="form" method="post" action="<?php echo $BaseUrl ?>/dashboard/sticky-pin/createpin.php" class="stckyForm" id="frmpin">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="row">
<!-- <div class="col-md-12">
<div class="form-group">
<?php
if ($pn != false) {
?>
<label>Update PIN</label>
<?php
} else {
?>
<label>FORGET PIN</label>
<?php
}
?>
<br>
<input type="checkbox" id="chngePin" name="txtPinActive" data-toggle="toggle">
<input type="hidden" id="ggg">
</div>
</div>-->
<div id="enableArea">
<!-- <div class="col-md-12">
<div class="form-group">
<label class="step">Step 1:</label>
<hr class="">
</div>
</div>-->
<div class="col-md-12">
<?php
if ($pn != false) {
while ($pwd = mysqli_fetch_assoc($pn)) {
//print_r($pwd);
?>
<div class="col-md-4">
<div class="form-group" style="    margin-left: -15px;">
<label>Enter your Current pin</label>
<input type="hidden" value="<?php echo  $pwd['pin']; ?>" id="curr_pwd">
<input type="password" class="form-control" id="current_pin" maxlength="4" autocomplete="off" /><span id="error_pin" class="red"><span>
</div>
</div>
<?php
}
}
?>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Enter your new pin (4 Digit)</label>
<input type="password" class="form-control" id="txtPin" name="txtPin" maxlength="4" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Confirm PIN</label>
<input type="password" class="form-control" id="txtConfirmPin" name="txtConfirmPin" maxlength="4" />
<span class="error" id="error"><span>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Add a Clue for your pin</label>
<input type="text" name="txtClue" id="txtClue" class="form-control" />
</div>
</div>
<!-- <div class="col-md-12">
<div class="form-group">
<label class="step">Step 2:</label>
<hr class="">
</div>
</div>-->
<div class="col-md-5 hidden">
<div class="form-group" name="txtCreatePin">
<label>Select where you want to send your code to verify your account</label>
<select class="form-control" name="txtCreateBy" id="txtCreateBy">
<!-- <option value="SMS">SMS</option>-->
<option value="Email">Email</option>
</select>
</div>
</div>
<!-- <div class="col-md-12">
<div class="form-group">
<label class="step">Step 3:</label>
<hr class="">
</div>
</div>-->
<div class="col-md-2">
<div class="form-group">
<a href="javascript:void(0)" class="btn btn-primary getnrateOtp btn-border-radius" style="margin-left: -7px;">Generate Code</a>
</div>
</div>
<div class="col-md-6" style="margin-left:-60px;">
<div class="form-group hidden" id="code">
<p class="red" id="sms_msg" style="padding: 5px;margin-right:-15px;display:none;">Code is sent to your phone via SMS</p>

<p class="red" id="email_msg" style="padding: 10px;margin-right:-15px;display:none;">Code is sent to your Email.</p>


</div>
</div>
<!-- <div class="col-md-12">
<div class="form-group">
<label class="step">Step 4:</label>
<hr class="">
</div>
</div>-->
<div class="col-md-12">
<div class="form-group">
<label>Enter the code sent to your EMAIL to verify your account</label>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
<input type="text" class="form-control" name="txtOtp" id="codematch" placeholder="Input code here" />
<span id="verifycode" style="color:red"></span>
</div>
</div>
<div class="col-md-12">
<input type="hidden" id="action" value="<?php echo $_GET['action']; ?>">
<?php
if ($pn != false) {
?>
<input type="submit" name="btnCreatePin" value="Update PIN" class="btn btn-success btn-border-radius">
<?php
} else {
?>
<input type="submit" name="btnCreatePin" value="Create PIN" class="btn btn-success btn-border-radius">
<?php
}
?>

</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php include('../../component/footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/btm_script.php'); ?>
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
</script>
<script>
$(document).ready(function() {
$("#current_pin").change(function() {
$("#error_pin").html("");
});




var a = $("#action").val();
if (a == "update") {
$('.toggle-off').click();
}

$("#frmpin").submit(function(e) {
var curr_pwd = $("#curr_pwd").val();
var current_pin = $("#current_pin").val();

if (curr_pwd == current_pin) {

} else {
$("#error_pin").html("Current pin does not match");

return false;
}


var txtConfirmPin = document.getElementById("txtConfirmPin").value;
var txtPin = document.getElementById("txtPin").value;

if (txtPin != txtConfirmPin) {

$("#error").html("Password  does not match");
return false;
e.preventDefault();
}
var code = document.getElementById("ggg").value;
var inputCode = document.getElementById("codematch").value;
if (code != inputCode) {
document.getElementById("codematch").value = "";
$("#verifycode").text("Code Inputted is Wrong. Please Input The Correct Code");
return false;
e.preventDefault();
}

});
});
</script>

</body>

</html>