<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/


ob_start();
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "my-groups/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
include('../univ/main.php');
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
spl_autoload_register("sp_autoloader");


include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
if ($group_id && isset($_GET['groupname']) && $group_id > 0) {
  $groupid = $group_id;
  $_GET['grouptimelinePage'] = 'yes';
} else {
  $groupid = 0;
header('location:' . $BaseUrl . '/timeline');
}

?>
<?php

$sn = new  _spgroup;
$reshsp = $sn->get_group_details($_SESSION['pid'], $groupid);
//print_r($reshsp); die('========s');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../component/f_links.php'); ?>
<!--NOTIFICATION-->

<style>
.timlinepicture.text-center {
margin-top: 25px !important;
}
</style>
<style>
#Menu ul {
display: none;
}

#Menu {
list-style: none;
}

#Menu li:hover>ul {
display: flex;
margin-top: -75px;
}

#Menu li ul {
margin: 0;
padding: 0;
position: absolute;
z-index: 5;
padding-top: 6px;
}

#Menu li {
float: left;
margin-left: 10px;
}

#Menu li ul li {
float: none;
margin: 0;
display: inline;
}

#Menu li ul li a {
display: block;
padding: 6px 10px;
background: #333;
white-space: nowrap;
}

#Menu li {
display: list-item;
text-align: -webkit-match-parent;
}

#Menu ul {
border: 0;
font-size: 100%;
font: inherit;
vertical-align: baseline;
}


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

.nav ul li+li {
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


.nav ul li>ul {
display: none;
position: absolute;
width: 150px;
top: 100%;
left: -1px;
z-index: 5;
text-align: left;
}

.nav ul li>ul li {
float: none;
margin: -2px;
}

.nav ul li>ul li a {
display: flex;

}

#hover:hover {

background-color: green;
}


.nav ul li.active {
pointer-events: none;
}


.navigation :hover {
display: flex !important;

}

.searchkeywordbox {
padding-top: 6px !important;
}

.nav-tabs>li.active>a span {
border-bottom: none !important;
}



</style>


<div id="testmodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close " data-dismiss="modal" aria-hidden="true">&times;</button>
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

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!--This script for sticky left and right sidebar STart-->
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<link rel="stylesheet" href="../assets/css/group_inner.css">
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

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


</head>

<body onload="pageOnload('groupdd')" class="bg_gray">
<?php

include_once("../header.php");
if (!isset($_SESSION['pid'])) {
include_once("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $groupid . "&groupname=" . $_GET['groupname'] . "&timeline";
}
$g = new _spgroup;
$result = $g->groupdetails($groupid);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
/*  print_r($row);*/
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}

$result_ismember = $g->ismember($groupid, $_SESSION['pid']);
//echo $g->ta->sql;
if ($result_ismember != false) {



$row_ismember = mysqli_fetch_assoc($result_ismember);

/* print_r($row_ismember);*/


/*  $admin_Id = $row_ismember['idspProfiles'];
$admin_Name = $row_ismember['spProfileName'];

$admin_ptype = $row_ismember['spProfileType_idspProfileType'];*/

$profile_exist = $row_ismember['spProfiles_idspProfiles'];
$approve =   $row_ismember['spApproveRegect'];

/*spApproveRegect*/
}



?>

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
<button type="button" class="btn btn_gray btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" class="btn btn_blue commentboxpost btn-border-radius">Comment</button>
</div>
</form>
</div>
</div>
</div>
<!-- COMMENT MODEL FOR TIMELINE START -->
<section class="landing_page">
<div class="container">

<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="grpid" value="<?php echo $groupid; ?>">
<input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
<input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
<div class="row">
<div id="sidebar" class="col-md-2 no-padding">
<?php
//GET ADMIN NAME OR ID
include('../component/left-group.php');
?>
</div>

<?php
if ($_GET['msg'] == "success") {

?>
<div class="alert alert-success" id="alert1" style="margin-left: 218px;margin-right:17px" onload="setTimeout()" role="alert">
Group Page Created Successfully!
</div>
<?php } ?>

<?php if ($_GET['msg'] == "update") {

?>
<div class="alert alert-success" id="alert1" style="margin-left: 218px;margin-right:17px" onload="setTimeout()" role="alert">
Group Page Update Successfully!
</div>

<?php    }

?>

<div class="row">



<?php

$g = new _spgroup;
if ($groupid) {
$result_grp_admin = $g->readgroupAdmin($groupid);

if ($result_grp_admin != false) {
$row_grp_admin = mysqli_fetch_assoc($result_grp_admin);

$admin_Id = $row_grp_admin['idspProfiles'];
}
}


if ($admin_Id  == $_SESSION["pid"]) {
?>
<div class="col-md-9 11">
<?php
} else {
?>
<div class="col-md-12 333">
<?php
}
?>





<?php
//this is another form for group timeline 
$grouptimelines = 1;
if (!isset($_GET['pendingtimeline'])) {
if (!empty($profile_exist) &&  $approve == 1) {
include("grouptimelineform.php");
}
}
//GLOBAL TIME LINE DETAIL FOR GROUP OR TIMELINE
//include("../publicpost/globaltimelines.php");

if (isset($_GET['pendingtimeline'])) {

include("../publicpost/pendinggrouptimeline.php");
} else {
include("../publicpost/grouptimeline.php");
}
?>
</div>


<?php
include_once("../header.php");
include('../publicpost/globaltimelineformEdit.php');

?>


<?php if (!empty($profile_exist) &&  $approve == 1) { ?>

<?php $g = new _spgroup;
$result = $g->pendingRequests($groupid);
if ($result != false) {
$row1 = mysqli_fetch_assoc($result);
//print_r($pendCounter); 
$spProfiles_idspProfiles = $row1['spProfiles_idspProfiles'];
}

if ($spProfiles_idspProfiles == $_SESSION['pid']) { ?>
<div id="sidebar_right" class="col-md-3" style="padding-left: 0px;margin-top:35px;">
<div class="add_friend bg_white right_sidebar_group_timeline" style="max-height: 600px;
overflow-y: scroll;">
<div class="member_add_top bg-white">
<h2><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/add_member.png" class="" alt="" /> Add Members </h2>
</div>
<?php include('../my-groups/myfriend.php'); ?>
<?php //include('../my-groups/myfriend_second.php'); 
?>
<!-- <div class="see_more">
<a href="#" class="">See More <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/dropdown_arrow_black.png"></a>
</div> -->
</div>

<!--         <div class="add_friend bg_white right_sidebar_group_timeline">
<div class="member_add_top bg-white">
<h2>Who is online <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/who_is_online.png" class="pull-right" alt="" /></h2>
</div>
<?php include('onlineusers.php'); ?>

<div class="member_add_top search_online bg-white" style="    padding-bottom: 33px;">
<input type="text" name="" class="form-control bradius-20" placeholder="Search" />
</div>

</div> -->
</div>

<?php }
} ?>


</div>
</div>

</div>
</div>
</section>
<?php include('../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
} ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="myModalLabel"></h4>
<div role="tabpanel" id="total_reaction">
<!-- Nav tabs -->

<ul class="nav nav-tabs" role="tablist" id="top_reaction">


</ul>
<!-- Tab panes -->
<div class="tab-content" id="bottom_reaction">



</div>



</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- modal code  -->



<script>
$(".rcount").on("click", function() {
var postidr = $(this).attr("data-postidr");
//	var rdetails = $(".rcount").val();


$.ajax({
url: "../social/getReaction.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response) {

$('#top_reaction').html(response);
},

});

$.ajax({
url: "../social/getReaction1.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response) {

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

$(".reactionbtn_remove").on("click", function() {
var rection = "&#128077;&#127995;";


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
success: function(response) {
$('#currentreaction_' + postid).html(rection);

//		$('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');		

//	$('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

},

});
});



$(".reactionbtn").on("click", function() {
var postid = $(this).attr("data-postid");
var reaction = $(this).attr("data-reaction");

var rid = $(this).attr("data-reaction");

if (rid == 1) {
rection = "&#128525;";
}

if (rid == 2) {
rection = "&#128512;";
}
if (rid == 3) {
rection = "&#128546;";
}
if (rid == 4) {
rection = "&#129315;";
}
if (rid == 5) {
rection = "&#128563;";
}
if (rid == 6) {
rection = "&#128545;";
}

if (rid == 7) {
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
success: function(response) {
$('#currentreaction_' + postid).html(rection);
//	$('#new_data_'+postid).html('<a id="currentreaction_'+postid+'" class="reactionbtn_remove" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');		
//				  $('#currentreaction_'+postid).removeClass('reactionbtn').addClass('reactionbtn_remove');

},

});
});


setTimeout(function() {
$('#alert1').hide();
}, 2000);

$(document).ready(function() {
$(".cancelreq").click(function() {
var pid = $(this).data("pid");
var gid = $(this).data("gid");
$.ajax({
method: "POST",
url: "../my-groups/cancel_join.php",
data: {
'pid': pid,
'gid': gid
},
cache: false,
success: function(data) {
location.reload();
},
});
});
});
</script>
