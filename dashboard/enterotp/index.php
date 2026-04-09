<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$requirePrefix = "../../";

include("../../univ/baseurl.php");
session_start();

function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once "../../helpers/common.php";


$u = new _spuser;
//print_r($_SESSION);
$userid=$_SESSION['uid'];
$res_1 = $u->phone($userid);
if($res_1){
$row = mysqli_fetch_assoc($res_1);
}


$otp = rand(10000,99999);
$spUserPhone = $row['phone_code']. $row['spUserPhone'];
$_SESSION["bank_otp"] = $otp;
$text ='The SharePage phone verification code  is  ' . $otp . ' . Do not share this code with anyone.';
callSmsApi($spUserPhone, $text);

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include('../../component/f_links.php');?> 
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
section.content-header {
margin-top: -10px;
padding-left: 30px;
margin-bottom: -5px;
}
ol.breadcrumb {
margin-right: 25px;
}
</style>
</head>
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
<h1>Verify Phone number</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Phone number OTP</li>
</ol>
</section>

<div class="content">

<div class="box box-success">

<div class="box-body">


<div class="container col-sm-12">
<form action="match_otp.php" method="post">
<div class="row">
<div class="col-sm-12">
	<?php
	// echo  $_SESSION['bank_otp'];
	// echo '<br>';
	echo '<b>An One Time Password to your Phone : </b> '. $userphone;
?>
	</div>
<div class="col-sm-6">
<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid'];?>">
<label for="spAccountname" class="control-label">Enter OTP <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" value=''>
<?php
if(isset($_GET['msg']) && ($_GET['msg']=='wrong')) { 
//die('==========');
	?>
<span style="color : red;">Enter Valid OTP</span>
<?php }?>
</div>
<p>if not get OTP , <a href='$BaseUrl . /dashboard/enterotp'>Click Here </a> to resend it.</p>
<button type="submit" style="margin-left: 391px;" class="btn btn-primary">Verify</button>

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
</section>



 <?php include('../../component/f_footer.php');?>
<!--  INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START -->
<?php include('../../component/f_btm_script.php'); ?>



</body> 
</html>
