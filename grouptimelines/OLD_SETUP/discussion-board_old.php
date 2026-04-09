<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

ob_start();
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}


include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<?php include('../component/links.php'); ?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
<!--This script for sticky left and right sidebar STart-->

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
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
<style type="text/css">
.selldiscusshead {
background-color: #1c4994 !important;
color: #fff;
border-top-left-radius: 15px;
border-top-right-radius: 15px;
}

btn:hover {
color: #f3e6f2 !important;
opacity: .8;
}

.zoom1:hover {
-ms-transform: scale(1.15);
/* IE 9 */
-webkit-transform: scale(1.15);
/* Safari 3-8 */
transform: scale(1.15);
}

#new1:hover {
color: white !important;
opacity: .8;
}

.db_primarybtn {
background: #83319f !important;
border: 1px solid transparent !important;
}

.zoom2:hover {
-ms-transform: scale(1.10);
/* IE 9 */
-webkit-transform: scale(1.10);
/* Safari 3-8 */
transform: scale(1.10);
}

</style>

</head>

<body onload="pageOnload('groupdd')" class="bg_gray">
<?php

include_once("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
/* 
print_r($_SESSION['pid']);
print_r($row);*/
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];

$sprofileid = $row['spProfiles_idspProfiles'];

$assostadmin = $row['spAssistantAdmin'];
}
$pr = $g->admin_Member($_SESSION['pid'], $group_id);
//echo $g->tad->sql;
if ($pr != false) {
$row = mysqli_fetch_assoc($pr);
//print_r($row);
$admin = $row["spProfileIsAdmin"];
$assistadmin = $row['spAssistantAdmin'];
}
?>

<section class="landing_page">
<div class="container">
<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="grpid" value="<?php echo $group_id; ?>">
<input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
<input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
<div class="row">
<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-group.php'); ?>
</div>

<div class="col-md-10">


<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<!--                                                 <span ><p id="size1" >Group </p><small>[Discussion Board]</small></span>
--> <span id="size1"> <small>Discussion Board</small></span>
</div>



<div class="col-md-6">
<a class="pull-right" href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1">Back</a>


<?php if ($admin == 0 || $assistadmin == 1) { ?>


<a href="#" data-toggle="modal" data-target="#conversationModal" id="new1" class="btn btnPosting db_btn db_primarybtn pull-right zoom2 btn-border-radius"><i class="fa fa-plus"></i><span class=""> New Discussion</span></a>

<?php } ?>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table_black_head text-center grpconversation " style="margin-top: 15px;">
<thead id="bgcl">
<tr>
<th>Topic</th>
<th>Post By</th>
<th>Reply</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$profileid = $_SESSION['pid'];
//Admin Testing Complete
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $group_id);
//echo $g->tad->sql;
if ($pr != false) {
$row = mysqli_fetch_assoc($pr);
// print_r($row);
$admin = $row["spProfileIsAdmin"];
$assistadmin = $row['spAssistantAdmin'];
}
$gc = new _groupconversation;
$m = new _spgroupmessage;
$res = $m->read($group_id);
//QUERY FOR CHEK HOW MANY PERSON IS ONLINE OR NOT
//echo $m->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {

// print_r($rows);

$latestreply = "";
$totalreply = 0;
$result = $gc->read($rows["idspGroupMessage"]);


$r = new _groupdiscussreply;

$sumres = $r->readdiscussmsg($rows["idspGroupMessage"]);

//echo $r->ta->sql; 

//print_r($sumres->num_rows); 

$totalreplies = $sumres->num_rows;


if ($result != false) {

$totalreply = $result->num_rows;
while ($row = mysqli_fetch_assoc($result)) {
$latestreply = $row["spProfileName"];
$datetime = $row["spGroupConversationDate"];
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
} else {
$datetime = isset($rows["spGroupMessageDate"]);
$latestreply = isset($rows["spProfileName"]);
$datetime = isset($row["spGroupConversationDate"]);
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
$result1 = $gc->readCreaterMsg($rows["idspGroupMessage"]);
if ($result1 != false) {
$row1 = mysqli_fetch_assoc($result1);
}

if (isset($admin) == 0 && $rows["spGroupMessageFlag"] != 2) { //Admin Approval And rejection
?>
<tr>
<td>
<a href="<?php echo $BaseUrl; ?>/grouptimelines/discussion-chat.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&sendrid=<?php echo $profileid; ?>&gid=<?php echo $rows["idspGroupMessage"]; ?>&disc">
<h3 class="eventcapitalize"><?php echo $rows["spGroupMessage"]; ?></h3>
</a>
<p><?php echo $row1['spGroupConversationText']; ?></p>
</td>
<td>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
</td>

<!--      <td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $rows['idspGroupMessage']; ?>" style="color: #fff!important;  background-color: #1c4994; border-radius: 20px;">Reply</a></td> -->

<td><?php if ($totalreplies > 0) {
echo $totalreplies;
} else {
echo "0";
} ?></td>

<td>


<a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage'] . '&groupid=' . $group_id; ?>" class=""></a>


<!--  <?php
if ($rows["spGroupMessageFlag"] == 1) { ?>
<button type='button' data-messageid='<?php echo $rows["idspGroupMessage"]; ?>' class='btn btn-success approve btn-xs'>Approve</button>
<button type='button' data-messageid='<?php echo $rows["idspGroupMessage"]; ?>' class='btn btn-danger reject btn-xs'>Reject</button> <?php
} else {
?>
<h4><?php echo $totalreply; ?></h4> <?php
}
?> -->
</td>
</tr>
<?php
} else { //Only Approved message seen by group Member
if ($rows["spGroupMessageFlag"] == 0) {
?>
<tr>
<td>
<h3 class="eventcapitalize" data-senderprofile="<?php echo $profileid; ?>" data-gid="<?php echo $rows["idspGroupMessage"]; ?>">
<a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage'] . '&groupid=' . $group_id; ?>" class=""><?php echo $rows["spGroupMessage"]; ?></a>
</h3>
<p style="word-wrap:break-word!important;width:500px!important;"><?php echo $row1['spGroupConversationText']; ?></p>
</td>
<td class="eventcapitalize">
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
</td>

<!--      <td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $rows['idspGroupMessage']; ?>" style="color: #fff!important;  background-color: #1c4994; border-radius: 20px;">Reply</a></td> -->

<td><?php if ($totalreplies > 0) {
echo $totalreplies;
} else {
echo "0";
} ?></td>

<td>
<?php if ($admin == 0 || $assistadmin == 1) { ?>
<a href="javascript:void(0)" data-postid="<?php echo $rows['idspGroupMessage']; ?>" class="deldiscussion"><i class="fa fa-trash zoom1"></i></a>
<?php  } ?>

</td>
<td>
<a href="#" data-toggle="modal" data-target="#conversationModal1" data-postid="<?php echo $rows['idspGroupMessage']; ?>" data-textid="<?php echo $row1['idspGroupConversation']; ?>" data-spGroupMess="<?php echo $rows['spGroupMessage']; ?>" data-spGroupConver="<?php echo $row1['spGroupConversationText']; ?>" class="deldiscussion1">
<i style="margin-left: -57px;" class="fa fa-edit zoom1"></i>
</a>
</td>


<!--   <td>
<a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage']; ?>" class=""><i class="fa fa-eye"></i></a>
</td>
-->
<!-- Modal -->
<div class="modal fade" id="mycomment<?php echo $rows['idspGroupMessage']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

<!--   <form id="sellercommentfrm"action="addsellercomment.php" method="post" enctype="multipart/form-data"> -->
<div class="modal-content no-radius bradius-15">
<div class="modal-header selldiscusshead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Reply</h3>

</div>
<div class="modal-body">
<!--   <input type="hidden" name="cid" value="<?php echo $row['id']; ?>"> -->
<!--   <input type="hidden" name="spByuerProfileId" value="<?php echo $buyerprofilid; ?>">
<input type="hidden" name="spSellerProfileId" value="<?php echo $sellerprofilid; ?>">

<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

-->

<input type="hidden" name="spreplyerProfileId" id="spreplyerProfileId<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="comment_id" id="comment_id<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $rows['idspGroupMessage']; ?>">
<div class="form-group">
<label for="sell1">Enter your message <span class="red">*</span></label>
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $rows['idspGroupMessage']; ?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style="background-color: #A60000; color: #fff; min-width: 100px;">Close</button>
<button type="button" class="btn btn-primary btn-border-radius" onclick="get_commentdata(<?php echo $rows['idspGroupMessage']; ?>)" style="background-color: #1c4994; color: #fff;border: none; min-width: 100px;">Submit</button>
</div>
</div>
<!--    </form>  -->
</div>
</div>

</div>
</tr>
<?php
}
}
}
} else { ?>

<tr>
<td colspan="4">

<p class="text-center">No Discussion Found</p>
<td>
</tr>

<?php  } ?>

</tbody>
</table>
</div>

</div>
<!--END left col-6-->

</div>
<!--END row-->
<?php //include('conversation.php');
?>

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
<form method="post" id="message_form">
<!-- action="sendmessage.php"  -->
<input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>" />


<input type="hidden" id="starter" value="<?php echo $profilename; ?>" />

<input type="hidden" name="spGroup_idspGroup" value="<?php echo $group_id ?>" />

<input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>" />

<input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">

<div class="form-group">
<label for="message" class="form-control-label">New Topic<span class="red">*</span> <span id="message_error" style="color:red;"></span></label>
<input type="text" class="form-control" id="message" name="spGroupMessage" onkeyup="keyupsponsorfun()" />
</div>

<div class="form-group">
<label for="message" class="form-control-label">Message<span class="red">*</span> <span id="description_error" style="color:red;"></span></label>
<textarea class="form-control" id="description" rows="5" maxlength="150" name="conversationText_" onkeyup="keyupsponsorfun()"></textarea>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style=" ">Cancel</button>
<button type="button" id="groupconversation" class="btn btn-primary btn-border-radius">Start</button>

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


<div class="modal fade" id="conversationModal1" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="enquireModalLabel"><b>Update Conversation</b></h4>
</div>
<div class="modal-body" style="background-color:white;">
<form action="updatemessage.php" method="post" id="message_form">
<!-- action="sendmessage.php"  -->
<input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>" />


<input type="hidden" id="starter" value="<?php echo $profilename; ?>" />

<input type="hidden" name="spGroup_idspGroup" value="<?php echo $group_id ?>" />

<input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>" />

<input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">







<input type="hidden" name="spGroup_idspGroup1" value="<?php echo $group_id ?>" />
<input type="hidden" name="groupname1_" value="<?php echo $_GET['groupname'] ?>" />
<input type="hidden" id="messageid1" name="messageid1" value="" >
<input type="hidden" id="textid1" name="textid1" value="" >
<div class="form-group">
<label for="message" class="form-control-label">New Topic<span class="red">*</span> <span id="message_error" style="color:red;"></span></label>
<input type="text" class="form-control" id="message11" name="spGroupMessage1" value="" onkeyup="keyupsponsorfun()" />
</div>

<div class="form-group">
<label for="message" class="form-control-label">Message<span class="red">*</span> <span id="description_error" style="color:red;"></span></label>
<textarea class="form-control" id="description11" rows="5" maxlength="150" name="conversationText_" value="" onkeyup="keyupsponsorfun()"></textarea>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
<button type="submit" id="groupconversation" name="update" class="btn btn-primary btn-border-radius">Update</button>

</div>
</form>
</div>
</div>
</div>
</div>


<script>
$(".deldiscussion1").click(function () {
var postid = $(this).attr("data-postid");
var textid = $(this).attr("data-textid");
var spGroupMess = $(this).attr("data-spGroupMess");
var spGroupConver = $(this).attr("data-spGroupConver");


$("#messageid1").val(postid);
$("#textid1").val(textid);
$("#message11").val(spGroupMess);
$("#description11").val(spGroupConver);

});

</script>

















</section>
<?php include('../component/footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>


<script type="text/javascript">
$(document).ready(function(e) {
// Submit form data via Ajax
$("#groupconversation").on("click", function() {

//alert();
var msg = $("#message").val();

var descrip = $("#description").val();
var grpid = $('#grpid').val();
var grpName = $('#grpName').val();

//alert(msg);
//alert(descrip);

if (msg == "" && descrip == "") {

$("#message_error").text("This field is required.");
$("#message").focus();

$("#description_error").text("This field is required.");
$("#description").focus();


return false;
} else if (msg == "") {

$("#message_error").text("This field is required.");
$("#message").focus();


return false;
} else if (descrip == "") {

$("#description_error").text("This field is required.");
$("#description").focus();


return false;
} else {
$("#message_form").submit();

//alert("Form Submitted Successfuly!");

return true;


}

});
});

$("#message_form").on('submit', function() {
var formData = new FormData($("#message_form")[0]);

$.ajax({
url: 'sendmessage.php',
type: 'POST',
data: formData,
processData: false,
contentType: false,
dataType: 'json',
success: function(response) {
if (response == 1) {
location.reload();
}
},
error: function(error) {

}
});
})


function keyupsponsorfun() {


var msg = $("#message").val();

var descrip = $("#description").val();


if (msg != "") {
$('#message_error').text(" ");

}
if (descrip != "") {
$('#description_error').text(" ");
}



}
</script>



</body>

</html>
