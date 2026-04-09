<?php



require_once("../univ/baseurl.php");
session_start();
//print_r($_SESSION);
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "my-friend/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");



//====================
//my friend list
//====================
//sender
$f = new _spprofilehasprofile;
$totalFrnd = array();
$result3 = $f->readallfriend($_SESSION['pid']);

if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
}
}
//receiver
$result4 = $f->readall($_SESSION['pid']);
//echo $f->ta->sql;
if ($result4 != false) {
while ($row4 = mysqli_fetch_assoc($result4)) {
array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
}
}
//print_r($totalFrnd);
if (!empty($totalFrnd)) {
$totalFriendsofId = count($totalFrnd);
} else {
$totalFriendsofId = 0;
}
//====end my frnd list 




//$r = new _spprofilehasprofile;
$res = $f->friendReequestAll($_SESSION["pid"]);
//echo  $res;
$total = $res->num_rows;
//echo  $total;
//die('ssssssss');

if ($total == "") {
$total = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

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

</head>

<body class="bg_gray" onload="pageOnload('admin')">
<?php



if (!isset($_SESSION['pid'])) {
//
include_once("../authentication/check.php");
$_SESSION['afterlogin'] = "post-ad/";
}

include_once("../header.php");

include("addtogroup.php");

?>

<style>
.totalfriend {
color: #7e6f6ffa !important;
}

.swal2-popup {
    
}
</style>




<section class="landing_page">
<div class="container pubpost">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php'); ?>
</div>


<div class="col-md-7">
<div class="panel panel-primary m_top_10 no-radius Othertimeline bradius-15">
<div class="panel-heading no-padding" style="background-color: #fff !important;">
<div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="navtabprofile" style="padding-top: 5px;padding-bottom: 5px;background-color: #ffffff; margin-left: 15px;">
<li role="presentation" class="<?php echo (isset($_GET['block'])) ? '' : 'active'; ?>"><a href="#friend" aria-controls="Friend" role="tab" data-toggle="tab">All Friends(<?php echo $totalFriendsofId; ?>)</a></li>
<li role="presentation"><a href="#request" aria-controls="Requests" role="tab" data-toggle="tab">Pending Requests(<?php echo $total; ?>)</a></li>
<li role="presentation"><a href="#recentlyAded" aria-controls="Recently" role="tab" data-toggle="tab">Recently Added</a></li>
<li role="presentation"><a href="#Birthdays" aria-controls="Birthdays" role="tab" data-toggle="tab">Birthdays</a></li>
<!-- <li role="presentation"><a href="#highSeller" aria-controls="Recently" role="tab" data-toggle="tab">Highest Sellers</a></li> -->
<li role="presentation"><a href="#myConnection" aria-controls="Recently" role="tab" data-toggle="tab">My connections</a></li>
<li class="dropdown">
<!--   <button class="btn btn-primary dropdown-toggle topMenubtn" type="button" data-toggle="dropdown" style="padding: 5px 15px;">More <span class="caret"></span></button> -->
<a href="javascript:void(0);" class="dropdown-toggle topMenubtn" data-toggle="dropdown" role="button">&nbsp;...&nbsp;</a>
<ul class="dropdown-menu">
<li role="presentation" class="<?php echo (isset($_GET['block'])) ? '' : ''; ?>"><a href="<?php echo $BaseUrl . '/my-friend/?block' ?>">Blocked List</a></li>
</ul>
</li>
</ul>
</div>
</div>
<div class="panel-body">
<div class="tab-content" id="frndadd">
<div role="tabpanel" class="tab-pane <?php echo (isset($_GET['block'])) ? '' : 'active'; ?>" id="friend">
<?php
include("friends.php");
?>
</div>
<div role="tabpanel" class="tab-pane" id="request">
<?php
include("request.php");
?>
</div>
<div role="tabpanel" class="tab-pane" id="recentlyAded">
<?php
include("recently.php");
?>
</div>
<div role="tabpanel" class="tab-pane" id="Birthdays">
<?php
include("birthdays.php");
?>
</div>
<div role="tabpanel" class="tab-pane" id="highSeller">
<?php
///include("");
?>
</div>
<div role="tabpanel" class="tab-pane" id="myConnection">
<?php
include("connecting.php");
?>
</div>
<?php
if (isset($_GET['block'])) { ?>
<div role="tabpanel" class="tab-pane <?php echo (isset($_GET['block'])) ? 'active' : ''; ?>" id="blockuser">
<?php
include("block.php");
?>
</div> <?php
}
?>


</div>
</div>
</div>
</div>
<div id="sidebar_right" class="col-md-3 no-padding" style="left: auto">
<?php include('../component/right-landing.php'); ?>
</div>

</div>
<!--Container-->
</section>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
}
?>