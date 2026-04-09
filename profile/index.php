<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
include('../univ/baseurl.php');
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "profile/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
} 



// $num=mysqli_num_rows($result3);
// echo $num;
// die('mjhgjhm,b');
spl_autoload_register("sp_autoloader");
?>
<!doctype html>
<html>

<head>

<?php include('../component/f_links.php'); ?>
<!--This script for posting timeline data End-->

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
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
jQuery(document).ready(function($) {
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});
</script>
<!--This script for sticky left and right sidebar END-->
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js">
</script>

</script>
</head>
<style>
.nav-tabs>li.fav_active.active>a,
.nav-tabs>li.fav_active.active>a:focus,
.nav-tabs>li.fav_active.active>a:hover {
background-color: #7092be !important;
color: #fff !important;
border: none !important;
margin: 1px;
}

#searchtx {
margin-left: -1px !important;
height: 36px !important;


}


.row {

    margin-left: -17px
}

.ordrSave {

margin-top: 3px !important;
}

#myTabMD li {
margin-bottom: 6px !important;
}



.dropdown-menu>li>a {
padding-bottom: 5px !important;
display: block;
padding-left: 10px;
padding-top: 5px;
/ padding: 5px 20px 5px 20px;/ clear: both;
font-weight: normal;
line-height: 1.42857143;
color: #333;
white-space: nowrap;
}

.green_clr {
color: #010807;
font-family: MarksimonRegular;
font-size: 12px;
}
.green_clr_2 {
color: #010807;
font-family: MarksimonRegular;
font-size: 12px;
}

.swal2-popup {
	font-size: larger !important;
}

span#spFavouritePost {
    display: none;
}
</style>

<body class="bg_gray" onload="">


<?php
//session_start();

include_once("../header.php");
?>
<!--send timeline link to email popup-->

<section class="landing_page">
<div class="container pubpost">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php'); ?>
</div>
<div class="col-md-7" style="min-height:500px;">
<div class="right_box_timeline bradius-20">
<h2 class="text-center" style="font-size: 19px;font-weight: 600;">MY FAVORITES</h2>
</div>
<!-- <?php echo $_SERVER['REQUEST_URI']; ?> -->
<div class="row m_top_10">
<div class="col-sm-12 social 1">
<div class="topstatus myProfileComponent bradius-15 bg-white">
<div class="createbox ">

<ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">

<li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/profile/") {
echo "fav_active active";
} ?>">
<a class="nav-link  <?php if ($_SERVER['REQUEST_URI'] == "/profile/") {
echo "fav_active active";
} ?>" id="home-tab-md" href="<?php echo $BaseUrl . '/profile/'; ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/post_photo_icon_enable.png" alt="photo" class="img-responsive" /> --><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;Photos
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "audio") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "audio") {
echo "fav_active active";
} ?>" id="profile-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?audio'; ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="audio" class="img-responsive" /> --><i class="fa fa-music" aria-hidden="true"></i>&nbsp;&nbsp;Audio
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "video") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "video") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?video'; ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="video" class="img-responsive" /> --><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;Videos
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "doc") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "doc") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?doc'; ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> --><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Documents
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "favourite") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "favourite") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?favourite'; ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> --><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Post
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "saveEvent") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "saveEvent") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?saveEvent'; ?>"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Events</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "favArts") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "favArts") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?favArts'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Arts</a>
</li>
<br><br><br>
<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "favServices") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "favServices") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?favServices'; ?>"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Services</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "hidePost") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "hidePost") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?hidePost' ?>">
<!-- <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> --><i class="fa fa-eye-slash" aria-hidden="true"></i>&nbsp;&nbsp;Hidden Post
</a>
</li>

<li class="nav-item <?php if ($_SERVER['QUERY_STRING'] == "save_Post") {
echo "fav_active active";
} ?>">
<a class="nav-link <?php if ($_SERVER['QUERY_STRING'] == "save_Post") {
echo "fav_active active";
} ?>" id="contact-tab-md" href="<?php echo $BaseUrl . '/profile/index.php?save_Post'; ?>"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Saved Post</a>
</li>

</ul>




<!--  <a href="<?php echo $BaseUrl . '/profile/'; ?>"><label class="btn-bs-file <?php if ($_SERVER['REQUEST_URI'] == "/profile/") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/post_photo_icon_enable.png" alt="photo" class="img-responsive" /> Photos</label></a>
<span class="seprate ">|</span>
<a href="<?php echo $BaseUrl . '/profile/index.php?audio'; ?>"><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "audio") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="audio" class="img-responsive" /> Audio</label></a>
<span class="seprate ">|</span>
<a href="<?php echo $BaseUrl . '/profile/index.php?video'; ?>" ><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "video") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="video" class="img-responsive" /> Videos</label></a>
<span class="seprate ">|</span>
<a href="<?php echo $BaseUrl . '/profile/index.php?doc'; ?>"><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "doc") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> Documents</label></a>
<span class="seprate ">|</span>
<a href="<?php echo $BaseUrl . '/profile/index.php?favourite'; ?>"><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "favourite") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> Post</label></a>
<span class="seprate ">|</span> -->
<!--   <a href="<?php echo $BaseUrl . '/profile/index.php?hidePost' ?>"><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "favourite") {
echo "fav_active";
} ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="document" class="img-responsive" /> Hidden Post</label></a>
<span class="seprate">|</span> -->
<!--    <a href="<?php echo $BaseUrl . '/profile/index.php?saveEvent'; ?>"><label class="btn-bs-file <?php if ($_SERVER['QUERY_STRING'] == "saveEvent") {
echo "fav_active";
} ?>"><i class="fa fa-calendar" aria-hidden="true"></i> Events</label></a>
<span class="seprate ">|</span>
<a href="#"><label class="btn-bs-file "><i class="fa fa-calendar" aria-hidden="true"></i>  Arts</label></a>
<span class="seprate fav_seprate">|</span>
<a href="#"><label class="btn-bs-file"><i class="fa fa-users" aria-hidden="true"></i>  Services</label></a> -->
<!--  <span class="seprate">|</span> -->




<!--    <div class="dropdown">
<button class="btn btn-primary dropdown-toggle topMenubtn" type="button" data-toggle="dropdown">More <span class="caret"></span></button>
<ul class="dropdown-menu"> -->
<!--   <li><a href="<?php echo $BaseUrl . '/profile/index.php?post'; ?>">Save Post</a></li> -->
<!--     <li><a href="<?php echo $BaseUrl . '/profile/index.php?hidePost' ?>">Hidden Post</a></li>
<li><a href="<?php echo $BaseUrl . '/profile/index.php?saveEvent'; ?>"> Events</li> -->
<!-- <li><a href="#">Coupons</a></li> -->
<!--    <li><a href="#">Arts</a></li>
<li><a href="#">services</a></li>
</ul>
</div> -->

</div>
</div>
</div>
<?php

$p = new _postingview;
$p2 = new _postingview;
$start = "DESC";
?>
<div class="col-sm-12">
<?php
if (isset($_GET['audio'])) { 
include('audio.php');
} else if (isset($_GET['video'])) {
//----condition for video--\\\\
$res = $p->globaltimelinesFavourite_uid_pid($start, $_SESSION['pid'], $_SESSION['uid']);
if ($res != false) {
while ($timeline = mysqli_fetch_assoc($res)) {
$_GET["timelineid"] = $timeline['idspPostings'];
$res2 = $p2->singletimelines($_GET["timelineid"]);
if ($res2 != false) {
while ($rows = mysqli_fetch_assoc($res2)) {
$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);
if ($result != false) {
$dt = new DateTime($rows['spPostingDate']);
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp4') {
//=====----condition  End --=====\\\\
include('video.php');
}
}
}
}
}
}
} else if (isset($_GET['doc'])) {
//----condition for document--\\\\
$res = $p->globaltimelinesFavourite_uid_pid($start, $_SESSION['pid'], $_SESSION['uid']);
if ($res != false) {
while ($timeline = mysqli_fetch_assoc($res)) {
$_GET["timelineid"] = $timeline['idspPostings'];
$res2 = $p2->singletimelines($_GET["timelineid"]);
if ($res2 != false) {
while ($rows = mysqli_fetch_assoc($res2)) {
$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);
if ($result != false) {
$dt = new DateTime($rows['spPostingDate']);
$r = mysqli_fetch_assoc($result);
//print_r($r);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx') {
//----condition  End --\\\\
include('document.php');
}
}
}
}
}
}
} else if (isset($_GET['favourite'])) {
include('favourite.php');
} else if (isset($_GET['save_Post'])) {
include('save_Post.php');
} else if (isset($_GET['post'])) {
include('postshare.php');
include('savePost.php');
} else if (isset($_GET['hidePost'])) {
include('hidePost.php');
} else if (isset($_GET['saveEvent'])) {
//----condition for favEvent--\\\\
$p = new _spevent;
$results = $p->event_favorite(9, $_SESSION["pid"]);
if ($results) {
include('favEvent.php');
}
} else if (isset($_GET['favArts'])) {

$p = new _postingviewartcraft;
$results = $p->art_favorite_list($_SESSION["pid"]);
if ($results) {
while ($rows = mysqli_fetch_assoc($results)) {

$postid = $rows['spPostings_idspPostings'];
$pf  = new _postfield;
$result = $p->singletimelines($postid);
if ($result != false) {
//----condition  End --\\\\
include('favArts.php');
break;
}
}
}
} else if (isset($_GET['favServices'])) {
//----condition for favEvent--\\\\
$p = new _classified;
$results = $p->event_favorite_service($_SESSION["pid"]);
if ($results) {
while ($rows = mysqli_fetch_assoc($results)) {

$postid = $rows['spPostings_idspPostings'];

$result = $p->singletimelines($postid);

if ($result != false) {
//----condition  End --\\\\
include('favServices.php');
break;
}
}
}
} else {
$p = new _postingview;
$res = $p->globaltimelinesFavourite_uid_pid($start, $_SESSION['pid'], $_SESSION['uid']);
if ($res != false) {
while ($timeline = mysqli_fetch_assoc($res)) {
//$_GET["timelineid"] = $v['idspPostings'];
$_GET["timelineid"] = $timeline['idspPostings'];
$res2 = $p2->singletimelines($_GET["timelineid"]);
if ($res2 != false) {
$rows = mysqli_fetch_assoc($res2);
$pic = new _postingpic;
$result = $pic->read($rows['idspPostings']);
//echo $result->num_rows.'cccc';
//echo $pic->ta->sql;
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$pict = $rp['spPostingPic'];
if (isset($pict)) {
include('gallery.php'); 
break;
}
}
}
}
}
}
?>

</div>

</div>
</div>

<?php
$f = new _spprofilehasprofile;
$totalFrnd = array();
$arrayForFriendSorting = array();

$result3 = $f->readallfriend($_SESSION['pid']);

if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
$arrayForFriendSorting[$row3['spProfiles_idspProfilesReceiver']] = $row3['spProfileName'];
}
}

//receiver
$result4 = $f->readall($_SESSION['pid']);
if ($result4 != false) {
while ($row4 = mysqli_fetch_assoc($result4)) {
array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
$arrayForFriendSorting[$row4['spProfiles_idspProfileSender']] = $row4['spProfileName'];
}
}

if (!empty($totalFrnd)) {
$totalFriendsofId = count($totalFrnd);
// asort($arrayForFriendSorting);
} else {
//echo 1;
$totalFriendsofId = 0;
}
//print_r($totalFrnd);
//print_r($arrayForFriendSorting);
//exit;
//====end my frnd list 
?>


<div class=" col-md-3 right_box_timeline right_sidebar pull-right">
<h2><a class="links" href="<?php echo $BaseUrl . '/my-friend'; ?>">My Friends (<?php echo $totalFriendsofId; ?>)</a><span class="pull-right"><a data-toggle="collapse" href="#collapse1">Show all <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/dropdown_arrow_black.png" class="img-responsive" /></a></span></h2>
<div class="panel-group">
<div class="panel panel-default">
<div id="collapse1" class="panel-collapse collapse">
<div class="panel-body no-padding">

<div class="rightscrooler">
<?php
if ($totalFriendsofId > 0) {

foreach ($arrayForFriendSorting as $key => $frndId) {
$profileid = $key;
if (strlen($profileid) > 0 && is_numeric($profileid)) {
$f = new _spprofiles;
$res = $f->read($profileid);
//echo $f->ta->sql;

if ($res != false) {
$row = mysqli_fetch_array($res);
$proftype = $row['spProfileType_idspProfileType'];
$profileIdRight = $row['idspProfiles'];
$NameRight = $row['spProfileName'];
$pict = $row['spProfilePic'];
$profileNote = $row['spProfileAbout'];
//$SubDate = $row['spProfileSubscriptionDate'];
$dt = new DateTime($row['spProfileSubscriptionDate']);
$pt = new _profiletypes;
$pt1 = $pt->readProfileType($proftype);
$rows12 = mysqli_fetch_array($pt1);
$profile_type = $rows12['spProfileTypeName'];
?>
<div class="row m_top_20 news_feed no-margin">
<div class="col-md-3 no-padding">
<?php
if (isset($pict)) {
echo "<img alt='profilepic'  class='img-responsive' src='" . ($pict) . "'>";
} else {
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
} ?>
</div>
<div class="col-md-9 no-padding join_timeline_main">
<h4><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileIdRight; ?>"><?php echo ucfirst($NameRight); ?></a></h4>
<h3><?= $profile_type; ?>Profile</h3>
</div>
</div>
<?php }
}
}
} else {
?>
<p style="margin-top: 15px;">No record available</p>
<?php
}

?>
</div>
</div>
</div>
</div>
</div>

</div>



<!-- <div class="row"> -->
<div class="col-md-3 right_box_timeline right_sidebar pull-right">
<!-- <div class=""> -->
<h2><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/stores_icon_ad.png" class="img-responsive" alt="" /> Stores <span class="pull-right"><a href="<?php echo $BaseUrl; ?>/store/">See All</a></span></h2>
<div id="carousel-example-generic" class="carousel slide carousel-fade">
<!-- SLIDER START -->
<div class="carousel-inner" role="listbox">
<?php
$active = 0;
for ($i = 0; $i <= 5; $i++) {
?>
<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php
$count = 0;
$p = new _productposting;
$query = $p->publicpost_two();
//  echo $p->ta->sql;
if ($query != false) {
while ($row_store = mysqli_fetch_assoc($query)) {
// echo "<pre>";
// print_r($row_store);
$dt = new DateTime($row_store['spPostingExpDt']);
$pro = new _spprofiles;
$result = $pro->read($row_store['spProfiles_idspProfiles']);
if ($result) {
$row = mysqli_fetch_assoc($result);
$ProfileName = $row['spProfileName'];
}
if ($count == 0) {
?>
<div class="row m_top_20" style="">
<div class="col-md-4 store_img">
<?php
$pic = new _productpic;
$result_pic = $pic->read($row_store['idspPostings']);
//echo $pic->ta->sql;
if ($row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
} else {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
} ?>

</div>
<div class="col-md-8 no-padding-left">
<?php
if (!empty($row_store['spPostingTitle'])) {
if (strlen($row_store['spPostingTitle']) < 15) {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo $row_store['spPostingTitle']; ?></a></h3><?php

													} else {
														?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo substr($row_store['spPostingTitle'], 0, 15) . '...'; ?></a>
<h3><?php
													}
												} else {
?>
<h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>">No-Title</a>
<h3><?php
												}
?>

<h5>
<?php
//if ($row_store['spPostingPrice'] != false) {
if (($row_store['retailSpecDiscount'] != '') && ($row_store['sellType'] == "Retail")) {
echo $row_store['default_currency'] . ' ' . $row_store['retailSpecDiscount']; ?>&nbsp;<del class="text-success" style="color:green;"><?php echo $row_store['default_currency'] . ' ' . $row_store['spPostingPrice']; ?></del>
<?php
//echo $row_store['default_currency'].' '.$row_store['spPostingPrice'];  
} else {
if ($row_store['spPostingPrice'] != false) {

echo $row_store['default_currency'] . ' ' . $row_store['spPostingPrice'];
} else {
$dt = new DateTime($row_store['spPostingExpDt']);
echo "Expires on " . $dt->format('d M y');
}
}
?>
<br>
<!-- <?php echo $dt->format('d M'); ?> green_clr -->
</h5>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" class="green_clr_2">by <?php echo $ProfileName; ?></a>
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" class="chat_timeline btn view_right_btn btn-border-radius">View</a>

</div>
</div>
<?php
$count = 1;
} else {
?>
<div class="row m_top_20" style="">
<div class="col-md-4 store_img">
<?php
$pic = new _productpic;
$result_pic = $pic->read($row_store['idspPostings']);
//echo $pic->ta->sql;
if ($row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
} else {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
} ?>

</div>
<div class="col-md-8 no-padding-left">
<?php
if (!empty($row_store['spPostingTitle'])) {
if (strlen($row_store['spPostingTitle']) < 15) {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo $row_store['spPostingTitle']; ?></a></h3><?php

													} else {
														?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo substr($row_store['spPostingTitle'], 0, 15) . '...'; ?></a>
<h3><?php
													}
												} else {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>">No-Title</a>
<h3><?php
												}
?>

<h5>
<?php

if (($row_store['retailSpecDiscount'] != '') && ($row_store['sellType'] == "Retail")) {
echo $row_store['default_currency'] . ' ' . $row_store['retailSpecDiscount']; ?>&nbsp;<del class="text-success" style="color:green;"><?php echo $row_store['default_currency'] . ' ' . $row_store['spPostingPrice']; ?></del>
<?php

} else {
if ($row_store['spPostingPrice'] != false) {
echo $row_store['default_currency'] . ' ' . $row_store['spPostingPrice'];
} else {
$dt = new DateTime($row_store['spPostingExpDt']);
echo "Expires on " . $dt->format('d M y');
}
}
?>
<br>
<!--   <?php echo $dt->format('d M'); ?> green_clr-->
</h5>


<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" class="green_clr_2">by <?php echo $ProfileName; ?></a>
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" class="chat_timeline btn view_right_btn btn-border-radius">View</a>

</div>
</div>
<?php
$count = 0;
}
}    ?>
<?php
}
?>
</div>
<?php
$active++;
} ?>
</div>
</div><!-- SLIDER END -->
</div>
</div>


</section>


<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
<script>
var _gaq = [
['_setAccount', 'UA-XXXXX-X'],
['_trackPageview']
];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s)
}(document, 'script'));
// Colorbox Call
$(document).ready(function() {
$("[rel^='lightbox']").prettyPhoto();
});
</script>

<script type="text/javascript">
$(".removefavorites").on("click", function() {


var btnremovefavorites = this;
$.post("../social/deletefavorites.php", {
postid: $(this).data("postid")
}, function(response) {
//alert(response);
$(btnremovefavorites).attr({
class: 'icon-favorites fa fa-heart-o sp-favorites faa-pulse animated'
});

//window.location.reload();
//document.getElementById("spFavouritePost").innerText = " Favourite";
});
});
</script>
<!-- image gallery script end -->
</body>

</html>
<?php
} ?>