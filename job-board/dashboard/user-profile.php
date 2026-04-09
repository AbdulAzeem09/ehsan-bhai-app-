<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php

include('../univ/baseurl.php');

session_start();
if(!isset($_SESSION['pid'])){
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_GET['pid']) && $_GET['pid'] >0)
{
$profileId = $_GET['pid'];
}
else
{
header('location:'.$BaseUrl.'/job-board');
}

$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 7;

$f = new _spprofiles;
$sl = new _shortlist;

$pid = $_GET['pid'];

$conn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
$sql = "SELECT * FROM spemployment_profile Where spprofiles_idspProfiles='$pid'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {

$tagline = $row['profile_tagline'];
$education = $row['education_level'];
$experience = $row['experience'];
$degree = $row['degree'];
$hobbies = $row['hobbies'];
$category = $row['category'];
$graduate = $row['graduate'];
$skill = $row['skill'];
$skillssa = explode(",", $skill);
$achievements = $row['achievements'];
$certification = $row['certification'];
$about = $row['spProfileAbout'];
}
}
$em = new _spemployment_profile;

$resemp = $em->read($pid);

if ($resemp != false)
{
$row4 = mysqli_fetch_assoc($resemp);
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>
<style>
ul li{
list-style-type: none;
}
</style>
<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectdetails userprofile" id="jobUserDetail">

<p class="back-to-projectlist"></p>
<?php
$sql = "SELECT * FROM spprofiles WHERE idspProfiles= '$pid'";
$result = mysqli_query($conn, $sql);
//echo $p->ta->sql;

if($result)
{
$row = mysqli_fetch_assoc($result);
/*print_r($row);*/
$Title = $row['spProfileName'];
$email = $row['spProfileEmail'];
$country = $row['spProfilesCountry'];
$city = $row['spProfilesCity'];
$picture = $row['spProfilePic'];

$phone = $row['spProfilePhone'];
$type = $row['spProfileType_idspProfileType'];
$country = $row['spProfilesCountry'];
$dob = $row['spProfilesDob'];
// $overview = $row['spProfileAbout'];
$fi = new _spprofiles;
$result_fi = $fi->read($row['idspProfiles']);
//echo $fi->ta->sql;
if($result_fi){
$ProjectName = '';
$perhour = '';
$skill = '';
while($row_fi = mysqli_fetch_assoc($result_fi)){

$skill = explode(',', $row_fi['skill']);
$overview = $row_fi['spProfileAbout'];
/*    if($skill == ''){
if($row_fi['spProfileFieldName'] == 'skill_'){
$skill = explode(',', $row_fi['spProfileFieldValue']);

}
}*/
}
}
}
?>
<div class="row">
<div class="col-md-3">
<h4> <a href="<?php echo $BaseUrl; ?>/job-board/all-jobseeker.php?cat=ALL&offset=0"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Home</a></h4>
<?php


if($_SESSION['pid'] != $_GET['pid']){

?>
<!--  <div class="col-xs-12 contact-marina">
<p class="contact-marina-heading">Contact <?php echo ucfirst($Title);?> to Discuss</p>
<div class="col-xs-12 contact-marina-content">
<form method="post" action="addchat.php" >
<input type="hidden" name="chat_date" value="<?php echo date('Y-m-d h:m');?>">
<input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid'];?>" >
<input type="hidden" name="receiver_idspProfiles" value="<?php echo $_GET['pid']; ?>" >
<input type="hidden" name="spProfileType_idspProfileType" value="5" >

<div class="form-group">
<textarea class="form-control inputField-textarea" name="chat_conversation" placeholder="Message"></textarea>
</div>
<div class="form-group">
<input type="submit" class="form-control inputSubmitField" value="Send Message">
</div>
</form>
</div>
</div> -->
<?php
}
?>
<!--   <div class="col-xs-12 profileLink">
<p>Profile Link</p>
<input type="text" name="" class="profileLinkField" value="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$profileId;?>">
</div>
-->

</div>
<div class="col-md-9 no-left-padding">
<?php
/*  include('top-job-search.php');
include('inner-breadcrumb.php');*/
?>
<div class="col-xs-12 profile-detail">

<div class="col-xs-12 col-sm-2 nopadding">
<?php
if(isset($picture)){
echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
}else{
echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
}
?>
</div>
<div class="col-xs-12 col-sm-10 freelancer-details">

<p class="name"><?php echo ucfirst($Title);?>&nbsp;&nbsp;<a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $profileId;?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a>

</p>

<!--  <?php
// COUNTRY
$co = new _country;
$result3 = $co->readCountryName($country);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
$country_Name = $row3['country_title'];
}
// CITY
$co = new _city;
$result5 = $co->readCityName($city);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
$city_Name = $row5['city_title'];
}
?>
<p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $city_Name. ', '.$country_Name; ?></p> -->
<div class="col-xs-12 col-sm-10 nopadding professional-skills">
<div class="col-xs-12 nopadding">
<p><?php echo $tagline ; ?></p>
</div>
</div>


</div>









<style>
.panel-body {
padding: 7px !important;
}
h4.heading12 {
margin-left: 20px;
}
</style>




<div class="row" style=" margin-top: 12px; ">
<div class="col-sm-12 mb-3" style=" margin-top: 43px; ">
<div class="row text-right">
<a class="btn btn-primary" href="#" onclick="chatWith(<?php echo $_GET['pid'];?>);">Message</a>

<div class="col-md-2 pull-right">
<select name="forma" class="form-control" id="selectinfo">
<option value="" id="more">--More--</option>
<option value="2">Send profile is a message</option>
<option value="3">Download Resume</option>
<option value="4">Recommend to someone</option>
<option value="5">Flag</option>
</select>
</div>
</div>
<br>
<?php

if($_GET['action']=="flag"){
$userid = $_SESSION['uid'];
$profid= $_GET['pid'];
//echo $userid;
//echo $profid;
$flagdata=array(
'userid'=>$userid,
'profileid'=>$profid
);

$flag_obj =	new	_flagpost;
$da = $flag_obj->getflagecount($userid,$profid);
// echo "<pre>"; print_r();exit;
if($da->num_rows > 0) {
echo "<script>alert('you have already flagged this post from another profile');</script>";
} else {
$flag_obj->createflagprofile($flagdata);
echo "<script>alert('Succesfully Flaged');</script>";
}




}
?>
<!--

<div class="container">
<div class="dropdown">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
<span class="caret"></span></button>
<ul class="dropdown-menu">
<li><a href="#">HTML</a></li>
<li><a href="#">CSS</a></li>
<li><a href="#">JavaScript</a></li>
</ul>
</div>
</div>
-->

<div class="panel panel-default">
<!----- <div class="panel-heading">
<h4 class="heading12">Personal Information</h4>
</div>----->
<!----<div class="panel panel-default" style=" margin-bottom: 0px; ">
<div class="panel-heading">
<div class="row">
<div class="col-md-3">
<b>Profile Name</b>
</div>
<div class="col-md-9">
<?php // echo ucfirst($Title);?>
</div>
</div>
</div>
</div>----->


<div class="panel-body">
<h4 class="heading12">Career Highlights</h4>

<ul class="careearhighs">
<?php
if(isset($skillssa) && $skillssa != ''){
foreach($skillssa as $key => $valuae){
echo "<li>".$valuae."</li>";
}
}else{
echo "No Sills Define";
}
?>
</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">About</h4>
<ul>
<li><?php echo $about;?></li>
</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Certification</h4>
<ul class="careearhighs">
<li><?php echo $certification; ?></li>
</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Experience</h4>  <br>
<?php
$cos = new _country;
$result33 = $cos->readCountry();
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($country) && $country == $row33['country_id']){
$currentcountry = $row33['country_title'];
$currentcountry_id = $row33['country_id'];

}
}
}

if (isset($state) && $state > 0) {
$countryId = $currentcountry_id;
$prs = new _state;
$result23 = $prs->readState($countryId);
if($result23 != false){
while ($row23 = mysqli_fetch_assoc($result23)) {
if(isset($state) && $state == $row23["state_id"] ){
$currentstate_id = $row23["state_id"];
$currentstate = $row23["state_title"];
}
}
}
}
if (isset($city) && $city > 0) {
$stateId = $currentstate_id;
$cos = new _city;
$result33 = $cos->readCity($stateId);
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($city) && $city == $row33['city_id']){
$currentcity = $row33['city_title'];
$currentcity_id = $row33['city_id'];
}																								}                                                                                             }
}
//$address=$currentcountry.', '.$currentstate.', '.$currentcity ;
?>
<div class="row">
<div class="col-md-1">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">
<b><?php echo $experience;?></b>  <br>
<span><?php echo $address;?></span>  <br>
</div>
</div>
<hr>
















<!---<div class="row">
<div class="col-md-2">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 40px;" />
</div>
<div class="col-md-10">
<b>Data Analyist/is Application Specialist</b>  <br>
<span>Lederal Government of Canada</span>  <br>
<span>Apr 2021 - Present - 10 yrs 10 mos</span>  <br>
<span>Surrey, BC</span>  <br> <br>
</div>
</div>
</ul>
<hr>--->
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Education</h4>  <br>

<div class="row">
<div class="col-md-1">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">
<b><?php echo $education;?></b>  <br>
</div>
</div>
<hr>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Accomplishments</h4>
<ul class="careearhighs">
<li style=" color: deepskyblue; "><?php echo $achievements;?></li>
<li>Certified</li>
</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Hobbies</h4>
<ul class="careearhighs">
<li><?php echo $hobbies;?></li>
<li></li>
</ul>
</div>
</div>

</div>
</div>












<?php $aa=0; if($aa==1){ ?>
<div class="col-xs-12 overview">
<p class="heading">Overviews</p>
<p class="details-description text-justify"><?php echo $overview;?></p>
<div class="row">
<div class="card-body">

<div class="container-fluid">

<div class="row">
<div class="col-lg-8">
<h4 class="mb-1">
<?php echo $_POST["pname"]; ?>

</h4>
<h5 class="fs-0 fw-normal"><?php  echo $row4["degree"]; ?></h5>
<p class="text-500"><?php echo $address_city;?></p>
<div >

<div class="border-dashed-bottom my-4 d-lg-none"></div>
</div>

</div>
</div>
</div>
<div class="row g-0">
<div class="col-lg-12 pe-lg-2">

<div class="card mb-3">
<div class="card-header bg-light d-flex justify-content-between">

<h4 class="mb-1"><b>Experience</b></h4>
<p><?php echo $experience;?></p>
</div>

<div class="container-fluid">

<div class="card-body fs--1 p-0" id="tbl_rec">

</div>

</div>
<br>
</div>

<div class="card mb-3">
<div class="card-header bg-light d-flex justify-content-between">

<h4 class="mb-1"><b> Qualifications</b>
</h4>
<?php

?>

<p><?php echo $education;?>&nbsp; <?php echo $category;?>&nbsp; <?php echo $degree;?>&nbsp; <?php echo $graduate;?></p><br>

</div>
</div>

<!-- Certification -->
<div class="card mb-3">
<div class="card-header bg-light">
<h4 class="mb-1"><b>Certification </b>
</h4>
</div>
<div class="card-body text-justify">
<p class="mb-0 text-1000" style="word-wrap: break-word;">
<?php echo $certification;?>
</p>
</div>
<br>
</div>
<!-- End Certification -->

<!-- Achievements -->

<div class="card mb-3">
<div class="card-header bg-light">
<h4 class="mb-1"><b>Achievements </b>
</h4>
</div>
<div class="card-body text-justify">
<p class="mb-0 text-1000" style="word-wrap: break-word;">
<?php echo $achievements;?>
</p>
</div>
<br>
</div>

<!-- end achievements -->

<!-- hobbies -->

<div class="card mb-3">
<div class="card-header bg-light">
<h4 class="mb-1"><b>Hobbies </b>
</h4>

</div>
<div class="card-body text-justify">
<p class="mb-0 text-1000" style="word-wrap: break-word;">
<?php echo $hobbies;?>
</p>
</div>
<br>
</div>

<!-- end hobbies -->
<!-- About Myself  -->
<div class="card mb-3">
<div class="card-header bg-light">
<h4 class="mb-1"><b> About Myself</b>
</h4>
</div>
<div class="card-body text-justify">
<p class="mb-0 text-1000">
<?php echo $about;?>
</p>
</div>
<br>
</div>
</div>
</div>
<a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
<!--     <div class="notification-avatar">
<div class="avatar avatar-xl me-3">
<div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📋️</span></div>
</div>
</div>
<div class="notification-body">
<p class="mb-1"><strong> </strong>  <strong> </strong>  <strong> </strong></p>
<span class="notification-time"> </span>
</div>
</a>

<a class="notification border-x-0 border-bottom-0 border-300 rounded-top-0" href="#!">
<div class="notification-avatar">
<div class="avatar avatar-xl me-3">
<div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📅️</span></div>
</div>
</div>-->
<div class="notification-body">
<p class="mb-1"><strong> </strong>  <strong> </strong> </p>
<span class="notification-time"> </span>
</div>
</a>

<!-- End Delete Design Modal -->


<!-- Certificates Section Scripts For Table  Management -->

<!-- Referances Table Start-->
<div class="modal fade" id="exampleModalCenter-referances" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">Referances</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="POST" id="ins_rec">
<div class="modal-body">
<div class="form-group">
<label><b>Referance Title</b></label>
<input type="text" name="username" class="form-control" placeholder="Username">
<span class="error-msg" id="msg_1"></span>
</div>
<div class="form-group">
<label><b>Referance Link</b></label>
<input type="text" name="email" class="form-control" placeholder="YourEmail@email.com">
<span class="error-msg" id="msg_2"></span>
</div>
<div class="mb-3">
<label class="col-form-label" for="message-text">Add Hobbies:</label>
<textarea class="form-control" id="message-text"></textarea>
</div>

<div class="form-group">
<span class="success-msg" id="sc_msg"></span>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary" > Add</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>

<!-- Referances Table End -->

<!-- Insert Design Modal -->


<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>


<script type="text/javascript">

$(document).ready(function (){
$('#tbl_rec').load('record.php');

$('#search').keyup(function (){
var search_data = $(this).val();
$('#tbl_rec').load('record.php', {keyword:search_data});
});

//insert Record

$('#ins_rec').on("submit", function(e){
e.preventDefault();
$.ajax({

type:'POST',
url:'insprocess.php',
data:$(this).serialize(),
success:function(vardata){

var json = JSON.parse(vardata);

if(json.status == 101){
console.log(json.msg);
$('#tbl_rec').load('record.php');
$('#ins_rec').trigger('reset');
$('#close_click').trigger('click');
}
else if(json.status == 102){
$('#sc_msg').text(json.msg);
console.log(json.msg);
}
else if(json.status == 103){
$('#msg_1').text(json.msg);
console.log(json.msg);
}
else if(json.status == 104){
$('#msg_2').text(json.msg);
console.log(json.msg);
}
else if(json.status == 105){
$('#msg_3').text(json.msg);
console.log(json.msg);
}
else if(json.status == 106){
$('#msg_4').text(json.msg);
console.log(json.msg);
}
else if(json.status == 107){
$('#msg_5').text(json.msg);
console.log(json.msg);
}
else{
console.log(json.msg);
}

}

});

});

//select data

$(document).on("click", "button.editdata", function(){
$('#umsg_1').text("");
$('#umsg_2').text("");
$('#umsg_3').text("");
$('#umsg_4').text("");
$('#umsg_5').text("");
$('#umsg_6').text("");
$('#umsg_7').text("");
var check_id = $(this).data('dataid');
$.getJSON("updateprocess.php", {checkid : check_id}, function(json){
if(json.status == 0){
$('#upd_1').val(json.username);
$('#upd_2').val(json.email);
$('#upd_3').val(json.country);
$('#upd_4').val(json.bod);
$('#upd_7').val(check_id);
if(json.gender == 'Male'){
$('#upd_5').prop("checked", true);
}
else{
$('#upd_6').prop("checked", true);
}
}
else{
console.log(json.msg);
}
});
});

//Update Record

$('#updata').on("submit", function(e){
e.preventDefault();

$.ajax({

type:'POST',
url:'updateprocess2.php',
data:$(this).serialize(),
success:function(vardata){

var json = JSON.parse(vardata);

if(json.status == 101){
console.log(json.msg);
$('#tbl_rec').load('record.php');
$('#ins_rec').trigger('reset');
$('#up_cancle').trigger('click');
}
else if(json.status == 102){
$('#umsg_6').text(json.msg);
console.log(json.msg);
}
else if(json.status == 103){
$('#umsg_1').text(json.msg);
console.log(json.msg);
}
else if(json.status == 104){
$('#umsg_2').text(json.msg);
console.log(json.msg);
}
else if(json.status == 105){
$('#umsg_3').text(json.msg);
console.log(json.msg);
}
else if(json.status == 107){
$('#umsg_4').text(json.msg);
console.log(json.msg);
}
else if(json.status == 106){
$('#umsg_5').text(json.msg);
console.log(json.msg);
}

else{
console.log(json.msg);
}

}

});

});

//delete record

var deleteid;

$(document).on("click", "button.deletedata", function(){
deleteid = $(this).data("dataid");
});

$('#deleterec').click(function (){
$.ajax({
type:'POST',
url:'deleteprocess.php',
data:{delete_id : deleteid},
success:function(data){
var json = JSON.parse(data);
if(json.status == 0){
$('#tbl_rec').load('record.php');
$('#de_cancle').trigger("click");
console.log(json.msg);
}
else{
console.log(json.msg);
}
}
});
});


});

function phoneprivacy(){

var address = $(".address").val();

$.ajax({
type: "POST",
url: "address.php",
cache:false,
data: {'address':address},
success: function(data) {

var obj = JSON.parse(data);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);

}
});
}







$(function() {

$('.dropdown > .caption').on('click', function() {
$(this).parent().toggleClass('open');
});

$('.dropdown > .list > .item').on('click', function() {
$('.dropdown > .list > .item').removeClass('selected');
$(this).addClass('selected').parent().parent().removeClass('open').children('.caption').text( $(this).text() );
});

$(document).on('keyup', function(evt) {
if ( (evt.keyCode || evt.which) === 27 ) {
$('.dropdown').removeClass('open');
}
});

$(document).on('click', function(evt) {
if ( $(evt.target).closest(".dropdown > .caption").length === 0 ) {
$('.dropdown').removeClass('open');
}
});

});



$('#selectinfo').change(function(){
var value = $(this).val();
if(value=="3"){
window.location= "<?php echo $BaseUrl; ?>/job-board/mpdffiles.php?pid=<?php echo $_GET['pid']; ?>";
//window.print();
}
else if(value=="5"){

//	$(location).prop('href', 'https://dev.thesharepage.com/job-board/user-profile.php?pid=1613');
$(location).prop('href', '<?php echo "https://" . $_SERVER['SERVER_NAME']; ?>/job-board/user-profile.php?action=flag&pid=<?php echo $_GET["pid"]; ?>');

//   window.location.href  =('user-profile.php?profid='<?php echo $profid ?>);
}
else if(value=="4"){
//	$(location).prop('href', 'https://dev.thesharepage.com/job-board/user-profile.php?pid=1613');
$(location).prop('href', '<?php echo "https://" . $_SERVER['SERVER_NAME']; ?>/job-board/user-profile.php?action=recommed&pid=<?php echo $_GET["pid"]; ?>');

//   window.location.href  =('user-profile.php?profid='<?php echo $profid ?>);

}
else if(value=="2"){
chatWith(<?php echo $_GET['pid'];?>);
}
});



</script>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>

<?php
} ?>
