    <?php



include('../../univ/baseurl.php');
session_start();
$_GET["module"] = "9";
$_GET["categoryid"] = "9";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "Events";
//$BaseUrl = 'http://localhost/the-share-page';
//include "../index.php";




//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

ini_set('upload_max_filesize', '1024M');
ini_set('post_max_size', '2048M');
ini_set('max_file_uploads ', '30');
ini_set('max_execution_time', '30000');

if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "events/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$header_event = "events";


if ($_SESSION['ptid'] == 1) {


$f = new _spuser;
$fil = $f->read1($_SESSION['pid']);
//print_r($fil);die("================");
if ($fil) {
$r = mysqli_fetch_assoc($fil);
//print_r($r); die("-----------------"); 
$pid = $r['sp_pid'];
//echo $pid;die('====');
if ($r['status'] != 2) {
header("Location: $BaseUrl/events/dashboard/?msg=notverified");
}
} else {
header("Location: $BaseUrl/events/dashboard/?msg=notverified");
}
}

if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}
//print_r()
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"];
$usercity = $ruser["spUserCity"];
}

?>

<html>

<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">
<meta name="author" content="">
<title>The SharePage</title>
<style>
#close {
display: none;
}

#output:hover+#close {
display: block;
}

span#car1 {
margin-top: 11px;
}

span.caret.caret_t {
margin-top: -5px;
}

#profileDropDown li.active {
background-color: #c11f50 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}

button#indent {
padding: 9px;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover{
    background-color: #ffb8bd !important;
}
.nav-tabs>li>a{
    color:black !important;
}
</style>
<link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">
<!--  <link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/logo-black.png' ?>" sizes="16x16" type="image/png"> -->
<!--Bootstrap core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="<?php echo $BaseUrl; ?>/assets/css/images-style.css" rel="stylesheet" type="text/css">

<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<?php
$aa = rand(10, 100); ?>
<!--<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>-->

<script src="<?php echo $BaseUrl; ?>/assets/js/posting/event.js?<?php echo $aa; ?>"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">


<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script src="<?php echo $BaseUrl; ?>/assets/js/posting/script.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
//This condition will check if form with id 'contact-form' is exist then only form reset code will execute.
if ($('#sp-create-album').length > 0) {
$('#sp-create-album')[0].reset();
}
});
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});

});
$(function() {
$('#rightmenu').multiselect({
includeSelectAllOption: true
});
});
$(function() {
$('#cohost').multiselect({
includeSelectAllOption: true
});
});
</script>
<script src="//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initialize"></script>
<script src="<?php echo $BaseUrl . '/assets/js/jquery.geocomplete.js'; ?>"></script>
<!--  <script>
$(function(){
$("#spPostingEventVenue_").geocomplete();
});
</script> -->

<!--   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
$(".datepicker").datepicker({
minDate: 0,
dateFormat: 'yy-mm-dd'
});
});
</script>

<?php
$urlCustomCss = $BaseUrl . '/component/custom.css.php';
include $urlCustomCss;
?>

<style type="text/css">
ul.multiselect-container.dropdown-menu {
height: 120px;
overflow: scroll;
overflow-x: hidden;
}

.multiselect-container>li>a>label {
margin: 0;
height: 25%;
cursor: pointer;
font-weight: 400;
padding: 3px 20px 3px 40px;
}

.ui-widget-header {
background-color: #ffb8bd !important;
}


input[type=time]::-webkit-inner-spin-button,
input[type=time]::-webkit-outer-spin-button {
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
margin: 0;
}

.upload-btn-wrapper {
position: relative;
overflow: hidden;
display: inline-block;
}

.btns {
border: 2px solid gray;
color: gray;
background-color: white;
padding: 5px 10px;
border-radius: 8px;
font-size: 15px;
font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
font-size: 100px;
position: absolute;
left: 0;
top: 0;
opacity: 0;
}





/*
input[type=time]::-webkit-datetime-edit-ampm-field {
display: none;
}
input[type=time]::-webkit-clear-button {
-webkit-appearance: none;
-moz-appearance: none;
-o-appearance: none;
-ms-appearance:none;
appearance: none;
margin: -10px; 
}*/

.sponsorimg {
width: 100px !important;
height: 100px !important;
}

h3.sponser-title {
margin-bottom: 20px;
}

.footer-button-block {
margin-bottom: 20px;
}

.sponser_menu {
margin-bottom: 0px !important;
}
</style>

</head>

<body onload="pageOnload('post')">
<div class="loadbox">
<div class="loader"></div>
</div>
<?php

include_once("../../header.php");

$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
if ($res != false) {
$r = mysqli_fetch_assoc($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];
} else {
$name = "Select Profile";
$icon = "<i class='fa fa-user'></i>";
}

///////////////////////  for subscription

$p = new _spprofiles;

$res = $p->read($_SESSION['pid']);
if ($res != false) {

$r = mysqli_fetch_assoc($res);
//echo "<pre>";
//print_r($r);
$name = ucwords(strtolower($r['spProfileName']));
$icon = $r['spprofiletypeicon'];
$spdate_created = $r['spdate_created'];
$Date =  $spdate_created;
$date1 =  strtotime($Date);

$date2 =  date('Y-m-d H:i:s');
$date3 = strtotime($date2);
//echo $date1."<br>".$date3; 



$datediff = $date3  -  $date1;
//echo "<br>";
$final_date = round($datediff / (60 * 60 * 24));
if (empty($_GET['postid'])) {
if ($_SESSION['ptid'] == 1) {
if (($final_date >= 90)) {
$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);

if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
//print_r($rows);
$payment_date = $rows["createdon"];

$res = $mb->readmember($rows["membership_id"]);

if ($res != false) {
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
$count = $row["spMembershipPostlimit"] . "<br>";
$duration = $row["spMembershipDuration"];

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8 = date('Y-m-d', strtotime($date7));
$date5 = date('Y-m-d', strtotime($payment_date));
$date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
// echo   $date5."<br>".$date6."<br>".$date8; 
if (!(($date5 <= $date8)  && ($date6 >=  $date8))) { ?>
<script>
window.location.replace("/membership?msg=notaccess");
</script>

<?php   }
}
}
} else {

$mb = new _spmembership;
$result_1 = $mb->read_event($_SESSION['pid']);
$num = 0;
if ($result_1) {
$num = mysqli_num_rows($result_1);
}

if ($num >= 2) {


?>

<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php

}
}
}
}
}
}



?>
<!--Add album size-->

<!--     <button data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn ">Add Sponsor</button> -->


<div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="loadbox">
<div class="loader"></div>
</div>

<div class="modal-dialog" role="document">


<div class="modal-content sharestorepos no-radius bradius-15" style="border-radius: 15px!important;">
<form action="../../events/dashboard/createsponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
<div class="modal-header  bg-white br_radius_top" style="border-top-left-radius: 15px!important;border-top-right-radius: 15px!important;background-color: #fff!important;">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor6</b></h4>
</div>
<div class="modal-body">


<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="row">


<div class="col-md-6">
<div class="form-group">

<label for="sponsorTitle">Company<span style="color:red;">*</span></label>

<input type="text" class="form-control sponser_menu" id="sponsorTitle" name="sponsorTitle" value="" onkeyup="keyupsponsorfun()" />
<span id='span1' style="color:red;"></span>
<span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>

<input type="text" class="form-control sponser_menu" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />
<span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>

</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spsponsorPrice">Price<span style="color:red;">*</span></label>

<input type="number" class="form-control sponser_menu" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" min="0" onkeyup="keyupsponsorfun()" />
<span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Category<span style="color:red;">*</span></label>
<select class="form-control sponser_menu" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
<option value="">Select Category</option>
<option class="General">General</option>
<option class="Prime">Prime</option>
<option class="Platinum">Platinum</option>
<option class="Gold">Gold</option>
<option class="Silver">Silver</option>
<option class="Media">Media</option>
</select>
<span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
<textarea class="form-control sponser_menu" name="sponsorDesc" id="spsponsorDesc" maxlength="500" onkeyup="keyupsponsorfun()"></textarea>
<span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spSponsorPic">Add Logo
<!--<span style="color:red;">*</span>-->
</label>

<input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
<span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<!--<p class="help-block"><small>Browse files from your device</small></p>-->
</div>
</div>
<div class="col-md-9" style="padding-left: 130px;">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>


<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview">

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div class="modal-footer bg-white br_radius_bottom" style="border-bottom-left-radius: 15px!important;border-bottom-right-radius: 15px!important;background-color: #fff!important;">
<button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal" style="background: #fab318!important;border-radius: 30px!important;color:#fff;">Close</button>
<button id="addSponser" type="submit" class="btn btn-primary db_btn db_primarybtn" style="background: #032350!important;border-radius: 30px!important;">Add</button>
</div>
</form>
</div>
</div>
</div>



<div class="modal fade" id="sponsorAddModala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos no-radius">
<form action="../../album/createsponsor.php" method="post" id="sp-create-album" class="no-margin">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor7</b></h4>
</div>
<div class="modal-body">

<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="sponsorTitle">Sponsor Name</label>
<input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="" required />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website</label>
<input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" required />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsor_idspProfile">Profile</label>
<select class="form-control" name="sponsor_idspProfile">
<?php
$b = array();
$r = new _spprofilehasprofile;
$pv = new _postingview;
$res = $r->readall($_SESSION["pid"]); //As a receiver
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$p = new _spprofiles;
$sender = $rows["spProfiles_idspProfileSender"];
array_push($b, $sender);
$result = $p->read($rows["spProfiles_idspProfileSender"]);
//echo $p->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
echo "<option value='" . $rows["spProfiles_idspProfileSender"] . "'  >" . $row["spProfileName"] . "</option>";
}
}
}
//show profile as sender
$r = new _spprofilehasprofile;
$res = $r->readallfriend($_SESSION["pid"]); //As a sender
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
if ($rm == "") {
$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];
$row = mysqli_fetch_assoc($result);
echo "<option value='" . $rows["spProfiles_idspProfilesReceiver"] . "' >" . $row["spProfileName"] . "</option>";
}
}
}
}
?>

</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Sponsorship Category</label>
<select class="form-control" name="sponsorCategory">
<option class="General">General</option>
<option class="Prime">Prime</option>
<option class="Platinum">Platinum</option>
<option class="Gold">Gold</option>
<option class="Silver">Silver</option>
<option class="Media">Media</option>
</select>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label for="sponsorDesc">Short Description</label>
<textarea class="form-control" name="sponsorDesc"></textarea>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spSponsorPic">Add Logo</label>
<input type="file" class="sponsorPic" name="spSponsorPic">
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>
<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview">

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button id="spaddSponsor" type="submit" class="btn btn-primary">Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->
<!--Album creation modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos no-radius">
<form action="../../album/createalbum.php" method="post" id="sp-create-album" class="no-margin">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Create New Album</b></h4>
</div>
<div class="modal-body">

<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="sppostingalbumFlag" value="<?php echo $_GET["module"]; ?>">

<div class="form-group">
<label for="spAlbumName" class="control-label contact">Album Name</label>
<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
</div>

<div class="form-group">
<label for="spAlbumDescription" class="contact">Details about your event</label>
<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button id="spaddalbum" type="submit" class="btn btn-primary">Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->
<!--Exhibition creation modal-->
<div class="modal fade" id="newExhibition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos no-radius">
<form action="../../album/createxhibition.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id=""><b>Create New Exhibition</b></h4>
</div>
<div class="modal-body">

<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="spExhibitionImage" name="spExhibitionImage" value="">

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spExhibitionTitle" class="control-label contact">Title</label>
<input type="text" class="form-control" id="spExhibitionTitle" name="spExhibitionTitle">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spStartDate" class="control-label contact">Starting Date</label>
<input type="date" class="form-control" id="spStartDate" name="spStartDate">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spEndDate" class="control-label contact">Ending Date</label>
<input type="date" class="form-control" id="spEndDate" name="spEndDate">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spExhibitionVenu" class="control-label contact">Venu</label>
<input type="text" class="form-control" id="spExhibitionVenu" name="spExhibitionVenu">
</div>
</div>
</div>


<div class="form-group">
<label for="spExhibitionDesc" class="contact">Description</label>
<textarea class="form-control" id="spExhibitionDesc" name="spExhibitionDesc"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button id="spaddexhibition" type="submit" class="btn btn-primary">Create</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->
<section>
<div class="container-fluid">
<div class="row">
<div class="col-md-3 no-padding">
<div class="left_artform" id="leftArtFrm" style="min-height: 1400px;">
<img src="<?php echo $BaseUrl; ?>/assets/images/art/left-art-form.jpg" class="img-responsive" alt="" />
</div>
</div>
<div class="col-md-9">

<div class="row">
<div class="col-md-12">
<form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostevent1.php" method="post" id="sp-form-post" name="postform">
<div class="event_form">
<!--<div class="modTitle" >

<h2><span>Events</span></h2>
</div>-->
<h3>
<i class="fa fa-pencil"></i><?php echo (isset($_GET["postid"]) ? " Update an event " : " Submit an event ") ?>
<a href="<?php echo $BaseUrl . '/events'; ?>" class="pull-right" style="color: #000;">&nbsp; | &nbsp;Back to Home </a><a href="<?php echo $BaseUrl . '/events/dashboard/'; ?>" class="pull-right" style="color: #000;">DASHBOARD </a>
</h3>
<?php if ($_GET['groupid']) {   ?>
<input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>">

<?php } else { ?>
<input type="hidden" name="groupid" value="0">

<?php } ?>

<div class="add_form_body form-body">

<div class="">
<div class="">
<div>
<div class="row no-margin">
<div class="col-md-12 no-padding">

</div>

<div class="col-md-6 text-right">
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercountry) && $usercountry == $row3['country_id']) {
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];
}
}
}

if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {
if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}
if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
}

/*	if(!$_GET['postid']){		
?>

<p><small>Current Location: <?php echo $currentcountry.', '.$currentstate.', '.$currentcity ; ?>
<br>
<a style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>
</p><?php } */ ?>
</div>



</div>
</div>
<!-- <div class="space"></div> -->
<div>
<?php
$profileid = "";
$eCountry = "";
$eCity = "";
$eCityID = "";
$eCategory = "";
$eSubCategoryID = "";
$eSubCategory = "";
$ePostTitle = "";
$ePostNotes = "";
$eExDt = "";
$ePrice = "";
$shipping = "";
$layoutpic = "";

if (isset($_GET["postid"])) {
//$p = new _postingview;
$p = new _spevent;
$r = $p->read($_GET["postid"]);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {

// echo "<pre>";
//print_r($row);
echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
$ePostTitle = $row["spPostingTitle"];
$layoutpic = $row["spPostingPic"];
$ePostNotes = $row["spPostingNotes"];
$specification = $row["specification"];
$eExDt = $row["spPostingExpDt"];
$ePrice = $row["spPostingPrice"];
$profileid = $row['idspProfiles'];
$postingflag = $row['spPostingsFlag'];
$phone = $row['spProfilePhone'];
$shipping = $row['sppostingShippingCharge'];
$eCountry = $row['spPostingsCountry'];
$eCity = $row['spPostingsCity'];

//$eCity = $row['spUserCity'];
$hallcapacity = $row['hallcapacity'];
$eventpaymenttype = $row['event_payment_type'];
$registration_req = $row['registration_req'];



$eState = $row['spPostingsState'];
$eeventaddress =	$row['eventaddress'];

// $pf  = new _postfield;
//$result_pf = $pf->read($_GET['postid']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){*/

//$organizerId = "";
$venu = "";
$hallcapicty = "";
$ticketCapty = "";
$spStartDate = "";
$spEndDate   = "";
$srtTime     = "";
$endTime     = "";
// $category    = "";

$category = $row['eventcategory'];
$organizerId = $row['spPostingEventOrgId'];
$organizerName = $row['spPostingEventOrgName'];
$venu = $row['spPostingEventVenue'];
$hallcapicty = $row['hallcapacity'];
$ticketCapty = $row['ticketcapacity'];
$spStartDate = $row['spPostingStartDate'];
$spEndDate = $row['spPostingExpDt'];
$srtTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$sponsorIds = $row['sponsorId'];

}
}
}
$p = new _spprofiles;
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

if ($res != false) {
$r = mysqli_fetch_assoc($res);
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
}


if ($eCountry == "") {
$eCountry = $usercountry;
}
if ($eState == "") {
$eState =  $userstate;
}
if ($eCity == "") {
$eCity =  $usercity;
}

?>
<?php
$c = new _spuser;
$cu = $c->readcurrency($_SESSION['uid']);
$cur = mysqli_fetch_assoc($cu);
$currency = $cur['currency'];

?>
<div class="row">
<div class="col-md-12">

<input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) {
echo $_GET["postid"];
} ?>">

<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">


<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">

<?php
$p = new _album;
$pid = $_SESSION['pid'];
$albumid = $p->timelinealbum($pid);
?>
<input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
<?php
if (isset($_GET["postid"])) {
echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
}
?>
<!--Art Gallery-->
<!--Art Gallery complete-->
<div class="row no-margin">

<div class="row category-section">

<!--<div class="col-md-6">
<div class="form-group">
<label for="eventcategory_" class="lbl4">Currency <span style="color:red;">*</span> <span id="lbl4" class="label_error"></span></label>-->
<input id="default_currency" name="default_currency" readonly class="form-control" type="hidden" value="<?php echo $currency; ?>">

<!--</div>
</div>-->
<script>
function evcat() {
document.getElementById("lbl_4").innerText = "";
}
</script>
<div class="col-md-6">
<div class="form-group">
<label for="eventcategory_" class="lbl_5">Category<span style="color:red;">*</span> <span id="lbl_4" class="label_error"></span></label>
<select class="form-control spPostField" data-filter="1" onchange="evcat()" id="eventcategory_" name="eventcategory" value="<?php echo (empty($category) ? "" : $category); ?>">
<option value="">Select Category</option>
<?php
$m = new _eventCategory;
$catid = 9;
$result = $m->readAll($catid);


if ($result) {
while ($rows = mysqli_fetch_assoc($result)) {


?>
<option value='<?php echo $rows["speventTitle"]; ?>' <?php if (trim($category) == trim($rows["speventTitle"])) {
echo 'selected';
} ?>><?php echo $rows["speventTitle"]; ?></option>
<?php
}
}
?>

</select>
</div>
</div>




</div>




<div class="col-md-12 no-padding">

<div class="row">
<div class="col-md-6">
<div class="form-group">
<script>
function evtitle() {
document.getElementById("lbl_1").innerText = "";
}
</script>
<label for="spPostingTitle" class="lbl_1">Event Title <span style="color:red;">*</span> <span id="lbl_1" class="label_error"></span> <span style="color:blue;font-weight: 500;font-size: 11px;">(Max 60 characters)</span></label>
<input type="text" class="form-control" id="spPostingTitle" maxlength="60" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder="" onkeyup="evtitle()" onkeypress="lettersNumbersCheck('spPostingTitle');" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingNotes">Write a catchy phrase for your event<span style="color:blue;font-weight: 500;font-size: 11px;"> (Max 100 characters)</span></label>
<input type="textarea" class="form-control" id="specification" name="specification" maxlength="100" value="<?php echo $specification; ?>">

</div>
</div>
</div>

<div class="row">

<div class="col-md-12">
<div class="form-group">

<label for="spPostingNotes">Event Description</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>

<textarea class="form-control" style="display:none;" id="spPostingNotes" name="spPostingNotes" maxlength="1500"><?php echo $ePostNotes ?> </textarea>
<div id="editor-container" style=" height: 135px; "><?php echo $ePostNotes ?></div>
<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{
header: [1, 2, false]
}],
['bold', 'italic', 'underline']
]
},
theme: 'snow' // or 'bubble'
});


quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML;
//alert(editor_content);
document.getElementById("spPostingNotes").value = editor_content;
});
</script>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-bottom:20px">
        <label>Location</label>
            <ul class="nav nav-tabs">
                <li onclick="event_platform('Venu');" class="active"><a data-toggle="tab" href="#tab1">Venu</a></li>
                <li onclick="event_platform('Online_event');"><a data-toggle="tab" href="#tab2">Online event</a></li>
                <li onclick="event_platform('To_be_announced');"><a data-toggle="tab" href="#tab3">To be announced</a></li>
            </ul>
        <input type="hidden" name="event_platform_title" class="event_platform_title" value="">
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="spPostingCountry" class="lbl_2">Country <span style="color:red;">*</span> <span id="lbl_2" class="label_error"></span></label>
                            <select id="spUserCountry" class="form-control " name="spPostingsCountry">
                            <option value="0">Select Country</option>
                            <?php
                            $co = new _country;
                            $result3 = $co->readCountry();
                            if ($result3 != false) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                            ?>
                            <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($eCountry) && $eCountry == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
                            <?php
                            }
                            }
                            ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="loadUserState">
                            <label for="spUserState" class="lbl_3">State <span style="color:red;">*</span> <span id="lbl_3" class="label_error"></span></label>
                            <select class="form-control" name="spPostingsState" id="spUserState">
                            <option value="0">Select State</option>
                            <?php
                            if (isset($eState) && $eState > 0) {
                            $countryId = $eCountry;
                            //echo CURDATE();					die;														//echo $countryId;die;
                            //echo $eState.'<br>'; 																	$pr = new _state;
                            $pr = new _state;
                            $result2 = $pr->readState($countryId);
                            //var_dump($result2);
                            if ($result2 != false) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                            //print_r($row2);
                            echo $row2['state_id'];
                            ?>
                            <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($eState) && $eState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                            <?php
                            }
                            }
                            }
                            ?>
                            </select>                       
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="loadCity">
                        <!--   <div class="form-group"> -->
                            <label for="spPostingCity">City</label>
                            <select class="form-control" name="spPostingsCity" id="spPostingsCity">
                            <option value="0">Select City</option>
                            <?php
                            if (isset($eCity) && $eCity > 0) {
                            $stateId = $eState;
                            $co = new _city;
                            $result3 = $co->readCity($stateId);
                            //var_dump($result3);																						//print_r($result3);
                            //echo $co->ta->sql;
                            if ($result3 != false) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                            //print_r($row3);																							
                            ?>
                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($eCity) && $eCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                            }
                            }
                            } ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
                            <!--  </div> -->
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <p>Online events have unique event pages where you can add links to livestreams and more</p>
                </div>
                <div id="tab3" class="tab-pane fade"></div>
            </div>
        </div>

<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostingCountry">Country</label>
<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) && $eCountry != '') ? $eCountry : $country; ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">Location/City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) && $eCity != '') ? $eCity : $city; ?>">
</div>
</div> -->

</div>


<div class="addcustomfields">
<!--add custom fields-->
<?php
if (isset($_GET["postid"])) {
$f = new _postfield;
$res = $f->field($_GET["postid"]);
if ($res != false) {
while ($result = mysqli_fetch_assoc($res)) {
$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
}
}
}

include("../event.php");

?>
<!--Getcustomfield-->
</div>



</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="col-md-3">

<div class="form-group">

<label for="postingpic">Upload Poster(s)</label>
<input type="file" class="postingpic" id="filesaaa" name="spPostingPic">
<label id="lbl_55" class="label_error"></label>
<p class="help-block"><small>Browse files from your device</small></p>
</div>

</div>
<div class="col-md-9">
<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview">
<?php
//$i = 1;
$pic = new _eventpic;
if (isset($_GET['postid'])) {
$res = $pic->read($_GET["postid"]);
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$picture = $rows['spPostingPic'];
//echo $picture;
if ($rows['spFeatureimg'] == 1) {
$select = "checked";
} else {
$select = '';
}
echo "<div class='col-md-3 imagepost'><span class='fa fa-remove dynamicimg closed' style=''   data-work='event_1' data-aws='6' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage 111' style='height: 120px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
$i++;
}
}
}
?>
</div>

</div>
</div>
<script>
function remove() {
document.getElementById("filesaaa").value = "";
}
</script>

<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
</div>
</div>
<div class="col-md-6">
<label for="html">Make Feature Event(35 USD) </label>
  <input type="radio" id="featureyes" name="feature" value="1">
  <label for="featureyes">Yes</label>
  <input type="radio" id="featureno" name="feature" value="0" checked>
  <label for="featureno">No</label>
</div>
</div>
<div class="col-md-12">
<div class="col-md-3">
<div class="form-group">
<label for="postingpica">Upload Seating Layout</label>
<input type="file" id="filesaaass" name="spPostingPicaaas[]" onchange="loadFile(event)">
<label id="lbl_56" class="label_error"></label>
<p class="help-block"><small>Browse files from your device</small></p>
</div>

</div>
<script>
var loadFile = function(event) {

var layout = $('#layout').attr('src');
if (layout) {

document.getElementById("layout").style.display = "block";

var reader = new FileReader();
reader.onload = function() {
var output = document.getElementById('layout');
output.src = reader.result;
};
reader.readAsDataURL(event.target.files[0]);

} else {

document.getElementById("output").style.display = "block";
document.getElementById("close").style.display = "block";
var reader = new FileReader();
reader.onload = function() {
var output = document.getElementById('output');
output.src = reader.result;
};
reader.readAsDataURL(event.target.files[0]);

}

};
</script>

<script>
$(document).ready(function() {
$("#close").click(function() {
$('#output').attr('src', '');
$("#filesaaass").val('');
$("#output").css("display", "none");
$("#close").css("display", "none");
});
});
</script>
<div class="form-group">
<label for="postingPicPreview" style="margin-left:15px;">Seating Layout Preview</label>
<div id="imagePreview"> </div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview">
<?php
$pic = new _eventpic;
$res2 = $pic->readlayout($_GET['postid']);

if (isset($_GET['postid'])) {
if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
//print_r($rp);
$pic2 = $rp['spPostingPic'];
$id = $rp['idspPostings'];
if($pic2){
echo "<div class='col-md-2 imagepost'><span style='margin-right:10px;' class='fa fa-remove dynamicimg closed'  data-work='seatlayout' data-aws='6' data-src='" . $pic2 . "'  data-pic='" . $id . "'></span><img  id='layout' class='overlayImage 22' style='width:100%; height: 120px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($pic2) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['id'] . "'></div>";
}
}
} else {
}
}
?>




<div class="col-md-2">
<span id="close" style=" font-size:15px;  position: absolute; color:white; border-radius:50px; padding:2px; background-color:black; top: -2px; left: 102px;"><i class="fa fa-remove"></i></span>
<img id="output" class="overlayImage 55" height="100" width="100" style="display:none;    border: 2px solid #717171; border-radius: 5px;">
</div>
</div>
</div>
</div>
<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
</div>
</div>

<div class="col-md-12">
<div class="col-md-3">
<div class="form-group">
<label for="postinggallerypic">Upload Images For Gallery</label>
<input type="file" onchange="loadFil(event)" id="Gallery" name="spPostingGallery[]" multiple>
<label id="lbl_57" class="label_error"></label>
<p class="help-block"><small>Browse files from your device</small></p>
</div>

</div>
<script>
var loadFil = function(event) {
document.getElementById("outpu").style.display = "block";
document.getElementById("clos").style.display = "block";
var reader = new FileReader();
reader.onload = function() {
var outpu = document.getElementById('outpu');
outpu.src = reader.result;
};
reader.readAsDataURL(event.target.files[0]);
};
</script>
<script>
$(document).ready(function() {
$("#clos").click(function() {
$('#outpu').attr('src', '');
$("#Gallery").val('');
$("#outpu").css("display", "none");
$("#clos").css("display", "none");
});
});
</script>


<div class="form-group">
<label for="postingPicPreview" style="margin-left:15px;">Gallery Preview</label>
<div id="imagePreview"> </div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview">
<?php
$pic = new _eventpic;
$res2 = $pic->readGallery($_GET['postid']);

if (isset($_GET['postid'])) {
if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['image_name'];
echo "<div class='col-md-2 imagepost'><span style='' class='fa fa-remove dynamicimg closed'  data-work='event' data-aws='6' data-src='" . $pic2 . "'  data-pic='" . $rp['id'] . "'></span><img class='overlayImage 44' style='width:100%; height: 120px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($pic2) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['id'] . "'></div>";
}
} else {
}
}
?>


<div class="col-md-2">
<span id="clos" style=" font-size:15px;display:none;  position: absolute; color:white; border-radius:50px; padding:2px; background-color:black; top: -2px; left: 102px;"><i class="fa fa-remove"></i></span>
<img id="outpu" class="overlayImage 11" height="100" width="100" style="display:none;border: 2px solid #717171; border-radius: 5px;">
</div>
</div>
</div>
</div>
<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
</div>

</div>



</div>
<script>
$(document).ready(function() {
$('.closed').click(function() {
var pic = $(this).data('pic');
// alert(pic);
});


})



function deleslayoutpic(postid) {
var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);
form_data.append('work', 'deletelayout');
$.ajax({
url: "<?php echo $BaseUrl ?>/post-ad/addeventpiclayout.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});
}
</script>
</div>

<div class="col-md-12">
<h3 class="sponser-title">Sponsor Information</h3>
<div class="row sponsorInfo ">
<div class="col-md-12">
<div class="form-group add_spon">
<!-- (<a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal">Add Sponsor</a>) -->
<div class="col-md-12">
<div class="col-md-6">

<label for="sponsorId_">Select Sponsor <span style="color:red"></span><span id="lbl_20" class="label_error"></span></label>
<select id="rightmenu" class="sp_Sponsor form-control spPostField " name="sponsorId[]" multiple="multiple" style="width: 100%;" >

<?php
$splinkp = new _speventlinkperson;
$selectedSpon = "";
$allSponsor = array();
if ($sponsorIds != '') {
$allSponsor = explode(",", $sponsorIds);
}
$sp = new _sponsorpic;
$result2 = $sp->readAll($_SESSION['pid']);
//echo $sp->ta->sql;
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {
if (in_array($row2['idspSponsor'], $allSponsor)) {
$spSelect = "selected";
$selectedSpon .= $row2['sponsorTitle'] . "<br>";
} else {
$spSelect = '';
}
echo "<option value='" . $row2['idspSponsor'] . "' " . $spSelect . ">" . ucwords(substr($row2['sponsorTitle'], 0, 5)) . "</option>";
}
}
?>
</select>

<a data-toggle="modal" style="margin-left:20px;    text-decoration: underline;cursor: pointer;" data-target="#sponsorAddModal">Add Sponsor</a>
</div>
<div class="col-md-6">


</div>
</div>

<?php
if ($selectedSpon != "") {
?>
<div class="col-md-6">
<label for="spPostingCohost_">Selected Name</label>
<br>
<?php echo $selectedSpon; ?>
</div>
<?php
}
?>


</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">

</div>
<div class="col-md-6">

</div>
</div>
<!--complete-->
</div>
</div>

</div>
</div>


</div>
</div>

</div>
<div class="col-md-12">
<div class="col-md-12">
<div class="row no-margin">
<div class="hidden">


<!-- <div class="btn-group">-->
<!--<button id="spPostSubmit" type="submit" class="btn btn-success">Public Post</button>-->
<!-- <button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>

<button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" style="height: 34px;"><span class="caret"></span></button>
<ul class="dropdown-menu posttype">
<li><a id="postpublic" style="cursor:pointer;">Public</a></li>
<li><a id="postgroup" style="cursor:pointer;">Group</a></li>
</ul> -->
<!-- </div> -->
</div>
<div class="col-md-4">
<div id="sp-group-container" class="input-group hidden">
<input class="form-control" id='group_' name="group_" type="text" placeholder="Type to Select Group...">

<span class="input-group-btn">
<!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
<a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
</span>
</div>
</div>
<div class="col-md-8 text-right footer-button-block">
<?php
if (isset($_GET["postid"])) {
/* echo "<a class='btn butn_draf' style='border-radius: 30px!important;' href='../deletePost.php?postid=" . $_GET['postid'] . "'>Delete post</a>";*/
}
?>
<a href="<?php echo $BaseUrl . '/events'; ?>" style="background-color:red!important" class="btn butn_cancel cancelpostbtn">Cancel</a>
<!-- this is preview button -->
<!--  <button type="submit" id="preview" class="btn butn_preview previewbtn">Preview</button> -->
<!-- <button id="spPostSubmit" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button> -->
<?php if (!isset($_GET['postid'])) {  ?>
<button style="color: black;background-color:#ffb8e5"  type="submit"  name="submit"  value="Save As Draft" class="btn butn_draf savedraftbtn">Save As Draft</button>

<?php
}
if ($_GET['draft'] == 1) {


?>
<button type="submit" style="background-color:#c11f50!important" class="btn butn_save savesubmitbtn <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button>
<?php


} else { ?>
<button  type="submit" value="" style="background-color:#c11f50!important" class="btn butn_save savesubmitbtn <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Update" : "Submit") ?></button>

<?php } ?>



<!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->
</div>
</div>
</div>
</div>
</form>
</div>



</div>
</div>
</div>
</div>

<!--<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"
<form method="post">
<div class="modal-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spUserCountry" id="spUserCountry" >
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> 
</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spUserState">
<option>Select State</option>
<?php
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City</label>
<select class="form-control" name="spUserCity" >
<option>Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?> ><?php echo $row3['city_title']; ?></option> <?php
}
}
} ?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
</div>
</div>
</div>
<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostingCountry">Country</label>
<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">Location/City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
</div>
</div> 

</div>
</div>
<div class="modal-footer">
<input type="submit" value="Change" class="btn btn-primary">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</form>
</div>

</div>
</div>-->
</section>
<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>
<!-- notification js -->
<div class="retail-wholesheller">
</div>
<script type="text/javascript">
$(function() {
$('#spPostingPrice').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});
$('#hallcapacity_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}


});

$('#ticketcapacity_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}

});



$('#spPostingPrice').on('mouseleave', function(e) {

var PostingPrice = $("#spPostingPrice").val();
if (PostingPrice != "") {
var regEx = /^[0-9]+$/;
if (PostingPrice.match(regEx)) {
return true;
} else {
alert("Please enter numbers only in Price.");
$("#spPostingPrice").val('');
return false;
}
}

});

$('#hallcapacity_').on('mouseleave', function(e) {

var hallcapacity = $("#hallcapacity_").val();
if (hallcapacity != "") {
var regEx = /^[0-9]+$/;
if (hallcapacity.match(regEx)) {
return true;
} else {
alert("Please enter numbers only in Hall Capacit.");
$("#hallcapacity_").val('');
return false;
}
}

});

$('#ticketcapacity_').on('mouseleave', function(e) {

var ticketcapacity = $("#ticketcapacity_").val();
if (ticketcapacity != "") {
var regEx = /^[0-9]+$/;
if (ticketcapacity.match(regEx)) {
return true;
} else {
alert("Please enter numbers only in Ticket Capacity.");
$("#ticketcapacity_").val('');
return false;
}

}
});


});
</script>


<script type="text/javascript">
function lettersNumbersCheck(name) {
var regEx = /^[0-9a-zA-Z]+$/;
if (document.postform.name.value.match(regEx)) {
return true;
} else {
alert("Please enter letters and numbers only.");
return false;
}
}

function Endtimecheck() {
var starttime = $('#spPostingStartTime_').val();


alert(starttime);

}

var endtime = document.getElementById('spPostingEndTime_');

var starttime = document.getElementById('spPostingStartTime_');

function onTimeChange() {
/*  var timeSplit = endtime.value.split(':'),
endhours,
endminutes,

var timeSplit2 = starttime.value.split(':'),
starthours,
startminutes,

starthours = timeSplit2[0];
startminutes = timeSplit2[1];

if(starthours > endhours ){

alert(start houer is greter)

}else{

alert(start houer is greter) 

}*/
/*if (hours > 12) {
meridian = 'PM';
hours -= 12;
} else if (hours < 12) {
meridian = 'AM';
if (hours == 0) {
hours = 12;
}
} else {
meridian = 'PM';
}*/
/*  alert(hours + ':' + minutes + ' ' + meridian);*/
}





$(function() {
$("#spPostingStartDate_").datepicker({
numberOfMonths: 2,
onSelect: function(selected) {
var dt = new Date(selected);
dt.setDate(dt.getDate() + 1);
$("#spPostingExpDt").datepicker("option", "minDate", dt);
}
});
$("#spPostingExpDt").datepicker({
numberOfMonths: 2,
onSelect: function(selected) {
var dt = new Date(selected);
dt.setDate(dt.getDate() - 1);
$("#spPostingStartDate_").datepicker("option", "maxDate", dt);
}
});
});
</script>

<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript">
function keyupsponsorfun() {

//alert($result2);
//alert();

var company = $("#sponsorTitle").val()

var Website = $("#sponsorWebsite").val()
var Price = $("#spsponsorPrice").val()
var category = $("#sponsorCategory").val()
var Description = $("#spsponsorDesc").val()
var sponsorImage = $("#sponsorImg").val()

//alert(category);
//alert(category.length);

if (company != "") {
$('#sponsorTitle_error').text(" ");
$.ajax({
type: "POST",
url: "<?= $BaseUrl; ?>/post-ad/sponsor_check.php",
cache: false,
data: {
'company': company
},
success: function(data) {
if (data == 1) {
$("#span1").html("Enter Unique Name");
return false;

}

//$("#"+ev_file).html(" ");
}
});

}
if (Website != "") {
$('#sponsorWebsite_error').text(" ");
}
if (Price != "") {
$('#spsponsorPrice_error').text(" ");

}
if (category.length != 0) {
$('#sponsorCategory_error').text(" ");

}
if (Description != "") {
$('#spsponsorDesc_error').text(" ");
}
if (sponsorImage != "") {
$('#sponsorImg_error').text(" ");

}


}
$('#sp-form-post').on('keyup keypress', function(e) {
var keyCode = e.keyCode || e.which;
if (keyCode === 13) {
e.preventDefault();
return false;
}
});

$('body').on('keydown', 'input, select', function(e) {
if (e.which === 13) {
var self = $(this),
form = self.parents('form:eq(0)'),
focusable, next;
focusable = form.find('input').filter(':visible');
next = focusable.eq(focusable.index(this) + 1);
if (next.length) {
next.focus();
}
return false;
}
});
$('#ticketcapacity_').on('mouseleave', function(e) {
var hallcapacity = $('#hallcapacity_').val();
var ticketcapacity = $('#ticketcapacity_').val();
if (hallcapacity == '') {
$('#ticketcapacity_').val('');

document.getElementById("myDIV").style.display = "none";

} else if (ticketcapacity > hallcapacity) {

document.getElementById("myDIV").style.display = "block";
$('#ticketcapacity_').val('');
} else {

document.getElementById("myDIV").style.display = "none";
}
});

$(".delGal").click(function(){
var ev_file = $(this).attr("data-src");

$.ajax({
type: "POST",
url: "<?= $BaseUrl; ?>/post-ad/delGallery.php",
cache: false,
data: {
'img_id': ev_file
},
success: function(data) {
//$("#"+ev_file).html(" ");
}
});
});
</script>


<script>
$("#spUserState").on("change", function() {
// alert('===1');
var state = this.value;
$.post("loadUserCity.php", {
state: state
}, function(r) {
//alert(r);
$(".loadCity").html(r);
});

});
</script>
<script>
    function event_platform(data) {
        console.log(data);
        $('.event_platform_title').val(data);
    }
</script>

</body>

</html>
<?php
} ?>