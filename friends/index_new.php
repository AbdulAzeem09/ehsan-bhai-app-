<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="timeline/";
include_once ("../authentication/check.php");

}else{

function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");




if(isset($_GET["profileid"]) && $_GET["profileid"] > 0){

}else{
header('location:'.$BaseUrl.'/timeline');
}

$f = new _spprofilehasprofile;

//====================
//my friend list
//====================
//sender
$totalFrnd = array();
$result3 = $f->readallfriend($_GET['profileid']);
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
}
}
//receiver
$result4 = $f->readall($_GET['profileid']);
if($result4 != false){
while ($row4 = mysqli_fetch_assoc($result4)) {
array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
}
}
//print_r($totalFrnd);
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
<!--This script for posting timeline data End-->

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
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

</script>
<!--This script for sticky left and right sidebar END-->
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/custom.css">
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
<section class="landing_page">
<div class="container pubpost">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php');?>
</div>
<div class="col-md-7" >



<?php



$p = new _spprofiles;
$rpvt = $p->read($_GET["profileid"]);
//echo $p->ta->sql;
if ($rpvt != false){
$row = mysqli_fetch_assoc($rpvt);
$name 		= $row["spProfileName"];
$picture 	= $row['spProfilePic'];
$about 		= $row["spProfileAbout"];
$phone 		= $row["spProfilePhone"];


// $co = new _country;
//$result3 = $co->readCountryName( $row["spProfilesCountry"];);

// print_r($result3);
//$country = $result3;

//$country 	= $row["spProfilesCountry"];
$city  		= $row["spProfilesCity"];
$profiletype 		= $row["spProfileType_idspProfileType"];
$profileTypeName 	= $row['spProfileTypeName'];
$icon 		= $row["spprofiletypeicon"];
$ptypeid 	= $row["idspProfileType"];
$email 		= $row["spProfileEmail"];
$location 	= $row["spprofilesLocation"];
$language 	= $row["spprofilesLanguage"];
$address 	= $row["spprofilesAddress"];
}

$pf = new _profilefield;
$res = $pf->read($_GET["profileid"]);
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
while($result = mysqli_fetch_assoc($res)){

$row[$result["spProfileFieldLabel"]] = $result["spProfileFieldValue"];

if($college == ''){
if($result['spProfileFieldName'] == 'college_'){
$college = $result['spProfileFieldValue'];
}
}
if($university == ''){
if($result['spProfileFieldName'] == 'university_'){
$university = $result['spProfileFieldValue'];
}
}
if($experiance == ''){
if($result['spProfileFieldName'] == 'experience_'){
$experiance = $result['spProfileFieldValue'];
}
}
if($degree == ''){
if($result['spProfileFieldName'] == 'degree_'){
$degree = $result['spProfileFieldValue'];
}
}
if($percentage == ''){
if($result['spProfileFieldName'] == 'percentage_'){
$percentage = $result['spProfileFieldValue'];
}
}
if($graduates == ''){
if($result['spProfileFieldName'] == 'graduate_'){
$graduates = $result['spProfileFieldValue'];
}
}
if($achievement == ''){
if($result['spProfileFieldName'] == 'achievements_'){
$achievement = $result['spProfileFieldValue'];
}
}
if($certification == ''){
if($result['spProfileFieldName'] == 'certification_'){
$certification = $result['spProfileFieldValue'];
}
}

}
}
$s = new _spprofilehasprofile;	
$results = $s->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
//echo $pr->ta->sql;
if($results == 0){
$level = '1st';
}else if($results == 1){
$level = '1st';
}else if($results == 2){
$level = '2nd';
}else if($results == 3){
$level = '3rd';
}else{
$level = 'No';
}
?>

<div class="post_timeline otherUserProfile m_top_10 bradius-15 bg-white" style="padding: 10px;">
<div class="row">
<div class="col-md-3">
<div class="">
<img id="profilepicture" alt="Profile Pic" class="img-responsive pb_10 bradius-10" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
</div>
</div>
<div class="col-md-9 no-padding">
<div class="otherProfileName">
<h3><span class="<?php echo $icon; ?>"></span> <?php echo ucfirst($name); ?> </h3>
<h4 class="no-margin">(<?php echo $profileTypeName;?> Profile) - <?php echo $level;?> Connection</h4>
<div class="innerOtherProfile <?php echo ($_SESSION['pid'] == $_GET['profileid'])?'hidden':'';?>">
<?php

$result = $s->checkfriend($_SESSION["pid"],$_GET["profileid"]);
//echo $s->ta->sql;
if($result != false){
$row2 = mysqli_fetch_assoc($result);

if($row2['spProfiles_has_spProfileFlag'] == '0' || $row2['spProfiles_has_spProfileFlag'] == ''){
$flag = -1; ?>
<button type="button" class="btn btn-success " id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $_GET["profileid"];?>" ><span class="fa fa-times"></span> Cancel Friend Request</button> <?php
}else if($row2['spProfiles_has_spProfileFlag'] == 1){ 
$flag = -1 ?>
<button type="button" class="btn btnPosting db_btn db_primarybtn" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $_GET["profileid"];?>" ><span class="fa fa-user"></span> Unfriend</button> <?php
}else if($row2['spProfiles_has_spProfileFlag'] == -1){
$flag = 'NULL'; ?>
<button type="button" class="btn btnPosting db_btn db_primarybtn" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $_GET["profileid"];?>" ><span class="fa fa-user-plus"></span> Add Friend</button> <?php
}
}else{ 
$flag = -1; ?>
<button type="button" class="btn btnPosting db_btn db_primarybtn" id="sendrequest" data-flag="<?php echo $flag;?>" data-profilename="<?php echo $name; ?>" data-sender="<?php echo $_SESSION["pid"];?>" data-reciver="<?php echo $_GET["profileid"];?>" ><span class="fa fa-user-plus"></span> Add Friend</button> <?php
}
?>
<!--Popup Box for sending message-->
<span class="dropdown">
<button type="button" class="btn btnPosting db_btn db_primarybtn dropdown-toggle" data-sender="" data-reciver="<?php echo $_GET["profileid"];?>" style="margin:5px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane"></span> Send Message</button>

<div class="dropdown-menu" id="popform" aria-labelledby="dropdownMenu1">
<form action="" method="post">
<div class="form-group" style="margin:3px;">
<textarea class="form-control frndmsg" rows="4" id="sndmsg" name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
</div>

<button type="button" class="btn btn-primary pull-right wthmsg" data-reciver="<?php echo $_GET["profileid"];?>" data-sender="<?php echo $_SESSION['pid'];?>" id="sendermesg">Send</button>
</form>
</div>
</span>
<!--Done-->
<!-- Modal -->
<div id="ReportProfile" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">
<form class="reportForm" method="post" action="favourite.php">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Report this profile</h4>
</div>
<div class="modal-body">
<div class="row">
<input type="hidden" name="idspProfileBy" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="idspProfileTo" value="<?php echo $_GET['profileid'];?>">
<div class="col-md-3">
<img id="profilepicture" alt="Profile Pic" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
</div>
<div class="col-md-9">
<label><input type="radio" name="radReport" value="This person is annoying me">This person is annoying me</label>
<label><input type="radio" name="radReport" value="They're pretending to be me or someone I know">They're pretending to be me or someone I know</label>
<label><input type="radio" name="radReport" value="This is a fake account">This is a fake account</label>
<label><input type="radio" name="radReport" value="This profile represents a business or organization">This profile represents a business or organization</label>
<label><input type="radio" name="radReport" value="They're using a different name than they use in everyday life">They're using a different name than they use in everyday life</label>

</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn_gray" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn_blue" name="btnReport">Submit</button>
</div>
</form>
</div>
</div>
</div>
<!-- Report , FLAG, and Block this profile -->
<div class="dropdown multiTask">
<button class="btn btnPosting db_btn db_primarybtn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span></button>
<ul class="dropdown-menu">
<?php
$fv = new _spprofilefeature;
$result3 = $fv->chkFavourite($_SESSION['pid'], $_GET['profileid']);
if($result3){ 
$flag = 0;
}else{
$flag = 1;
}
$result4 = $fv->chkBlock($_SESSION['pid'], $_GET['profileid']);
if($result4){
$block = 0;
}else{
$block = 1;
}
?>
<li><a class="<?php echo ($flag == 1)?'':'favpro';?>" href="<?php echo $BaseUrl.'/friends/favourite.php?flag='.$flag.'&by='.$_SESSION['pid'].'&to='.$_GET['profileid'];?>" >Flag</a></li>
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#ReportProfile">Report</a></li>
<li><a href="<?php echo $BaseUrl.'/friends/favourite.php?block='.$block.'&by='.$_SESSION['pid'].'&to='.$_GET['profileid'];?>"><?php echo ($block == 0)?'Unblock':'Block';?></a></li>
</ul>
</div>

</div>

</div>
</div>
</div>
</div>
<div class="no-padding m_top_15">
<!--user data start-->
<div class="panel panel-primary no-margin no-radius Othertimeline bradius-15 bg-white">
<div>
<div class="row">
<div class="col-md-12">
<ul class='nav nav-tabs' id='tabprofile'>
<li role="presentation" class="active"><a href="#srchtimeline" aria-controls="home" role="tab" data-toggle="tab">Timeline</a></li> 
<li role="presentation"><a href="#about" aria-controls="home" role="tab" data-toggle="tab" >About</a></li>
<li role="presentation"><a href="#friends" aria-controls="home" role="tab" data-toggle="tab">All Friends(<?php echo $totalFriendsofId;?>)</a></li>
<li role="presentation" class="<?php echo ($ptypeid == 5 ?"hidden":"") ?>"><a href="#str" aria-controls="home" role="tab" data-toggle="tab">Store</a></li>
<li role="presentation"><a href="#srchphotos" aria-controls="home" role="tab" data-toggle="tab">Photos</a></li>

</ul>
</div>
</div>

<!--Testing-->
<div class="tab-content no-radius otherTimleineBody">
<!--Timeline-->


<div role="tabpanel" class="tab-pane active" id="srchtimeline" style="padding-left: 10px;padding-right: 10px;">
<div class="row m_top_10">
<div class="col-md-12">


<?php

$timeline = new _postingview;
$result = $timeline->readtimelines($_GET["profileid"]);


//echo $timeline->ta->sql;
if($result != false){

while($rows = mysqli_fetch_assoc($result)){

?>



<!--Testing Audio content div-->
<div class="tab-content no-radius otherTimleineBody">
<!--Timeline-->
<div role="tabpanel" class="tab-pane active" id="srchtimeline" style="padding-left: 10px;padding-right: 10px;">   
<div class="row m_top_10">
<div class="col-md-12">

<div class="post_timeline post_timeline_all_post searchable deldiv_2203">

<div class="row ">
<div class="col-md-6">
<div class="left_profile_timeline">
<img id="profilepicture" alt="Profile Pic" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
</div>
<div class="title_profile">

<h4><?php echo $name; ?> </h4>
<?php
$p2 = new _postingview;
$postingDate = $p2->spPostingDate($rows["spPostingDate"]); ?>


<h5><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
</div>      
</div>

<!--   <div class="col-md-6">
<div class="dropdown pull-right right_profile_timeline">
<i class="fa fa-flag" aria-hidden="true"></i>&nbsp;&nbsp;
<button class="btn dropdown-toggle" onclick="myFunction()" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
<ul class="dropdown-menu" id="myDropdown">
<li><a href="https://thesharepage.dbvertex.com/post-ad/savePost.php?postid=2203"><i class="fa fa-save"></i> Save Post</a></li>    
<li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> 
<li><a href="https://thesharepage.dbvertex.com/post-ad/hidePost.php?postid=2203&amp;flag=1"><i class="fa fa-minus-square-o"></i> Hide Post</a>
</li>     <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> 

</ul>
</div>


</div> -->
<div>
<div class="col-md-6">
<div class="dropdown pull-right right_profile_timeline" >
<button class="btn dropdown-toggle" onclick="myFunction()" type="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
<ul  class="dropdown-menu" id="myDropdown">
<?php
if(isset($_SESSION['pid'])){
$sp = new _savepost;

$result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
if($result2){
if($result2->num_rows > 0){ ?>
<li><a href="<?php echo $BaseUrl.'/post-ad/savePost.php?unsave='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Unsave Post</a></li> <?php
}else{ ?>
<li><a href="<?php echo $BaseUrl.'/post-ad/savePost.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
}
}else{?>
<li><a href="<?php echo $BaseUrl.'/post-ad/savePost.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
}
}else{?>
<li><a href="<?php echo '../post-ad/savePost.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-floppy-o"></i> Save Post</a></li> <?php
}
if($_SESSION['pid'] == $rows['idspProfiles']){ ?>
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings']; ?>" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a></li> <?php
}
?>


<!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
<?php
//Delete timeline by poster//
if(isset($_SESSION['uid'])){
$pr = new _spprofiles;
$pres = $pr->checkprofile($_SESSION['uid'], $rows['idspProfiles']);
if ($pres != false) {
?>
<li><a href="javascript:void(0);" class="postdel" data-id="<?php echo $rows['idspPostings']?>" data-pid="<?php ?>" >
<i class="fa fa-trash-o" style="color:red"></i>  Delete Post</a></li>
<?php
//echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
//echo "<li><a href='#'><i class='fa fa-trash'></i> Delete Post</a></li>";
}
}else{
echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
}
//hide post from timeline
if($_SESSION['pid'] != $rows['idspProfiles']){
echo "<li><a href='".$BaseUrl."/post-ad/hidePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-minus-square-o'></i> Hide Post</a></li>";   
}
?>
<!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> -->

</ul>

</div>
</div>






</div>




<div class="col-md-12 ">

<?php
if($rows["spPostingNotes"] != ''){

echo "<div style='color:#333'>".$rows["spPostingNotes"]."</div>";
}

$pic = new _postingpic;
$res = $pic->read($rows['idspPostings']);
if($res!= false){
$rp = mysqli_fetch_assoc($res);
$pic = $rp['spPostingPic'];
echo "<div class='row no-margin text-center'>";
echo "<img alt='Posting Pic' src=' ".($pic)."' style='max-height:300px;' class='postpic img-thumbnail img-responsive center-block bradius-15' >" ;
echo "</div>";
}


$media = new _postingalbum;
$result2 = $media->read($rows['idspPostings']);
if ($result2 != false) 

{

$r = mysqli_fetch_assoc($result2);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if($sppostingmediaExt == 'mp3'){ ?>
<div style='margin-left:15px;margin-right:15px;'>
<audio controls>
<source src="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" type="audio/<?php echo $sppostingmediaExt;?>">
Your browser does not support the audio element.
</audio>
</div>
<?php
}else if($sppostingmediaExt == 'mp4'){ ?>
<div style='margin-left:15px;margin-right:15px;'>
<video  style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
</video>
</div>
<?php
}else if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
?>

<div class="row timelinefile">
<div class="col-md-offset-1 col-md-1 no-padding">
<img src="<?php echo $BaseUrl.'/assets/images/pdf.png'?>" alt="pdf" class="img-responsive" />
</div>
<div class="col-md-10">
<h3><?php echo $sppostingmediaTitle;?></h3>
<small><?php echo $sppostingmediaExt;?></small>
<a href="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" target="_blank">Download</a>
</div>
</div>


<?php
}
} 


?>



</div>



<!---------footer -------------------->


<div class="col-md-12">
<div class="col-md-12">
<div class="post_footer">
<ul>
<li> 
<?php
$pl = new _postlike;
$r = $pl->readnojoin($rows['idspPostings']);
if ($r != false) {
$i = 0;
$liked = $r->num_rows;
while ($row = mysqli_fetch_assoc($r)) {
if ($row['spProfiles_idspProfiles'] == $_SESSION['pid']) {
echo "<span id='spLikePost' data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ") <span class='font_regular'></span></span>";
$i++;
}
}
if ($i == 0) {
echo "<span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ") <span class='font_regular'>Like</span></span>";
}
} else {
$liked = 0;
echo "<span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $liked . "'> <span class='font_regular'>Like</span></span>";
}?>
</li>

<li><i class="fa fa-comment" aria-hidden="true"></i> <span class='font_regular'>Comment</span></li>
<li>
<?php
$pl = new _favorites;
$re = $pl->read($rows['idspPostings']);
if ($re != false) {
$i = 0;
while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spUserid'] == $_SESSION['uid']) {
echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> Unfavourite</span></span>";
$i++;
}
}
if ($i == 0) {
echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> Favourite</span></span>";
}
} else {

echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> Favourite</span></span>";
}?>
</li>
<li><a href="javascript:void(0);"  data-toggle='modal' data-target='#myshare'><span class='sp-share' data-postid='<?php echo $rows['idspPostings'];?>' src='<?php echo ($pict); ?>'><i class="fa fa-share-alt"></i> <span class='font_regular'>Share</span></span></a></li>
</ul>
</div>



</div>


<div class="col-md-12 no-padding" style="margin-top: 10px;">





<form action="../publicpost/addcomment.php" id="comntform" method="post">
<input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings']?>">
<input class="dynamic-pid" id="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['uid']?>">

<input name="userid" id="userid"  type="hidden" value="<?php echo $_SESSION['uid']?>">

<div class="row ">
<div class="col-md-12">
<div class="input-group">
<div class="input-group-addon commentprofile inputgroupadon border_none">
<?php
$p = new _spprofiles;
$rpvt = $p->read($_GET["profileid"]);
if($rpvt != false)

{
$row = mysqli_fetch_assoc($rpvt);
if(isset($row["spProfilePic"]))
echo "<img alt='profilepic' class='' src=' ". ($row["spProfilePic"])."' style='width: 30px; height: 30px;' >" ;
else
echo "<img alt='profilepic' class='' src='../assets/images/blank-img/default-profile.png' style='width: 30px; height: 30px;' >" ;
}
?>
</div>
<input type="text" class="form-control enterkey timelin_comm_text bradius-20" name="comment" id="timeline" data-id="<?php echo $rows['idspPostings']?>"  placeholder="Type your comment here..." autocomplete="off" style='height:45px;border-radius: 0px;margin-bottom: 0px;'>
</div>
<span id=text_error  class="red"></span>
</div>
</div>
</form>




<!--                          <div id="comments_<?php echo $rows['idspPostings']; ?>">

-->        
<div>                    <?php
$c = new _comment;
$result21 = $c->read($rows['idspPostings']);
$totalcmt = 0;
if ($result21 != false) {
$totalcmt = $result21->num_rows;
while ($row = mysqli_fetch_assoc($result21)) {
$profilename = $row["spProfileName"];
$comment = $row["comment"];
$picture = $row["spProfilePic"];
//$date = $row["commentdate"];
} ?>
<div class="timelinecmnt_<?php echo $rows['idspPostings']; ?>">
<!--
<div class="row">
<div class="col-md-1">
<?php
if (isset($picture))
echo "<img alt='profilepic'  class='' src=' " . ($picture) . "' >";
else
echo "<img alt='profilepic'  class='' src='../assets/images/blank-img/default-profile.png' >";
?>
</div>
<div class="col-md-11">
<div class="right_coment_detail">
<a href="#"><?php echo $profilename;?></a>
<p><?php echo $comment; ?></p>
</div>
</div>
</div>-->

<div class="row view_more_cmnt_<?php echo $rows['idspPostings']; ?> comment_align">
<div class="col-md-12">
<!--  <?php
echo "<a href='http://thesharepage.dbvertex.com/publicpost/post_comment_details.php' data-toggle='modal' data-target='#mycomment'><span class='morecomment' data-postid='" . $rows['idspPostings'] . "' >View all comments <span class='tltcmt'>" . $totalcmt . "</span></span></a>";
?> -->
<!--  <a href= ".$BaseUrl.publicpost/post_comment_details.php?postid=$rows['idspPostings']">View all comments <span class='tltcmt'> 

<?php echo $totalcmt ;?> </span></span></a> -->
<a href="<?php echo "$BaseUrl.publicpost/post_comment_details.php?postid=$rows['idspPostings']";?>" title="">View all comment</a>
</div>
</div>
</div>

<?php
} ?>
</div>


</div>



</div>





<!--------footer end------------> 

</div>
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










<div role="tabpanel" class="tab-pane" id="about">

<div class="table-responsive m_top_10">
<table class="table table-striped">
<tbody>
<tr>
<td colspan="2">Personal Information</td>
</tr>
<tr>
<td style="width: 30%">Name</td>
<td><?php echo ucfirst($name); ?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $email; ?></td>
</tr>
<tr>
<td>Phone</td>
<td><?php echo $phone; ?></td>
</tr>
<tr>
<td>Country</td>
<td><?php echo $country; ?></td>
</tr>
<tr>
<td>City</td>
<td><?php echo $city; ?></td>
</tr>
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
$r = $c->read($_GET["profileid"]);
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
<li class="active"><a href="#tabAllFrnd" data-toggle="tab">All Friends</a></li>
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
$_GET["friendid"] = $_GET["profileid"];
include("store-detail.php");
include("../publicpost/postshare.php")
?>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="srchphotos"> 
<div >
<?php include("photos.php"); ?>
</div>
</div>


</div>
<!--Testing Complete-->
</div>
</div>
</div>





</div>

<div id="sidebar_right" class="col-md-3 no-padding" style="left: auto" >
<?php include('../component/right-landing.php');?>
</div>
</div>
</section>


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<!--         	<script src="../js/home.js"></script>
-->
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

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
<!-- image gallery script end -->

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
/*window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
}*/
</script>
</body>
</html>
<?php

} 
?>