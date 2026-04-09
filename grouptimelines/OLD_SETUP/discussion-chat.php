<?php
ob_start();
include('../univ/baseurl.php');
include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');
?>

<!DOCTYPE html>
<html lang="en"> 
<head>	
<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
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

</head>
<body onload="pageOnload('groupdd')" class="bg_gray">
<?php
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
include_once ("../header.php");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}
$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>

<section class="landing_page">
<div class="container">
<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="grpid" value="<?php echo $_GET["groupid"]; ?>">
<input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
<input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
<div class="row">		
<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-group.php');?>
</div>	

<div class="col-md-10">
<?php include('top_banner_group.php');?>

<div class="row">
<div class="col-md-12">
<div class="about_banner">
<div class="top_heading_group ">
<div class="row">
<div class="col-md-6">
<h3>Description</h3>
</div>
<div class="col-md-6">
<a href="#" data-toggle="modal" data-target="#conversationModal" class="btn btn-white pull-right btn-border-radius"><i class="fa fa-plus"></i> New Discussion</a>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12 no-padding" >
<div id="message_box" class="chattingsystem">
<?php include('loadconversation.php');?>
</div>

</div>
</div><!--END row-->
<?php //include('conversation.php');?>

<!--Conversation Subject-->
<div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="enquireModalLabel"><b>New Conversation</b></h4>
</div>
<div class="modal-body" style="background-color:white;">
<form action="sendmessage.php" method="post">

<input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>"/>


<input type="hidden" id="starter" value="<?php echo $profilename; ?>"/>

<input type="hidden" name="spGroup_idspGroup" value="<?php echo $_GET['groupid'] ?>"/>

<input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>"/>

<input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">

<div class="form-group">
<label for="message" class="form-control-label">New Topic</label>
<input type="text" class="form-control" id="message" name="spGroupMessage" />
</div>

<div class="form-group">
<label for="message" class="form-control-label">Message</label>
<textarea class="form-control" id="description" rows="5" name="conversationText_" ></textarea>
</div>

<div class="modal-footer">
<button type="button" class="btn btn_gray btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" id="groupconversation" class="btn btn_blue btn-border-radius">Start</button>
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
</section>
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>

</body>	
</html>