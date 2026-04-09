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
$pageactive = 116;
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

<?php 
$u = new _spuser;
$p = new _spAllStoreForm;
$pro = new _spprofiles;
$em = new _email;
if($_SESSION['spstickyOtp']==''){
$userId = $_SESSION['uid'];
	$result = $u->read($userId);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$userEmail = $row['spUserEmail'];

		$pid1 = $_SESSION['pid'];
		$result1 = $u->read_pro($pid1);
		if($result1){
		$row1 = mysqli_fetch_assoc($result1);
		}
		$userName = $row1['spProfileName'];
		//echo $userName;
		//die('======');

		//$userName = $row['spUserName'];
		$pid = $_SESSION['pid'];

		// chek already create or not
		$result = $p->chekOtp($pid);
		if ($result) {
			// already created ha then ????
			$row = mysqli_fetch_assoc($result);
			if($row['spstickyOtp']){
				$codeSend = $row['spstickyOtp'];
				$_SESSION['spstickyOtp'] = 	$codeSend;
			}else{
				$codeSend =rand(99999,10000);
				$_SESSION['spstickyOtp'] = $codeSend;

			}
		} else {
			// if not created first time created

			$codeSend =rand(99999,10000);
			$_SESSION['spstickyOtp'] = $codeSend;

			

		}
		
		// write code here of email
		// ===========SEND EMAIL==============
		$headers = "From: TheSharePage <no-reply@thesharepage.com> \r\n";
		$msg = "Dear " . $userName . ",\r\n\r\n" . "Your code for Vault note is " . $codeSend . "\r\n\r\n";
		$em->send_all_email('krsure1234@gmail.com', $headers, $msg);


	}
}



    
 
	



?>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">
<!-- breadcrumb -->
<section class="content-header">
<?php
$pin = new _spAllStoreForm;
$pn = $pin->readpindata($_SESSION['pid']); ?>
<?php
if ($pn != false) {
?>
<h1>UPDATE THE SECURITY PIN FOR YOUR VAULT</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Update unique key</li>
</ol>
<?php } else { ?>
<h1>Create your unique Key for your vault</h1>  
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

</div>
<!-- /.box-header -->
<div class="box-body">
<form role="form" method="post" action="check_email_otp.php" class="stckyForm" id="frmpin">
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
<label>Create PIN</label>
<?php
}
?>
<br>
<input type="checkbox" id="chngePin" name="txtPinActive" data-toggle="toggle">
<input type="hidden" id="ggg">
</div>
</div>-->
<div id="enableArea">
<!--<div class="col-md-12">
<div class="form-group">
<label class="step">Step 1:</label>
<hr class="">
</div>
</div>-->
<div class="col-md-12">
<?php

//print_r($pwd);
?>
<div class="col-md-4">
<div class="form-group" style="    margin-left: -15px;">
<label>Enter the code sent to your EMAIL</label>&nbsp;<?php
if($_GET['msg']=='not'){ ?>
<span style='color:red'>Wrong OTP.</span>
<?php }
?>
<input type="hidden" value="<?php echo  $pwd['pin']; ?>" id="curr_pwd">
<input type="text" class="form-control" id="check_email" name="code"  /><span id="error_pin" class="red"><span>
<span class="loginerrormsg black" ></span>
</div>
</div>



</div>



<!-- <div class="col-md-12 ">
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

<div class="col-md-12">
<div class="form-group">

</div>
</div>

<div class="col-md-8" style="float: right;margin-top: -64px;">
<input type="hidden" id="action" value="<?php echo $_GET['action']; ?>">

<input type="submit" name="btnemail" id="btnemail" value="Submit" class="btn btn-success">



</div>

<div class="col-md-12">


<input type="button" name="resendotp" id="resendotp" value="Resend" class="btn btn-success">



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

// $("#frmpin").submit(function(e) {
//    // alert('kkkkkk');
//     e.preventDefault();
// var curr_pwd = $("#curr_pwd").val();
// var current_pin = $("#current_pin").val();

// if (curr_pwd == current_pin) {

// } else {
// $("#error_pin").html("Current pin does not match");

// return false;
// }


// var txtConfirmPin = document.getElementById("txtConfirmPin").value;
// var txtPin = document.getElementById("txtPin").value;

// if (txtPin != txtConfirmPin) {

// $("#error").html("Password  does not match ");
// return false;
// e.preventDefault();
// }
// var code = document.getElementById("ggg").value;
// var inputCode = document.getElementById("codematch").value;
// if (code != inputCode) {
// document.getElementById("codematch").value = "";
// $("#verifycode").text("Code Inputted is Wrong. Please Input The Correct Code");
// return false;
// e.preventDefault();
// }

// });




});





function UpdateOtp() {
   // alert('=======');
			let txtOtp =$('#codematch').val();
            let codetst =$('#codetst').val();
            let txtPin =$('#txtPin').val();
            let txtConfirmPin =$('#txtConfirmPin').val();
            let txtClue =$('#txtClue').val();
            //alert(txtOtp);
           /// alert(codetst);

            if(txtOtp == codetst){

                $.ajax({ 
				url       : 'createpin.php', 
				type      : 'POST',
				data      : {txtOtp:txtOtp,
                            txtPin:txtPin,
                            txtConfirmPin:txtConfirmPin,
                            txtClue:txtClue,
                            btnCreatePin:true,
                            pid:'<?php echo $_SESSION['pid']; ?>'
                                },				
				success   : function(data) {
									//alert(data);
									$("#span2").html(data);

                                    window.location.href = data;

							}
			});		
  }
  else{
    $("#verifycode").html('Incorrect OTP');
  }
     }    


 $('#resendotp').click(function(){
      $.ajax({
        url: "resend_email.php",
        type: "post",
        data: {} ,
        success: function (response) {
			var aa=$.trim(response);
			if(aa==1){
		  $(".loginerrormsg").html("OTP Resend Successfully!");

			}
        }
    });
 });
				
 $('#btnemail').click(function(){
	let check_email =$('#check_email').val();
	if(check_email==""){
		$(".loginerrormsg").html("Pleasse Enter the code");
		return false;
	} else{
		$(".loginerrormsg").html("");
	}
	
    
 });   


</script>

</body>

</html>
