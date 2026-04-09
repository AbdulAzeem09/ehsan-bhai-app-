<?php
include('../univ/baseurl.php');
session_start();

if ($_SESSION['ptid'] != 1  && $_SESSION['ptid'] != 3) {
	//die('++++++000');
	header('location:' . $BaseUrl . '/business-directory-services/?category=A');
}


if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';  
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$activePage = 12;
$page = "dashboardPage";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?> 
<!-- owl carousel -->
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl; ?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- this script for slider art -->
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: false
}
}
});
});
</script>

</head>
<?php 
if(isset($_POST['btnsum'])){
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $arr=array(
      "business_address"=>$address,
      "business_email"=>$email,
      "business_phone"=>$phone
    );
  //print_r($arr);
  $bb44 = new _spprofiles;
  $reshsp = $bb44->shan_bb44($arr,$_SESSION['uid']);
  
  $_SESSION['contact1']='contact';
  }
?>
<?php 
$cc44 = new _spprofiles;
$resh44 = $cc44->shan_cc44($_SESSION['uid']);
$resh33 = mysqli_fetch_assoc($resh44);
$address=$resh33['business_address'];
$email=$resh33['business_email'];
$phone=$resh33['business_phone'];
?>
<body class="bg_gray">
<?php
include_once("../header.php");
?>

<?php

if($_SESSION['contact1']=='contact'){
  unset($_SESSION['contact1']);
  ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
swal("Updated Successfully!", "", "success");

</script>

<?php } ?>
<!-- Modal -->
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add News</h3>  
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl . '/business-directory/addnews.php'; ?>" id="addnew_form" method="post" class="">
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
Title<span class="red">*</span><span class="red" id="error_title"></span>
</label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
</div>
<div class="row">
<?php
$prof = new _spprofiles;
$result2 = $prof->chekProfileIsBusiness($_SESSION['uid']);
//echo $prof->ta->sql;
if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<div class="col-md-6">
<div class="checkbox">
<label><input type="checkbox" value="<?php echo $row2['idspProfiles']; ?>" name="profileCheck[]" <?php echo ($_SESSION['pid'] == $row2['idspProfiles']) ? 'checked' : ''; ?>><?php echo $row2['spProfileName']; ?></label>
</div>
</div>
<?php
}
}

?>

</div>
<div class="form-group">
<label for="recipient-name" class="control-label">
Description<span class="red">*</span><span class="red" id="error_desc"></span>
</label>
<textarea class="form-control no-radius" id="cmpanynewsDesc" name="cmpanynewsDesc"></textarea>
</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" id="btnsubmit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!--READALL NEWS-->
<div class="modal fade jobseeker" id="ReadNews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Update News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl . '/business-directory/updatenews.php'; ?>" method="post" class="">
<div id="updateNews"></div>
<div class="modal-footer" class="uploadupdate">
<button type="submit" class="btn btn-primary btn-border-radius">Update</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>
</div>

<section>
<div class="row no-margin">
<!-- <div class="col-md-3 no-padding">
<?php
//include('../component/left-business.php');
?>
</div>-->
<div class="col-md-12 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
<?php include('search-form.php'); ?>
<?php include('top-dashboard.php'); ?>
<div class="bg_white" style="padding: 60px;">

<div class="row" style="width: 700px;margin: auto;">
<div class="col-md-12 m_btm_15 ">

</div>

     




<div class="col-md-12">
 <div class="row">
 <form action="" method="post">
  <label for="fname">Our Address:</label><br>
  <input type="text" id="address" class="form-control" name="address" value="<?php echo $address ?>" ><br>
  <label for="lname">Email Us:</label><br>
  <input type="email" id="email" class="form-control" name="email" value="<?php echo $email ?>"><br>
  <label for="fname">Call Us:</label><br>
  <input type="text" id="phone" class="form-control" name="phone" value="<?php echo $phone ?>" ><br><br>
  <input type="submit" value="Update" name="btnsum" class="btn btn-primary btn-border-radius">
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
<div class="space-lg"></div>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
} ?>
  <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>





