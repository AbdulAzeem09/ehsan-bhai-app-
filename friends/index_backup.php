
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include('../univ/baseurl.php');
include( "../univ/main.php");
session_start();
$isFriendAlready = false; 

//print_r($_SESSION);die("===");
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="timeline/";
include_once ("../authentication/check.php");

}else{

function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_GET["profileid"]) && $_GET["profileid"] > 0) {
  $profile_id = (int) $_GET["profileid"];
} else {
  $profile_id = 0;
header('location:'.$BaseUrl.'/timeline'); 
}

$f = new _spprofilehasprofile;

//====================
//my friend list
//====================
//sender
$totalFrnd = array();


$resultr3 = $f->readallfriend($profile_id);
if($resultr3 != false) {
while ($row3 = mysqli_fetch_assoc($resultr3)) {

array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
}
}
//receiver
$resultr4 = $f->readall($profile_id);
if($resultr4 != false){
while ($row4 = mysqli_fetch_assoc($resultr4)) {

array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
}
}

if(!empty($totalFrnd)){
$totalFriendsofId = count($totalFrnd);
}else{
$totalFriendsofId = 0;
}
//====end my frnd list

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">




<!-- Magnific Popup core JS file111 -->

<!--   <link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css"> -->
<!--This script for posting timeline data End-->

<!--This script for sticky left and right sidebar STart-->
<!--  <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});
function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script> --> 
<!--This script for sticky left and right sidebar END-->
<!--NOTIFICATION-->

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/js/home.js"> -->
<!-- image gallery script end -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/custom.css"> -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<style>


.db_btn_friends{
display: inline-block!important;
padding: 7px 25px!important;
border: none!important;
border-radius: 5px!important;
color: #fff!important;
text-transform: capitalize!important;
font-size: 14px!important;
margin-right: 0px!important;
}


h5 {
font-size: 14px !important;
}
#tabprofile li.active a {
background-color: #613f90!important;
}

#Menu ul {display:none;}
#Menu { list-style:none;}
#Menu li:hover > ul {display:flex;    margin-top: -58px; margin-left:20px;}
#Menu li ul { margin:0; padding:0; position:absolute;z-index:5;padding-top:6px;}
#Menu li { float:left; margin-left:10px; }
#Menu li ul li { float:none; margin:0; display:inline;}
#Menu li ul li a {display:block; padding:6px 10px; background:#333; white-space:nowrap;}
#Menu li { display: list-item; text-align: -webkit-match-parent;}
#Menu ul { border:0; font-size:100%; font:inherit;vertical-align:baseline;}


.nav ul {
margin: 0;
padding: 0;
list-style: none;
}

.nav ul {
display: inline-block;
vertical-align: top;
font-size: 14px; 
}

.nav ul li {
position: relative;
float: left;
}

.nav ul li + li {
margin-left: 1px;
}

.nav ul li a {

display: inline-block;
text-decoration: none;
padding: 0px 20px;
-webkit-transition: all 0.1s ease-in;
-o-transition: all 0.1s ease-in;
transition: all 0.1s ease-in;
}


.nav ul li > ul {
display: none;
position: absolute;
width: 150px;
top: 100%;
left: -1px;
z-index: 5;
text-align: left;
}

.nav ul li > ul li {
float: none;
margin: -2px;
}

.nav ul li > ul li a {
display: flex;

}



.nav ul li.active {
pointer-events: none;
}


.navigation :hover {
display: flex !important;






}
</style>


<div id="testmodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Favourite Profiles Details</h4>
</div>
<div class="modal-body">
<p><b> </b><span id="user_name" style="font-size:20px;"></span></p>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<div id="testmodal-1" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close btn-border-radius" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Confirmation</h4>
</div>
<div class="modal-body">
<p>Do you want to save changes you made to document before closing?</p>
<p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary btn-border-radius">Save changes</button>
</div>
</div>
</div>
</div>










<script>
function postfunction(postid) {
//alert("===========");

$("#testmodal").modal('show');
//alert(postid);

$.ajax({
url: MAINURL+"/timeline/timepost.php", 
type: "POST",
data: {

postid: postid

},
success: function(response) {

$("#user_name").html(response);

console.log(response); 
}

});
}
</script>









<script>

$(document).ready(function(){
var show_btn=$('.show-modal');
var show_btn=$('.show-modal');
//$("#testmodal").modal('show');

show_btn.click(function(){
$("#testmodal").modal('show');
})
});

$(function() {
$('#element').on('click', function( e ) {
Custombox.open({
target: '#testmodal-1',
effect: 'fadein'
});
e.preventDefault();
});
});

</script>
</head>
<body class="bg_gray" onload="pageOnload('cart')">

<?php

if(!isset($_SESSION['pid']))
{   
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="cart/";
}

include_once("../header.php");
?>
<style>
html, body {

font-size: 13px!important;

}
</style>
<section class="landing_page">
<div class="container pubpost">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php');?>
</div>
<div class="col-md-10" >



<?php
$pp = new _spprofiles;
$rpvt = $pp->read($profile_id);
//echo $p->ta->sql;
if ($rpvt != false){

$row = mysqli_fetch_assoc($rpvt);
// print_r($row);
$name       = $row["spProfileName"];
$picture    = $row['spProfilePic'];
$about      = $row["spProfileAbout"];
$phone      = $row["spProfilePhone"];
$phonestatus        = $row["phone_status"];
$emailstatus        = $row["email_status"];
$relationship_status        = $row["relationship_status"];
$uid = $row["spUser_idspUser"];


$city       = $row["spProfilesCity"];
$profiletype        = $row["spProfileType_idspProfileType"];
$profileTypeName    = $row['spProfileTypeName'];
$icon       = $row["spprofiletypeicon"];
$ptypeid    = $row["idspProfileType"];
$email      = $row["spProfileEmail"];
$location   = $row["spprofilesLocation"];
$language   = $row["spprofilesLanguage"];
$address    = $row["spprofilesAddress"];
$profileaddress     = $row["address"];
$userImage = ($picture);
}

$pf = new _profilefield;
$res = $pf->read($profile_id);
//echo $pf->ta->sql;
$college = "";
$university = "";
$experiance = "";
$degree = "";
$percentage = "";
$graduates = "";
$achievement = "";
$certification = "";
if($res != false){

while($resultr = mysqli_fetch_assoc($res)){

$row[$resultr["spProfileFieldLabel"]] = $resultr["spProfileFieldValue"];

if($college == ''){
if($resultr['spProfileFieldName'] == 'college_'){
$college = $resultr['spProfileFieldValue'];
}
}
if($university == ''){
if($resultr['spProfileFieldName'] == 'university_'){
$university = $resultr['spProfileFieldValue'];
}
}
if($experiance == ''){
if($resultr['spProfileFieldName'] == 'experience_'){
$experiance = $resultr['spProfileFieldValue'];
}
}
if($degree == ''){
if($resultr['spProfileFieldName'] == 'degree_'){
$degree = $resultr['spProfileFieldValue'];
}
}
if($percentage == ''){
if($resultr['spProfileFieldName'] == 'percentage_'){
$percentage = $resultr['spProfileFieldValue'];
}
}
if($graduates == ''){
if($resultr['spProfileFieldName'] == 'graduate_'){
$graduates = $resultr['spProfileFieldValue'];
}
}
if($achievement == ''){
if($resultr['spProfileFieldName'] == 'achievements_'){
$achievement = $resultr['spProfileFieldValue'];
}
}
if($certification == ''){
if($resultr['spProfileFieldName'] == 'certification_'){
$certification = $resultr['spProfileFieldValue'];
}
}

}
}
//echo $row['idspProfiles'];
$s = new _spprofilehasprofile;  
$resultrs = $s->frndLeevel($_SESSION['pid'], $row['idspProfiles']);

$chkFriendForConn = $s->checkfriend($_SESSION["pid"],$profile_id);


// Show connection only for added as friend.

if($chkFriendForConn != false){
$chkFriendForConnRow = mysqli_fetch_assoc($chkFriendForConn);


if($resultrs == 0 && $chkFriendForConnRow['spProfiles_has_spProfileFlag'] == 1) { 

$level = '1st';
}else if($resultrs == 1){
$level = '1st';
}else if($resultrs == 2){
$level = '2nd';
}else if($resultrs == 3){
$level = '3rd';
}else{
$level = 'No';
}
}
else{

$level='3rd';
}

?>
<?php   
$fv = new _spprofilefeature;
$checkIsBlocked = $fv->chkBlock($_SESSION['pid'], $profile_id);
$checkIsBlocked2 = $fv->chkBlock($profile_id, $_SESSION['pid']); 
?>
<div class="post_timeline otherUserProfile m_top_10 bradius-15 bg-white " style="padding: 5px;">
<div class="row">
<div class="col-md-2">
<div class="">
<img id="profilepicture" alt="Profile Pic" class="img-responsive bradius-10" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>"
style="width: 143px; height: 143px;"
>
</div> 
</div>
<div class="col-md-9 no-padding" style="padding: 8px !important;">

<div class="otherProfileName">
<h3><span class="<?php //echo $icon; ?>"></span> <?php echo ucwords($name); ?> </h3>
<h4 class="no-margin">(<?php echo $profileTypeName;?> Profile)
<?php 
$checkfriend = $s->checkfriend($_SESSION["pid"],$profile_id);
if($checkfriend != false) {
$checkResult = mysqli_fetch_assoc($checkfriend);
if($checkResult['spProfiles_has_spProfileFlag'] == '1' && $checkIsBlocked == false && $checkIsBlocked2 == false) {
echo '-'.$level.' Connection';
}
}
?>
</h4>
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>


<div class="innerOtherProfile <?php //echo ($_SESSION['pid'] == $_GET['profileid'])?'hidden':'';?>">
<?php

if($_SESSION['pid'] != $profile_id){

$resultr = $s->checkfriend($_SESSION["pid"],$profile_id);

if($resultr != false){
$row2 = mysqli_fetch_assoc($resultr);

if($row2['spProfiles_has_spProfileFlag'] == '0' || $row2['spProfiles_has_spProfileFlag'] == ''){
$flag = -1; 
$isRequested = $s->checkFriendRequest($profile_id, $_SESSION["pid"]);
if ($isRequested) {
?>
<button type='button' id="" class='btn btn-success db_btn  acceptReqOfUser' data-sender='<?php echo $profile_id; ?>' data-receiver='<?php echo $_SESSION["pid"]; ?>'>
Accept Friend Request
</button>

<button type='button' id="" class='btn btn-danger db_btn rejectrequest_new' data-sender='<?php echo $profile_id; ?>' data-request="page" data-receiver='<?php echo $_SESSION["pid"]; ?>'>
Reject Request
</button>   
<span class="addbuttonaftercancel hide">
<button type="button" class="btn btnPosting db_btn btn" style="background-color: #3e2048;" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $profile_id;?>" ><span class="fa fa-user-plus"></span>&nbsp; Add Friend</button>
</span>
<?php } else { ?>
<span id = "sendrequest_for_hid">
<button  type="button" class="btn db_btn btn-danger" id="sendrequest_for" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $profile_id;?>" ><span class="fa fa-times"></span>&nbsp;  Cancel Request</button>  
</span>                                 
<?php }
}else if($row2['spProfiles_has_spProfileFlag'] == 1){ 
$flag = -1;
$isFriendAlready = true;
?>
<?php 
if($checkIsBlocked == false && $checkIsBlocked2 == false) { ?>
<button onclick="unfriend()"  type="button" class="btn btnPosting db_btn_friends db_primarybtn btn-border-radius" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $profile_id;?>" ><span class="fa fa-user"></span>&nbsp; Unfriend</button> 
<?php }
}else if($row2['spProfiles_has_spProfileFlag'] == -1){
$flag = 'NULL';
// Check if profile is not of user profiles at header.php.
if(!in_array($profile_id, $user_profiles_list, TRUE) && $checkIsBlocked == false && $checkIsBlocked2 == false) {
?>
<button type="button" class="btn btnPosting db_btn btn-border-radius" style="background-color: green;" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $profile_id;?>" ><span class="fa fa-user-plus"></span>&nbsp; Add Friend</button> 
<?php
}
}
}else{ 


$flag = -1;
// Check if profile is not of user profiles at header.php.
if(!in_array($profile_id, $user_profiles_list, TRUE) && $checkIsBlocked == false && $checkIsBlocked2 == false) {
?>
<span id="add_friend_11"> 
<button type="button" class="btn btnPosting db_btn" style="background-color:#3e2048;border-radius:5px!important;" id="sendrequest_now" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $profile_id;?>" ><span class="fa fa-user-plus"></span>&nbsp; Add Friend</button> 
</span>
<?php

}
}
?>
<!--Popup Box for sending message-->
<span  id="sendrequest_11"> 

</span>



<span  id="sendrequest_add_11"> 

</span>
<span class="dropdown">
<?php 
//if($checkIsBlocked == false && $checkIs.
//Blocked2 == false) { 
if($_SESSION['pid']!=$profile_id){


?>
<button type="button" class="btn btnPosting db_btn_friends  dropdown-toggle btn-border-radius" data-sender="" data-reciver="<?php echo $profile_id;?>" style="margin:0px;background-color:#3e2048;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane "></span> Send Message</button>
<?php
}
//} ?>
<div class="dropdown-menu bradius-15" id="popform" aria-labelledby="dropdownMenu1" style="margin-left: -160px; margin-top: 20px;">
<form action="" method="post">
<div class="form-group" style="margin:3px;">
<textarea class="form-control frndmsg" rows="4" id="sndmsg" name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
</div>

<button type="button"  class="btn btn-primary pull-right wthmsg db_btn db_primarybtn" data-reciver="<?php echo $profile_id;?>" data-sender="<?php echo $_SESSION['pid'];?>" id="sendermesg">Send</button>
</form>
</div>
</span>
<!--Done-->
<!-- Modal -->

<style>
.modal-backdrop.in {

opacity: .1;
}

.modal-backdrop {

z-index: 0;

}                    

</style>


<div id="ReportProfile" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius bradius-15 bg-white">
<form class="reportForm" method="post" action="favourite.php">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Report this profile</h4>
</div>
<div class="modal-body">
<div class="row">
<input type="hidden" name="idspProfileBy" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="idspProfileTo" value="<?php echo $profile_id;?>">
<div class="col-md-3">
<img id="profilepicture" alt="Profile Pic" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../assets/images/icon/blank-img.png");?>">
</div>
<div class="col-md-9">
<label><input type="radio" checked name="radReport" value="This person is annoying me">This person is annoying me</label>
<label><input type="radio" name="radReport" value="They're pretending to be me or someone I know">They're pretending to be me or someone I know</label>
<label><input type="radio" name="radReport" value="This is a fake account">This is a fake account</label>
<label><input type="radio" name="radReport" value="This profile represents a business or organization">This profile represents a business or organization</label>
<label><input type="radio" name="radReport" value="They're using a different name than they use in everyday life">They're using a different name than they use in everyday life</label>
<label><input type="radio" name="radReport" value="Others">Others</label>

</div>
</div>
</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="button" class="btn btn-danger btn-border-radius"  data-dismiss="modal">Close12345</button>
<button type="submit" class="btn btn-blue db_btn db_primarybtn btn-border-radius" name="btnReport">Submit</button>
</div>
</form>
</div>
</div>
</div>
<!-- Report , FLAG, and Block this profile -->
<div class="dropdown multiTask">


<button class="btn btnPosting db_btn_friends dropdown-toggle btn-border-radius" style="background-color:#3e2048;" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span></button>

<ul class="dropdown-menu">
<?php
$resultr3 = $fv->chkFavourite($_SESSION['pid'], $profile_id);
if($resultr3){ 
$flag = 0;
}else{
$flag = 1;
}
$resultr4 = $fv->chkBlock($_SESSION['pid'], $profile_id);
if($resultr4){
$block = 0;
}else{
$block = 1;
}
?>
<!-- <li><a class="<?php echo ($flag == 1)?'':'favpro';?>" href="<?php echo $BaseUrl.'/friends/favourite.php?flag='.$flag.'&by='.$_SESSION['pid'].'&to='.$_GET['profileid'];?>" >Flag</a></li> -->
<?php if($_SESSION['pid'] !== $profile_id){ ?>
<li>
<a href="javascript:void(0)" data-toggle="modal" data-target="#ReportProfile">Report</a>
</li>
<?php

if($isFriendAlready || $isFriendAlready == false  || $checkIsBlocked != false) {
?>
<li>

<!-- <a class="block_unblock" data-attr="<?php echo ($block == 0)?'Unblock':'Block';?>" href="<?php echo $BaseUrl.'/friends/favourite.php?block='.$block.'&by='.$_SESSION['pid'].'&to='.$_GET['profileid'];?>"><?php echo ($block == 0)?'Unblock':'Block';?>     
</a> -->


<a data-attr="<?php echo ($block == 0) ? 'Unblock' : 'Block'; ?>" onclick=" deactivate('<?php echo $BaseUrl . '/friends/favourite.php?block=' . $block . '&by=' . $_SESSION['pid'] . '&to=' . $profile_id; ?>')">
<?php echo ($block == 0) ? 'Unblock' : 'Block'; ?>
</a>





</li>


<?php } }?>
</ul>
</div>
<?php } ?>

</div> <?php } ?>

</div>
</div>
</div>
</div>

<?php 

$pp = new _spprofiles;
$rpvt = $pp->read($profile_id);
//echo $p->ta->sql;
if ($rpvt != false){

$row = mysqli_fetch_assoc($rpvt);
// print_r($row);
$profile_status         = $row["profile_status"];

}
$ab = 1;

if($profile_id == $_SESSION['pid']){
$profile_status = '';   
}

if(($profile_status == "public") || ($profile_status == "") ){ 
//if($ab == 1){  

?>
<div class="no-padding m_top_15">
<!--user data start-->
<div class="panel panel-primary no-margin no-radius Othertimeline bradius-15 bg-white">
<div>
<div class="row" style="margin-right: -9px;">
<div class="col-md-12">
<?php 
$bbbll = 2;
if($checkIsBlocked == false && $checkIsBlocked2 == false) {    
//if($bbbll == 2) {   
//echo 1;
?>
<ul class='nav nav-tabs' id='tabprofile' style="margin-left: 7px; margin-top: 7px;">
<li role="presentation" class="active"><a href="#srchtimeline" aria-controls="home" role="tab" data-toggle="tab">Timeline</a></li> 
<li role="presentation"><a href="#about" aria-controls="home" role="tab" data-toggle="tab" >About</a></li>
<li role="presentation"><a href="#friends" aria-controls="home" role="tab" data-toggle="tab">Friends  (<?php echo $totalFriendsofId;?>)</a></li>
<!-- <li role="presentation" class="<?php echo ($ptypeid == 5 ?"hidden":"") ?>"><a href="#str" aria-controls="home" role="tab" data-toggle="tab">Store</a></li> -->
<li role="presentation"><a href="#srchphotos" aria-controls="home" role="tab" data-toggle="tab">Photos</a></li>
<li role="presentation"><a href="#srchprod" aria-controls="home" role="tab" data-toggle="tab">Store</a></li>
<li role="presentation"><a href="#portfolio" aria-controls="home" role="tab" data-toggle="tab">Portfolio</a></li>
</ul>
<?php 
} else { ?>
<div class="row m_top_10">
<div class="col-md-12">
<b style="margin-left: 15px;color: lightslategrey;">
<i>Access rights are restricted to view profile.</i></b>
</div>
</div>
<?php 
} ?>
</div>
</div>

<!--Testing harikesh-->
<div class="tab-content no-radius otherTimleineBody 1111">
<!--Timeline-->


<div role="tabpanel" class="tab-pane active" id="srchtimeline" style="padding-left: 10px;padding-right: 10px;">
<div class="row m_top_10">
<div class="col-md-12 social" style="margin-bottom: 10px;" >
<?php
$timeline = new _postings;
$postShare = new _postshare;
$postShareData = $postShare->getSharePost($profile_id);
$shareDataArray = [];
if($postShareData != false){
while($rowsShare = mysqli_fetch_assoc($postShareData)){
$resultrShare = $timeline->getTimeLinePostUsr($rowsShare["spPostings_idspPostings"]);
if($resultrShare){
while($shareRows = mysqli_fetch_assoc($resultrShare)){
$shareRows['shareTime'] = strtotime($rowsShare['created']);
$shareRows['sharePostTime'] = $rowsShare['created'];
$shareDataArray[] = $shareRows;
}
}
}
}

$resultr21 = $timeline->readtimelines($profile_id);
//var_dump($resultr21);
$resultr = $timeline->readtimelinesbylimit($profile_id);
// var_dump($resultr);
//echo $count_num_rows;die;


if($resultr != false){
while($rows = mysqli_fetch_assoc($resultr)){
$rows['shareTime'] = strtotime($rows['spPostingDate']);
$rows['sharePostTime'] = $rows['spPostingDate'];
$shareDataArray[] = $rows;
}
}

$count_num_rows =count($shareDataArray ) ;


//echo '<pre>';
//print_r($shareDataArray);
//echo '</pre>';
//echo '<br>ffffffffffffffffffffffffffffff<br>';
$timelineIndex = [];
usort($shareDataArray, function($a, $b) {
//    return $a['shareTime'] <=> $b['shareTime'];
return $b["shareTime"] - $a["shareTime"];
});

//foreach ($shareDataArray as $index=>$item){
//    $date = new DateTime($item['spPostingDate']);
//    $timelineIndex[$index] = strtotime($date) ;
//}
//

//echo '<pre>';
//print_r($shareDataArray); 
//echo '</pre>';
?>

<?php

if(count($shareDataArray ) > 0){
foreach ($shareDataArray as $rows){
include('friend_data.php');
}
//while($rows = mysqli_fetch_assoc($resultr)){
//}

}

if($count_num_rows > 10){
?>

<h1 class="load-more" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer; font-size:25px!important;<?php if($block==0){ echo "display:none";}  ?>" >Load More</h1>
<input type="hidden" id="row" value="0">
<input type="hidden" id="all" value="<?php echo $count_num_rows; ?>"> 
<input type="hidden" id="profiddd" value="<?php echo $profile_id; ?>"> 

<?php } ?>



</div>
</div>
</div>



<?php
//include 'postshare.php';
//include '../publicpost/globaltimelineformEdit.php';
include 'Post_edit.php';
?>
<div role="tabpanel" class="tab-pane" id="about">
<div class="table-responsive m_top_10">
<table class="table table-striped">
<tbody>
<tr>
<td colspan="2">Personal Information</td>
</tr>
<?php
if($isFriendAlready) { 
?>
<tr>
<td style="width: 30%">Name</td>
<td><?php echo ucwords($name); ?></td>
</tr>
<?php
if($emailstatus == "public"){?>
<tr>
<td>Email</td>
<td><?php echo $email; ?></td>
</tr>
<?php } ?>
<?php
if($phonestatus == "public"){?>
<tr>
<td>Phone</td>
<td><?php echo $phone; ?></td>
</tr>
<?php } ?>
<?php if(!empty($relationship_status ) && $relationship_status != "Select"){ ?>
<tr>
<td>Relationship Status </td>
<td><?php echo $relationship_status; ?></td>
</tr>
<?php } ?>

<?php

$con = mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
die('Not Connected To Server');
}

//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected'; 
}
// print_r($_SESSION);
/*echo "SELECT * FROM userfamily WHERE spProfileId='".$_POST["pid"]."' ORDER BY id DESC";*/

//$querym = mysqli_query($con,"SELECT * FROM userfamily WHERE  spProfileId='".$_POST['pid']."' ORDER BY id DESC");

$querym = mysqli_query($con,"SELECT * FROM userfamily WHERE spuserId='".$uid."' ORDER BY id DESC");
if(mysqli_num_rows($querym) > 0) {

?>

<tr>
<td>Family</td>
<td>
<ol>
<?php
if($querym){

while($member = mysqli_fetch_array($querym)) {

?>
<li><?php echo ucwords($member['membername']);?> (<?php echo $member['memberrelation'] ;?>)</li>
<?php }
}                                       ?>
</ol>
</td>
</tr>
<?php } ?>
<?php if(!empty($profileaddress)){ ?>           
<tr>
<td>Address</td>
<td><?php echo $profileaddress; ?></td>

</tr>
<?php } ?>
<!-- <tr>
<td>Country</td>
<td><?php echo $country; ?></td>
</tr>
<tr>
<td>City</td>
<td><?php echo $city; ?></td>
</tr> -->
<!-- <tr>
<td>About</td>
<td><?php echo $about; ?></td>
</tr>

<tr>
<td>Address</td>
<td><?php echo $address; ?></td>
</tr> -->
<?php
$c = new _profilefield;
$r = $c->read($profile_id);
if($r != false){
while($rw = mysqli_fetch_assoc($r)){
?>
<!-- <tr>
<td><?php echo $rw["spProfileFieldLabel"];?></td>
<td><?php echo $rw["spProfileFieldValue"];?></td>
</tr> -->
<?php
}
}
?>
<?php } else { ?>
<tr>
<td style="text-align:center;font-size:25px;">No Info Found.</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div role="tabpanel" class="tab-pane" id="friends"> 
<div class="row m_top_10 m_btm_5 no-margin">
<div class="col-md-12 no-padding">
<div class="panel with-nav-tabs panel-default no-radius" style="border-color:transparent;">
<div class="panel-heading no-padding no-radius" style="border-color: transparent;background-color: transparent;">
<ul class="nav nav-tabs" id='navtabFrnd' style="border-bottom: none;">
<li class="active"><a href="#tabAllFrnd" data-toggle="tab">Friends</a></li>
<li><a href="#tabMutualFrnd" data-toggle="tab">Mutual Friends</a></li>
<li><a href="#tabConnectFrnd" data-toggle="tab">Connection Level</a></li>

</ul>
</div>
<div class="panel-body" style="padding: 5px;">
<div class="tab-content">
<div class="tab-pane fade in active" id="tabAllFrnd">
<?php include("allsearchfriend.php"); ?>
</div>
<div class="tab-pane fade" id="tabMutualFrnd">
<?php include("mutualfriend.php"); ?>
</div>
<div class="tab-pane fade" id="tabConnectFrnd">
<?php include('connecting.php');?>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div role="tabpanel" class="tab-pane social" id="str">
<div class="row no-margin m_top_10">
<?php
$_GET["publictimeline"] = 8;
$_GET["friendid"] = $profile_id;
include("store-detail.php");
include("../publicpost/postshare.php")
?>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="srchphotos"> 
<div >
<?php include("photos.php");
?>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="srchprod"> 
<div >
<?php include("mystore.php");
?>
</div>
</div>      
<div role="tabpanel" class="tab-pane" id="portfolio"> 
<div >
<?php include("portfolio.php");
?>
</div>
</div>                                  


</div>
<!--Testing Complete  harikesh-->
</div>
</div>
</div>

<?php } ?>



</div>


</div>
</section>

<div><br><br></div>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

<?php

} 
?>
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>

<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>
<!-----
<script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>
---->
<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
// Colorbox Call
$(document).ready(function(){
$("[rel^='lightbox']").prettyPhoto();
});
</script>

<script>
$(document).ready(function(){
// Load more data
$('.load-more').click(function(){

var row = Number($('#row').val());
var allcount = Number($('#all').val());
row = row + 10;

if(row <= allcount){

$("#row").val(row);
var profileid = $("#profiddd").val();


$.ajax({
url: 'more_data.php', 
type: 'post',
data: {row:row,profile:profileid},
beforeSend:function(){
$(".load-more").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".post:last").after(response).show().fadeIn("slow");


var rowno = row + 10;

// checking row value is greater than allcount or not
if(rowno > allcount){
$('.load-more').css("display","none");
}else{
$(".load-more").text("Load more");
}

}, 2000);
setTimeout(function() {
$(".load-morez").text("Load More");
}, 2000);
}
});
}else{
$('.load-more').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

// Reset the value of row
$("#row").val(0); 

// Change the text and background
$('.load-more').text("Load more");
$('.load-more').css("background","#15a9ce");
}, 2000);
}
});
});


</script>


<!-- image gallery script end -->


<script type="text/javascript">

$(document).ready( function() {
$(".block_unblock").click(function(){

var attr = $(".block_unblock").attr("data-attr");
var link = $(".block_unblock").attr("data-link");
//alert(link);
swal({
title: "Are you sure?",
text: "You will not be able to recover this imaginary file!",
type: "warning",
showCancelButton: true,
confirmButtonColor: '#DD6B55',
confirmButtonText: 'Yes, I am sure!',
cancelButtonText: "No, cancel it!",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){

if (isConfirm){
window.location.href=link;

} else {
swal("Cancelled", "Your imaginary file is safe :)", "error");
e.preventDefault();
}
});

})






$("#sendrequest_now").click( function (i, e) {
var btn = this;
var senderId  = $(this).data("sender");
var reciverId  = $(this).data("reciver");
var profilename  = $(this).data("profilename");     
var flag  = $(this).data("flag");
// alert(flag);

$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {

// window.location.reload();
// $('#sendrequest_11').show();
// alert('hello');
var can_button ='<button onclick="req_fun('+flag+','+senderId+','+reciverId+')" type="button" class="btn db_btn btn-danger cancel11" id="" data-flag="'+flag+'" data-profilename="'+profilename+'" data-sender="'+senderId+'" data-reciver="'+reciverId+'" ><span class="fa fa-times"></span>&nbsp;  Cancel Request</button>'; 
swal("Request Send Successfully");
//alert(can_button);
$('#add_friend_11').hide(); 
$('#sendrequest_add_11').hide();  
alert('ddddd');
//$('#sendrequest_11').show(); 
$('#sendrequest_11').html(can_button);      

});
window.location.reload(); 
});

//Accept Friend Request
$(".acceptReqOfUser_1").on("click", function () {
$.post('../friends/accept.php', {sender: $(this).data("sender"), receiver: $(this).data("receiver")}, function (d) {
location.reload();
});
});
});




function req_fun(a,b,c){
var senderId  = b;
var reciverId  = c;
//var profilename  = 
var flag  = a;

$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, flag:flag}, function (d) {

// alert('hello');
var add_button ='<button onclick="add_fun('+flag+','+senderId+','+reciverId+')" type="button" class="btn btnPosting db_btn " style="background-color:#3e2048;" id="" data-flag="'+flag+'" data-sender="'+senderId+'" data-reciver="'+reciverId+'" ><span class="fa fa-user-plus"></span>&nbsp; Add Friend</button>';  

swal("Request Cancel Successfully");
// alert(add_button);
$('#sendrequest_11').hide();  
$('#sendrequest_add_11').show();  
$('#sendrequest_add_11').html(add_button);    

window.location.reload();
});
}


// function unfriend(){

//     swal({
//   title: 'Are you sure?',
//   text: "It will permanently deleted !",
//   type: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes, delete it!'
// }).then(function() {
//   swal(
//     'Deleted!',
//     'Your file has been deleted.',
//     'success'
//   );
// })

//     return false;
// } 




function add_fun(a,b,c){
var senderId  = b;
var reciverId  = c;
//var profilename  = 
var flag  = a;

$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, flag:flag}, function (d) {

// window.location.reload();
// $('#sendrequest_11').show();
// alert('hello');
var can_button ='<button onclick="req_fun('+flag+','+senderId+','+reciverId+')" type="button" class="btn db_btn btn-danger " id="" data-flag="'+flag+'"  data-sender="'+senderId+'" data-reciver="'+reciverId+'" ><span class="fa fa-times"></span>&nbsp;  Cancel Request</button>'; 
swal("Request Send Successfully");
// alert(can_button);
$('#add_friend_11').hide(); 
$('#sendrequest_add_11').hide(); 
$('#sendrequest_11').show(); 
$('#sendrequest_11').html(can_button);     
});
}

$(document).ready( function() {
$("#sendrequest").click( function (i, e) {
//alert('hello');
var btn = this;
var senderId  = $(this).data("sender");
var reciverId  = $(this).data("reciver");
var profilename  = $(this).data("profilename");
var flag  = $(this).data("flag");

$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {

window.location.reload();
});






});



$("#sendrequest_for").click( function (i, e) {

var btn = this;  
var senderId  = $(this).data("sender");
var reciverId  = $(this).data("reciver");
var profilename  = $(this).data("profilename");
var flag  = $(this).data("flag");
// alert(flag);
// alert('cav');
$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {

// alert('hello');
var add_button ='<button onclick="add_fun('+flag+','+senderId+','+reciverId+')" type="button" class="btn btnPosting db_btn " style="background-color:#3e2048;" id="" data-flag="'+flag+'" data-sender="'+senderId+'" data-reciver="'+reciverId+'" ><span class="fa fa-user-plus"></span>&nbsp; Add Friend</button>';  

swal("Request Cancel Successfully");
// alert(add_button);
$('#sendrequest_for_hid').hide();  
$('#sendrequest_11').hide();  
$('#sendrequest_add_11').show();  
$('#sendrequest_add_11').html(add_button); 
// alert('cav11');   

//window.location.reload();
});
window.location.reload();
});


$("#sendrequest_add").click( function (i, e) {
//alert('hello');
var btn = this;
var senderId  = $(this).data("sender");
var reciverId  = $(this).data("reciver");
var profilename  = $(this).data("profilename");
var flag  = $(this).data("flag");
$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {
alert('hello');
//window.location.reload();
});
});

//Accept Friend Request
$(".acceptReqOfUser").on("click", function () {
$.post('../friends/accept.php', {sender: $(this).data("sender"), receiver: $(this).data("receiver")}, function (d) {
location.reload();
});
});
});
// acti
function flagpost(postid){

/*$("#radReport").();

alert($("#radReport").val());*/
if ($('input[name="radReport"]:checked').length == 0) {
var logo = "../assets/images/logo/tsplogo.PNG";

swal({
title: "Please Select a Reason to Flag.",
imageUrl: logo
});
return false; 
}else {
///alert("checked");





swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {


$.ajax({
url: "../publicpost/flagpost.php",
type: "POST",
data:  $("#flagpostfrm"+postid).serialize(),
dataType: "text",
success: function(vi){

$("#flag"+postid).hide();
$("#unflag"+postid).show();

$("#myModal"+postid).hide();
$(".modal-backdrop").remove();

$("body").removeClass("modal-open");

var logo = "../assets/images/logo/tsplogo.PNG";


swal({
title: "Flagged successfully.",
imageUrl: logo
});

},
error: function(error){

}          
});

}
});

}
}

//POST LIKE

$(".sp-like").click(function(){
var btnLike = this;
var liked = $(this).attr("data-liked");
$.post("../social/addlike.php", {postid: $(this).data("postid"), pid: $(".dynamic-pid").val()}, function (response) {
$(btnLike).attr({class: 'icon-socialise fa fa-thumbs-up spunlike faa-vertical'});
if (liked != false){
liked++;
$(btnLike).text(" (" + liked + ")");
$(btnLike).attr("data-liked", liked);
} else{
liked++;
$(btnLike).text(" (" + liked + ")");
$(btnLike).attr("data-liked", liked);
}
});
});
/*    $(".social").unbind().on("click", ".sp-like", function () {

alert();
var btnLike = this;
var liked = $(this).attr("data-liked");
$.post("../social/addlike.php", {postid: $(this).data("postid"), pid: $(".dynamic-pid").val()}, function (response) {
$(btnLike).attr({class: 'icon-socialise fa fa-thumbs-up spunlike faa-vertical'});
if (liked != false){
liked++;
$(btnLike).text(" (" + liked + ")");
$(btnLike).attr("data-liked", liked);
} else{
liked++;
$(btnLike).text(" (" + liked + ")");
$(btnLike).attr("data-liked", liked);
}
});
});
*/
//POST UN-LIKE
$(".social").on("click", ".spunlike", function () {
var btnunlike = this;
var liked = $(this).attr("data-liked");
$.post("../social/unlike.php", {postid: $(this).data("postid"), pid: $(".dynamic-pid").val()}, function (response) {
$(btnunlike).attr({class: 'icon-socialise sp-like fa fa-thumbs-o-up faa-vertical'});
if (liked != false)
{
if (liked == 1 || liked == 0)
{
$(btnunlike).text("");
$(btnunlike).attr("data-liked", 0);
//document.getElementById("spLikePost").innerText = " Like";
} else{
liked--;
$(btnunlike).text(" (" + liked + ")");
$(btnunlike).attr("data-liked", liked);
//document.getElementById("spLikePost").innerText = " Like";
}
}
});
});

$(".sp-favorites").click(function(){

var btnfavorites = this;
$.post(MAINURL+"/social/addfavorites.php", {postid: $(this).data("postid"), pid: $(".dynamic-pid").val()}, function (response) {
$(btnfavorites).attr({class: 'icon-favorites fa fa-heart removefavorites faa-pulse animated'});
//document.getElementById("spFavouritePost").innerText = " Unfavourite";
});
});
/*    $(".social").on("click", ".sp-favorites", function () {
var btnfavorites = this;
$.post(MAINURL+"/social/addfavorites.php", {postid: $(this).data("postid"), pid: $(".dynamic-pid").val()}, function (response) {
$(btnfavorites).attr({class: 'icon-favorites fa fa-heart removefavorites faa-pulse animated'});
//document.getElementById("spFavouritePost").innerText = " Unfavourite";
});
});*/
//POST REMOVE FAVORITES [FREELANCE]
$(".social").on("click", ".removefavorites", function () {


var btnremovefavorites = this;
$.post(MAINURL+"/social/deletefavorites.php", {postid: $(this).data("postid")}, function (response) {
//alert(response);
$(btnremovefavorites).attr({class: 'icon-favorites fa fa-heart-o sp-favorites faa-pulse animated'});
//document.getElementById("spFavouritePost").innerText = " Favourite";
});
});


</script>
<!-- shan74 -->
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

<script type="text/javascript">

$('.thumbnail').magnificPopup({
type: 'image'
// other options
});

</script>

<script type="text/javascript">
$( document ).ready(function() {

$('.timelin_comm_text').keydown(function(e){
if(e.keyCode == 13)
{
e.preventDefault();
var postid = $(this).attr("data-id");

var txtIndusrtyType = $(this).val();
var flag=0;

if (txtIndusrtyType!="")
{
var strArr = new Array();
strArr = txtIndusrtyType.split("");

if(strArr[0]==" ")
{
flag=1;
} 
}

if(txtIndusrtyType == ""){
$("#text_error_"+postid).text("Please Enter comment.");
return false;
}
else if(flag == 1){
$("#text_error_"+postid).text("Space not allowed.");
return false;
}
else{

var form = $("#comntformProfile_"+postid);
$.ajax({
type: "POST",
url: "../friends/addprofilecomment.php",
data: form.serialize(), // serializes the form's elements.
async : false,
cache: false,
processData:false,
success: function(data)
{   
var obj = JSON.parse(data);

$('#timelinecmnt_'+postid).remove(); 
$('#removec_'+ postid).css('display', 'none');
$("#comments_"+postid).html(obj.comment);
$(".single_comm_box_"+postid).val("");
}
});
}
}
});
});
</script>   

</body>
</html>


<script> 


$(".rcount").on("click", function(){
var postidr = $(this).attr("data-postidr");
//  var rdetails = $(".rcount").val();


$.ajax({
url: "../social/getReaction.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response){

$('#top_reaction').html(response);
},

});



$.ajax({
url: "../social/getReaction1.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response){

$('#bottom_reaction').html(response);
},

});

});

</script>   

<script>

/*
$(".main-ul").css("display", "none");

setTimeout(function () {
$(".main-ul").css("display", "flex");
}, 2000);
*/

$(".reactionbtn_remove").on("click", function(){
var rection =  "&#128077;&#127995;";


var postid = $(this).attr("data-postid");
var prid = $("#prid").val();
var usid = $("#usid").val();

$.ajax({
url: "../social/remove_reaction.php",
type: "POST",
data: {
spPostings_idspPostings: postid,
spProfiles_idspProfiles: prid
},
success: function(response){
//alert(response);
var a= $('#cuer'+postid).text();

var c = parseInt(a) - parseInt(response);
if(c>=1){
$('#cuer'+postid).text(c);
}
else{
$('#cuer'+postid).text("0");
}


$('#currentreaction_'+postid).html(rection);

//      $('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');        

//  $('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

},

});
});



$(".reactionbtn").on("click", function(){
var postid = $(this).attr("data-postid");
var reaction = $(this).attr("data-reaction");

var rid = $(this).attr("data-reaction");

if(rid == 1){
rection = "&#128525;";
}

if(rid == 2){
rection = "&#128512;";
}
if(rid == 3){
rection = "&#128546;";
}
if(rid == 4){
rection = "&#129315;"; 
}
if(rid == 5){
rection = "&#128563;";
}
if(rid == 6){
rection = "&#128545;";
}

if(rid == 7){
rection = "&#128077";
}




var usid = $("#usid").val();
var prid = $("#prid").val();

$.ajax({
url: "../social/addlike.php",
type: "POST",
data: {
spPostings_idspPostings: postid,
spProfiles_idspProfiles: prid,
uid: usid,
Reaction_id: reaction,
},
success: function(response){
var a= $('#cuer'+postid).text();

var c = parseInt(a) + parseInt(response);

$('#cuer'+postid).text(c);  




$('#currentreaction_'+postid).html(rection);
//  $('#new_data_'+postid).html('<a id="currentreaction_'+postid+'" class="reactionbtn_remove" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');        
//                $('#currentreaction_'+postid).removeClass('reactionbtn').addClass('reactionbtn_remove');

},

});
});


</script>  

<script>
$(".navigation li").hover(function() {
var isHovered = $(this).is(":hover");
if (isHovered) {
$(this).children("ul").stop().slideDown(300);
} else {
$(this).children("ul").stop().slideUp(300);
}
});


</script>
<script>
// 222jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 4;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems, 
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});



</script>

<script type="">

$('.thumbnail').magnificPopup({
type: 'image'
// other options
});

$(document).ready(function(){
// Load more data
$('.load-more8').click(function(){
//alert("uyiyyyyyyyyyyyyyyyyy");
var row = Number($('#row78').val());
var allcount = $('#all78').val();
row = row + 10;

if(row <= allcount){

$("#row78").val(row);
var profileid = $("#profiddd78").val();


$.ajax({
url: 'more_store.php', 
type: 'post',
data: {row:row,profile:profileid},
beforeSend:function(){
$(".load-more8").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".item:last").after(response).show().fadeIn("slow");

$(".load-more8").text("Load More");
var rowno = row + 10;
// checking row value is greater than allcount or not
if(rowno > allcount){

$(".load-more8").css("display","none");
}else{

$(".load-more8").text("Load more");
}
$(".load-more8").text("Load More");
}, 2000);

}
});
}else{
$('.load-more8').text("Loading...");

// Setting little delay while removing contents  
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.item:nth-child(3)').nextAll('.item').remove().fadeIn("slow");

// Reset the value of row
$("#row78").val(0); 

// Change the text and background
$('.load-more8').text("Load more");
$('.load-more8').css("background","#15a9ce");
}, 2000);
}
});
});

</script>   

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">

$('.thumbnail').magnificPopup({
type: 'image'
// other options
});



$(document).ready(function(){
// Load more data
$('.load-more1').click(function(){
var row1 = Number($('#row1').val());
var allcount1 = Number($('#all1').val());
row1 = row1 + 8;

if(row1 <= allcount1){

$("#row1").val(row1);
var profileid1 = $("#profiddd1").val();


$.ajax({
url: 'more_pic.php', 
type: 'post',
data: {row:row1,profile:profileid1},
beforeSend:function(){
$(".load-more1").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".post1:last").after(response).show().fadeIn("slow");

$(".load-more1").text("Load More");
var rowno = row1 + 8;
// checking row value is greater than allcount or not
if(rowno > allcount1){
$('.load-more1').css("display","none");
}else{
$(".load-more1").text("Load more");
}
$(".load-more1").text("Load More");
}, 2000);
}
});
}else{
$('.load-more1').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
// $('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");

// Reset the value of row
// $("#row1").val(0); 

// Change the text and background
$('.load-more1').text("Load more");
$('.load-more1').css("background","#15a9ce");
}, 2000);
}
});
});

</script>   

<script>
function deactivate(ida){
//alert('====');
Swal.fire({
title: 'Are you sure you want to block this profile ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = ida;
}
});

}

</script>



