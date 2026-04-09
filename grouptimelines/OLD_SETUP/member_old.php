<style>
    i.fa.fa-cog {
    color: white!important;
}
</style>

<?php
include('../univ/baseurl.php');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
ob_start();
session_start();
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}


spl_autoload_register("sp_autoloader");

include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');
$getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
//echo $getid;
//die("============");
$obj = new _spAllStoreForm;
$ress = $obj->readdatabyid($getid);
if ($ress != "") {
$roww = mysqli_fetch_assoc($ress);

//print_r($roww);

}
$pid = $_SESSION['pid'];

//echo $pid;
//die("============");
$obj2 = new _spAllStoreForm;
$ress2 = $obj2->readdatabymulid($getid, $pid);

//print_r($ress2);
//die("+++++++++++++++++");

//if($ress2 ==false){
//die("=======");
//header("location:$BaseUrl/my-groups/?msg=notaccess");

//}


?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<?php include('../component/links.php'); ?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
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
<!--THIS SCRIPT FOR TOGLE POPOVER LEFT START-->
<script type="text/javascript">
$(document).ready(function() {
$('[data-toggle="popover"]').popover({
placement: 'left'
});
});
</script>
<!--THIS SCRIPT FOR TOGLE POPOVER LEFT END-->
<!--This script for sticky left and right sidebar END-->


<!--
<script type="text/javascript">
//USER ONE
$(function () {
$('#users').multiselect({
includeSelectAllOption: true
});
$('#groups').multiselect({
includeSelectAllOption: true
});
$('#importusers').multiselect({
includeSelectAllOption: true
});
});
//USER TWO
$(function () {
$('#userstoo').multiselect({
includeSelectAllOption: true
});
$('#groupstoo').multiselect({
includeSelectAllOption: true
});
$('#importuserstoo').multiselect({
includeSelectAllOption: true
});
});
</script>-->

<script>
//THIS IS FILE UPLOAD FOLDER TO CREATE NEW FOLDER OR NOT
function selectNewFolder() {
var x = document.getElementById("txtFolerName").value;
if (x == 'New') {
document.getElementById("txtDisable").style.display = "none";
document.getElementById("txtFoldTitle").style.display = "inline";
} else {
document.getElementById("txtDisable").style.display = "inline";
document.getElementById("txtFoldTitle").style.display = "none";
}
}
</script>
</head>

<body onload="pageOnload('groupdd')" class="bg_gray">
<?php

include_once("../header.php");


if (!isset($_SESSION['pid'])) {
include_once("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $getid . "&groupname=" . $_GET['groupname'] . "&timeline";
}
$g = new _spgroup;
$result = $g->groupdetails($getid);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);

$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
//print_r($row);
$idspProfiles = $row['spProfiles_idspProfiles'];

?>
<style>
.member_box img.profilePic {
height: 70px;

}
.member_box{
background-color:white!important;

border: solid!important;
}


#sendrequest {
margin-top: 4px;
}

.inner_top_form button {
	padding:9px 12px!important;
}
	
		
</style>


<!-- Trigger the modal with a button -->
<div class="modal fade" id="mycomment" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../social/addcomment.php" method="post">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="commentModalLabel">Comments</h4>
</div>
<div class="modal-body">
<div id="commentUploading">

</div>

<div class="row">

<div class="col-md-12">
<div class="input-group">
<div class="input-group-addon commentprofile inputgroupadon">
<div id="profilepictures"></div>
</div>
<input type="text" class="form-control" name="comment" id="comment" placeholder="Type your comment here ..." style='height:45px;border-radius: 0px;'>
</div>

<input type="hidden" id="postcomment" name="spPostings_idspPostings" value="" />
<input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
<input name="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn_gray" data-dismiss="modal">Close</button>
<button type="button" class="btn btn_blue commentboxpost">Comment</button>
</div>
</form>
</div>
</div>
</div> 
<!-- COMMENT MODEL FOR TIMELINE START -->
<section class="landing_page">
<div class="container">
<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="grpid" value="<?php echo $getid; ?>">
<input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
<input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
<div class="row">
<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-group.php'); ?>
</div>

<div class="col-md-10">
<!--                         <?php //include('top_banner_group.php');
?>
-->
<div class="topstatus timeline-topstatus" id="ip2">

<?php
//Edit and delete 
$p = new _spprofiles;
$result = $p->readMember($_SESSION['uid'], $getid);
//echo $p->ta->sql;
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) {
$profileid = $row["idspProfiles"];
$profilename = $row["spProfileName"];
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $getid);
if ($pr != false) {
$rw = mysqli_fetch_assoc($pr);
if ($rw["spProfileIsAdmin"] == 0) {
$admin = $rw["spProfileIsAdmin"];
}
}
}
}
$p = new _spgroup;
//$rpvt = $p->members($_GET["groupid"]); 
$rpvt = $p->joinedMembersOfGroup($getid);
//echo $p->ta->sql;
if ($rpvt != false) {

$totMember = mysqli_num_rows($rpvt);

//echo  $totMember ;die('hhhhhhhhhhhhhhhhhhhhh');
$admin = 0;
$subadmin = 0;
$civilian = 0;
$notapprove = 0;
while ($row = mysqli_fetch_assoc($rpvt)) {
// print_r($row);

if ($row['spAssistantAdmin'] == 1) {   
$subadmin++;
}

if ($row['spApproveRegect'] == 1) {
if ($row['spProfileIsAdmin'] == 0) {
$admin++;
} else {
if (isset($admin) && $row['spAssistantAdmin'] == 0) {  
$civilian++;
} elseif (isset($admin) && $row['spAssistantAdmin'] == 1) {
$subadmin++;
}
}
} else {

if (isset($admin) && $row['spApproveRegect'] == 2) {
$notapprove++;
}
}
}
}
?>
<style>
.db_btn {

margin-right: 13px !important;
}

#ip2 {
padding-left: 7px !important;
margin-left: 1px !important;

}
</style>

<div class="row">
<div class="col-md-12">

<div class="about_banner">
<div class="top_heading_group " style="border-radius:0px !important;" id="ip6">
<div class="row">
<div class="col-md-6">
<!--                                                 <span ><p id="size1" >Group </p><small>[Discussion Board]</small></span>
--> <span id="size1"><small>[Members]</small></span>
</div>
<!-- <div class="col-md-6">
<a href="#" data-toggle="modal" data-target="#conversationModal"  class="btn btnPosting db_btn db_primarybtn pull-right"><i  class="fa fa-plus"></i><span class="hv"> New Discussion</span></a>
</div> -->
</div>
</div>
<div class="top_heading_group member_head " style="margin-top: 10px;">
<div class="row">
<div class="col-md-12">
<ul class="nav nav-pills">
<li class='<?php if ($_GET['tab'] == 'allmemder') {
echo 'active';
} ?>'><a data-toggle="pill" href="#memberstab">All Members (<?php echo $totMember; ?>)</a></li>
<li><a data-toggle="pill" href="#admintab">Admins (<?php echo $admin; ?>)</a></li>
<li class='<?php if ($_GET['tab'] == 'assistant') {
echo 'active';
} ?>'><a data-toggle="pill" href="#assistanttab">Assistant Admins (<?php echo $subadmin; ?>)</a></li>
<?php
//$pid=$_SESSION['pid'];

$pid = $_SESSION['pid'];

//echo $pid;
//die("============");
$obj2 = new _spAllStoreForm;
$ress2 = $obj2->readdatabymulid_assitant($getid, $pid);



//print_r($ress2);
//die("+++++++++++++++++");     

/*if($ress2 ==false){
}*/


$g = new _spgroup;

$result_grp_admin = $g->readgroupAdmin($_POST["spPostingVisibility"]);

if ($result_grp_admin != false) {
$row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
$admin_Id = $row_grp_admin['idspProfiles'];
}


if ($pid == $admin_Id or $ress2 == true) {
?>



<?php
$rpvtt = $p->members_pending($getid);
//echo $p->ta->sql;
$notapprove = 0;
if ($rpvtt != false) {
$i = 0;

while ($row = mysqli_fetch_assoc($rpvtt)) {
$notapprove++;
}
}
?>

<li class='<?php if ($_GET['tab'] == 'memberreq') {
echo 'active';
} ?> '><a  style="margin-left:20px;" data-toggle="pill" href="#notapprove">New Members (Pending) (<?php echo $notapprove; ?>)</a></li>
<?php } ?>


<!-- <li><a data-toggle="pill" href="#">Request <span>(<?php echo $subadmin; ?>)</a></li> -->

</ul>
</div>
<!-- <div class="col-md-2">
<h3>Members <span>(<?php echo $totMember; ?>)</span></h3>
</div>
<div class="col-md-2">
<h3>Admins <span>(<?php echo $admin; ?>)</span></h3>
</div>
<div class="col-md-3">
<h3>Assistant Admins <span>(<?php echo $subadmin; ?>)</span></h3>
</div>
<div class="col-md-5">
<a href="#" class="btn btn-white pull-right"><i class="fa fa-plus"></i> Add</a>
<select class="form-control">
<option>Sort By</option>
<option>Asc</option>
<option>Desc</option>
</select>
</div> -->
</div>
</div>
<div class="row no-margin">

<div class="tab-content">

<div id="memberstab" class=" tab-pane fade  <?php if (($_GET['tab'] != 'memberreq') && ($_GET['tab'] != 'assistant')) {
echo ' in active';
}  ?>">

<div class="main_pading">
<?php include('all-member.php'); ?>
</div>

</div>

<div id="admintab" class="tab-pane fade">
<div class="main_pading">
<?php include('admin.php'); ?>
</div>
</div>
<div id="assistanttab" class="tab-pane fade <?php if ($_GET['tab'] == 'assistant') {
echo ' in active';
} ?>">
<div class="main_pading">
<?php include('assistant.php'); ?>
</div>
</div>

<div id="notapprove" class="tab-pane fade <?php if ($_GET['tab'] == 'memberreq') {
echo ' in active';
}  ?> ">
<div class="main_pading">
<?php include('notapprove.php'); ?>
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

<div id="StorebannerUpload" class="modal fade" role="dialog">
<div class="modal-dialog">

<form id="address" action="<?php echo $BaseUrl . '/grouptimelines/uploadgroupbanner.php'; ?>" method="post" enctype="multipart/form-data">
<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Group Setting <?php echo $_GET['groupname'] ?></h4>
</div>

<div class="modal-body">
<div class="row">
<div class="col-md-12">
<h4>Group Name</h4>
<div id=""></div>
<input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
<input type="text" id="gname" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control bradius-10">
</div>


</div>



<div class="row">
<div class="col-md-6">



<!--<input type="text" onkeyup="clearerror();" class="form-control bradius-10" id="spgroupLocation" name="spgroupLocation" value="<?php echo $spgroupLocation; ?>"  />-->

<?php
//$p = new _spuser

$res = $g->read($getid);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);

$spUserCountry = $ruser["spUserCountry"];
$spUserState = $ruser["spUserState"];
$spUserCity = $ruser["spUserCity"];
}

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$spUserCountry = $ruser["spUserCountry"];
$spUserState = $ruser["spUserState"];
$spUserCity = $ruser["spUserCity"];
}


?>

<input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
<div class="form-group">

<label for="spProfilesCountry" class="add_shippinglabel">
<h4>Country:</h4><span class="red"></span>
</label>
<select id="spUserCountry_default_address" class="form-control " name="spUserCountry">
<option value="0">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
<?php echo $row3['country_title']; ?>
</option>
<?php
}
}
?>
</select>
<span id="shippcounrty_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<div class="loadUserState">
<label for="spUserState" class="add_shippinglabel">
<h4>State:</h4><span class="red"></span>
</label>
<select class="form-control" name="spUserState" id="spUserState">
<option value="0">Select State</option>
<?php
//echo $spUserState; die('');
// if (isset($spUserState) && $spUserState > 0) {
$pr = new _state;
$result2 = $pr->readState($spUserCountry);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
//  }
?>
</select>
<span id="shippstate_error" style="color:red;"></span>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<div class="loadCity">
<label class="add_shippinglabel" for="spUserCity">
<h4>City:</h4><span class="red"></span>
</label>
<!--<input type="text" class="form-control" name="city" id="shipp_city">-->
<select class="form-control" name="spUserCity" id="spUserCity">
<option value="0">Select City</option>
<?php
//    if (isset($usercity) && $usercity > 0) {
$co = new _city;
$result3 = $co->readCity($spUserState);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
}
//    } 
?>
</select>
<span id="shippcity_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="add_shippinglabel" for="shipp_address">
<h4>Address:</h4><span class="red"></span>
</label>


<input class="form-control" type="text" id="shipp_address" value="<?php
echo (isset($address) && !empty($address)) ? $address : ''; ?>" name="address" autocomplete="off" />

<span id="shippaddress_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="add_shippinglabel" for="shipp_zipcode">
<h4>Zipcode:</h4>
</label>
<input type="text" class="form-control" maxlength="6" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>">
<span id="shippzipcode_error" style="color:red;"></span>
</div>
</div>


<div class="col-md-6">
<h4>Select Privacy</h4>
<div id=""></div>


<div class="form-control bg_gray_light no-radius bradius-10">
<div class="row">
<div class="col-md-4">
<label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag == 0) {
echo "checked";
} ?>>Public</label>
</div>
<div class="col-md-4">
<label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag == 1) {
echo "checked";
} ?>>Private</label>
</div>

</div>
</div>
</div>

</div>

<div class="row">
<div class="col-md-6">
<input type="hidden" name="groupid" value="<?= $getid; ?>">
<h4>Short Description (Max 50 words)</h4>
<div id=""></div>
<br />

<input type="text" class="form-control bradius-10" id="spGroupTagline" name="spGroupTag" value="<?php echo $row['spGroupTagline']; ?>">
</div>

<div class="col-md-6">
<h4>Group Category</h4>
<div id=""></div>
<br />

<select class="form-control bradius-10" onclick="clearerror();" id="grpcategory" name="spgroupCategory">
<option value="<?php echo $id; ?>">Select Category </option>

<?php

$sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


$result = mysqli_query($dbConn, $sql);
//var_dump($result);

while ($rows = mysqli_fetch_assoc($result)) {
//print_r($rows);die('===');
?>
<?php //echo $spgroupCategory ;
?>
<option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
echo "selected";
} ?>>
<?php echo $rows["group_category_name"]; ?>
</option>


<?php
}
?>

</select>

</div>
</div>



<div class="row">
<div class="col-md-12">
<h4>Description</h4>
<div id=""></div>
<br />

<textarea onkeyup="clearerror();" class="form-control bradius-10" id="spGroupAbout" name="spGroupAbout">
<?php
echo $spGroupAbout;
?>

</textarea>
</div>


</div>
<div class="row">
<div class="col-md-6">
<h4>Choose your banner</h4>
<div id=""></div>
<br />
<?php //echo  $bannerfile.'---------';
?>

<input type="file" name="bannerfile" class="basestorebanner" id="basestorebannerid" style="display: block;" />
<input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">



<input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
<input type="hidden" id="sgroupid" value="<?php echo $getid ?>">
</div>






<div class="col-md-6">
<h4>Your selected banner will appear here...</h4>
<div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
<?php if ($bannerpicture) { ?>
<img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
<?php } else { ?>
<img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

<?php } ?>
</div>
</div>



</div>






<div class="modal-footer bg-white br_radius_bottom">
<button type="submit" class="btn btn-primary" id="update3" style="">Update Data</button>

<button type="button" class="btn btn-default db_btn db_orangebtn" style="   padding-top: 5px!important;
padding-bottom: 7px!important;" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</form>
</div>
</div>


<style>
<!--	.text-center {
margin-top:0px !important;
}
-->
</style>
<?php include('../component/footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>

</body>

</html>
