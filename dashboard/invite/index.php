<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 202; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
body{

background-color: #eee; 
}
textarea#if_email {
resize: none;
}
</style>
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
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<div class="content">
<div class="col-sm-12 "> 

<div class="row">




<div class="col-sm-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">

<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Invite Friends</h4></span>


<div class="container-fluid">
<form action="<?php echo $BaseUrl . '/my-profile/invitefriend.php'; ?>" method="post" class="" id="form_submit">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-body">
<div class="form-group">
<label for="yourName" class="control-label contact">Your Name <span class="red">*</span></label>
<input type="text" class="form-control" id="yourName" value="<?php echo $_SESSION['MyProfileName']; ?>" readonly />
</div>
<div class="form-group">
<label for="sendTo" class="control-label contact">Send To <span style="font-size: 12px; color: red;">Add multiple emails by separating with Semicolon2 ;</span> <span class="red">*</span></label>
<textarea class="form-control" id="if_email" name="if_email" placeholder="" required=""></textarea>
</div>
<?php
$p = new _spprofiles;
$d = $p->inviteFrd_description(4);
if ($d) {
$ro = mysqli_fetch_array($d);
$notification_description = $ro['notification_description'];
//$subject = $ro['subject'];
}
?>
<div class="form-group">
<label for="txtmessage" class="control-label contact">Message <span class="red">*</span></label>
<textarea class="form-control" rows="7" id="if_message" name="if_message" required="">  <?php echo $notification_description ?>
   Thank you</textarea>
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<!--<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>-->
<button type="button" onclick="validateEmail()" class="btn btn-submit db_btn db_primarybtn" id="btn_submit"><i class="fa fa-user"></i> Invite Friends</button>
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

</div>
</div>
</div>

</div>
</div> 
</section>
<script>
$(document).ready(function() {
    function validateEmail() {
        var emailField = $('#if_email').val();
        console.log('Email field value:', emailField); // Debugging line
        return false;
        // Your validation and form submission logic here
        
        $('#form_submit').submit();
    }

    // Attach click event handler to the button
    $('.btn-submit').click(function() {
        validateEmail();
    });
});
</script>

<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

</body> 
</html>
<?php
} ?>

