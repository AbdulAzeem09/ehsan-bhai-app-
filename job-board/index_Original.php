<?php
require_once('../common.php');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "job-board/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";


if ($_SESSION['Countryfilter'] == '') {
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {

$ruser = mysqli_fetch_assoc($res);

$_SESSION['Countryfilter'] = $ruser["spUserCountry"];
$_SESSION['Statefilter'] = $ruser["spUserState"];
$_SESSION['Cityfilter'] = $ruser["spUserCity"];
}
}



if (isset($_POST['Change_Current_Location'])) {
session_start();

$_SESSION["Countryfilter"] = $_POST['spUserCountry'];
$_SESSION["Statefilter"] = $_POST['spUserState'];
$_SESSION["Cityfilter"] = $_POST['spUserCity'];


//unset($_SESSION['Products']);
}

if (isset($_POST['Closeresetlocation'])) {
session_start();

unset($_SESSION['Countryfilter']);
unset($_SESSION['Statefilter']);
unset($_SESSION['Cityfilter']);
}



?>

<?php
$p = new _classified;

$r = $p->read($_GET["postid"]);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
$usercountry = $row['spPostCountry'];
$userstate = $row['spUserState'];
$usercity = $row['spUserCity'];
}
}
//print_r($_SESSION);
//die('==');
/*if (($_SESSION['ptid'] == 2) || ($_SESSION['ptid'] == 3) || ($_SESSION['ptid'] == 4) || ($_SESSION['ptid'] == 6)) {
$_SESSION['ms'] = "message";
header("Location: $BaseUrl/my-profile/");
}
*/




?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<?php include('component/links.php'); ?>

<!-- owl carousel -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->

<?php include('../../component/dashboard-link.php'); ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<style media="screen">
.midjob {
padding: 0px !important;
}

.midjob form.job_search {
box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.12), 0 4px 10px 0 rgba(0, 0, 0, 0.16);
background-color: #fff !important;
padding: 16px;
}

.midjob form.job_search .form-group input {
height: 40px;
border-radius: 50px;
padding: 0px 10px;
}

.midjob form.job_search button#btnJobSearch {
padding: 10px 0px !important;
border-radius: 40px !important;
width: 100%;
}

section.landing_page.bg_white {
margin-bottom: 16px;
}

/*.whiteboardmain {
padding: 15px 15px 30px 15px;
margin-bottom: 20px;
}*/
.whiteboardmain h4 {
margin-bottom: 20px;
margin-top: 30px;
font-size: 20px;
}

.whiteboardmain p {
margin-bottom: 6px;
}

.right_main_top .row:hover {
background-color: #f1f1f1f1;
cursor: pointer;
}

.right_main_top h4 {
margin-top: 10px;
line-height: 26px;
}

.right_main_top h4 a {
font-size: 18px;
color: #000;
}

.right_main_top button.jobbutton.btn-primary {
margin-top: 20px !important;
}

.right_main_top span {
padding: 0px 4px;
margin-right: 2px;
margin-left: 8px;
}

.right_main_top button.jobbutton.btn-primary {
margin-top: 20px !important;
padding: 5px 10px;
border: 1px solid #fff;
}

.skilllink {
margin-right: 10px !important;
}

/* --------new-job-list-css----------- */

.right-job-listing {
margin-top: 10px;
background-color: #fff;
}

.right-job-listing table#task-list-tbl {
width: 100%;
}

.job-content {
padding: 0 16px;
border-bottom: 1px solid #DEDEDE;
}

.job-content .job-card {
padding: 24px 0;
}

.job-content .job-card .card-primary .pri-head {
margin-bottom: 16px;
}

.job-content .job-card .card-primary .pri-head .head-link {
font-size: 16px;
line-height: 1.5;
color: #0e1724;
font-weight: 700;
margin-right: 4px;
}

.job-content .job-card .card-primary .pri-head .head-days {
margin-right: 12px;
}

.job-content .job-card .card-primary .pri-head .new-head {
background-color: #4fb55d;
color: #fff;
padding: 2px 4px;
font-size: 12px;
margin-right: 3px;
border: 1px solid #4fb55d;
margin-bottom: 3px;
display: inline-block;
}

.job-content .job-card .card-primary .pri-head .new-head {
padding: 0px 4px;
margin-right: 2px;
margin-left: 2px;
}

.job-content .job-card .card-primary .pri-para {
margin-bottom: 16px;
font-size: 14px;
line-height: 1.4;
color: #0e1724;
}

.job-content .job-card .card-primary .pri-tags a {
margin-bottom: 8px;
margin-right: 8px;
text-decoration: none;
color: #007fed !important;
}

.job-content .job-card .card-secondary .price {
font-size: 16px;
line-height: 1.5;
font-weight: 700;
margin-bottom: 8px;
color: #0e1724;
}

.job-content .job-card .card-secondary .price .avg {
font-size: 13px;
font-weight: 400;
line-height: 1.2;
font-weight: 400;
}

.job-content .job-card .card-secondary .entry {
font-size: 14px;
line-height: 1.43;
color: #0e1724;
}

.job-content .job-card .card-secondary .avg-btn {
display: block;
margin-top: 10px;
}

.job-content .job-card .card-secondary .avg-btn .avg-bid {
background: #337ab7;
border: 1px solid #337ab7;
color: #F7F7F7;
font-weight: 700;
text-shadow: 0 -1px transparent;
padding: 4px 12px;
font-size: 13px;
border-radius: 50px;
}

.job-content:hover {
background-color: #F7F7F7;
cursor: pointer;
}

.job-content:hover .avg-btn {
display: block !important;
margin-top: 12px;
}

.avg-bid {
background: #5dc26a;
border-color: #5dc26a;
color: #F7F7F7;
}

.location-btn {
margin-top: 16px;
margin-left: 2px;
}

.location-btn a.loc-btn {
color: #000;
font-size: 15px;
}

/* ----start-media-query-css----- */

@media only screen and (max-width: 767px) {

.home_top_job {
padding: 0px;
}

.midjob form.job_search button#btnJobSearch {
margin-top: 20px;
}

li.cls {
margin-top: -19px !important;
}
}

#profileDropDown li.active {
background-color: #1f3060 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}
/*apply now btn*/
a.avg-bid.btn.zoom1.apl-nw {
    padding: 10px 25px !important;
    font-size: 14px !important;
}
.pri-head.lct-tlt {
    font-size: 14px;
	margin-top:7px;
}
</style>
<script>
$('.dropdown-toggle').click(function() {
alert('ok')
});

$(document).ready(function() {

var
filters = {
user: null,
status: null,
milestone: null,
priority: null,
tags: null
};


function updateFilters() {
$('.task-list-row').hide().filter(function() {
var
self = $(this),
result = true; // not guilty until proven guilty

Object.keys(filters).forEach(function(filter) {
if (filters[filter] && (filters[filter] != 'None') && (filters[filter] != 'Any')) {
result = result && filters[filter] === self.data(filter);
}
});

return result;
}).show();

tableRowCount()
}

function tableRowCount() {
var numOfVisibleRows = $('tr:visible').length;
if (numOfVisibleRows == 0) {
document.getElementById('no_result').style.display = '';

} else {
document.getElementById('no_result').style.display = 'none';

}

}


function changeFilter(filterName) {
filters[filterName] = this.value;
updateFilters();
}

// Assigned User Dropdown Filter
$('#job-level-filter').on('change', function() {
changeFilter.call(this, 'user');
});

// Task Status Dropdown Filter
$('#job-type-filter').on('change', function() {
changeFilter.call(this, 'status');
});

// Task Milestone Dropdown Filter
$('#salary-filter').on('change', function() {
changeFilter.call(this, 'milestone');
});


/*alert();*/

$("#btnJobSearch").click(function() {

// alert("heree");

var txtJobTitle = $("#txtJobTitle").val();
var txtJobLoc = $("#txtJobLoc").val();

//alert(txtJobTitle);

if (txtJobTitle == "" || txtJobLoc == "") {

$("#title_err").text("This Fileld is Required.");
// $("#loc_err").text("Please Enter Location.");

return false;

} else {
$("#job_search").submit();
}

});

});


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
items: 7,
nav: false
}
}
});
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true, // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
});
</script>

</head>
<style media="screen">

</style>

<body class="bg_gray">


<?php

$header_jobBoard = "header_jobBoard";
include_once("../header.php");
//print_r($_SESSION);
//die('==');  


if (isset($_POST['btnJobSearch']) or isset($_POST['searchforstorebtn'])) {
} else {
?>
<section class="jobboard">
<div class="container">
<div class="row text-center">
<div class="col-sm-12">
<div class="home_top_job">
<h1>It's Time TO <img src="<?php echo $BaseUrl; ?>/assets/images/jobboard/heart.png" class="img-responsive" alt="heart" /> <span>love</span> Monday's</h1>
<style>  
.dropdown-toggle i,
.right_head_top a i {
color: #fff;
font-size: 16px;
margin-top: 8px;
}
</style>
    <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
      <div class="modal-content no-radius">

       <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
         <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
           <h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business"</span> modules can post a job.</h2>
            <div class="space-md"></div>
             <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
              <a href="<?php echo $BaseUrl . '/job-board'; ?>" class="btn">Back to Home</a>
             </div>
           </div>
        </div>
    </div>
<?php
if ($_SESSION['ptid']) {
$u = new _spuser;
$p_result = $u->isverify($_SESSION['uid']);
//if ($p_result == 1) {
$pv = new _postingview;
$reuslt_vld = $pv->chekposting(2, $_SESSION['pid']);
if ($reuslt_vld == false) {

?>
<?php if ($_SESSION['ptid'] == 1) { ?>
<a href="<?php echo $BaseUrl . '/post-ad/job-board/?post'; ?>" class="btn butn_jobboard btn-border-radius">Post a job</a><?php
} else {?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_jobboard btn-border-radius">Post a job</a>
<?php
}
}
//}
} ?>
</div>
</div>
</div>
</div>
</section>
<?php } ?>


<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">


<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
<form method="post">
<input type="hidden" name="spPostingVisibility" value="0">
<div class="modal-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spUserCountry" id="spUserCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION["Countryfilter"]) && $_SESSION["Countryfilter"]  == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
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
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spUserState" id="spUserState">
<option>Select State</option>
<?php
if (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] > 0) {
$countryId = $_SESSION["Countryfilter"];
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
<select id="spUserCity" class="form-control" name="spUserCity">
<option>Select City</option>
<?php
if (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"] > 0) {
$stateId = $_SESSION["Statefilter"];
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"]==$row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
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
</div> -->

</div>
</div>
<div class="modal-footer">
<!-- <button type="button" class="btn btn-danger" name="Closeresetlocation" value="Cancel">Cancel</button> -->
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>

<input type="submit" value="Change" class="btn btn-primary btn-border-radius" name="Change_Current_Location">
</div>
</form>
</div>

</div>
</div>


<?php if ($_GET['msg'] == "notaccess") { ?>
</br>
<div class="alert alert-danger alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Danger ! </strong> Please Select Employment or Buisness Profile Type !! .
</div>


<?php   } ?>


<section class="midjob">
<div class="container">
<form class="job_search" id="job_search" method="post" action="/job-board/">
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-1">
							<a href="<?php echo $BaseUrl . '/job-board/ '; ?>" class="btn " style="
    padding: 6px 0px !important;" ><i class="fa fa-home " style="font-size: 25px !important;"></i></a>
								</div>
<div class="col-md-6">
<div class="form-group no-margin">

<input type="text" style="width: 490px;" name="txtJobTitle" id="txtJobTitle" class="form-control" value="<?php echo $_POST['txtJobTitle']; ?>" placeholder="Job Title">
<span id="title_err" style="color: red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group no-margin">
<a href="#" style="cursor:pointer;" data-toggle="modal" data-target="#myModa">

<a>
<datalist id="suggested_address">
</datalist>
<!----<a href="#" style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>--->
<span id="loc_err" style="color: red;"></span>
</div>
</div>

<script type="text/javascript">
function getaddress() {

var address = $("#txtJobLoc").val();

$.ajax({
type: "POST",
url: "../address.php",
cache: false,
data: {
'address': address
},
success: function(data) {

var obj = JSON.parse(data);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);

}
});
}
</script>
<!--  <div class="col-md-3">
<div class="form-group no-margin">
<select class="form-control" name="txtJobLevel" >
<option value="">Select Job Level</option>
<?php
$m = new _masterdetails;
$masterid = 2;
$result = $m->read($masterid);
if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
echo "<option value='" . $rows["masterDetails"] . "'>" . $rows["masterDetails"] . "</option>";
}
}
?>
</select>
</div>
</div> -->

</div>
</div>
<div class="col-md-1" >

<button type="submit" id="btnJobSearch" name="btnJobSearch" class="btn btnPosting db_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<?php if ($_SESSION['ptid'] == 5) { ?>

<a style="border-color: #1f3060;background-color: #1f3060;    margin-right: 10px;padding: 10px 10px;" class="btn btn-primary pull-right btn-border-radius" href="<?php echo $BaseUrl . '/job-board/dashboard/emp_dashboard.php'; ?>">Dashboard</a>



<?php  } else { ?>
<a style="border-color: #1f3060;background-color: #1f3060;    margin-right: 10px;padding: 10px 10px;" class="btn btn-primary pull-right zoom btn-border-radius" href="<?php echo $BaseUrl . '/job-board/dashboard'; ?>">Dashboard</a>

<?php  }
}  ?>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<!-- <a style="margin-right: 10px;" class="btn btn-primary pull-right" href="<?php echo $BaseUrl . '/job-board/forward-jobs.php?frw=1'; ?>">Forwarded Jobs</a> -->
<a style="margin-right: 10px;padding: 10px 10px;" class="btn btn-primary pull-right zoom btn-border-radius" href="<?php echo $BaseUrl . '/job-board/all-jobs.php'; ?>">All Jobs</a>
<?php } ?>










</div>
</form>
</div>
</section>
<section>
<div class="container">
<div class="row">
<!-- <div class="col-md-3 jobboardleft no-padding top_margin" > -->
<!--  <div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title ">
<a class="accordion-toggle hv" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
Job Level
</a>
</h4>
</div>
<div id="collapseOne" class="panel-collapse collapse ">
<div class="panel-body">
<ul>
<?php
$m = new _masterdetails;
$masterid = 2;
$result = $m->read($masterid);
if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<li><a href="<?php echo $BaseUrl . '/job-board/search.php?level=' . $rows["masterDetails"]; ?>"><?php echo $rows["masterDetails"]; ?></a></li>
<?php
//echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
}
}
?>



</ul>
</div>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title hv">
<a href="<?php echo $BaseUrl . '/job-board/find-a-job.php' ?>">Find a job</a>
</h4>
</div>

</div>


</div> -->
<!--      <div class="left_main_btm text-center">

<img src="<?php echo $BaseUrl; ?>/assets/images/jobboard/hiring.png" class="img-responsive center-block">
<h4>SINCE 2017.</h4>
<p>We’ve connected thousands of creative professionals with great companies and outstanding work opportunities.</p>
</div> -->
<!-- <div class="space-lg"></div> -->
<!-- </div> -->
<div class="col-sm-12" style="margin-top:10px;">

<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<form action="<?php echo $Baseurl; ?>/job-board/">
<div class="whiteboardmain">
<div class="row">
<div class="col-md-2">
<input type="date" id="" name="fromdate" class="datepicker form-control" value="<?php echo $_GET['fromdate']; ?>" placeholder="Start Date">
</div>
<!-- <div class="col-md-2">
<input type = "text" id = "end-date" name="todate" class="datepicker form-control" value="<?php echo $_GET['todate']; ?>" placeholder="End Date">			
</div> -->




<script>
$(function() {
$("#start-date").datepicker({
dateFormat: "dd/mm/yy",
maxDate: 0,
onSelect: function(date) {
var dt2 = $('#end-date');
var startDate = $(this).datepicker('getDate');
var minDate = $(this).datepicker('getDate');
if (dt2.datepicker('getDate') == null) {
dt2.datepicker('setDate', minDate);
}
//dt2.datepicker('option', 'maxDate', '0');
dt2.datepicker('option', 'minDate', minDate);
}
});
$('#end-date').datepicker({
dateFormat: "dd/mm/yy",
maxDate: 0
});
});
</script>
<div class="col-md-2">
<select name="jobtype" class="form-control btn-secondary text-dark" style="color:black;">
<option value="">Job type</option>
<option <?php if ($_GET['jobtype'] == 'Office') {
echo 'selected';
} ?> value="Office">Office</option>
<option <?php if ($_GET['jobtype'] == 'Remote') {
echo 'selected';
} ?> value="Remote">Remote</option>
</select>

</div>
<div class="col-md-2">
<select name="joblevel" class="form-control btn-secondary text-dark" style="color:black;">
<option value="">Job Level </option>
<?php
$jl = new _spAllStoreForm;
$result2 = $jl->readJobLevel();
if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) {
?>
<option <?php if ($_GET['joblevel'] == $row2['jobLevelTitle']) {
echo 'selected';
} ?> value="<?php echo $row2['jobLevelTitle']; ?>" <?php if (isset($jobLevel)) {
if ($jobLevel == $row2["jobLevelTitle"]) {
echo 'selected';
}
} ?>><?php echo $row2['jobLevelTitle']; ?></option>
<?php
}
}
?>
</select>

</div>

<div class="col-md-2">
<select name="salaryrange" class="form-control btn-secondary text-dark" style="color:black;">
<option value="">Salary Range</option>
<option <?php if ($_GET['salaryrange'] == 'u100') {
echo 'selected';
} ?> value="u100">Under 100</option>
<option <?php if ($_GET['salaryrange'] == 'o100') {
echo 'selected';
} ?> value="o100">Over 100</option>
<option <?php if ($_GET['salaryrange'] == 'o500') {
echo 'selected';
} ?> value="o500">Over 500</option>
<option <?php if ($_GET['salaryrange'] == 'o1000') {
echo 'selected';
} ?> value="o1000">Over 1000</option>
</select>

</div>
<!---<div class="col-md-2">
<select name="salarytype" class="form-control btn-secondary text-dark" style="color:black;">
<option>Salary Type</option>
<option value="Hourly">Hourly</option>
<option value="Monthly">Monthly</option>
<option value="Yearly">Yearly</option>
</select>

</div>
<div class="col-md-2">
<select name="jobcategory" class="form-control btn-secondary text-dark" style="color:black;">
<option>Job Category</option>
<?php
$m = new _subcategory;
$catid = 2;
$result = $m->read($catid);

/*echo $m->ta->sql;*/
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php if (isset($jobType)) {
if ($jobType == $rows['subCategoryTitle']) {
echo "selected";
}
} ?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
<?php
}
}
?>
</select>

</div>
<div class="col-md-2">
<select class="form-control btn-secondary text-dark" style="color:black;">
<option>Company</option>
<option>aaaaaaaaaaa</option>
<option>aaaaaaaaaaa</option>
<option>aaaaaaaaaaa</option>
</select>

</div>--->
<div class="col-md-1">
<button type="submit" class="btn btnPosting db_btn zoom btn-border-radius" name="searchforstorebtn" style="background-color:black;">Filter</button>
</div>
<!--<div class="col-md-1">
<a href="/job-board/" class="btn btnPosting db_btn zoom1" style="background-color: orange;">Reset</a>
</div>-->


<div class="col-md-2" style="margin-left: 25px;">
<div style="margin-right: -15px;">

<?php

$usercountry = $_SESSION["Countryfilter"];
$userstate = $_SESSION["Statefilter"];
$usercity = $_SESSION["Cityfilter"];

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
while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
//die('===');
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
while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
};
?>



<p>



<small style="font-size:14px!important;">
<!--Current Location: -->
<?php
$words = explode(' ', $currentstate);
$result = $words[0][0] . $words[1][1];
//$result=$words;
?>
<?php
if ($currentcity) {
echo $currentcity . ', ';
}
if ($currentstate) {
echo $currentstate . ', ';
}
if ($currentcountry) {
echo $currentcountry;
}
//echo $currentcity.','.$currentstate.','.$currentcountry; 
//echo $result;
?>
<br>

<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>
</p>

</div>
</div>
</div>
</div>
</form>

</div>

<div class="col-sm-12">



<div class="right-job-listing">
<h3 id="no_result" style='display:none;text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>
<table id="task-list-tbl" class="list-wrapper">

<style type="text/css">
.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #EEE;
background-color: #FFF;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;
background-color: #1f3060;
border-color: #1f3060;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #1f3060;
}

.zoom1:hover {
-ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
}
</style>
<?php
$joblevelfilter = "";
$jobtypefilter = "";
$startenddate = "";
$salaryrangefilter = "";
$Countryfilter = "";
$Statefilter = "";
$Cityfilter = "";



$limit = "100";
/*$p   = new _postingview;*/
$p   = new _jobpostings;
$pf  = new _postfield;

$txtJobTitle = $_POST['txtJobTitle'];
//$txtJobLoc = $_POST['txtJobLoc'];

if (isset($_GET['salaryrange'])) {
if (!empty($_GET['salaryrange'])) {
$salaryrange = $_GET['salaryrange'];
if ($salaryrange == 'u100') {
$salaryrangefilter = "AND spPostingSlryRngFrm <= 100";
}
if ($salaryrange == 'o100') {
$salaryrangefilter = "AND spPostingSlryRngFrm >= 100";
}
if ($salaryrange == 'o500') {
$salaryrangefilter = "AND spPostingSlryRngFrm >= 500";
}
if ($salaryrange == 'o1000') {
$salaryrangefilter = "AND spPostingSlryRngFrm >= 1000";
}
}
}
if (isset($_GET['jobtype'])) {
if (!empty($_GET['jobtype'])) {
$jobtype = $_GET['jobtype'];
$jobtypefilter = "AND spPostingLocation = '$jobtype'";
}
}
if (isset($_GET['joblevel'])) {
if (!empty($_GET['joblevel'])) {
$joblevel = $_GET['joblevel'];
$joblevelfilter = "AND spPostingJoblevel = '$joblevel'";
}
}


//die("================================");

if (isset($_GET['searchforstorebtn'])) {
if (!empty($_GET['fromdate'])) {
//echo $_GET['todate']; die;
$fromdate = $_GET['fromdate'];
//$todate = $_GET['todate'];
$da = explode('/', $fromdate);
//$da1=explode('/',$todate);

$vdate1 = $da[2] . '-' . $da[1] . '-' . $da[0];
//$vdate2= $da1[2].'-'.$da1[1].'-'.$da1[0];
$vdate1 = substr($vdate1, 2); // "quick brown fox jumps over the lazy dog."

$startenddate = "AND spPostingDate LIKE '$vdate1%' ";


//$startenddate = "AND spPostingDate BETWEEN '$vdate1' AND '$vdate2'"; 
}


if (isset($_SESSION['Countryfilter'])) {
if (!empty($_SESSION['Countryfilter'])) {
$ccff = $_SESSION['Countryfilter'];
$Countryfilter = "AND spPostingsCountry = $ccff";
}
}

if (isset($_SESSION['Statefilter'])) {
if (!empty($_SESSION['Statefilter'])) {
$ssf = $_SESSION['Statefilter'];
$Statefilter = "AND spPostingsState = $ssf";
}
}

if (isset($_SESSION['Cityfilter'])) {
if (!empty($_SESSION['Cityfilter'])) {
$ciicff = $_SESSION['Cityfilter'];
$Cityfilter = "AND spPostingsCity = $ciicff";
}
}



$limit = "10000";
$res = $p->publicpost_jobBoardwithfilter($limit, 2, $startenddate, $jobtypefilter, $joblevelfilter, $salaryrangefilter, $Countryfilter, $Statefilter, $Cityfilter);

//echo $p->ta->sql; die('==='); 
}
else {
	if (!empty($_POST['txtJobTitle'])) {
	//die("================================");

	$_SESSION['jobtitle'] = $txtJobTitle;

	if (isset($_SESSION['Countryfilter'])) {
 		if (!empty($_SESSION['Countryfilter'])) {
			$ccff = $_SESSION['Countryfilter'];
			$Countryfilter = "AND spPostingsCountry = $ccff";
		}
	}

	if (isset($_SESSION['Statefilter'])) {
		if (!empty($_SESSION['Statefilter'])) {
			$ssf = $_SESSION['Statefilter'];
			$Statefilter = "AND spPostingsState = $ssf";
		}
	}


	if (isset($_SESSION['Cityfilter'])) {
		if (!empty($_SESSION['Cityfilter'])) {
			$ciicff = $_SESSION['Cityfilter'];
			$Cityfilter = "AND spPostingsCity = $ciicff";
		}
	}


$res = $p->readJobSearch($_POST['txtJobTitle'], $Countryfilter, $Statefilter, $Cityfilter);
}else {
	    if(!empty($_SESSION['Countryfilter']) && !empty($_SESSION['Statefilter']) && !empty($_SESSION['Cityfilter']) ){
			if (isset($_SESSION['Countryfilter'])) {
				if (!empty($_SESSION['Countryfilter'])) {
					$ccff = $_SESSION['Countryfilter'];
					$Countryfilter = "AND spPostingsCountry = $ccff";
				}
			}
			if (isset($_SESSION['Statefilter'])) {
				if (!empty($_SESSION['Statefilter'])) {
					$ssf = $_SESSION['Statefilter'];
					$Statefilter = "AND spPostingsState = $ssf";
				}
			}
		$limit = -1;
		//$res = $p->publicpost_jobBoardwithfilter($limit, 2, $startenddate, $jobtypefilter, $joblevelfilter, $salaryrangefilter, $Countryfilter, $Statefilter, $Cityfilter); 
		$res = $p->publicpost_jobBoard_session($limit, $_SESSION['Countryfilter'], $_SESSION['Statefilter'], $_SESSION['Cityfilter']);
		}else{
			$Countryfilter  = $_SESSION['Countryfilter'];
			$res_data = selectQ("SELECT * from spjobboard where spPostingsCountry=? and spPostingVisibility=-1 and spPostingExpDt >= CURDATE()", "i", [$Countryfilter]);
		}
	}
}
?>
<div class="right-job-listing123">
<h5 id="no_result" style="padding-left: 10px;padding-top: 16px;min-height: 67px;color: #007fed!important;font-size: 30px; text-align: center;">
<?php
$job_count = $res->num_rows;
$txtJobTitle = $_POST['txtJobTitle'];

if ($txtJobTitle != "") {
$keyword = "matching '" . $txtJobTitle . "' keyword";
} else {
$keyword = "";
}

if (!empty($currentcity)) {
$city = 'in ' . $currentcity . ', ';
} else {
$city = "";
}
//echo $currentstate;
//die('===');
if (!empty($currentstate)) {
$state = $currentstate;
//echo $state;
} else {
//die('==');
$state = "";
//echo $state;
}
if (!empty($currentcountry)) {
$country = ', ' . $currentcountry;
} else {
$country = "";
}
$dd = explode(" ", $state);
$dds = substr($dd[1], 0, 1);
//echo $dds;
$ddh = substr($dd[2], 0, 1);
//echo $ddh;
//$state = $dds.$ddh;
//echo $state;
//die('===');
if ($job_count > 1) {
	echo $job_count . " jobs found " . $keyword .  '' . $state . '' . $country;
}
if ($job_count == 1) {
	echo $job_count . " job found " . $keyword . '' . $state . '' . $country;
}

/*else{
echo $job_count . " job found ". $keyword . $city .','. $state . $country;
}*/

?>
</h3>
</div>
<?php
//echo $p->ta->sql; die;
if(!empty($_SESSION['Countryfilter']) && !empty($_SESSION['Statefilter']) && !empty($_SESSION['Cityfilter']) ){
	if ($res) {
		while ($row = mysqli_fetch_assoc($res)) {
			if ($row['spuser_idspuser'] != NULL) {
				$st = new _spuser;
				$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
				if ($st1 != false) {
					$stt = mysqli_fetch_assoc($st1);
					$account_status = $stt['deactivate_status'];
				}
			}
			$idposting = $row['idspPostings'];
			$pf = new _productposting;
			$flagcmd = $pf->flagcount(2, $idposting);
			$flagnums = $flagcmd->num_rows;
			if ($flagnums == '9') {
				$updatestatus = $pf->jobboardstatus($idposting);
			}
		
			// echo "<pre>";
			// print_r($row);
			/*$postingDate = $p-> spPostingDate($row["spPostingDate"]);*/
			$postingDate = $row["spPostingDate"];
			
			//$cmpnyName = $row["spPostingDate"];
			
			$skill = $row["spPostingSkill"];
			//read posting field
			/*  $result_pf = $pf->read($row['idspPostings']);
			//echo $pf->ta->sql."<br>";
			if($result_pf){
			$skill = "";
			while ($row2 = mysqli_fetch_assoc($result_pf)) {
			if($skill == ''){
			if($row2['spPostFieldName'] == 'spPostingSkill_'){
			$skill = explode(',', $row2['spPostFieldValue']);
			}
			}
			}
			$postingDate = $p-> spPostingDate($row["spPostingDate"]);
			}
			// company profile information
			$u = new _profilefield;
			$result3 = $u->read($row['idspProfiles']);
			if ($result3) {
			$cmpnyName = "";
			while ($row3 = mysqli_fetch_assoc($result3)) {
			if($cmpnyName == ''){
			if($row3['spProfileFieldName'] == 'companyname_'){
			$cmpnyName = $row3['spProfileFieldValue'];
			}
			}
			}*/
			/* }*/
			// ========================END======================
			if ($account_status != 1) {
			?>
		
				<tr id="task-<?php echo $row['idspPostings']; ?>" class="task-list-row" data-task-id="<?php echo $row['idspPostings']; ?>" data-user="<?php echo $row['spPostingJoblevel']; ?>" data-status="<?php echo $row['spPostingJobType']; ?>" data-milestone="<?php echo $row['spPostingJobAs']; ?>">
				<td class="list-item">
				
				<div class="job-content">
				<div class="job-card" style="font-size: 16px;">
				<div class="row">
				
				
				<div class="col-sm-12 col-sm-12">
				<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="head-link">
				<div class="card-primary">
				<div class="col-md-9 col-sm-12">
				<div class="pri-head">
					<?php
					// Creates DateTime objects
					$date = strtotime($row["spPostingDate"]);
					$date1 = date('Y-m-d');
					$date2 = $row["spPostingExpDt"];
					$date1_ts = strtotime($date1);
					$date2_ts = strtotime($date2);
					$diff = $date2_ts - $date1_ts;
					?>
					<!-- <span class="head-days"><?php //echo round($diff / 86400);// ?> days left</span> -->
					<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="head-link"><?php echo ucfirst($row['spPostingTitle']); ?></a>
					<span class="new-head">New</span><br><br> 
				</div>
				<?php
				$string = strip_tags($row['spPostingNotes']);
				if (strlen($string) > 65) {
				// truncate string
				$stringCut = substr($string, 0, 65);
				$endPoint = strrpos($stringCut, ' ');
				
				//if the string doesn't contain any space then it will cut without word basis.
				$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				$string .= '... <a href=' . $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings'] . '>Read More</a>';
				}
				
				?>
				<p class="pri-para"><?php echo ucfirst($string); ?></p>
				<div class="pri-tags" style="height: 40px;overflow: hidden;">
				<?php
				
				$skills = explode(',', $row['spPostingSkill']);
				foreach ($skills as $key => $value) {
				?>
					<a><?php echo ucfirst($value); ?></a>
				<?php
				} ?>
				
				</div>
				<div class="pri-head lct-tlt">
					<?php
						$usercountryn = $row["spPostingsCountry"];
						$userstaten = $row["spPostingsState"];
						$usercityn = $row["spPostingsCity"];
				
						$co = new _country;
						$result3 = $co->readCountry();
						if ($result3 != false) {
							while ($row3 = mysqli_fetch_assoc($result3)) {
								if (isset($usercountryn) && $usercountryn == $row3['country_id']) {
									$currentcountryn = $row3['country_title'];
									$currentcountry_id = $row3['country_id'];
								}
							}
						}
						if (isset($userstaten) && $userstaten > 0) {
							$countryId = $currentcountry_id;
							$pr = new _state;
							$result2 = $pr->readState($countryId);
							if ($result2 != false) {
								while ($row2 = mysqli_fetch_assoc($result2)) {
									if (isset($userstaten) && $userstaten == $row2["state_id"]) {
										$currentstate_id = $row2["state_id"];
										$currentstaten = $row2["state_title"];
									}
								}
							}
						}
						if (isset($usercityn) && $usercityn > 0) {
							$stateId = $currentstate_id;
							$co = new _city;
							$result3 = $co->readCity($stateId);
							//echo $co->ta->sql;
								if ($result3 != false) {
									while ($row3 = mysqli_fetch_assoc($result3)) {
										if (isset($usercityn) && $usercityn == $row3['city_id']) {
											$currentcityn = $row3['city_title'];
											$currentcity_id = $row3['city_id'];
										}
									}
								}
						};
					?>
					<?php
						if (!empty($currentcityn)) {
							echo $currentcityn;
						}
						if (!empty($currentstaten)) {
							echo ', ' . $currentstaten;
						}
						if (!empty($currentcountryn)) {
							echo ', ' . $currentcountryn;
						}
					?>
				</div>
				</div>
				
				<div class="col-md-3 col-sm-12">
				<div class="card-secondary">
				<div class="price">
				<?php if ($row['spPostingSlryRngFrm'] > 0) {
				echo $row['job_currency'] . ' ' . $row['spPostingSlryRngFrm'] . ' - ' . $row['job_currency'] . ' ' . $row['spPostingSlryRngTo'] . '';
				} ?>
				</div>
				<div class="avg-btn">
				<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="avg-bid btn zoom1 apl-nw">APPLY NOW </a>
				</div>
				<div class="location-btn">
				<a href="#" class="loc-btn"><?php echo ucfirst($row["spPostingLocation"]); ?> </a>
				</div>
				</div>
				</div>
				</div>
				</a>
				</div>
				
				</div>
				</div>
				</div>
				
				
				</td>
				
		<?php
		}
	}
	} else {
		echo "<h3 style='text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>";
		}
}else{
if ($res_data) {
foreach ($res_data as $row) {
	if ($row['spuser_idspuser'] != NULL) {
	$st = new _spuser;
	$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
	if ($st1 != false) {
	$stt = mysqli_fetch_assoc($st1);
	$account_status = $stt['deactivate_status'];
	}
	}
	$idposting = $row['idspPostings'];
	$pf = new _productposting;
	$flagcmd = $pf->flagcount(2, $idposting);
	$flagnums = $flagcmd->num_rows;
	if ($flagnums == '9') {
	$updatestatus = $pf->jobboardstatus($idposting);
	}

	// echo "<pre>";
	// print_r($row);
	/*$postingDate = $p-> spPostingDate($row["spPostingDate"]);*/
	$postingDate = $row["spPostingDate"];

	//$cmpnyName = $row["spPostingDate"];

	$skill = $row["spPostingSkill"];
	//read posting field
	/*  $result_pf = $pf->read($row['idspPostings']);
	//echo $pf->ta->sql."<br>";
	if($result_pf){
	$skill = "";
	while ($row2 = mysqli_fetch_assoc($result_pf)) {
	if($skill == ''){
	if($row2['spPostFieldName'] == 'spPostingSkill_'){
	$skill = explode(',', $row2['spPostFieldValue']);
	}
	}
	}
	$postingDate = $p-> spPostingDate($row["spPostingDate"]);
	}
	// company profile information
	$u = new _profilefield;
	$result3 = $u->read($row['idspProfiles']);
	if ($result3) {
	$cmpnyName = "";
	while ($row3 = mysqli_fetch_assoc($result3)) {
	if($cmpnyName == ''){
	if($row3['spProfileFieldName'] == 'companyname_'){
	$cmpnyName = $row3['spProfileFieldValue'];
	}
	}
	}*/
	/* }*/
	// ========================END======================
	if ($account_status != 1) {
	?>

	<tr id="task-<?php echo $row['idspPostings']; ?>" class="task-list-row" data-task-id="<?php echo $row['idspPostings']; ?>" data-user="<?php echo $row['spPostingJoblevel']; ?>" data-status="<?php echo $row['spPostingJobType']; ?>" data-milestone="<?php echo $row['spPostingJobAs']; ?>">
		<td class="list-item">

		<div class="job-content">
			<div class="job-card" style="font-size: 16px;">
			<div class="row">
				<div class="col-sm-12 col-sm-12">
					<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="head-link">
					<div class="card-primary">
						<div class="col-md-9 col-sm-12">
							<div class="pri-head">
								<?php
								// Creates DateTime objects
								$date = strtotime($row["spPostingDate"]);
								$date1 = date('Y-m-d');
								$date2 = $row["spPostingExpDt"];
								$date1_ts = strtotime($date1);
								$date2_ts = strtotime($date2);
								$diff = $date2_ts - $date1_ts;
								?>
							<!-- <span class="head-days"><?php //echo round($diff / 86400);// ?> days left</span> -->
								<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="head-link"><?php echo ucfirst($row['spPostingTitle']); ?></a>
								<span class="new-head">New</span><br><br> 
							</div>
							<?php
							$string = strip_tags($row['spPostingNotes']);
							if (strlen($string) > 400) {
							// truncate string
							$stringCut = substr($string, 0, 400);
							$endPoint = strrpos($stringCut, ' ');

							//if the string doesn't contain any space then it will cut without word basis.
							$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
							$string .= '... <a href=' . $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings'] . '>Read More</a>';
							}

							?>
							<p class="pri-para"><?php echo ucfirst($string); ?></p>
							<div class="pri-tags" style="height: 40px;overflow: hidden;">
								<?php

								$skills = explode(',', $row['spPostingSkill']);
								foreach ($skills as $key => $value) {
								?>
									<a><?php echo ucfirst($value); ?></a>
								<?php
								} ?>

							</div>
							<div class="pri-head lct-tlt">
								<?php
									$usercountryn = $row["spPostingsCountry"];
									$userstaten = $row["spPostingsState"];
									$usercityn = $row["spPostingsCity"];

									$co = new _country;
									$result3 = $co->readCountry();
									if ($result3 != false) {
										while ($row3 = mysqli_fetch_assoc($result3)) {
											if (isset($usercountryn) && $usercountryn == $row3['country_id']) {
												$currentcountryn = $row3['country_title'];
												$currentcountry_id = $row3['country_id'];
											}
										}
									}
									if (isset($userstaten) && $userstaten > 0) {
										$countryId = $currentcountry_id;
										$pr = new _state;
										$result2 = $pr->readState($countryId);
										if ($result2 != false) {
											while ($row2 = mysqli_fetch_assoc($result2)) {
												if (isset($userstaten) && $userstaten == $row2["state_id"]) {
													$currentstate_id = $row2["state_id"];
													$currentstaten = $row2["state_title"];
												}
											}
										}
									}
									if (isset($usercityn) && $usercityn > 0) {
										$stateId = $currentstate_id;
										$co = new _city;
										$result3 = $co->readCity($stateId);
										//echo $co->ta->sql;
											if ($result3 != false) {
												while ($row3 = mysqli_fetch_assoc($result3)) {
													if (isset($usercityn) && $usercityn == $row3['city_id']) {
														$currentcityn = $row3['city_title'];
														$currentcity_id = $row3['city_id'];
													}
												}
											}
									};
								?>
								<?php
									if (!empty($currentcityn)) {
										echo $currentcityn;
									}
									if (!empty($currentstaten)) {
										echo ', ' . $currentstaten;
									}
									if (!empty($currentcountryn)) {
										echo ', ' . $currentcountryn;
									}
								?>
							</div>
						</div>

						<div class="col-md-3 col-sm-12">
							<div class="card-secondary">
								<div class="price">
									<?php if ($row['spPostingSlryRngFrm'] > 0) {
									echo $row['job_currency'] . ' ' . $row['spPostingSlryRngFrm'] . ' - ' . $row['job_currency'] . ' ' . $row['spPostingSlryRngTo'] . '';
									} ?>
								</div>
								<div class="avg-btn">
									<a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="avg-bid btn zoom1 apl-nw">APPLY NOW </a>
								</div>
								<div class="location-btn">
									<a href="#" class="loc-btn"><?php echo ucfirst($row["spPostingLocation"]); ?> </a>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div>

			</div>		
			</div>
		</div>


		</td>

		<?php
		}
	}
	} else {
		echo "<h3 style='text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>";
	}
	}
	?>
</tr>
<?php ?>
</table>

</div>

</div>


</div>



</div>

</section>

<div class="space"></div>
<?php if ($res > 10) { ?>
<div id="pagination-container"></div>
<?php } ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
<script>
var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 10;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function(pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.show().slice(showFrom, showTo).show();
}
});
</script>
<!--     <section class="bg_white job_search">
<div class="container">
<div class="row">
<div class="col-md-6 right_left_jobboard">
<h1>Trending Companies (<a href="<?php echo $BaseUrl . '/job-board/trend-cmpany.php'; ?>">View All</a>)</h1>
<div class="space-lg"></div>
<?php
$limitpr = 3;
$p = new _jobpostings;
$pro = new _spprofiles;
$result3 = $pro->readBusProfiles($limitpr);
//echo $pro->ta->sql;
if ($result3) {
while ($row3 = mysqli_fetch_assoc($result3)) {

//get company
$c = new _profilefield;
$r = $c->read($row3['idspProfiles']);
if ($r) {
$cmpnyName = '';
$CmpnySize = '';
while ($row4 = mysqli_fetch_assoc($r)) {
if ($cmpnyName == '') {
if ($row4['spProfileFieldName'] == 'companyname_') {
$cmpnyName = $row4['spProfileFieldValue'];
}
}
if ($CmpnySize == '') {
if ($row4['spProfileFieldName'] == 'CompanySize_') {
$CmpnySize = $row4['spProfileFieldValue'];
}
}
}
} else {
$cmpnyName = "Not Define";
}

//get the total post which is open
$result5 = $p->readOpenJobs($row3['idspProfiles']);
//echo $p->ta->sql;
if ($result5) {
$totalJob = $result5->num_rows;
} else {
$totalJob = 0;
}

?>
<div class="trndpost">
<?php
$result4 = $pro->read($row3['idspProfiles']);
if ($result4 != false) {
$row4 = mysqli_fetch_assoc($result4);
if (isset($row4["spProfilePic"])) {
echo "<img alt='profile pic' class='img-responsive' src=' " . ($row4["spProfilePic"]) . "'  >";
} else {
echo "<img alt='profilepic' class='img-responsive' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
}
}
?>
<div class="">
<p class="titlejob">
<a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $row4['idspProfiles']; ?>"><?php echo $cmpnyName; ?></a>
<span class="pull-right">
<a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $row4['idspProfiles']; ?>"><?php echo $totalJob; ?> Position openings </a>
</span>
</p>
<p class="postingng">Company Size: <?php echo ($CmpnySize == '') ? "Not Define" : $CmpnySize; ?></p>
</div>
</div><?php
}
}
?>



</div>
<div class="col-md-6 right_left_jobboard">
<h1>Recent Job Offers (<a href="<?php echo $BaseUrl . '/job-board/all-jobs.php'; ?>">View All</a>)</h1>
<div class="space-lg"></div>
<?php
$limit = 3;
$p   = new _jobpostings;
$pf  = new _postfield;
$res = $p->publicpost_jobBoard($limit, 2);
//echo $p->ta->sql;
if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {

$postingDate = $p->spPostingDate($row["spPostingDate"]);
$exdt = new DateTime($row['spPostingExpDt']);

/*$result6 = $p->readPostCmpnySize($row['idspPostings']);
// echo $p->ta->sql;
if($result6!=false){
$row6 = mysqli_fetch_assoc($result6);
$CmpnySize = "Over".$row6['spPostFieldValue'];
}else{
$CmpnySize = "Not Define";
}*/
?>
<div class="trndpost">
<?php
$result4 = $pro->read($row['idspProfiles']);
if ($result4 != false) {
$row4 = mysqli_fetch_assoc($result4);
if (isset($row4["spProfilePic"])) {
echo "<img alt='profile pic' class='img-responsive' src=' " . ($row4["spProfilePic"]) . "' style='display:inline'; >";
} else {
echo "<img alt='profilepic' class='img-responsive' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' style='display:inline'; >";
}
}
?>

<p class="aplyjob pull-right"><?php echo $exdt->format('d M, Y') ?></p>
<div class="">
<p class="titlejob"><a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo $row['spPostingtitle']; ?></a> <span class="pull-right">Apply</span></p>
<p class="postingng">Company Size: <?php echo $CmpnySize; ?></p>
</div>
</div>
<?php
}
}

?>




</div>
</div>
</div>
</section> -->
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<section class="jobbox">
<div class="container">
<div class="row text-center">
<?php
//print_r($_SESSION);
//die('==');
if ($_SESSION['ptid'] != 5) {
?>
<div class="col-md-offset-1 col-md-10 no-padding">
<div class="blue_left">
<h1>Hire an employee</h1>
<?php
$all = new _spAllStoreForm;
$result4 = $all->readContent(2);
if ($result4 != false) {
$row4 = mysqli_fetch_assoc($result4);
echo "<p>" . $row4['contDesc'] . "</p>";
}
?>

<!--<a href="<?php echo $BaseUrl . '/job-board/all-jobseeker.php?cat=ALL&offset=0'; ?>" >Hire Today</a>-->
<a href="<?php echo $BaseUrl . '/job-board/all-jobseeker.php?cat=ALL&offset=0'; ?>">Hire Today</a>
</div>
</div>
<?php } else if ($_SESSION['ptid'] != 1) { ?>
<div class="col-md-offset-1 col-md-10 no-padding">
<div class="darkblue_right">
<h1>Looking for a job</h1>
<?php
$all = new _spAllStoreForm;
$result4 = $all->readContent(3);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
echo "<p>" . $row4['contDesc'] . "</p>";
}
?>

<a href="<?php echo $BaseUrl . '/job-board/all-jobs.php'; ?>">Find Job</a>
</div>
</div>
<?php } ?>
</div>
</div>
</section>
<?php } ?>
<!--<section class="findCandidate">
<div class="container">
<div class="row">
<h2>Find your <span>Best Candidate</span> at Sharepage</h2>
<div class="col-xs-12 search-freelancer" id="jobboard">
<div class="">
<p class="desc">Donec tincidunt felis quam, eu tempus purus finibus in. Curabitur hendrerit, odio in viverra interdum, lorem velit scelerisque ipsum, a sagittis ligula leo in dolor. Etiam vestibulum.</p>
<div class="col-xs-12 freelancers-ids">
<div class="owl-carousel owl-theme">
<?php

$pro = new _spprofiles;
//die('=gggg===');
$result7 = $pro->profileTypePerson(5, $_SESSION['uid']);
//echo $pro->ta->sql;
if ($result7 != false) {
while ($rows = mysqli_fetch_assoc($result7)) { ?>
<div class="item">
<div class="freelancer-content">
<div class="avatar">
<a href="<?php echo $BaseUrl . '/job-board/user-profile.php?pid=' . $rows['idspProfiles']; ?>">
<?php
$picture = $rows['spProfilePic'];
if (isset($picture)) {
echo "<img  alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else {
echo "<img  alt='Posting Pic' class='img-responsive' src='../img/default-profile.png' >";
}

?>
</a>
</div>
<div class="col-xs-12 nopadding">
<h5 class="freelancer-name" id="jobseaker-name"><a href="<?php echo $BaseUrl . '/job-board/user-profile.php?pid=' . $rows['idspProfiles']; ?>"><?php echo $rows["spProfileName"]; ?></a></h5>
<?php
$fi = new _profilefield;
$result_fi = $fi->getType($rows['idspProfiles']);
//echo $fi->ta->sql;
if ($result_fi) {
$row_fi = mysqli_fetch_assoc($result_fi);
$pro = new _projecttype;
$result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
//echo $pro->ta->sql;
if ($result_pro) {
$row_pr = mysqli_fetch_assoc($result_pro);
$ProjectName = $row_pr['project_title'];
} else {
$ProjectName = "Not Define";
}
} else {
$ProjectName = "Not Define";
}
//gettotal skills
$result_sk = $fi->getSkill($rows['idspProfiles']);
if ($result_sk) {
$row_sk = mysqli_fetch_assoc($result_sk);
$string_sk = explode(',', $row_sk['spProfileFieldValue']);
$totalSkil = count($string_sk);
//print_r($string_sk);
} else {
$totalSkil = 0;
}
?>
<p class="freelancer-designation"><?php echo $ProjectName; ?></p>
<p class="skill-rating">Skills: (<span><?php echo $totalSkil; ?> Skills</span>)</p>
<div class="progress-wrap progress" data-progress-percent="25">
<div class="progress-bar progress"></div>
</div>
<p class="job-success">Job Success <span>70%</span></p>
<div class="progress-wrap progress">
<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
<span class="sr-only">70% Complete</span>
</div>
</div>

</div>
</div>
</div>
<?php
}
}
?>


</div>
</div>
</div>
</div>
</div>
</div>
</section>-->






<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
}
?>




<script type="text/javascript">
//==========ON CHANGE LOAD CITY==========
$("#spUserState").on("change", function() {

var state = this.value;
$.post("loadUserCity.php", {
state: state
}, function(r) {
//alert(r);
$(".loadCity").html(r);
});

});
//==========ON CHANGE LOAD CITY==========
</script>
